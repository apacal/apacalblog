<?php
/*留言评论模块*/
namespace Home\Controller;
use Think\Controller;
class CommentController extends CommonController {
	
	/**
	 * 发表留言
	 **/
	public function add(){
		$result = array('ret' => -1, 'error' => '');
		$data = $_POST;
	    $data['ip'] = get_client_ip(); 
        $data['createtime'] = time();
        $data['status'] = 1;
        if(!empty($_POST) && M('Comment')->add($data)){
			$result['ret'] = 0;
		}else{
			$result['error'] = '发表失败！';
		}
		$this->ajaxReturn($result, 'json');
	}

	/**
	 * 支持或者反对
	 **/
    public function vote() {
        $id = $_POST['id'];
        $type = $_POST['typeid'];
        $where['id'] = $id;
        $Comment = M('Comment');
        if($type == 1) {
            if($Comment->where($where)->setInc('agree'))
			    $result['ret'] = 0;
            else
			    $result['error'] = '赞成失败！';
        }else{
            if($Comment->where($where)->setInc('disagree'))
			    $result['ret'] = 0;
            else
			    $result['error'] = '反对失败！';
        }
		$this->ajaxReturn($result, 'json');
    }
    /**
     *  获取更多留言,供ajax调用
     **/
	public function more(){
        $model = D('Comment');
		//获取最多评论
        $p = I('post.p');
		$oid = I('post.id');
        $cid = I('post.cid');
		//获取一级评论总数
        $where['oid&status&pid&cid'] = array($oid,'1','0',$cid,'_multi' => true);
        $commentCount = $model->where($where)->count();
        //获取每页显示的数目
        $pageNum = C('COMMENT_PAGE_NUM');
        if(!isset($pageNum) || empty($pageNum)) {
            $pageNum = 5;
        }
        $maxShowComment = C('COMMENT_SHOWNUM');
        if(!isset($maxShowComment) || empty($maxShowComment)) {
            $maxShowComment = 5;
        }
        $commentNum = $maxShowComment + $p * $pageNum;
        $comment = $model->where($where)->limit($commentNum, $pageNum)->order('createtime ASC')->select();
        if(is_array($comment)) {
            foreach($comment as $key => $val) {
                $comment[$key]['reply'] = $model->where('status=1 AND pid='.$val['id'])->order('createtime ASC')->select();
                $comment[$key]['reply'] = isset($comment[$key]['reply']) ? $comment[$key]['reply'] : array();
                $model->getParentName($comment[$key]['reply']);
            }
        }
        if($commentCount > $commentNum + $pageNum)
            $this->assign('commentMore',1);
        else
            $this->assign('commentMore',0);
        $this->assign('commentList',$comment);//评论
		$this->display('Comment:comment');
	}
}
