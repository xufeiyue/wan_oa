<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>无标题文档</title>
    <link href="/Public/Admin/css/style.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="/Public/Admin/js/jquery.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/jquery-3.2.1.min.js"></script>
    <script type="text/javascript" src="/Public/Admin/js/layer/layer.js"></script>
    <script type="text/javascript">
        function add() {
            layer.open({
                type: 2,
                area: ['800px', '600px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/Home/Performance/addPerformance'
            });
        }
        function edit(id) {
            var id = id
            layer.open({
                type: 2,
                area: ['700px', '530px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/Home/Performance/editPerformanceInfo?id='+id
            });
        }
        function del(id) {
            var id = id
            layer.msg('你确定要删除这条业绩？', {
                time: 0 //不自动关闭
                ,btn: ['是', '否']
                ,yes: function(index){
                    $.ajax({
                        //提交数据的类型 POST GET
                        type:"POST",
                        //提交的网址
                        url:"/index.php/Home/Performance/delPerformance",
                        //提交的数据
                        data:{id:id},
                        //返回数据的格式
                        datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
                        //在请求之前调用的函数
//            beforeSend:function(){$("#msg").html("logining");},
                        //成功返回之后调用的函数
                        success:function(data){
                            if(data.code == 200){
                                location.reload();
                            }else{
                                layer.alert(data.msg);
                            }
                        },
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
            });
        }

        function search(){
            var truename = $("#truename").val();
            var department_id = $("#department_id").val();
            var begin_time = $("#begin_time").val();
            var end_time = $("#end_time").val();
            $.ajax({
                //提交数据的类型 POST GET
                type:"POST",
                //提交的网址
                url:"/Home/Performance/performanceList",
                //提交的数据
                data:{truename:truename,department_id:department_id,begin_time:begin_time,end_time:end_time},
                //返回数据的格式
                datatype: "json",//"xml", "html", "script", "json", "jsonp", "text".
                //在请求之前调用的函数
//            beforeSend:function(){$("#msg").html("logining");},
                //成功返回之后调用的函数
                success:function(data){
                    location.reload();
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
        function getEmployee(id){
            if(id==0){
                $("#c").empty();
                $("#c").append("<option value='0'>请选择员工</option>");
            }
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
            if(id==0){
                $("#product_id").empty();
                $("#product_id").append("<option value='0'>请选择产品</option>");
            }
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
    <script type="text/javascript" src="/Public/Admin/js/jedate/jedate.js"></script>

</head>


<body>

<div class="place">
    <span>位置：</span>
    <ul class="placeul">
        <li><a href="#">首页</a></li>
        <li><a href="#">数据表</a></li>
        <li><a href="#">基本内容</a></li>
    </ul>
</div>

<div class="rightinfo" style="font-size: 9pt;">

    <div class="tools">
        <form action="#" name="form1" method="post">
            <ul class="toolbar">
                <!--<li onclick="add();"><span><img src="/Public/Admin/images/t01.png" /></span>添加</li>&nbsp;&nbsp;-->
                选择部门：<select name="department_id"   style="border:solid 1px;" id="department_id" onchange="getEmployee(this.value);">
                <option value="0">请选择部门</option>
                <?php if(is_array($department_list)): $i = 0; $__LIST__ = $department_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['department']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>&nbsp;&nbsp;
                员工姓名：<select name="employee_id" id="c" style="border:solid 1px;">
                    <option value="0">请选择员工</option>
                </select>
                合同编号：<input type="text" name="compact_no" id="compact_no"style="border:solid 1px;">&nbsp;&nbsp;
                客户名称：<input type="text" name="client_name" id="client_name"style="border:solid 1px;" >&nbsp;&nbsp;
                客户联系人：<input type="text" name="client_truename" id="client_truename"style="border:solid 1px;"><br/>
                产品类别：<select name="product_type_id" style="border:solid 1px;" id="product_type_id" onchange="getProductList(this.value)">
                <option value="0">请选择类别</option>
                <?php if(is_array($product_type_list)): $i = 0; $__LIST__ = $product_type_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo1): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo1['id']); ?>"><?php echo ($vo1['type_name']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>
                产品：<select name="product_id" id="product_id" style="border:solid 1px;">
                <option value="0">请选择产品</option>
            </select>
                开始时间：<input type="text" name="begin_time" id="begin_time" style="border:solid 1px;"onclick="jeDate({dateCell:'#begin_time',isTime:true,format:'YYYY-MM-DD'})"/>&nbsp;&nbsp;
                结束时间：<input type="text" name="end_time" id="end_time" style="border:solid 1px;"onclick="jeDate({dateCell:'#end_time',isTime:true,format:'YYYY-MM-DD'})"/>&nbsp;&nbsp;
                <input name="sub" type="submit" class="btn" value="搜索" />
            </ul>
        </form>

    </div>


    <table class="tablelist">
        <thead>
        <tr>
            <th>姓名</th>
            <th>部门名称</th>
            <th>系统时间</th>
            <th>合同编号</th>
            <th>签单日期</th>
            <th>客户名称</th>
            <th>企业名称</th>
            <th>企业地址</th>
            <th>指定联系人</th>
            <th>联系方式</th>
            <th>产品类别</th>
            <th>产品名称</th>
            <th>服务性质</th>
            <th>到账金额</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($vo['truename']); ?></td>
                <td><?php echo ($vo['department']); ?></td>
                <td><?php echo ($vo['add_time']); ?></td>
                <td><?php echo ($vo['compact_no']); ?></td>
                <td><?php echo ($vo['compact_time']); ?></td>
                <td><?php echo ($vo['client_name']); ?></td>
                <td><?php echo ($vo['company_name']); ?></td>
                <td><?php echo ($vo['company_address']); ?></td>
                <td><?php echo ($vo['client_truename']); ?></td>
                <td><?php echo ($vo['phone']); ?></td>
                <td><?php echo ($vo['type_name']); ?></td>
                <td><?php echo ($vo['product_name']); ?></td>
                <td><?php echo ($vo['client_type']); ?></td>
                <td><?php echo ($vo['performance']); ?></td>
                <td><a href="javascript:edit(<?php echo ($vo['id']); ?>)" class="tablelink">修改</a>     <a href="javascript:del(<?php echo ($vo['id']); ?>)" class="tablelink" > 删除</a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>
    <div class="pagin">
        <?php echo ($page); ?>
    </div>
</div>

<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');
</script>

</body>

</html>