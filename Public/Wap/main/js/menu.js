$(function() {
  var menuspeed =200; // 边栏滑出耗费时间
  var $burger = $('#product_menu');
  var $click=$('.click_nav');
  var clickList=$(".click");
  var heightScreen=$(window).height();

  $('.theader #product_menu').css({
    "height" :heightScreen-60+"px"
  });
  $(".search").click(function(){
    $(".search-bar").slideToggle(200)
  });
  $('.mbtn').click(function (){
    //局部
    if($(this).hasClass("co")){
      $(".t-1").removeClass("t-10");
      $(".t-2").animate({opacity:1});
      $(".t-3").removeClass("t-30");
      $(this).removeClass("co");
    }else{
      $(".t-1").addClass("t-10");
      $(".t-2").animate({opacity:0});
      $(".t-3").addClass("t-30");
      $(this).addClass("co")
    }
    $($burger).slideToggle('menuspeed');//slideToggle 向下卷动显示与隐藏相互切换
  });
  for(var i=0;i<clickList.length;i++){
    $(clickList[i]).click(function(){
      var j=getCorrtenNum(this,clickList);
      $($click[j]).slideToggle('menuspeed');
      if($($click[j]).attr("state")!="1"){
        $(this).find('i').html("-");
        $($click[j]).attr("state","1");
      }else{
        $(this).find('i').html("+");
        $($click[j]).attr("state","0");
      }
    });
  }
  function getCorrtenNum(obj,objPre){
    for(var j=0;j<objPre.length;j++){
      if(objPre[j]==obj){
        return j;
      }
    }
  }
});