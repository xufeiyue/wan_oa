<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, user-scalable=0">
    <title>信息发布详细页</title>
    <link rel="stylesheet" type="text/css" href="/Public/Wap/main/css/style.css">
    <script src="https://img.hcharts.cn/jquery/jquery-1.8.3.min.js"></script>
    <script src="https://img.hcharts.cn/highcharts/highcharts.js"></script>
    <script src="https://img.hcharts.cn/highcharts-plugins/highcharts-zh_CN.js"></script>

</head>
<body>
<!--头部开始-->
<div class="theader">
    <a class="goback" href="/index.php/Wap/Index/mainView"><img src="/Public/Wap/main/images/fanhui.png"/> </a><strong>业绩查询系统</strong></div>

<!--头部结束-->
<div class="re_header"></div>
<div style="width: 100%;height: 60px;">
    <div style="float:left;width: 50%;">
        <div style="background-color: #9b9b9b;text-align:center; color:#FFF">
            <span style="height:30px; line-height:30px; width:50%; overflow:hidden;">
                <?php if($contro == 'day'): ?><a href="/index.php/Wap/Performance/dayPerformanceList?type=1" style="color:#FFF"> 部门</a><?php endif; ?>
                <?php if($contro == 'month'): ?><a href="/index.php/Wap/Performance/monthPerformanceList?type=1" style="color:#FFF"> 部门</a><?php endif; ?>
                <?php if($contro == 'year'): ?><a href="/index.php/Wap/Performance/yearPerformanceList?type=1" style="color:#FFF"> 部门</a><?php endif; ?>
            </span>
        </div>
    </div>
    <div style="float:left;width: 50%;">
        <div style="background-color: #9b9b9b;text-align:center;">
            <span style="height:30px; line-height:30px; width:50%; overflow:hidden;">
                <?php if($contro == 'day'): ?><a href="/index.php/Wap/Performance/dayPerformanceList?type=2" style="color:#FFF"> 个人</a><?php endif; ?>
                <?php if($contro == 'month'): ?><a href="/index.php/Wap/Performance/monthPerformanceList?type=2" style="color:#FFF"> 个人</a><?php endif; ?>
                <?php if($contro == 'year'): ?><a href="/index.php/Wap/Performance/yearPerformanceList?type=2" style="color:#FFF"> 个人</a><?php endif; ?>
            </span>
        </div>
    </div>
</div>
<?php if($contro != 'day'): ?><div style="width:100%;float: left">
    <div style="margin-left: 20%">
        <form action="" method="post" name="form1">
        日期：<?php echo ($sel_month); ?>&nbsp;&nbsp;
            <input type="hidden" name="type" value="<?php echo $_GET['type']?>">
        <input type="submit" name="sub" value="查询">
        </form>
    </div>
</div><?php endif; ?>
<!--正文开始-->
<div class="news_detail">
    <div id="container"></div>
    <script>
        $(function () {
            $('#container').highcharts({
                chart: {
                    type: 'bar'
                },
                title: {
                    text: '<?php echo ($title); ?>'
                },
                xAxis: {
                    categories: [<?php echo ($str); ?>],
                    title: {
                        text: null
                    }
                },
                yAxis: {
                    min: 0,
                    max:100,
                    title: {
                        text: '业绩 (<?php echo ($danwei); ?>)',
                        align: 'high'
                    },
                    labels: {
                        overflow: 'justify'
                    }
                },
                tooltip: {
                    valueSuffix: ' <?php echo ($danwei); ?>'
                },
                plotOptions: {
                    bar: {
                        dataLabels: {
                            enabled: true,
                            allowOverlap: true
                        }
                    }
                },
                credits: {
                    enabled: false
                },
                series: [{
                    events: {
                        legendItemClick: function () {
                            return false;
                        }
                    },
                    data: [<?php echo ($str1); ?>]
                }]
            });
        });

    </script>
    <script>

    </script>
</div>
</div>
<!--正文结束-->
<!--底部开始-->
<div class="footer2">
    <p>楚朗传媒  <br/>
        Copryrught@2015-2020 版权所有
    </p>
</div>
<!--底部结束-->
<!--footer开始-->
<div class="footer_replace"></div>
<div class="footer">
    <ul>
        <li>
            <a href="<?php echo U('Performance/dayPerformanceList');?>">
                <div class="li_img"><img src="/Public/Wap/main/images/login.png"></div>
                <i>当日到账</i>
            </a>
        </li>
        <li>
            <a href="<?php echo U('Performance/monthPerformanceList');?>">
                <div class="li_img"><img src="/Public/Wap/main/images/message.png"></div>
                <i>月度业绩</i>
            </a>
        </li>
        <li>
            <a href="<?php echo U('Index/index');?>">
                <div class="li_img_big"><img src="/Public/Wap/main/images/home.png"></div>
            </a>
        </li>
        <li>
            <a href="<?php echo U('Performance/yearPerformanceList');?>">
                <div class="li_img"><img src="/Public/Wap/main/images/tel.png"></div>
                <i>年度业绩</i>
            </a>
        </li>
        <li>
            <a href="#">
                <div class="li_img"><img src="/Public/Wap/main/images/share.png"></div>
                <i>公告</i>
            </a>
        </li>
    </ul>
</div>
<!--footer结束-->
</body>
</html>