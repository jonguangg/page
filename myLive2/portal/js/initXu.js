var clientWidth = 1080;
var clientHeight = 1920;
	
function imOnLine() { //上报在线状态
	var now = new Date(); //此时此刻
	var sec = now.getSeconds(); //此时的秒
	//因为后台是每个被5整除的分钟时下线所有机顶盒，所以机顶盒要在下线后（延时1分钟）上报在线状态
	//如果当前分钟正好被5整除，则说明此时后台刚刚下线所有机顶盒，前端延时1分钟上线当前机顶盒 60-sec是为了精确到秒
	//如果当前分钟离整5有1、2、3、4分钟，则分别延时1、2、3、4分钟。用6减模5余几的数，就是要延时的时间
	var ms = (now.getMinutes() % 5 == 0) ? 60 - sec : (6 - now.getMinutes() % 5) * 60 - sec;
	//	var ms = ( (6-now.getMinutes()%5)*60>300 )?60-sec:(6-now.getMinutes()%5)*60-sec;
	//	var ms = ( (6-now.getMinutes()%5)*60000>300000 )?60000-sec*1000:(6-now.getMinutes()%5)*60000-sec*1000;
	//	sn = ( sn )?sn:window.androidJs.JsGetCookie("sn",0);
	st = setTimeout(function() {
		sendAjax("./ajax.php", "imOnlineSN=" + sn);
		imOnLine();
	}, ms * 1000);
}

var xmlHttp; //1.创建XMLHttpRequest对象
//var xmlHttp = new XMLHttpRequest();// 1.创建XMLHttpRequest对象(不兼容浏览器)
function createXmlHttpRequestObject() {
	if (window.ActiveXObject) { //如果在internet Explorer下运行
		try {
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		} catch (e) {
			xmlHttp = false;
		}
	} else {
		try { //如果在Mozilla或其他的浏览器下运行
			xmlHttp = new XMLHttpRequest();
		} catch (e) {
			xmlHttp = false;
		}
	}
	if (!xmlHttp) { //返回创建的对象或显示错误信息
		alert("返回创建的对象或显示错误信息");
	} else {
		return xmlHttp;
	}
}

var backArea = "false";
var expireTime = "";
var intExpireTime = "";
function sendAjax(_url, _content) {
	createXmlHttpRequestObject();
	// 2.请求行
	xmlHttp.open("POST", _url); //"./isOnLine.php");
	// 3.请求头
	xmlHttp.setRequestHeader('Content-Type', ' application/x-www-form-urlencoded');
	// 4.设置数据
	xmlHttp.send(_content); //'sn='+sn);
	// 5.监听服务器响应
	xmlHttp.onreadystatechange = function() {
		if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
			if (_content.indexOf('checkLicenseSN') > -1) {
				expireTime = xmlHttp.responseText.slice(xmlHttp.responseText.indexOf("expireTime") + 10);
				intExpireTime = xmlHttp.responseText.slice(xmlHttp.responseText.indexOf("Succeed") + 7, 15);
				setCookie("expireTime", expireTime, "8h");
				setCookie("intExpireTime", intExpireTime, "8h");
				if (parseInt(intLoginTime) > parseInt(intExpireTime)) { //授权已过期
					setTimeout(function() {
						scrollTo(0, 0);
						getID("cardKey").style.display = "block";
						getID("exp").innerHTML = "Exp. " + expireTime;
						scrollDisable();
						if (typeof(window.androidJs) != "undefined") {
							window.androidJs.JsClosePlayer();
							window.androidJs.JsShowImm();
						}
					}, 10000); //10秒后弹出注册页面
				} else {
					backArea = "true";						
				}
			} else if (_content.indexOf('card') > -1) { //注册卡号
				var clientHeight = window.innerHeight;
				if (xmlHttp.responseText.indexOf("Succeed") > -1) { //成功延期
					expireTime = xmlHttp.responseText.slice(xmlHttp.responseText.indexOf("expireTime") + 10);
					intExpireTime = xmlHttp.responseText.slice(xmlHttp.responseText.indexOf("Succeed") + 7, 15);
					getID("msg").innerHTML = "<br>Succeed ! <br>Your expire time is </br>" + expireTime + "</br>Back to enjoy videos !<br>";
					getID("msg").style.lineHeight = clientHeight * 0.35 * 0.16 + "px"; //多行内容，调整到居中显示
					setCookie("expireTime", expireTime, "8h");
					setCookie("intExpireTime", intExpireTime, "8h");
					backArea = "true";
				} else { //失败
					getID("msg").style.lineHeight = clientHeight * 0.35 + "px"; //只一行内容，行高=div height
					if (xmlHttp.responseText.indexOf("Card") > -1) { //卡号输错了	
						getID("msg").innerHTML = xmlHttp.responseText.slice(xmlHttp.responseText.indexOf("error") + 5);
					} else if (xmlHttp.responseText.indexOf("PIN") > -1) { //密码输错了	
						getID("msg").innerHTML = xmlHttp.responseText.slice(xmlHttp.responseText.indexOf("error") + 5);
					}
				}
				getID("msg").style.background = "linear-gradient(to bottom,green,blue,indigo,violet)";
			}
		}
	}
}

