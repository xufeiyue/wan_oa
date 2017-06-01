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
            var department = $("#department_id").val();
            if(department == ''){
                layer.tips('部门名称不能为空', '#department_id');
            }
            $.ajax({
                //提交数据的类型 POST GET
                type:"POST",
                //提交的网址
                url:"/Home/Department/addDepartment",
                //提交的数据
                data:{department:department},
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
    </script>
</head>

<body>



<div class="formbody">

    <div class="formtitle"><span>基本信息</span></div>

    <ul class="forminfo">
        <li><label>部门名称</label><input name="department" type="text" class="dfinput" id="department_id"/></li>
        <li><label>&nbsp;</label><input name="" type="button" class="btn" value="确认保存" onclick="sub();"/></li>
    </ul>


</div>


</body>

</html>