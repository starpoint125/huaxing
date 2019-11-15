$(function(){
	$(".jl_indexBigPicThreePer").each(function(index){
		$(this).mouseover(function(){
			$(".jl_indexBigFloat").each(function(){
				$(this).hide();
			});
			$(this).addClass("jl_indexBigPicThreePer_hover");
			$($(".jl_indexBigFloat")[index]).show();
		}).mouseout(function(){
			$(".jl_indexBigFloat").each(function(){
				$(this).hide();
			});
			$(this).removeClass("jl_indexBigPicThreePer_hover");
		});
	});
	$(".jl_indexBigFloat").each(function(index){
		$(this).mouseover(function(){
			$(this).show();
			$($(".jl_indexBigPicThreePer")[index]).addClass("jl_indexBigPicThreePer_hover");
		}).mouseout(function(){
			$(this).hide();
			$($(".jl_indexBigPicThreePer")[index]).removeClass("jl_indexBigPicThreePer_hover");
		});
	});


	var eachScrollWidth = 374;			//每次滚动宽度
	var divNum = $(".jl_indexMainSecBottomBox").children(".jl_indexMainSecBottom").size();
	var maxMargin = eachScrollWidth*(divNum-1);	
	var minMargin = 0;
	var sh_ei = 0;		
	$("#jl_indexMainSecPrev").click(function(){
/*		var nowMarginLeft = parseInt($(".jl_indexMainSecBottomBox").css("marginLeft"));			//这是个非正值
		if((0-nowMarginLeft) > minMargin){
			$(".jl_indexMainSecBottomBox").animate({marginLeft:((nowMarginLeft+eachScrollWidth)+"px")});
		}*/
		if(sh_ei>0){sh_ei--;}
		if(sh_ei<0){
			sh_ei+=1;
			return false;
			}
		$(".jl_indexMainSecBottomBox").animate({marginLeft:"-"+eachScrollWidth*sh_ei+"px"});
		$(".scy_xj_syshzr h4").html(sh_ei+1)
	});
	$("#jl_indexMainSecNext").click(function(){
/*		var nowMarginLeft = parseInt($(".jl_indexMainSecBottomBox").css("marginLeft"));			//这是个非正值
		if((0-nowMarginLeft) < maxMargin){
			$(".jl_indexMainSecBottomBox").animate({marginLeft:((nowMarginLeft-eachScrollWidth)+"px")});
		}*/
		if(sh_ei<divNum){sh_ei++;}
		if(sh_ei>=divNum){
			sh_ei-=1;
			return false;
			}
		$(".jl_indexMainSecBottomBox").animate({marginLeft:"-"+eachScrollWidth*sh_ei+"px"});
		$(".scy_xj_syshzr h4").html(sh_ei+1)
	});
	

	//获取屏幕宽度
	var windowWidth = $(window).width();			//屏幕宽度
	var bigPicNums = $(".jl_indexBigPic").size();								//图片数量
	$(".jl_indexBigPic").width(windowWidth);		//设置大图所在区域宽度
	$(".jl_bgBoxForBig").width(windowWidth);		//设置大图的显示区域的宽度
	var maxBigMargin = windowWidth*(bigPicNums-1)	//最大marginLeft值
	var stopOrStartFlag = 1;						//停止或者启动的标示，1标示启动，0标示停止
	var animateTime = 500;
	//默认显示启动
	var bigPicSlider;
	bgFade();
	$($("#jl_controlUl").children("li")[0]).css("background","url(images/jl_indexBigControl2.png)");
	var s_iei = 0;
	//鼠标浮在切换按钮、数字按钮、内容时计时器停止，移开是计时器重新开始
	$("#jl_bigPicNext").mouseover(function(){
		clearInterval(bigPicSlider);
		stopOrStartFlag = 0;
	}).mouseout(function(){
		if(!stopOrStartFlag){
			bgFade();
			stopOrStartFlag = 1;
		}
	});
	$("#jl_bigPicPrev").mouseover(function(){
		clearInterval(bigPicSlider);
		stopOrStartFlag = 0;
	}).mouseout(function(){
		if(!stopOrStartFlag){
			bgFade();
			stopOrStartFlag = 1;
		}
	});
	$(".jl_indexBigFloat").each(function(index){
		$(this).mouseover(function(){
			clearInterval(bigPicSlider);
			stopOrStartFlag = 0;
		}).mouseout(function(){
			if(!stopOrStartFlag){
				bgFade();
				stopOrStartFlag = 1;
			}
		});
	});
	$(".jl_indexBigPicThreePer").each(function(index){
		$(this).mouseover(function(){
			clearInterval(bigPicSlider);
			stopOrStartFlag = 0;
		}).mouseout(function(){
			if(!stopOrStartFlag){
				bgFade();
				stopOrStartFlag = 1;
			}
		});
	});
	$("#jl_controlUl>li").each(function(index){
		$(this).mouseover(function(){
			clearInterval(bigPicSlider);
			stopOrStartFlag = 0;
		}).mouseout(function(){
			if(!stopOrStartFlag){
				bgFade();
				stopOrStartFlag = 1;
			}
		});
	});
	$(".jl_indexBigPic").mouseover(function(){
		clearInterval(bigPicSlider);
		stopOrStartFlag = 0;
	}).mouseout(function(){
		if(!stopOrStartFlag){
			bgFade();
			stopOrStartFlag = 1;
		}
	});	
	//鼠标浮在切换按钮、数字按钮、内容时计时器停止，移开是计时器重新开始 end
	

	$("#jl_bigPicNext").click(function(){
/*		var nowBigMarginLeft = parseInt($(".jl_bigPicBox").css("marginLeft"));
		if((0-nowBigMarginLeft)<maxBigMargin){
			$(".jl_bigPicBox").animate({marginLeft:(nowBigMarginLeft-windowWidth)+"px"},animateTime);
			var witchLiShow = (0-nowBigMarginLeft)/windowWidth;
			deleteAllLiStyle();
			$($("#jl_controlUl").children("li")[witchLiShow+1]).css("background","url(images/jl_indexBigControl2.png)");
		}*/
		if(s_iei<bigPicNums){s_iei++;}
		if(s_iei>=bigPicNums){
			s_iei-=1;
			return false;
			}
		$(".jl_bigPicBox").animate({marginLeft:"-"+windowWidth*s_iei+"px"},animateTime);
		deleteAllLiStyle();
		$("#jl_controlUl li").each(function(index, element) {
            if(index==s_iei){
				$(this).css("background","url(images/jl_indexBigControl2.png)");
				}
        });
	});
	$("#jl_bigPicPrev").click(function(){
/*		var nowBigMarginLeft = parseInt($(".jl_bigPicBox").css("marginLeft"));
		if((0-nowBigMarginLeft)>0){
			$(".jl_bigPicBox").animate({marginLeft:(nowBigMarginLeft+windowWidth)+"px"},animateTime);
			var witchLiShow = (0-nowBigMarginLeft)/windowWidth;
			deleteAllLiStyle();
			$($("#jl_controlUl").children("li")[witchLiShow-1]).css("background","url(images/jl_indexBigControl2.png)");
		}*/
		if(s_iei>0){s_iei--;}
		if(s_iei<0){
			s_iei+=1;
			return false;
			}
		$(".jl_bigPicBox").animate({marginLeft:"-"+windowWidth*s_iei+"px"},animateTime);
		deleteAllLiStyle();
		$("#jl_controlUl li").each(function(index, element) {
            if(index==s_iei){
				$(this).css("background","url(images/jl_indexBigControl2.png)");
				}
        });
	});

	//点击停止
	$("#jl_controlStop").click(function(){
		if(stopOrStartFlag){
			$(this).css("background","url(images/jl_bigPicControl4.png)");
			clearInterval(bigPicSlider);
			stopOrStartFlag = 0;
		}else{
			$(this).css("background","url(images/jl_indexBigControl1.png)");
			bgFade();
			stopOrStartFlag = 1;
		}
	});
	//点击停止end

	//点击数字
	$("#jl_controlUl>li").each(function(index){
		$(this).click(function(){
			/*var nowBigMarginLeft = parseInt($(".jl_bigPicBox").css("marginLeft"));
			$(".jl_bigPicBox").animate({marginLeft:(0-index*windowWidth)+"px"},animateTime);
			var witchLiShow = (0-nowBigMarginLeft)/windowWidth;*/
			s_iei=index;
			$(".jl_bigPicBox").animate({marginLeft:"-"+windowWidth*s_iei+"px"},animateTime);
			deleteAllLiStyle();
			$(this).css("background","url(images/jl_indexBigControl2.png)");
		});
	});
	//点击数字end

	//计时显示
	function bgFade(){
		bigPicSlider = setInterval(function(){
			//var nowBigMarginLeft = parseInt($(".jl_bigPicBox").css("marginLeft"));
			//if(s_iei<bigPicNums){
/*				$(".jl_bigPicBox").animate({marginLeft:(nowBigMarginLeft-windowWidth)+"px"},animateTime);
				var witchLiShow = (0-nowBigMarginLeft)/windowWidth;
				deleteAllLiStyle();
				$($("#jl_controlUl").children("li")[witchLiShow+1]).css("background","url(images/jl_indexBigControl2.png)");*/
				s_iei+=1;
				if(s_iei>bigPicNums-1){
					s_iei=0;
					}
	    $(".jl_bigPicBox").animate({marginLeft:"-"+windowWidth*s_iei+"px"},animateTime);
		deleteAllLiStyle();
		$("#jl_controlUl li").each(function(index, element) {
            if(index==s_iei){
				$(this).css("background","url(images/jl_indexBigControl2.png)");
				}
        });
			//}else{
		
/*				$(".jl_bigPicBox").animate({marginLeft:"0px"},200);
				deleteAllLiStyle();
				$($("#jl_controlUl").children("li")[0]).css("background","url(images/jl_indexBigControl2.png)");*/
			
			//}
		},5000);
	}
	//计时显示end

	//清除数字显示所有的效果
	function deleteAllLiStyle(){
		$("#jl_controlUl").children("li").each(function(){
			$(this).css("background","url(images/jl_indexBigControl3.png)");
		});
	}
	/*************************************/
	$(window).resize(function(){
	$(".jl_indexBigPicThreePer").each(function(index){
		$(this).mouseover(function(){
			$(".jl_indexBigFloat").each(function(){
				$(this).hide();
			});
			$(this).addClass("jl_indexBigPicThreePer_hover");
			$($(".jl_indexBigFloat")[index]).show();
		}).mouseout(function(){
			$(".jl_indexBigFloat").each(function(){
				$(this).hide();
			});
			$(this).removeClass("jl_indexBigPicThreePer_hover");
		});
	});
	$(".jl_indexBigFloat").each(function(index){
		$(this).mouseover(function(){
			$(this).show();
			$($(".jl_indexBigPicThreePer")[index]).addClass("jl_indexBigPicThreePer_hover");
		}).mouseout(function(){
			$(this).hide();
			$($(".jl_indexBigPicThreePer")[index]).removeClass("jl_indexBigPicThreePer_hover");
		});
	});


	var eachScrollWidth = 374;			//每次滚动宽度
	var divNum = $(".jl_indexMainSecBottomBox").children(".jl_indexMainSecBottom").size();
	var maxMargin = eachScrollWidth*(divNum-1);	
	var minMargin = 0;
	var sh_ei = 0;		
	$("#jl_indexMainSecPrev").click(function(){
/*		var nowMarginLeft = parseInt($(".jl_indexMainSecBottomBox").css("marginLeft"));			//这是个非正值
		if((0-nowMarginLeft) > minMargin){
			$(".jl_indexMainSecBottomBox").animate({marginLeft:((nowMarginLeft+eachScrollWidth)+"px")});
		}*/
		if(sh_ei>0){sh_ei--;}
		if(sh_ei<0){
			sh_ei+=1;
			return false;
			}
		$(".jl_indexMainSecBottomBox").animate({marginLeft:"-"+eachScrollWidth*sh_ei+"px"});
		$(".scy_xj_syshzr h4").html(sh_ei+1)
	});
	$("#jl_indexMainSecNext").click(function(){
/*		var nowMarginLeft = parseInt($(".jl_indexMainSecBottomBox").css("marginLeft"));			//这是个非正值
		if((0-nowMarginLeft) < maxMargin){
			$(".jl_indexMainSecBottomBox").animate({marginLeft:((nowMarginLeft-eachScrollWidth)+"px")});
		}*/
		if(sh_ei<divNum){sh_ei++;}
		if(sh_ei>=divNum){
			sh_ei-=1;
			return false;
			}
		$(".jl_indexMainSecBottomBox").animate({marginLeft:"-"+eachScrollWidth*sh_ei+"px"});
		$(".scy_xj_syshzr h4").html(sh_ei+1)
	});
	

	//获取屏幕宽度
	var windowWidth = $(window).width();			//屏幕宽度
	var bigPicNums = $(".jl_indexBigPic").size();								//图片数量
	$(".jl_indexBigPic").width(windowWidth);		//设置大图所在区域宽度
	$(".jl_bgBoxForBig").width(windowWidth);		//设置大图的显示区域的宽度
	var maxBigMargin = windowWidth*(bigPicNums-1)	//最大marginLeft值
	var stopOrStartFlag = 1;						//停止或者启动的标示，1标示启动，0标示停止
	var animateTime = 500;
	//默认显示启动
	var bigPicSlider;
	bgFade();
	$($("#jl_controlUl").children("li")[0]).css("background","url(images/jl_indexBigControl2.png)");
	var s_iei = 0;
	//鼠标浮在切换按钮、数字按钮、内容时计时器停止，移开是计时器重新开始
	$("#jl_bigPicNext").mouseover(function(){
		clearInterval(bigPicSlider);
		stopOrStartFlag = 0;
	}).mouseout(function(){
		if(!stopOrStartFlag){
			bgFade();
			stopOrStartFlag = 1;
		}
	});
	$("#jl_bigPicPrev").mouseover(function(){
		clearInterval(bigPicSlider);
		stopOrStartFlag = 0;
	}).mouseout(function(){
		if(!stopOrStartFlag){
			bgFade();
			stopOrStartFlag = 1;
		}
	});
	$(".jl_indexBigFloat").each(function(index){
		$(this).mouseover(function(){
			clearInterval(bigPicSlider);
			stopOrStartFlag = 0;
		}).mouseout(function(){
			if(!stopOrStartFlag){
				bgFade();
				stopOrStartFlag = 1;
			}
		});
	});
	$(".jl_indexBigPicThreePer").each(function(index){
		$(this).mouseover(function(){
			clearInterval(bigPicSlider);
			stopOrStartFlag = 0;
		}).mouseout(function(){
			if(!stopOrStartFlag){
				bgFade();
				stopOrStartFlag = 1;
			}
		});
	});
	$("#jl_controlUl>li").each(function(index){
		$(this).mouseover(function(){
			clearInterval(bigPicSlider);
			stopOrStartFlag = 0;
		}).mouseout(function(){
			if(!stopOrStartFlag){
				bgFade();
				stopOrStartFlag = 1;
			}
		});
	});
	$(".jl_indexBigPic").mouseover(function(){
		clearInterval(bigPicSlider);
		stopOrStartFlag = 0;
	}).mouseout(function(){
		if(!stopOrStartFlag){
			bgFade();
			stopOrStartFlag = 1;
		}
	});	
	//鼠标浮在切换按钮、数字按钮、内容时计时器停止，移开是计时器重新开始 end
	

	$("#jl_bigPicNext").click(function(){
/*		var nowBigMarginLeft = parseInt($(".jl_bigPicBox").css("marginLeft"));
		if((0-nowBigMarginLeft)<maxBigMargin){
			$(".jl_bigPicBox").animate({marginLeft:(nowBigMarginLeft-windowWidth)+"px"},animateTime);
			var witchLiShow = (0-nowBigMarginLeft)/windowWidth;
			deleteAllLiStyle();
			$($("#jl_controlUl").children("li")[witchLiShow+1]).css("background","url(images/jl_indexBigControl2.png)");
		}*/
		if(s_iei<bigPicNums){s_iei++;}
		if(s_iei>=bigPicNums){
			s_iei-=1;
			return false;
			}
		$(".jl_bigPicBox").animate({marginLeft:windowWidth*s_iei+"px"},animateTime);
		deleteAllLiStyle();
		$("#jl_controlUl li").each(function(index, element) {
            if(index==s_iei){
				$(this).css("background","url(images/jl_indexBigControl2.png)");
				}
        });
	});
	$("#jl_bigPicPrev").click(function(){
/*		var nowBigMarginLeft = parseInt($(".jl_bigPicBox").css("marginLeft"));
		if((0-nowBigMarginLeft)>0){
			$(".jl_bigPicBox").animate({marginLeft:(nowBigMarginLeft+windowWidth)+"px"},animateTime);
			var witchLiShow = (0-nowBigMarginLeft)/windowWidth;
			deleteAllLiStyle();
			$($("#jl_controlUl").children("li")[witchLiShow-1]).css("background","url(images/jl_indexBigControl2.png)");
		}*/
		if(s_iei>0){s_iei--;}
		if(s_iei<0){
			s_iei+=1;
			return false;
			}
		$(".jl_bigPicBox").animate({marginLeft:"-"+windowWidth*s_iei+"px"},animateTime);
		deleteAllLiStyle();
		$("#jl_controlUl li").each(function(index, element) {
            if(index==s_iei){
				$(this).css("background","url(images/jl_indexBigControl2.png)");
				}
        });
	});

	//点击停止
	$("#jl_controlStop").click(function(){
		if(stopOrStartFlag){
			$(this).css("background","url(images/jl_bigPicControl4.png)");
			clearInterval(bigPicSlider);
			stopOrStartFlag = 0;
		}else{
			$(this).css("background","url(images/jl_indexBigControl1.png)");
			bgFade();
			stopOrStartFlag = 1;
		}
	});
	//点击停止end

	//点击数字
	$("#jl_controlUl>li").each(function(index){
		$(this).click(function(){
			/*var nowBigMarginLeft = parseInt($(".jl_bigPicBox").css("marginLeft"));
			$(".jl_bigPicBox").animate({marginLeft:(0-index*windowWidth)+"px"},animateTime);
			var witchLiShow = (0-nowBigMarginLeft)/windowWidth;*/
			s_iei=index;
			$(".jl_bigPicBox").animate({marginLeft:"-"+windowWidth*s_iei+"px"},animateTime);
			deleteAllLiStyle();
			$(this).css("background","url(images/jl_indexBigControl2.png)");
		});
	});
	//点击数字end

	//计时显示
	function bgFade(){
		bigPicSlider = setInterval(function(){
			//var nowBigMarginLeft = parseInt($(".jl_bigPicBox").css("marginLeft"));
			//if(s_iei<bigPicNums){
/*				$(".jl_bigPicBox").animate({marginLeft:(nowBigMarginLeft-windowWidth)+"px"},animateTime);
				var witchLiShow = (0-nowBigMarginLeft)/windowWidth;
				deleteAllLiStyle();
				$($("#jl_controlUl").children("li")[witchLiShow+1]).css("background","url(images/jl_indexBigControl2.png)");*/
				s_iei+=1;
				if(s_iei>bigPicNums-1){
					s_iei=0;
					}
	    $(".jl_bigPicBox").animate({marginLeft:"-"+windowWidth*s_iei+"px"},animateTime);
		deleteAllLiStyle();
		$("#jl_controlUl li").each(function(index, element) {
            if(index==s_iei){
				$(this).css("background","url(images/jl_indexBigControl2.png)");
				}
        });
			//}else{
		
/*				$(".jl_bigPicBox").animate({marginLeft:"0px"},200);
				deleteAllLiStyle();
				$($("#jl_controlUl").children("li")[0]).css("background","url(images/jl_indexBigControl2.png)");*/
			
			//}
		},5000);
	}
	//计时显示end

	//清除数字显示所有的效果
	function deleteAllLiStyle(){
		$("#jl_controlUl").children("li").each(function(){
			$(this).css("background","url(images/jl_indexBigControl3.png)");
		});
	}
		});
})