<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-4-16
 * Time: 上午11:24
 */

namespace Home\Controller;



use Home\Model\CategoryModel;
use Home\Model\GalleryItemsModel;
use Home\Model\GalleryModel;

class GalleryController extends CommentController {

    public function index($cid = 0) {

        if ($cid == 0) {
            $where = array(
                'status' => 1,
            );
        } else {
            $where = array(
                'status' => 1,
                'cid' => array('in', (new CategoryModel())->getThisCategoryChildren($cid))
            );
        }
        $list = (new GalleryModel())->getListByWhere($where);

        $this->assign('gallery', $list);
        $this->display();

    }

    public function view($id = 0, $title = '') {

        $where = array(
            'status' => 1,
            'gallery_id' => $id,
        );
        $list = (new GalleryItemsModel())->getListByWhere($where);

        $this->assign('gallery', $list);
        $this->assign("page_title", $title);
        $this->display();
    }

} 