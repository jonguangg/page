<?php
	include_once "../connectMysql.php";
	include_once "../readStbArray.php";
	include_once "../readChannelArray.php";
	set_time_limit(0);//限制页面执行时间,0为不限制
//	error_reporting(0);// 关闭所有PHP错误报告
//	error_reporting(-1);// 报告所有 PHP 错误=error_reporting(E_ALL);
//	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);// 报告 E_NOTICE也挺好 (报告未初始化的变量或者捕获变量名的错误拼写)
	error_reporting(E_ALL^E_NOTICE^E_WARNING);

function getIP(){	//获取用户真实 IP
	static $realip;
	if (isset($_SERVER)){
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])){
			$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
			$realip = $_SERVER["HTTP_CLIENT_IP"];
		} else {
			$realip = $_SERVER["REMOTE_ADDR"];
		}
	} else {
		if (getenv("HTTP_X_FORWARDED_FOR")){
			$realip = getenv("HTTP_X_FORWARDED_FOR");
		} else if (getenv("HTTP_CLIENT_IP")) {
			$realip = getenv("HTTP_CLIENT_IP");
		} else {
			$realip = getenv("REMOTE_ADDR");
		}
	}
	return $realip;
}
$ip = getIP();
setcookie("ip", $ip, time()+24*3600);//cookie存24小时 
//	echo $ip;

function getCity(){			// 获取当前IP所在城市 
	$getIp = getIP(); 
	$content = file_get_contents("http://api.map.baidu.com/location/ip?ak=2TGbi6zzFm5rjYKqPPomh9GBwcgLW5sS&ip={$getIp}&coor=bd09ll"); 
	$json = json_decode($content); 
	$address = $json->{'content'}->{'address'};//按层级关系提取address数据 
	$data['address'] = $address; 
	$return['province'] = mb_substr($data['address'],0,3,'utf-8'); 
	$return['city'] = mb_substr($data['address'],3,3,'utf-8'); 
	return $return['province'].$return['city']; 
}
$city = getCity();
setcookie("city", $city, time()+24*3600);//cookie存24小时
//	echo $city;

	$sn = $_COOKIE["sn"];//机顶盒序列号（MAC地址和SN结合体）
	$mark = $_COOKIE["deviceInfo"];//机顶盒备注
//	echo $mark;
	$loginTime = date("Y-m-d"); //机顶盒第一次打开APP的时间
	$lastTime = date("Y-m-d H:i:s"); //机顶盒上一次打开APP的时间
	$expireTime = date("Y-m-d",strtotime("+1 day")); //机顶盒授权到期时间
	$isOnLine = "在线";//每次进入应用都激活在线状态
	$sql = mysqli_query($connect,"select * from client where sn='$sn' ") or die(mysqli_error($connect));
	$cuurloginTime = str_replace("-","",$loginTime);	//为了便于比大小将时间内的-删掉
	$cuurexpireTime = str_replace("-","",$expireTime);	//为了便于比大小将时间内的-删掉，这里的到期时间是当天后7天
	
	if( mysqli_num_rows($sql)>0 ){//如果数据库中有当前机顶盒
		while($row=mysqli_fetch_array($sql)){
		//	$loginTime = $row["loginTime"];	//这个好像没什么用
			$expireTime = $row["expireTime"];					 //从数据库获取真实的到期时间
			$cuurexpireTime = str_replace("-","",$expireTime);	//为了便于比大小将时间内的-删掉
		}
		$sql = mysqli_query($connect,"UPDATE client set isOnLine='$isOnLine',ip='$ip',city='$city',lastTime='$lastTime' where sn='$sn' ") or die(mysqli_error($connect));
	}else if( strlen($sn)>0 ){//如果数据库中没有当前机顶盒，且当前机顶盒有SN
		$sql = mysqli_query($connect,"replace into client(sn,mark,ip,city,loginTime,expireTime,lastTime,isOnLine) values ('$sn','$mark','$ip','$city','$loginTime','$expireTime','$lastTime','$isOnLine')") or die(mysqli_error($connect));
	}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="utf-8">
  
