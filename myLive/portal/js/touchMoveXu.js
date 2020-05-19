	
//全局变量，触摸开始结束位置
var startX = 0,startY = 0,endX   = 0,endY   = 0;

function touchSatrtFunc(evt){
	try{
	//	evt.preventDefault(); //阻止触摸时浏览器的缩放、滚动条滚动等
		var touch = evt.touches[0]; //获取第一个触点
		startX = Number(touch.pageX); //页面触点X坐标
		startY = Number(touch.pageY); //页面触点Y坐标
		endX   = Number(touch.pageX); //页面触点X坐标
		endY   = Number(touch.pageY); //页面触点Y坐标
		var text = 'TouchStart事件触发:<br>' +'startX:'+ startX + '<br>' +'startY:'+startY;
	//	document.getElementById("test").style.display = "block";
	//	document.getElementById("test").innerHTML = text;
	}
	catch(e){
		alert('touchSatrtFunc：' + e.message);
	}
}

var zhiBoTemp = 0;
var zhiBoPos = 0;
function changeZhiBo(){
	zhiBoPos = parseInt( (document.body.scrollTop+clientHeight/2)/clientHeight );
//	getID("test").style.display = "block";
//	getID("test").innerHTML = $(document).height() +"<br>scrollTop_"+ document.body.scrollTop+"<br>clientHeight_"+clientHeight+"<br>zhiBoPos_"+zhiBoPos;				
//	getID("zhiBo"+zhiBoTemp ).pause();
//	getID("zhiBo"+zhiBoPos).play();
	zhiBoTemp = zhiBoPos;
}

function touchMoveFunc(evt){
	try{
		evt.preventDefault(); //阻止触摸时浏览器的缩放、滚动条滚动等
		var touch = evt.touches[0]; //获取第一个触点
		endX = Number(touch.pageX); //页面触点X坐标
		endY = Number(touch.pageY); //页面触点Y坐标
		var moveX = endX-startX;
		var moveY = endY-startY;
	//	var text = 'TouchMove事件触发:<br>' +'endX:'+endX + '<br>' +'endY:'+ endY+'<br>moveX:'+moveX+'<br>moveY:'+moveY;
	//	document.getElementById("test").style.display = "block";
	//	document.getElementById("test").innerHTML = text;
		if(moveX<0 && Math.abs(moveX)>Math.abs(moveY) && startY>850 && tab1<tab1Arr["data"].length-1 && (indexArea=="home" || indexArea == "vod" || indexArea=="live") ){	//只能向左移
			if( tab1==-1){
				document.getElementById("channel").style.left = moveX+"px";
			}else{
				document.getElementById("vodList"+tab1).style.left = moveX+"px";
			}			
		}

		if( moveY != 0 && indexArea=="zhiBo"){	//上下滑
			changeZhiBo();
		}
	}
	catch(e){
		alert('touchMoveFunc：' + e.message);
	}
}

function touchEndFunc(evt){
	try{
	//	evt.preventDefault(); //阻止触摸时浏览器的缩放、滚动条滚动等
		var moveX = endX-startX;
		var moveY = endY-startY;
		var text = 'TouchEnd事件触发:<br>' +'startX:'+startX+'<br>'+'startY:'+startY;
		text += '<br>'+'moveX:'+moveX+'<br>'+'moveY:'+moveY+'<br>scrollTop:'+document.body.scrollTop;
	//	document.getElementById("test").style.display = "block";
	//	document.getElementById("test").innerHTML = text;
		if( tab1>-1 ){	//非直播
			if( indexArea=="home" || indexArea == "vod" || indexArea=="live" ){		//只在首页和直播时滑动
				if( moveX < -500 && Math.abs(moveX)>Math.abs(moveY) && startY>1050){//左滑
					moveChangeTag(1);
				}else if(moveX > 500 && Math.abs(moveX)>Math.abs(moveY) && startY>1050){//右滑
					moveChangeTag(-1);
				}
			}			
		}else if( tab1==-1){	//直播
			if( moveX < -500 && Math.abs(moveX)>Math.abs(moveY) && startY>1050){//左滑
				moveChangeGroup(1);
			}else if( moveX > 500 && Math.abs(moveX)>Math.abs(moveY) && startY>1050){//右滑
				moveChangeGroup(-1);
			}
		}			
		
	//	if( moveY < -0 && Math.abs(moveX)<Math.abs(moveY) ){	//向上滑动	
		if( moveY < -0 ){	//向上滑动
		//	var loadMoreBottom = $(document).height() - document.body.scrollTop - $(window).height();
		//	alert(loadMoreBottom);
			if( indexArea!="home"  && indexArea!="detail" && indexArea!="zhiBo"){
				loadMore();
			}
			if( indexArea=="zhiBo" ){
				if(zhiBoTemp!=zhiBoPos){
			//		getID("zhiBo"+zhiBoTemp ).pause();
				}
				changeZhiBo();
			}
		}
		
		if( moveY > 0 && Math.abs(moveX)<Math.abs(moveY) ){ //向下滑动			
			if( indexArea=="zhiBo" ){
				if(zhiBoTemp!=zhiBoPos){
			//		getID("zhiBo"+zhiBoTemp ).pause();
				}
				changeZhiBo();
			}
		}
		
		if( moveX > -500 ){	//移动距离不满足切换类型时，向右返回当前页面
			if(tab1==-1){
				document.getElementById("channel").style.left = "0px";	
			}else{
				document.getElementById("vodList"+tab1).style.left = "0px";
			}			
		}


	}
	catch(e){
		alert('touchEndFunc：' + e.message);
	}
}

//绑定事件
function bindEvent(){
	document.addEventListener('touchstart', touchSatrtFunc, false);
	document.addEventListener('touchmove', touchMoveFunc, false);
	document.addEventListener('touchend', touchEndFunc, false);
}



//判断是否支持触摸事件，可以不要这个函数
function isTouchDevice(){
//	document.getElementById("test").style.display = "block";
//	document.getElementById("test").innerHTML = navigator.appVersion;
	try{
		document.createEvent("TouchEvent");
	//	alert("支持TouchEvent事件！");
		bindEvent(); //绑定事件
	}
	catch(e){
	//	alert("不支持TouchEvent事件！" + e.message);
	}
}	