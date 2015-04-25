<?php
namespace Home\Model;
use Think\Model;
class CommonModel extends Model {



    public function getListByWhere($where) {
        return $this->where($where)->select();
    }

}
?>

