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
	if (tag1Temp > tabArr[1].length-1) {
		tag1Temp = tabArr[1].length-1;
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
		if(moveX<0 && Math.abs(moveX)>Math.abs(moveY) && startY>850 && tab1<tabArr[1].length-1 && (indexArea=="home" || indexArea == "vod" || indexArea=="live") ){	//只能向左移
			if( tab1==-1){
			//	document.getElementById("channel").style.left = moveX+"px";
			}else{
			//	document.getElementById("vodList"+tab1).style.left = moveX+"px";
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
		
		if( tab1==0 ){ //首页向下或向右滑动 刷新页面	alert(moveX+"_"+moveY);
			if(  moveY > 900  || moveX > 800 ){
			//	alert("我要刷新了\n首页向下或向右滑很多才会刷新\n这是为调试使用的\n上线后会取消");
				location.href = "./indexM.php?"+Math.random();
			}
		}
		if( indexArea=="home" || indexArea == "vod" ){
			if( moveX < -100 && Math.abs(moveX)>Math.abs(moveY) && startY>300){//左滑
				moveChangeTag(1);
			}else if(moveX > 200 && Math.abs(moveX)>Math.abs(moveY) && startY>300){//右滑
				moveChangeTag(-1);
			}
		}else if( (indexArea == "me" || indexArea == "login") && ( moveX < -300 || moveX > 300 || moveY > 300 || moveY < -300)){
			if( typeof(window.androidJs)=="undefined" && getCookie("username") && getCookie("username").length>0 ){ //个人中心有用户名时可以滑出
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
		if( indexArea=="zhiBo" && moveY > 0 ){	//这段是老版本主播有的，可以删掉
			if(zhiBoTemp!=zhiBoPos){
		//		getID("zhiBo"+zhiBoTemp ).pause();
			}
			changeZhiBo();
		}*/
		
		if( moveY < -0 ){	//向上滑动	var loadMoreBottom = $(document).height() - document.body.scrollTop - $(window).height();	alert(loadMoreBottom);
			if( indexArea!="home"  && indexArea!="detail" && indexArea!="zhiBo" && indexArea!="live"){
				loadMore();
			}
			if( indexArea=="zhiBo" ){
				if(zhiBoTemp!=zhiBoPos){
			//		getID("zhiBo"+zhiBoTemp ).pause();
				}
				changeZhiBo();
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