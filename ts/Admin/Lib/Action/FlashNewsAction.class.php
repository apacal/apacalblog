<?php
class FlashNewsAction extends ArticleAction {
    /* flashnews广告控制器
     * @author Apacal
     * time 2013.05.14
     *
     */

    /* 上传图片
     * @author Apacal
     * time 2013.05.14
     *
     */
    public function upload() {
        $this->checkStatus();
        import("ORG.Net.UploadFile");
        $upload=new UploadFile();
        $upload->maxSize=3145728;
        $upload->allowExts=array('jpg','gif','png','jpeg');
        $upload->saveRule=time;
        $upload->savePath='./uploadfile/flashNews/';
        if(!$upload->upload()){
            $this->error($upload->getErrorMsg());
        }else{
            $info=$upload->getUploadFileInfo();
        }
        $FlashNews=D("FlashNews");
        $data=$FlashNews->create();
        $data['img_url']='__ROOT__/uploadfile/flashNews/'.$info[0]["savename"];
        $data['open']=isset($_POST['open']) ? 1 : 0;
        if($FlashNews->add($data)){
            $this->success("添加成功");
        }else{
            $this->error("添加失败");
        }
        
    }
    /* 广告修改后保存
     * @author Apacal
     * time 2013.04.15
     *
     */
    public function save() {
        $this->checkStatus();
        import("ORG.Net.UploadFile");
        $upload=new UploadFile();
        $upload->maxSize=3145728;
        $upload->allowExts=array('jpg','gif','png','jpeg');
        $upload->saveRule=time;
        $upload->savePath='./uploadfile/flashNews/';
        $FlashNews=D("FlashNews");
        $id=$_POST['id'];
        $data=$FlashNews->create();
        if($upload->upload()){
            $info=$upload->getUploadFileInfo();
            $data['img_url']='__ROOT__/uploadfile/flashNews/'.$info[0]["savename"];
        }
        $data['open']=isset($_POST['open']) ? 1 : 0;
        if($FlashNews->where("id=$id")->save($data)){
            $this->success("修改成功","__URL__/manager");
        }else{
            $this->error("修改失败","__URL__/manager");
        }
        
    }
    
}
