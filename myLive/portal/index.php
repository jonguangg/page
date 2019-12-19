<?php
	include "../connectMysql.php";
	include "../readStbArray.php";
	set_time_limit(0);
	error_reporting (E_ALL^E_NOTICE^E_WARNING);

	/**
	 * 获取用户真实 IP
	 */
	function getIP(){
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
//echo $ip;
	/**
	 * 获取 IP  地理位置
	 * 淘宝IP接口
	 * @Return: array
	 */
function getCity(){			// 获取当前位置所在城市 
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
//	echo $city;
	$sn = $_COOKIE["sn"];
	$mark = $_COOKIE["deviceInfo"];
//	echo $mark;
	$logintime = date("Y-m-d"); 
	$lasttime = date("Y-m-d H:i:s"); 
	$expiretime = date("Y-m-d",strtotime("+7 day")); 
	$isonline = "在线";
	$sql = mysqli_query($connect,"select * from license where sn='$sn' ") or die(mysqli_error($connect));
	$cuurLogintime = str_replace("-","",$logintime);	
	$cuurExpiretime = str_replace("-","",$expiretime);	
	
	if( mysqli_num_rows($sql)>0 ){
		while($row=mysqli_fetch_array($sql)){
			$logintime = $row["logintime"];
			$expiretime = $row["expiretime"]; 
			$cuurExpiretime = str_replace("-","",$expiretime);
		}
		$sql = mysqli_query($connect,"UPDATE license set isonline='$isonline',ip='$ip',city='$city',lasttime='$lasttime' where sn='$sn' ") or die(mysqli_error($connect));
	}else if( strlen($sn)>0 ){
		$sql = mysqli_query($connect,"replace into license(sn,mark,ip,city,logintime,expiretime,lasttime,isonline) values ('$sn','$mark','$ip','$city','$logintime','$expiretime','$lasttime','$isonline')") or die(mysqli_error($connect));
	}
	
//	session_start(); 
//	$_SESSION["$sn"] = $sn;

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
var groupId = parseInt(window.androidJs.JsGetCookie("groupId",0));
var channelPos = parseInt(window.androidJs.JsGetCookie("channelPos",0));
var channelPagePos = parseInt(window.androidJs.JsGetCookie("channelPagePos",0));
var channelPageAll = parseInt((channelCount-1+10)/10);
var channelJump = ( window.androidJs.JsGetCookie("channelJump",0)=='0' )?'1':window.androidJs.JsGetCookie("channelJump",0);
var videoUrlCookie = ( window.androidJs.JsGetCookie("videoUrlCookie",0)=='0' )?dataArr[0].channel[0].videoUrl:window.androidJs.JsGetCookie("videoUrlCookie",0);

var channelCount = 0;
var channelPagePosTemp = 0;
var channelPosTemp = 0;
var channelArr = [];

var indexArea = "lock"//打开应用后默认为锁定状态

for(i=0;i<dataArr.length;i++){//合并所有频道为一个数组 
	channelArr = channelArr.concat( dataArr[i].channel );
}
//console.log(channelArr[ channelArr.length-1 ].name);

var channelTempArr = [];//当前显示的频道组 
var groupSizeArr = [];//每个频道的节目数  
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

function showChannel(_num){
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

function moveChannel(_num){
	try{
		window.clearTimeout(st);
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

function changeChannel(_num){//上下键换台 
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

function jumpTo(){
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

function jumpIf(){
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
	sn = window.androidJs.JsGetMac();
	deviceBrand = window.androidJs.JsGetDeviceBrand();
	systemModel = window.androidJs.JsSystemModel();
	var deviceInfo = deviceBrand+" "+systemModel;
	setCookie("sn", sn, '1000d');
	setCookie("deviceInfo", deviceInfo, '1000d');
	return sn;
	getID("test").innerHTML = "<br> YourSN_"+deviceInfo;
}

function exitApp(){
	var logintime = <?php echo $cuurLogintime ?>;
	var expiretime = <?php echo $cuurExpiretime ?>;
//	getID("test").innerHTML = "<br> 授权到期_"+expiretime;
	if( parseInt(logintime) > parseInt(expiretime) ){
	//	window.androidJs.JsExitApp();
		getID('buyPrompt').style.display = 'block';
	}
//	window.setTimeout("exitApp()",60000);//60秒后运行
}
//window.setTimeout("exitApp()",60000);//60秒后运行

function imOnLine(){
	var now = new Date();
	var sec = now.getSeconds();
	var minu = ( (6-now.getMinutes()%5)*60000>300000 )?60000-sec*1000:(6-now.getMinutes()%5)*60000-sec*1000;
//	getID("test").innerHTML += "_"+now.getMinutes()+":"+sec;
	setTimeout('sendAjax();', minu);	
	exitApp();
}

function sendAjax(){
	// 1.创建XMLHttpRequest对象
	var xhr = new XMLHttpRequest();
	// 2.请求行
	xhr.open("POST", "./isOnLine.php");
	// 3.请求头
	xhr.setRequestHeader('Content-Type',' application/x-www-form-urlencoded');
	// 4.设置数据
	xhr.send('sn='+sn);
	// 5.监听服务器响应
	xhr.onreadystatechange = function(){
		if (xhr.readyState==4 && xhr.status==200){
			imOnLine();
		//	setTimeout('sendAjax();',300000);
		//	var now = new Date();
		//	getID("test").innerHTML += "_"+now.getMinutes()+":"+now.getSeconds();
		}
	}
}

var numId = 4;
function changeNum(_num){
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
<div id="lockImg" style="position:absolute;top:0px;left:0px;width:1280px;height:720px;background:url(lock.jpg);display:block;color: red;"></div>

<!-- 输入卡号及卡密 -->
<div id="cardKey" style="position:absolute;top:0px;left:0px;width:1280px;height:720px;background:url(cardKey.jpg);text-align:center;line-height:50px;display:none;">
	<div id="card_id" style="position:absolute;left:0px;top:160px;width:1280px;height:50px;line-height:50px;text-align:center;font-weight:900;">Please enter your card number</div><!-- Please enter the card number -->
	<div id="card_key" style="position:absolute;left:0px;top:200px;width:1280px;height:50px;line-height:50px;text-align:center;font-weight:900;"></div><!-- Please enter the card key -->

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
			if( getID("card_id").innerText !="Please enter your card number"){//显示区为数字才能删除
				getID("card_id").innerText = getID("card_id").innerText.slice(0,getID("card_id").innerText.length-1);
				if( getID("card_id").innerText.length==0 ){//当显示区没内容时，显示提示语
					getID("card_id").innerText = "Please enter your card number";
				}
			}
		}else if( numId==11){//GO
			indexArea = "card_key";
			getID("card_key").innerText = "Please enter your card key"
		}else{//数字
			if( getID("card_id").innerText =="Please enter your card number"){//第一次输入数字
				getID("card_id").innerText = numId+1;
			}else{
				getID("card_id").innerText += numId+1;
			}
		}
	}else if( indexArea=="card_key"){//输入卡密
		if( numId==10 ){//删除
			if( getID("card_key").innerText !="Please enter your card key"){//显示区为数字才能删除
				getID("card_key").innerText = getID("card_key").innerText.slice(0,getID("card_key").innerText.length-1);
				if( getID("card_key").innerText.length==0 ){//当显示区没内容时，显示提示语
					getID("card_key").innerText = "Please enter your card key";
				}
			}
		}else if( numId==11){//GO

			
		}else{//数字
			if( getID("card_key").innerText =="Please enter your card key"){//第一次输入数字
				getID("card_key").innerText = numId+1;
			}else{
				getID("card_key").innerText += numId+1;
			}
		}
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
			}else if( indexArea=="lock1"){
				indexArea = "lock2";
				clearTimeout(backLock);
				backLock = setTimeout( "indexArea = 'lock';" , 3000);//3秒后按键状态返回锁定状态
			}else if( indexArea=="lock2"){
				indexArea = "lock3";
				clearTimeout(backLock);
				backLock = setTimeout( "indexArea = 'lock';" , 3000);//3秒后按键状态返回锁定状态
			}else if( indexArea=="lock3"){
				indexArea = "lock3";
				clearTimeout(backLock);
				backLock = setTimeout( "indexArea = 'lock';" , 3000);//3秒后按键状态返回锁定状态
			}else if( indexArea=="card_id" || indexArea=="card_key"){
				if( numId<3){
					changeNum(9);
				}else{
					changeNum(-3);
				}
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
				clearTimeout(backLock);
				indexArea = "card_id";
				getID("lockImg").style.display = "none";
			//	getID("cardKey").style.display = "block";
			}else if( indexArea=="card_id" || indexArea=="card_key"){
				if(numId>7){
					changeNum(-9);
				}else{
					changeNum(3);
				}
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
				}
			}else if( indexArea=="card_id" || indexArea=="card_key"){
				changeNum(1);
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