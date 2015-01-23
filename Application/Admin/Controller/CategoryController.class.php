<?php
/**
 * 栏目控制器
 **/
namespace Admin\Controller;
use Admin\Model\CategoryModel;
use Think\Controller;
class CategoryController extends CommonController {
    protected $unManageField = array("updatetime","image","keywords","description");
    protected $controllerExtName = "BlogMenu";


    public function treeJson() {
        $Model = new CategoryModel();
        $treeData = $Model->getCateTreeData(0);
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
