<script type=text/javascript src="js/global.js" charset=UTF-8></script>
<script type=text/javascript src="js/init2.js"></script>
<script type=text/javascript src="js/register2.js"></script>
<script type=text/javascript src="js/searchHistoryCollect.js" charset=UTF-8></script>
<script type=text/javascript src="../jquery-1.11.0.min.js" charset=UTF-8></script>
<!--script type=text/javascript src="js/getXuData.js" charset=UTF-8></script-->
<script type=text/javascript src="js/getXuDataToJs.js" charset=UTF-8></script>
<script type=text/javascript src="js/touchMoveXu.js" charset=UTF-8></script>

<?php
//	error_reporting(0);// 关闭所有PHP错误报告
//	error_reporting(-1);// 报告所有 PHP 错误=error_reporting(E_ALL);
//	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);// 报告 E_NOTICE也挺好 (报告未初始化的变量或者捕获变量名的错误拼写)
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	set_time_limit(0); //限制页面执行时间,0为不限制
	include_once "readSplash.php";
	include_once "../connectMysql.php";
	include_once "../readChannelArray.php";
//	include_once "../readTagNav.php";	//获取分类标签
//	include_once "getXuData.php";	//
//	var_dump(  $dataTab1Arr);

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
	<title>mixTVx</title>
	<link rel="stylesheet" type="text/css" href="style2.css" >
	<link rel="stylesheet" type="text/css" href="circle/css/normalize.css" /><!--CSS RESET-->
	<link rel="stylesheet" type="text/css" href="circle/css/style.css" />
	<script>
		var intLoginTime = <?php echo $intLloginTime ?>; //应用登陆时间，其实这个没必要去后台获取，只要取当前时间即可
		var channelDataArr = <?php echo json_encode($channelArr); ?>;
		var userKey = (typeof(window.androidJs) != "undefined") ? window.androidJs.JsGetCookie("userKey", 0) : "9527";
		if (parseInt(userKey) == 0) { //没设置密码时获取到的密码为0，所以要改一下
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
			groupScrollL = (groupId - 1) * 150;//大概两个汉字150，4个汉字300
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
			groupScrollL += (_num - groupId) * 150; //移动分类的位置
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

		var episodeTemp = 0;
	//	var playUrls = "";
		function playVod(_id,_playUrl,_father,_poster,_episodePos,_videoType) {
			var playUrl = _playUrl.replace("128.1.160.114","mixtvapi.mixtvapp.com");
			if (typeof(window.androidJs) != "undefined") {
				window.androidJs.JsClosePlayer();
				window.androidJs.JsSetPageArea("vod");
				window.androidJs.JsPlayVod(playUrl);
			}
		//	alert(sn+"_"+_id+"_"+_father+_poster+"_"+_episodePos);
			$.ajax({
				type: 'POST',
				url: './playVodXu.php',
				data: {
					'sn':sn,
					'id':_id,
				//	'name':_playUrl,
					'father':_father,
					'poster':_poster,
					'episodePos':_episodePos
				},
				dataType: 'json',
				beforeSend: function() {
					//这里一般显示加载提示;
				},
				success: function(json) {
				//	alert(json.status);
				},
				error: function() {
				//	alert("something error!");
				}
			});

			if( _videoType>2 ){	//多集的才需定位当前集
				getID('chooseChapter'+episodeTemp).style.color = "black";
				episodeTemp = _episodePos;
				getID('chooseChapter'+episodeTemp).style.color = "#ff9933";			
				getID("chooseChapterNum").scrollLeft = ( (episodeTemp-3)>0 )?(episodeTemp-3)*126:0;
			}
		}

		function rePlay(){
			window.androidJs.JsPlayVod(playUrls);
		}
	
		//	显示海报列表
		var tab1 = 0;	//一级分类，即电影 电视剧……
		var tab2 = 0;	//二级分类，即地区
		var tab3 = 0;	//三级分类，即爱情、动作、喜剧之类的分类标签
		var pageNow = 1; //第一页是1
		var pageNow1=0, pageNow2=0, pageNow3=0, pageNow4=0, pageNow5=0, pageNow6=0, pageNow7=0, pageNow8=0, pageNow9=0, pageNow10=0, pageNow11=0, pageNow12=0, vodPageAll = 1;
		var changePageStatus = "f"; //；加载状态，f为未完成，此时不加载下一页
		function getXuList(_tab1, _tab2,_tab3,_pageNow, _pageSize) {	
			
			var	tab2s = ( _tab2==0 || !tab2Arr[_tab1][_tab2-1] )?"":tab2Arr[_tab1][_tab2-1]["name"];
			var tab3s = ( _tab3==0 || !tab3Arr[_tab1][_tab3-1] )?"":tab3Arr[_tab1][_tab3-1]["name"];
			alert(tab1+"_"+tab2s+"_"+tab3s+"_"+eval("pageNow"+tab1));

			pageNow = _pageNow; //当前请求页码
		//	alert("已显示页码："+eval("pageNow"+tab1)+"当前请求页码："+pageNow);
			if( eval("pageNow"+tab1)>=pageNow ){//如果上次已显示的页码>=当前请求的页码，就不再请求了,并且更新当前页为上次已显示的
				pageNow = eval("pageNow"+tab1);
				alert("上次页码>=请求页码");
				return;
			}
			$.ajax({
				type: 'POST',
				url: './getXuDataList.php',
				data: {
					'channelId': tab1Arr["data"][_tab1].channelId,
					'tab2': ( _tab2==0 || !tab2Arr[_tab1][_tab2-1] )?"":tab2Arr[_tab1][_tab2-1]["name"],
					'tab3': ( _tab3==0 || !tab3Arr[_tab1][_tab3-1] )?"":tab3Arr[_tab1][_tab3-1]["name"],
					'pageNow': eval("pageNow"+tab1)+1,
					'pageSize': 12
				},
				dataType: 'json',
				beforeSend: function() {
					//这里一般显示加载提示;
				},
				success: function(json) {
					eval("pageNow"+tab1+"="+pageNow);//请求成功才更新当前页码
					alert("当前页："+eval("pageNow"+tab1));
					vodPageAll = json.pages;
					if( vodPageAll == 0 || pageNow == vodPageAll ){	//打开这段就直接显示no more，否则需上拉一下			
						getID("loadmore"+tab1).innerHTML = "•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;&nbsp;no more&nbsp;&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•";
						getID("loading"+tab1).style.display = "none";
					}else{
						getID("loadmore"+tab1).innerHTML = "";
						getID("loading"+tab1).style.display = "block";
					}
					var list = json.records;
					console.log(list);
					$.each(list,
						function(index, array) { //遍历json数据列
							var id = array["id"];
							var name = array['videoName'];
							var poster = array['imgUrl'];
							if( name.length > 6){
								name = '<marquee behavior="scroll" direction="left" width="100%" scrollamonut="100" scrolldelay="100">'+name +'</marquee>';
							}
							getID("vodListContent"+_tab1).innerHTML += '<div class="listImg" style="background: url('+poster+')" onClick=showDetail("'+id+'")><div class="listName">'+name+'</div></div>';
						});	
					setTimeout(function() {
						changePageStatus = "t";
					}, 1000); // 加载完成后才将状态改为true
				},
				error: function() {
					alert("something error");
				}
			});
		}

		function moveChangeTag(_num) { //滑动切换分类
			var tag1Temp = navPos;
			tag1Temp += _num;
			if (tag1Temp < 0) {
				tag1Temp = 0;
			}
			if (tag1Temp > tab1Arr["data"].length-1) {
				tag1Temp = tab1Arr["data"].length-1;
			}				
			clickTab1(tag1Temp);
		}

		function changePage(_num) { //VOD列表换页
			pageNow += _num;
			if (pageNow > vodPageAll || pageNow < 1) {
			//	pageNow = vodPageAll;
			}
			if( indexArea == "search" || indexArea == "history" ||indexArea == "collect" ){
				showSHC(indexArea,pageNow,"_key");
			}else{
				getXuList(tab1,tab2,tab3,pageNow, 9);
			}
		}

		function showHomeLiveGroup(){	//显示首页直播分组入口
			for(i=0;i<channelDataArr.length;i++){
				getID('homeNavLive').innerHTML += '<div class="tab-homeLive-item" id="homeLiveGroup"'+i+' onClick="showLiveList('+i+');" style="background:url(live/'+channelDataArr[i]["groupLogo"]+')"><div class="tab-homeLive-groupName">'+channelDataArr[i]["group"]+'</div></div>'
			}
		}

//	console.log(homeListArr);
		function showHomeList(){
			for(i=0;i<homeListArr["data"].length-1;i++){	//循环电影电视综艺等类型
				getID("homeListName"+i).innerHTML = "热播"+homeListArr["data"][i+1].channelName;
				for(j=0;j<3;j++){	//每个类型取前3个影片
					var name = homeListArr["data"][i+1]["videoInfo"][j].videoName;
					var poster = homeListArr["data"][i+1]["videoInfo"][j].imgUrl;
					var id = homeListArr["data"][i+1]["videoInfo"][j].id;

					if( name.length > 6){	
						name = '<marquee behavior="scroll" direction="left" width="100%" scrollamonut="100" scrolldelay="100">'+name +'</marquee>';
					}
					getID('homeListContent'+i).innerHTML += '<div class="listImg" style="background: url('+poster+')" onClick=showDetail("'+id+'")><div class="listName">'+name+'</div></div>';
				}
			}
		}

//		console.log(tab1Arr);
		function showTab1(){	//显示一级影视类型		
			for(i=1;i<tab1Arr["data"].length;i++){
				getID('vodTab1').innerHTML += '<li class="tab-tab1-item" id=nav'+i+' onClick="clickTab1('+i+')" style="background:url(img/'+tab1Arr["data"][i].channelName+'0.png) center no-repeat" >'+tab1Arr["data"][i].channelName+'</li>';
			}
			getID("nav0").style.backgroundImage = "url(img/直播1.png)";	//这里写的是直播，实际是首页，因许的后台第一个是直播，而我的页面一级栏目没有直播
		}

//	console.log(tab2Arr); console.log(tab3Arr);
		function showTab2and3(_tab1){		//显示二三级分类
			tab2 = 0;
			getID('vodTabRegion').innerHTML = "";
			getID('vodTab3').innerHTML = "";

			if( tab2Arr[_tab1].length>0 ){	//如果有二级分类
				getID("vodTabRegion").style.height = "60px";
				getID("vodTabRegion").style.backgroundColor = "#333333";
				getID('vodTabRegion').innerHTML = '<li class="tab-tag2_3-item" id=region0 onClick="clickTab2(0)" >全部</li>';
				getID("region0").style.color = "#ff9933";
				for(i=0;i<tab2Arr[_tab1].length;i++){
					getID('vodTabRegion').innerHTML += '<li class="tab-tag2_3-item" id=region'+(i+1)+' onClick="clickTab2('+(i+1)+')" >'+tab2Arr[_tab1][i].name+'</li>';
				}
				getID("vodTabRegion").scrollLeft = 0;
				if( tab3Arr[_tab1].length>0 ){	//如果有三级分类
					getID("vodTab3").style.height = "60px";
					getID("vodTab3").style.backgroundColor = "#666666";
					getID('vodTab3').innerHTML = '<li class="tab-tag2_3-item" id=tag3_0 onClick="clickTag3(0)" >全部</li>';
					for(j=0;j<tab3Arr[_tab1].length;j++){
						getID('vodTab3').innerHTML += '<li class="tab-tag2_3-item" id=tag3_'+(j+1)+' onClick="clickTag3('+(j+1)+')" >'+tab3Arr[_tab1][j].name+'</li>';
					}
					getID("vodTab3").scrollLeft = 0;
				}else{	//	没有三级分类，隐藏三级分类标签
					getID("vodTab3").style.height = "0px";
					getID("vodTab3").style.backgroundColor = "black";
					getID("vodList"+_tab1).style.top = "405px";
				}
			}else{	//	没有二级分类，肯定也没有三级分类，所以隐藏两级分类标签
				getID("vodTabRegion").style.height = "0px";
				getID("vodTabRegion").style.backgroundColor = "black";
				getID("vodTab3").style.height = "0px";
				getID("vodTab3").style.backgroundColor = "black";
				getID("vodList"+_tab1).style.top = "335px";
			}
		}

		function clickTab1(_tab1){	//点击一级分类
			indexArea = "vod";
		/*	if (navPos < 0) { 	//从直播切换到点播，这个版本不需要这段，因为一级栏目没有直播
				getID("vod").style.display = "block";
				getID("channel").style.display = "none";
				if (typeof(window.androidJs) != "undefined") {
					window.androidJs.JsClosePlayer();
				}
			}*/
			getID("nav" + navPos).style.color = "white"; 
			getID("nav" + navPos).style.backgroundImage = "url(img/"+tab1Arr["data"][navPos].channelName+"0.png)"; 
			navPos = _tab1;
			getID("nav" + navPos).style.color = "f7a333";
			getID("nav" + navPos).style.backgroundImage = "url(img/"+tab1Arr["data"][navPos].channelName+"1.png)"; 
			getID("vodTab1").scrollLeft = ( (navPos-2)>0 )?(navPos-2)*200:0;

			if(_tab1==0){	//显示首页
				indexArea = "home";
				getID("vodTab").style.display = "none";
			//	for(i=1;i<6;i++){
			//		getID("vodList"+i).style.display = "none";
			//		getID("vodListContent"+i).innerHTML = "";
			//	}
				getID("vodList"+tab1).style.display = "none";
				getID("vodList0").style.display = "block";
				getID("vodList0").style.left = "0px";
				return;
			}else{
				getID("vodTab").style.display = "block";
				getID("vodList0").style.display = "none";
			}

			if(tab1>0){
			//	getID("vodListContent"+tab1).style.display = "none";
			//	getID("loadmore"+tab1).style.display = "none";
				getID("vodList"+tab1).style.display = "none";
			}
			tab1 = _tab1;
			getID("vodList"+tab1).style.display = "block";
		//	getID("vodList"+tab1).style.left = "0px";
			showTab2and3( _tab1 );	//动态显示二三级分类
			getXuList(_tab1,0,0,1,9);	//显示海报列表
			getID("searchHistoryCollect").style.display = "none";
		}

		function clickTab2(_num){	//点击二级地区
			getID("vodListContent"+navPos).innerHTML = "";
			getID("region"+tab2).style.backgroundColor = "";	
			getID("region"+tab2).style.color = "white";	
			if( tab3Arr[tab1].length>0){	//如果是从三级转到二级
				getID("tag3_"+tab3).style.backgroundColor = "";			
				getID("tag3_"+tab3).style.color = "white";			
				getID("tag3_0").style.color = "#ff9933";
				tab3 = 0;
			}
			tab2 = _num;
			eval("pageNow"+tab1+"=0");	//当前页置0，否则因当前页可能大于请求页，而不会请求数据
			getID("region"+tab2).style.backgroundColor = "#ff9933";
			getID("vodTabRegion").scrollLeft = ((_num-2) * 200<0)?0:(_num-2) * 200;
			getXuList(tab1,_num,0,1,12);
		}

		function clickTag3(_num){	//点击三级标签
			getID("vodListContent"+navPos).innerHTML = "";
			getID("region"+tab2).style.backgroundColor = "";			
			getID("region"+tab2).style.color = "#ff9933";
			getID("tag3_"+tab3).style.backgroundColor = "";			
			getID("tag3_"+tab3).style.color = "white";		
			tab3 = _num;
			eval("pageNow"+tab1+"=0");	//当前页置0，否则因当前页可能大于请求页，而不会请求数据
			getID("tag3_"+tab3).style.backgroundColor = "#ff9933";
			getID("vodTab3").scrollLeft = ((_num-2) * 200<0)?0:(_num-2) * 200;
			getXuList(tab1,tab2,_num,1,12);
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
		
		st2 = setTimeout(function(){ }, 1000);	//防止scrollWindow第一次执行找不到st2
		function scrollWindow(){
			if( indexArea=="zhiBo"){
				clearTimeout(st2);
				changeZhiBo();		
				st2 = setTimeout(function() {
					scrollTo(0,zhiBoPos*clientHeight);
					if( zhiBoPos%10 >7 && changePageStatus == "t" ){
						showZhiBoList(1);
					}
				}, 1000);	//1秒后将当前窗口的top放到屏幕顶端
			}
		}

		function loadMore() { //加载下一页
			var loadMoreBottom = $(document).height() - document.body.scrollTop - $(window).height();			
		//	getID("test").style.display = "block";
		//	getID("test").innerHTML = loadMoreBottom+"<br>"+"pageNow"+pageNow+"pageAll"+vodPageAll;
			if (loadMoreBottom < 850 && pageNow < vodPageAll && navPos > -20 && changePageStatus == "t") { //loadMoreBottom数字越大，就越早加载下一页
				changePage(1);
				changePageStatus = "f"; //运行一次加载后马上将状态置为假，不允许继续加载，防止滑动屏幕时多次运行changePage(1);
			}			
			if( vodPageAll == 0 || pageNow == vodPageAll ){		
				if( indexArea=="vod" ){
					getID("loadmore"+tab1).innerHTML = "•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;&nbsp;no more&nbsp;&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•";
					getID("loading"+tab1).style.display = "none";
				}else{
             	   getID("loadmoreSHC").innerHTML = "•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;no more&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•";
				}
			}
		}		

		function showSplash(){
			getID("splash").style.height = clientHeight + "px"; 
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

		var clientWidth = 0 ;
		var clientHeight = 0 ;
		function init() {
			stbInfo();			
			scrollDisable();		//禁止页面滚动	
			bindEvent();		//绑定滑动事件
			clientWidth = document.body.scrollWidth;
			clientHeight = window.innerHeight;			

			getID('bodys').style.width = clientWidth + "px"; //全局宽
			getID("detaiPoster").style.height = clientWidth*9/16+"px";

		//	showSplash();		//显示第二个启动图片
			showTab1();				//显示一级分类
			showHomeLiveGroup();//显示首页直播分组入口
			showHomeList();			//显示首页热播列表
		}
	</script>
</head>

<body bgcolor="black" leftmargin="0" topmargin="0" onload="init();"  onScroll="scrollWindow();">
<div id="bodys" style="position:absolute;top:0px;left:0px;width:100%;display:block;">
	<div id="test" style="position:fixed;top:100px;left:0px;width:100%;max-height:900px;overflow:auto;line-height:100px;z-index:9999;background-color:white;font-size:100px;color:red;display:none;"></div>
	<!--非直播 -->
	<div id="vod" style="position:absolute;left:0px;width:100%;display:block;">
		<!-- 顶部黑底 -->
		<div style="position:fixed;width:100%;height:315px;background-color:#000;z-index:1;"></div>
		<!-- 右上角头像 -->
		<div style="position:fixed;top:50px;left:50px;width:200px;height:100px;line-height:110px; background:url(img/vip.png) no-repeat;background-size:33% 100% !important; background-color:#000;color:white;font-size:40px;padding-left:100px;z-index:1;" onclick="showMe();">Mix TV</div>

		<!-- 搜索框 -->
		<input type="text" id="searchInput" class="homeTop" style="left:290px;top:-90px;width:370px;height:80px;line-height:80px;font-size:45px;text-align:center;border-radius:50px;background:transparent;color:white;-webkit-transition:1s;outline:none;" autofocus="autofocus" onclick="getID('searchInput').focus();window.androidJs.JsShowImm();" />

		<!-- 搜索图标 -->
		<div style="position:fixed;top:65px;left:670px;width:80px;height:80px;z-index:1;" onclick="showSearchInput();getID('shcContent').innerHTML = '';"><img src="img/search0.png" /></div>

		<!-- 历史图标 -->
		<div style="position:fixed;top:65px;left:770px;width:80px;height:80px;z-index:1;" onclick="showSHC('history',1,'h');getID('shcContent').innerHTML = '';"><img src="img/history0.png" /></div>

		<!-- 收藏图标 -->
		<div style="position:fixed;top:65px;left:870px;width:80px;height:80px;z-index:1;" onclick="showSHC('collect',1,'c');getID('shcContent').innerHTML = '';"><img src="img/collect0.png" /></div>

		<!-- 首页一级分类导航 -->
		<div class="homeTop" style="top:180px;left:0px;width:95%;">
			<ul id="vodTab1" class="tab-head">
				<li class="tab-tab1-item" id="nav0" onClick="clickTab1(0);" style="margin-left:25px;background: url(img/null.png) center no-repeat;">首页</li>
			</ul>
		<div style="position:fixed;top:300px;left:5%;width:90%;height:10px;background-color:#333333;"></div>
		</div>

		<!-- 首页列表 -->
		<div id="vodList0" style="position: absolute;left:0%;top:285px;width:100%;display:block;">
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
				<span style="position:relative;left:15%;" id="homeListName0">热播电影</span>
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
				<span style="position:relative;left:15%;" id="homeListName1">热播剧集</span>
				<span style="position:relative;left:60%;" onclick="showTabList1(2);">更多</span>
				<div style="background:url(img/劇集0.png) no-repeat;" class="homeListLogo"></div>
				<div id="homeListContent1" style="position:absolute;left:0%;top:110px;width:100%;"></div>
			</div>

			<!-- 首页 综艺入口 -->
			<div id="homeList2" class="homeList" style="top:1380px;">
				<span style="position:relative;left:15%;" id="homeListName2">热播短视频</span>
				<span style="position:relative;left:60%;" onclick="showTabList1(3);">更多</span>
				<div style="background:url(img/短视频0.png) no-repeat;" class="homeListLogo"></div>
				<div id="homeListContent2" style="position:absolute;left:0%;top:110px;width:100%;"></div>
			</div>

			<!-- 首页 动漫入口 -->
			<div id="homeList3" class="homeList" style="top:1920px;">
				<span style="position:relative;left:15%;" id="homeListName3">热播综艺</span>
				<span style="position:relative;left:60%;" onclick="showTabList1(4);">更多</span>
				<div style="background:url(img/綜藝0.png) no-repeat;" class="homeListLogo"></div>
				<div id="homeListContent3" style="position:absolute;left:0%;top:110px;width:100%;"></div>
			</div>

			<!-- 首页 动漫入口 -->
			<div id="homeList4" class="homeList" style="top:2460px;">
				<span style="position:relative;left:15%;" id="homeListName4">热播动漫</span>
				<span style="position:relative;left:60%;" onclick="showTabList1(5);">更多</span>
				<div style="background:url(img/動漫0.png) no-repeat;" class="homeListLogo"></div>
				<div id="homeListContent4" style="position:absolute;left:0%;top:110px;width:100%;"></div>
			</div>

			<!-- 首页 动漫入口 -->
			<div id="homeList5" class="homeList" style="top:3000px;">
				<span style="position:relative;left:15%;" id="homeListName5">热播体育</span>
				<span style="position:relative;left:60%;" onclick="showTabList1(6);">更多</span>
				<div style="background:url(img/體育0.png) no-repeat;" class="homeListLogo"></div>
				<div id="homeListContent5" style="position:absolute;left:0%;top:110px;width:100%;"></div>
			</div>
		
		</div>

		<!-- 点播分类导航 -->
		<div id="vodTab" style="position:fixed;left:0%;top:300px;width:100%;display:none;z-index:1;">
			<ul id="vodTabRegion" class="tab-head" style="background-color:#333333;height:60px;line-height:60px;padding-top:1px;padding-left:20px;">
				<!--li class="tab-vod-item" id="region0" style="background-color:#ff9933;" onClick="showHome();" >大陆</li-->
			</ul>
			<ul id="vodTab3" class="tab-head" style="background-color:#666666;height:60px;line-height:60px;padding-top:1px;padding-left:20px;">
				<!--li class="tab-vod-item" id="region0" style="background-color:#ff9933;" onClick="showHome();" >大陆</li-->
			</ul>
		</div>

		<!-- 点播 电影 列表 -->
		<div id="vodList1" class="vodList" style="top:455px;">
			<div id="vodListContent1">
				<!--div id="vodListImg0" class="vodListImg" onClick="playVod(0);" ></div>
				<div id="vodListName0" class="vodListName"></div-->
			</div>
			<div id="loading1" class="vodListName" style="width:100%;height:100px;background:url(img/loading2.gif) center center no-repeat; background-size:10% 40%;padding-top:150px;">loading</div>
			<div id="loadmore1" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

		<!-- 点播 电视剧 列表 -->
		<div id="vodList2" class="vodList" style="top:455px;">
			<div id="vodListContent2">			</div>
			<div id="loading2" class="vodListName" style="width:100%;height:100px;background:url(img/loading2.gif) center center no-repeat; background-size:10% 40%;padding-top:150px;">loading</div>
			<div id="loadmore2" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

		<!-- 点播 综艺 列表 -->
		<div id="vodList3" class="vodList" style="top:455px;">
			<div id="vodListContent3">			</div>
			<div id="loading3" class="vodListName" style="width:100%;height:100px;background:url(img/loading2.gif) center center no-repeat; background-size:10% 40%;padding-top:150px;">loading</div>
			<div id="loadmore3" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

		<!-- 点播 动漫 列表 -->
		<div id="vodList4" class="vodList" style="top:455px;">
			<div id="vodListContent4">			</div>
			<div id="loading4" class="vodListName" style="width:100%;height:100px;background:url(img/loading2.gif) center center no-repeat; background-size:10% 40%;padding-top:150px;">loading</div>
			<div id="loadmore4" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

		<!-- 点播 纪录片 列表 -->
		<div id="vodList5" class="vodList" style="top:455px;">
			<div id="vodListContent5">			</div>
			<div id="loading5" class="vodListName" style="width:100%;height:100px;background:url(img/loading2.gif) center center no-repeat; background-size:10% 40%;padding-top:150px;">loading</div>
			<div id="loadmore5" class="vodListName" style="height:100px;color:gray;"></div>
		</div>	

		<!-- 点播 纪录片 列表 -->
		<div id="vodList6" class="vodList" style="top:455px;">
			<div id="vodListContent6">			</div>
			<div id="loading6" class="vodListName" style="width:100%;height:100px;background:url(img/loading2.gif) center center no-repeat; background-size:10% 40%;padding-top:150px;">loading</div>
			<div id="loadmore6" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

	</div><!-- 点播尾 -->

	<!-- 主播 -->
	<div id="zhiBo" style="background-color:black;display:none;z-index:2;">	
		<div style="position:fixed;left:0px;top:0px;width:100%;height:2000px;background:url(./img/loading.gif);background-size:100% 100%;z-index:2;"></div>
		<div id="zhiBoContent"></div>
	<!--	<div class="zhiBoImg" onclick="playStopZhuBo()">
			<video id="zhiBo0" width="100%" height="100%" poster="img/poster.jpg" preload="auto" src="http://cctvalih5ca.v.myalicdn.com/live/cctv1_2/index.m3u8" style="object-fit:fill"  x5-video-player-fullscreen="true" x5-video-orientation="landscape" x5-playsinline="true" playsinline="true" webkit-playsinline="true" x-webkit-airplay="true" >
			</video>
		</div>-->
	</div>

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
		<div class="detailText" style="top:60px;"><b>类型：</b><span id="detailTag"></span></div>
		<div class="detailText" style="top:80px;"><b>地区：</b><span id="detailRegion"></span></div>
		<div class="detailText" style="top:100px;" id="year" ><b>上映年份：</b><span id="detailYear"></span></div>
		<div class="detailText" style="top:120px;" id="duration"><b>时长：</b><span id="detailDuration"></span></div>
		<div class="detailText" style="top:0px;left:50%;width:45%;" id="score"><b>IMDB评分：</b><span id="detailScore" style="color:#f7a333;"></span></div>

		<div class="detailText" style="top:80px;" id="director"><b>导演：</b><span id="detailDirector" ></span></div>
		<div class="detailText" style="top:100px;" id="actor"><b>主演：</b><span id="detailActor" ></span></div>
		<div class="detailText" style="top:-160px;left:84%;width:100px;height:100px;background:url(img/collect0.png);" onClick="changeCollect()" id="collectImg"></div>
		<div class="detailText" style="top:20px;" id="description" onclick="moreDescription()"><b>剧情：</b><span id="detailDescription"></span></div>
		<div class="detailText2" style="top:-40px;display:none;" id="chooseChapter">选集&emsp;<span id="episodes"></span>
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
<script type=text/javascript src="js/detailXu.js" charset=UTF-8></script>