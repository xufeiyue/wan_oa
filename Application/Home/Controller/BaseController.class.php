<?php
/**
 * Created by PhpStorm.
 * User: 徐飞越
 * Date: 2017/5/11
 * Time: 13:06
 */

namespace Home\Controller;
use Think\Controller;

class BaseController extends Controller
{
    public function _initialize(){
//        $admin_id = session('member_id');
//        if($admin_id>0){
//            $this->redirect('Wap/Index/mainView');
//        }else{
//            $this->redirect('Wap/Index/loginView');
//        }
    }
}