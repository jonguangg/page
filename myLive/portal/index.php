<?php
	include_once "../connectMysql.php";
	include_once "../readStbArray.php";
	ignore_user_abort(true); // 忽略客户端断开 
	set_time_limit(0);    // 设置执行不超时
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

function getCity( $ip = '' ){ // 获取 IP  地理位置
	if( $ip == ''){
		$url = "http://int.dpool.sina.com.cn/iplookup/iplookup.php?format=json";
		$ip = json_decode(file_get_contents($url),true);
		$data = $ip;
	}else{
		$url="http://ip.taobao.com/service/getIpInfo.php?ip=".$ip;
		$ip=json_decode(file_get_contents($url));   
		if((string)$ip->code=='1'){
		   return false;
		}
		$data = (array)$ip->data;
	}    
	return $data;   
}
	$city = getCity( $ip )['region'].getCity( $ip )['city'];
	setcookie("city", $city, time()+24*3600);//cookie存24小时
//	echo $city;
	sleep(3);
	$sn = $_COOKIE["sn"];//机顶盒序列号（MAC地址和SN结合体）
	$mark = $_COOKIE["deviceInfo"];//机顶盒备注
//	echo $mark;
	$loginTime = date("Y-m-d"); //机顶盒第一次打开APP的时间
	$lastTime = date("Y-m-d H:i:s"); //机顶盒上一次打开APP的时间
	$expireTime = date("Y-m-d",strtotime("+7 day")); //机顶盒授权到期时间
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
	
