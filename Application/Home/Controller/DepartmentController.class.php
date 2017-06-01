<?php
/**
 * 部门类
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/13
 * Time: 12:51
 */

namespace Home\Controller;
use Think\Controller;

class DepartmentController extends BaseController
{
    /**
     * 部门列表
     */
    public function DepartmentList(){
        $model = D('Department');

        $res = $model->getDepartmentList();

        $count = count($res);

        $Page       = new \Think\Page($count,15);

        $list=array_slice($res,$Page->firstRow,$Page->listRows);

        $show       = $Page->show();// 分页显示输出

        $this->assign('list',$list);

        $this->assign('page',$show);// 赋值分页输出

        $this->display();
    }

    /**
     * 添加部门
     */
    public function addDepartment(){
        if(IS_POST){
            $department = I('post.department');
            if($department == ''){
                $this->ajaxReturn(array('code'=>100,'msg'=>'部门名称不能为空'));
            }
            $model = D('Home/Department');
            $res = $model->addDepartment($department);
            if($res>0){
                $this->ajaxReturn(array('code'=>200,'msg'=>'添加成功'));
            }else{
                $this->ajaxReturn(array('code'=>300,'msg'=>'系统繁忙，请稍后重试！'));
            }
        }else{
            $this->display();
        }
    }

    /**
     * 修改部门
     */
    public function editDepartment(){
        $department_id = I('get.id');
        $model = D('Home/Department');
        if(IS_POST){
            $department = I('post.department');
            $data = " `department` = '$department'";
            $where = " id = ".I('post.id');
            if($department == ''){
                $this->ajaxReturn(array('code'=>100,'msg'=>'部门名称不能为空'));
            }else{
                $res = $model->updateDepartmentInfo($where,$data);
                if($res=== false){
                    $this->ajaxReturn(array('code'=>300,'msg'=>'更新失败'));
                }else if($res>0){
                    $this->ajaxReturn(array('code'=>200,'msg'=>'更新成功'));
                }else{
                    $this->ajaxReturn(array('code'=>400,'msg'=>'未发生改变'));
                }
            }
        }else{
            $where = " id=$department_id";
            $info = $model->getDepartmentInfo($where);
            $this->assign('info',$info);
            $this->display();
        }
    }

    /**
     * 删除部门
     */
    public function deleteDepartment(){
        $id = I("post.id");
        $model = D('Home/Department');
        $where = " id = $id";
        $res = $model->deleteDepartmentInfo($where);
        if($res===false){
            $this->ajaxReturn(array('code'=>100,'msg'=>'删除失败'));
        }elseif ($res>0) {
            $this->ajaxReturn(array('code' => 200, 'msg' => '删除成功'));
        }else{
            $this->ajaxReturn(array('code'=>300,'msg'=>'删除失败'));
        }
    }

}