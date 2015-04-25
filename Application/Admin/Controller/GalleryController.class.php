<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-4-18
 * Time: 上午8:41
 */

namespace Admin\Controller;



use Admin\Model\GalleryItemsModel;

class GalleryController extends CommonController {

    public function _initialize() {
        parent::_initialize();
        $this->assign("is_gallery", true);
    }


    public function editItems($gallery_id = 0) {
        $Model = new GalleryItemsModel();

        if (empty($gallery_id) || !is_numeric($gallery_id)) {
            $this->sendNotAuth("less argv!");
        }

        $where = array(
            'gallery_id' => $gallery_id,
        );
        $list = $Model->getList($where, "sort DESC");

        $this->assign('gallery', $list);
        $this->assign("gallery_id", $gallery_id);
        $this->display();
    }


    protected function setExtManageData(&$val) {
        $val['editItemsTab'] = 'GalleryItems';
        $val['editItemsUrl'] = U('Gallery/editItems', array('gallery_id' => $val['id']));
    }
} 