//	session_start(); //启动会话，session_start()函数必须位于 <html> 标签之前
//	$_SESSION["$sn"] = $sn;	//存储 session 变量
//	echo "您存储的SN session是：". $_SESSION['sn'];	//读取session
//	unset($_SESSION['sn']);	//释放指定的 session 变量
//	session_destroy() 将重置 session，您将失去所有已存储的 session 数据
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<!--<meta name="viewport" content="width=device-width ,initial-scale=1" />
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
<meta http-equiv="Pragma" content="no-cache" />
<meta http-equiv="Expires" content="0" />-->
<title>mLiveIndex</title>
<style>
	*{margin:0px;padding:0px;border:0px;font-family:SimHei;color:white;background-size:100% 100% !important;font-size:30px;}
	img{width:100%;height:100%;}
	.channels{position:absolute;left:0px;width:450px;height:65px;line-height:65px;}
	.channel{position:absolute;top:0px;left:90px;width:360px;height:65px;line-height:65px;text-align:center;}
	.channelID{position:absolute;top:0px;left:40px;width:50px;height:65px;line-height:65px;text-align:left;}
	.num{position:absolute;width:50px;height:50px;border-radius:50% 50%;border:#F0F 2px solid;color:#F0F;}
</style>

<script type=text/javascript src="global.js" charset=UTF-8></script>
<script type=text/javascript src="channelArr.js"></script>
<!-- script type=text/javascript src="jquery-1.11.0.min.js"></script -->
<script>
var groupId = ( typeof(window.androidJs) != "undefined")?parseInt(window.androidJs.JsGetCookie("groupId",0)):0;
var channelPos = ( typeof(window.androidJs) != "undefined")?parseInt(window.androidJs.JsGetCookie("channelPos",0)):0;
var channelPagePos = ( typeof(window.androidJs) != "undefined")?parseInt(window.androidJs.JsGetCookie("channelPagePos",0)):0;
var channelPageAll = parseInt((channelCount-1+10)/10);
//channelJump：跳转至，即在右上角显示的频道号
var channelJump = ( window.androidJs.JsGetCookie("channelJump",0)=='0' )?'1':window.androidJs.JsGetCookie("channelJump",0);
var videoUrlCookie = ( window.androidJs.JsGetCookie("videoUrlCookie",0)=='0' )?dataArr[0].channel[0].videoUrl:window.androidJs.JsGetCookie("videoUrlCookie",0);
//	要在浏览器测试，需将这行上两个设为0

var channelCount = 0;
var channelPagePosTemp = 0;
var channelPosTemp = 0;
var channelArr = [];
var indexArea = "live"//打开应用后默认为锁定状态

for(i=0;i<dataArr.length;i++){//合并所有频道为一个数组，便于显示所有频道和跳转
	channelArr = channelArr.concat( dataArr[i].channel );
}
//console.log(channelArr[ channelArr.length-1 ].name);

var channelTempArr = [];//当前显示的频道组 
var groupSizeArr = [];//每个组的节目数  
for(i=0;i<dataArr.length;i++){
	groupSizeArr.push( dataArr[i].channel.length );
}
//console.log( groupSizeArr );

var groupStartArr = [1];//每个频道组第一个频道号 
for( i=1;i<groupSizeArr.length;i++ ){
	var groupStart = 1;
	for( j=0;j<i;j++ ){
		groupStart += groupSizeArr[j];
	}
	groupStartArr.push( groupStart );
}
//console.log( groupStartArr );

function showChannel(_num){//显示频道组，即左右键切换频道组
/*	if( _num!=0 ){
		channelPos = 0;
		channelPagePos = 0;
	}*/
	groupId += _num;
	if( groupId<-1){
		groupId= dataArr.length-1;
	}
	if( groupId>dataArr.length-1){
		groupId=-1;
	}
	channelTempArr = [];
	channelTempArr = ( groupId==-1 )?channelArr:channelTempArr.concat( dataArr[groupId].channel );
	if( groupId>-1 ){
		for(i=0;i<channelTempArr.length;i++){//改写频道号 
			channelTempArr[i].channelId = groupStartArr[groupId]+i;
		}
	}else{
		for(i=0;i<channelArr.length;i++){//改写频道号  
			channelArr[i].channelId = i+1;
		}
	}
	channelCount = channelTempArr.length;
	channelPageAll = parseInt((channelCount-1+10)/10);
	getID('groupName').innerText = ( groupId==-1 )?'所有频道':dataArr[groupId].group;
	for(i=0;i<10;i++){
		getID('channel'+i).innerHTML = '';
		getID('channelId'+i).innerHTML = '';
		if( channelTempArr[i+channelPagePos*10]  ){ 
			getID('channelId'+i).innerText = channelTempArr[i+channelPagePos*10].channelId;
			getID('channel'+i).innerText = channelTempArr[i+channelPagePos*10].name.slice(0,9);
		}
	}		
}

function moveChannel(_num){//在频道列表上换台，即上下键移动选择频道
	try{
		window.clearTimeout(st);//不让频道列表隐藏
	}catch(err){
	}
	
	getID('channels'+channelPos).style.background = 'rgba(0,0,0,0)';
	getID('channel'+channelPos).innerText = channelTempArr[channelPos+channelPagePos*10].name.slice(0,9);
	channelPos += _num;
	if( channelPos<0){
		channelPos=9;//在第一个时向上，焦点移到最下面,暂时定为9，如果最后一个不是9，再改之  
		if( channelPagePos>0){//如果不在第一页，则向前翻一页
			channelPagePos--;
		}else{//如果已在第一页，则移到最后一页
			channelPagePos = channelPageAll-1;
			if( channelPos + channelPagePos*10>channelCount-1){
				channelPos = channelCount-channelPagePos*10-1;
			}
		}
	}
	if( channelPos+channelPagePos*10>channelCount-1 && _num>0){//在最后一页最后一条下移，跳到第一页第一个
		channelPagePos =0;
		channelPos = 0;
	}
	if( channelPos>9){
		channelPos=0;
		if( channelPagePos<channelPageAll-1){
			channelPagePos++;
		}
	}
	showChannel(0);
	var nameTemp = channelTempArr[channelPos+channelPagePos*10].name;
	if( nameTemp.length>9){
		getID('channel'+channelPos).innerHTML = '<marquee behavior="alternate" direction="left" width="100%" scrollamonut="100" scrolldelay="300" style="color:#f60;">'+nameTemp+'</marquee>'
	}
	getID('channels'+channelPos).style.background = 'rgba(0,0,255,0.7)';
	st = window.setTimeout("showHiddenChannelList(0)", 3000);//3秒后自动隐藏频道列表 
}

function changeChannel(_num){//播放时上下键换台 频道列表不显示出来
	moveChannel(_num);
	channelJump = (parseInt(channelJump)+_num).toString();
	if( parseInt(channelJump)<channelTempArr[0].channelId ){//同组内到了第一个再减，就跳到最后一个
		channelJump = channelTempArr[channelTempArr.length-1].channelId.toString();
	}
	if( parseInt(channelJump) > channelTempArr[channelTempArr.length-1].channelId ){//同组内到了最后一个，就跳到第一个
		channelJump = channelTempArr[0].channelId.toString();
	}
	getID('jumpChannel').innerText = channelJump;//换台后显示频道号
	window.setTimeout('getID("jumpChannel").innerHTML = ""', 2000);
	if( parseInt(channelJump)>0 ){
		getID('jumpName').innerText = channelArr[parseInt(channelJump)-1].name;
		window.setTimeout('getID("jumpName").innerHTML = ""', 2000);
	}
	window.androidJs.JsPlayLive(channelArr[parseInt(channelJump)-1].videoUrl);
	//记录 channelPagePos channelPos channelJump videoUrl
	updateCookie();	
}

function showHiddenChannelList(_num){//_num为0，给返回键隐藏频道列表，_num为其它值，给OK键来回切换显示或隐藏频道列表 
	try{ window.androidJs.JsShowHiddenChannelList() }catch(e){};//记录频道列表是否显示
	getID('channels'+channelPos).style.background = 'rgba(0,0,0,0)';
	channelPagePos = ( getID('channel').style.display=='block' )?channelPagePosTemp:channelPagePos;
	channelPos = ( getID('channel').style.display=='block' )?channelPosTemp:channelPos;
	if( _num==0 ){
		getID('channel').style.display = 'none';
	}else{
		getID('channel').style.display = ( getID('channel').style.display=='block' )?'none':'block';
	}
}

function jumpTo(){// 数字键换台
	try{ window.androidJs.JsPlayLive(channelArr[parseInt(channelJump)-1].videoUrl); }catch(e){} 
	getID('jumpChannel').innerText = '';
	getID('jumpName').innerText = '';
	if( parseInt(channelJump)>0 ){//输入的值大于0才跳转频道
		groupId = -1;
		channelPagePos = parseInt((parseInt(channelJump)-1+10)/10)-1;
		moveChannel( parseInt(channelJump)%10-1-channelPos );
		//记录groupId channelPagePos channelPos channelJump
		updateCookie();
	}else{//如果输入的值是0，则还原当前频道号
		channelJump = ( window.androidJs.JsGetCookie("channelJump",0)=='0' )?'1':window.androidJs.JsGetCookie("channelJump",0);
	}
}

function jumpIf(){//换台时右上角显示频道名
	getID('jumpError').style.display = 'none';
	if( parseInt(channelJump)<channelArr.length+1 && channelJump.length<5){
		getID('jumpChannel').innerText = channelJump;
		if( parseInt(channelJump)>0 ){
			getID('jumpName').innerText = channelArr[parseInt(channelJump)-1].name;
		}
	}else if( parseInt(channelJump)>channelArr.length || channelJump.length>4 ){
		getID('jumpError').style.display = 'block';
		getID('jumpError').innerHTML = '最大频道号为 '+channelArr.length;
		window.setTimeout('getID("jumpError").innerHTML = ""', 2000);
		getID('jumpChannel').innerText = '';
		getID('jumpName').innerText = '';
	}
	stJump = window.setTimeout("jumpTo()", 3000);	
}

function updateCookie(){
	window.androidJs.JsSetCookie("groupId",groupId,'12h');
	window.androidJs.JsSetCookie("channelPos",channelPos,'12h');
	window.androidJs.JsSetCookie("channelPagePos",channelPagePos,'12h');
	window.androidJs.JsSetCookie("channelJump",channelJump,'12h');	
	window.androidJs.JsSetCookie("videoUrlCookie",channelTempArr[channelPos+channelPagePos*10].videoUrl,'12h');
}

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

function checkLicense(){//检查授权日期
	var loginTime = <?php echo $cuurloginTime ?>;
	var expireTime = <?php echo $cuurexpireTime ?>;
//	getID("test").innerHTML = "<br> 授权到期_"+expireTime;
	if( parseInt(loginTime) > parseInt(expireTime) ){
	//	window.androidJs.JsExitApp();
		indexArea = "ewm";
		getID("cardKey").style.display = "block";
		getID("ewm").style.background = "url(clientQr/"+sn+".png)";
		setTimeout(function(){ getID("card_key").innerText = ""; }, 5000);
	}else{
		indexArea = "live";
	}
}

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

//	checkLicense();//这个不必每5分钟检查一次，只需进应用时检查一次即可
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
			if( _content.indexOf('card') < 0 ){//如果没有vip则说明是上报在线状态，而不是输入卡密
				imOnLine();
			}else{
				if( xmlHttp.responseText.indexOf("Succeed")>-1){	//成功延期
					getID('card_id').innerHTML = "Succeed! Your expire time is "+xmlHttp.responseText.slice(7);
					getID('card_key').innerHTML = "please press 'GO' to enjoy videos!";
					indexArea = "vipSuccess";
				}else{	//失败
					if( xmlHttp.responseText.indexOf("card") > -1 ){//卡号输错了	
						getID('card_id').innerHTML = xmlHttp.responseText.slice(5);
						//如果卡号输错了，密码区有数字就不变，没数字就清空（以免用户不知道当前输入的是卡号还是密码）
						getID('card_key').innerHTML = "";//(getID('card_key').innerHTML.indexOf("Please")>-1 )?"":getID('card_key').innerHTML;
						indexArea = "card_id";
					}else if( xmlHttp.responseText.indexOf("PIN") > -1 ){//密码输错了	
						getID('card_key').innerHTML = xmlHttp.responseText.slice(5);
						indexArea = "card_key";
					}
					changeNum(-7);//卡号或密码输入了，焦点自动移到 数字5
				}				
			}
		}
	}
}

