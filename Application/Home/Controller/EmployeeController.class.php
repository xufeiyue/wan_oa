<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/20
 * Time: 22:10
 */

namespace Home\Controller;
use Think\Controller;

class EmployeeController extends BaseController
{
    private $model;
    public function _initialize()
    {
        parent::_initialize();
        $this->model = D('Employee');
    }

    /**
     * 员工列表
     */
    public function employeeList(){
        $where = '';
        $order = " order by e.id desc";
        $res = $this->model->employeeList($where,$order);
        $count = count($res);
        $Page       = new \Think\Page($count,15);
        $list=array_slice($res,$Page->firstRow,$Page->listRows);
        $show       = $Page->show();// 分页显示输出
        $departmentModel = D('Department');
        $departmentList = $departmentModel->getDepartmentList();
        $this->assign('department_list',$departmentList);
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }
    /**
     * 添加员工
     */
    public function addEmployee(){
        if(IS_POST){
            $department_id = I("post.department_id");
            $truename = I("post.truename");
            if($department_id == 0){
                $this->ajaxReturn(array('code'=>100,'msg'=>'请选择所属部门'));
            }else if($truename == ''){
                $this->ajaxReturn(array('code'=>300,'msg'=>'员工姓名不能为空'));
            }else{
                $values = "'$truename',$department_id";
                $res = $this->model->addEmployee($values);
                if( $res === false || $res == 0 ){
                    $this->ajaxReturn(array('code'=>400,'msg'=>'添加失败'));
                }else{
                    $this->ajaxReturn(array('code'=>200,'msg'=>'添加成功'));
                }
            }
        }else{
            /**
             * 获取部门列表
             */
            $departmentModel = D('Department');
            $departmentList = $departmentModel->getDepartmentList();
            $this->assign('departmentList',$departmentList);
            $this->display();
        }
    }

    /**
     * 修改员工信息
     */
    public function editEmployeeInfo(){
        if(IS_POST){
            $id = I("post.id");
            $department_id = I("post.department_id");
            $truename = I("post.truename");
            if($department_id == 0){
                $this->ajaxReturn(array('code'=>100,'msg'=>'请选择所属部门'));
            }else if($truename == ''){
                $this->ajaxReturn(array('code'=>300,'msg'=>'员工姓名不能为空'));
            }else{
                $datas = "   `department_id` = $department_id,`truename` = '$truename'";
                $where = " where id = $id";
                $res = $this->model->updateEmployeeInfo($where,$datas);
                if( $res === false || $res == 0 ){
                    $this->ajaxReturn(array('code'=>400,'msg'=>'修改失败'));
                }else{
                    $this->ajaxReturn(array('code'=>200,'msg'=>'修改成功'));
                }
            }
        }else{
            /**
             * 获取部门列表
             */
            $id = I("get.id");
            $departmentModel = D('Department');
            $departmentList = $departmentModel->getDepartmentList();
            $this->assign('departmentList',$departmentList);
            $where = " id = $id";
            $info = $this->model->getEmployeeInfo($where);
            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 删除员工信息
     */
    public function delEmployeeInfo(){
        $id = I("post.id");
        $where = " id = $id";
        $res = $this->model->delEmployeeInfo($where);
        if( $res === false || $res == 0 ){
            $this->ajaxReturn(array('code'=>400,'msg'=>'删除失败'));
        }else{
            $this->ajaxReturn(array('code'=>200,'msg'=>'删除成功'));
        }
    }
    /**
     * ajax获取员工列表
     */
    public function ajaxGetEmployeeList(){
        $department_id = I("post.id");
        $where = " where e.department_id = $department_id";
        $employee_list = $this->model->employeeList($where);
        if(empty($employee_list)){
            $this->ajaxReturn(array('code'=>100,'msg'=>'该部门下没有员工'));
        }else{
            $str = "";
            foreach($employee_list as $k=>$v){
                $str.="<option value='{$v['id']}'>{$v['truename']}</option>";
            }
            $this->ajaxReturn(array('code'=>200,'msg'=>'请求成功','datas'=>$str));
        }
    }
}