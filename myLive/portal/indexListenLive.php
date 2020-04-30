<script type=text/javascript src="js/global.js" charset=UTF-8></script>
<script type=text/javascript src="js/init2.js"></script>
<script type=text/javascript src="js/register2.js"></script>
<script type=text/javascript src="js/touchMove2.js" charset=UTF-8></script>
<script type=text/javascript src="js/searchHistoryCollect.js" charset=UTF-8></script>
<script type=text/javascript src="../jquery-1.11.0.min.js" charset=UTF-8></script>

<script type=text/javascript src="./listenLive.js" charset=UTF-8></script>
<script type=text/javascript src="./listenLiveArr.js" charset=UTF-8></script>
<!--script type=text/javascript src="../../jiangZhiBo/download/listenZhuBo.js" charset=UTF-8></script-->

<?php
include_once "readSplash.php";
include_once "../connectMysql.php";
//	include_once "../readStbArray.php";
include_once "../readChannelArray.php";
include_once "../readTagNav.php";	//获取分类标签
include_once "readHomeList.php";	//首页每类前4个
set_time_limit(0); //限制页面执行时间,0为不限制
//	error_reporting(0);// 关闭所有PHP错误报告
//	error_reporting(-1);// 报告所有 PHP 错误=error_reporting(E_ALL);
//	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);// 报告 E_NOTICE也挺好 (报告未初始化的变量或者捕获变量名的错误拼写)
error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

