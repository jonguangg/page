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
			if( getCookie("username") && getCookie("username").length>5  ){
				getID("login").style.display = "none";
				getID("usernameH5").innerHTML = getCookie("username");
				getID("defaultSpeed").innerHTML = speed;
			}else{
				getID("login").style.display = "block";
				getID("login").style.height = clientHeight+"px";
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
	}

	var loginType = 0;
	function changeLoginType(){//0注册，1登陆，2重置密码，3修改密码
		loginType = (loginType==0)?1:0;
		getID("loginType").style.backgroundImage = (loginType==0)?'url(img/login_register.png)':'url(img/login_login.png)';
		getID("loginSubmit").innerHTML = (loginType==0)?"注 册 (Register)":"登 陆 (Log in)";
		getID("resetPassword").style.display = (loginType==0)?"none":"block";
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
						alert("提交成功！请查看您的邮箱");
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
							alert("注册成功！\n请前往邮箱激活账号");
						}else if( loginType==1){	//登陆
							userId = json.data["userId"];
							setCookie("userId",userId,"1000d");
							alert("登陆成功！\n请牢记您的用户名和密码!\n稍后自动转至首页");
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
		username = getID('usernameInput').value;
		var emailTemp = getID('emailInput').value;
		var passwordTemp = getID('passwordInput').value;
		var sReg = /[_a-zA-Z\d\-\.]+@[_a-zA-Z\d\-]+(\.[_a-zA-Z\d\-]+)+$/;
		if( !sReg.test(emailTemp) ){
			alert("Email地址错误,请重新输入");
		}else if( username.length < 6 ){
			alert("用户名至少6位");
		}else if(passwordTemp.length < 6 ){
			alert("密码至少6位");
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
	}

	function resetPassword(){
		var emailTemp = getID('emailInput').value;
		var sReg = /[_a-zA-Z\d\-\.]+@[_a-zA-Z\d\-]+(\.[_a-zA-Z\d\-]+)+$/;
		if( !sReg.test(emailTemp) ){
			alert("Email地址错误,请重新输入");
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
	}

	function submitChangePassword(){
		var passwordOldTemp = getID('passwordOld').value;
		var passwordNewTemp0 = getID('passwordNew0').value;
		var passwordNewTemp1 = getID('passwordNew1').value;
		if( passwordNewTemp0!=passwordNewTemp1 ){
			alert("两次输入的密码不一致");
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