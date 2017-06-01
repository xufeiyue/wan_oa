<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/13
 * Time: 14:11
 */

namespace Home\Model;
use Think\Model;

class DepartmentModel extends Model
{
    /**
     * 部门列表
     * @param string $where 查询条件
     * @param string $orderby 排序
     * @return mixed
     */
    public function getDepartmentList($where,$orderby){
        $sql = "select `id`,`department` from `qp_department` $where $orderby";
        $model = M();
        $res = $model->query($sql);
        return $res;
    }
    /**
     * 添加部门
     * @param string $department 插入数据
     * @return false|int
     */
    public function addDepartment($department){
        $sql = "insert into `qp_department` (`department`) VALUES ('$department')";
        $model = M();
        $id = $model->execute($sql);
        return $id;
    }
    /**
     * 获取部门信息
     * @param string $where 查询条件
     * @return mixed
     */
    public function getDepartmentInfo($where){
        $sql = "select * from `qp_department` where $where";
        $model = M();
        $res = $model->query($sql);
        return $res[0];
    }

    /**
     * 更新部门信息
     * @param string $where 更新条件
     * @param string $data 更新字段和值
     * @return false|int
     */
    public function updateDepartmentInfo($where,$data){
        $sql = "update `qp_department` set $data where $where";
        return $this->execute($sql);
    }

    /**
     * 删除部门数据
     * @param string $where 删除条件
     * @return false|int
     */
    public function deleteDepartmentInfo($where){
        if($where == ''){
            return false;
        }else{
            $sql = "delete from `qp_department` where $where";
            return $this->execute($sql);
        }

    }
}