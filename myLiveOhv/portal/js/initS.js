document.onsystemevent = eventHandler;
//document.onkeypress    = eventHandler;
document.onirkeypress  = eventHandler; 
function eventHandler(e,type){	//按键
	var key_code = "";
	if(navigator.userAgent.indexOf('iPanel')!=-1){
		key_code=iPanelKey();
	}else key_code = e.code ;
	switch(key_code){
		case "KEY_SELECT":
			if( indexArea=="search" ){
			//	alert(getID('searchInput').value );
				showSearchInput();
			}else if( indexArea=="register" ){
				checkInput();
			}else if( indexArea=="login"){
				if( getID('usernameInput').value.length>0 ){
					username = getID('usernameInput').value;
					sn = getID('usernameInput').value+fingers;
					setCookie("username",username,"1000d");
					setCookie("deviceInfo",username,"1000d"); //供php页面记录备注
					setCookie("sn",sn,"1000d");
					getID("promptMe").innerHTML = "Success";
					getID("promptMe").style.opacity = 1;
					setTimeout(function() {
						getID("promptMe").style.opacity = 0;
						location.href = "./indexM.php";
					}, 1500);
				}
			}
			return 0;
			break;
	}	
}

function splashJump(){
	getID('splash').style.display='none';
	if( typeof(window.androidJs)=="undefined" && (!getCookie("username") || getCookie("username").length<1) ){
		showMe();
	}else{			
		scrollEnable();
	}
	sendAjax("./ajax.php", "checkLicenseSN=" + sn);	//检查到期日期
	if( indexArea=="lock"){	//如果设置了启动默认锁定
		scrollDisable();	
		getID('lock').style.display='block';
		getID("lock").style.height = clientHeight + "px"; //解锁页面的高，即全屏高度
	}else{	//如果没设启动默认锁定，则启动后就进入首页
		getID("vod").style.display = "block";
		getID("vod").style.opacity = 1;
	}
}

function androidBack(){	//供返回键调用	alert("from_"+from+"_indexArea1_"+indexArea+"_isZhiBo_"+isZhiBo);
	if( typeof(window.androidJs)!="undefined"){
		window.androidJs.JsClosePlayer();
	}
	if( indexArea =="live" ){
		getID("vod").style.display = "block";
		getID("group" + groupId).style.color = 'white';
		getID("channel").style.display = "none";
		getID("liveVideo").src = "";
		indexArea = "home";
		navPos = 0;
		tab1 = 0;
		scrollTo(0,0);
	}else if( indexArea == "detail" ){
		getID("h5video").src = "";
		indexArea = from;
		getID("vod").style.opacity = 1;
		getID("detail").style.display = "none";
		if( from=="search" || from=="history" ||from=="collect" || from=="detail"){
			getID("searchHistoryCollect").style.display = "block";
		}
		scrollTo(0,scrollTops);
	}else if( indexArea == "zhiBo"){
		if( isZhiBo ){	//先退出播放窗口
			isZhiBo = false;
			window.androidJs.JsSetPageArea("zhiBo");
		}else{	//再退出直播界面
		//	getID("zhiBo"+zhiBoPos).pause();
			getID("zhiBo").style.display = "none";
			indexArea = "home";
			showTabList1(0);
			scrollTo(0,0);
		}
	}else if( indexArea == "me" || indexArea == "login"){
		scrollEnable();
		indexArea = "home";
		getID("me").style.opacity = 0;
		setTimeout(function(){
			getID("me").style.display = "none";			
			getID("me").style.opacity = 1;	
		},1000);
	}else if( typeof(window.androidJs)=="undefined" && (indexArea=="home" || indexArea=="vod") ){
		alert("请按 home 键退出");
	}
}

function updateCookie(){
	if (typeof(window.androidJs) != "undefined") {
		window.androidJs.JsSetCookie("groupId", groupId, '12h');
		window.androidJs.JsSetCookie("channelPos", channelPos, '12h');
		//	window.androidJs.JsSetCookie("videoUrlCookie",channelTempArr[channelPos].videoUrl,'12h');
	}
}

function requestFullScreen(element){	//全屏
	var requestMethod = element.requestFullScreen || element.webkitRequestFullScreen || element.mozRequestFullScreen || element.msRequestFullScreen;
	if(	requestMethod){
		requestMethod.call(element);
	}else if(typeof window.ActiveXObject !== "undefined"){
		var wscript = new ActiveXObject("WScript.Shell");
		if(wscript !== null){
			wscript.SendKeys("{F11}");
		}
	}
}

function fullscreenH5(){	//全屏
    if( typeof(window.androidJs) == "undefined" ){
        requestFullScreen(getID('h5video'));
    }
}

function changeDefaultSpeed(){	//设置默认播放速度
    if( typeof(window.androidJs) == "undefined" ){
        if( speed<2.5 ){
            speed = parseFloat(speed)+0.25;
        }else{
            speed = 0.5;
        }
        setCookie("speed",speed,"30d");
        getID("defaultSpeed").innerHTML = speed;
    }
}

