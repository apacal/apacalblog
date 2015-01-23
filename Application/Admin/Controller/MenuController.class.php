<?php
namespace Admin\Controller;
use Admin\Model\MenuModel;
use Think\Controller;
class MenuController extends CommonController {
    protected $controllerExtName = 'CMSMenu';



    public function treeJson() {
        $Model = new MenuModel();
        $treeData = $Model->getMenuTreeData(0);
        $root = array(
            'text' => 'Root',
            'id' => 0,
            'a_attr' => array(
                'onclick' => "addValueToInput('0');",
            ),
        );
        array_unshift($treeData, $root);
        echo(json_encode($treeData));

    }



}
