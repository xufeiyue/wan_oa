<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 2017/5/31
 * Time: 17:53
 */

namespace Home\Controller;
use Think\Controller;

class ProductController extends BaseController
{
    private $product;
    public function _initialize()
    {
        parent::_initialize(); // TODO: Change the autogenerated stub
        $this->product = D('Home/ProductType');
    }

    public function addProductType(){
        if(IS_POST){
            $type_name = I("post.type_name");
            if($type_name == ''){
                $this->ajaxReturn(array('code'=>100,'msg'=>'请填写产品类型名称'));exit;
            }
            $values = " ('$type_name')";
            $res = $this->product->addProductType($values);
            if($res === false){
                $this->ajaxReturn(array('code'=>300,'msg'=>'系统繁忙，请稍后重试！'));
            }else{
                $this->ajaxReturn(array('code'=>200,'msg'=>'添加成功！'));
            }
        }else{
            $this->display();
        }
    }

    public function productTypeList(){
        $where = " where `status` = '1'";
        $order = " order by id desc";
        $res = $this->product->productTypeList($where,$order);
        $count = count($res);
        $Page       = new \Think\Page($count,15);
        $list=array_slice($res,$Page->firstRow,$Page->listRows);
        $show       = $Page->show();// 分页显示输出
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }

    public function editProductType(){
        if(IS_POST){
            $type_name = I("post.type_name");
            if($type_name == ''){
                $this->ajaxReturn(array('code'=>100,'msg'=>'请填写产品类型名称'));exit;
            }
            $id = I("post.id");
            $data = "$type_name";
            $res = $this->product->editProductType($data,$id);
            if($res === false){
                $this->ajaxReturn(array('code'=>300,'msg'=>'系统繁忙，请稍后再试！'));exit;
            }else if($res ==1){
                $this->ajaxReturn(array('code'=>200,'msg'=>'修改成功'));exit;
            }else if($res ==0){
                $this->ajaxReturn(array('code'=>400,'msg'=>'未修改内容'));exit;
            }
        }else{
            $id = I("get.id");
            $where = " where id= $id";
            $info = $this->product->getProductTypeInfo($where);
            $this->assign('info',$info);
            $this->display();
        }
    }

    public function delProductType(){
        $id = I("post.id");
        $res = $this->product->delProductType($id);
        if($res === false){
            $this->ajaxReturn(array('code'=>300,'msg'=>'系统繁忙，请稍后再试！'));exit;
        }elseif ($res == 0){
            $this->ajaxReturn(array('code'=>400,'msg'=>'删除失败！'));exit;
        }else if($res == 1){
            $this->ajaxReturn(array('code'=>200,'msg'=>'删除成功！'));exit;
        }
    }

    public function productList(){
        $where = " where p.`status` = '1'";
        $order = " order by p.id desc";
        $res = $this->product->getProductList($where,$order);
        $count = count($res);
        $Page       = new \Think\Page($count,15);
        $list=array_slice($res,$Page->firstRow,$Page->listRows);
        $show       = $Page->show();// 分页显示输出
        $this->assign('list',$list);
        $this->assign('page',$show);// 赋值分页输出
        $this->display();
    }

    public function addProduct(){
        if(IS_POST){
            $type_id = I("post.type_id");
            $product_name = I("post.product_name");
            if($type_id == 0){
                $this->ajaxReturn(array('code'=>300,'msg'=>'请选择所属类别！'));exit;
            }
            if($product_name == ''){
                $this->ajaxReturn(array('code'=>400,'msg'=>'请填写产品名称！'));exit;
            }
            $data = "$type_id,'$product_name'";
            $res = $this->product->addProduct($data);
            if($res === false){
                $this->ajaxReturn(array('code'=>500,'msg'=>'系统繁忙，请稍后再试！'));exit;
            }elseif ($res ==0){
                $this->ajaxReturn(array('code'=>600,'msg'=>'添加失败！'));exit;
            }elseif ($res == 1){
                $this->ajaxReturn(array('code'=>200,'msg'=>'添加成功！'));exit;
            }

        }else{
            $where = " where `status` = '1'";
            $product_type_list = $this->product->productTypeList($where);
            $this->assign('product_list',$product_type_list);
            $this->display();
        }
    }

    public function editProduct(){
        if(IS_POST){
            $id = I("post.id");
            $type_id = I("post.type_id");
            $product_name = I("post.product_name");
            if($type_id == 0){
                $this->ajaxReturn(array('code'=>300,'msg'=>'请选择所属类别！'));exit;
            }
            if($product_name == ''){
                $this->ajaxReturn(array('code'=>400,'msg'=>'请填写产品名称！'));exit;
            }
            $data = " `type_id` = $type_id,`product_name` = '$product_name'";
            $res= $this->product->editProductInfo($id,$data);
            if($res === false){
                $this->ajaxReturn(array('code'=>500,'msg'=>'系统繁忙，请稍后重试！'));exit;
            }elseif ($res == 1){
                $this->ajaxReturn(array('code'=>200,'msg'=>'修改成功！'));exit;
            }elseif ($res ==0){
                $this->ajaxReturn(array('code'=>600,'msg'=>'未修改内容！'));exit;
            }
        }else{
            $id = I("get.id");
            $info = $this->product->getProductInfo($id);
            $this->assign('info',$info);
            $where = " where `status` = '1'";
            $product_type_list = $this->product->productTypeList($where);
            $this->assign('product_list',$product_type_list);
            $this->display();
        }
    }

    public function delProduct(){
        $id = I("post.id");
        $res = $this->product->delProduct($id);
        if($res === false){
            $this->ajaxReturn(array('code'=>500,'msg'=>'系统繁忙，请稍后重试！'));exit;
        }elseif ($res == 1){
            $this->ajaxReturn(array('code'=>200,'msg'=>'删除成功！'));exit;
        }elseif ($res ==0){
            $this->ajaxReturn(array('code'=>600,'msg'=>'删除失败！'));exit;
        }
    }

    public function ajaxGetProductList(){
        $type_id = I("post.id");
        $product_list = $this->product->ajaxGetProductList($type_id);
        if(empty($product_list)){
            $this->ajaxReturn(array('code'=>100,'msg'=>'该分类下没有产品'));
        }else{
            $str = "";
            foreach($product_list as $k=>$v){
                $str.="<option value='{$v['id']}'>{$v['product_name']}</option>";
            }
            $this->ajaxReturn(array('code'=>200,'msg'=>'请求成功','datas'=>$str));
        }
    }
}