var sn = '';
var deviceBrand = '';
var systemModel = '';
function stbInfo() {
	sn = (typeof(window.androidJs) != "undefined") ? window.androidJs.JsGetMac() : getCookie("snH5");
	deviceBrand = (typeof(window.androidJs) != "undefined") ? window.androidJs.JsGetDeviceBrand() : "";
	systemModel = (typeof(window.androidJs) != "undefined") ? window.androidJs.JsSystemModel() : "";
	deviceBrand = deviceBrand.replace(/\s*/g, ""); //删除空格
	systemModel = systemModel.replace(/\s*/g, ""); //删除空格
	sn = sn + deviceBrand + systemModel; //用厂家型号和MAC拼接成一个新的SN
	var deviceInfo = deviceBrand + "_" + systemModel;
	setCookie("deviceInfo", deviceInfo, '1000d'); //供php页面记录备注
//	setCookie("sn", sn, '1000d'); //供app从后台唤醒时使用
	sendAjax("./indexM2.php", "imOnLineSN=" + sn); //传递当前SN给php页面去获取授权信息
	return sn;
}

setTimeout(function() {	//延时启动上报在线状态的定时器，同时检查授权日期（为兼容用户直接点击跳过，检查授权代码写在splashJump内）
	imOnLine();
	splashJump();
}, 10000);

var mo = function(e) {
	e.preventDefault();
};

function scrollDisable() {
	document.body.style.overflow = 'hidden';
	document.addEventListener("touchmove", mo, {
		passive: false
	}); //禁止页面滑动
}

function scrollEnable() {
	document.body.style.overflow = ''; //出现滚动条
	document.removeEventListener("touchmove", mo, {
		passive: false
	});
}

function androidBack(){	//供返回键调用
	window.androidJs.JsClosePlayer();
	getID("h5video").src = "";
//	alert("from_"+from+"_indexArea1_"+indexArea+"_isZhiBo_"+isZhiBo);
	if( indexArea =="live" ){
		getID("group" + groupId).style.color = 'white';
		getID("channel").style.display = "none";
		getID("vod").style.display = "block";
		indexArea = "home";
		navPos = 0;
		scrollTo(0,0);
	}else if( indexArea == "detail" ){
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

function updateCookie() {
	if (typeof(window.androidJs) != "undefined") {
		window.androidJs.JsSetCookie("groupId", groupId, '12h');
		window.androidJs.JsSetCookie("channelPos", channelPos, '12h');
		//	window.androidJs.JsSetCookie("videoUrlCookie",channelTempArr[channelPos].videoUrl,'12h');
	}
}

var preLoadImageArr = ["直播0.png","電影1.png","劇集1.png","動漫1.png","短视频1.png","體育1.png","綜藝1.png","search1.png","history1.png","collect1.png","vipCard.png","promptBg.png","loading.gif","loading2.gif"];

function preLoadImages(){
	for(i=0;i<preLoadImageArr.length;i++){
		getID("preLoadImg").innerHTML += '<img src=img/'+preLoadImageArr[i]+'>';
	}
}

//	var total = 0;
function startCircle(){
	var minute = 0;
	var second = 10;
	var total = (parseInt(minute)*60) + parseInt(second);
	var circle = getID("cls");
//    circle.style.strokeDashoffset = "800";
	circle.style.animationDuration = total+"s";
	circle.style.animationPlayState = "running";
//    set(1000*total);
	circle.classList.add("run-anim");
}

function splashJump(){
	if( getID('splash') ){	//加这个是为了兼容浏览器访问
		sendAjax("./ajax.php", "checkLicenseSN=" + sn);
		getID('splash').style.display='none';
		if( indexArea=="lock"){	//如果设置了启动默认锁定		
			getID('lock').style.display='block';
			getID("lock").style.height = clientHeight + "px"; //解锁页面的高，即全屏高度
		}else{					//如果没设启动默认锁定，则启动后就进入首页
		//	if( navPos==0){
				getID("vod").style.opacity = 1;
		//	}			
			scrollEnable();
		}
	}
//	requestFullScreen(document.documentElement);
//	getID("bodys").className = "full";
}

function requestFullScreen(element){
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

var fingers = "";
//	var hasConsole = typeof console !== "undefined";
var fingerprintReport = function () {
    var d1 = new Date();

    Fingerprint2.get(function(components) {
        var murmur = Fingerprint2.x64hash128(components.map(function (pair) { return pair.value }).join(), 31);
        var d2 = new Date();
        var time = d2 - d1;
        var details = "";

    //    if(hasConsole) {
        //    console.log("time", time);
        //    console.log("fingerprint hash", murmur);
            fingers += murmur;
        //    alert(fingers);
    //    }
        for (var index in components) {
            var obj = components[index];
            var line = obj.key + " = " + String(obj.value).substr(0, 100);
        //    if (hasConsole) {
            //	console.log(line)
        //    }
            details += line + "\n";
        }
    })
}

var cancelId;
var cancelFunction;

if (window.requestIdleCallback) {
    cancelId = requestIdleCallback(fingerprintReport);
    cancelFunction = cancelIdleCallback;
} else {
    cancelId = setTimeout(fingerprintReport, 500);
    cancelFunction = clearTimeout;
}

function changeDefaultSpeed(){
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