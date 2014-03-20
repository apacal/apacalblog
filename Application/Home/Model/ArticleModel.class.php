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
     * 获取文章列表
     * @param $cid 栏目id, $cid = 0表示全部文章
     **/
    public function getArticleList($cid = 0) {
        $page =  I('post.p' ,0 , 'intval'); //当空为会转为0
        $pageNum = C('ARTICLE_PAGE_NUM');
		$articleShow = C('ARTICLE_SHOWNUM');
        if($cid !=0) 
            $where['cid'] = array('in', D('Category')->getChild($cid)); //得到属于$cid的所有栏目的id
        $where['status'] = 1;
        if ($page < 1) {
            $list = $this->where($where)->order('sort DESC, createtime DESC')->relation(true)->field('content', true)->limit($articleShow)->select();
        }else{
            $first = $articleShow + ($page - 1) * $pageNum;
            $list = $this->where($where)->order('sort DESC, createtime DESC')->relation(true)->field('content', true)->limit($first, $pageNum)->select();
        }
        return $list;
    }
    /**
     * 获取一篇文章
     **/
    public function getArticle($id) {
        $where['id'] = $id;
        $where['status'] = 1;
        $article = $this->where($where)->relation(true)->find();
        $article['commentCount'] =  (int)D('Comment')->getCommentCount($article['id'], $article['cid']);
        $admin = M('Admin')->where(array('adminid' => $article['adminid']))->find();
        $article['adminname'] = $admin['adminname'];
        $article['adminimage'] = $admin['image'];
        return $article;
    }
    /**
     * 获取热门文章
     **/
    public function getHotArticle($cid) {
        $where['cid'] = $cid;
        $where['status'] = 1;
        $list = $this->where($where)->order("sort DESC, click DESC")->field('content', true)->limit(5)->select();
        return $list;

    }
    /**
     * 按时间分类
     **/
     public function getDataArticle($cid) {
        $where['cid'] = $cid;
        $allCid =  D('Category')->getChild($cid); //得到属于$cid的所有栏目的id
        $allcid = implode(",", $allCid);
        $where['status'] = 1;
        $list = $this->query("SELECT COUNT(FROM_UNIXTIME(createtime,'%Y-%m')) AS count,FROM_UNIXTIME(createtime,'%Y-%m') AS time FROM `".C('DB_PREFIX')."article`  where status=1 and cid in (".$allcid.") GROUP BY time ORDER BY time DESC");
        foreach($list as &$value) {
            $value['cid'] = $cid;
        }
        return $list;
    }
    /**
     * 获取readNext，一篇以前的，两篇后面的。
     * @param $cid
     **/
    public function getReadNext($cid, $createtime) {
        $where['cid'] = $cid;
        $where['status'] = 1;
        $where['createtime'] = array('lt', $createtime);
        $prev = $this->where($where)->relation(true)->order('createtime DESC')->field('content', true)->find();
        $where['createtime'] = array('gt', $createtime);
        $next = $this->where($where)->relation(true)->order('createtime DESC')->field('content', true)->limit(2)->select(); 
        $list = array();
        if(!empty($prev))
            $list[] = $prev;
        if(!empty($next))
            foreach ($next as $value)
                $list[] = $value;
        return $list;
    }
}
?>

