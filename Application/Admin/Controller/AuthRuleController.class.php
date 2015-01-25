<?php
/**
 * Created by PhpStorm.
 * User: apacal
 * Date: 15-1-23
 * Time: 下午10:34
 */

namespace Admin\Controller;




use Admin\Model\AuthRuleModel;

class AuthRuleController extends CommonController {
    public function setStatus() {
        header("HTTP/1.0 404 These data don't have status!");
    }

    public function treeJson() {

        $groupId = $_REQUEST['id'];
        if (empty($groupId) || !is_numeric($groupId)) {
            $groupId = 0;
        }
        $Model = new AuthRuleModel();
        $treeData = $Model->getRuleTreeData($groupId);
        $list = array(
            'text' => 'All',
            'state' => array(

                "opened" =>  true,
            ),
            'children' => $treeData
        );
        echo(json_encode($list));

    }

} 