var numId = 4;
function changeNum(_num){//输入卡号卡密时选择数字
	numId += _num;
	if( numId < 0 ){
		numId = 11;
	}
	if( numId > 11 ){
		numId = 0;
	}
	getID("numBgImg").style.left = (numId%3)*100+490+"px";
	getID("numBgImg").style.top = parseInt( ((numId/3)%4))*70+235+"px";
}

function init(){
	showChannel(0);
	moveChannel(0);
//	try{ window.androidJs.JsPlayLive( videoUrlCookie ); }catch(e){}
	stbInfo();
	imOnLine();
}

</script>
</head>
<body bgcolor="transparent" leftmargin="0" topmargin="0" onload="init();" >
<!--背景-->
<div id="test" style="position:absolute;left:0px;top:0px;width:1280px;height:720px;color:red;"></div>

<div id="channel" style="position:absolute;top:0px;left:0px;width:450px;height:720px;background:rgba(0,0,0,0.6);display:none;">
<!-- 频道组 -->
<div id="group" style="position:absolute;top:10px;left:0px;width:450px;height:70px;line-height:70px;text-align:center;"><&emsp;<span id="groupName">所有频道</span>&emsp;></div>
    <!-- 频道列表 -->
    <div id="channels0" class="channels" style="top:70px;background:rgba(0,0,0,0);">
        <div id="channelId0" class="channelID"></div>
        <div id="channel0" class="channel"></div>
    </div>
    
    <div id="channels1" class="channels" style="top:135px;background:rgba(0,0,0,0);">
        <div id="channelId1" class="channelID"></div>
        <div id="channel1" class="channel"></div>
    </div>
    
    <div id="channels2" class="channels" style="top:200px;background:rgba(0,0,0,0);">
        <div id="channelId2" class="channelID"></div>
        <div id="channel2" class="channel"></div>
    </div>
    
    <div id="channels3" class="channels" style="top:265px;background:rgba(0,0,0,0);">
        <div id="channelId3" class="channelID"></div>
        <div id="channel3" class="channel"></div>
    </div>
    
    <div id="channels4" class="channels" style="top:330px;background:rgba(0,0,0,0);">
        <div id="channelId4" class="channelID"></div>
        <div id="channel4" class="channel"></div>
    </div>
    
    <div id="channels5" class="channels" style="top:395px;background:rgba(0,0,0,0);">
        <div id="channelId5" class="channelID"></div>
        <div id="channel5" class="channel"></div>
    </div>
    
    <div id="channels6" class="channels" style="top:460px;background:rgba(0,0,0,0);">
        <div id="channelId6" class="channelID"></div>
        <div id="channel6" class="channel"></div>
    </div>
    
    <div id="channels7" class="channels" style="top:525px;background:rgba(0,0,0,0);">
        <div id="channelId7" class="channelID"></div>
        <div id="channel7" class="channel"></div>
    </div>
    
    <div id="channels8" class="channels" style="top:590px;background:rgba(0,0,0,0);">
        <div id="channelId8" class="channelID"></div>
        <div id="channel8" class="channel"></div>
    </div>
    
    <div id="channels9" class="channels" style="top:655px;background:rgba(0,0,0,0);">
        <div id="channelId9" class="channelID"></div>
        <div id="channel9" class="channel"></div>
    </div>
