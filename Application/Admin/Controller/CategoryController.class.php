<?php
/**
 * 栏目控制器
 **/
namespace Admin\Controller;
use Admin\Model\UserModel;
use Think\Controller;
class CategoryController extends CommonController {
    protected $unManageField = array("updatetime","image","keywords","description");
    protected $controllerExtName = "BlogMenu";


}
