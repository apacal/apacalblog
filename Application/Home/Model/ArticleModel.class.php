<?php
namespace Home\Model;
use Think\Model\RelationModel;
class ArticleModel extends RelationModel {

    /**
     * 定义关联模型，每篇文章属于一个栏目和关联到用户名
     **/
    protected $_link = array(
        'Category' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'Category',
            'foreign_key' => 'cid',
            'mapping_fields' => 'cname',
            'as_fields' => 'cname',
        ),
        'Admin' => array(
            'mapping_type' => self::BELONGS_TO,
            'class_name' => 'Admin',
            'foreign_key' => 'adminid',
            'mapping_fields' => 'adminname',
            'as_fields' => 'adminname',
        ),
    );

    /**
     * @param int $cid when cid = 0 means the all article not care about the cid
     * @param int $page when the page = 0 means this is first page
     * @return array|bool
     */
    public function getArticleList($cid = 0, $page = 0) {
        $pageNum = C('ARTICLE_PAGE_NUM');
		$articleShow = C('ARTICLE_SHOWNUM');
        $tagArticleList = cacheTag(ArticleList, $cid, $page);
        if (false === ($list = getCache($tagArticleList))) {
            if($cid !=0)
                $where['cid'] = array('in', D('Category')->getThisCategoryChildren($cid)); //得到属于$cid的所有栏目的id
            $where['status'] = 1;
            if ($page < 1) {
                $list = $this->where($where)->order('sort DESC, createtime DESC')->relation(true)->limit($articleShow)->select();
            } else {
                $first = $articleShow + ($page - 1) * $pageNum;
                $list = $this->where($where)->order('sort DESC, createtime DESC')->relation(true)->limit($first, $pageNum)->select();
            }

            foreach($list as &$val) {
                $val['url'] = U('article/' .$val['id']);
                $val['adminUrl'] = U('admin/' .$val['adminid']);
                // <hr> is mean this is a separate to article
                $str = strstr($val['content'], "<hr>", true);
                if (!empty($str)) {
                    $val['content'] = $str;
                }

            }

            setCache($tagArticleList, $list, C('ARTICLE_TTL'));


        }
        return $list;
    }

    /**
     * get a articel && set cache
     * @param $id
     * @return false | array
     */
    public function getArticle($id) {
        $tagArticle = cacheTag(OneArticle, $id);
        if (false === ($article = getCache($tagArticle))) {
            $where['id'] = $id;
            $where['status'] = 1;
            $article = $this->where($where)->relation(true)->find();
            if(empty($article))
                return false;
            $article['commentCount'] =  (int)D('Comment')->getCommentCount($article['id'], $article['cid']);
            $admin = M('Admin')->where(array('adminid' => $article['adminid']))->find();
            $article['adminname'] = $admin['adminname'];
            $article['adminimage'] = $admin['image'];

            setCache($tagArticle, $article, C('ARTICLE_TTL'));

        }
        return $article;
    }

    /**
     * get article count group by date
     * @param $count
     * @param int $cid
     * @return bool | array
     */
    public function getArticleCountGroupByDate(&$count, $cid = 0) {
        $tagDateArticel = cacheTag(ArticleCountGroupByDate,$cid);
        if (false === ($list = getCache($tagDateArticel))) {

            if ($cid == 0) { //全部文章
                $list = $this->query("SELECT COUNT(FROM_UNIXTIME(createtime,'%Y-%m')) AS count,FROM_UNIXTIME(createtime,'%Y-%m') AS time FROM `".C('DB_PREFIX')."article`  where status=1 GROUP BY time ORDER BY time DESC");
            } else {
                $where['cid'] = $cid;
                $allCid =  D('Category')->getThisCategoryChildren($cid); //得到属于$cid的所有栏目的id
                $allcid = implode(",", $allCid);
                $list = $this->query("SELECT COUNT(FROM_UNIXTIME(createtime,'%Y-%m')) AS count,FROM_UNIXTIME(createtime,'%Y-%m') AS time FROM `".C('DB_PREFIX')."article`  where status=1 and cid in (".$allcid.") GROUP BY time ORDER BY time DESC");
            }
            foreach($list as &$value) {
                $value['cid'] = $cid;
            }

            setCache($tagDateArticel, $list, C('ARTICLE_TTL'));
        }

        $count = count($list);
        return $list;
    }

    /**
     * get two next article and one prev article
     * @param $cid
     * @param $createtime
     * @return false | array
     */
    public function getReadNextAndPrev($cid, $createtime) {
        $tagNextAndPrev = cacheTag(ReadNextAndPrev, $cid, $createtime);
        if (false === ($list = getCache($tagNextAndPrev))) {
            $where['cid'] = $cid;
            $where['status'] = 1;
            $where['createtime'] = array('lt', $createtime);
            $prev = $this->where($where)->relation(true)->order('createtime DESC')->field('content', true)->find();
            $where['createtime'] = array('gt', $createtime);
            $next = $this->where($where)->relation(true)->order('createtime DESC')->field('content', true)->limit(2)->select();

            $list = array();
            if(!empty($prev)) {
                $list[] = $prev;
            }

            if(!empty($next)) {
                foreach ($next as $value) {
                    $list[] = $value;
                }
            }

            setCache($tagNextAndPrev, $list, C('ARTICLE_TTL'));

        }
        return $list;
    }


    /**
     * get recent article in this category
     * @param int $cid
     * @param string $order
     * @param int $limit
     * @return array|false
     */
    public  function getRecentArticleList($cid = 0, $order='id DESC, sort DESC', $limit = 5) {
        $tagNewlyArticleList = cacheTag(RecentArticleList, $cid);
        if (false === ($list = getCache($tagNewlyArticleList))) {
            $where['status'] = 1;
            if($cid != 0)
                $where['cid'] = array('in', D('Category')->getThisCategoryChildren($cid)); //得到属于$cid的所有栏目的id
            $list = D('Article')->where($where)->relation(true)->order($order)->limit($limit)->select();

            if (is_array($list)) {
                foreach ($list as &$val) {
                    $val['url'] = U('article/' .$val['id']);
                }
            }

            setCache($tagNewlyArticleList, $list, C('ARTICLE_TTL'));
        }
        return $list;
    }

    /**
     * get rand article in this category
     * @param int $cid
     * @param string $order
     * @param int $limit
     * @return array|false
     */
    public function getRandArticleList($cid = 0, $order='sort DESC, id DESC', $limit = 18) {
        $tagRandArticleList = cacheTag(RandArticleList, $cid);
        if (false === ($list = getCache($tagRandArticleList))) {
            $where['status'] = 1;
            if($cid != 0)
                $where['cid'] = array('in', D('Category')->getThisCategoryChildren($cid)); //得到属于$cid的所有栏目的id
            $list = D('Article')->where($where)->relation(true)->order($order)->limit($limit)->select();

            setCache($tagRandArticleList, $list, C('ARTICLE_TTL'));
        }
        return $list;
    }

    /**
     * get article's count number in this category
     * @param int $cid
     * @return int | false
     */
    public  function getArticleCount($cid = 0) {
        $tagArticleCount = cacheTag($cid);
        if (false === ($count = getCache($tagArticleCount))) {
            $where['status'] = 1;
            if($cid != 0)
                $where['cid'] = array('in', D('Category')->getThisCategoryChildren($cid)); //得到属于$cid的所有栏目的id
            $count = M('Article')->where($where)->count();

            setCache($tagArticleCount, $count, C('ARTICLE_TTL'));
        }
        return $count;
    }
}
?>

