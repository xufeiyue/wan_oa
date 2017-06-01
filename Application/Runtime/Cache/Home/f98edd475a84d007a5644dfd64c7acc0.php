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
        $(document).ready(function(){
            $("#click").click(function(){
                $(".tip").fadeIn(200);
            });

            $(".tiptop a").click(function(){
                $(".tip").fadeOut(200);
            });

            $(".sure").click(function(){
                $(".tip").fadeOut(100);
            });

            $(".cancel").click(function(){
                $(".tip").fadeOut(100);
            });

        });
    </script>
    <script type="text/javascript">
        function add() {
            layer.open({
                type: 2,
                area: ['700px', '530px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/Home/Product/addProduct'
            });
        }
        function edit(id) {
            var id = id
            layer.open({
                type: 2,
                area: ['700px', '530px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/Home/Product/editProduct?id='+id
            });
        }
        function del(id) {
            var id = id
            layer.msg('你确定要删除这个产品？', {
                time: 0 //不自动关闭
                ,btn: ['是', '否']
                ,yes: function(index){
                    $.ajax({
                        //提交数据的类型 POST GET
                        type:"POST",
                        //提交的网址
                        url:"/index.php/Home/Product/delProduct",
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

    </script>

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

        <ul class="toolbar">
            <li onclick="add();"><span><img src="/Public/Admin/images/t01.png" /></span>添加</li>
        </ul>


        <ul class="toolbar1">
            <li><span><img src="/Public/Admin/images/t05.png" /></span>设置</li>
        </ul>

    </div>


    <table class="tablelist">
        <thead>
        <tr>
            <th>编号<i class="sort"><img src="/Public/Admin/images/px.gif" /></i></th>
            <th>类别名称</th>
            <th>产品名称</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($vo['id']); ?></td>
                <td><?php echo ($vo['type_name']); ?></td>
                <td><?php echo ($vo['product_name']); ?></td>
                <td><a href="javascript:edit(<?php echo ($vo['id']); ?>)" class="tablelink">修改</a>     <a href="javascript:del(<?php echo ($vo['id']); ?>)" class="tablelink" > 删除</a></td>
            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
        </tbody>
    </table>


    <div class="pagin">
        <!--<div class="message">共<i class="blue">1256</i>条记录，当前显示第&nbsp;<i class="blue">2&nbsp;</i>页</div>-->
        <!--<ul class="paginList">-->
        <!--<li class="paginItem"><a href="javascript:;"><span class="pagepre"></span></a></li>-->
        <!--<li class="paginItem"><a href="javascript:;">1</a></li>-->
        <!--<li class="paginItem current"><a href="javascript:;">2</a></li>-->
        <!--<li class="paginItem"><a href="javascript:;">3</a></li>-->
        <!--<li class="paginItem"><a href="javascript:;">4</a></li>-->
        <!--<li class="paginItem"><a href="javascript:;">5</a></li>-->
        <!--<li class="paginItem more"><a href="javascript:;">...</a></li>-->
        <!--<li class="paginItem"><a href="javascript:;">10</a></li>-->
        <!--<li class="paginItem"><a href="javascript:;"><span class="pagenxt"></span></a></li>-->
        <!--</ul>-->
        <?php echo ($page); ?>
    </div>


    <div class="tip">
        <div class="tiptop"><span>提示信息</span><a></a></div>

        <div class="tipinfo">
            <span><img src="/Public/Admin/images/ticon.png" /></span>
            <div class="tipright">
                <p>是否确认对信息的修改 ？</p>
                <cite>如果是请点击确定按钮 ，否则请点取消。</cite>
            </div>
        </div>

        <div class="tipbtn">
            <input name="" type="button"  class="sure" value="确定" />&nbsp;
            <input name="" type="button"  class="cancel" value="取消" />
        </div>

    </div>




</div>

<script type="text/javascript">
    $('.tablelist tbody tr:odd').addClass('odd');
</script>

</body>

</html>