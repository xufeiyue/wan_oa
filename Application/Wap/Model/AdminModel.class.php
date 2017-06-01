<?php

/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/12
 * Time: 17:11
 */
namespace Home\Model;
use Think\Model;
class AdminModel extends Model
{
    private $model;
    public function __construct()
    {
        $this->model = M();
    }

    /**
     * 根据条件 获取管理员表数据信息
     * @param $where
     * @return mixed
     */
    public function getAdminInfo($where){
        $sql = "select * from `qp_admin` ".$where;
        $res = $this->model->query($sql);
        return $res[0];
    }

    /**
     * 根据条件 获取管理员表数据数量
     * @param $where
     * @return mixed
     */
    public function getAdminCount($where){
        $sql = "select count(*) as c from `qp_admin` $where";
        $res = $this->model->query($sql);
        return $res[0]['c'];
    }
}