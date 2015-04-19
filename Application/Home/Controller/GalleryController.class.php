<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-4-16
 * Time: 上午11:24
 */

namespace Home\Controller;



class GalleryController extends CommentController {

    public function index($cid = 0) {


        $list = array(
        );
        $data = array(
            'url' => U('Gallery/view'),
            'title' => "this test title",
            'image' => "/Uploads/Avatar/image/20150113/54b50954c9750.png"
        );
        for ($i = 0; $i < 10; $i++) {
            $list[] = $data;
        }
        $this->assign('gallery', $list);
        $this->display();

    }

    public function view($id = 0) {

        $list = array(
        );
        $data = array(
            'url' => U('Gallery/view'),
            'title' => "this test title",
            'image' => "/Uploads/Avatar/image/20150113/54b50954c9750.png"
        );
        for ($i = 0; $i < 10; $i++) {
            $list[] = $data;
        }
        $this->assign('gallery', $list);
        $this->assign("page_title", "gallery title");
        $this->display();
    }

} 