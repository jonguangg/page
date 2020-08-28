//	init Second
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
					var password = getID('passwordInput').value;
					if( username.length < 6 ){
						alert("用户名至少6位");
					}else if(password.length < 6 ){
						alert("密码至少6位");
					}else{
						$.ajax({
							type: 'POST',
							url: './login.php',	//写当前的播放记录
							data: {
								'username':username,
								'password':password,
							},
							dataType: 'json',
							beforeSend: function() {
								//这里一般显示加载提示;
							},
							success: function(json) {
							//	alert(json.status);
								if( json.status=="密码错误"){
									alert("密码错误或用户名已被使用");
								}else if( json.status=="注册成功" || json.status=="密码正确"){
									setCookie("username",username,"1000d");
									setCookie("sn",username,"1000d");
									getID("promptMe").innerHTML = "Success"; 
									getID("promptMe").style.opacity = 1;
									setTimeout(function() {
										getID("promptMe").style.opacity = 0;
										location.href = "./indexMx.php?username="+username;
									}, 1500);
								}
							},
							error: function() {
								alert("something error!");
							}
						});
					}

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

function androidBack(){	//供返回键调用	alert("from_"+from+"_indexArea1_"+indexArea);
	if( typeof(window.androidJs)!="undefined"){
		window.androidJs.JsClosePlayer();
	}
	if( indexArea =="live" ){
		getID("vod").style.display = "block";
		if( from=="history" || from=="search" ||from=="collect" ){
			getID("searchHistoryCollect").style.display = "block";	//	隐藏搜索 历史 收藏 海报列表
		}
		getID("group" + groupId).style.color = 'white';
		getID("channel").style.display = "none";
		getID("liveVideo").src = "";
		indexArea = from;
	//	navPos = 0;
		tab1 = tempTab1;
		scrollTo(0,0);
	}else if( indexArea == "detail"){
		if( typeof(window.androidJs)!="undefined"){
			window.androidJs.JsClosePlayer();
			if(from=="zoneC"){
				getID("zoneC").style.display = "block";
			}else if(from=="zone"){
				getID("zone").style.display = "block";
			}else{
				getID("vod").style.display = "block";
			}
			updateCurrentTime();
			getID("detail").style.left = "-2000px";
		}
		setTimeout(function(){
			getID("h5video").src = "";
			if( from=="zoneC"){
				getID("zoneC").style.display = "block";
			}else if( from=="zone"){
			//	getID("zoneC").style.display = "none";
				getID("zone").style.display = "block";
			}else{				
				getID("vod").style.opacity = 1;
				setTimeout(function(){getID("vod").style.display = "block";},1000); //否则进入详情后马上按返回，会黑屏
			}
			getID("detail").style.display = "none";
			if( from=="search" || from=="history" ||from=="collect" || from=="detail"){
				getID("searchHistoryCollect").style.display = "block";
			}
			scrollTo(0,scrollTops);
		},300);
		indexArea = from;
	}else if( indexArea=="zoneC"){
		getID("zoneC").style.display = "none";
		getID("zone").style.display = "block";
		setTimeout(function(){scrollTo(0,scrollTops);},300);
		indexArea = "zone";
	}else if( indexArea=="zone"){		
		getID("vod").style.opacity = 1;
		getID("vod").style.display = "block";
		setTimeout(function(){
			scrollTo(0,scrollTops);
			getID("zone").style.display = "none";
		},300); //否则进入详情后马上按返回，会黑屏
		indexArea = "home";
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
	//	alert("请按 home 键退出");
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
			scrollTo(0,0);
			if( indexArea=="detail"){
				getID('detailPoster').style.zIndex ="999";
			//	getID('h5video').width = clientHeight;	//横屏宽高对换
				getID('h5video').height = clientWidth-64;
			}else if( indexArea=="live"){
				getID('liveVideo').height = clientWidth-64;
				getID("group").style.top = (clientWidth-64)+"px";
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
	window.addEventListener("popstate", function(e) { //	alert("我监听到了浏览器的返回按钮事件啦");
		if( indexArea=="detail" || indexArea=="live" || indexArea=="me" || indexArea=="login" || indexArea=="zoneC" || indexArea=="zone"){
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
		//	setTimeout(function(){androidBack();},300);
			androidBack();
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