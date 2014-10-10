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
        array('author', 'require', 'author必须!'),
    );

    /**
     * @param $oid | origin id like article id
     * @param $cid | category id
     * @return array|false
     */
    public function getCommentCount($oid, $cid) {
        $tagCommentCount = cacheTag(CommentCount, $oid, $cid);
        if (false === ($commentCount = getCache($tagCommentCount))) {
            $where['status'] = 1;
            $where['oid'] = $oid;
            $where['cid'] = $cid;
            $commentCount = $this->where($where)->count();

            setCache($tagCommentCount, $commentCount, C('COMMENT_TTL'));
        }
        return $commentCount;
    
    }
    /**
     * 获取评论的父亲的名字
     * @param &$list 
     **/
    public function getParentName(&$list) {
        foreach($list as &$val) {
            $where['status'] = 1;
            $val['parentName'] = $this->where('id='.$val['rid'])->getField('author');
            $val['parent_author_id'] = $this->where("id=".$val['rid'])->getField('author_id');
        }
    }
}
?>
