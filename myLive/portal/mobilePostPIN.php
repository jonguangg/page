<?php
	include_once "rsa.php";	//RSA加解密
	$rsa = new rsa();
//	$snPriv = $_GET['snPriv'];
	$ip = $_GET['ip'];
	$city = $_GET['city'];
	$snPub = $_GET['snPub'];
	
	// 公钥解密获取SN
//	$snPriv = $rsa->publicDecrypt("$snPriv");	//跟下面效果一样
//	$snPriv = $rsa->publicDecrypt($snPriv);
//	echo "<br>公钥解密后的SN：".$sn.PHP_EOL.PHP_EOL;

	// 私钥解密
	$snPub = $rsa->privDecrypt($snPub);
//	echo "<br>私钥解密后的SN：".$sng.PHP_EOL.PHP_EOL;


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" >
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<meta name="viewport" content="user-scalable=no" /><!-- 禁止缩放页面 -->
<title>Registered VIP Card</title>

<style>
	*{margin:0px;overflow:hidden;}
	img{width:100%;height:100%;}
</style>

<script type="text/javascript" src="global.js"></script>
<script language="javascript">
function getID(id){return document.getElementById(id);}
var clientWidth  = document.documentElement.clientWidth;
var clientHeight = document.documentElement.clientHeight;

var xmlHttp;	//1.创建XMLHttpRequest对象
//var xmlHttp = new XMLHttpRequest();// 1.创建XMLHttpRequest对象(不兼容浏览器)
function createXmlHttpRequestObject(){
	if(window.ActiveXObject){	//如果在internet Explorer下运行
		try{
			xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
		}catch(e){
			xmlHttp = false;
		}
	}else{
		try{	//如果在Mozilla或其他的浏览器下运行
			xmlHttp = new XMLHttpRequest();
		}catch(e){
			xmlHttp = false;
		}
	}
	if(!xmlHttp){	//返回创建的对象或显示错误信息
		alert("返回创建的对象或显示错误信息");
	}else{
		return xmlHttp;
	}
}

function sendAjax(_url,_content){
	createXmlHttpRequestObject();
	// 2.请求行
	xmlHttp.open("POST", _url);//"./isOnLine.php");
	// 3.请求头
	xmlHttp.setRequestHeader('Content-Type',' application/x-www-form-urlencoded');
	// 4.设置数据
	xmlHttp.send(_content);//'sn='+sn);
	// 5.监听服务器响应
	xmlHttp.onreadystatechange = function(){
		if (xmlHttp.readyState==4 && xmlHttp.status==200){
			if( xmlHttp.responseText.indexOf("Succeed")>-1){	//成功延期
				getID("msg").innerHTML = "</br>Succeed! Your expire time is </br>"+xmlHttp.responseText.slice( xmlHttp.responseText.indexOf("Succeed")+7 )+"</br>Now restart STB enjoy videos!";
				getID("msg").style.lineHeight = clientWidth*0.8*0.64*0.2+"px"; //有4行内容 ，行高=1/5*div height
			}else{	//失败
				getID("msg").style.lineHeight = clientWidth*0.8*0.64+"px";	//只一行内容，行高=div height
				if( xmlHttp.responseText.indexOf("card") > -1 ){//卡号输错了	
					getID("msg").innerHTML = xmlHttp.responseText.slice( xmlHttp.responseText.indexOf("error")+5 );
				}else if( xmlHttp.responseText.indexOf("PIN") > -1 ){//密码输错了	
					getID("msg").innerHTML = xmlHttp.responseText.slice( xmlHttp.responseText.indexOf("error")+5 );
				}
			}
			getID("msg").style.backgroundColor = "#f0f3fa";
		}
	}
}

var sn = "<?php echo $snPub ?>";	//从当前页面php拿，php是从二维码地址get
var ip = "<?php echo $ip ?>";	//从当前页面php拿，php是从二维码地址get
var city = "<?php echo $city ?>";	//从当前页面php拿，php是从二维码地址get
setCookie("ip", ip, '1000d');	//存下来给ajax.php
setCookie("city", city, '1000d');	//存下来给ajax.php
//console.log(sn);
function checkInput(){
	if( getID("card_id").value.length<19 ){
		alert( "Please enter card number!" );
	}else if( getID("card_key").value.length<19 ){
		alert( "Please enter PIN code!" );
	}else{
		var cardIdPost = getID("card_id").value.replace(/-/g, "");//把每4位中间的横杠删掉
		var cardKeyPost = getID("card_key").value.replace(/-/g, "");
		sendAjax("./ajax.php","sn="+sn+"&cardId="+cardIdPost+"&cardKey="+cardKeyPost);
	}
}

