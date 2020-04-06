var clientWidth = 1080;
var clientHeight = 1920;
	
	function imOnLine() { //上报在线状态
		var now = new Date(); //此时此刻
		var sec = now.getSeconds(); //此时的秒
		//因为后台是每个被5整除的分钟时下线所有机顶盒，所以这里要在下线后即时（延时1分钟）上线
		//如果当前分钟正好被5整除，则说明此时后台刚刚下线所有机顶盒，前端延时1分钟上线当前机顶盒 60-sec是为了精确到秒
		//如果当前分钟离整5有1、2、3、4分钟，则分别延时1、2、3、4分钟。用6减模5余几的数，就是要延时的时间
		var ms = (now.getMinutes() % 5 == 0) ? 60 - sec : (6 - now.getMinutes() % 5) * 60 - sec;
		//	var ms = ( (6-now.getMinutes()%5)*60>300 )?60-sec:(6-now.getMinutes()%5)*60-sec;
		//	var ms = ( (6-now.getMinutes()%5)*60000>300000 )?60000-sec*1000:(6-now.getMinutes()%5)*60000-sec*1000;
		//	sn = ( sn )?sn:window.androidJs.JsGetCookie("sn",0);
		//	getID("vodListName1").innerHTML += "_"+now.getMinutes()+":"+sec+sn+"<br>";
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
		sn = (typeof(window.androidJs) != "undefined") ? window.androidJs.JsGetMac() : "";
		deviceBrand = (typeof(window.androidJs) != "undefined") ? window.androidJs.JsGetDeviceBrand() : "";
		systemModel = (typeof(window.androidJs) != "undefined") ? window.androidJs.JsSystemModel() : "";
		deviceBrand = deviceBrand.replace(/\s*/g, ""); //删除空格
		systemModel = systemModel.replace(/\s*/g, ""); //删除空格
		sn = sn + deviceBrand + systemModel; //用厂家型号和MAC拼接成一个新的SN
		var deviceInfo = deviceBrand + "_" + systemModel;
		setCookie("deviceInfo", deviceInfo, '1000d'); //供php页面记录备注
		setCookie("sn", sn, '1000d'); //供app从后台唤醒时使用
		sendAjax("./indexM2.php", "imOnLineSN=" + sn); //传递当前SN给php页面去获取授权信息
		return sn;
	}

	//延时检查授权日期 同时启动上报在线状态的定时器
	setTimeout(function() {
		sendAjax("./ajax.php", "checkLicenseSN=" + sn);
		imOnLine();
		splashJump();
	}, 5000);

	function splashJump(){
		getID('splash').style.display='none';
		if( indexArea=="lock"){	//如果设置了启动默认锁定		
			getID('lock').style.display='block';
		}else{					//如果没设启动默认锁定，则启动后就进入首页
			if( navPos==0){
				getID("vodList0").style.display = "block";
			}			
			scrollEnable();
		}
	}

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