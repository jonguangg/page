	var pinTemp = "";
	var pinTemp1 = "";
	var pinTemp2 = "";
	function clearLockKey() { //清除输入的解锁密码
		pinTemp = "";
		getID("lockKey1").innerHTML = "";
		getID("lockKey2").innerHTML = "";
		getID("lockKey3").innerHTML = "";
		getID("lockKey4").innerHTML = "";
	}

	function checkPin(_num) { //解锁
		if (typeof(window.androidJs) != "undefined") {
			window.androidJs.JsVibrate(40);
		}
		if (indexArea == "lock" || indexArea == "alterCheck") { //输入解锁密码
			if (_num == 10) { //修改密码
				clearLockKey();
				indexArea = "alterCheck";
				getID("prompt").innerText = "Check your old key";
			} else if (_num == 11) { //清除
				clearLockKey();
			} else if (pinTemp.length < 4) { //不到4位就可以输入
				pinTemp += _num;
				getID("lockKey" + pinTemp.length).innerText = "*";
				if (pinTemp == userKey) { //密码正确
					if (indexArea == "alterCheck") { //如果是要改密码
						indexArea = "alter";
						getID("prompt").innerText = "Enter your new key";
						clearLockKey();
					} else { //密码正确就隐藏解锁界面并显示点播列表
						indexArea = "live";
						getID("lock").style.display = "none";
						getID("vodList0").style.display = "block";
						var clientWidth = document.body.scrollWidth;
						scrollEnable();
					}
				}
			}
			if (pinTemp.length == 4 && pinTemp != userKey) { //密码输入错误
				clearLockKey();
				getID("prompt").innerHTML = "Please try again";
			}
		} else if (indexArea == "alter") { //修改密码
			if (_num == 11) { //清除
				clearLockKey();
			} else if (pinTemp.length < 4) { //不到4位就可以输入
				pinTemp += _num;
				getID("lockKey" + pinTemp.length).innerText = "*";
			}
			if (pinTemp.length == 4) { //密码输入4位了
				pinTemp1 = pinTemp;
				clearLockKey();
				indexArea = "alter2";
				getID("prompt").innerText = "Enter new key again";
			}
		} else if (indexArea == "alter2") { //输入新密码
			if (_num == 11) { //清除
				clearLockKey();
			} else if (pinTemp.length < 4) { //不到4位就可以输入
				pinTemp += _num;
				getID("lockKey" + pinTemp.length).innerText = "*";
			}
			if (pinTemp.length == 4) { //密码输入4位了
				pinTemp2 = pinTemp;
				clearLockKey();
				if (pinTemp2 == pinTemp1) {
					getID("prompt").innerHTML = "Succeed ! <br>The new key is " + pinTemp2;
					getID("prompt").innerHTML += "<br/>";
					indexArea = "lock";
					userKey = pinTemp2;
					if (typeof(window.androidJs) != "undefined") {
						window.androidJs.JsSetCookie("userKey", userKey, '1000d');
					}
				} else {
					getID("prompt").innerText = "Two key don't match";
				}
			}
		}
	}		

	var speed = (getCookie('speed'))?getCookie('speed'):1;
	function showMe() { //进入个人中心
	//	alert(sn+"\r\n"+intLoginTime+"-"+intExpireTime+"\r\n"+expireTime);
		scrollTo(0, 0);
		scrollDisable();
		getID("expireTimeH5").innerHTML = expireTime;
		if( typeof(window.androidJs)=="undefined"){	//浏览器访问才检查username
			if( getCookie("username") && getCookie("username").length>1  ){
				getID("login").style.display = "none";
				getID("usernameH5").innerHTML = getCookie("username");
				getID("defaultSpeed").innerHTML = speed;
			}else{
				getID("login").style.display = "block";
				getID("login").style.height = clientHeight+"px";
				getID('emailInput').placeholder = (language=="c")?"請輸入已註冊的郵箱":"Email";
				getID('passwordInput').placeholder = (language=="c")?"請輸入密碼":"Password";
			}
		}else{	//非浏览器访问，不显示username和默认速度（因为还不能设置app的默认速度）
			window.androidJs.JsSetPageArea("me");
			getID("speedDiv").style.display = "none";
			getID("logOutDiv").style.display = "none";
			getID("usernameDiv").style.display = "none";
			getID("changePasswordDiv").style.display = "none";
		}
		getID('me').style.display = 'block';
		getID("me").style.height = (clientHeight +0)+ "px";
		indexArea = "me";

		getID("meTitle").innerHTML = (language=="c")?"<span style='font-size:70px;'>個人中心</span>":"<span style='font-size:90px;'>Personal center</span>";
		getID("meUser").innerHTML = (language=="c")?"用戶名":"User name";
		getID("meExpire").innerHTML = (language=="c")?"有效期":"Expire time";
		getID("meLicense").innerHTML = (language=="c")?"延期授權":"License";
		getID("meShare").innerHTML = (language=="c")?"分享":"Share";
		getID("meHistory").innerHTML = (language=="c")?"播放歷史":"History";
		getID("meCollect").innerHTML = (language=="c")?"收藏":"Collect";
		getID("meSpeed").innerHTML = (language=="c")?"播放速度":"Default speed";
		getID("meLanguage").innerHTML = (language=="c")?"Language":"系統語言";
		getID("defaultLanguage").innerHTML = (language=="c")?"中文":"English";
		getID("mePassword").innerHTML = (language=="c")?"修改密碼":"Change password";
		getID("meLogout").innerHTML = (language=="c")?"退出登陸":"Log out";
	}

	var loginType = 0;
	function changeLoginType(){//0注册，1登陆，2重置密码，3修改密码
		loginType = (loginType==0)?1:0;
	//	getID("loginType").style.backgroundImage = (loginType==0)?'url(img/login_register.png)':'url(img/login_login.png)';
		getID("loginType").style.left = (loginType==0)?"35%":"0%";
		getID("login-login").style.color = (loginType==1)?"white":"black";
		getID("login-register").style.color = (loginType==0)?"white":"black";
		getID("resetPassword").style.display = (loginType==0)?"none":"block";
		getID("resetPassword").innerHTML = (language=="c")?"重置密码":"Reset password";
		getID("loginSubmit").innerHTML = (loginType==0)?(language=="c")?"注&emsp;册":"Register":(language=="c")?"登&emsp;陆":"Log in";
		getID("login_type").innerHTML = (loginType==1)?(language=="c")?"点击这注册一个新账号":"Click here register a new account":(language=="c")?"已有账号，点击这立即登陆":"Click here to log in immediately";
	}

	var userId = 0;
	function emailApi(_email,_username,_password){
		$.ajax({
			type: 'POST',
			url: 'email.php',
			data: {
				'loginType': loginType,
				'email': _email,
				'username': _username,
				'password': _password,
			},
			dataType: 'json',
			beforeSend: function() {
				//这里一般显示加载提示;
			},
			success: function(json){
			//	console.log(json);
			//	alert(json.msg);
				getID("loading").style.display = "none";
				if(json.msg=="success"){
					if( loginType==3){	//重置密码
						loginType = 1;
						if( language=="c"){
							alert("提交成功！请查看您的邮箱");
						}else{
							alert("Success ! Please check your email");
						}						
					}else if(loginType==4){
						alert(json.msg);
						getID("changePassword").style.display = "none";
						showMe();
					}else{	//0注册 1登陆
						setCookie("sn",_email,"1000d");
						setCookie("email",_email,"1000d");
						setCookie("username",_username,"1000d");
						setCookie("deviceInfo", _username, '1000d'); //供php页面记录备注
						if( loginType==0 ){	//注册
							changeLoginType();
							getID("loading").style.display = "none";
							if( language=="c"){
								alert("注册成功！\n请前往邮箱激活账号");
							}else{
								alert("Success !\nPlease enter the email to activate your account");
							}							
						}else if( loginType==1){	//登陆
							userId = json.data["userId"];
							setCookie("userId",userId,"1000d");
							if( language=="c"){
								alert("登陆成功！\n请牢记您的用户名和密码!\n稍后自动转至首页");
							}else{
								alert("Success !\nPlease remember your username and password !\nLater transferred to the home page automatically");
							}							
							location.href = "./indexMx.php?username="+_username;
						}
					}
				}else{
					alert(json.msg);
				}
			},
			error: function(json) {
			//	console.log(json.responseText);
			}
		});
	}

	function login(){
	//	username = getID('usernameInput').value;
		var emailTemp = getID('emailInput').value;
		username = emailTemp.slice(0,emailTemp.indexOf("@"));
		var passwordTemp = getID('passwordInput').value;
		var sReg = /[_a-zA-Z\d\-\.]+@[_a-zA-Z\d\-]+(\.[_a-zA-Z\d\-]+)+$/;
		if( !sReg.test(emailTemp) ){
			if( language=="c"){
				alert("Email地址错误,请重新输入");
			}else{
				alert("Email address error, please enter again");
			}			
		}else if( username.length < 1 ){
			alert("用户名至少1位");
		}else if(passwordTemp.length < 6 ){
			if( language=="c"){
				alert("密码至少6位");
			}else{
				alert("Password must be at least 6 characters");
			}			
		}else{
		//	alert("正在提交，请稍候！");
			getID("loading").style.display = "block";
			emailApi(emailTemp,username,passwordTemp);
		}
	}

	function logout(){
		setCookie("username","null","2s");
		getID("login").style.display = "block";
		getID("login").style.height = clientHeight+"px";
		getID('emailInput').placeholder = (language=="c")?"請輸入已註冊的郵箱":"Email";
		getID('passwordInput').placeholder = (language=="c")?"請輸入密碼":"Password";
		changeLoginType();
	}

	function resetPassword(){
		var emailTemp = getID('emailInput').value;
		var sReg = /[_a-zA-Z\d\-\.]+@[_a-zA-Z\d\-]+(\.[_a-zA-Z\d\-]+)+$/;
		if( !sReg.test(emailTemp) ){			
			if( language=="c"){
				alert("Email 地址错误,请重新输入");
			}else{
				alert("Email address error, please enter again");
			}
		}else{
			getID("loading").style.display = "block";
			loginType = 3;
			var emailTemp = getID('emailInput').value;
			emailApi(emailTemp,"resetPassword","password");
		}
	}

	function changePassword(){
		loginType = 4;
		userId = (getCookie("userId"))?getCookie("userId"):userId;
		getID("changePassword").style.display = "block";
		getID("changePassword").style.height = clientHeight+"px";	
		getID("changePasswordTitle").innerHTML = (language=="c")?"修改密碼":"Change password";
		getID("changePasswordCancle").innerHTML = (language=="c")?"取&emsp;消":"Cancle";
		getID("changePasswordSubmit").innerHTML = (language=="c")?"提&emsp;交":"Submit";
		getID('passwordOld').placeholder = (language=="c")?"原密碼":"Old password";
		getID('passwordNew0').placeholder = (language=="c")?"新密碼":"New password";
		getID('passwordNew1').placeholder = (language=="c")?"确认新密碼":"Confirm new password";
	}

	function submitChangePassword(){
		var passwordOldTemp = getID('passwordOld').value;
		var passwordNewTemp0 = getID('passwordNew0').value;
		var passwordNewTemp1 = getID('passwordNew1').value;
		if( passwordNewTemp0!=passwordNewTemp1 ){
			if( language=="c"){
				alert("两次输入的密码不一致");
			}else{
				alert("Two input password is not consistent");
			}
		}else{
			getID("loading").style.display = "block";
		//	alert(userId+"_"+passwordOldTemp+"_"+passwordNewTemp0);
			emailApi(userId,passwordNewTemp0,passwordOldTemp);	//对应email username password
		}
	}

	function registedVipCard(){
		scrollTo(0, 0);
		getID("me").style.display = "none";
		getID('cardKey').style.display = 'block';
		getID("cardKey").style.height = clientHeight + "px"; //注册VIP卡页面的高
		getID("exp").innerHTML = "Exp. " + expireTime;
		getID("msg").style.background = ""; //多次进入个人中心，这里可能会显示注册时的信息
		getID("msg").innerHTML = ""; //所以先清空
	/*	if (typeof(window.androidJs) != "undefined") {
			window.androidJs.JsClosePlayer();
		}else{
			getID('card_id').focus();
		}*/
		scrollDisable();
		indexArea = "register";
	}

	function back() { //从个人中心返回
		if (parseInt(intLoginTime) < parseInt(intExpireTime) || backArea == "true") { //授权没过期
			getID("cardKey").style.display = 'none';
			scrollEnable();
			if (tab1 == -1) {
				showLiveList(0);
			}
			getID("msg").innerHTML = "";
			getID("msg").style.background = "";
		} else {
			getID("msg").style.lineHeight = window.innerHeight * 0.35 + "px"; //只一行内容，行高=div height
			getID("msg").innerHTML = "Register your VIP card !";
			getID("msg").style.background = "linear-gradient(to bottom,gray,white)";
		}
		indexArea = "home";
	}

	function checkInput(){	//提交授权码
		var clientHeight  = window.innerHeight;
		getID("msg").style.lineHeight = clientHeight*0.35+"px";
		/*if( getID("card_id").value.length<8 ){
			getID("msg").style.background = "linear-gradient(to bottom,gray,white)";	
			getID("msg").innerHTML = "Card number error !";
		}else */if( getID("card_key").value.length<8 ){
			getID("msg").style.background = "linear-gradient(to bottom,gray,white)";
			getID("msg").innerHTML = "PIN code error !";
		}else{
		//	var cardIdPost = getID("card_id").value.replace(/-/g, "");	//把每4位中间的横杠删掉
			var cardIdPost = getID("card_key").value.replace(/-/g, "");	//卡号和卡密一样
			var cardKeyPost = getID("card_key").value.replace(/-/g, "");
		//	getID("msg").innerHTML = sn;
			sendAjax("./ajax.php","sn="+sn+"&cardId="+cardIdPost+"&cardKey="+cardKeyPost);
		}
	}

	//监听input value
	var lastLength = 0;
	
	function onInputHandler(event,_id) {// Firefox, Google Chrome, Opera, Safari, Internet Explorer from version 9
	//    console.log("刚输入的是："+event.target.value);
		if( lastLength < event.target.value.length ){	//上次字数少于当前字数，说明新加了，否则就是删除
			if( event.target.value.length==4 ){
			//	event.target.value += "-"
			}
		}
		lastLength = event.target.value.length;	//存储当前字数
		if( event.target.value.length >11  && event.target.value.indexOf("-")<0){//16位没有横杠，说明是直接复制过来的
			var temp = event.target.value;
		//	temp = temp.slice(0, 4) + "-" + temp.slice(4);
			event.target.value = temp.slice(0,12);
		}
	}
	
	/*
	function onPropertyChangeHandler(event) {// Internet Explorer 目前这个是手机页面，这个函数可以不用
		if (event.propertyName.toLowerCase () == "value") {
	//        console.log(event.srcElement.value);
			if( event.target.value.length==4 ){
				getID("card_key").value += "-"
			}
		}
	}*/