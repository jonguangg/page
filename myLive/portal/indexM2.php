<script type=text/javascript src="js/global.js" charset=UTF-8></script>
<script type=text/javascript src="js/init2.js"></script>
<script type=text/javascript src="js/register2.js"></script>
<!--script-- type=text/javascript src="js/showHome.js"></!--script-->
<script type=text/javascript src="js/touchMove2.js" charset=UTF-8></script>
<script type=text/javascript src="../jquery-1.11.0.min.js" charset=UTF-8></script>

<?php
include_once "readSplash.php";
include_once "../connectMysql.php";
//	include_once "../readStbArray.php";
include_once "../readChannelArray.php";
include_once "../readTagNav.php";	//获取分类标签
include_once "../readTagList.php";	//首页每类前4个
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
		var channelPageAll = parseInt((channelCount - 1 + 10) / 10);
		var channelPos = (typeof(window.androidJs) != "undefined") ? parseInt(window.androidJs.JsGetCookie("channelPos", 0)) : 0;
		var videoUrlCookie = 0; //( window.androidJs.JsGetCookie("videoUrlCookie",0)=='0' )?channelDataArr[0].channel[0].videoUrl:window.androidJs.JsGetCookie("videoUrlCookie",0);
		//	要在浏览器测试，需将这行上1个设为0

		var imgHeight = "280px"; //图片高度，会在init内根据屏幕宽按16:9重新计算
		var channelCount = 0;
		var channelPagePosTemp = 0;
		var channelPosTemp = channelPos;
		var channelArr = [];
		var indexArea = "lock" //打开应用后默认为锁定状态
		var navPos = 0; //当前分类 0为home 1为movie

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

		function jumpToHome(){
			getID("channel").style.display = "none";
			getID("vod").style.display = "block";
			navPos = 0;
		}

		var groupScrollL = 0;
		function showLiveList(_num) {	//显示直播列表
			var clientWidth = document.body.scrollWidth;
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
		//	getID('nav' + navPos).style.color = "white"; //'#081925';
		//	getID('nav' + navPos).style.fontSize = '60px';
		//	navPos = 1;
		//	getID('nav1').style.color = 'f7a333';
		//	getID("nav1").style.fontSize = "70px";
			getID("group").style.top = (clientWidth * 9 / 16 - 1) + "px"; //频道组
			getID("channels").style.top = (clientWidth * 9 / 16 + 90) + "px"; //频道列表
			if (typeof(window.androidJs) != "undefined") {
				window.androidJs.JsPlayLive(channelTempArr[channelPos].videoUrl);
			//	window.androidJs.JsMovePlayerWindow(0);	//2.0版小窗口固定在上方，不需移动
			}
			groupScrollL = (groupId - 1) * 300;
			getID("groups").scrollLeft = groupScrollL;
			window.androidJs.JsGetPageArea("live");
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
	/*		if (groupId > -1) {	//不显示所有频道就不要这段
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
			getID("channel").style.left = "0px";
			for (i = 0; i < channelTempArr.length; i++) {
				getID("channels").innerHTML += '<div id=channels' + i + ' class="channels" onClick=startLive(' + i + ');><div id=channelId' + i + ' class="channelID" ><img class="liveListImg" src=live/'+(groupStartArr[groupId]+i)+'.jpg /><div class="liveLine" ></div></div><div id=channel' + i + ' class="channel"></div></div>';
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
		var tag2 = 0;	//二级分类，即地区
		var tag3 = 0;	//三级分类，即爱情、动作、喜剧之类的分类标签
		var pageNow = 1; //第一页是1
		var vodPageAll = 1;
		var changePageStatus = "f"; //；加载状态，f为未完成，此时不加载下一页
	//	var navScrollL = 0;
		var playUrl = [];
		var tag1Temp = 1;

		function getTagData(_tag1, _tag2,_tag3,_pageNum, _pageSize, _mobile) {
			if (navPos < 0) { //从直播切换到点播
				getID("vod").style.display = "block";
				getID("channel").style.display = "none";
				if (typeof(window.androidJs) != "undefined") {
					window.androidJs.JsClosePlayer();
				}
			}
			getID("nav" + navPos).style.color = "white"; 
			getID("nav" + navPos).style.backgroundImage = "url(img/"+tagArr[1][navPos].tagTable+"0.png)"; 
			
		//	tag1 = _tag1;
		//	tag2 = _tag2;
			navPos = _tag1;
			getID("vodTab1").scrollLeft = ( (navPos-2)>0 )?(navPos-2)*200:0;
			getID("nav" + navPos).style.color = "f7a333";
			getID("nav" + navPos).style.backgroundImage = "url(img/"+tagArr[1][navPos].tagTable+"1.png)"; 			
			if(_tag1==0){	//显示首页
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
			getID("vodList"+tag1Temp).style.display = "none";
			tag1Temp = _tag1;			
			getID("vodList"+_tag1).style.display = "block";
			getID("vodList"+_tag1).style.left = "0px";
			
			pageNow = _pageNum; //当前页 
			$.ajax({
				type: 'POST',
				url: '../readTagJson.php',
				data: {
					'tag1': tagArr[1][_tag1].tagTable,
					'tag2': tagArr[2][_tag2].tagName,
					'tag3': tagArr[3][_tag3].tagName,
					'pageNow': _pageNum,
					'pageSize': _pageSize,
					'mobile': "mobile",
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
							if( title.length > 4){
								title = '<marquee behavior="scroll" direction="left" width="100%" scrollamonut="100" scrolldelay="100">'+title +'</marquee>';
							}
							playUrl.push(name);
							getID("vodListContent"+_tag1).innerHTML += '<div id=homeListImg'+index+' class="listImg" style="background: url(../vod/'+name+'/'+name+'.jpg)" onClick=location.href="http://tenstar.synology.me:10025/myLive/vod/' +name + '/index.m3u8"><div class="listName">'+title+'</div></div>';
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
			var navPosTemp = navPos;
			navPosTemp += _num;
			if (navPosTemp < 0) {
				navPosTemp = 0;
			}
			if (navPosTemp > tagArr[1].length-1) {
				navPosTemp = tagArr[1].length-1;
			}
			if(navPosTemp>0){
				getID("vodListContent"+navPosTemp).innerHTML = "";
			}				
			getTagData(navPosTemp,0,0, 1, 20, 'mobile');

			getID("region"+regionTemp).style.backgroundColor = "";
			getID("region"+regionTemp).style.color = "white";
			getID("region0").style.color = "#ff9933";
			getID("vodTabRegion").scrollLeft = 0;
			regionTemp = 0;

			getID("tag3_"+tag3Temp).style.backgroundColor = "";
			getID("tag3_"+tag3Temp).style.color = "white";
			getID("tag3_0").style.color = "#ff9933";
			getID("vodTab3").scrollLeft = 0;
			tag3Temp = 0;
		}

		function changePage(_num) { //VOD列表换页
			pageNow += _num;
			if (pageNow > vodPageAll || pageNow < 1) {
				pageNow = vodPageAll;
			}
			getTagData(navPos,regionTemp,tag3Temp,pageNow, 20, "mobile");
		}

		function playVod(_num) {
			var playUrls = "http://tenstar.synology.me:10025/myLive/vod/" + playUrl[_num] + "/index.m3u8";
			if (typeof(window.androidJs) != "undefined") {
				window.androidJs.JsPlayVod(playUrls);
				window.androidJs.JsMovePlayerWindow(0); //每次点播将视频置顶
			}
		}

		function showHomeLiveGroup(){	//显示首页直播分组入口
			for(i=0;i<channelDataArr.length;i++){
				getID('homeNavLive').innerHTML += '<div class="tab-homeLive-item" id="homeLiveGroup"'+i+' onClick="showLiveList('+i+');" style="background:url(img/'+channelDataArr[i]["groupLogo"]+')"><div class="tab-homeLive-groupName">'+channelDataArr[i]["group"]+'</div></div>'
			}
		}

		function showHomeList(){
			for(i=0;i<4;i++){
				for(j=0;j<4;j++){
					var name = homeArr4[i*4+j].fileName.slice(0, homeArr4[i*4+j].fileName.length - 4);
					var homeListIndex = i*4+j;
					var title = homeArr4[i*4+j].title;
					if( title.length > 4){
						title = '<marquee behavior="scroll" direction="left" width="100%" scrollamonut="100" scrolldelay="100">'+title +'</marquee>';
					}
					getID('homeListContent'+i).innerHTML += '<div id=homeListImg'+homeListIndex+' class="listImg" style="background: url(../vod/'+name+'/'+name+'.jpg)" onClick=location.href="http://tenstar.synology.me:10025/myLive/vod/' +name + '/index.m3u8"><div class="listName">'+title+'</div></div>';
				}
			}
		}

		function showTabList1(_num){	//点击一级分类
			getID("region"+regionTemp).style.backgroundColor = "";
			getID("region"+regionTemp).style.color = "white";
			getID("region0").style.color = "#ff9933";
			getID("vodTabRegion").scrollLeft = 0;
		//	regionTemp = 0;

			getID("tag3_"+tag3Temp).style.backgroundColor = "";
			getID("tag3_"+tag3Temp).style.color = "white";
			getID("tag3_0").style.color = "#ff9933";
			getID("vodTab3").scrollLeft = 0;
		//	tag3Temp = 0;

			if(_num>0){
				getID("vodListContent"+_num).innerHTML = "";
			}
			getTagData(_num,0,0,1,20,0);
		}

		function showTab1(){	//显示一级影视类型		
			for(i=0;i<tagArr[1].length;i++){
				getID('vodTab1').innerHTML += '<li class="tab-tab1-item" id=nav'+i+' onClick="showTabList1('+i+')" style="background:url(img/'+tagArr[1][i].tagTable+'0.png)" >'+tagArr[1][i].tagName+'</li>';
			}
			getID("nav0").style.backgroundImage = "url(img/typeHome1.png)";
		}

	//	var regionScrollL = 0;
		var regionTemp = 0;
		function showTabList2(_num){	//点击二级地区
			getID("vodListContent"+navPos).innerHTML = "";
			getID("region"+regionTemp).style.backgroundColor = "";	
			getID("region"+regionTemp).style.color = "white";	
			getID("region"+_num).style.backgroundColor = "#ff9933";	
			regionTemp = _num;

			getID("tag3_"+tag3Temp).style.backgroundColor = "";	
			getID("tag3_0").style.color = "#ff9933";
			getID("vodTab3").scrollLeft = 0;
			
		//	tag3Temp = 0;	

			getTagData(navPos,_num,0,1,20,0);
			getID("vodTabRegion").scrollLeft = ((_num-2) * 200<0)?0:(_num-2) * 200;
		/*	if(_num>2){
				regionScrollL = (_num-2) * 200; //移动分类的位置
				getID("vodTabRegion").scrollLeft = regionScrollL;
			}else{
				getID("vodTabRegion").scrollLeft = 0;
			}*/
		}

		function showTabRegion(){	//显示二级地区分类
			for(i=0;i<tagArr[2].length;i++){
				getID('vodTabRegion').innerHTML += '<li class="tab-vod-item" id=region'+i+' onClick="showTabList2('+i+')" >'+tagArr[2][i].tagName+'</li>';
			}
		}

	//	var tag3ScrollL = 0;
		var tag3Temp = 0;
		function showTag3List(_num){	//点击三级标签
			getID("vodListContent"+navPos).innerHTML = "";
			getID("region"+regionTemp).style.backgroundColor = "";			
			getID("region"+regionTemp).style.color = "#ff9933";

			getID("tag3_"+tag3Temp).style.backgroundColor = "";			
			getID("tag3_"+tag3Temp).style.color = "white";
			getID("tag3_"+_num).style.backgroundColor = "#ff9933";		
			tag3Temp = _num;

			getTagData(navPos,regionTemp,_num,1,20,0);
			getID("vodTab3").scrollLeft = ((_num-2) * 200<0)?0:(_num-2) * 200;
		/*	if(_num>2){
				tag3ScrollL = (_num-2) * 200; //移动分类的位置
				getID("vodTab3").scrollLeft = tag3ScrollL;
			}else{
				getID("vodTab3").scrollLeft = 0;
			}*/
		}
		
		function showTab3(){	//显示三级分类标签
			for(i=0;i<tagArr[3].length;i++){
				getID('vodTab3').innerHTML += '<li class="tab-vod-item" id=tag3_'+i+' onClick="showTag3List('+i+')" >'+tagArr[3][i].tagName+'</li>';
			}
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
		//	getID("test").innerHTML = loadMoreBottom+"<br>"+pageNow;

			if (loadMoreBottom < 670 && pageNow < vodPageAll && navPos > 0 && changePageStatus == "t") { //数字越大，就越早加载下一页,670大概是最后一个图片刚显示的时候
				changePage(1);
				changePageStatus = "f"; //运行一次加载后马上将状态置为假，不允许继续加载，防止滑动屏幕时多次运行changePage(1);
			}

		//	if( pageNow == vodPageAll && navPos>0){
		//		getID("loadmore"+navPos).innerHTML = "•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;the end&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•";
		//	}

		}

		function showSplash(){
			var splashArr = <?php echo json_encode($splashArr); ?>;	
			var splashIndex = window.androidJs.JsGetCookie("splashIndex",0)?window.androidJs.JsGetCookie("splashIndex",0):0;
			splashIndex ++;
			if( splashIndex > splashArr.length-1 ){
				splashIndex = 0;
			}
			window.androidJs.JsSetCookie("splashIndex", splashIndex, '12h');
			getID("splash").style.backgroundImage = 'url(./splash/'+splashArr[splashIndex]+')';
		}

		function init() {
			showSplash();
			stbInfo();			
			startCircle();	//右上角跳过圆圈
			var clientWidth = document.body.scrollWidth;
			var clientHeight = window.innerHeight;			

			getID('bodys').style.width = clientWidth + "px"; //全局宽
			getID("lock").style.height = clientHeight + "px"; //解锁页面的高，即全屏高度
			getID("splash").style.height = clientHeight + "px"; 
			getID("cardKey").style.height = clientHeight + "px"; //注册VIP卡页面的高	

			scrollDisable();		//禁止页面滚动	
			bindEvent();		//绑定滑动事件
			showTab1();				//显示一级分类
			showTabRegion(); 	//显示地区导航
			showTab3(); 			//显示分类标签
			showHomeLiveGroup();//显示首页直播分组入口
			showHomeList();			//显示首页热播列表
		}

		function showSearchInput(){
			if( parseInt(getID('searchLogo').style.top) < 0 ){
				getID('searchLogo').style.top='110px';
				getID('searchLogo').focus();
				window.androidJs.JsShowImm();
			}else{
				alert(getID('searchLogo').value );
			}
		}
	</script>