function orient(){	//旋转屏幕
	if( window.orientation == 0 || window.orientation == 180) {	//竖屏
	//	alert(window.orientation);
	//	$("bodys").attr("class", "portrait");
	//	orientation = 'portrait';
		if( indexArea=="detail"){
		//	getID('h5video').width = clientWidth;
		//	getID('h5video').height = clientWidth*9/16;
		}else if( indexArea=="live"){
		//	getID('liveVideo').height = clientWidth*9/16;
		//	getID("group").style.top = (clientWidth*9/16-1)+"px";
		}
		getID('bodys').style.width = clientWidth + "px";
		getID("bodys").style.transform = "scale(1)";
		return false;
	}else if( window.orientation == 90 || window.orientation == -90) {	//横屏
	//	alert(window.orientation);
	//	$("h5video").attr("class", "landscape");
	//	orientation = 'landscape';
		scrollTo(0,0);
		if( indexArea=="detail"){
		//	getID('detailPoster').style.zIndex ="999";
		//	getID('h5video').width = clientHeight;	//横屏宽高对换
		//	getID('h5video').height = clientWidth-64;
		}else if( indexArea=="live"){
		//	getID('liveVideo').height = clientWidth-64;
		//	getID("group").style.top = (clientWidth-64)+"px";
		}
		getID('bodys').style.width = clientHeight + "px";
		getID("bodys").style.transform = "scale(1)";
		return false;
	}
}

window.addEventListener("orientationchange", function() {
	orient();
//	alert(window.orientation);
}, false);

//改写H5返回键事件
window.addEventListener("popstate", function(e) { 
//	alert("我监听到了浏览器的返回按钮事件啦");
	if( indexArea=="detail" || indexArea=="live" || indexArea=="me" || indexArea=="login" ){
		pushHistory(); 
		getID("vod").style.display = "block";
		if( typeof(window.androidJs)!="undefined"){
			window.androidJs.JsClosePlayer();
		}
		if( indexArea=="detail"){
			updateCurrentTime();
			getID("detail").style.left = "-2000px";
		}else if( indexArea=="live"){
			getID("channel").style.display = "none";
		}
		setTimeout(function(){androidBack();},1000);
	}
}, false);
function pushHistory() { 
	var state = { 
		title: "title", 
		url: "#"
	}; 
	window.history.pushState(state, "title", "#"); 
}

if( typeof(window.androidJs)=="undefined"){
	pushHistory(); 
}	

//	监听切换前后台
var hiddenTime = getCookie("hiddenTime")?getCookie("hiddenTime"):0;	// 切到后台的时间点 
function getTime(){
	return parseInt(Date.now()/1000);
}	
document.addEventListener("visibilitychange", function() {	//IOS 
	if( document.visibilityState=='hidden'){
		hiddenTime = getTime();
		setCookie("hiddenTime",hiddenTime,"30d");
	}else{
		var leaveTime = getTime()-hiddenTime;	//切到后台的秒数
		if( leaveTime > 600 ){	//切到后台600秒以上再切回来，才重新记录登陆时间，否则就当作用户切走马上又回来了，这种情况不算是真正离开，所以不重新记录登陆时间
			sendAjax("./ajax.php", "imBackSN=" + sn);
		//	alert( leaveTime+"_"+sn);
		}
	}
});

function changeCollect(_id ){
	$.ajax({
		type: 'POST',
		url: './collect.php',
		data: {
			'id':_id,
			'sn':sn,
		},
		dataType: 'json',
		beforeSend: function() {
			//这里一般显示加载提示;
		},
		success: function(json) {
			var isCollect = json.isCollect;	//这是点击收藏之后的值
			getID("collectImg"+_id).src = ( isCollect==0 )?'img/collect0.png':'img/collect1.png';
			if(isCollect){
				collectArr.push(_id.toString());
			}
			if( getID("collectImgs"+_id)){
				getID("collectImgs"+_id).src = ( isCollect==0 )?'img/collect0.png':'img/collect1.png'; 
			}
			getID("promptCollect").innerHTML = ( isCollect ==1 )?"<b>已收藏</b>":"<b>已取消收藏</b>";  
			getID("promptCollect").style.opacity = 1; 
			setTimeout(function() {
				getID("promptCollect").style.opacity = 0;
			}, 1500);
		},
		error: function() {
		//   alert("error");
		}
	});	
}

var idTemp = 0;
var innerHTMLTemp = "";
function createVideo(_id,_name){
	if( getID("videoImg"+idTemp)){
		getID("videoImg"+idTemp).innerHTML = innerHTMLTemp;
	}
	innerHTMLTemp = getID("videoImg"+_id).innerHTML;
	idTemp = _id;
	var playUrl = "http://158.69.108.183:8080/myLiveOhv/vod/"+_name+"/index.m3u8";
	getID("videoImg"+_id).innerHTML = '<video id="h5Video" style="object-fit:fill;" width="100%" height="100%" autoplay controls  preload="auto" type="application/x-mpegURL" poster="../vod/'+_name+'/poster.jpg" src='+playUrl+' playsinline x5-playsinline webkit-playsinline x-webkit-airplay="true" x5-video-player-fullscreen="true" x5-video-orientation="landscape"></video>';
}