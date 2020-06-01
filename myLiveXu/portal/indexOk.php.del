<?php
	include "../connectMysql.php";
	include "../readStbArray.php";
	set_time_limit(0);
	$sn = $_COOKIE["sn"];
	$logintime = date("Y-m-d"); 
	$expiretime = date("Y-m-d",strtotime("+7 day")); 
	$isonline = "在线";
	$sql = mysqli_query($connect,"select * from license where sn='$sn' ") or die(mysqli_error($connect));
	
	if( mysqli_num_rows($sql)>0 ){
	#	$sql = mysqli_query($connect,"select expiretime from license where sn='$sn' ") or die(mysqli_error($connect));
		while($row=mysqli_fetch_array($sql)){
			$logintime = $row["logintime"];
			$expiretime = $row["expiretime"]; 
		}
		$sql = mysqli_query($connect,"UPDATE license set isonline='$isonline' where sn='$sn' ") or die(mysqli_error($connect));
	}else if( strlen($sn)>0 ){
		$sql = mysqli_query($connect,"replace into license(sn,logintime,expiretime,isonline) values ('$sn','$logintime','$expiretime','$isonline')") or die(mysqli_error($connect));
	}
	$cuurLogintime = str_replace("-","",$logintime);	
	$cuurExpiretime = str_replace("-","",$expiretime);

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
</style>

<script type=text/javascript src="global.js" charset=UTF-8></script>
<script type=text/javascript src="channelArr.js"></script>
<script>

var groupId = parseInt(window.androidJs.JsGetCookie("groupId",0));
var channelPos = parseInt(window.androidJs.JsGetCookie("channelPos",0));
var channelPagePos = parseInt(window.androidJs.JsGetCookie("channelPagePos",0));
var channelPageAll = parseInt((channelCount-1+10)/10);
var channelJump = ( window.androidJs.JsGetCookie("channelJump",0)=='0' )?'1':window.androidJs.JsGetCookie("channelJump",0);
var videoUrlCookie = ( window.androidJs.JsGetCookie("videoUrlCookie",0)=='0' )?dataArr[0].channel[0].videoUrl:window.androidJs.JsGetCookie("videoUrlCookie",0);

/*
var groupId = 0;
var channelPos = 0;
var channelPagePos = 0;
var channelPageAll = parseInt((channelCount-1+10)/10);
var channelJump = 0;
var videoUrlCookie = 0;
*/

var channelCount = 0;
var channelPagePosTemp = 0;
var channelPosTemp = 0;
var channelArr = [];
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

function stbInfo(){
	var sn = window.androidJs.JsGetMac();
//	getID("test").innerHTML = "<br>YourSN_"+sn;
	setCookie("sn", sn, '1d');
}

function exitApp(){
	var logintime = <?php echo $cuurLogintime ?>;
	var expiretime = <?php echo $cuurExpiretime ?>;
	if( parseInt(logintime) > parseInt(expiretime) ){
	//	window.androidJs.JsExitApp();
		getID('buyPrompt').style.display = 'block';
	}
}
window.setTimeout("exitApp()",6000);//60秒后运行

function init(){
	showChannel(0);
	moveChannel(0);
	try{ window.androidJs.JsPlayLive( videoUrlCookie ); }catch(e){}
	stbInfo();
}
</script>
</head>
<body bgcolor="transparent" leftmargin="0" topmargin="0" onload="init();" >

<!--背景图片-->
<div style="position:absolute;left:0px;top:0px;width:1280px;height:720px;"></div>

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

<div id="buyPrompt" style="position:absolute;top:0px;left:0px;width:1280px;height:720px;background:url(buy.jpeg);font-size:60px;color:red;text-align:center;display:none;"></div>

</body>
</html>

<script>
function doSelect(){//确认键
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
			if( getID('channel').style.display=='block' ){
				moveChannel(-1);
			}else{
				changeChannel(1);
			}
			return 0;
			break;
			
		case "KEY_DOWN":
			if( getID('channel').style.display=='block' ){
				moveChannel(1);
			}else{
				changeChannel(-1);
			}
			return 0;
			break;
			
		case "KEY_LEFT":
			if( getID('channel').style.display=='block' ){
				moveChannel(-9);
				channelPagePos = 0;
				moveChannel(-channelPos);
				showChannel(-1);
			}
			return 0;
			break;
			
		case "KEY_RIGHT":
			if( getID('channel').style.display=='block' ){
				moveChannel(-9);
				channelPagePos = 0;
				moveChannel(-channelPos);
				showChannel(1);
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