<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/31
 * Time: 17:57
 */

namespace Home\Model;
use Think\Model;

class ProductTypeModel extends Model
{
    /**
     * 获取产品类型列表
     * @param string $where 查询条件
     * @param string $order 排序
     * @return mixed
     */
    public function productTypeList($where,$order){
        $sql = "select * from `qp_product_type` $where $order";
        return $this->query($sql);
    }

    /**
     * 添加产品类型
     * @param string $values 数据
     * @return false|int
     */
    public function addProductType($values){
        $sql = "insert into `qp_product_type` (`type_name`) VALUES $values";
        return $this->execute($sql);
    }

    /**
     * 修改产品类型信息
     * @param string $data 更新内容
     * @param int $id 更新条件
     * @return false|int
     */
    public function editProductType($data,$id){
        $sql = "update `qp_product_type` set `type_name` = '$data' where `id` = $id";
        return $this->execute($sql);
    }

    /**
     * 获取产品类型信息
     * @param string $where 查询条件
     * @return mixed
     */
    public function getProductTypeInfo($where){
        $sql = "select * from `qp_product_type` {$where}";
        $res = $this->query($sql);
        return $res[0];
    }

    /**
     * 删除产品类别
     * @param int $id 删除条件
     * @return false|int
     */
    public function delProductType($id){
        $sql = "update `qp_product_type` set `status` = '2' where id = $id";
        $res = $this->execute($sql);
        return $res;
    }

    /**
     * 获取产品列表
     * @param string $where 查询条件
     * @param string $order 排序
     * @return mixed
     */
    public function getProductList($where,$order){
        $sql = "select p.*,t.type_name from `qp_product` as p LEFT JOIN `qp_product_type` as t on p.type_id = t.id $where $order";
        return $this->query($sql);
    }

    /**
     * 添加产品
     * @param string $data 添加数据
     * @return false|int
     */
    public function addProduct($data){
        $sql = "insert into `qp_product` (`type_id`,`product_name`) VALUES ($data)";
        return $this->execute($sql);
    }

    /**
     * 获取产品详细信息
     * @param int $id 产品id
     * @return mixed
     */
    public function getProductInfo($id){
        $sql = "select p.*,t.type_name from `qp_product` as p LEFT JOIN `qp_product_type` as t on p.type_id = t.id";
        $info = $this->query($sql);
        return $info[0];
    }

    /**
     * 更新产品详细信息
     * @param int $id 产品id
     * @param string $data 更新数据
     * @return false|int
     */
    public function editProductInfo($id,$data){
        $sql  = "update `qp_product` set $data where id = $id";
        return $this->execute($sql);
    }

    /**
     * 删除产品
     * @param int $id 产品id
     * @return false|int
     */
    public function delProduct($id){
        $sql = "update `qp_product` set `status` = '2' where id = $id";
        return $this->execute($sql);
    }

    /**
     * ajax根据产品类型获取产品列表
     * @param int $type_id 产品类别id
     * @return mixed
     */
    public function ajaxGetProductList($type_id){
        $sql = "select * from `qp_product` where `type_id` = $type_id and `status` = '1'";
        return $this->query($sql);
    }

    /**
     * 获取指定产品类型下的所有产品
     * @param int $id 产品类型id
     * @return mixed
     */
    public function getTheProductList($id){
        $sql = "select * from `qp_product` where type_id = $id and `status` = '1'";
        return $this->query($sql);
    }
}