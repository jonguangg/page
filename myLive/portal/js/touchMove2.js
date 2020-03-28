	
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

function touchMoveFunc(evt){
	try{
		//evt.preventDefault(); //阻止触摸时浏览器的缩放、滚动条滚动等
		var touch = evt.touches[0]; //获取第一个触点
		endX = Number(touch.pageX); //页面触点X坐标
		endY = Number(touch.pageY); //页面触点Y坐标
		var moveX = endX-startX;
		var moveY = endY-startY;
	//	var text = 'TouchMove事件触发:<br>' +'endX:'+endX + '<br>' +'endY:'+ endY+'<br>moveX:'+moveX+'<br>moveY:'+moveY;
	//	document.getElementById("test").style.display = "block";
	//	document.getElementById("test").innerHTML = text;
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
		if( navPos>-1 ){	//非直播
			if( moveX < -500 && Math.abs(moveX)>Math.abs(moveY) && startY>1050){//左滑
				moveChangeTag(1);
			}else if(moveX > 500 && Math.abs(moveX)>Math.abs(moveY) && startY>1050){//右滑
				moveChangeTag(-1);
			}			
		}else if( navPos==-1){	//直播
			if( moveX < -500 && Math.abs(moveX)>Math.abs(moveY) && startY>1050){//左滑
				moveChangeGroup(1);
			}else if( moveX > 500 && Math.abs(moveX)>Math.abs(moveY) && startY>1050){//右滑
				moveChangeGroup(-1);
			}
		}			
		
		if( moveY < -10 && Math.abs(moveX)<Math.abs(moveY) ){
	//		text += '<br/>向上滑动';
			loadMore();
		}
		
		if( moveY > 200 && Math.abs(moveX)<Math.abs(moveY) ){
	//		text += '<br/>向下滑动';
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