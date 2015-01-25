<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-1-13
 * Time: 下午11:15
 */
namespace Home\Widget;
use Home\Model\CommentModel;
use Think\Controller;
class CommentWidget extends Controller {
    public function index($cid, $oid, $showCount = true){
        $Comment = new CommentModel();
        $commentList = $Comment->getCommentListByCidAndOid($cid, $oid);
        if ($showCount) {
            $this->assign('comment_count', $Comment->getCommentCount($cid, $oid));
        }
        $this->assign("comment_list", $commentList);
        $this->assign("cid", $cid);
        $this->display("Comment:index");
    }

}
