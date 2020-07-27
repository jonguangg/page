<script type=text/javascript src="js/global.js" charset=UTF-8></script>
<script type=text/javascript src="js/init.js"></script>
<script type=text/javascript src="js/register.js"></script>
<script type=text/javascript src="js/showHome.js"></script>
<script type=text/javascript src="js/touchMove.js" charset=UTF-8></script>
<script type=text/javascript src="../jquery-1.11.0.min.js" charset=UTF-8></script>

<?php
include_once "../connectMysql.php";
//	include_once "../readStbArray.php";
include_once "../readChannelArray.php";
include_once "../readTagNav.php";
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
	$sql = mysqli_query($connect, "UPDATE client set isOnLine='$isOnLine',ip='$ip',city='$city',lastTime='$lastTime' where sn='$sn' ") or die(mysqli_error($connect)); //更新在线状态
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
	<link href="style.css" rel="stylesheet">
	<link rel="stylesheet" type="text/css" href="circle/css/normalize.css" /><!--CSS RESET-->
	<link rel="stylesheet" href="circle/css/style.css" type="text/css">
	<script>
		var intLoginTime = <?php echo $intLloginTime ?>; //应用登陆时间，其实这个没必要去后台获取，只要取当前时间即可
		var dataArr = <?php echo json_encode($channelArr); ?>;
		var tagArr = <?php echo json_encode($tagArr); ?>;
		var userKey = (typeof(window.androidJs) != "undefined") ? window.androidJs.JsGetCookie("userKey", 0) : "9527";
		if (parseInt(userKey) == 0) { //没设置密码时获取到的密码为0
			userKey = "9527";
		}
		var groupId = (typeof(window.androidJs) != "undefined") ? parseInt(window.androidJs.JsGetCookie("groupId", 0)) : 0;
		var channelPagePos = (typeof(window.androidJs) != "undefined") ? parseInt(window.androidJs.JsGetCookie("channelPagePos", 0)) : 0;
		var channelPageAll = parseInt((channelCount - 1 + 10) / 10);
		var channelPos = (typeof(window.androidJs) != "undefined") ? parseInt(window.androidJs.JsGetCookie("channelPos", 0)) : 0;
		var videoUrlCookie = 0; //( window.androidJs.JsGetCookie("videoUrlCookie",0)=='0' )?dataArr[0].channel[0].videoUrl:window.androidJs.JsGetCookie("videoUrlCookie",0);
		//	要在浏览器测试，需将这行上1个设为0

		var imgHeight = "280px"; //图片高度，会在init内根据屏幕宽按16:9重新计算
		var channelCount = 0;
		var channelPagePosTemp = 0;
		var channelPosTemp = channelPos;
		var channelArr = [];
		var indexArea = "lock" //打开应用后默认为锁定状态
		var navPos = 0; //当前分类

		for (i = 0; i < dataArr.length; i++) { //合并所有频道为一个数组，便于显示所有频道和跳转
			channelArr = channelArr.concat(dataArr[i].channel);
		}

		var channelTempArr = []; //当前显示的频道组 
		var groupSizeArr = []; //每个组的节目数  
		for (i = 0; i < dataArr.length; i++) {
			groupSizeArr.push(dataArr[i].channel.length);
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
		function showLiveList() {	//显示直播列表
			var clientWidth = document.body.scrollWidth;
			for (i = 0; i < dataArr.length; i++) { //显示频道组
				getID("groups").innerHTML += '<li class=tab-live-item id=group' + i + ' style="font-weight:500" onClick=showChannel(' + i + ');></li>';
				getID("group" + i).innerHTML = dataArr[i].group;
			}
			showChannel(groupId); 
			getID("channel" + channelPos).style.color = "#f7a333";
			getID("channelId" + channelPos).style.color = "#f7a333";
			getID("channel").style.display = "block";
			getID("vodList").style.display = "none";
			getID('nav' + navPos).style.color = "white"; //'#081925';
			getID('nav' + navPos).style.fontSize = '60px';
			navPos = 1;
		//	getID('nav1').style.color = 'f7a333';
		//	getID("nav1").style.fontSize = "70px";
			getID("group").style.top = (clientWidth * 9 / 16 - 1) + "px"; //频道组
			getID("channels").style.top = (clientWidth * 9 / 16 + 90) + "px"; //频道列表
			if (typeof(window.androidJs) != "undefined") {
				window.androidJs.JsPlayLive(channelTempArr[channelPos].videoUrl);
				window.androidJs.JsMovePlayerWindow(0);
			}
			groupScrollL = (groupId - 1) * 300;
			getID("groups").scrollLeft = groupScrollL;
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
			//	getID("test").style.display = "block";
			//	getID("test").innerHTML= _num+"_"+groupId;
			getID("group" + groupId).style.color = "#f7a333";
			channelTempArr = [];
			channelTempArr = (groupId == -1) ? channelArr : channelTempArr.concat(dataArr[groupId].channel);
	/*		if (groupId > -1) {
				for (i = 0; i < channelTempArr.length; i++) { //改写频道号 
				//	channelTempArr[i].channelId = groupStartArr[groupId] + i;
				}
			} else {
				for (i = 0; i < channelArr.length; i++) { //改写频道号  
				//	channelArr[i].channelId = i + 1;
				}
			}*/
			channelCount = channelTempArr.length;
			channelPageAll = parseInt((channelCount - 1 + 10) / 10);
			scrollTo(0, 0);
			getID("channels").innerHTML = "";
			for (i = 0; i < channelTempArr.length; i++) {
				getID("channels").innerHTML += '<div id=channels' + i + ' class="channels" onClick=startLive(' + i + ');><div id=channelId' + i + ' class="channelID" ><img src=live/'+(groupStartArr[groupId]+i)+'.jpg /><div class="liveLine" ></div></div><div id=channel' + i + ' class="channel"></div></div>';
				getID('channel' + i).innerText = channelTempArr[i].name.slice(0, 50);
			//	getID('channelId' + i).innerText = channelTempArr[i].channelId;
			}
		//	getID("channels").innerHTML += "<br><br>";
		}

		function moveChangeGroup(_num) { //滑动切换分类
			var groupIdTemp = groupId;
			groupIdTemp += _num;
			if (groupIdTemp < 0) {
				groupIdTemp = 0;
			}
			if (groupIdTemp > dataArr.length - 1) {
				groupIdTemp = dataArr.length - 1;
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
		var pageNow = 1; //第一页是1不是0
		var vodPageAll = 1;
		var changePageStatus = "f"; //；加载状态，f为未完成，此时不加载下一页
		var navScrollL = 0;
		var playUrl = [];
		function getTagData(_tagNum, _pageNum, _pageSize, _mobile) {
			if (navPos < 0) { //从直播切换到点播
				getID("vodList").style.display = "block";
				getID("channel").style.display = "none";
				if (typeof(window.androidJs) != "undefined") {
					window.androidJs.JsClosePlayer();
				}
			}
			getID("nav" + navPos).style.color = "white"; //"#081925";
			getID("nav" + navPos).style.fontSize = "60px";
			navScrollL += (_tagNum - Math.abs(navPos)) * 150; //移动分类的位置
		//	getID("vodNavList").scrollLeft = navScrollL;
			navPos = _tagNum;
			getID("nav" + navPos).style.color = "f7a333";
			getID("nav" + navPos).style.fontSize = "70px";
			pageNow = _pageNum; //当前页 
			$.ajax({
				type: 'POST',
				url: '../readTagJson.php',
				data: {
					'tagNow': tagArr[_tagNum].tagTable,
					'pageNow': _pageNum,
					'pageSize': _pageSize,
					'mobile': _mobile
				},
				dataType: 'json',
				beforeSend: function() {
					//这里一般显示加载提示;
				},
				success: function(json) {
					var list = json.list;
					vodPageAll = json.pageAll;
					$.each(list,
						function(index, array) { //遍历json数据列
							var name = array['fileName'].slice(array['fileName'].lastIndexOf('/') + 1);
							var title = array['title'];
							name = name.slice(0, name.length - 4);
							playUrl.push(name);
							getID("vodListContent").innerHTML += '<div style="height:' + imgHeight + ';background:url(../vod/' + name + '/' + name + '.jpg) " class="vodListImg" onClick="playVod(' + ((pageNow - 1) * 10 + index) + ');" ></div><div class="vodListName">' + title + '</div>';	
						});
					setTimeout(function() {
						changePageStatus = "t";
					}, 1000); // 加载完成后才将状态改为true
				},
				error: function() {
				}
			});
		}

		function changeTagList(_tagNum) { //点击切换分类列表
			playUrl = [];
			getID('vodListContent').innerHTML = '';
			getTagData(_tagNum, 1, 10, 'mobile');
		}

		function moveChangeTag(_num) { //滑动切换分类
			var navPosTemp = navPos;
			navPosTemp += _num;
			if (navPosTemp < -1) {
				navPosTemp = 1;
			}
			if (navPosTemp > tagArr.length-1) {
				navPosTemp = tagArr.length-1;
			}
			if (navPosTemp == -1) {
				showLiveList();
			} else {
				changeTagList(navPosTemp);
			}
		}

		function changePage(_num) { //VOD列表换页
			pageNow += _num;
			if (pageNow > vodPageAll || pageNow < 1) {
				pageNow = vodPageAll;
			}
			getTagData(navPos, pageNow, 10, "mobile");
			console.log(navPos + "_" + pageNow);
		}

		function playVod(_num) {
			var playUrls = "http://tenstar.synology.me:10025/myLive/vod/" + playUrl[_num] + "/index.m3u8";
			if (typeof(window.androidJs) != "undefined") {
				window.androidJs.JsPlayVod(playUrls);
				window.androidJs.JsMovePlayerWindow(0); //每次点播将视频置顶
			}
		}
/*
		function showTagNav() {
			for (i = tagArr.length; i < 21; i++) { //隐藏没有的分类
				getID("nav" + i).style.display = "none";
			}
			for (i = 0; i < tagArr.length; i++) { //显示栏目分类名称
				getID("nav" + i).innerText = tagArr[i].tagName;
			}
		}*/

		function moveVideoWindow() {
			if (navPos > -1 && document.body.scrollTop == 0) { //只在点播列表且第一个图被挡住时才移动
				var clientWidth = document.body.scrollWidth;
				var clientHeight = window.innerHeight;
				if (typeof(window.androidJs) != "undefined") {
					window.androidJs.JsMovePlayerWindow(clientHeight - clientWidth * 9 / 16);
				}
			} else {
				window.androidJs.JsMovePlayerWindow(0);
			}
		}

		function loadMore() { //加载下一页
			var loadMoreBottom = $(document).height() - document.body.scrollTop - $(window).height();
			if (loadMoreBottom < 600 && pageNow < vodPageAll && navPos > -1 && changePageStatus == "t") { //数字越大，就越早加载下一页,600大概是最后一个图片刚显示的时候
				changePage(1);
				changePageStatus = "f"; //运行一次加载后马上将状态置为假，不允许继续加载，防止滑动屏幕时多次运行changePage(1);
			}
			//	getID("test").style.display = "block";
			//	getID("test").innerHTML = loadMoreBottom+"<br>"+pageNow;
			/*	if( pageNow == vodPageAll){
					getID("loadmore").innerHTML = "- - - - - - the end - - - - - -";
				}*/
		}

		function init() {
		//	showHome();
			stbInfo();
			var clientWidth = document.body.scrollWidth;
			var clientHeight = window.innerHeight;			
			
		/*	for(i=0;i<document.getElementsByClassName("listImg").length;i++){
				document.getElementsByClassName("listImg")[i].style.height = clientWidth*0.2*16/9+"px";
			}
			for(i=0;i<document.getElementsByClassName("listName").top;i++){
				document.getElementsByClassName("listName")[i].style.height = (clientWidth*0.2*16/9+5)+"px";
			}*/

			getID('bodys').style.width = clientWidth + "px"; //全局宽
			getID("splash").style.height = clientHeight + "px"; 
			getID("splash").style.backgroundImage = 'url(./splash/'+splashArr[splashIndex]+')';
			startCircle();//右上角跳过圆圈
			getID("lock").style.height = clientHeight + "px"; //解锁页面的高，即全屏高度
			getID("cardKey").style.height = clientHeight + "px"; //注册VIP卡页面的高	
			scrollDisable();	//禁止页面滚动	
			bindEvent();	//绑定滑动事件
		//	showTagNav(); //动态显示下方分类导航
		//	getTagData(0, 1, 10, "mobile"); //预加载
			//	alert('网页可见区域宽：'+document.body.clientWidth+'\n网页可见区域高：'+document.body.clientHeight+'\n网页可见区域宽：'+document.body.offsetWidth+ '\n网页可见区域高：'+document.body.offsetHeight+ '\n网页正文全文宽：'+document.body.scrollWidth+ '\n网页正文全文高：'+document.body.scrollHeight+ '\n网页被卷去的高：'+document.body.scrollTop+ '\n网页被卷去的左：'+document.body.scrollLeft+'\n网页正文部分上：'+window.screenTop+ '\n网页正文部分左：'+window.screenLeft+ '\n屏幕分辨率的高：'+window.screen.height+ '\n屏幕分辨率的宽：'+window.screen.width+ '\n屏幕可用工作区高度：'+window.screen.availHeight+'\n屏幕可用工作区宽度：'+window.screen.availWidth+'\nwindow.innerHeight：'+window.innerHeight);
		}
	</script>
</head>

<body bgcolor="black" leftmargin="0" topmargin="0" onload="init();" onScroll="moveVideoWindow();">
<div id="bodys" style="position:absolute;top:0px;left:0px;width:100%;display:block;">
	<div id="test" style="position:fixed;top:1000px;left:0px;width:100%;height:200px;z-index:20;background-color:white;font-size:100px;display:none;"></div>
	<!-- 顶部图标 -->
	<div style="position: fixed;top:100px;left:50px;width:100px;height:100px;background-size:100% 100% !important;background:url('img/vip.png') no-repeat;"></div>
	<div style="position:absolute;left:170px;top:110px;width:500px;height:100px;line-height:100px;font-size:60px;color:white;">Mix TV</div>
	<div style="position: absolute;top:110px;right:50px;width:500px;height:80px;ling-height:80px;border-radius:50px 50px 50px 50px;background-color:rgba(255,255,255,0.8);font-size:50px;padding-left:20px;">冰雪奇缘2</div>
	<div style="position:fixed;top:110px;right:70px;width:80px;height:80px;"><img src="img/search.png" /></div>

	<!-- 分类导航栏 -->
	<div id="vodNav" style="position:fixed;top:240px;left:50px;width:95%;z-index:2;">
		<ul id="vodNavList" class="tab-head">
			<li class="tab-head-item" id="nav0" onClick="showHome();" style="background: url(img/home1.png)"></li>
			<li class="tab-head-item" id="nav1" onClick="showLiveList();" style="background: url(img/live0.png)"></li>
			<li class="tab-head-item" id="nav2" onClick="changeTagList(0);" style="background: url(img/movie0.png)"></li>
			<li class="tab-head-item" id="nav3" onClick="changeTagList(1);" style="background: url(img/series0.png)"></li>
			<li class="tab-head-item" id="nav4" onClick="changeTagList(2);" style="background: url(img/sports0.png)"></li>
			<li class="tab-head-item" id="nav5" onClick="changeTagList(3);" style="background: url(img/variety0.png)"></li>
			<li class="tab-head-item" id="nav6" onClick="changeTagList(4);" style="background: url(img/eighteen0.png)"></li>
		</ul>
	<div style="position:fixed;top:440px;left:5%;width:90%;height:10px;background-color:#333333;"></div>
	</div>

	<!-- 最近观看 -->
	<div style="position:absolute;left:50px;top:450px;width:500px;height:100px;line-height:100px;font-size:50px;background:url(img/history0.png) no-repeat;background-size:20% 100%;padding-left:150px;">最近观看</div>

	<!-- 我的收藏 -->
	<div style="position:absolute;left:450px;top:450px;width:500px;height:100px;line-height:100px;font-size:50px;background:url(img/collect0.png) no-repeat;background-size:20% 100%;padding-left:150px;">我的收藏</div>

	<!-- 首页 历史 收藏 列表 -->
	<div id="historyCollect" style="position:absolute;left:4%;top:580px;width:96%;">
		<div id="historyCollectImg0" class="listImg" style="background: url(img/poster.jpg)">
			<div id="historyCollectName0" class="listName">影片名称</div>
		</div>
		<div id="historyCollectImg1" class="listImg" style="background: url(img/poster.jpg)">
			<div id="historyCollectName1" class="listName">影片名称</div>
		</div>
		<div id="historyCollectImg2" class="listImg" style="background: url(img/poster.jpg)">
			<div id="historyCollectName2" class="listName">影片名称</div>
		</div>
		<div id="historyCollectImg3" class="listImg" style="background: url(img/poster.jpg)">
			<div id="historyCollectName3" class="listName">影片名称</div>
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
	</div>

	<!-- 点播列表 -->
	<div id="vodList" style="position:absolute;top:0px;left:0px;width:100%;display:none;">
		<div id="vodListContent">
			<!--div id="vodListImg0" class="vodListImg" onClick="playVod(0);" ></div>
			<div id="vodListName0" class="vodListName"></div-->
		</div>
		<div id="loadmore" class="vodListName" style="height:200px;"></div><br><br>
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

			<div class="lockNumR" style="left:0px;top:75%;font-size:90px;" onClick="checkPin(10);">Alter</div>
			<div class="lockNumR" style="left:33.3%;top:75%;" onClick="checkPin(0);">0</div>
			<div class="lockNum" style="left:66.6%;top:75%;font-size:90px;" onClick="checkPin(11);">Del</div>
		</div>
	</div>

	<!-- 输入卡号及卡密 -->
	<div id="cardKey" style="position:absolute;top:0px;left:0px;width:100%;height:0px;background:linear-gradient(to bottom,red,deeppink,orange,yellow,green,blue,indigo,violet);display:none;text-align:center;font-size:80px;color:white; z-index:10;">
		<h1 id="title" style="position:absolute;left:0px;top:5%;width:100%;height:100px;text-align:center;font-size:90px;text-shadow:-5px 5px 5px #000;">Registered VIP Card</h1>

		<div style="position:absolute;left:5%;top:16%;width:90%;height:70px;font-size:60px;text-align:left;text-shadow:-5px 5px 5px #000;">Card Number</div>
		<!-- 卡号输入框 -->
		<input type="number" id="card_id" style="position:absolute;left:5%;top:21%;width:90%;height:100px;font-size:60px;text-align:center;border-radius:10px 10px 10px 10px;background:transparent;" maxlength="8" oninput="onInputHandler(event,'card_id')" autofocus="autofocus" onkeyup="value=value.replace(/[^-\d]/g,'')" />

		<div style="position:absolute;left:40%;top:21%;width:50%;height:100px;" onClick="window.androidJs.JsShowImm();getID('card_id').focus();"></div>

		<div style="position:absolute;left:5%;top:30%;width:90%;height:70px;font-size:60px;text-align:left;text-shadow:-5px 5px 5px #000;">PIN Code</div>
		<!-- 卡密输入框 -->
		<input type="number" id="card_key" style="position:absolute;left:5%;top:35%;width:90%;height:100px;font-size:60px;text-align:center;border-radius:10px 10px 10px 10px;background:transparent;" maxlength="8" oninput="onInputHandler(event,'card_key')" onkeyup="value=value.replace(/[^-\d]/g,'')" />

		<div style="position:absolute;left:40%;top:35%;width:50%;height:100px;" onClick="window.androidJs.JsShowImm();getID('card_key').focus();"></div>

		<div id="back" style="position:absolute;left:5%;top:45%;width:40%;line-height:120px;font-size:80px;text-align:center; border-radius:60px 60px 60px 60px;background:linear-gradient(to bottom,yellow,green);color:gold;text-shadow:-5px 5px 5px #000;" onclick="back()"><b>back</b></div>

		<div id="ok" style="position:absolute;left:55%;top:45%;width:40%;line-height:120px;font-size:80px;text-align:center; border-radius:60px 60px 60px 60px;background:linear-gradient(to bottom,yellow,green);color:gold;text-shadow:-5px 5px 5px #000;" onclick="checkInput()"><b>submit</b></div>

		<div id="img" style="position:absolute;left:5%;top:60%;width:90%;height:35%;background:url(vipCard.png) no-repeat;background-size:100% 100% !important;"></div>

		<div id="exp" style="position:absolute;left:13%;top:65%;width:77%;height:100px;color:gold;font-size:60px;text-align:left;text-shadow:0px 3px 3px gold;"></div>

		<div id="msg" style="position:absolute;left:5%;top:60%;width:90%;height:35%;text-align:center;font-size:70px;font-weight:900;border-radius:55px 55px 55px 55px;color:red;"></div>
	</div>

	<div id="splash" style="position: absolute;left:0px;top:0px;width:1080px;height:1920px;background:url(null.png);background-size:100% 100%;display:block;z-index:99;">	
		<div onclick="getID('splash').style.display='none';getID('lock').style.display='block';" style="position: absolute;right:100px;">
			<div class="flex-container" >
				<div class="outbox" id="splashJump">跳过</div>
				<svg class="svg">
					<circle id="cls" class="cls run-anim" cx="70" cy="70" r="65"></circle>
				</svg>
			</div>
		</div>
	</div>

</div></body></html>