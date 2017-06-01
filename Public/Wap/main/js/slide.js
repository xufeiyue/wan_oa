(function($){	$.fn.ckSlide = function(opts){		//.extend() 扩展jQuery类，添加ckSlide方法，参数是对象类型{}		opts = $.extend({}, $.fn.ckSlide.opts, opts);		this.each(function(){			var slidewrap = $(this).find('.staff-slider');//轮播元素父对象			var slide = slidewrap.find('.staff-item');//获取<li>对象集			var count = slide.length;//计算对象集长度			var Ws = $(this).width();			var that = this;//存放父对象			var index = 0;//起始位置			var time = null;			$(slide).css("width",Ws);			$(this).data('opts', opts);//给轮播对象添加参数 数据			// next			$(this).find('.next-staff').on('click', function(){				if(opts['isAnimate'] == true){					return;				}				var old = index;				if(index >= count - 1){					index = 0;				}else{					index++;				}				change.call(that, index, old);//调用图片切换方法，.call() 每个JS函数都包含的一个非继承而来的方法，主要用来指定函数的作用域 that ，通常不严谨写法是change()，有可能会函数冲突。			});			// prev			$(this).find('.prev-staff').on('click', function(){				if(opts['isAnimate'] == true){					return;				}				var old = index;				if(index <= 0){					index = count - 1;				}else{					index--;				}				change.call(that, index, old);			});			// dir  移动方向参数			switch(opts.dir){				case "x":					opts['width'] = $(slide).width();					slidewrap.css({						'width':count * opts['width']					});					slide.css({						'float':'left',						'position':'relative',						'margin-left':'0px'					});					break;				case "y":  //添加垂直移动参数					opts['height'] = $(this).height();					slidewrap.css({						'height':count * opts['height']					});					slide.css({						'float':'left',						'position':'relative',						'margin-top':'0px'					});					break;			}		});	};	function change(show, hide){		//获取之前设置在ckSlide对象上的参数 数据		var opts = $(this).data('opts');		//水平移动		if(opts.dir == 'x'){			var x = show * opts['width'];			//animate() 与css()执行结果相同，但是过程不同，前者有渐变动画效果			$(this).find('.staff-slider').stop().animate({'margin-left':-x}, function(){opts['isAnimate'] = false;});			opts['isAnimate'] = true;//图片在移动过程中设置按钮点击不可用，确保每一次轮播视觉上执行完成，		}else if(opts.dir == 'y'){//垂直移动——自己添加			var y = show * opts['height'];			$(this).find('.staff-slider').stop().animate({'margin-top':-y}, function(){opts['isAnimate'] = false;});			opts['isAnimate'] = true;		}		else{			//默认的淡隐淡出效果			$(this).find('.staff-item').eq(hide).stop().animate({opacity:0});			$(this).find('.staff-item').eq(show).show().css({opacity:0}).stop().animate({opacity:1});		}		////切换对应标记的颜色		//$(this).find('.ck-slidebox li').removeClass('current');		//$(this).find('.ck-slidebox li').eq(show).addClass('current');	}	$.fn.ckSlide.opts = {		autoPlay: false,//默认不自动播放		dir: null,//默认淡隐淡出效果		isAnimate: false,//默认按钮可用		interval:2000//默认自动2秒切换 	};})(jQuery);