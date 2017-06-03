<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/21
 * Time: 9:09
 */

namespace Home\Controller;
use Think\Controller;

class performanceController extends BaseController
{
    private $performanceModel;
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->performanceModel = D('Performance');
    }

    /**
     * 业绩管理
     */
    public function performanceList(){
        $department_id = I("post.department_id");
        $employee_id = I("post.employee_id");
        $compact_no = I("post.compact_no");
        $client_name = I("post.client_name");
        $client_truename = I("post.client_truename");
        $product_type_id = I("post.product_type_id");
        $product_id = I("post.product_id");
        $begin_time = I("post.begin_time");
        $end_time = I("post.end_time");
        $where = "";
        if($employee_id !=0){
            $where.=" and p.employee_id = $employee_id";
        }
        if($compact_no != ''){
            $where.= " and p.compact_no = '$compact_no'";
        }
        if($client_name != ''){
            $where.= " and p.client_name like '%$client_name%'";
        }
        if($client_truename != ''){
            $where.= " and p.client_truename like '%$client_truename%'";
        }
        if($product_type_id != 0){
            $where.= " and p.product_type_id = '$product_type_id'";
        }
        if($product_id != 0){
            $where.= " and p.product_id = '$product_id'";
        }
        if($begin_time!="" && $end_time!=""){
            $where.= " and p.compact_time >'$begin_time' and p.compact_time<'$end_time'";
        }
        $res = $this->performanceModel->getPerformanceList($where);
        $count = count($res);
        $Page       = new \Think\Page($count,15);
        $list=array_slice($res,$Page->firstRow,$Page->listRows);
        $show       = $Page->show();// 分页显示输出
        $departmentModel = D('Department');
        $departmentList = $departmentModel->getDepartmentList();
        $this->assign('department_list',$departmentList);
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
        $productModel = D('ProductType');
        $product_type_list = $productModel->productTypeList(" where `status`='1'");
        $this->assign('product_type_list',$product_type_list);
        $this->display();
    }
    /**
     * 添加业绩
     */
    public function addPerformance(){
        if(IS_POST){
            $department_id = I("post.department_id");
            $employee_id = I("post.employee_id");
            $performance = I("post.performance");
            $add_time = date("Y-m-d H:i:s",time());
            $compact_no = I("post.compact_no");
            $compact_time = I("post.compact_time");
            $client_name = I("post.client_name");
            $client_truename = I("post.client_truename");
            $product_type_id = I("post.product_type_id");
            $product_id = I("post.product_id");
            $client_type = I("post.client_type");
            $company_name = I("post.company_name");
            $company_address = I("post.company_address");
            $phone = I("post.phone");
            if($department_id == 0){
                $this->ajaxReturn(array('code'=>100,'msg'=>'请选择部门'));
            }
            if($employee_id == 0){
                $this->ajaxReturn(array('code'=>300,'msg'=>'请选择员工'));
            }
            if($performance == ''){
                $this->ajaxReturn(array('code'=>400,'msg'=>'请填写业绩'));
            }elseif (!is_numeric($performance)){
                $this->ajaxReturn(array('code'=>500,'msg'=>'业绩必须为数字'));
            }elseif ($performance<0){
                $this->ajaxReturn(array('code'=>600,'msg'=>'业绩不能为负数'));
            }

            if($compact_no == ''){
                $this->ajaxReturn(array('code'=>800,'msg'=>'请填写合同编号'));
            }
            if($compact_time == ''){
                $this->ajaxReturn(array('code'=>900,'msg'=>'请填写合同日期'));
            }
            if($client_name == ''){
                $this->ajaxReturn(array('code'=>1000,'msg'=>'请填写客户名称'));
            }
            if($client_truename == ''){
                $this->ajaxReturn(array('code'=>1100,'msg'=>'请填写客户联系人'));
            }
            if($product_type_id == ''){
                $this->ajaxReturn(array('code'=>1200,'msg'=>'请填写产品类别'));
            }
            if($product_id == ''){
                $this->ajaxReturn(array('code'=>1300,'msg'=>'请填写产品'));
            }
            if($client_type == ''){
                $this->ajaxReturn(array('code'=>1400,'msg'=>'请填写服务性质'));
            }
            if($company_name == ''){
                $this->ajaxReturn(array('code'=>1500,'msg'=>'请填写企业名称'));
            }
            if($company_address == ''){
                $this->ajaxReturn(array('code'=>1600,'msg'=>'请填写企业地址'));
            }
            if($phone == ''){
                $this->ajaxReturn(array('code'=>1700,'msg'=>'联系方式'));
            }
            $datas = "$department_id,$employee_id,$performance,'$add_time','$compact_no','$compact_time','$company_name',
            '$company_address','$client_name','$client_truename','$phone',$product_type_id,$product_id,'$client_type'";

            $res = $this->performanceModel->addPerformance($datas);
            if($res === false || $res == 0){
                $this->ajaxReturn(array('code'=>800,'msg'=>'添加失败'));
            }else{
                $this->ajaxReturn(array('code'=>200,'msg'=>'添加成功'));
            }

        }else{
            /**
             * 获取部门列表
             */
            $departmentModel = D('Department');
            $departmentList= $departmentModel->getDepartmentList();
            $this->assign('department_list',$departmentList);
            /**
             * 获取产品类型列表
             */
            $productModel = D('ProductType');
            $where = " where `status` = '1'";
            $product_type_list = $productModel->productTypeList($where);
            $this->assign('product_list',$product_type_list);
            $this->display();
        }
    }
    /**
     *  修改业绩
     */
    public function editPerformanceInfo(){
        if(IS_POST){
            $department_id = I("post.department_id");
            $employee_id = I("post.employee_id");
            $performance = I("post.performance");
            $add_time = date("Y-m-d H:i:s",time());
            $compact_no = I("post.compact_no");
            $compact_time = I("post.compact_time");
            $client_name = I("post.client_name");
            $client_truename = I("post.client_truename");
            $product_type_id = I("post.product_type_id");
            $product_id = I("post.product_id");
            $client_type = I("post.client_type");
            $id = I("post.id");
            $company_name = I("post.company_name");
            $company_address = I("post.company_address");
            $phone = I("post.phone");
            if($department_id == 0){
                $this->ajaxReturn(array('code'=>100,'msg'=>'请选择部门'));
            }
            if($employee_id == 0){
                $this->ajaxReturn(array('code'=>300,'msg'=>'请选择员工'));
            }
            if($performance == ''){
                $this->ajaxReturn(array('code'=>400,'msg'=>'请填写业绩'));
            }elseif (!is_numeric($performance)){
                $this->ajaxReturn(array('code'=>500,'msg'=>'业绩必须为数字'));
            }elseif ($performance<0){
                $this->ajaxReturn(array('code'=>600,'msg'=>'业绩不能为负数'));
            }

            if($compact_no == ''){
                $this->ajaxReturn(array('code'=>800,'msg'=>'请填写合同编号'));
            }
            if($compact_time == ''){
                $this->ajaxReturn(array('code'=>900,'msg'=>'请填写合同日期'));
            }
            if($client_name == ''){
                $this->ajaxReturn(array('code'=>1000,'msg'=>'请填写客户名称'));
            }
            if($client_truename == ''){
                $this->ajaxReturn(array('code'=>1100,'msg'=>'请填写客户联系人'));
            }
            if($product_type_id == ''){
                $this->ajaxReturn(array('code'=>1200,'msg'=>'请填写产品类别'));
            }
            if($product_id == ''){
                $this->ajaxReturn(array('code'=>1300,'msg'=>'请填写产品'));
            }
            if($client_type == ''){
                $this->ajaxReturn(array('code'=>1400,'msg'=>'请填写服务性质'));
            }
            if($company_name == ''){
                $this->ajaxReturn(array('code'=>1500,'msg'=>'请填写企业名称'));
            }
            if($company_address == ''){
                $this->ajaxReturn(array('code'=>1600,'msg'=>'请填写企业地址'));
            }
            if($phone == ''){
                $this->ajaxReturn(array('code'=>1700,'msg'=>'联系方式'));
            }
            $datas = " `department_id` = $department_id,`employee_id` = $employee_id,`performance`=$performance,`add_time`='$add_time',
            `compact_no` = '$compact_no',`compact_time` = '$compact_time',`company_name` = '$company_name',
            `company_address` = '$company_address',`client_name`='$client_name',`client_truename`='$client_truename',`phone`='$phone',
            `product_type_id` = $product_type_id,`product_id` = '$product_id',`client_type` = '$client_type'";
            $where = " where id = $id";
            $res = $this->performanceModel->updatePerformanceInfo($where,$datas);
            if($res === false){
                $this->ajaxReturn(array('code'=>800,'msg'=>'修改失败'));
            }else if($res == 0){
                $this->ajaxReturn(array('code'=>800,'msg'=>'未改变内容'));
            }else{
                $this->ajaxReturn(array('code'=>200,'msg'=>'修改成功'));
            }
        }else{
            $id = I("get.id");
            $where =" where p.id = $id";
            $info = $this->performanceModel->getPerformanceInfo($where);
            $this->assign('info',$info);
            /**
             * 获取部门下所有员工列表
             */
            $emp_model = D("Employee");
            $employee_list = $emp_model->getDepartmentEmployeeList($info['department_id']);
            $this->assign('employee_list',$employee_list);
            /**
             * 获取指定产品类型下的所有产品
             */
            $product_model = D('ProductType');
            $product_list = $product_model->getTheProductList($info['product_type_id']);
            $this->assign('product_list',$product_list);
            /**
             * 获取部门列表
             */
            $departmentModel = D('Department');
            $departmentList= $departmentModel->getDepartmentList();
            $this->assign('department_list',$departmentList);
            /**
             * 获取产品类型列表
             */
            $productModel = D('ProductType');
            $where1 = " where `status` = '1'";
            $product_type_list = $productModel->productTypeList($where1);
            $this->assign('product_type_list',$product_type_list);
            $this->display();
        }
    }
    /**
     * 删除业绩
     */
    public function delPerformance(){
        $id = I("post.id");
        $where = " id = $id";
        $res = $this->performanceModel->delPerformance($where);
        if($res === false || $res==0){
            $this->ajaxReturn(array('code'=>100,'msg'=>'删除失败'));
        }else{
            $this->ajaxReturn(array('code'=>200,'msg'=>'删除成功'));
        }
    }

    /**
     * 部门业绩管理
     */
    public function departmentPerformance(){
        $department_id = I("post.department_id");
        $product_type_id = I("post.product_type_id");
        $product_id = I("post.product_id");
        $begin_time = I("post.begin_time");
        $end_time = I("post.end_time");
        $where1 = 1;
        $where = 1;

        if ($department_id !=0){
            $where1.= " and `department_id` = $department_id";
        }

        if($product_type_id !=0 && $product_id!=0){
            $where.= " and `product_type_id` = $product_type_id and `product_id` = $product_id";
        }
        if($product_type_id !=0 && $product_id == 0){
            $where.= " and `product_type_id` = $product_type_id";
        }
        if($begin_time !='' && $end_time !=''){
            $where.= " and `compact_time`>'$begin_time' and `compact_time` < '$end_time'";
        }

        $res = $this->performanceModel->getDepartmentPerformance($where,$where1);
        $count = count($res);
        $Page       = new \Think\Page($count,15);
        $list=array_slice($res,$Page->firstRow,$Page->listRows);
        $show       = $Page->show();// 分页显示输出
        $departmentModel = D('Department');
        $departmentList = $departmentModel->getDepartmentList();
        $productModel = D('ProductType');
        $product_type_list = $productModel->productTypeList(" where `status`='1'");
        $this->assign('product_type_list',$product_type_list);
        $this->assign('department_list',$departmentList);
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
}