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
    /* ===========================================================================*/
    /**
        * @brief getSearch   获得查询的信息
        *
        * @returns  $list
     */
    /* ===========================================================================*/
    protected function getSearch() {
        //$content = I('post.content');
        $content = $_REQUEST['content'];
     //   $content = str_replace('/[\S]*','',$content);
        $searchTable = C('SEARCHTABLE'); //需要查询的表
        $searchCol = C('SEARCHCOL');
        $searchSetCol = C('SEARCHSETCOL');
        $result = array();
        //var_dump($searchTable);
        //var_dump($searchCol);
        //var_dump($searchSetCol);
        foreach($searchTable as $val) {
            $model = D($val);
            $where = array();
            foreach($searchCol as $value) {
                $where[$value] = array('like', '%'.$content.'%');
            }
            $where['_logic'] = 'OR';
            //var_dump($where);
            $list = $model->where($where)->relation(true)->field('content', true)->select();
            $result = array_merge($result, $list);
        }
        $this->setSearch($result, $searchSetCol, $content);
        //var_dump($result);
        return $result;
    }
    /* ===========================================================================*/
    /**
        * @brief setSearch 标记查询内容
        *
        * @param    $list
        *
        * @returns  
     */
    /* ===========================================================================*/
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
        $this->assign('articleList', $articleModel->getArticleList());
        $this->assign('articleCount',$articleModel->getArticleCount());
        $this->assign('cid', 0);
        $this->assign('advertList', $advertList = $this->getAdvert());
        $this->assign('advertListCount', count($advertList));
<<<<<<< HEAD
        $this->assign('hotArticleList', ($hotArticleList = $articleModel->getNewlyArticleList()));
        $this->assign('hotArticleCount', count($hotArticleList));
=======
        $this->assign('hotArticleList', $articleModel->getNewlyArticleList());
>>>>>>> origin/master
        $this->assign('hotTitle', '最新文章');
        $this->seo('首页', NULL, NULL, NULL);
        //var_dump($this->getArticleList());
        $this->display();
    }
    private function getAdvert() {
        $where['status'] = 1;
        $list = M('Advert')->where($where)->order('sort DESC, createtime DESC')->select();
        return $list;
    }

    public function book() {
        $this->seo('书籍', NULL, NULL, NULL);
        //$mem = \MemcachedManager::getInstance();
        //var_dump($mem);
        //var_dump($mem->getStats());
        //$mem->set('hello', 'worldss');
        //var_dump($mem->get('hello'));
        $this->display();
    }

}
