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
	echo $city;

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
	
//	session_start(); //启动会话，session_start()函数必须位于 <html> 标签之前
//	$_SESSION["$sn"] = $sn;	//存储 session 变量
//	echo "您存储的SN session是：". $_SESSION['sn'];	//读取session
//	unset($_SESSION['sn']);	//释放指定的 session 变量
//	session_destroy() 将重置 session，您将失去所有已存储的 session 数据
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
	.channels{position:relative;left:0px;top:0px;width:100%;height:110px;line-height:110px;font-size:60px;color:white;z-index:0;}
	.channelID{position:relative;top:0px;left:0px;width:50%;height:110px;line-height:110px;text-align:center;}
	.channel{position:relative;top:-110px;left:30%;width:70%;height:110px;line-height:110px;text-align:center;}
	.num{position:absolute;width:50px;height:50px;border-radius:50% 50%;border:#F0F 2px solid;color:#F0F;}
	.tab-head{
		list-style-type: none;
		display:-webkit-box;
		display:-webkit-flex;
		display:-ms-flexbox;
		display:flex;
		-webkit-flex-wrap:nowrap;
		-ms-flex-wrap:nowrap;
		flex-wrap:nowrap;
		-webkit-box-pack:justify;
		-webkit-justify-content:space-between;
		-ms-flex-pack:justify;
		justify-content:space-between;
		background:#123456;	<!--FF4878-->
		padding:0px;
		overflow:auto;
      }
	.tab-head-item{
		-webkit-box-flex:1;
		-webkit-flex:1 0 auto;
		-ms-flex:1 0 auto;
		flex:1 0 auto;
		color:white;
		padding:0px 0px 0px 50px;
		font-size:70px;
		font-weight:900;
	}
	.vodListImg{position:relative;left:0px;top:0px;width:100%;background-size:100% 100% !important;z-index1;}	.vodListName{position:relative;left:0px;top:0px;width:100%;max-height:300px;overflow:auto;line-height:100px;text-align:center;font-size:70px;background-color:#123456;color:white;}
	.lockKey{position:absolute;top:20%;width:10%;height:100px;line-height:100px;border-bottom:4px white solid;}
	.lockNumR{width:33%;height:25%;display:flex;align-items:center;justify-content:center;position:absolute;border-top:4px white solid;border-right:4px white solid;}
	.lockNum{width:33%;height:25%;display:flex;align-items:center;justify-content:center;position:absolute;border-top:4px white solid;}
</style>

<script type=text/javascript src="global.js" charset=UTF-8></script>
<!--script type=text/javascript src="channelArr.js"></script-->
<!--script type=text/javascript src="testAdArr.js"></script-->
<script type=text/javascript src="vodArr.js"></script>
<script type=text/javascript src="register.js"></script>
<!-- script type=text/javascript src="jquery-1.11.0.min.js"></script -->
<script>
var dataArr = <?php echo json_encode($channelArr);?>;
//	console.log(dataArr);
var userKey = ( typeof(window.androidJs) != "undefined")?window.androidJs.JsGetCookie("userKey",0):"9527";
if( parseInt(userKey) == 0 ){//没设置密码时获取到的密码为0
	userKey = "9527";
}
var groupId = ( typeof(window.androidJs) != "undefined")?parseInt(window.androidJs.JsGetCookie("groupId",0)):0;

var channelPagePos = ( typeof(window.androidJs) != "undefined")?parseInt(window.androidJs.JsGetCookie("channelPagePos",0)):0;
var channelPageAll = parseInt((channelCount-1+10)/10);

var channelPos = ( typeof(window.androidJs) != "undefined")?parseInt(window.androidJs.JsGetCookie("channelPos",0)):0;
var videoUrlCookie = 0;//( window.androidJs.JsGetCookie("videoUrlCookie",0)=='0' )?dataArr[0].channel[0].videoUrl:window.androidJs.JsGetCookie("videoUrlCookie",0);
//	要在浏览器测试，需将这行上1个设为0

var channelCount = 0;
var channelPagePosTemp = 0;
var channelPosTemp = channelPos;
var channelArr = [];
var indexArea = "lock"//打开应用后默认为锁定状态

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

function showLiveList(){
	showChannel(0);//显示直播列表
	getID("channel"+channelPos).style.color = "gold";
	getID("channel").style.display = "block";
	getID("vodList").style.display = "none";
	getID('nav'+navPos).style.color = 'white';
	getID('navLive').style.color = 'gold';
	window.androidJs.JsPlayLive( channelTempArr[channelPos].videoUrl );
}

function updateCookie(){
	window.androidJs.JsSetCookie("groupId",groupId,'12h');
	window.androidJs.JsSetCookie("channelPos",channelPos,'12h');
//	window.androidJs.JsSetCookie("videoUrlCookie",channelTempArr[channelPos].videoUrl,'12h');
}

function startLive(_num){
	getID("channel"+channelPos).style.color = "white";
	window.androidJs.JsPlayLive( channelTempArr[_num].videoUrl );
	channelPos = _num;
	getID("channel"+channelPos).style.color = "gold";
	updateCookie(); 
}

function showChannel(_num){//显示频道组，即左右键切换频道组
	groupId += _num;
//	alert(groupId);
	if( groupId < 0){//改成<-1就显示所有频道
		groupId = dataArr.length-1;
	}
	if( groupId > dataArr.length-1){
		groupId = 0;//-1;负1就显示所有频道
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
	scrollTo(0,0);	
	getID("channels").innerHTML = "";
	for(i=0;i<channelTempArr.length;i++){
		getID("channels").innerHTML += '<div id=channels'+i+' class="channels" onClick=startLive('+i+');><div id=channelId'+i+ ' class="channelID"></div><div id=channel'+i+' class="channel"></div></div>';		
		getID('channel'+i).innerText = channelTempArr[i].name.slice(0,50);
		getID('channelId'+i).innerText = channelTempArr[i].channelId;
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
//	st = window.setTimeout("showHiddenChannelList(0)", 3000);//3秒后自动隐藏频道列表 
}

function changeChannel(_num){//播放时上下键换台 频道列表不显示出来，手机端需换成上下滑动
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
/*
var testArrIndex = 0;
function JumpTestArr(){
//	try{ window.androidJs.JsPlayLive( testAdArr[testArrIndex%testAdArr.length].m3u8 ); }catch(e){}
	try{ window.androidJs.JsPlayLive( "http://192.168.31.225:935/hls/fileList.m3u8" ); }catch(e){}
	testArrIndex ++;
//	setTimeout(JumpTestArr,60000);
}
//setTimeout(JumpTestArr,60000);
*/
function playVod(_num){
	try{ window.androidJs.JsPlayVod( "http://192.168.1.25:925/nvod/video/vod/"+navArr[navPos][vodPageCurr*10+_num].video+".m3u8" ); }catch(e){}	
}
var navListArr = ["Japan","White","Black","NP","Mosaic","HD","Chinese","Abuse","All"];

var mvArr = [];			//0
var newYearArr = [];	//1
var aviArr = [];		//2
var f4vArr = [];		//3
var mp4Arr = [];		//4
var rmvbArr = [];		//5
var seriesArr = [];		//6
var tsArr = [];			//7
var wmvArr = [];		//8
for(i=0;i<vodArr.length;i++){//将不同分类的单独放进一个数组(需严格按照竖线中间放分类的形式写tag)
	if( vodArr[i].tag.indexOf("|mv|")>-1 ){
		mvArr.push( vodArr[i] );
	}
	if( vodArr[i].tag.indexOf("|newYear|")>-1 ){
		newYearArr.push( vodArr[i] );
	}
	if( vodArr[i].tag.indexOf("|avi|")>-1 ){
		aviArr.push( vodArr[i] );
	}
	if( vodArr[i].tag.indexOf("|f4v|")>-1 ){
		f4vArr.push( vodArr[i] );
	}
	if( vodArr[i].tag.indexOf("|mp4|")>-1 ){
		mp4Arr.push( vodArr[i] );
	}
	if( vodArr[i].tag.indexOf("|rmvb|")>-1 ){
		rmvbArr.push( vodArr[i] );
	}
	if( vodArr[i].tag.indexOf("|series|")>-1 ){
		seriesArr.push( vodArr[i] );
	}
	if( vodArr[i].tag.indexOf("|ts|")>-1 ){
		tsArr.push( vodArr[i] );
	}
	if( vodArr[i].tag.indexOf("|wmv|")>-1 ){
		wmvArr.push( vodArr[i] );
	}
}
var navArr = [];			//将单独分类的数组拼成一个多维数组
navArr.push( mvArr );		//0
navArr.push( newYearArr );	//1
navArr.push( aviArr );		//2
navArr.push( f4vArr );		//3
navArr.push( mp4Arr );		//4
navArr.push( rmvbArr );		//5
navArr.push( seriesArr );	//6
navArr.push( tsArr );		//7
navArr.push( wmvArr );		//8

var vodPageCurr = 0;		//当前页
var navPos = 0;				//当前分类
var vodPageAll = parseInt( (navArr[navPos].length-1+10)/10 );	//总页数
function showVodList(_num){
	getID("vodList").style.display = "block";
	getID("channel").style.display = "none";
	scrollTo(0,0);
	getID("nav"+navPos).style.color = "white";
	getID('navLive').style.color = 'white';
	if( navPos != _num){	//如果换了分类，就将当前页码归0
		vodPageCurr = 0;
	}
	navPos = _num;
	vodPageAll = parseInt( (navArr[navPos].length-1+10)/10 );
	for(i=0;i<10;i++){
		if( navArr[navPos][vodPageCurr*10+i] ){
			getID("vodListImg"+i).style.display = "block";
			getID("vodListName"+i).style.display = "block";
			getID("vodListImg"+i).style.backgroundImage = "url(../../video/"+navArr[navPos][vodPageCurr*10+i].video+".png)";
			getID("vodListName"+i).innerText = navArr[navPos][vodPageCurr*10+i].name;
			if( parseInt(window.getComputedStyle( getID("vodListName"+i) ).height)>110 ){
				getID("vodListName"+i).style.textAlign = "left";
			}else{
				getID("vodListName"+i).style.textAlign = "center";
			}
		}else{
			getID("vodListImg"+i).style.display = "none";
			getID("vodListName"+i).style.display = "none";
		}
	}
	if( vodPageCurr < vodPageAll-1 ){
		getID("vodNextPage").style.display = "block";
	}else{
		getID("vodNextPage").style.display = "none";
	}	
	getID("nav"+navPos).style.color = "gold";
}

function pageDown(){
	if( vodPageCurr < vodPageAll-1 ){
		vodPageCurr ++;
		showVodList(navPos);
	}
	scrollTo(0,0);
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
	window.androidJs.JsVibrate(40);
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
	var clientWidth  = document.body.scrollWidth ;
	var clientHeight  = window.innerHeight;	
	getID('bodys').style.width = clientWidth+"px";	
	getID("lock").style.height = clientHeight+"px";
	getID("cardKey").style.height = clientHeight+"px";
	
	for(i=0;i<10;i++){
		getID("vodListImg"+i).style.height = "1px";
	}
	showVodList(0);//预加载	
	imOnLine();
//	alert('网页可见区域宽：'+document.body.clientWidth+'\n网页可见区域高：'+document.body.clientHeight+'\n网页可见区域宽：'+document.body.offsetWidth+ '\n网页可见区域高：'+document.body.offsetHeight+ '\n网页正文全文宽：'+document.body.scrollWidth+ '\n网页正文全文高：'+document.body.scrollHeight+ '\n网页被卷去的高：'+document.body.scrollTop+ '\n网页被卷去的左：'+document.body.scrollLeft+'\n网页正文部分上：'+window.screenTop+ '\n网页正文部分左：'+window.screenLeft+ '\n屏幕分辨率的高：'+window.screen.height+ '\n屏幕分辨率的宽：'+window.screen.width+ '\n屏幕可用工作区高度：'+window.screen.availHeight+'\n屏幕可用工作区宽度：'+window.screen.availWidth+'\nwindow.innerHeight：'+window.innerHeight);
}
</script>
</head>
<body bgcolor="#123456" leftmargin="0" topmargin="0" onload="init();" >
<!-- 测试 
<div id="test" style="position:absolute;left:0px;top:0px;width:1200px;height:720px;background-color:white;z-index:99;color:red;font-size:100px;"></div>
-->
<div id="bodys" style="position:absolute;top:0px;left:0px;width:100%;display:block;">
	<!-- 顶部分类导航栏 -->
	<div id="vodNav" style="position:fixed;top:0px;left:0px;width:100%;height:130px;line-height:130px;z-index:2;">
		<ul class="tab-head">
			<li class="tab-head-item" id="navLive" onClick="showLiveList();">Live</li>
			<li class="tab-head-item" id="nav0" onClick="showVodList(0);">Japan</li>
			<li class="tab-head-item" id="nav1" onClick="showVodList(1);">White</li>
			<li class="tab-head-item" id="nav2" onClick="showVodList(2);">Black</li>
			<li class="tab-head-item" id="nav3" onClick="showVodList(3);">NP</li>
			<li class="tab-head-item" id="nav4" onClick="showVodList(4);">All</li>
			<li class="tab-head-item" id="nav5" onClick="showVodList(5);">Mosaic</li>
			<li class="tab-head-item" id="nav6" onClick="showVodList(6);">HD</li>
			<li class="tab-head-item" id="nav7" onClick="showVodList(7);">Chinese</li>
			<li class="tab-head-item" id="nav8" onClick="showVodList(8);">abuse</li>
		</ul>
	</div>
	
	<!-- 直播频道列表 -->
	<div id="channel" style="position:absolute;top:0px;left:0px;width:100%;display:none;">
		<!-- 频道组 -->
		<div id="group" style="position:fixed;top:130px;left:0px;width:100%; height:120px;line-height:120px;text-align:center;font-size:65px;font-weight:500;color:gold;z-index:2;background-color:#123456;border-bottom:2px solid white; border-top:2px solid white; ">
			<span style="position:absolute;left:0px;width:50%;text-align:center;" onClick="showChannel(-1);"><<<<<<</span>&emsp;
			<span id="groupName">所有频道</span>&emsp;
			<span style="position:absolute;right:0px;width:50%;text-align:center;" onClick="showChannel(1);">>>>>>></span>
		</div>
		
		<!-- 频道列表 -->
		<div id="channels" class="channels" style="position:absolute;left:0px;top:260px;">
			<!--div id="channels0" class="channels" onClick="startLive(5);" >
				<div id="channelId0" class="channelID"></div>
				<div id="channel0" class="channel"></div>
			</div>
			
			<div id="channels1" class="channels">
				<div id="channelId1" class="channelID"></div>
				<div id="channel1" class="channel"></div>
			</div>
			
			<div id="channels2" class="channels">
				<div id="channelId2" class="channelID"></div>
				<div id="channel2" class="channel"></div>
			</div>
			
			<div id="channels3" class="channels">
				<div id="channelId3" class="channelID"></div>
				<div id="channel3" class="channel"></div>
			</div>
			
			<div id="channels4" class="channels">
				<div id="channelId4" class="channelID"></div>
				<div id="channel4" class="channel"></div>
			</div>
			
			<div id="channels5" class="channels">
				<div id="channelId5" class="channelID"></div>
				<div id="channel5" class="channel"></div>
			</div>
			
			<div id="channels6" class="channels">
				<div id="channelId6" class="channelID"></div>
				<div id="channel6" class="channel"></div>
			</div>
			
			<div id="channels7" class="channels">
				<div id="channelId7" class="channelID"></div>
				<div id="channel7" class="channel"></div>
			</div>
			
			<div id="channels8" class="channels">
				<div id="channelId8" class="channelID"></div>
				<div id="channel8" class="channel"></div>
			</div>
			
			<div id="channels9" class="channels">
				<div id="channelId9" class="channelID"></div>
				<div id="channel9" class="channel"></div>
			</div>
			
			<div id="channels10" class="channels">
				<div id="channelId10" class="channelID"></div>
				<div id="channel10" class="channel"></div>
			</div>
			
			<div id="channels11" class="channels">
				<div id="channelId11" class="channelID"></div>
				<div id="channel11" class="channel"></div>
			</div>
			
			<div id="channels12" class="channels">
				<div id="channelId12" class="channelID"></div>
				<div id="channel12" class="channel"></div>
			</div>
			
			<div id="channels13" class="channels">
				<div id="channelId13" class="channelID"></div>
				<div id="channel13" class="channel"></div>
			</div>
			
			<div id="channels14" class="channels">
				<div id="channelId14" class="channelID"></div>
				<div id="channel14" class="channel"></div>
			</div>
			
			<div id="channels15" class="channels">
				<div id="channelId15" class="channelID"></div>
				<div id="channel15" class="channel"></div>
			</div>
			
			<div id="channels16" class="channels">
				<div id="channelId16" class="channelID"></div>
				<div id="channel16" class="channel"></div>
			</div-->
		</div>
	</div>

	<!-- 点播列表 -->
	<div id="vodList" style="position:absolute;top:120px;left:0px;width:100%;display:none;">
		<div id="vodListImg0" class="vodListImg" style="height:480px;background:url(null.png);" onClick="playVod(0);"></div>
		<div id="vodListName0" class="vodListName"></div>
		
		<div id="vodListImg1" class="vodListImg" style="height:480px;background:url(null.png);" onClick="playVod(1);"></div>
		<div id="vodListName1" class="vodListName"></div>
		
		<div id="vodListImg2" class="vodListImg" style="height:480px;background:url(null.png);" onClick="playVod(2);"></div>
		<div id="vodListName2" class="vodListName"></div>
		
		<div id="vodListImg3" class="vodListImg" style="height:480px;background:url(null.png);" onClick="playVod(3);"></div>
		<div id="vodListName3" class="vodListName"></div>
		
		<div id="vodListImg4" class="vodListImg" style="height:480px;background:url(null.png);" onClick="playVod(4);"></div>
		<div id="vodListName4" class="vodListName"></div>
		
		<div id="vodListImg5" class="vodListImg" style="height:480px;background:url(null.png);" onClick="playVod(5);"></div>
		<div id="vodListName5" class="vodListName"></div>
		
		<div id="vodListImg6" class="vodListImg" style="height:480px;background:url(null.png);" onClick="playVod(6);"></div>
		<div id="vodListName6" class="vodListName"></div>
		
		<div id="vodListImg7" class="vodListImg" style="height:480px;background:url(null.png);" onClick="playVod(7);"></div>
		<div id="vodListName7" class="vodListName"></div>
		
		<div id="vodListImg8" class="vodListImg" style="height:480px;background:url(null.png);" onClick="playVod(8);"></div>
		<div id="vodListName8" class="vodListName"></div>
		
		<div id="vodListImg9" class="vodListImg" style="height:480px;background:url(null.png);" onClick="playVod(9);"></div>
		<div id="vodListName9" class="vodListName"></div>
		
		<div id="vodNextPage" class="vodListName" style="height:200px;line-height:200px;color:gray;" onClick="pageDown();" >press here to load next page</div>
	</div>
	
	<!-- 解锁界面 -->
	<div id="lock" style="position:absolute;top:0px;left:0px;width:100%;height:0px;background-color:#123456;display:block;text-align:center;font-size:80px;color:white; z-index:9;">
		<div style="position:absolute;top:10%;left:0px;width:100%;height:100px;line-height:100px;">Please enter your key</div>
		
		<span id="lockKey1" class="lockKey" style="left:15%;"></span>
		<span id="lockKey2" class="lockKey" style="left:35%;"></span>
		<span id="lockKey3" class="lockKey" style="left:55%;"></span>
		<span id="lockKey4" class="lockKey" style="left:75%;"></span>
		
		<div id="prompt" style="position:absolute;left:0px;top:40%;width:100%;max-height:300px;line-height:100px;font-size:80px;"></div>
		
		<div style="position:absolute;left:0px;top:60%;width:100%;height:40%;">
			<div class="lockNumR" style="left:0px;top:0px;" onClick="checkPin(1);">1</div>
			<div class="lockNumR" style="left:33%;top:0px;" onClick="checkPin(2);">2</div>
			<div class="lockNum" style="left:66%;top:0px;" onClick="checkPin(3);">3</div>
			
			<div class="lockNumR" style="left:0px;top:25%;" onClick="checkPin(4);">4</div>
			<div class="lockNumR" style="left:33%;top:25%;" onClick="checkPin(5);">5</div>
			<div class="lockNum" style="left:66%;top:25%;" onClick="checkPin(6);">6</div>
			
			<div class="lockNumR" style="left:0px;top:50%;" onClick="checkPin(7);">7</div>
			<div class="lockNumR" style="left:33%;top:50%;" onClick="checkPin(8);">8</div>
			<div class="lockNum" style="left:66%;top:50%;" onClick="checkPin(9);">9</div>
			
			<div class="lockNumR" style="left:0px;top:75%;" onClick="checkPin(0);">0</div>
			<div class="lockNumR" style="left:33%;top:75%;" onClick="checkPin(10);">Alter</div>
			<div class="lockNum" style="left:66%;top:75%;" onClick="checkPin(11);">DEL</div>
		</div>
	</div>

	<!-- 输入卡号及卡密 -->
	<div id="cardKey" style="position:absolute;top:0px;left:0px;width:100%;height:0px;background-color:#123456;display:none;text-align:center;font-size:80px;color:white; z-index:10;">
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

<div id="jumpChannel" style="position:absolute;top:50px;left:900px;width:300px;height:60px;text-align:right;overflow:hidden;font-size:50px;font-weight:900;color:white;"></div>

<div id="jumpName" style="position:absolute;top:110px;left:400px;width:800px;height:50px;text-align:right; overflow:hidden;font-size:30px;font-weight:900;color:white;"></div>

<div id="jumpError" style="position:absolute;top:300px;left:0px;width:1280px;height:100px;text-align:center;font-size:80px;color:white;display:none;"></div>

<!-- 二维码 -->
<div id="ewm" style="position:absolute;left:510px;top:260px;width:260px;height:265px;background:url(null.png);"></div>

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
