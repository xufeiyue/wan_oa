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

<div class="rightinfo">

    <div class="tools">
        <form action="#" name="form1" method="post">
            <ul class="toolbar">
                <!--<li onclick="add();"><span><img src="/Public/Admin/images/t01.png" /></span>添加</li>&nbsp;&nbsp;-->
                选择部门：<select name="department_id"   style="border:solid 1px;" id="department_id">
                <option value="0">请选择部门</option>
                <?php if(is_array($department_list)): $i = 0; $__LIST__ = $department_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['department']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
            </select>&nbsp;&nbsp;
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
            <th>部门名称</th>
            <th>到账金额</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($vo['department']); ?></td>
                <td><?php echo ($vo['performance']); ?></td>

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