//监听input value
var lastLength = 0;
// Firefox, Google Chrome, Opera, Safari, Internet Explorer from version 9
function onInputHandler(event,_id) {
//    console.log("刚输入的是："+event.target.value);
	if( lastLength < event.target.value.length ){	//上次字数少于当前字数，说明新加了，否则就是删除
		if( event.target.value.length==4 ||  event.target.value.length==9 ||  event.target.value.length==14 ){
		/*	if( _id=="card_id" ){
				getID("card_id").value += "-"
			}else if( _id=="card_key" ){
				getID("card_key").value += "-"
			}*/
			event.target.value += "-"
		}
	}
	lastLength = event.target.value.length;	//存储当前字数
	if( event.target.value.length==16 && event.target.value.indexOf("-")<0){//16位没有横杠，说明是直接复制过来的
		var temp = event.target.value;
		temp = temp.slice(0, 4) + "-" + temp.slice(4);
		temp = temp.slice(0, 9) + "-" + temp.slice(9);
		temp = temp.slice(0, 14) + "-" + temp.slice(14);
		event.target.value = temp;
	}
}
// Internet Explorer 目前这个是手机页面，这个函数可以不用
function onPropertyChangeHandler(event) {
    if (event.propertyName.toLowerCase () == "value") {
//        console.log(event.srcElement.value);
		if( event.target.value.length==4 ||  event.target.value.length==9 ||  event.target.value.length==14 ){
			getID("card_key").value += "-"
		}
    }
}

function init(){
	getID("enterDiv").style.width = clientWidth*0.8+"px";	//定义整个页面的宽度为手机屏幕80%
	getID("enterDiv").style.left = clientWidth*0.1+"px";
	
	getID("img").style.height = clientWidth*0.8*0.64+"px";
	getID("msg").style.height = clientWidth*0.8*0.64+"px";
	getID("ok").style.top = (clientWidth*0.8*0.64+750)+"px";
}
</script>
</head>
 
<body onload="init()" background="bg.jpg">
<div id="enterDiv" style="position:absolute;left:0px;top:0px;width:100%;height:100%;color:#FF6600;">
	<h1 id="title" style="position:absolute;left:0px;top:50px;width:100%;height:100px;text-align:center;font-size:75px;">Registered VIP Card</h1>

	<div id="cardId" style="position:absolute;left:0px;top:200px;width:100%;height:70px;font-size:50px;">Card Number</div>
	
	<input type="text" id="card_id" style="position:absolute;left:0px;top:280px;width:100%;height:70px;font-size:55px;" required="required"  maxlength="19" placeholder=" Please enter your card number" oninput="onInputHandler(event,'card_id')" onkeyup="value=value.replace(/[\u4e00-\u9fa5]/ig,'')" /><!-- onkeyup是禁止输入中文，将中文替换为空(即删除) -->
	
	<div id="cardKey" style="position:absolute;left:0px;top:400px;width:100%;height:70px;font-size:50px;">PIN Code</div>
	
	<input type="text" id="card_key" style="position:absolute;left:0px;top:480px;width:100%;height:70px;font-size:55px;" required="required" maxlength="19" placeholder=" Please enter your PIN code" oninput="onInputHandler(event,'card_key')" />
	
	<div id="img" style="position:absolute;left:0px;top:630px;width:100%;height:51%;background:url(vipCard.png) no-repeat;background-size:100% 100% !important;"></div>
	
	<div id="ok" style="position:absolute;left:0px;top:880px;width:100%;line-height:120px;font-size:80px;text-align:center; border-radius:50px 50px 50px 50px; background-color:#FF6600;color:gold" onclick="checkInput()"><b>submit</b></div>
	
	<div id="msg" style="position:absolute;left:0px;top:630px;width:100%;text-align:center;font-size:50px;border-radius:45px 45px 45px 45px;"></div>

	
</div>	
	
	
	
	
	
	
</body>
</html>