<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/Admin/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/layer/layer.js"></script>
    <script type="text/javascript">
        function sub() {
            var product_name = $("#product_name").val();
            var type_id = $("#type_id").val();
            if(type_id == 0){
                layer.tips('请选择所属类别', '#type_id');
            }else if(product_name == ''){
                layer.tips('产品名称不能为空', '#product_name');
            }

            if(type_id !=0 && product_name !=''){
                $.ajax({
                    //提交数据的类型 POST GET
                    type:"POST",
                    //提交的网址
                    url:"/Home/Product/editProduct",
                    //提交的数据
                    data:{product_name:product_name,type_id:type_id,id:<?php echo $_GET['id'];?>},
                    //返回数据的格式
                    datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
                    //在请求之前调用的函数
//            beforeSend:function(){$("#msg").html("logining");},
                    //成功返回之后调用的函数
                    success:function(data){
                        if(data.code == 200){
                            parent.location.reload();
                            parent.layer.close(index);
                        }else{
                            layer.alert(data.msg);
                        }
                    }   ,
                    //调用执行后调用的函数
//            complete: function(XMLHttpRequest, textStatus){
//                alert(XMLHttpRequest.responseText);
//                alert(textStatus);
//                //HideLoading();
//            },
                    //调用出错执行的函数
                    error: function(){
                        //请求出错处理
                        alert('系统繁忙，请稍后再试')
                    }
                });
            }

        }
    </script>
</head>

<body>



<div class="formbody">

    <div class="formtitle"><span>基本信息</span></div>

    <ul class="forminfo">
        <li><label>所属部门</label>
            <select name="type_id" id="type_id" class="dfinput">
                <option value="0">请选择类别</option>
                <?php if(is_array($product_list)): $i = 0; $__LIST__ = $product_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>" <?php if($info['type_id'] == $vo['id']): ?>selected='selected'<?php endif; ?>><?php echo ($vo['type_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </li>
        <li><label>产品名称</label><input name="product_name" type="text" class="dfinput" id="product_name" value="<?php echo ($info['product_name']); ?>"/></li>
        <li><label>&nbsp;</label><input name="" type="button" class="btn" value="确认保存" onclick="sub();"/></li>
    </ul>


</div>


</body>

</html>