<!-- <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />-->
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />
<title>mLiveIndex</title>
<style media="screen">
	*{margin:0px;padding:0px;}
	img{width:100%;height:100%;}

	.lockKey{position:absolute;top:20%;width:10%;height:100px;line-height:100px;border-bottom:4px white solid;}
	.lockNumR{width:33%;height:25%;display:flex;align-items:center;justify-content:center;position:absolute;border-top:4px white solid;border-right:4px white solid;}
	.lockNum{width:33%;height:25%;display:flex;align-items:center;justify-content:center;position:absolute;border-top:4px white solid;}
</style>

<script type=text/javascript src="global.js" charset=UTF-8></script>
<script type=text/javascript src="register.js"></script>
<script>


var sn = '';
var deviceBrand = '';
var systemModel = '';
function stbInfo(){
	sn = ( typeof(window.androidJs)!="undefined" )?window.androidJs.JsGetMac():"";
	deviceBrand = ( typeof(window.androidJs)!="undefined" )?window.androidJs.JsGetDeviceBrand():"";
	systemModel = ( typeof(window.androidJs)!="undefined" )?window.androidJs.JsSystemModel():"";
	var deviceInfo = deviceBrand+" "+systemModel;
	setCookie("sn", sn, '1000d');
	setCookie("deviceInfo", deviceInfo, '1000d');
//	getID("test").innerHTML = "<br> YourSN_"+sn+"_deviceInfo_"+deviceInfo;
	return sn;
}
/*
function checkLicense(){//检查授权日期
	var loginTime = <?php echo $cuurloginTime ?>;
	var expireTime = <?php echo $cuurexpireTime ?>;
//	getID("test").innerHTML += "<br> 授权到期_"+expireTime;
	if( parseInt(loginTime) > parseInt(expireTime) ){//授权已过期
		getID("cardKey").style.display = "block";
		indexArea = "cardKey";
		showVodList(0);//加这个是为了从直播进入输入卡号的时候，列表太长，虽然出了输入卡号的界面，但还是可以下拉
		for(i=0;i<10;i++){//授权过期就将列表隐藏，否则虽然出了输入卡号的界面，但还是可以下拉
			getID("vodListImg"+i).style.height = "1px";
		}
		window.androidJs.JsClosePlayer();
	}else{
		indexArea = ( indexArea== "lock" )?"lock":"live";//如果一直停留在解锁界面，就不改变焦点状态
	}
}
	setTimeout(function(){ checkLicense();}, 10000);//试看N分钟再检查授权日期
//setTimeout( checkLicense, 6000);//试看N分钟再检查授权日期
*/
function imOnLine(){//上报在线状态
	var now = new Date();			//此时此刻
	var sec = now.getSeconds();		//此时的秒
	//因为后台是每个被5整除的分钟时下线所有机顶盒，所以这里要在下线后即时（延时1分钟）上线
	//如果当前分钟正好被5整除，则说明此时后台刚刚下线所有机顶盒，前端延时1分钟上线当前机顶盒 60-sec是为了精确到秒
	//如果当前分钟离整5有1、2、3、4分钟，则分别延时1、2、3、4分钟。用6减模5余几的数，就是要延时的时间
	var ms = ( now.getMinutes()%5==0 )?60-sec:(6-now.getMinutes()%5)*60-sec;
//	var ms = ( (6-now.getMinutes()%5)*60>300 )?60-sec:(6-now.getMinutes()%5)*60-sec;
//	var ms = ( (6-now.getMinutes()%5)*60000>300000 )?60000-sec*1000:(6-now.getMinutes()%5)*60000-sec*1000;
//	getID("test").innerHTML += "_"+now.getMinutes()+":"+sec;
	setTimeout(function(){ sendAjax("./ajax.php","sn="+sn);}, ms*1000);
}

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
			if( _content.indexOf('card') < 0 ){//如果没有card则说明是上报在线状态，而不是输入卡密
				imOnLine();
			}else{
				var clientHeight  = window.innerHeight;
				if( xmlHttp.responseText.indexOf("Succeed")>-1){	//成功延期
					getID("msg").innerHTML = "</br>Succeed! Your expire time is </br>"+xmlHttp.responseText.slice( xmlHttp.responseText.indexOf("Succeed")+7 )+"</br>Now restart APP enjoy videos!";
					getID("msg").style.lineHeight = clientHeight*0.35*0.2+"px"; //有4行内容 ，行高=1/5*div height
				}else{	//失败
					getID("msg").style.lineHeight = clientHeight*0.35+"px";	//只一行内容，行高=div height
					if( xmlHttp.responseText.indexOf("card") > -1 ){//卡号输错了	
						getID("msg").innerHTML = xmlHttp.responseText.slice( xmlHttp.responseText.indexOf("error")+5 );
					}else if( xmlHttp.responseText.indexOf("PIN") > -1 ){//密码输错了	
						getID("msg").innerHTML = xmlHttp.responseText.slice( xmlHttp.responseText.indexOf("error")+5 );
					}
				}
				getID("msg").style.backgroundColor = "#234567";				
			}
		}
	}
}