function getIP(){	//获取用户真实 IP
	static $realip;
	if (isset($_SERVER)) {
		if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
			$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
		} else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
			$realip = $_SERVER["HTTP_CLIENT_IP"];
		} else {
			$realip = $_SERVER["REMOTE_ADDR"];
		}
	} else {
		if (getenv("HTTP_X_FORWARDED_FOR")) {
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
setcookie("ip", $ip, time() + 24 * 3600); //cookie存24小时	echo $ip;

function getCity(){			// 获取当前IP所在城市 
	$getIp = getIP();
	$content = file_get_contents("http://api.map.baidu.com/location/ip?ak=2TGbi6zzFm5rjYKqPPomh9GBwcgLW5sS&ip={$getIp}&coor=bd09ll");
	$json = json_decode($content);
	$address = $json->{'content'}->{'address'}; //按层级关系提取address数据 
	$data['address'] = $address;
	$return['province'] = mb_substr($data['address'], 0, 3, 'utf-8');
	$return['city'] = mb_substr($data['address'], 3, 3, 'utf-8');
	return $return['province'] . $return['city'];
}
$city = getCity();
setcookie("city", $city, time() + 24 * 3600); //cookie存24小时	echo $city;

$sn = $_POST['imOnLineSN'];
$mark = $_COOKIE["deviceInfo"];	//机顶盒备注
$loginTime = date("Y-m-d"); 						//机顶盒打开APP的时间
$intLloginTime = str_replace("-", "", $loginTime);	//为了便于比大小将时间内的-删掉
$expireTime = date("Y-m-d", strtotime("+1 day")); 	//初次安装的授权到期时间
//	$intExpireTime = str_replace("-","",$expireTime);	//为了便于比大小将时间内的-删掉	
$lastTime = date("Y-m-d H:i:s"); 					//机顶盒上一次打开APP的时间
$isOnLine = "在线";									//每次进入应用都激活在线状态
$sql = mysqli_query($connect, "select * from client where sn='$sn' ") or die(mysqli_error($connect));
if (mysqli_num_rows($sql) > 0) { //如果数据库中有当前机顶盒
	while ($row = mysqli_fetch_array($sql)) {
		//	$expireTime = $row["expireTime"];						//从数据库获取真实的到期时间
		//	$intExpireTime = str_replace("-","",$expireTime);		//为了便于比大小将时间内的-删掉
		//	setcookie("expireTime", $expireTime, time()+8*3600);	//cookie存8小时，供个人中心显示用
	}
	$sql = mysqli_query($connect, "UPDATE client set isOnLine='$isOnLine',ip='$ip',city='$city',lastTime='$lastTime' where sn='$sn' ") or die(mysqli_error($connect));	 //更新在线状态
	
	$sql2 = mysqli_query($connect, "INSERT INTO login SET sn='$sn' ") or die(mysqli_error($connect)); 	//记录登陆时间

} else if (strlen($sn) > 0) { //如果数据库中没有当前机顶盒，且当前机顶盒有SN
	$sql = mysqli_query($connect, "replace into client(sn,mark,ip,city,loginTime,expireTime,lastTime,isOnLine) values ('$sn','$mark','$ip','$city','$loginTime','$expireTime','$lastTime','$isOnLine')") or die(mysqli_error($connect));
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
	<link rel="stylesheet" type="text/css" href="style2.css" >
	<link rel="stylesheet" type="text/css" href="circle/css/normalize.css" /><!--CSS RESET-->
	<link rel="stylesheet" type="text/css" href="circle/css/style.css" />
	<script>
		var intLoginTime = <?php echo $intLloginTime ?>; //应用登陆时间，其实这个没必要去后台获取，只要取当前时间即可
		var channelDataArr = <?php echo json_encode($channelArr); ?>;
		var tagArr = <?php echo json_encode($tagArr); ?>;
		var homeArr4 = <?php echo json_encode($homeArr4); ?>;
		var userKey = (typeof(window.androidJs) != "undefined") ? window.androidJs.JsGetCookie("userKey", 0) : "9527";
		if (parseInt(userKey) == 0) { //没设置密码时获取到的密码为0
			userKey = "9527";
		}
		var groupId = (typeof(window.androidJs) != "undefined") ? parseInt(window.androidJs.JsGetCookie("groupId", 0)) : 0;
		var channelPagePos = (typeof(window.androidJs) != "undefined") ? parseInt(window.androidJs.JsGetCookie("channelPagePos", 0)) : 0;
		var channelPos = (typeof(window.androidJs) != "undefined") ? parseInt(window.androidJs.JsGetCookie("channelPos", 0)) : 0;
		var channelCount = 0;
		var channelPageAll = parseInt((channelCount - 1 + 10) / 10);
	//	var channelPagePosTemp = 0;
	//	var channelPosTemp = channelPos;
		var channelArr = [];
		var videoUrlCookie = 0; //( window.androidJs.JsGetCookie("videoUrlCookie",0)=='0' )?channelDataArr[0].channel[0].videoUrl:window.androidJs.JsGetCookie("videoUrlCookie",0);

		var imgHeight = "280px"; //图片高度，会在init内根据屏幕宽按16:9重新计算
		var indexArea = "home";
		var navPos = 0; //当前分类 0为home 1为movie -1为直播

		for (i = 0; i < channelDataArr.length; i++) { //合并所有频道为一个数组，便于显示所有频道和跳转
			channelArr = channelArr.concat(channelDataArr[i].channel);
		}

		var channelTempArr = []; //当前显示的频道组 
		var groupSizeArr = []; //每个组的节目数  
		for (i = 0; i < channelDataArr.length; i++) {
			groupSizeArr.push(channelDataArr[i].channel.length);
		}

		var groupStartArr = [1]; //每个频道组第一个频道号 
		for (i = 1; i < groupSizeArr.length; i++) {
			var groupStart = 1;
			for (j = 0; j < i; j++) {
				groupStart += groupSizeArr[j];
			}
			groupStartArr.push(groupStart);
		}

		function androidBack(){	//供返回键调用
			window.androidJs.JsClosePlayer();
		//	alert("from_"+from+"_indexArea1_"+indexArea);
			if( indexArea =="live" ){
				getID("group" + groupId).style.color = 'white';
				getID("channel").style.display = "none";
				getID("vod").style.display = "block";
				indexArea = "home";
				navPos = 0;
			}else if( indexArea == "detail" ){
				indexArea = from;
				getID("vod").style.display = "block";
				getID("detail").style.display = "none";
				if( from=="search" || from=="history" ||from=="collect" ){
					getID("searchHistoryCollect").style.display = "block";
				}
			}
		//	alert("from_"+from+"_indexArea2_"+indexArea);
		}

		var groupScrollL = 0;
		function showLiveList(_num) {	//显示直播列表
		//	var clientWidth = document.body.scrollWidth;
			for (i = 0; i < channelDataArr.length; i++) { //显示频道组
				getID("groups").innerHTML += '<li class=tab-live-item id=group' + i + ' style="font-weight:500" onClick=showChannel(' + i + ');></li>';
				getID("group" + i).innerHTML = channelDataArr[i].group;
			}
			channelPos = (groupId == _num)?channelPos:0;	//如果回上次看的组，则不变频道，否则播放第1个
			navPos = -1;	//当前区域定为直播
			groupId = _num;
			showChannel(groupId); 
			getID("vod").style.display = "none";
			getID("channel").style.display = "block";
			getID("channel" + channelPos).style.color = "#f7a333";
			getID("channelId" + channelPos).style.color = "#f7a333";

			getID("group").style.top = (clientWidth * 9 / 16 - 1) + "px"; //频道组
			getID("channels").style.top = (clientWidth * 9 / 16 + 90) + "px"; //频道列表
			if (typeof(window.androidJs) != "undefined") {
				window.androidJs.JsPlayLive(channelTempArr[channelPos].videoUrl);
			//	window.androidJs.JsMovePlayerWindow(0);	//2.0版小窗口固定在上方，不需移动
			}
			groupScrollL = (groupId - 1) * 300;
			getID("groups").scrollLeft = groupScrollL;
			window.androidJs.JsSetPageArea("live");
			indexArea = "live";
		}

		function startLive(_num) {	//播放直播频道
			getID("channel" + channelPos).style.color = "white";
			getID("channelId" + channelPos).style.color = "white";
			channelPos = _num;
			getID("channel" + channelPos).style.color = "#f7a333";
			getID("channelId" + channelPos).style.color = "#f7a333";
			updateCookie();
			if (typeof(window.androidJs) != "undefined") {
				window.androidJs.JsPlayLive(channelTempArr[_num].videoUrl);
			}
		}

		function showChannel(_num) { //切换频道组
			groupScrollL += (_num - groupId) * 300; //移动分类的位置
			getID("groups").scrollLeft = groupScrollL;
			getID("group" + groupId).style.color = 'white'; //"#081925";
			groupId = _num;
			getID("group" + groupId).style.color = "#f7a333";
			channelTempArr = [];
			channelTempArr = (groupId == -1) ? channelArr : channelTempArr.concat(channelDataArr[groupId].channel);
			channelCount = channelTempArr.length;
			channelPageAll = parseInt((channelCount - 1 + 10) / 10);
			scrollTo(0, 0);
			getID("channels").innerHTML = "";
			getID("channel").style.left = "0px";
			for (i = 0; i < channelTempArr.length; i++) {
				getID("channels").innerHTML += '<div id=channels' + i + ' class="channels" onClick=startLive(' + i + ');><div id=channelId' + i + ' class="channelID" ><img class="liveListImg" src=live/'+channelTempArr[i].channelLogo+' /><div class="liveLine" ></div></div><div id=channel' + i + ' class="channel"></div></div>';
				getID('channel' + i).innerText = channelTempArr[i].name.slice(0, 50);
			}
		}

		function moveChangeGroup(_num) { //滑动切换直播分类
			var groupIdTemp = groupId;
			groupIdTemp += _num;
			if (groupIdTemp < 0) {
				groupIdTemp = 0;
			}
			if (groupIdTemp > channelDataArr.length - 1) {
				groupIdTemp = channelDataArr.length - 1;
			}
			showChannel(groupIdTemp);
		}

		function updateCookie() {
			if (typeof(window.androidJs) != "undefined") {
				window.androidJs.JsSetCookie("groupId", groupId, '12h');
				window.androidJs.JsSetCookie("channelPos", channelPos, '12h');
				//	window.androidJs.JsSetCookie("videoUrlCookie",channelTempArr[channelPos].videoUrl,'12h');
			}
		}
	
		//	显示分类列表
		var tag1 = 0;	//一级分类，即电影 电视剧……
		var tag2 = 0;	//二级分类，即地区
		var tag3 = 0;	//三级分类，即爱情、动作、喜剧之类的分类标签
		var pageNow = 1; //第一页是1
		var vodPageAll = 1;
		var changePageStatus = "f"; //；加载状态，f为未完成，此时不加载下一页

		function getTagData(_tag1, _tag2,_tag3,_pageNum, _pageSize, _mobile) {
			if (navPos < 0) { 	//从直播切换到点播
				getID("vod").style.display = "block";
				getID("channel").style.display = "none";
				if (typeof(window.androidJs) != "undefined") {
					window.androidJs.JsClosePlayer();
				}
			}
			getID("nav" + navPos).style.color = "white"; 
			getID("nav" + navPos).style.backgroundImage = "url(img/"+tagArr[1][navPos].tagTable+"0.png)"; 

			navPos = _tag1;
			getID("vodTab1").scrollLeft = ( (navPos-2)>0 )?(navPos-2)*200:0;
			getID("nav" + navPos).style.color = "f7a333";
			getID("nav" + navPos).style.backgroundImage = "url(img/"+tagArr[1][navPos].tagTable+"1.png)"; 			
			if(_tag1==0){	//显示首页
				indexArea = "home";
				getID("vodTab").style.display = "none";
				for(i=1;i<6;i++){
					getID("vodList"+i).style.display = "none";
					getID("vodListContent"+i).innerHTML = "";
				}
				getID("vodList0").style.display = "block";
				getID("vodList0").style.left = "0px";
				return;
			}else{
				getID("vodTab").style.display = "block";
				getID("vodList0").style.display = "none";
			}
			
			pageNow = _pageNum; //当前页 	
			getID("vodList"+_tag1).style.display = "block";
			getID("vodList"+_tag1).style.left = "0px";
			$.ajax({
				type: 'POST',
				url: '../readTagJson.php',
				data: {
					'tag1': tagArr[1][_tag1].tagName,
					'tag2': tag2ArrTemp[tag2],
					'tag3': tag3ArrTemp[tag3],
					'pageNow': _pageNum,
					'pageSize': 9,//_pageSize,
					'mobile': "mobile",
				},
				dataType: 'json',
				beforeSend: function() {
					//这里一般显示加载提示;
				},
				success: function(json) {
					vodPageAll = json.pageAll;/*
					if( vodPageAll == 0 || pageNow == vodPageAll ){						
						getID("loadmore"+navPos).innerHTML = "•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;&nbsp;no more&nbsp;&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•";
					}*/
					var list = json.list;
					$.each(list,
						function(index, array) { //遍历json数据列
							var name = array['name'].slice(array['name'].lastIndexOf('/') + 1);
							var father = array['father'];
							var id = array["id"];
							name = name.slice(0,name.lastIndexOf('.') );
							if( father.length > 6){
								var	father2 = '<marquee behavior="scroll" direction="left" width="100%" scrollamonut="100" scrolldelay="100">'+father +'</marquee>';
							}else{
								var father2 = father;
							}
						//	getID("vodListContent"+_tag1).innerHTML += '<div class="listImg" style="background: url(../vod/'+name+'/'+name+'.jpg)" onClick=showDetail("'+father+'")><div class="listName">'+father2+'</div></div>';

							getID("vodListContent"+_tag1).innerHTML += '<div class="listImg" style="background: url(../vod/'+name+'/'+name+'.jpg)" onClick=showDetail('+id+')><div class="listName">'+father2+'</div></div>';
						});	
					setTimeout(function() {
						changePageStatus = "t";
					}, 1000); // 加载完成后才将状态改为true
				},
				error: function() {
				//	alert("error");
				}
			});
		}

		function moveChangeTag(_num) { //滑动切换分类
			var tag1Temp = navPos;
			tag1Temp += _num;
			if (tag1Temp < 0) {
				tag1Temp = 0;
			}
			if (tag1Temp > tagArr[1].length-1) {
				tag1Temp = tagArr[1].length-1;
			}				
			showTabList1(tag1Temp);
		}

		function changePage(_num) { //VOD列表换页
			pageNow += _num;
			if (pageNow > vodPageAll || pageNow < 1) {
				pageNow = vodPageAll;
			}if( indexArea == "search" || indexArea == "history" ||indexArea == "collect" ){
				showSHC(indexArea,pageNow,"_key");
			}else{
				getTagData(navPos,tag2,tag3,pageNow, 9, "mobile");
			}
		}

		var episodeTemp = 0;
		var playUrls = "";
		function playVod(_episodePos,_id) {
			window.androidJs.JsClosePlayer();
			   window.androidJs.JsSetPageArea("vod");
			//   alert(_id);
			$.ajax({
				type: 'POST',
				url: './playVod.php',
				data: {
					'sn':sn,
					'id':_id,
				},
				dataType: 'json',
				beforeSend: function() {
					//这里一般显示加载提示;
				},
				success: function(json) {
					playUrls = json.playUrl;
					if (typeof(window.androidJs) != "undefined") {
						window.androidJs.JsPlayVod(playUrls);
					}
				},
				error: function() {
				//	alert("something error!");
				}
			});
			getID('chooseChapter'+episodeTemp).style.color = "black";
			episodeTemp = _episodePos;
			getID('chooseChapter'+episodeTemp).style.color = "#ff9933";			
			getID("chooseChapterNum").scrollLeft = ( (episodeTemp-3)>0 )?(episodeTemp-3)*126:0;
		}

		function rePlay(){
			window.androidJs.JsPlayVod(playUrls);
		}

		function showHomeLiveGroup(){	//显示首页直播分组入口
			for(i=0;i<channelDataArr.length;i++){
				getID('homeNavLive').innerHTML += '<div class="tab-homeLive-item" id="homeLiveGroup"'+i+' onClick="showLiveList('+i+');" style="background:url(live/'+channelDataArr[i]["groupLogo"]+')"><div class="tab-homeLive-groupName">'+channelDataArr[i]["group"]+'</div></div>'
			}
		}

		function showHomeList(){
			for(i=0;i<4;i++){	//循环电影电视综艺等类型
				for(j=0;j<3;j++){	//每个类型取前3个影片
					var name = homeArr4[i*4+j].name.slice(0, homeArr4[i*4+j].name.lastIndexOf('.'));
					var homeListIndex = i*4+j;
					var father = homeArr4[i*4+j].father;
					var id = homeArr4[i*4+j].id;
					if( father.length > 6){	//father是显示在页面上的节目名称，超长的改为游动的father2
						var	father2 = '<marquee behavior="scroll" direction="left" width="100%" scrollamonut="100" scrolldelay="100">'+father +'</marquee>';
					}else{
						var father2 = father;
					}
				//	getID('homeListContent'+i).innerHTML += '<div id=homeListImg'+homeListIndex+' class="listImg" style="background: url(../vod/'+name+'/'+name+'.jpg)" onClick=showDetail("'+father+'")><div class="listName">'+father2+'</div></div>';
					getID('homeListContent'+i).innerHTML += '<div class="listImg" style="background: url(../vod/'+name+'/'+name+'.jpg)" onClick=showDetail('+id+')><div class="listName">'+father2+'</div></div>';
				}
			}
		}

		function showTabList1(_tag1){	//点击一级分类
			indexArea = "vod";
			if(tag1>0){
				getID("vodListContent"+tag1).innerHTML = "";
				getID("loadmore"+navPos).innerHTML = "";
			}			
			tag1 = _tag1;
			showTabRegion();	//动态显示二级地区分类
			getTagData(_tag1,0,0,1,9,0);	//显示海报列表
			getID("searchHistoryCollect").style.display = "none";
		}

		function showTab1(){	//启动APP时根据后台数据动态显示一级影视类型		
			for(i=0;i<tagArr[1].length;i++){
				getID('vodTab1').innerHTML += '<li class="tab-tab1-item" id=nav'+i+' onClick="showTabList1('+i+')" style="background:url(img/'+tagArr[1][i].tagTable+'0.png)" >'+tagArr[1][i].tagName+'</li>';
			}
			getID("nav0").style.backgroundImage = "url(img/typeHome1.png)";
		}

		function showTabList2(_num){	//点击二级地区
			getID("vodListContent"+navPos).innerHTML = "";
			getID("region"+tag2).style.backgroundColor = "";	
			getID("region"+tag2).style.color = "white";		
			tag2 = _num;
			getID("region"+tag2).style.backgroundColor = "#ff9933";

			showTab3();	
			getID("vodTabRegion").scrollLeft = ((_num-2) * 200<0)?0:(_num-2) * 200;
			getTagData(navPos,_num,0,1,9,0);
		}

		var tag2ArrTemp = ["全部"];	//供点击后显示列表时提交ajax使用
		function showTabRegion(){		//显示二级地区分类
			tag2 = 0;
			tag2ArrTemp = ["全部"];
			var tag2Temp = 1;	
			getID('vodTabRegion').innerHTML = '<li class="tab-tag2_3-item" id=region0 onClick="showTabList2(0)" >全部</li>';
			for(i=0;i<tagArr[2].length;i++){
				if( tagArr[2][i].tagFather.indexOf(tagArr[1][tag1].tagName) > -1 ){	//如果当前分类的父级是此时显示的一级分类
					getID('vodTabRegion').innerHTML += '<li class="tab-tag2_3-item" id=region'+tag2Temp+' onClick="showTabList2('+tag2Temp+')" >'+tagArr[2][i].tagName+'</li>';
					tag2Temp ++;
					tag2ArrTemp.push(tagArr[2][i].tagName);
				}
			}
			getID("region0").style.color = "#ff9933";
			getID("vodTabRegion").scrollLeft = 0;
			showTab3();			//动态显示三级分类标签
		}

		function showTag3List(_num){	//点击三级标签
			getID("vodListContent"+navPos).innerHTML = "";
			getID("region"+tag2).style.backgroundColor = "";			
			getID("region"+tag2).style.color = "#ff9933";

			getID("tag3_"+tag3).style.backgroundColor = "";			
			getID("tag3_"+tag3).style.color = "white";		
			tag3 = _num;
			getID("tag3_"+tag3).style.backgroundColor = "#ff9933";
			getTagData(navPos,tag2,_num,1,9,0);
			getID("vodTab3").scrollLeft = ((_num-2) * 200<0)?0:(_num-2) * 200;
		}

		var tag3ArrTemp = ["全部"];	//供点击后显示列表时提交ajax使用
		function showTab3(){	//显示三级分类标签
			tag3 = 0;
			tag3ArrTemp = ["全部"];
			var tag3Temp = 1;			
			getID('vodTab3').innerHTML = '<li class="tab-tag2_3-item" id=tag3_0 onClick="showTag3List(0)" >全部</li>';
			
			for(i=0;i<tagArr[3].length;i++){
				if( tag2ArrTemp[tag2]== "全部" ){
					getID('vodTab3').innerHTML += '<li class="tab-tag2_3-item" id=tag3_'+(i+1)+' onClick="showTag3List('+(i+1)+')" >'+tagArr[3][i].tagName+'</li>';
					tag3ArrTemp.push(tagArr[3][i].tagName);	
				}else if( tagArr[3][i].tagFather.indexOf( tag2ArrTemp[tag2] ) > -1 ){	//如果当前分类的父级是此时显示的二级分类
					
					getID('vodTab3').innerHTML += '<li class="tab-tag2_3-item" id=tag3_'+tag3Temp+' onClick="showTag3List('+tag3Temp+')" >'+tagArr[3][i].tagName+'</li>';			
					tag3Temp ++;	
					tag3ArrTemp.push(tagArr[3][i].tagName);	
				}
			}
			getID("tag3_0").style.color = "#ff9933";
			getID("vodTab3").scrollLeft = 0;
		}

		function moveVideoWindow() {	//2.0版不需要移动播放窗口
		/*	if (navPos > -1 && document.body.scrollTop == 0) { //只在点播列表且第一个图被挡住时才移动
				var clientWidth = document.body.scrollWidth;
				var clientHeight = window.innerHeight;
				if (typeof(window.androidJs) != "undefined") {
					window.androidJs.JsMovePlayerWindow(clientHeight - clientWidth * 9 / 16);
				}
			} else {
				window.androidJs.JsMovePlayerWindow(0);
			}*/
		}

		function loadMore() { //加载下一页
			var loadMoreBottom = $(document).height() - document.body.scrollTop - $(window).height();
			
		//	getID("test").style.display = "block";
		//	getID("test").innerHTML = loadMoreBottom+"<br>"+"pageNow"+pageNow+"pageAll"+vodPageAll;

			if (loadMoreBottom < 2 && pageNow < vodPageAll && navPos > -20 && changePageStatus == "t") { //数字越大，就越早加载下一页
				changePage(1);
				changePageStatus = "f"; //运行一次加载后马上将状态置为假，不允许继续加载，防止滑动屏幕时多次运行changePage(1);
			}
			
			if( vodPageAll == 0 || pageNow == vodPageAll ){		
				if( indexArea=="vod" ){
					getID("loadmore"+navPos).innerHTML = "•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;&nbsp;no more&nbsp;&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•";
				}else{
             	   getID("loadmoreSHC").innerHTML = "•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;no more&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•";
				}
			}

		}		

		function showSplash(){
			var splashArr = <?php echo json_encode($splashArr); ?>;	
			var splashIndex = window.androidJs.JsGetCookie("splashIndex",0)?window.androidJs.JsGetCookie("splashIndex",0):0;
			splashIndex ++;
			if( splashIndex > splashArr.length-1 ){
				splashIndex = 0;
			}
			window.androidJs.JsSetCookie("splashIndex", splashIndex, '12h');
			getID("splash").style.display = "block";
			getID("splash").style.backgroundImage = 'url(./splash/'+splashArr[splashIndex]+')';
			startCircle();	//右上角跳过圆圈
		}

		function init() {
			stbInfo();			
			scrollDisable();		//禁止页面滚动	
		//	bindEvent();		//绑定滑动事件
			clientWidth = document.body.scrollWidth;
			clientHeight = window.innerHeight;			

			getID('bodys').style.width = clientWidth + "px"; //全局宽
		//	getID("lock").style.height = clientHeight + "px"; //解锁页面的高，即全屏高度
		//	getID("splash").style.height = clientHeight + "px"; 
		//	getID("cardKey").style.height = clientHeight + "px"; //注册VIP卡页面的高
		//	getID("detaiPoster").style.height = clientWidth*9/16+"px";

		//	showSplash();		//显示第二个启动图片
			showTab1();				//显示一级分类
		//	showHomeLiveGroup();//显示首页直播分组入口
			showHomeList();			//显示首页热播列表
		}
	
	</script>
</head>

<body bgcolor="black" leftmargin="0" topmargin="0" onload="init();" onScroll="moveVideoWindow();">
<div id="bodys" style="position:absolute;top:0px;left:0px;width:100%;display:block;">
	<div id="test" style="position:fixed;top:800px;left:0px;width:100%;max-height:400px;overflow:auto;line-height:80px;z-index:20;background-color:white;font-size:100px;color:red;display:none;">test</div>
	<!--非直播 -->
	<div id="vod" style="position:absolute;left:0px;width:100%;display:block;">
		<!-- 顶部黑底 -->
		<div style="position:fixed;width:100%;height:380px;background-color:#000;z-index:1;"></div>
		<!-- 右上角头像 -->
		<div style="position:fixed;top:50px;left:50px;width:200px;height:100px;line-height:110px; background:url(img/vip.png) no-repeat;background-size:33% 100% !important; background-color:#000;color:white;font-size:40px;padding-left:100px;z-index:1;" onclick="showMe();">Mix TV</div>

		<!-- 搜索框 -->
		<input type="text" id="searchInput" class="homeTop" style="left:290px;top:-90px;width:370px;height:80px;line-height:80px;font-size:50px;text-align:center;border-radius:50px;background:transparent;color:white;-webkit-transition:1s;outline:none;" autofocus="autofocus" />

		<!-- 搜索图标 -->
		<div style="position:fixed;top:65px;left:670px;width:80px;height:80px;z-index:1;" onclick="showSearchInput();getID('shcContent').innerHTML = '';"><img src="img/search0.png" /></div>

		<!-- 历史图标 -->
		<div style="position:fixed;top:65px;left:770px;width:80px;height:80px;z-index:1;" onclick="showSHC('history',1,'h');getID('shcContent').innerHTML = '';"><img src="img/history0.png" /></div>

		<!-- 收藏图标 -->
		<div style="position:fixed;top:65px;left:870px;width:80px;height:80px;z-index:1;" onclick="showSHC('collect',1,'c');getID('shcContent').innerHTML = '';"><img src="img/collect0.png" /></div>

		<!-- 首页一级分类导航 -->
		<div class="homeTop" style="top:180px;left:0px;width:95%;">
			<ul id="vodTab1" class="tab-head">
				<!--li class="tab-tab1-item" id="nav0" onClick="showHome();" style="background: url(img/typeHome1.png)">首页</li-->
			</ul>
		<div style="position:fixed;top:365px;left:5%;width:90%;height:10px;background-color:#333333;"></div>
		</div>

		<!-- 首页列表 -->
		<div id="vodList0" style="position: absolute;left:0%;top:350px;width:100%;display:block;">
			<!-- 首页 直播入口 -->
			<div class="homeList" style="top:50px;">
				<span style="position:relative;left:15%;">直播频道</span>
				<div style="background:url(img/typeLive0.png) no-repeat;" class="homeListLogo"></div>
				<div id="historyCollect.del" style="position:absolute;left:0%;top:110px;width:100%;">			
					<ul id="homeNavLive" class="tab-head">
						<!--div class="tab-homeLive-item" id="homeLiveGroup0" onClick="showLiveList(0);" style="background:url(img/poster.jpg)"><div class="tab-homeLive-groupName">央视</div></div-->
					</ul>
				</div>
			</div>	

			<!-- 首页 电影入口 -->
			<div id="homeList0" class="homeList" style="top:300px;">
				<span style="position:relative;left:15%;">热播电影</span>
				<span style="position:relative;left:60%;" onclick="showTabList1(1);">更多</span>
				<div style="background:url(img/typeMovie0.png) no-repeat;" class="homeListLogo"></div>
				<div id="homeListContent0" style="position:absolute;left:0%;top:110px;width:100%;">
					<!--div id="homeListImg0" class="listImg" style="background: url(img/poster.jpg)">
						<div id="homeListName0" class="listName">影片名称</div>
					</div-->
				</div>
			</div>

			<!-- 首页 电视剧入口 -->
			<div id="homeList1" class="homeList" style="top:840px;">
				<span style="position:relative;left:15%;">热播剧集</span>
				<span style="position:relative;left:60%;" onclick="showTabList1(2);">更多</span>
				<div style="background:url(img/typeSeries0.png) no-repeat;" class="homeListLogo"></div>
				<div id="homeListContent1" style="position:absolute;left:0%;top:110px;width:100%;"></div>
			</div>

			<!-- 首页 综艺入口 -->
			<div id="homeList2" class="homeList" style="top:1380px;">
				<span style="position:relative;left:15%;">热播综艺</span>
				<span style="position:relative;left:60%;" onclick="showTabList1(3);">更多</span>
				<div style="background:url(img/typeVariety0.png) no-repeat;" class="homeListLogo"></div>
				<div id="homeListContent2" style="position:absolute;left:0%;top:110px;width:100%;"></div>
			</div>

			<!-- 首页 动漫入口 -->
			<div id="homeList3" class="homeList" style="top:1920px;">
				<span style="position:relative;left:15%;">热播动漫</span>
				<span style="position:relative;left:60%;" onclick="showTabList1(4);">更多</span>
				<div style="background:url(img/typeCartoon0.png) no-repeat;" class="homeListLogo"></div>
				<div id="homeListContent3" style="position:absolute;left:0%;top:110px;width:100%;"></div>
			</div>
		
		</div>

		<!-- 点播分类导航 -->
		<div id="vodTab" style="position:fixed;left:0%;top:365px;width:100%;display:none;z-index:2;">
			<ul id="vodTabRegion" class="tab-head" style="background-color:#333333;height:70px;line-height:60px;padding-top:10px;padding-left:20px;">
				<!--li class="tab-vod-item" id="region0" style="background-color:#ff9933;" onClick="showHome();" >大陆</li-->
			</ul>
			<ul id="vodTab3" class="tab-head" style="background-color:#666666;height:70px;line-height:60px;padding-top:10px;padding-left:20px;">
				<!--li class="tab-vod-item" id="region0" style="background-color:#ff9933;" onClick="showHome();" >大陆</li-->
			</ul>
		</div>

		<!-- 点播 电影 列表 -->
		<div id="vodList1" style="position:absolute;top:580px;left:0px;width:100%;display:none;">
			<div id="vodListContent1">
				<!--div id="vodListImg0" class="vodListImg" onClick="playVod(0);" ></div>
				<div id="vodListName0" class="vodListName"></div-->
			</div>
			<div id="loadmore1" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

		<!-- 点播 电视剧 列表 -->
		<div id="vodList2" style="position:absolute;top:580px;left:0px;width:100%;display:none;">
			<div id="vodListContent2">			</div>
			<div id="loadmore2" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

		<!-- 点播 综艺 列表 -->
		<div id="vodList3" style="position:absolute;top:580px;left:0px;width:100%;display:none;">
			<div id="vodListContent3">			</div>
			<div id="loadmore3" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

		<!-- 点播 动漫 列表 -->
		<div id="vodList4" style="position:absolute;top:580px;left:0px;width:100%;display:none;">
			<div id="vodListContent4">			</div>
			<div id="loadmore4" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

		<!-- 点播 纪录片 列表 -->
		<div id="vodList5" style="position:absolute;top:580px;left:0px;width:100%;display:none;">
			<div id="vodListContent5">			</div>
			<div id="loadmore5" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

	</div><!-- 点播尾 -->

	<!-- 搜索 历史 收藏 列表页 -->	
	<div id="searchHistoryCollect" class="homeList" style="top:400px;display:none;">
		<span id="shcTitle" style="position:relative;left:15%;color:#f7a333;">搜索结果</span>
		<div id="shcImg" style="background:url(img/typeCartoon0.png) no-repeat;background-size:100% 100% !important;" class="homeListLogo"></div>
		<div style="position:absolute;left:0%;top:110px;width:100%;">
			<div id="shcContent" ></div>
			<div id="loadmoreSHC" class="vodListName" style="height:100px;color:gray;"></div>
		</div>		
	</div>

	<!-- 直播频道列表 -->
	<div id="channel" style="position:absolute;top:0px;left:0px;width:100%;display:none;">
		<!-- 频道组 -->
		<div id="group" style="position:fixed;top:0px;left:0px;width:100%; height:90px;line-height:90px;z-index:2;">
			<ul id="groups" class="tab-head" style="background-color:#333333;">
				<!--li class="tab-head-item" id="group0" onClick="showVodList(0);"></li-->
			</ul>
		</div>

		<!-- 频道列表 -->
		<div id="channels" class="channels" style="position:absolute;left:0px;top:100px;">
			<!--div id="channels0" class="channels" onClick="startLive(5);">
				<div id="channelId0" class="channelID"></div>
				<div id="channel0" class="channel"></div>
			</div-->
		</div>
	</div><!-- 直播频道尾 -->

	<!-- 详情页 -->
	<div id="detail" style="position:absolute;left:0px;top:0px;width:100%;z-index:2;background-color:black;display:none;">
		<div id="detaiPoster" style="position:relative;left:0%;top:0px;width:100%;height:0px;background:url(../loading.gif);background-size:100% 100% !important;" onclick="rePlay()"></div>

		<div class="detailText" style="top:40px;font-size:50px;color:#f7a333;" id="detailName" ></div>
		<div class="detailText" style=top:60px;"><b>导演：</b><span id="detailDirector" ></span></div>
		<div class="detailText" style="top:80px;"><b>主演：</b><span id="detailActor" ></span></div>
		<div class="detailText" style="top:100px;"><b>上映年份：</b><span id="detailYear"></span></div>
		<div class="detailText" style="top:50px;left:50%;width:45%;"><b>地区：</b><span id="detailRegion"></span></div>
		<div class="detailText" style="top:70px;"><b>时长：</b><span id="detailDuration"></span></div>
		<div class="detailText" style="top:20px;left:50%;width:45%;"><b>IMDB评分：</b><span id="detailScore" style="color:#f7a333;"></span></div>
		<div class="detailText" style="top:40px;"><b>类型：</b><span id="detailTag"></span></div>
		<div class="detailText" style="top:-160px;left:84%;width:100px;height:100px;background:url(img/collect0.png);" onClick="changeCollect()" id="collectImg"></div>
		<div class="detailText" style="top:-40px;" id="description" onclick="moreDescription()"><b>剧情：</b><span id="detailDescription"></span></div>
		<div id="chooseChapter" class="detailText2" style="top:-40px;display:none;" >选集&emsp;<span id="episodes"></span>
			<ul id="chooseChapterNum" class="tab-head">
				<!--div class="tab-chooseChapter-item" onClick="showLiveList(0);" style="">1</!-div-->
			</ul>
		</div>
		<div id="guess" class="detailText2" style="top:-40px;">猜您喜欢
			<div style="position:relative;left:0%;top:0px;">
				<!--div id="guess0" class="guess" style="margin-right:3%;background:url(img/poster.jpg);"></div>
				<div id="guess1" class="guess" style="margin-right:3%;float:left;background-size:100% 100% !important;background:url(img/poster.jpg);"></div>
				<div id="guess2" class="guess" style="margin-right:0%;margin-bottom:30px;background:url(img/poster.jpg);"></div-->

				<ul id="guesses" class="tab-head" >
					<!--div class="tab-guess-item" onClick="showLiveList(0);" style="background:url(img/poster.jpg)"><div class="tab-guessName">猜您喜欢之一</div></div>
					<div class="tab-guess-item" onClick="showLiveList(1);" style="background:url(img/poster.jpg)"><div class="tab-guessName">猜您喜欢之二</div></div>
					<div class="tab-guess-item" onClick="showLiveList(2);" style="background:url(img/poster.jpg)"><div class="tab-guessName">猜您喜欢之三</div></div>
					<div class="tab-guess-item" onClick="showLiveList(3);" style="background:url(img/poster.jpg)"><div class="tab-guessName">猜您喜欢之四</div></div-->
				</ul>

			</div>
		</div>
		<div id="promptCollect" class="promptCollect">已收藏</div>
	</div>

	<!-- 解锁界面 -->
	<div id="lock" style="position:absolute;top:0px;left:0px;width:100%;height:0px;background-color:#f7a333;display:none;text-align:center;font-size:80px;color:white; z-index:9;background:linear-gradient(to bottom,red,deeppink,orange,yellow,green,blue,indigo,violet);">
		<div style="position:absolute;top:15%;left:0px;width:100%;height:100px;line-height:100px;font-size:90px;font-weight:900;text-shadow:-5px 5px 5px #000;">Unlock your APP</div>

		<span id="lockKey1" class="lockKey" style="left:15%;"></span>
		<span id="lockKey2" class="lockKey" style="left:35%;"></span>
		<span id="lockKey3" class="lockKey" style="left:55%;"></span>
		<span id="lockKey4" class="lockKey" style="left:75%;"></span>

		<div id="prompt" style="position:absolute;left:0px;top:40%;width:100%;max-height:300px;line-height:100px;font-size:90px;font-weight:900;text-shadow:-5px 5px 5px #000;"></div>

		<div style="position:absolute;left:0px;top:59%;width:100%;height:40%;">
			<div class="lockNumR" style="left:0px;top:0px;" onClick="checkPin(1);">1</div>
			<div class="lockNumR" style="left:33.3%;top:0px;" onClick="checkPin(2);">2</div>
			<div class="lockNum" style="left:66.6%;top:0px;" onClick="checkPin(3);">3</div>

			<div class="lockNumR" style="left:0px;top:25%;" onClick="checkPin(4);">4</div>
			<div class="lockNumR" style="left:33.3%;top:25%;" onClick="checkPin(5);">5</div>
			<div class="lockNum" style="left:66.6%;top:25%;" onClick="checkPin(6);">6</div>

			<div class="lockNumR" style="left:0px;top:50%;" onClick="checkPin(7);">7</div>
			<div class="lockNumR" style="left:33.3%;top:50%;" onClick="checkPin(8);">8</div>
			<div class="lockNum" style="left:66.6%;top:50%;" onClick="checkPin(9);">9</div>

			<div class="lockNumR" style="left:0px;top:75%;font-size:90px;" onClick="checkPin(10);">Alt</div>
			<div class="lockNumR" style="left:33.3%;top:75%;" onClick="checkPin(0);">0</div>
			<div class="lockNum" style="left:66.6%;top:75%;font-size:90px;" onClick="checkPin(11);">Del</div>
		</div>
	</div>

	<!-- 输入卡号及卡密 -->
	<div id="cardKey" style="position:absolute;top:0px;left:0px;width:100%;height:0px;background:linear-gradient(to bottom,red,deeppink,orange,yellow,green,blue,indigo,violet);display:none;text-align:center;font-size:80px;color:white; z-index:10;">
		<h1 id="title" style="position:absolute;left:0px;top:5%;width:100%;height:100px;text-align:center;font-size:90px;text-shadow:-5px 5px 5px #000;">Registered VIP Card</h1>

		<div style="position:absolute;left:5%;top:16%;width:90%;height:70px;font-size:60px;text-align:left;text-shadow:-5px 5px 5px #000;">Card Number</div>
		<!-- 卡号输入框 -->
		<input type="number" id="card_id" style="position:absolute;left:5%;top:21%;width:90%;height:100px;font-size:60px;text-align:center;border-radius:10px 10px 10px 10px;background:transparent;color:black;" maxlength="8" oninput="onInputHandler(event,'card_id')" autofocus="autofocus" onkeyup="value=value.replace(/[^-\d]/g,'')" />

		<div style="position:absolute;left:40%;top:21%;width:50%;height:100px;" onClick="window.androidJs.JsShowImm();getID('card_id').focus();"></div>

		<div style="position:absolute;left:5%;top:30%;width:90%;height:70px;font-size:60px;text-align:left;text-shadow:-5px 5px 5px #000;">PIN Code</div>
		<!-- 卡密输入框 -->
		<input type="number" id="card_key" style="position:absolute;left:5%;top:35%;width:90%;height:100px;font-size:60px;text-align:center;border-radius:10px 10px 10px 10px;background:transparent;color:black;" maxlength="8" oninput="onInputHandler(event,'card_key')" onkeyup="value=value.replace(/[^-\d]/g,'')" />

		<div style="position:absolute;left:40%;top:35%;width:50%;height:100px;" onClick="window.androidJs.JsShowImm();getID('card_key').focus();"></div>

		<div id="back" style="position:absolute;left:5%;top:45%;width:40%;line-height:120px;font-size:80px;text-align:center; border-radius:60px 60px 60px 60px;background:linear-gradient(to bottom,yellow,green);color:gold;text-shadow:-5px 5px 5px #000;" onclick="back()"><b>back</b></div>

		<div id="ok" style="position:absolute;left:55%;top:45%;width:40%;line-height:120px;font-size:80px;text-align:center; border-radius:60px 60px 60px 60px;background:linear-gradient(to bottom,yellow,green);color:gold;text-shadow:-5px 5px 5px #000;" onclick="checkInput()"><b>submit</b></div>

		<div id="img" style="position:absolute;left:5%;top:58%;width:90%;height:35%;background:url(img/vipCard.png) no-repeat;background-size:100% 100% !important;"></div>

		<div id="exp" style="position:absolute;left:13%;top:63%;width:77%;height:100px;color:gold;font-size:60px;text-align:left;text-shadow:0px 3px 3px gold;"></div>

		<div id="msg" style="position:absolute;left:5%;top:58%;width:90%;height:35%;text-align:center;font-size:70px;font-weight:900;border-radius:55px 55px 55px 55px;color:red;"></div>
	</div>

	<!-- 启动图片 -->
	<div id="splash" style="position: absolute;left:0px;top:0px;width:100%;height:0px;background:url(img/null.png);background-size:100% 100%;display:none;z-index:99;">	
		<div onclick="splashJump()" style="position: absolute;right:100px;">
			<div class="flex-container" >
				<div class="outbox" id="splashJump">跳过</div>
				<svg class="svg">
					<circle id="cls" class="cls run-anim" cx="70" cy="70" r="65"></circle>
				</svg>
			</div>
		</div>
	</div>

</div><!-- bodys尾 -->
</body></html>

<script>
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
						
		case "KEY_SELECT":
			if( indexArea=="search" ){
			//	alert(indexArea);
			/*	alert(getID('searchInput').value );
				getID('searchInput').blur();
				getID('searchInput').style.top= '-110px';
				indexArea = "home";*/
				showSearchInput();
			}else if( indexArea=="register" ){
				checkInput();
				window.androidJs.JsShowImm();
			}
			return 0;
			break;
	}
}
</script>
<script type=text/javascript src="js/detail.js" charset=UTF-8></script>