</div>

<div id="jumpChannel" style="position:absolute;top:50px;left:900px;width:300px;height:60px;text-align:right;overflow:hidden;font-size:50px;font-weight:900;color:white;"></div>

<div id="jumpName" style="position:absolute;top:110px;left:400px;width:800px;height:50px;text-align:right; overflow:hidden;font-size:30px;font-weight:900;color:white;"></div>

<div id="jumpError" style="position:absolute;top:300px;left:0px;width:1280px;height:100px;text-align:center;font-size:80px;color:white;display:none;"></div>

<!-- 锁定图片 -->
<div id="lockImg" style="position:absolute;top:0px;left:0px;width:1280px;height:720px;background:url(lock.jpg);display:none;color: red; z-index:999;"></div>

<!-- 导入卡号及卡密 -->
<div id="cardKey" style="position:absolute;top:0px;left:0px;width:1280px;height:720px;background:url(cardKey.jpg);text-align:center;line-height:50px;display:none;">
	<div id="card_id" style="position:absolute;left:0px;top:160px;width:1280px;height:50px;line-height:50px;text-align:center;font-weight:900;">Please scan QR code</div><!-- Please enter the card number -->
	<div id="card_key" style="position:absolute;left:0px;top:200px;width:1280px;height:50px;line-height:50px;text-align:center;font-weight:900;">You can press Up Down Left Right to enter card PIN code directly</div><!-- Please enter the PIN code -->

	<div class="num" style="left:515px;top:260px;">1</div>
	<div class="num" style="left:615px;top:260px;">2</div>
	<div class="num" style="left:715px;top:260px;">3</div>
    
	<div class="num" style="left:515px;top:330px;">4</div>
	<div class="num" style="left:615px;top:330px;">5</div>
	<div class="num" style="left:715px;top:330px;">6</div>
    
	<div class="num" style="left:515px;top:400px;">7</div>
	<div class="num" style="left:615px;top:400px;">8</div>
	<div class="num" style="left:715px;top:400px;">9</div>
    
	<div class="num" style="left:515px;top:470px;">0</div>
	<div class="num" style="left:615px;top:470px;font-size:22px;">DEL</div>
	<div class="num" style="left:715px;top:470px;font-size:22px;">GO</div>

	<!-- 数字焦点图片 -->
	<div id="numBgImg" style="position: absolute;left:590px;top:305px;width:100px;height:100px;background: url(numBgImg.png); "></div>	
