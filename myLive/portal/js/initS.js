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
					setCookie("sn",sn,"1000d");
					getID("promptMe").innerHTML = "Success";
					getID("promptMe").style.opacity = 1;
					setTimeout(function() {
						getID("promptMe").style.opacity = 0;
						location.href = "./indexMx.php";
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
		updateCurrentTime();
		indexArea = from;
		getID("vod").style.display = "block";
		getID("detail").style.left = "-2000px";
	//	getID("detail").style.opacity = 0
	//	setTimeout(function(){
			getID("detail").style.display = "none";
	//		getID("detail").style.opacity = 1;
	//	},1000);
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
	}
//	alert("from_"+from+"_indexArea2_"+indexArea+"_isZhiBo_"+isZhiBo);
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
				getID('h5video').height = clientWidth*9/16;
			}else if( indexArea=="live"){
				getID('liveVideo').height = clientWidth*9/16;
				getID("group").style.top = (clientWidth*9/16-1)+"px";
			}
			getID('bodys').style.width = clientWidth + "px";
			getID("bodys").style.transform = "scale(1)";
			return false;
		}else if( window.orientation == 90 || window.orientation == -90) {	//横屏
		//	alert(window.orientation);
		//	$("h5video").attr("class", "landscape");
		//	orientation = 'landscape';
			if( indexArea=="detail"){
				getID('detailPoster').style.zIndex ="999";
			//	getID('h5video').width = clientHeight;	//横屏宽高对换
				getID('h5video').height = clientWidth-40;
			}else if( indexArea=="live"){
				getID('liveVideo').height = clientWidth-120;
				getID("group").style.top = (clientWidth-120)+"px";
			}
			getID('bodys').style.width = clientHeight + "px";
			getID("bodys").style.transform = "scale(1)";
			scrollTo(0,0);
			return false;
		}
	}

	window.addEventListener("orientationchange", function() {
		orient();
	//	alert(window.orientation);
	}, false);

