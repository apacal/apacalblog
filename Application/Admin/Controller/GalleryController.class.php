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
        $this->assign("is_gallery", true);
    }


    public function editItems($gallery_id = 0) {

        $list = array(
        );
        $data = array(
            'url' => U('Gallery/view'),
            'title' => "this test title",
            'image' => "/Uploads/Avatar/image/20150113/54b50954c9750.png"
        );
        for ($i = 1; $i < 10; $i++) {
            $data['id'] = $i;
            $list[] = $data;
        }
        $this->assign('gallery', $list);
        $this->assign("gallery_id", 10);
        $this->display();
    }

    public function saveGalleryItem($gallery_id, $image, $title) {
        $ret = array(
            'code' => 0,
        );
        if (empty($gallery_id) || empty($image) || empty($title)) {
            $ret['code'] = 1;
            $ret['data'] = 'less some argv!';
        } else {
            $GalleryItem = new GalleryItemsModel();
            $data = $GalleryItem->create($_REQUEST);
            if ($GalleryItem->add($data)) {

            }

        }

        $this->jsonReturn($ret);

    }

    public function delGalleryItem() {

    }

    protected function setExtManageData(&$val) {
        $val['editItemsTab'] = 'GalleryItems';
        $val['editItemsUrl'] = U('Gallery/editItems', array('gallery_id' => $val['id']));
    }
} 