var pinTemp = "";
var pinTemp1 = "";
var pinTemp2 = "";
function clearLockKey(){
	pinTemp = "";
	getID("lockKey1").innerHTML = "";
	getID("lockKey2").innerHTML = "";
	getID("lockKey3").innerHTML = "";
	getID("lockKey4").innerHTML = "";
}
function checkPin(_num){
	if( typeof(window.androidJs) != "undefined" ){
		window.androidJs.JsVibrate(40);
	}	
	if( indexArea=="lock" || indexArea=="alterCheck" ){//输入解锁密码
		if( _num==10 ){//修改密码
			clearLockKey();
			indexArea = "alterCheck";
			getID("prompt").innerText = "Please check your old key";
		}else if( _num==11 ){//清除
			clearLockKey();
		}else if( pinTemp.length < 4 ){//不到4位就可以输入
			pinTemp += _num;
			getID("lockKey"+pinTemp.length).innerText = "*";
			if( pinTemp == userKey ){//密码正确
				if( indexArea=="alterCheck" ){//如果是要改密码
					indexArea = "alter";
					getID("prompt").innerText = "Please enter your new key";
					clearLockKey();
				}else{//密码正确就隐藏解锁界面并显示点播列表
					indexArea = "live";					
					getID("lock").style.display = "none";
					getID("vodList").style.display = "block";
					var clientWidth  = document.body.scrollWidth ;
					for(i=0;i<10;i++){
						getID("vodListImg"+i).style.height = (clientWidth*9/16)+"px";
					}
				}
			}
		}
		if( pinTemp.length == 4 && pinTemp != userKey ){//密码输入错误
			clearLockKey();	
			getID("prompt").innerHTML = "Please try again";			
		}
	}else if( indexArea=="alter" ){//修改密码
		if( _num==11 ){//清除
			clearLockKey();
		}else if( pinTemp.length < 4 ){//不到4位就可以输入
			pinTemp += _num;
			getID("lockKey"+pinTemp.length).innerText = "*";
		}
		if( pinTemp.length == 4 ){//密码输入4位了
			pinTemp1 = pinTemp;
			clearLockKey();
			indexArea = "alter2";
			getID("prompt").innerText = "Please enter your new key again";
		}
	}else if( indexArea=="alter2" ){//输入新密码
		if( _num==11 ){//清除
			clearLockKey();
		}else if( pinTemp.length < 4 ){//不到4位就可以输入
			pinTemp += _num;
			getID("lockKey"+pinTemp.length).innerText = "*";
		}
		if( pinTemp.length == 4 ){//密码输入4位了
			pinTemp2 = pinTemp;
			clearLockKey();
			if( pinTemp2==pinTemp1 ){
				getID("prompt").innerHTML = "Succeed ! The new key is:"+pinTemp2;
				getID("prompt").innerHTML += "<br/>";
				getID("prompt").innerHTML += "Now enter the new key to unlock";
				indexArea = "lock";
				userKey = pinTemp2;
				window.androidJs.JsSetCookie("userKey",userKey,'1000d');
			}else{
				getID("prompt").innerText = "The two key don't match";
			}
		}
	}
}
	