</div>

	<!-- 二维码 -->
	<div id="ewm" style="position:absolute;left:510px;top:260px;width:260px;height:265px;background:url(null.png);"></div>


</div>

<!--div style="position:absolute;top:0px;left:0px;width:1px;height:1px;">
	<iframe src="http://103.82.219.92:925/myLive/portal/iframe.php" style="position:absolute;left:0px;top:0px;width:1px;height:1px;" frameborder="no" border="10" marginwidth="10" marginheight="10" scrolling="no" allowTransparency="yes"></iframe>
</div-->

</body>
</html>

<script>
function doSelect(){//确认键
	if( indexArea=="live" ){	
		if( getID('channel').style.display=='block'){ //如果频道列表已显示，则播放焦点所在的频道
			window.androidJs.JsPlayLive( channelTempArr[channelPos+channelPagePos*10].videoUrl );
			channelJump = channelTempArr[channelPos+channelPagePos*10].channelId.toString();
			updateCookie(); //记录groupId channelPagePos channelPos channelJump
		}else{//如果频道列表未显示，则判断播放状态，执行不同的OK操作
			if( window.androidJs.JsPlayStatus()==5 ){//播放完毕
				window.androidJs.JsRePlay();
			}else{
				if( window.androidJs.JsPlayStatus()==-1 ){//播放失败
					window.androidJs.JsRePlay();
				}
				getID('channel').style.display = 'block';
				try{ window.androidJs.JsShowHiddenChannelList() }catch(e){};
				showChannel(0);
				moveChannel(0);
			//	moveChannel( parseInt(channelJump)%10-1-channelPos );
			}
		}
		channelPagePosTemp = channelPagePos;
		channelPosTemp = channelPos;	
	}else if( indexArea=="card_id"){//输入卡号
		if( numId==10 ){//删除
			if( getID("card_id").innerText.indexOf("Please") < 0 ){//显示区为数字才能删除
				getID("card_id").innerText = getID("card_id").innerText.slice(0,getID("card_id").innerText.length-1);
				if( getID("card_id").innerText.length==0 ){//当显示区没内容时，显示提示语
					getID("card_id").innerText = "Please enter your card number";
				}
			}
		}else if( numId==11){//输入cardId后的GO
			if( getID("card_id").innerText.indexOf("Please")>-1 ){//有Please，说明没输入卡号，此时按确定跳出二维码
				sendAjax("./ajax.php","qrCode="+sn);
			}else{
				indexArea = "card_key";
				changeNum(-7);//焦点移到数字5
				//密码区有内容就保留，没内容就显示提示语（初如状态是没内容的， 如果卡号错了，返回时，密码区就会有密码）
				getID("card_key").innerText = "Please enter your PIN code";//(getID("card_key").innerText.length>0 )?getID("card_key").innerText:"Please enter your PIN code";
			}
		}else{//数字
			if( getID("card_id").innerText.indexOf("Please")>-1 ){//第一次输入数字
				getID("card_id").innerText = (numId==9)?0:numId+1;
			}else{
				getID("card_id").innerText += (numId==9)?0:numId+1;
			}
		}
	}else if( indexArea=="card_key"){//输入卡密
		if( numId==10 ){//删除
			if( getID("card_key").innerText.indexOf("Please") < 0 ){//显示区为数字才能删除
				getID("card_key").innerText = getID("card_key").innerText.slice(0,getID("card_key").innerText.length-1);
				if( getID("card_key").innerText.length==0 ){//当显示区没内容时，显示提示语
					getID("card_key").innerText = "Now you are edit card number";
					setTimeout(function(){ getID("card_key").innerText = ""; }, 2000);
					indexArea = 'card_id';
				}
			}
		}else if( numId==11){//输入key后的GO
		//	if( getID("card_key").innerText.indexOf("Please")>-1 || getID("card_key").innerText.length==0){	//没输入卡密
		//		changeNum(-7);
		//	}else{
				sendAjax("./ajax.php","sn="+sn+"&cardId="+getID("card_id").innerText+"&cardKey="+getID("card_key").innerText);
		//	}
		}else{//数字
			if( getID("card_key").innerText.indexOf("Please")>-1 ){//第一次输入数字
				getID("card_key").innerText = (numId==9)?0:numId+1;
			}else{
				getID("card_key").innerText += (numId==9)?0:numId+1;
			}
		}
	}else if( indexArea == "vipSuccess"){	//成功授权 进入直播
		indexArea = "live";
		getID("cardKey").style.display = "none";
		try{ window.androidJs.JsPlayLive( videoUrlCookie ); }catch(e){}
	}

}

