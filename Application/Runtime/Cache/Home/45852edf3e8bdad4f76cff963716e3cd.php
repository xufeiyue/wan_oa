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
            var department_id = $("#department_id").val();
            var employee_id = $("#c").val();
            var performance = $("#performance").val();
            var add_time = $("#add_time").val();
            var compact_no = $("#compact_no").val();
            var compact_time = $("#compact_time").val();
            var client_name = $("#client_name").val();
            var client_truename = $("#client_truename").val();
            var product_type_id = $("#type_id").val();
            var product_id = $("#product_id").val();
            var client_type = $('#wrap input[name="client_type"]:checked ').val();
            if(department_id == 0){
                layer.tips('请选择部门', '#department_id');
            }else if(employee_id == 0){
                layer.tips('请选择员工', '#c');
            }else if(performance == ''){
                layer.tips('请填写业绩', '#performance');
            }else if(add_time == ''){
                layer.tips('请填写系统时间', '#add_time');
            }else if(compact_no == ''){
                layer.tips('请填写合同编号', '#compact_no');
            }else if(compact_time == ''){
                layer.tips('请填写合同日期', '#compact_time');
            }else if(client_name == ''){
                layer.tips('请填写客户名称', '#client_name');
            }else if(client_truename == ''){
                layer.tips('请填写客户联系人', '#client_truename');
            }else if(product_type_id == ''){
                layer.tips('请填写产品类别', '#product_type_id');
            }else if(product_id == ''){
                layer.tips('请填写产品', '#product_id');
            }else if(client_type == ''){
                layer.msg('请选择服务性质');
            }else{
                $.ajax({
                    //提交数据的类型 POST GET
                    type:"POST",
                    //提交的网址
                    url:"/Home/Performance/editPerformanceInfo",
                    //提交的数据
                    data:{department_id:department_id,employee_id:employee_id,performance:performance,add_time:add_time,compact_no:compact_no,compact_time:compact_time,
                        client_name:client_name,client_truename:client_truename,product_type_id:product_type_id,product_id:product_id,client_type:client_type,id:<?php echo $_GET['id'];?>},
                    //返回数据的格式
                    datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
                    //在请求之前调用的函数
//            beforeSend:function(){$("#msg").html("logining");},
                    //成功返回之后调用的函数
                    success:function(data){
                        //alert(data)
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
        function getEmployee(id){
            if(id != 0){
                $.ajax({
                    //提交数据的类型 POST GET
                    type:"POST",
                    //提交的网址
                    url:"/Home/Employee/ajaxGetEmployeeList",
                    //提交的数据
                    data:{id:id},
                    //返回数据的格式
                    datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
                    //在请求之前调用的函数
//            beforeSend:function(){$("#msg").html("logining");},
                    //成功返回之后调用的函数
                    success:function(data){
                        if(data.code == 200){
                            $("#c").empty();
                            $("#c").append(data.datas);
                        }else{
                            $("#c").empty();
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
        function getProductList(id){

            if(id != 0){
                $.ajax({
                    //提交数据的类型 POST GET
                    type:"POST",
                    //提交的网址
                    url:"/Home/Product/ajaxGetProductList",
                    //提交的数据
                    data:{id:id},
                    //返回数据的格式
                    datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
                    //在请求之前调用的函数
//            beforeSend:function(){$("#msg").html("logining");},
                    //成功返回之后调用的函数
                    success:function(data){
                        if(data.code == 200){
                            $("#product_id").empty();
                            $("#product_id").append(data.datas);
                        }else{
                            $("#product_id").empty();
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
    <script type="text/javascript" src="/Public/Admin/js/jeDate/jedate.js"></script>
</head>

<body>



<div class="formbody">

    <div class="formtitle"><span>基本信息</span></div>

    <ul class="forminfo">
        <li><label>请选择部门：</label><select name="department_id" class="dfinput" onchange="getEmployee(this.value);" id="department_id">
            <option value="0">请选择部门</option>
            <?php if(is_array($department_list)): $i = 0; $__LIST__ = $department_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>" <?php if($info['department_id'] == $vo['id']): ?>selected='selected'<?php endif; ?>><?php echo ($vo['department']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select></li>
        <li><label>请选择员工：</label>
            <select name="employee_id" id="c" class="dfinput">
                <?php if(is_array($employee_list)): $i = 0; $__LIST__ = $employee_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo1['id']); ?>" <?php if($info['employee_id'] == $vo1['id']): ?>selected='selected'<?php endif; ?>><?php echo ($vo1['truename']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </li>
        <li><label>业绩：</label><input type="text" name="performance" class="dfinput" id="performance" value="<?php echo ($info['performance']); ?>"/></li>
        <li><label>系统时间：</label><input type="text" name="add_time" id="add_time" class="dfinput" value="<?php echo ($info['add_time']); ?>" onclick="jeDate({dateCell:'#add_time',isTime:true,format:'YYYY-MM-DD hh:mm:ss'})"/></li>
        <li><label>合同编号：</label><input type="text" name="compact_no" class="dfinput" id="compact_no" value="<?php echo ($info['compact_no']); ?>"/></li>
        <li><label>合同日期：</label><input type="text" name="compact_time" class="dfinput" id="compact_time" value="<?php echo ($info['compact_time']); ?>" onclick="jeDate({dateCell:'#compact_time',isTime:true,format:'YYYY-MM-DD hh:mm:ss'})"/></li>
        <li><label>客户名称：</label><input type="text" name="client_name" class="dfinput" id="client_name" value="<?php echo ($info['client_name']); ?>"/></li>
        <li><label>客户联系人：</label><input type="text" name="client_truename" class="dfinput" id="client_truename" value="<?php echo ($info['client_truename']); ?>"/></li>
        <li><label>产品类型：</label>
            <select name="type_id" id="type_id" class="dfinput" onchange="getProductList(this.value);">
                <option value="0">请选择类别</option>
                <div id="d">
                    <?php if(is_array($product_type_list)): $i = 0; $__LIST__ = $product_type_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo2['id']); ?>"<?php if($info['product_type_id'] == $vo2['id']): ?>selected='selected'<?php endif; ?>><?php echo ($vo2['type_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>

            </select>
        </li>
        <li><label>产品名称：</label>
            <select name="product_id" id="product_id" class="dfinput">
                <?php if(is_array($product_list)): $i = 0; $__LIST__ = $product_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo3): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo3['id']); ?>" <?php if($info['product_id'] == $vo3['id']): ?>selected='selected'<?php endif; ?>><?php echo ($vo3['product_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
        </li>
        <li><label>服务性质：</label>
            <div id="wrap">
                新客户：<input type="radio" name="client_type"  value="新客户" <?php if($info['client_type'] == '新客户'): ?>checked='checked'<?php endif; ?>/>
                老客户：<input type="radio" name="client_type"  value="老客户" <?php if($info['client_type'] == '老客户'): ?>checked='checked'<?php endif; ?>/>
            </div>
        </li>
        <li><label>&nbsp;</label><input name="" type="button" class="btn" value="确认保存" onclick="sub();"/></li>
    </ul>


</div>


</body>

</html>