function init(){
	stbInfo();	
	var clientWidth  = document.body.scrollWidth;
	var clientHeight  = window.innerHeight;
	getID('bodys').style.width = clientWidth+"px";		//全局宽	
	getID("cardKey").style.height = clientHeight+"px";	//注册VIP卡页面的高
	
//	alert('网页可见区域宽：'+document.body.clientWidth+'\n网页可见区域高：'+document.body.clientHeight+'\n网页可见区域宽：'+document.body.offsetWidth+ '\n网页可见区域高：'+document.body.offsetHeight+ '\n网页正文全文宽：'+document.body.scrollWidth+ '\n网页正文全文高：'+document.body.scrollHeight+ '\n网页被卷去的高：'+document.body.scrollTop+ '\n网页被卷去的左：'+document.body.scrollLeft+'\n网页正文部分上：'+window.screenTop+ '\n网页正文部分左：'+window.screenLeft+ '\n屏幕分辨率的高：'+window.screen.height+ '\n屏幕分辨率的宽：'+window.screen.width+ '\n屏幕可用工作区高度：'+window.screen.availHeight+'\n屏幕可用工作区宽度：'+window.screen.availWidth+'\nwindow.innerHeight：'+window.innerHeight);
}
</script>
</head>
<body bgcolor="#123456" leftmargin="0" topmargin="0" onload="init();" >

<div id="bodys" style="position:absolute;top:0px;left:0px;width:100%;display:block;">
	<!-- 输入卡号及卡密 -->
	<div id="cardKey" style="position:absolute;top:0px;left:0px;width:100%;height:0px;background-color:#123456;display:block;text-align:center;font-size:80px;color:white; z-index:10;">
		<h1 id="title" style="position:absolute;left:0px;top:5%;width:100%;height:100px;text-align:center;font-size:90px;">Registered VIP Card</h1>

		<div id="cardId" style="position:absolute;left:5%;top:15%;width:90%;height:70px;font-size:70px;text-align:left;">Card Number</div>
	
		<input type="text" id="card_id" style="position:absolute;left:5%;top:20%;width:90%;height:100px;font-size:50px;" required="required"  maxlength="19" placeholder=" you can long press here paste the card number" oninput="onInputHandler(event,'card_id')" onkeyup="value=value.replace(/[\u4e00-\u9fa5]/ig,'')" /><!-- onkeyup是禁止输入中文，将中文替换为空(即删除) -->
	
		<div id="cardKey" style="position:absolute;left:5%;top:30%;width:90%;height:70px;font-size:70px;text-align:left;">PIN Code</div>
	
		<input type="text" id="card_key" style="position:absolute;left:5%;top:35%;width:90%;height:100px;font-size:50px;" required="required" maxlength="19" placeholder=" you can long press here paste the PIN code" oninput="onInputHandler(event,'card_key')" />
	
		<div id="img" style="position:absolute;left:5%;top:45%;width:90%;height:35%;background:url(vipCard.png) no-repeat;background-size:100% 100% !important;"></div>
	
		<div id="ok" style="position:absolute;left:5%;top:85%;width:90%;line-height:120px;font-size:80px;text-align:center; border-radius:50px 50px 50px 50px; background-color:#FF6600;color:gold" onclick="checkInput()"><b>submit</b></div>
	
		<div id="msg" style="position:absolute;left:5%;top:45%;width:90%;height:35%;text-align:center;font-size:70px;border-radius:45px 45px 45px 45px;"></div-->
	</div>

</div>




</body>
</html>

