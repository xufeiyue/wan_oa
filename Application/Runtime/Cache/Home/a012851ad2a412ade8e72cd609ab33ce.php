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
            var id = id
            layer.open({
                type: 2,
                area: ['700px', '530px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/Home/Employee/addEmployee'
            });
        }
        function edit(id) {
            var id = id
            layer.open({
                type: 2,
                area: ['700px', '530px'],
                fixed: false, //不固定
                maxmin: true,
                content: '/Home/Employee/editEmployeeInfo?id='+id
            });
        }
        function del(id) {
            var id = id
            layer.msg('你确定要删除这个员工？', {
                time: 0 //不自动关闭
                ,btn: ['是', '否']
                ,yes: function(index){
                    $.ajax({
                        //提交数据的类型 POST GET
                        type:"POST",
                        //提交的网址
                        url:"/index.php/Home/Employee/delEmployeeInfo",
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
            $.ajax({
                //提交数据的类型 POST GET
                type:"POST",
                //提交的网址
                url:"/Home/Employee/employeeList",
                //提交的数据
                data:{truename:truename,department_id:department_id},
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
        <form action="#" name="form1" method="post">
        <ul class="toolbar">
            <li onclick="add();"><span><img src="/Public/Admin/images/t01.png" /></span>添加</li>&nbsp;&nbsp;
            选择部门：<select name="department_id" class="dfinput" id="department_id">
            <option value="0">请选择部门</option>
            <?php if(is_array($department_list)): $i = 0; $__LIST__ = $department_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><option value="<?php echo ($vo['id']); ?>"><?php echo ($vo['department']); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
        </select>&nbsp;&nbsp;
            员工姓名：<input type="text" class="dfinput" name="truename" id="truename">&nbsp;&nbsp;
            <input name="sub" type="submit" class="btn" value="搜索" />
        </ul>
        </form>

        <ul class="toolbar1">
            <li><span><img src="/Public/Admin/images/t05.png" /></span>设置</li>
        </ul>

    </div>


    <table class="tablelist">
        <thead>
        <tr>
            <th>编号<i class="sort"><img src="/Public/Admin/images/px.gif" /></i></th>
            <th>姓名</th>
            <th>部门名称</th>
            <th>操作</th>
        </tr>
        </thead>
        <tbody>
        <?php if(is_array($list)): $i = 0; $__LIST__ = $list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr>
                <td><?php echo ($vo['id']); ?></td>
                <td><?php echo ($vo['truename']); ?></td>
                <td><?php echo ($vo['department']); ?></td>
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