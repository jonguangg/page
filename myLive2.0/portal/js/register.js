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

var splashArr = ['splash0.gif','splash1.gif','splash2.gif','splash3.gif','splash4.gif','splash5.gif','splash6.gif','splash7.gif','splash8.gif','splash9.gif','splash10.gif','splash11.gif','splash12.gif','splash13.gif','splash14.gif','splash15.gif','splash16.gif','splash17.gif','splash18.gif','splash19.gif','splash20.gif','splash21.gif','splash22.gif','splash23.gif','splash24.gif','splash25.gif','splash26.gif','splash27.gif','splash28.gif','splash29.gif','splash30.gif','splash31.gif','splash32.gif','splash33.gif','splash34.gif','splash35.gif','splash.png','splash.jpg'];
//var splashIndex = window.androidJs.JsGetCookie("splashIndex",0)?window.androidJs.JsGetCookie("splashIndex",0):0;
var splashIndex = getCookie("splashIndex")?getCookie("splashIndex"):0;
splashIndex ++;
if( splashIndex > splashArr.length-1 ){
	splashIndex = 0;
}
setCookie("splashIndex", splashIndex, '12h');

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
				//	getID("vodList").style.display = "block";
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

function showMe() { //进入个人中心
	scrollTo(0, 0);
	getID('cardKey').style.display = 'block';
	getID("exp").innerHTML = "Exp. " + expireTime;
	getID("msg").style.background = ""; //多次进入个人中心，这里可能会显示注册时的信息
	getID("msg").innerHTML = ""; //所以先清空
	if (typeof(window.androidJs) != "undefined") {
		window.androidJs.JsClosePlayer();
	}
	scrollDisable();
}

function back() { //从个人中心返回
	if (parseInt(intLoginTime) < parseInt(intExpireTime) || backArea == "true") { //授权没过期
		getID("cardKey").style.display = 'none';
		scrollEnable();
		if (navPos == -1) {
			showLiveList();
		}
		getID("msg").innerHTML = "";
		getID("msg").style.background = "";
	} else {
		getID("msg").style.lineHeight = window.innerHeight * 0.35 + "px"; //只一行内容，行高=div height
		getID("msg").innerHTML = "Register your VIP card !";
		getID("msg").style.background = "linear-gradient(to bottom,yellow,green,blue,indigo)";
	}
}

function checkInput(){
	var clientHeight  = window.innerHeight;
	getID("msg").style.lineHeight = clientHeight*0.35+"px";
	if( getID("card_id").value.length<8 ){
		getID("msg").style.background = "linear-gradient(to bottom,green,blue,indigo,violet)";	
		getID("msg").innerHTML = "Card number error !";
	}else if( getID("card_key").value.length<8 ){
		getID("msg").style.background = "linear-gradient(to bottom,green,blue,indigo,violet)";
		getID("msg").innerHTML = "PIN code error !";
	}else{
		var cardIdPost = getID("card_id").value.replace(/-/g, "");//把每4位中间的横杠删掉
		var cardKeyPost = getID("card_key").value.replace(/-/g, "");
	//	getID("msg").innerHTML = sn;
		sendAjax("./ajax.php","sn="+sn+"&cardId="+cardIdPost+"&cardKey="+cardKeyPost);
	}
}

//监听input value
var lastLength = 0;
// Firefox, Google Chrome, Opera, Safari, Internet Explorer from version 9
function onInputHandler(event,_id) {
//    console.log("刚输入的是："+event.target.value);
	if( lastLength < event.target.value.length ){	//上次字数少于当前字数，说明新加了，否则就是删除
		if( event.target.value.length==4 ){
		//	event.target.value += "-"
		}
	}
	lastLength = event.target.value.length;	//存储当前字数
	if( event.target.value.length >7  && event.target.value.indexOf("-")<0){//16位没有横杠，说明是直接复制过来的
		var temp = event.target.value;
	//	temp = temp.slice(0, 4) + "-" + temp.slice(4);
		event.target.value = temp.slice(0,8);
	}
}
// Internet Explorer 目前这个是手机页面，这个函数可以不用
/*
function onPropertyChangeHandler(event) {
    if (event.propertyName.toLowerCase () == "value") {
//        console.log(event.srcElement.value);
		if( event.target.value.length==4 ){
			getID("card_key").value += "-"
		}
    }
}*/