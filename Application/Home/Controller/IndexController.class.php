<?php
namespace Home\Controller;
use Think\Controller;
class IndexController extends BaseController{
    public function _initialize(){
        parent::_initialize();
    }
    public function index(){
        $admin_id = session('admin_id');
        if($admin_id>0){
            $this->redirect('Index/mainView');
        }else{
            $this->redirect('Index/loginView');
        }
    }

    /**
     * 显示登录页面
     */
    public function loginView(){
        $this->display();
    }

    /**
     * 登录
     */
    public function login(){
        $admin_name = I('post.admin_name');
        $admin_pwd  = I('post.admin_pwd');

        /**
         * 验证用户名是否为空
         */
        if($admin_name == ''){
            $this->ajaxReturn(array('code'=>100));
        }
        /**
         * 验证密码是否为空
         */
        if($admin_pwd == ''){
            $this->ajaxReturn(array('code'=>300,'msg'=>'密码不能为空'));
        }

        $admin_pwd = md5($admin_pwd);

        $where = "where `admin_name`  = '$admin_name' and `admin_pwd` = '$admin_pwd'";

        $model = D('Home/Admin');

        $res = $model->getAdminCount($where);

        if($res){
            session('admin_id',$res['id']);
            $this->ajaxReturn(array('code'=>200,'msg'=>'登录成功'));

        }else{
            $this->ajaxReturn(array('code'=>400,'msg'=>'账户密码错误'));
        }
    }

    public function mainView(){

        $this->display();
    }

    public function topView(){
        $this->display();
    }

    public function leftView(){
        $this->display();
    }

    public function rightView(){
        $this->display();
    }
}