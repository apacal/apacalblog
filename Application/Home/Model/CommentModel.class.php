<?php
/**
 * 评论模型
 **/
namespace Home\Model;
use Think\Model;
class CommentModel extends Model {
    //自动完成，必须调用create()方法，才会进行
    protected $_auto = array(
        array('status', '1'),
        array('createtime', 'time', 1, 'function'),
        array('ip', 'get_client_ip', 1, 'function'),
    );
    protected $_validate = array(
        array('content', 'require', 'content必须!'),
        array('name', 'require', 'name必须!'),
        array('email', 'require', 'eamil必须!'),
    );

    public function insert($data) {
        if (false === $this->add($data)) {
            return false;
        } else {
            return true;
        }
    }
    /**
     * @param $cid | category id
     * @param $oid | origin id like article id
     * @return array|false
     */
    public function getCommentCount($cid, $oid) {
        $tagCommentCount = cacheTag(__METHOD__, $oid, $cid);
        if (false === ($commentCount = getCache($tagCommentCount))) {
            $where['status'] = 1;
            $where['oid'] = $oid;
            $where['cid'] = $cid;
            $commentCount = $this->where($where)->count();

            setCache($tagCommentCount, $commentCount, COMMENT_TTL);
        }
        return $commentCount;
    
    }

    public function getRecentCommentListByCategory($cid = 0,$oid = 0, $limit = 5) {
        $tag = cacheTag(__METHOD__, $cid, $oid, $limit);
        if (false !== ($list = getCache($tag))) {
            return $list;
        }

        $where = array(
            'status' => 1,
        );
        if (0 != $oid) {
            $where['oid'] = $oid;
        }

        if (0 !== $cid) {
            $cids = (new CategoryModel())->getThisCategoryChildren($cid);
            if (!empty($cids)) {
                //$ids = implode(',', $cids);
                $where['cid'] = array('in', $cids);
            }
        }

        $list = $this->where($where)->order('createtime desc')->limit($limit)->select();
        if (empty($list)){
            return false;
        }

        $Category = new CategoryModel();
        foreach($list as &$val) {
            if(0 != $val['uid']) {
                $val['userUrl'] = U('user/' .$val['uid'] .C("URL_HASH"));
            }
            $extend = $Category->getExtendInfoByCategoryIdAndObjectId($val['cid'], $val['oid']);
            if(false !== $extend) {
                if(empty($extend['origin'])) {
                    $val['title'] = $extend['cate']['cname'];
                } else {
                    $val['title'] = $extend['origin']['title'];
                }
                if ($extend['cate']['url'][0] == '/') {
                    $val['url'] = $extend['cate']['url'];
                } else {
                    $val['url'] = U($extend['cate']['url'] , array('id' => $val['oid'], 'cid' => $val['cid']));
                    $val['url'] .= '#comment-' .$val['id'];
                }
            }



        }

        setCache($tag, $list, COMMENT_TTL);
        return $list;
    }


    /**
     * @param $cid
     * @param $oid
     * @return array|false|mixed|null
     */
    public function getCommentListByCidAndOid($cid, $oid) {
        $tag = cacheTag(__METHOD__, $cid, $oid);
        if (false !== ($list = getCache($tag))) {
            return $list;
        }
        $where = array(
            'status' => 1,
            'cid' => $cid,
            'oid' => $oid,
            'pid' => 0
        );
        $list = $this->getCommentListByWhere($where);

        if(is_array($list)) {
            foreach($list as &$val) {
                $where['pid'] = $val['id'];
                $subList = $this->getCommentListByWhere($where);

                if(is_array($subList)) {
                    foreach($subList as &$value) {
                        $where['pid'] = $value['id'];
                        $sub2List = $this->getCommentSub2AllList($where);
                        if(!empty($sub2List)) {
                            $value['sub2'] = $sub2List;
                        }
                    }
                    $val['sub'] = $subList;
                }
            }
        }


        setCache($tag, $list, COMMENT_TTL);
        return $list;


    }

    private function getAllCommentList($list, $where) {
        $data = $list;
        foreach ($list as $val) {
            $where['pid'] = $val['id'];
            $sub = $this->getCommentListByWhere($where);
            if (!empty($sub)) {
                $data = array_merge($data, $this->getAllCommentList($sub, $where));
            }
        }

        return $data;

    }

    private function getCommentSub2AllList($where) {
        $list = $this->getCommentListByWhere($where);
        if (empty($list)) {
            return null;
        }
        $data = $list;
        foreach($list as &$val) {
            $where['pid'] = $val['id'];
            $sub = $this->getCommentListByWhere($where);
            if (is_array($sub)) {
                $sub = $this->getAllCommentList($sub, $where);
                $data = array_merge($data, $sub);

            }

        }

        return $data;
    }


    /**
     * @param $where
     * @return mixed | false | null
     */
    private function getCommentListByWhere($where) {
        $list = $this->where($where)->select();
        $User = new \Admin\Model\UserModel();
        if(is_array($list)) {
            foreach ($list as &$val) {
                $parent = $this->where(array('id'=>$val['pid']))->find();
                if(is_array($parent)) {
                    $val['pName'] = $parent['name'];
                    $val['pUid'] = $parent['uid'];
                    if ($parent['uid'] != 0) {
                        $val['pUrl'] = U('user/' .$parent['uid'] .C('URL_HASH'));
                    }
                }

                if (0 != $val['uid']) {
                    $val['userUrl'] = U('user/' .$val['uid'] .C('URL_HASH'));
                    $val['image'] = $User->where(array('uid'=>$val['uid']))->getField('image');
                }
            }

        }
        return $list;
    }
}
?>
