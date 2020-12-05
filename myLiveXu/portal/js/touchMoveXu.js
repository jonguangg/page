function moveChangeGroup(_num) { //滑动切换直播分类
	var groupIdTemp = groupId;
	groupIdTemp += _num;
	if (groupIdTemp < 0) {
		groupIdTemp = 0;
	}
	if (groupIdTemp > channelDataArr.length - 1) {
		groupIdTemp = channelDataArr.length - 1;
	}
	showChannel(groupIdTemp);
}

function moveChangeTag(_num) { //滑动切换分类
	getID("vodList"+tab1).style.left = "0px";
	var tag1Temp = tab1;	//如果此时直接改tab1,就无法在切换栏目时通过clickTab1修改相关参数
	tag1Temp += _num;
	if (tag1Temp < 0) {
		tag1Temp = 0;
	}
	if (tag1Temp > tab1Arr["data"].length-1) {
		tag1Temp = tab1Arr["data"].length-1;
	}
	if( tag1Temp>0){
		getID("loading"+tag1Temp).style.display = "block";
	}
	clickTab1(tag1Temp);
}

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
			//	document.getElementById("channel").style.left = moveX+"px";
			}else if(tab1 > 0){
			//	document.getElementById("vodList"+tab1).style.left = moveX+"px";
			}			
		}
	}catch(e){
		alert('touchMoveFunc：' + e.message);
	}
}

var ifMoveLoop = false;
function touchEndFunc(evt){
	try{	//	evt.preventDefault(); //阻止触摸时浏览器的缩放、滚动条滚动等
		var moveX = endX-startX;
		var moveY = endY-startY;
	//	var text = 'TouchEnd事件触发:<br>' +'startX:'+startX+'<br>'+'startY:'+startY;
	//	text += '<br>'+'moveX:'+moveX+'<br>'+'moveY:'+moveY+'<br>scrollTop:'+document.body.scrollTop;		
		
		if( indexArea=="home" && tab1==0 ){ //首页向下或向右滑动 刷新页面	alert(moveX+"_"+moveY);
			if( moveY >900  || moveX >800 ){//alert("我要刷新了\n首页向下或向右滑很多才会刷新\n这是为调试使用的\n上线后会取消");
				var currUrl = window.location.href;
				currUrl = currUrl.replace("#","");
			//	location.href = "./indexMx.php?"+Math.random();
				location.href = currUrl+"?"+Math.random();
			}else if(startY > 300 && startY < 700 ){
				ifMoveLoop = true;
				if( moveX > 100 ){
					moveHomeLoop(-1);
				}else if(moveX < -100 ){
					moveHomeLoop(1);
				}
				setTimeout( ifMoveLoop = false,5000);	
			}
		}
		if( tab1>0 && (indexArea=="home" || indexArea == "vod") ){//首页非Major
			if( moveX < -300 && Math.abs(moveX)>Math.abs(moveY) && startY>1050){//左滑
				moveChangeTag(1);
			}else if(moveX > 300 && Math.abs(moveX)>Math.abs(moveY) && startY>1050){//右滑
				moveChangeTag(-1);
			}
		}else if( indexArea=="detail" && isGuideDetail==0 ){//详情页左、右、下滑返回首页	alert("X_"+moveX+"_Y_"+moveY+"_startY_"+startY);
			if( startY < (videoHeight-200) && ( moveX < -200 || moveX > 200 || moveY < -200 || moveY > 200 ) ){
				updateCurrentTime();
				getID("vod").style.display = "block";
				getID("detail").style.left = "-2000px";
			//	scrollTo(0,scrollTops);
				setTimeout(function(){androidBack();},300);			
			}
			if( startY < 900 && startY > (videoHeight+100)){	//视频下主演上这个区域左右滑返回
				if( moveX < -200 || moveX > 200 ){
					updateCurrentTime();
					getID("vod").style.display = "block";
					getID("detail").style.left = "-2000px";
			//		scrollTo(0,scrollTops);
					setTimeout(function(){androidBack();},300);
				}
			}
			if( moveY > 700 ){	//详情页下滑返回
				updateCurrentTime();
				getID("vod").style.display = "block";
				getID("detail").style.left = "-2000px";
			//	scrollTo(0,scrollTops);
				setTimeout(function(){androidBack();},300);
			}
		}else if( (indexArea == "me" || indexArea=="share"|| indexArea == "login") && ( moveX < -300 || moveX > 300 || moveY > 300 || moveY < -300)){
			if( indexArea=="share" ){	
				indexArea = "me";			
				getID("share").style.display = "none";
				return;
			}
			if( isGuideMe==0 && typeof(window.androidJs)=="undefined" && getCookie("username") && getCookie("username").length>0 ){ //个人中心有用户名时可以滑出
				scrollEnable();
				indexArea = "home";
				getID("me").style.opacity = 0;
				setTimeout(function(){
					getID("me").style.display = "none";			
					getID("me").style.opacity = 1;	
				},1000);
			}
		}else if( indexArea=="live" ){	//直播
			if( startY < (videoHeight-100) ){	//在播放窗口滑动
				if( moveX<-100 || moveX>100 || moveY<-100 || moveY>100 ){
					androidBack();
				}
			}else if( startY > (videoHeight+100) ){	//在播放窗口下方滑动
				if( moveX < -200 && Math.abs(moveX)>Math.abs(moveY) ){	//左滑
					moveChangeGroup(1);
				}else if( moveX > 200 && Math.abs(moveX)>Math.abs(moveY) ){	//右滑
					moveChangeGroup(-1);
				}
				if( moveY > 600 ){	//下滑
					androidBack();
				}
			}
			getID("liveBack").style.display = "block";
			setTimeout(function(){getID("liveBack").style.display = "none";},3000);
		}
/*
		if( moveX > -200 ){	//移动距离不满足切换类型时，向右返回当前页面
			if(tab1==-1){
				document.getElementById("channel").style.left = "0px";	
			}else{
				document.getElementById("vodList"+tab1).style.left = "0px";
			}			
		}*/
		
		if( moveY < -0 ){	//向上滑动	var loadMoreBottom = $(document).height() - document.body.scrollTop - $(window).height();	alert(loadMoreBottom);
			if( indexArea!="home"  && indexArea!="detail" && indexArea!="live"){
				loadMore();
			}
		}

	}catch(e){
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