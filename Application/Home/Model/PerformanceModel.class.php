<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/21
 * Time: 13:04
 */

namespace Home\Model;
use Think\Model;

class PerformanceModel extends Model
{
    /**
     * 添加业绩
     * @param string $datas 添加数据
     * @return false|int
     */
    public function addPerformance($datas){
        $sql = "insert into `qp_performance` (`department_id`,`employee_id`,`performance`,`add_time`,`compact_no`,
`compact_time`,`company_name`,`company_address`,
`client_name`,`client_truename`,`phone`,`product_type_id`,`product_id`,`client_type`) VALUES 
($datas)";
        return $this->execute($sql);
    }

    /**
     * 获取业绩信息
     * @param string $where 搜索条件
     * @param string $order 排序
     * @return mixed
     */
    public function getPerformanceList($where,$order){
        $sql = "select p.*,e.truename,d.department,pc.product_name,t.type_name from `qp_performance` as p 
LEFT JOIN `qp_employee` as e on p.employee_id = e.id LEFT JOIN 
`qp_department` as d on p.department_id = d.id LEFT JOIN `qp_product_type` as t on p.product_type_id = t.id 
LEFT JOIN `qp_product` as pc on p.product_id = pc.id where 1 $where order by p.id desc";
        return $this->query($sql);
    }

    /**
     * 获取业绩信息
     * @param $where
     * @return mixed
     */
    public function getPerformanceInfo($where){
        $sql = "select p.* from `qp_performance` as p $where";
        $res = $this->query($sql);
        return $res[0];
    }

    /**
     * 更新业绩信息
     * @param string $where 更新条件
     * @param string $datas 更新信息
     * @return false|int
     */
    public function updatePerformanceInfo($where,$datas){
        $sql = "update `qp_performance` set $datas $where";
        return $this->execute($sql);
    }

    /**
     * 删除业绩
     * @param string $where 删除条件
     * @return false|int
     */
    public function delPerformance($where){
        $sql = "delete from `qp_performance` where $where";
        return $this->execute($sql);
    }

    /**
     * 获取部门业绩列表
     * @return mixed
     */
    public function getDepartmentPerformance($where=1,$where1=1){
        $sql = "select IFNULL(a.performance,0) as performance,d.department,d.id as department_id from (select sum(performance) as performance,department_id 
from `qp_performance` where $where group by department_id ) as a RIGHT JOIN `qp_department` as d on a.department_id = d.id where $where1";
        return $this->query($sql);
    }
}