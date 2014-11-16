<?php
/**
 * 广告模型
 **/
namespace Admin\Model;
use Think\Model;
class ArticleModel extends CommonModel {
    protected $_validate = array(
        array('title','require','标题必须！'),
        array('description','require','描述必须！'),
        array('sort','require','排序值必须！'),
        array('content','require','内容必须！'),
        array('keyword','require','关键字必须！'),
    );

    public function delCache($cid = 0, $id = 0) {
        $tag = cacheTag(ArticleList, $cid, 0); // article page
        deleteCache($tag);
        $tag = cacheTag(ArticleList, 0, 0); // home page
        deleteCache($tag);
        $tag = cacheTag(OneArticle, $id);
        deleteCache($tag);
    }
}
