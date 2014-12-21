<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends CommonController {

    public function search() {
        $list = $this->getSearch();
        $this->assign('articleCount', count($list));
        $this->assign('articleList', $list);
        $this->display();
    }

    protected function getSearch() {
        $content = I('post.content');
        //$content = $_REQUEST['content'];
     //   $content = str_replace('/[\S]*','',$content);
        $searchTable = C('SEARCHTABLE'); //需要查询的表
        $searchCol = C('SEARCHCOL');
        $searchSetCol = C('SEARCHSETCOL');
        $result = array();
        foreach($searchTable as $val) {
            $model = D($val);
            $where = array();
            foreach($searchCol as $value) {
                $where[$value] = array('like', '%'.$content.'%');
            }
            $where['_logic'] = 'OR';

            $list = $model->where($where)->relation(true)->field('content', true)->select();
            $result = array_merge($result, $list);
        }
        $this->setSearch($result, $searchSetCol, $content);
        //var_dump($result);
        return $result;
    }

    protected function setSearch(&$list, $col, $content) {
        $replace = "<code>$content</code>";
        foreach($list as &$val) {
            foreach($col as $value) {
                $val[$value] = str_replace($content, $replace, $val[$value]);
            }
        }
    }

    public function index(){
        $articleModel = D('Article');
        $this->assign('article_list', $articleModel->getArticleList());
        $this->assign('recent_article_list', $articleModel->getRecentArticleList());
        $this->assign('archives_list', $articleModel->getArticleListGroupByDate());
        $this->seo('首页', NULL, NULL, NULL);
        $this->display();
    }

    public function book() {
        $this->seo('书籍', NULL, NULL, NULL);
        $this->display();
    }
    public function aboutme() {
        $this->seo('About Me', NULL, NULL, NULL);
        $this->display();
    }

}
