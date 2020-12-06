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
	if( !getCookie("language")){
		getID("language").style.display = "block";
		getID("language").style.height = clientHeight+"px";
	}
	if( typeof(window.androidJs)=="undefined" && (!getCookie("username") || getCookie("username").length<1) ){
		showMe();
		isGuideMe = 1;
		setCookie("isGuideMe",1  ,"1000d");
	}else{			
		scrollEnable();		
		getID("loading").style.display = "none";
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
		getID("loading").style.display = "block";
		if( typeof(window.androidJs)!="undefined"){	//apk
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
				getID("loading").style.display = "none";
			}else if( from=="zone"){
				getID("zone").style.display = "block";
				getID("loading").style.display = "none";
			}else{				
				getID("vod").style.opacity = 1;
				setTimeout(function(){
					getID("vod").style.display = "block";
					getID("loading").style.display = "none";
				},1000); //否则进入详情后马上按返回，会黑屏
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
	}else if( indexArea == "me" || indexArea == "login"){
		scrollEnable();
		indexArea = "home";
		getID("me").style.opacity = 0;
		setTimeout(function(){
			getID("me").style.display = "none";			
			getID("me").style.opacity = 1;	
		},1000);
	}else if( indexArea == "share"){
		indexArea = "me";
		getID("share").style.display = "none";
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

var language = getCookie("language");
function changeLanguage(){
	language = ( language=="c" )?"e":"c";
	setCookie("language",language,"1000d");
	getID("defaultLanguage").innerHTML = (language=="c")?"中文":"English";
	showMe();
}

function changeLanguages(_language){
	language = _language;
	setCookie('language',_language,'1000d');
	getID('language').style.display='none';
	getID('emailInput').placeholder = (language=="c")?"請輸入已註冊的郵箱":"Email";
	getID('passwordInput').placeholder = (language=="c")?"請輸入密碼":"Password";
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

	function showShare(){
		indexArea = "share";
		getID('share').style.display = 'block';
		getID('share').style.height = clientHeight+'px';
		getID('shareImg').style.height = clientWidth*0.8+'px';
		getID('shareShare').style.display = "none";
	//	getID('shareShare').style.top = (clientWidth*0.8+100)+'px';
		if( typeof(window.androidJs) == "undefined" ){	//浏览器	
			getID('shareCancle').style.top = (clientWidth*0.8+300)+'px';	
			getID('shareDownload').style.top = (clientWidth*0.8+100)+'px';
			getID("shareDownloads").innerHTML = (language=="c")?"保存二维码":"Download QR code";
			getID("shareCancle").innerHTML = (language=="c")?"取&emsp;消":"Cancle";

			if( !isIOS ){	//安卓
			//	getID("shareDownloads").innerHTML = "Download";
			}else{
			//	getID("shareDownloads").innerHTML = "<a style='text-decoration:none;color:white;' href='http://128.1.160.114:925/myLive/portal/img/shareIOS.png' download='MixTV.png'>Download</a>";
			}
		}else{	//apk
			getID('shareDownload').style.display = "none";
			getID('shareCancle').style.top = (clientWidth*0.8+200)+'px';
		}
	}

	function shareShare(){
		
	}

	function shareDownload(){
		if( isIOS ){
			if( language=="c"){
				alert("请长按二维码，存储图像");
			}else{
				alert("Please long press the QR code \nto download the image");
			}			
		}else{
			var save_link = document.createElementNS('http://www.w3.org/1999/xhtml', 'a');		
			if( typeof(window.androidJs) == "undefined" ){	//浏览器
			//	save_link.href = "http://128.1.160.114:925/myLive/portal/img/shareIOS.png";
				save_link.href = "http://mixip.mixtvapp.com/myLive/portal/img/shareIOS.png";
			}
			save_link.download = "MixTV.png";
			var event=document.createEvent('MouseEvents');
			event.initMouseEvent('click',true,false,window,0,0,0,0,0,false,false,false,false,0,null);
			save_link.dispatchEvent(event);
		}
	};

	function shareDownload2(){	//这个IOS没用，放这做备份
		var x=new XMLHttpRequest();
		x.open("GET", "http://128.1.160.114:925/myLive/portal/img/shareIOS.png", true);
		x.responseType = 'blob';
		x.onload=function(e){
			var url = window.URL.createObjectURL(x.response)
			var a = document.createElement('a');
			a.href = url
			a.download = 'MixTV'
			a.click()
		}
		x.send();
	}

var guideIndex = 0;
var isGuideMe = ( getCookie("isGuideMe") )?getCookie("isGuideMe"):1;
var isGuideHome = ( getCookie("isGuideHome") )?getCookie("isGuideHome"):1;
var isGuideZone = ( getCookie("isGuideZone") )?getCookie("isGuideZone"):1;
var isGuideDetail = ( getCookie("isGuideDetail") )?getCookie("isGuideDetail"):1;

function showGuide(){
	scrollDisable();
	getID("guideOk").innerHTML = (language=="c")?"朕 知 道 了":"I got it";
	if( indexArea=="home" ){
		if( isGuideHome==1 ){				
			getID("guide").style.display = "block";
			getID("redArrow").style.display = "block";
			if( guideIndex==0 ){
				getID("redArrow").style.left = "190px";
				getID("guideContent").innerHTML = (language=="c")?"<br>点击箭头指向的区域<br>进入个人中心<br>&ensp;":"<br>Enter personal center<br>&ensp;";
				getID("leftUpLogo").style.border = "5px red solid";
				getID("leftUpLogo").style.webkitAnimation = "myBorder 3s infinite alternate";
			}else if( guideIndex==1 ){
				getID("redArrow").style.left = "755px";
				getID("guideContent").innerHTML = (language=="c")?"<br>点击箭头指向的区域<br>搜索影片<br>可点击输入法的Enter<br>提交搜索<br>&ensp;":"<br>Search movies<br>Can click enter to submit<br>&ensp;";
				getID("leftUpLogo").style.border = "0px red solid";
				getID("leftUpLogo").style.webkitAnimation = "";
				getID("searchImg").style.border = "5px red solid";
				getID("searchImg").style.webkitAnimation = "myBorder 3s infinite alternate";
			}else if( guideIndex==2){
				getID("redArrow").style.left = "885px";
				getID("guideContent").innerHTML = (language=="c")?"<br>点击箭头指向的区域<br>显示播放历史<br>&ensp;":"<br>Enter history page<br>&ensp;";
				getID("searchImg").style.border = "0px red solid";
				getID("searchImg").style.webkitAnimation = "";
				getID("historyImg").style.border = "5px red solid";
				getID("historyImg").style.webkitAnimation = "myBorder 3s infinite alternate";
			}else if( guideIndex==3 ){
				getID("redArrow").style.left = "0px";
				getID("redArrow").style.transform = "rotate(90deg)";
				getID("guideContent").innerHTML = (language=="c")?"<br>在精选页面<br>从屏幕左侧向右滑<br>重新加载数据<br>&ensp;":"Slide from left to right <br>at any area of major page<br>to refresh page";
				getID("historyImg").style.border = "0px red solid";
				getID("historyImg").style.webkitAnimation = "";
			}else if( guideIndex==4 ){
				getID("guide").style.display = "none";
				getID("redArrow").style.display = "none";
				isGuideHome = 0;
				setCookie("isGuideHome",0,"1000d");
				scrollEnable();
			//	isGuideMe = 1;
				guideIndex = 0;
			}
		}else{
			getID("guide").style.display = "none";
			scrollEnable();
		}
	}else if( indexArea=="detail" ){
		if( guideIndex==1){
			getID("guideContent").innerHTML = (language=="c")?"<br>点击剧情内容<br>展开或收缩全部剧情<br>&ensp;":"<br>Click the plot<br>show or shrinkage the all plot<br>&ensp;";
		}else{
			getID("guide").style.display = "none";
			setCookie("isGuideDetail",0,"1000d");
			isGuideDetail = 0;
			scrollEnable();
			guideIndex = 0;
		}
	}else if( indexArea=="me" ){
		getID("guide").style.display = "none";
		isGuideMe = 0;
		setCookie("isGuideMe",0,"1000d");
	//	scrollEnable();
	}else if( indexArea=="zone"){
		getID("zoneLogo").style.border = "0px red solid";		
		getID("zoneLogo").style.webkitAnimation = "";
		if( guideIndex==1 ){
			getID("redArrow").style.display = "none";
			getID("zoneRemark").style.border = "5px red solid";
			getID("zoneRemark").style.webkitAnimation = "myBorder 3s infinite alternate";
			getID("guideContent").innerHTML = (language=="c")?"<br>点击专题简介<br>展开或收缩全部简介<br>&ensp;":"<br>Click the introduction of the zone<br>show or shrinkage the all<br>&ensp;";
		}else{
			scrollEnable();
			isGuideZone = 0;
			setCookie("isGuideZone",0,"1000d");
			getID("guide").style.display = "none";
			getID("zoneRemark").style.border = "0px red solid";
			getID("zoneRemark").style.webkitAnimation = "";
		}
	}
}