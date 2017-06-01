<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head lang="en">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>index</title>
    <link rel="stylesheet" href="/Public/Wap/main/css/style.css"/>
</head>
<body>
<div class="pageWrap">
    <img class="logo" src="/Public/Wap/main/images/logo.png" />
    <div id="page3">
        <div class="bg"><img src="/Public/Wap/main/images/bg.jpg" alt=""/></div>
        <div class="p3Circle">
            <div><img src="/Public/Wap/main/images/p3_r1.png"></div>
            <div><img src="/Public/Wap/main/images/p3_r2.png"></div>
            <ul class="p3Ball">
                <li><a href="#"><img src="/Public/Wap/main/images/p3_rr1.png"></a></li>
                <li><a href="#"><img src="/Public/Wap/main/images/p3_rr2.png"></a></li>
                <li><a href="#"><img src="/Public/Wap/main/images/p3_rr3.png"></a></li>
                <li><a href="#"><img src="/Public/Wap/main/images/p3_rr4.png"></a></li>
                <li><a href="#"><img src="/Public/Wap/main/images/p3_rr5.png"></a></li>
                <li><a href="#"><img src="/Public/Wap/main/images/p3_rr6.png"></a></li>
            </ul>
            <div class="p3Text" style="touch-action: pan-y; -webkit-user-select: none; -webkit-user-drag: none; -webkit-tap-highlight-color: rgba(0, 0, 0, 0);">
                <img src="/Public/Wap/main/images/p3_t2.png">
            </div>
        </div>
        <ul class="p3_ft">
            <li class="p3Btn">
                <a href="<?php echo U('Performance/dayPerformanceList');?>">当日到账</a>
            </li>
            <li class="p3Btn">
                <a href="<?php echo U('Performance/monthPerformanceList');?>">月度业绩</a>
            </li>
            <li class="p3Btn">
                <a href="<?php echo U('Performance/yearPerformanceList');?>">年度业绩</a>
            </li>
            <li class="p3Btn">
                <a href="#">公告</a>
            </li>
        </ul>
    </div>
</div>
<script type="text/javascript" src="/Public/Wap/main/js/jquery-1.9.1.min.js"></script>
<script type="text/javascript">

    $(function(){
        var heightScreen=$(window).height();
        var widthScreen=$(window).width();
        var mainBox=$(".pageWrap");
        mainBox.css("height",heightScreen);
        mainBox.css("width",widthScreen);

    });
</script>
</body>
</html>