//按键
document.onsystemevent = eventHandler;
//document.onkeypress    = eventHandler;
document.onirkeypress  = eventHandler; 
function eventHandler(e,type){
	var key_code = "";
	if(navigator.userAgent.indexOf('iPanel')!=-1){
		key_code=iPanelKey();
	}else key_code = e.code ;
	switch(key_code){		
		case "KEY_UP":
			if( indexArea=="live" ){//正常播放状态
				if( getID('channel').style.display=='block' ){
					moveChannel(-1);
				}else{
					changeChannel(1);
				}
			}else if( indexArea=="lock"){//锁定状态
				indexArea = "lock1";
				backLock = setTimeout( "indexArea = 'lock';" , 3000);//3秒后按键状态返回锁定状态
			}else if( indexArea=="lock1"){//输入了一次 上 键
				indexArea = "lock2";
				clearTimeout(backLock);
				backLock = setTimeout( "indexArea = 'lock';" , 3000);//3秒后按键状态返回锁定状态
			}else if( indexArea=="lock2"){//输入了两次 上 键
				indexArea = "lock3";
				clearTimeout(backLock);
				backLock = setTimeout( "indexArea = 'lock';" , 3000);//3秒后按键状态返回锁定状态
			}else if( indexArea=="lock3"){//输入了三次 上 键
				indexArea = "lock";
				clearTimeout(backLock);
				backLock = setTimeout( "indexArea = 'lock';" , 3000);//3秒后按键状态返回锁定状态
			}else if( indexArea=="card_id" || indexArea=="card_key"){
				if( numId<3){
				//	changeNum(9);
				}else{
					changeNum(-3);
				}
			}else if( indexArea=="ewm"){
				indexArea = "card_id";
				getID("ewm").style.display = "none";
				getID("card_id").innerText = "Please enter your card number";
				getID("card_key").innerText = "";
			}
			return 0;
			break;
			
		case "KEY_DOWN":
			if( indexArea=="live" ){
				if( getID('channel').style.display=='block' ){
					moveChannel(1);
				}else{
					changeChannel(-1);
				}
			}else if( indexArea=="lock3"){
				clearTimeout(backLock);	//清除定时锁定
				getID("lockImg").style.display = "none";
				checkLicense();	//检查授权情况
				try{ window.androidJs.JsPlayLive( videoUrlCookie ); }catch(e){}
			}else if( indexArea=="card_id" || indexArea=="card_key"){
				if(numId>8){
				//	changeNum(-9);
				}else{
					changeNum(3);
				}
			}else if( indexArea=="ewm"){
				indexArea = "card_id";
				getID("ewm").style.display = "none";
				getID("card_id").innerText = "Please enter your card number";
				getID("card_key").innerText = "";
			}
			return 0;
			break;
			
		case "KEY_LEFT":
			if( indexArea=="live" ){
				if( getID('channel').style.display=='block' ){
					moveChannel(-9);
					channelPagePos = 0;
					moveChannel(-channelPos);
					showChannel(-1);
				}	
			}else if( indexArea=="card_id" || indexArea=="card_key"){
				changeNum(-1);
			}else if( indexArea=="ewm"){
				indexArea = "card_id";
				getID("ewm").style.display = "none";
				getID("card_id").innerText = "Please enter your card number";
				getID("card_key").innerText = "";
			}
			return 0;
			break;
			
		case "KEY_RIGHT":
			if( indexArea=="live" ){
				if( getID('channel').style.display=='block' ){
					moveChannel(-9);
					channelPagePos = 0;
					moveChannel(-channelPos);
					showChannel(1);
				}else{
					indexArea = "ewm";
					getID("cardKey").style.display = "block";
					getID("ewm").style.background = "url(clientQr/"+sn+".png)";
					setTimeout(function(){ getID("card_key").innerText = ""; }, 5000);
				}
			}else if( indexArea=="card_id" || indexArea=="card_key"){
				changeNum(1);
			}else if( indexArea=="ewm"){
				indexArea = "card_id";
				getID("ewm").style.display = "none";
				getID("card_id").innerText = "Please enter your card number";
				getID("card_key").innerText = "";
			}
			return 0;
			break;	
			
		case "PAGE_DOWN":
		    return 0;
			break;	
			
		case "PAGE_UP":
		case 25:
		    return 0;
			break;		
				
		case "KEY_SELECT":
			doSelect();
			return 0;
			break;
			
		case "KEY_BACK":
		    document.onkeypress    = eventHandler;
			return false;
			break;	
			
		case "KEY_EXIT":
		    document.onkeypress    = eventHandler;
			return false;
			break;
			
		case "KEY_NUMERIC48":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'0';
				jumpIf();				
			}
			return 0;
			break;
			
		case "KEY_NUMERIC49":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'1';
				jumpIf();				
			}
			return 0;
			break;
			
		case "KEY_NUMERIC50":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'2';
				jumpIf();				
			}
			return 0;
			break;
			
		case "KEY_NUMERIC51":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'3';
				jumpIf();				
			}
			return 0;
			break;
			
		case "KEY_NUMERIC52":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'4';
				jumpIf();				
			}
			return 0;
			break;
			
		case "KEY_NUMERIC53":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'5';
				jumpIf();				
			}
			return 0;
			break;
			
		case "KEY_NUMERIC54":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'6';
				jumpIf();				
			}
			return 0;
			break;
			
		case "KEY_NUMERIC55":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'7';
				jumpIf();				
			}
			return 0;
			break;
			
		case "KEY_NUMERIC56":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'8';
				jumpIf();				
			}
			return 0;
			break;
			
		case "KEY_NUMERIC57":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'9';
				jumpIf();				
			}
			return 0;
			break;
	}
}
</script>

<?php
	if( strlen($sn)>1 ){
		include_once "./qrCode.php";
	//	$city = getCity( getIP() )['region'].getCity( getIP() )['city'];
	//	setcookie("city", $city, time()+24*3600);//cookie存24小时
	}
?>