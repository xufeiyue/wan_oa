var xxEvents = ('ontouchstart' in window) ? { start: 'touchstart', move: 'touchmove', end: 'touchend'} : { start: 'mousedown', move: 'mousemove', end: 'mouseup' };
var _xx = _xx || {
    astrict:true,
    z:2,
    pIndex:0
};
(function ($) {
    $.fn.moveIn = function (options) {
        var defaults = {
            classIn: 'moveIn',
            classOut: 'moveOut',
            complete: function () { }
            // CALLBACKS
        };
        var options = $.extend(defaults, options);
        this.show().addClass(options.classIn);
        this.one('webkitAnimationEnd', function () {
            $(this).removeClass(options.classIn);
            options.complete();
        });
        return this;
    };
    $.fn.moveOut = function (options) {
        var defaults = {
            classIn: 'moveIn',
            classOut: 'moveOut',
            complete: function () { }
            // CALLBACKS
        };
        var options = $.extend(defaults, options);
        this.show().addClass(options.classOut);
        this.one('webkitAnimationEnd', function () {
            $(this).removeClass(options.classOut).hide();
            options.complete();
        });
        return this;
    };
    $.fn.btnHover = function () {
        this.on(xxEvents.start, function (e) {
            $(this).addClass('on');
            e.preventDefault();
        });
        this.on(xxEvents.end, function (e) {
            $(this).removeClass('on');
            e.preventDefault();
        });
    }
})(jQuery);
_xx.page3_in=function(delay){
    var delay=delay||0;
    _xx.z++;
    $('#page3').css('zIndex',_xx.z).addClass('animate').show();
    $('#page3 .bg').transition({opacity:1,scale:1,delay:delay},1000);
    var aImg=$('#page3 .p3Circle img');
    aImg.each(function(i,d){
        delay+=200;
        $(this).css({opacity:0,scale:5}).transition({ opacity: 1, scale: 1,delay:delay},1000,'easeOutQuart'); 
    });
    delay+=200;
    $('#page3 .p3Text').css({opacity:0,scale:5}).transition({ opacity: 1, scale: 1,delay:delay},1000,'easeOutQuart');
    var aFt=$('#page3 .p3_ft li');
    delay+=200;
    aFt.eq(0).css({width:'0%'}).transition({width:'100%',delay:delay},1000,'easeOutQuart');
    delay+=500;
    aFt.eq(1).css({width:'0%'}).transition({width:'100%',delay:delay},1000,'easeOutQuart');
    delay+=200;
    aFt.eq(2).css({opacity:0,x:100}).transition({opacity:1,x:0,delay:delay},1000,'easeOutQuart',function(){
        _xx.pIndex=1;
        _xx.astrict=false;
    });
};
_xx.page3_out=function(){
    var delay=0;
    var aImg=$('#page3 .p3Circle img');
    aImg.transition({ opacity: 0, scale: 0.1,delay:delay},1000,'easeOutQuart'); 
    $('#page3 .p3Text').transition({ opacity: 0, scale: 0.1,delay:delay},1000,'easeOutQuart');
    var aFt=$('#page3 .p3_ft li');
    aFt.eq(0).transition({opacity:0,x:100,delay:delay},1000,'easeOutQuart');
    delay+=200;
    $('#page3 .bg').transition({opacity:0,delay:delay},1000,function(){
        $('#page3').removeClass('animate').hide();
    });
};