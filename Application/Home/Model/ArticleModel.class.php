<?php
namespace Home\Model;
use Admin\Model\TermModel;
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

    public function getTagsByCategory($cid = 0) {
        if ($cid != 0) {
            $where['cid'] = array('in', (new CategoryModel())->getThisCategoryChildren($cid));
        }
        $where['status'] = 1;
        $list = $this->where($where)->field('id')->select();
        if (!empty($list)) {
            $objectIds = array();
            foreach($list as $val) {
                $objectIds[] = $val['id'];
            }
            $tags = (new TermModel())->getTermsByObjectIdAndTaxonomy('Article', $objectIds);
            $this->buildTagsUrl($tags);
            return $tags;
        } else {
            return null;
        }


    }

    /**
     * @param int $cid when cid = 0 means the all article not care about the cid
     * @param int $limit
     * @param int $page when the page = 0 means this is first page
     * @param int $everyPageNum
     * @return array|bool
     */
    public function getArticleListByCategory($cid = 0 ,$limit = 0, $page = 0, $everyPageNum = 0) {
        $tagArticleList = cacheTag(ArticleList, $cid, $page);
        if (false === ($list = getCache($tagArticleList))) {
            if (empty($everyPageNum)) {
                $everyPageNum = C('EVERY_PAGE_NUM');
            }
            if (empty($limit)) {
                $limit = $everyPageNum;
            }
            $where = array();
            if($cid !=0) {
                $where['cid'] = array('in', (new CategoryModel())->getThisCategoryChildren($cid));
            }
            $where['status'] = 1;
            if ($page < 1) {
                $list = $this->where($where)->order('sort DESC, createtime DESC')->relation(true)->limit($limit)->select();
            } else {
                $first = ($page - 1) * $everyPageNum;
                $list = $this->where($where)->order('sort DESC, createtime DESC')->relation(true)->limit($first, $everyPageNum)->select();
            }

            $this->getExtendInfoForArticle($list, true, true);

            setCache($tagArticleList, $list, C('ARTICLE_TTL'));


        }
        return $list;
    }



    /**
     * get a articel && set cache
     * @param $id
     * @return false | array
     */
    public function getArticleById($id) {
        $tagArticle = cacheTag(OneArticle, $id);
        if (false === ($article = getCache($tagArticle))) {
            $where['id'] = $id;
            $where['status'] = 1;
            $article = $this->where($where)->relation(true)->find();
            if(empty($article))
                return false;

            $this->getExtendInfoForArticle($article);
            setCache($tagArticle, $article, C('ARTICLE_TTL'));

        }
        return $article;
    }

    /**
     * get article List group by date
     * @param int $cid
     * @return bool | array
     */
    public function getArticleListGroupByDateByCategry($cid = 0) {
        $tagDateArticel = cacheTag(ArticleCountGroupByDate,$cid);
        if (false === ($list = getCache($tagDateArticel))) {

            if ($cid == 0) { //全部文章
                $cidCondition = "";
            } else {
                $where['cid'] = $cid;
                $allCid =  (new CategoryModel())->getThisCategoryChildren($cid);
                $allcid = implode(",", $allCid);
                $cidCondition = " and cid in ($allcid) ";
            }

            $list = $this->query("SELECT COUNT(FROM_UNIXTIME(createtime,'%Y-%m')) AS count,FROM_UNIXTIME(createtime,'%Y%m') AS time, FROM_UNIXTIME(createtime,'%M %Y') AS title  FROM `".C('DB_PREFIX')."article`  where status=1" .$cidCondition ." GROUP BY time ORDER BY time DESC");

            foreach($list as &$value) {
                $value['cid'] = $cid;
                $value['url'] = U('date/'.$value['cid'] .'/' .$value['time']);
            }

            setCache($tagDateArticel, $list, C('ARTICLE_TTL'));
        }
        return $list;
    }

    public function getNextArticleByCategory($cid, $createtime) {
        $tagNextArticle = cacheTag(NextArticle, $cid, $createtime);
        if (false === ($next = getCache($tagNextArticle))) {
            $where['cid'] = $cid;
            $where['status'] = 1;
            $where['createtime'] = array('gt', $createtime);
            $next = $this->where($where)->relation(true)->order('createtime DESC')->field('content', true)->find();

            setCache($tagNextArticle, $next, C('ARTICLE_TTL'));

        }
        return $next;
    }

    public function getPrevArticleByCategory($cid, $createtime) {
        $tagPrevArticle = cacheTag(PrevArticle, $cid, $createtime);
        if (false === ($next = getCache($tagPrevArticle))) {
            $where['cid'] = $cid;
            $where['status'] = 1;
            $where['createtime'] = array('lt', $createtime);
            $next = $this->where($where)->relation(true)->order('createtime DESC')->field('content', true)->find();

            setCache($tagPrevArticle, $next, C('ARTICLE_TTL'));

        }
        return $next;
    }


    /**
     * get recent article in this category
     * @param int $cid
     * @param int $limit
     * @param int $notId
     * @param string $order
     * @return array|false
     */
    public  function getRecentArticleListByCategory($cid = 0, $notId = 0, $limit = 5, $order='id DESC, sort DESC') {
        $tagNewlyArticleList = cacheTag(RecentArticleList, $cid);
        if (false === ($list = getCache($tagNewlyArticleList))) {
            $where = array();
            if(!empty($notId)) {
                $where['id'] = array('neq', $notId);
            }
            $where['status'] = 1;
            if($cid != 0) {
                $where['cid'] = array('in', (new CategoryModel())->getThisCategoryChildren($cid)); //得到属于$cid的所有栏目的id
            }
            $list = $this->where($where)->relation(true)->order($order)->limit($limit)->select();

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
     * get article's count number in this category
     * @param int $cid
     * @return int | false
     */
    public  function getArticleCountByCategory($cid = 0) {
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


    public function setIncClickById($id, $field) {
        $this->where(array('id' => $id))->setInc($field);
    }

    private function buildTagsByObjectId($objectId) {
        $Terms = new TermModel();
        $tags = $Terms->getTermsByObjectIdAndTaxonomy('Article', $objectId);
        $this->buildTagsUrl($tags);
        return $tags;

    }

    private function buildTagsUrl(&$tags) {
        if(is_array($tags)) {
            foreach($tags as &$val) {
                $val['url'] = U('tag/' .$val['name']);
            }
        }

    }

    /**
     * extend info for article, include tags, comment count, author name
     * @param &$articles  | array | mixed array
     */
    private function getExtendInfoForArticle(&$articles, $isMixed = false, $isStrstrContent = false) {
        $Comment = new CommentModel();
        $temp = true;
        // if is not a array, become a array and sign it
        if ($isMixed == false) {
            $temp = array();
            $temp[] = $articles;
            $articles = $temp;
        }

        foreach($articles as &$val) {
            $val['commentCount'] =  (int)$Comment->getCommentCount($val['id'], $val['cid']);
            $val['url'] = U('article/' .$val['id']);

            $val['tags'] = $this->buildTagsByObjectId($val['id']);
            $val['adminUrl'] = U('admin/' .$val['adminid']);
            $val['cateUrl'] = U('cate/' .$val['cid']);

            if ($isStrstrContent == true) {
                $str = strstr($val['content'], "<hr>", true);
                if (!empty($str)) {
                    $val['content'] = $str;
                }
            }
        }

        // restore not to array
        if (false === $isMixed) {
            $articles = $articles[0];
        }

    }
}
?>

