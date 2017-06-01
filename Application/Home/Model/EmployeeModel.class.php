<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/20
 * Time: 22:24
 */

namespace Home\Model;
use Think\Model;

class EmployeeModel extends Model
{
    /**
     * 添加员工
     * @param string $values 添加信息
     * @return false|int
     */
    public function addEmployee($values){
        $sql = "insert into `qp_employee` (`truename`,`department_id`) VALUES ($values)";
        return $this->execute($sql);
    }

    /**
     * 查询员工列表
     * @param string $where 查询条件
     * @param string $order 排序
     * @return mixed
     */
    public function employeeList($where,$order){
        $sql = "select d.department,e.* from `qp_employee` as e INNER JOIN `qp_department` as d on e.department_id = d.id $where $order";
        return $this->query($sql);
    }

    /**
     * 获取员工信息
     * @param string $where 查询条件
     * @return mixed
     */
    public function getEmployeeInfo($where){
        $sql = "select * from `qp_employee` where $where";
        $res = $this->query($sql);
        return $res[0];
    }

    /**
     * 更新员工信息
     * @param $where
     * @param $datas
     * @return false|int
     */
    public function updateEmployeeInfo($where,$datas){
        $sql = "update `qp_employee` set $datas $where";
        return $this->execute($sql);
    }

    /**
     * 删除员工信息
     * @param string $where 删除条件
     * @return false|int
     */
    public function delEmployeeInfo($where){
        $sql = "delete from `qp_employee` where $where";
        return $this->execute($sql);
    }

    /**
     * 获取指定部门下的员工列表
     * @param int $id 部门id
     * @return mixed
     */
    public function getDepartmentEmployeeList($id){
        $sql = "select * from `qp_employee` where `department_id` = $id";
        return $this->query($sql);
    }
}