</head>

<body bgcolor="black" leftmargin="0" topmargin="0" onload="init();" onScroll="moveVideoWindow();">
<div id="bodys" style="position:absolute;top:0px;left:0px;width:100%;display:block;">
	<div id="test" style="position:fixed;top:150px;left:0px;width:100%;height:200px;z-index:20;background-color:white;font-size:100px;color:red;display:none;"></div>
	<!--非直播 -->
	<div id="vod" style="display:block;">
		<!-- 顶部图标 -->
		<div style="position:fixed;width:100%;height:450px;background-color:#000;z-index:1;"></div>

		<div style="position:fixed;top:100px;left:50px;width:200px;height:100px;line-height:100px; background:url(img/vip.png) no-repeat;background-size:35% 100% !important; background-color:#000;color:white;font-size:50px;padding-left:150px;z-index:1;" onclick="showMe();">Mix TV</div>

		<!--div class="homeTop" id="searchLogo" style="top:-90px;left:400px;width:500px;height:80px;line-height:80px;background-color:rgba(255,255,255,0.5);border-radius:50px 50px 50px 50px;font-size:50px;padding-left:20px;-webkit-transition: 0.6s" >请输入搜索关键字</div-->

		<input type="text" id="searchLogo" class="homeTop" style="left:400px;top:-90px;width:400px;height:80px;line-height:80px;font-size:60px;text-align:center;border-radius:50px;background:transparent;color:white;-webkit-transition:1s;outline:none;" autofocus="autofocus" />

		<div style="position:fixed;top:112px;left:820px;width:80px;height:80px;z-index:1;" onclick="showSearchInput()"><img src="img/search.png" /></div>

		<!-- 首页分类导航栏 -->
		<div class="homeTop" style="top:250px;left:0px;width:95%;">
			<ul id="vodTab1" class="tab-head">
				<!--li class="tab-tab1-item" id="nav0" onClick="showHome();" style="background: url(img/typeHome1.png)">首页</li-->
			</ul>
		<div style="position:fixed;top:450px;left:5%;width:90%;height:10px;background-color:#333333;"></div>
		</div>

		<!-- 首页列表 -->
		<div id="vodList0" style="position: absolute;left:0%;top:450px;width:100%;display:block;">
			<!-- 首页 直播入口 -->
			<div class="homeListTitle" style="top:50px;background:url(img/typeLive0.png) no-repeat;">直播频道</div>	
			<div id="historyCollect" style="position:absolute;left:0%;top:200px;width:100%;">			
				<ul id="homeNavLive" class="tab-head">
					<!--div class="tab-homeLive-item" id="homeLiveGroup0" onClick="showLiveList(0);" style="background:url(img/poster.jpg)"><div class="tab-homeLive-groupName">央视</div></div-->
				</ul>
			</div>

			<!-- 首页 电影入口 -->
			<div id="homeList0" class="homeListTitle" style="top:550px;background:url(img/typeMovie0.png) no-repeat;">热播电影
				<span style="position:relative;left:94%;" onclick="showTabList1(1);">更多</span>
			</div>
			<div id="homeListContent0" style="position:absolute;left:0%;top:700px;width:100%;">
				<!--div id="homeListImg0" class="listImg" style="background: url(img/poster.jpg)">
					<div id="homeListName0" class="listName">影片名称</div>
				</div-->
			</div>

			<!-- 首页 电视剧入口 -->
			<div id="homeList1" class="homeListTitle" style="top:1100px;background:url(img/typeSeries0.png) no-repeat;">热播剧集
				<span style="position:relative;left:94%;" onclick="showTabList1(2);">更多</span>
			</div>
			<div id="homeListContent1" style="position:absolute;left:0%;top:1250px;width:100%;">		</div>

			<!-- 首页 综艺入口 -->
			<div id="homeList2" class="homeListTitle" style="top:1650px;background:url(img/typeVariety0.png) no-repeat;">热播综艺
				<span style="position:relative;left:94%;" onclick="showTabList1(3);">更多</span>
			</div>
			<div id="homeListContent2" style="position:absolute;left:0%;top:1800px;width:100%;">		</div>

			<!-- 首页 动漫入口 -->
			<div id="homeList3" class="homeListTitle" style="top:2200px;background:url(img/typeCartoon0.png) no-repeat;">热播动漫
				<span style="position:relative;left:94%;" onclick="showTabList1(4);">更多</span>
			</div>
			<div id="homeListContent3" style="position:absolute;left:0%;top:2350px;width:100%;">		</div>
		
		</div>

		<!-- 点播分类导航 -->
		<div id="vodTab" style="position:fixed;left:0%;top:450px;width:100%;display:none;z-index:2;">
			<ul id="vodTabRegion" class="tab-head" style="background-color:#333333;height:90px;line-height:80px;padding-top:10px;padding-left:20px;">
				<!--li class="tab-vod-item" id="region0" style="background-color:#ff9933;" onClick="showHome();" >大陆</li-->
			</ul>
			<ul id="vodTab3" class="tab-head" style="background-color:#666666;height:90px;line-height:80px;padding-top:10px;padding-left:20px;">
				<!--li class="tab-vod-item" id="region0" style="background-color:#ff9933;" onClick="showHome();" >大陆</li-->
			</ul>
		</div>

		<!-- 点播 电影 列表 -->
		<div id="vodList1" style="position:absolute;top:700px;left:0px;width:100%;display:none;">
			<div id="vodListContent1">
				<!--div id="vodListImg0" class="vodListImg" onClick="playVod(0);" ></div>
				<div id="vodListName0" class="vodListName"></div-->
			</div>
			<div id="loadmore1" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

		<!-- 点播 电视剧 列表 -->
		<div id="vodList2" style="position:absolute;top:700px;left:0px;width:100%;display:none;">
			<div id="vodListContent2">			</div>
			<div id="loadmore2" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

		<!-- 点播 综艺 列表 -->
		<div id="vodList3" style="position:absolute;top:700px;left:0px;width:100%;display:none;">
			<div id="vodListContent3">			</div>
			<div id="loadmore3" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

		<!-- 点播 动漫 列表 -->
		<div id="vodList4" style="position:absolute;top:700px;left:0px;width:100%;display:none;">
			<div id="vodListContent4">			</div>
			<div id="loadmore4" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

		<!-- 点播 纪录片 列表 -->
		<div id="vodList5" style="position:absolute;top:700px;left:0px;width:100%;display:none;">
			<div id="vodListContent5">			</div>
			<div id="loadmore5" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

	</div><!-- 点播尾 -->

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

		<div id="img" style="position:absolute;left:5%;top:58%;width:90%;height:35%;background:url(vipCard.png) no-repeat;background-size:100% 100% !important;"></div>

		<div id="exp" style="position:absolute;left:13%;top:63%;width:77%;height:100px;color:gold;font-size:60px;text-align:left;text-shadow:0px 3px 3px gold;"></div>

		<div id="msg" style="position:absolute;left:5%;top:58%;width:90%;height:35%;text-align:center;font-size:70px;font-weight:900;border-radius:55px 55px 55px 55px;color:red;"></div>
	</div>

	<!-- 启动图片 -->
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

</div><!-- bodys尾 -->
</body></html>