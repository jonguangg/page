<script type=text/javascript src="js/global.js" charset=UTF-8></script>
<script type=text/javascript src="js/register2.js"></script>
<script type=text/javascript src="../jquery-1.11.0.min.js" charset=UTF-8></script>
<script type=text/javascript src="js/touchMove2.js" charset=UTF-8></script>
<script>
	function imOnLine() { //上报在线状态
		var now = new Date(); //此时此刻
		var sec = now.getSeconds(); //此时的秒
		//因为后台是每个被5整除的分钟时下线所有机顶盒，所以这里要在下线后即时（延时1分钟）上线
		//如果当前分钟正好被5整除，则说明此时后台刚刚下线所有机顶盒，前端延时1分钟上线当前机顶盒 60-sec是为了精确到秒
		//如果当前分钟离整5有1、2、3、4分钟，则分别延时1、2、3、4分钟。用6减模5余几的数，就是要延时的时间
		var ms = (now.getMinutes() % 5 == 0) ? 60 - sec : (6 - now.getMinutes() % 5) * 60 - sec;
		//	var ms = ( (6-now.getMinutes()%5)*60>300 )?60-sec:(6-now.getMinutes()%5)*60-sec;
		//	var ms = ( (6-now.getMinutes()%5)*60000>300000 )?60000-sec*1000:(6-now.getMinutes()%5)*60000-sec*1000;
		//	sn = ( sn )?sn:window.androidJs.JsGetCookie("sn",0);
		//	getID("vodListName1").innerHTML += "_"+now.getMinutes()+":"+sec+sn+"<br>";
		st = setTimeout(function() {
			sendAjax("./ajax.php", "imOnlineSN=" + sn);
			imOnLine();
		}, ms * 1000);
	}

	var xmlHttp; //1.创建XMLHttpRequest对象
	//var xmlHttp = new XMLHttpRequest();// 1.创建XMLHttpRequest对象(不兼容浏览器)
	function createXmlHttpRequestObject() {
		if (window.ActiveXObject) { //如果在internet Explorer下运行
			try {
				xmlHttp = new ActiveXObject("Microsoft.XMLHTTP");
			} catch (e) {
				xmlHttp = false;
			}
		} else {
			try { //如果在Mozilla或其他的浏览器下运行
				xmlHttp = new XMLHttpRequest();
			} catch (e) {
				xmlHttp = false;
			}
		}
		if (!xmlHttp) { //返回创建的对象或显示错误信息
			alert("返回创建的对象或显示错误信息");
		} else {
			return xmlHttp;
		}
	}

	var backArea = "false";
	var expireTime = "";
	var intExpireTime = "";
	function sendAjax(_url, _content) {
		createXmlHttpRequestObject();
		// 2.请求行
		xmlHttp.open("POST", _url); //"./isOnLine.php");
		// 3.请求头
		xmlHttp.setRequestHeader('Content-Type', ' application/x-www-form-urlencoded');
		// 4.设置数据
		xmlHttp.send(_content); //'sn='+sn);
		// 5.监听服务器响应
		xmlHttp.onreadystatechange = function() {
			if (xmlHttp.readyState == 4 && xmlHttp.status == 200) {
				/*if( _content.indexOf('imOnLineSN') > -1 ){
					imOnLine();//改成直接在imOnLime()程序里启动定时器
				}else */
				if (_content.indexOf('checkLicenseSN') > -1) {
					expireTime = xmlHttp.responseText.slice(xmlHttp.responseText.indexOf("expireTime") + 10);
					intExpireTime = xmlHttp.responseText.slice(xmlHttp.responseText.indexOf("Succeed") + 7, 15);
					setCookie("expireTime", expireTime, "8h");
					setCookie("intExpireTime", intExpireTime, "8h");
					if (parseInt(intLoginTime) > parseInt(intExpireTime)) { //授权已过期
						setTimeout(function() {
							scrollTo(0, 0);
							getID("cardKey").style.display = "block";
							getID("exp").innerHTML = "Exp. " + expireTime;
							scrollDisable();
							if (typeof(window.androidJs) != "undefined") {
								window.androidJs.JsClosePlayer();
								window.androidJs.JsShowImm();
							}
						}, 10000); //10秒后弹出注册页面
						//	indexArea = "cardKey";
						/*	showVodList(0);//加这个是为了从直播进入输入卡号的时候，列表太长，虽然出了输入卡号的界面，但还是可以下拉
							for(i=0;i<10;i++){//授权过期就将列表隐藏，否则虽然出了输入卡号的界面，但还是可以下拉
								getID("vodListImg"+i).style.height = "1px";
							}		*/

					} else {
						backArea = "true";
						//	indexArea = ( indexArea== "lock" )?"lock":"live";//如果一直停留在解锁界面，就不改变焦点状态
					}
				} else if (_content.indexOf('card') > -1) { //注册卡号
					var clientHeight = window.innerHeight;
					if (xmlHttp.responseText.indexOf("Succeed") > -1) { //成功延期
						expireTime = xmlHttp.responseText.slice(xmlHttp.responseText.indexOf("expireTime") + 10);
						intExpireTime = xmlHttp.responseText.slice(xmlHttp.responseText.indexOf("Succeed") + 7, 15);
						getID("msg").innerHTML = "<br>Succeed ! <br>Your expire time is </br>" + expireTime + "</br>Back to enjoy videos !<br>";
						getID("msg").style.lineHeight = clientHeight * 0.35 * 0.16 + "px"; //多行内容，调整到居中显示
						setCookie("expireTime", expireTime, "8h");
						setCookie("intExpireTime", intExpireTime, "8h");
						backArea = "true";
					} else { //失败
						getID("msg").style.lineHeight = clientHeight * 0.35 + "px"; //只一行内容，行高=div height
						if (xmlHttp.responseText.indexOf("Card") > -1) { //卡号输错了	
							getID("msg").innerHTML = xmlHttp.responseText.slice(xmlHttp.responseText.indexOf("error") + 5);
						} else if (xmlHttp.responseText.indexOf("PIN") > -1) { //密码输错了	
							getID("msg").innerHTML = xmlHttp.responseText.slice(xmlHttp.responseText.indexOf("error") + 5);
						}
					}
					getID("msg").style.background = "linear-gradient(to bottom,green,blue,indigo,violet)";
				}
			}
		}
	}

	var sn = '';
	var deviceBrand = '';
	var systemModel = '';
	function stbInfo() {
		sn = (typeof(window.androidJs) != "undefined") ? window.androidJs.JsGetMac() : "";
		deviceBrand = (typeof(window.androidJs) != "undefined") ? window.androidJs.JsGetDeviceBrand() : "";
		systemModel = (typeof(window.androidJs) != "undefined") ? window.androidJs.JsSystemModel() : "";
		deviceBrand = deviceBrand.replace(/\s*/g, ""); //删除空格
		systemModel = systemModel.replace(/\s*/g, ""); //删除空格
		sn = sn + deviceBrand + systemModel; //用厂家型号和MAC拼接成一个新的SN
		var deviceInfo = deviceBrand + "_" + systemModel;
		setCookie("deviceInfo", deviceInfo, '1000d'); //供php页面记录备注
		setCookie("sn", sn, '1000d'); //供app从后台唤醒时使用
		sendAjax("./indexM2.php", "imOnLineSN=" + sn); //传递当前SN给php页面去获取授权信息
		return sn;
	}

	//延时3秒钟检查授权日期 同时启动上报在线状态的定时器
	setTimeout(function() {
		sendAjax("./ajax.php", "checkLicenseSN=" + sn);
		imOnLine();
		getID("splash").style.display = "none";
		if( indexArea=="lock"){//不加这个，用户点跳过后，还会弹出锁定界面
			getID('lock').style.display = 'block';
		}		
	}, 5000);

	var mo = function(e) {
		e.preventDefault();
	};

	function scrollDisable() {
		document.body.style.overflow = 'hidden';
		document.addEventListener("touchmove", mo, {
			passive: false
		}); //禁止页面滑动
	}

	function scrollEnable() {
		document.body.style.overflow = ''; //出现滚动条
		document.removeEventListener("touchmove", mo, {
			passive: false
		});
	}
</script>

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

function getIP()
{	//获取用户真实 IP
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

function getCity()
{			// 获取当前IP所在城市 
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
	<link rel="stylesheet" type="text/css" href="style2.css"/>
	<link rel="stylesheet" type="text/css" href="circle/css/normalize.css" /><!--CSS RESET-->
	<link rel="stylesheet" type="text/css" href="circle/css/style.css"  />
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

		var vodImgHeight = "480px"; //图片高度，会在init内根据屏幕宽按16:9重新计算
		var channelCount = 0;
		var channelPagePosTemp = 0;
		var channelPosTemp = channelPos;
		var channelArr = [];
		var indexArea = "lock" //打开应用后默认为锁定状态
		var navPos = 0; //当前分类

		for (i = 0; i < dataArr.length; i++) { //合并所有频道为一个数组，便于显示所有频道和跳转
			channelArr = channelArr.concat(dataArr[i].channel);
		}
		//console.log(channelArr[ channelArr.length-1 ].name);

		var channelTempArr = []; //当前显示的频道组 
		var groupSizeArr = []; //每个组的节目数  
		for (i = 0; i < dataArr.length; i++) {
			groupSizeArr.push(dataArr[i].channel.length);
		}
		//console.log( groupSizeArr );

		var groupStartArr = [1]; //每个频道组第一个频道号 
		for (i = 1; i < groupSizeArr.length; i++) {
			var groupStart = 1;
			for (j = 0; j < i; j++) {
				groupStart += groupSizeArr[j];
			}
			groupStartArr.push(groupStart);
		}
		//console.log( groupStartArr );

		var groupScrollL = 0;

		function showLiveList() {
			var clientWidth = document.body.scrollWidth;
			for (i = 0; i < dataArr.length; i++) { //显示频道组
				getID("groups").innerHTML += '<li class=tab-head-item id=group' + i + ' style="font-weight:500" onClick=showChannel(' + i + ');></li>';
				getID("group" + i).innerHTML = dataArr[i].group;
			}
			showChannel(groupId); //显示直播列表
			getID("channel" + channelPos).style.color = "#39C5BB";
			getID("channelId" + channelPos).style.color = "#39C5BB";
			getID("channel").style.display = "block";
			getID("vodList").style.display = "none";
			getID('nav' + navPos).style.color = "white"; //'#081925';
			getID('nav' + navPos).style.fontSize = '60px';
			navPos = -1;
			getID('nav-1').style.color = '39C5BB';
			getID("nav-1").style.fontSize = "70px";
			getID("group").style.top = (clientWidth * 9 / 16 - 1) + "px"; //频道组
			getID("channels").style.top = (clientWidth * 9 / 16 + 90) + "px"; //频道列表
			if (typeof(window.androidJs) != "undefined") {
				window.androidJs.JsPlayLive(channelTempArr[channelPos].videoUrl);
				window.androidJs.JsMovePlayerWindow(0);
			}
			groupScrollL = (groupId - 1) * 300;
			getID("groups").scrollLeft = groupScrollL;
		}

		function startLive(_num) {
			getID("channel" + channelPos).style.color = "white";
			getID("channelId" + channelPos).style.color = "white";
			channelPos = _num;
			getID("channel" + channelPos).style.color = "#39C5BB";
			getID("channelId" + channelPos).style.color = "#39C5BB";
			updateCookie();
			if (typeof(window.androidJs) != "undefined") {
				window.androidJs.JsPlayLive(channelTempArr[_num].videoUrl);
			}
			//	window.clearTimeout(st);
			//	imOnLine();	//加这个是为了应用从后台激活后再播放就重新上报在线状态
		}

		function showChannel(_num) { //点击切换频道组
			groupScrollL += (_num - groupId) * 300; //移动分类的位置
			getID("groups").scrollLeft = groupScrollL;
			getID("group" + groupId).style.color = 'white'; //"#081925";
			groupId = _num;
			//	getID("test").style.display = "block";
			//	getID("test").innerHTML= _num+"_"+groupId;
			getID("group" + groupId).style.color = "#39C5BB";
			channelTempArr = [];
			channelTempArr = (groupId == -1) ? channelArr : channelTempArr.concat(dataArr[groupId].channel);
			if (groupId > -1) {
				for (i = 0; i < channelTempArr.length; i++) { //改写频道号 
					channelTempArr[i].channelId = groupStartArr[groupId] + i;
				}
			} else {
				for (i = 0; i < channelArr.length; i++) { //改写频道号  
					channelArr[i].channelId = i + 1;
				}
			}
			channelCount = channelTempArr.length;
			channelPageAll = parseInt((channelCount - 1 + 10) / 10);
			scrollTo(0, 0);
			getID("channels").innerHTML = "";
			for (i = 0; i < channelTempArr.length; i++) {
				getID("channels").innerHTML += '<div id=channels' + i + ' class="channels" onClick=startLive(' + i + ');><div id=channelId' + i + ' class="channelID"></div><div id=channel' + i + ' class="channel"></div></div>';
				getID('channel' + i).innerText = channelTempArr[i].name.slice(0, 50);
				getID('channelId' + i).innerText = channelTempArr[i].channelId;
			}
			getID("channels").innerHTML += "<br><br>";
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

		function changeChannel(_num) { //播放时上下键换台 频道列表不显示出来，手机端需换成上下滑动
			moveChannel(_num);
			channelJump = (parseInt(channelJump) + _num).toString();
			if (parseInt(channelJump) < channelTempArr[0].channelId) { //同组内到了第一个再减，就跳到最后一个
				channelJump = channelTempArr[channelTempArr.length - 1].channelId.toString();
			}
			if (parseInt(channelJump) > channelTempArr[channelTempArr.length - 1].channelId) { //同组内到了最后一个，就跳到第一个
				channelJump = channelTempArr[0].channelId.toString();
			}
			getID('jumpChannel').innerText = channelJump; //换台后显示频道号
			window.setTimeout('getID("jumpChannel").innerHTML = ""', 2000);
			if (parseInt(channelJump) > 0) {
				getID('jumpName').innerText = channelArr[parseInt(channelJump) - 1].name;
				window.setTimeout('getID("jumpName").innerHTML = ""', 2000);
			}
			if (typeof(window.androidJs) != "undefined") {
				window.androidJs.JsPlayLive(channelArr[parseInt(channelJump) - 1].videoUrl);
			}
			updateCookie(); //记录 channelPagePos channelPos channelJump videoUrl
		}

		function showHiddenChannelList(_num) { //_num为0，给返回键隐藏频道列表，_num为其它值，给OK键来回切换显示或隐藏频道列表 
			if (typeof(window.androidJs) != "undefined") {
				window.androidJs.JsShowHiddenChannelList();
			} //记录频道列表是否显示
			getID('channels' + channelPos).style.background = 'rgba(0,0,0,0)';
			channelPagePos = (getID('channel').style.display == 'block') ? channelPagePosTemp : channelPagePos;
			channelPos = (getID('channel').style.display == 'block') ? channelPosTemp : channelPos;
			if (_num == 0) {
				getID('channel').style.display = 'none';
			} else {
				getID('channel').style.display = (getID('channel').style.display == 'block') ? 'none' : 'block';
			}
		}
		/*

		var vodPageCurr = 0;		//当前页
		var vodPageAll = parseInt( (navArr[navPos].length-1+10)/10 );	//总页数
		function showVodList(_num){
			if( typeof(window.androidJs) != "undefined" && navPos==-1 ){
				window.androidJs.JsClosePlayer();
			}	
			getID("vodList").style.display = "block";
			getID("channel").style.display = "none";
			scrollTo(0,0);
			getID("nav"+navPos).style.color = "#081925";
			getID("nav"+navPos).style.fontSize = "60px";
			
			if( navPos != _num){	//如果换了分类，就将当前页码归0
				vodPageCurr = 0;
			}
			navPos = _num;
			getID("nav"+navPos).style.color = "39C5BB";
			getID("nav"+navPos).style.fontSize = "70px";
			vodPageAll = parseInt( (navArr[navPos].length-1+10)/10 );
			for(i=0;i<10;i++){
				if( navArr[navPos][vodPageCurr*10+i] ){
					getID("vodListImg"+i).style.display = "block";
					getID("vodListName"+i).style.display = "block";
					getID("vodListImg"+i).style.backgroundImage = "url(../vod/"+navArr[navPos][vodPageCurr*10+i].video+"/"+navArr[navPos][vodPageCurr*10+i].video+".png)";
					getID("vodListName"+i).innerText = navArr[navPos][vodPageCurr*10+i].title;
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
			if( vodPageAll >1 ){
				getID("vodNextPage").style.display = "block";
			}else{
				getID("vodNextPage").style.display = "none";
			}	
		}
		*/
		//	显示分类列表
		var pageNow = 1; //第一页是1不是0
		var vodPageAll = 1;
		var changePageStatus = "f"; //；加载状态，f为未完成，此时不加载下一页
		var navScrollL = 0;
		//	var tagNow = "tagChinese";
		var playUrl = [];
		//	var tagArr = ["tagChinese", "tagJapan", "tagEurUSA", "tagMosaic", "tagNP", "tagRole"];
		//	var tagNavArr = ["三国", "水浒", "西游", "初唐", "盛唐"];

		function getTagData(_tagNum, _pageNum, _pageSize, _mobile) {
			if (navPos < 0) { //从直播切换到点播
				getID("vodList").style.display = "block";
				getID("channel").style.display = "none";
				if (typeof(window.androidJs) != "undefined") {
					window.androidJs.JsClosePlayer();
				}
			}
			/*	for(i=0;i<10;i++){	//先清空点播列表
					getID("vodListImg"+i).style.display = "block";
					getID("vodListName"+i).style.display = "block";				
					getID("vodListImg"+i).style.backgroundImage = "url(./null.png)";	
					getID("vodListName"+i).innerText = 	"";
				}*/
			//	getID("vodListContent").innerHTML = "";
			getID("nav" + navPos).style.color = "white"; //"#081925";
			getID("nav" + navPos).style.fontSize = "60px";
			//	playUrl = [];
			//	if( _tagNum > navPos ){	//点击的在当前的右边
			navScrollL += (_tagNum - Math.abs(navPos)) * 150; //移动分类的位置
			getID("vodNavList").scrollLeft = navScrollL;
			//	}
			navPos = _tagNum;
			getID("nav" + navPos).style.color = "39C5BB";
			getID("nav" + navPos).style.fontSize = "70px";
			//	tagNow = tagArr[_tagNum];		//当前分类
			pageNow = _pageNum; //当前页 
			$.ajax({
				type: 'POST',
				url: '../readTagJson.php',
				data: { //这下面的内容没用上，用的是上面的cookie
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

							getID("vodListContent").innerHTML += '<div style="height:' + vodImgHeight + ';background:url(../vod/' + name + '/' + name + '.jpg) " class="vodListImg" onClick="playVod(' + ((pageNow - 1) * 10 + index) + ');" ></div><div class="vodListName">' + title + '</div>'

							//	getID("vodListImg"+index).style.display = "block";
							//	getID("vodListName"+index).style.display = "block";				
							//	getID("vodListImg"+index).style.backgroundImage = "url(../vod/"+name+"/"+name+".jpg)";	
							//	getID("vodListName"+index).innerText = 	title;	
						});
					setTimeout(function() {
						changePageStatus = "t";
					}, 1000); // 加载完成后才将状态改为true
					/*	if( list.length<10 ){//隐藏没有内容的div
							for(i=list.length;i<10;i++){
								getID("vodListImg"+i).style.display = "none";
								getID("vodListName"+i).style.display = "none";						
							}
						}
						if( vodPageAll >1 ){
							getID("vodNextPage").style.display = "block";
						}else{
							getID("vodNextPage").style.display = "none";
						}*/
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
			//	scrollTo(0,0);
		}

		function playVod(_num) {
			var playUrls = "http://tenstar.synology.me:10025/myLive/vod/" + playUrl[_num] + "/index.m3u8";
			if (typeof(window.androidJs) != "undefined") {
				window.androidJs.JsPlayVod(playUrls);
				window.androidJs.JsMovePlayerWindow(0); //每次点播将视频置顶
			}
			//	var clientWidth  = document.body.scrollWidth;
		}

		function showTagNav() {
			for (i = tagArr.length; i < 21; i++) { //隐藏没有的分类
				getID("nav" + i).style.display = "none";
			}
			for (i = 0; i < tagArr.length; i++) { //显示栏目分类名称
				getID("nav" + i).innerText = tagArr[i].tagName;
			}
		}

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
			//	loadMore();//监测页面最下方定位符的位置，当这个位置大概为100时，表示最后一个图片已显示，此时应加载下一页
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
					getID("loadmore").innerHTML = "--- the end ---";
				}*/
		}

		function showMe() { //进入个人中心
			scrollTo(0, 0);
			getID('cardKey').style.display = 'block';
			getID("exp").innerHTML = "Exp. " + expireTime;
			getID("msg").style.background = ""; //多次进入个人中心，这里可能会显示注册时的信息
			getID("msg").innerHTML = ""; //所以先清空
			if (typeof(window.androidJs) != "undefined") {
				window.androidJs.JsClosePlayer();
			}
			scrollDisable();
		}

		function back() { //从个人中心返回
			if (parseInt(intLoginTime) < parseInt(intExpireTime) || backArea == "true") { //授权没过期
				getID("cardKey").style.display = 'none';
				scrollEnable();
				if (navPos == -1) {
					showLiveList();
				}
				getID("msg").innerHTML = "";
				getID("msg").style.background = "";
			} else {
				getID("msg").style.lineHeight = window.innerHeight * 0.35 + "px"; //只一行内容，行高=div height
				getID("msg").innerHTML = "Register your VIP card !";
				getID("msg").style.background = "linear-gradient(to bottom,yellow,green,blue,indigo)";
			}
		}

		var pinTemp = "";
		var pinTemp1 = "";
		var pinTemp2 = "";
		function clearLockKey() { //清除输入的解锁密码
			pinTemp = "";
			getID("lockKey1").innerHTML = "";
			getID("lockKey2").innerHTML = "";
			getID("lockKey3").innerHTML = "";
			getID("lockKey4").innerHTML = "";
		}

		function checkPin(_num) { //解锁
			if (typeof(window.androidJs) != "undefined") {
				window.androidJs.JsVibrate(40);
			}
			if (indexArea == "lock" || indexArea == "alterCheck") { //输入解锁密码
				if (_num == 10) { //修改密码
					clearLockKey();
					indexArea = "alterCheck";
					getID("prompt").innerText = "Check your old key";
				} else if (_num == 11) { //清除
					clearLockKey();
				} else if (pinTemp.length < 4) { //不到4位就可以输入
					pinTemp += _num;
					getID("lockKey" + pinTemp.length).innerText = "*";
					if (pinTemp == userKey) { //密码正确
						if (indexArea == "alterCheck") { //如果是要改密码
							indexArea = "alter";
							getID("prompt").innerText = "Enter your new key";
							clearLockKey();
						} else { //密码正确就隐藏解锁界面并显示点播列表
							indexArea = "live";
							getID("lock").style.display = "none";
							getID("vodList").style.display = "block";
							var clientWidth = document.body.scrollWidth;
							/*	for(i=0;i<10;i++){
									getID("vodListImg"+i).style.height = (clientWidth*9/16)+"px";
								}*/
							scrollEnable();
						}
					}
				}
				if (pinTemp.length == 4 && pinTemp != userKey) { //密码输入错误
					clearLockKey();
					getID("prompt").innerHTML = "Please try again";
				}
			} else if (indexArea == "alter") { //修改密码
				if (_num == 11) { //清除
					clearLockKey();
				} else if (pinTemp.length < 4) { //不到4位就可以输入
					pinTemp += _num;
					getID("lockKey" + pinTemp.length).innerText = "*";
				}
				if (pinTemp.length == 4) { //密码输入4位了
					pinTemp1 = pinTemp;
					clearLockKey();
					indexArea = "alter2";
					getID("prompt").innerText = "Enter new key again";
				}
			} else if (indexArea == "alter2") { //输入新密码
				if (_num == 11) { //清除
					clearLockKey();
				} else if (pinTemp.length < 4) { //不到4位就可以输入
					pinTemp += _num;
					getID("lockKey" + pinTemp.length).innerText = "*";
				}
				if (pinTemp.length == 4) { //密码输入4位了
					pinTemp2 = pinTemp;
					clearLockKey();
					if (pinTemp2 == pinTemp1) {
						getID("prompt").innerHTML = "Succeed ! <br>The new key is " + pinTemp2;
						getID("prompt").innerHTML += "<br/>";
						//	getID("prompt").innerHTML += "Use new key to unlock";
						indexArea = "lock";
						userKey = pinTemp2;
						if (typeof(window.androidJs) != "undefined") {
							window.androidJs.JsSetCookie("userKey", userKey, '1000d');
						}
					} else {
						getID("prompt").innerText = "Two key don't match";
					}
				}
			}
		}

		var total = 0;
		function startCircle(){
		    var minute = 0;
		    var second = 10;
		    total = (parseInt(minute)*60) + parseInt(second);
			var circle = getID("cls");
		//    circle.style.strokeDashoffset = "800";
		    circle.style.animationDuration = total+"s";
		    circle.style.animationPlayState = "running";
		//    set(1000*total);
		    circle.classList.add("run-anim");
		}

		var splashArr = ['splash0.gif','splash1.gif','splash2.gif','splash3.gif','splash4.gif','splash5.gif','splash6.gif','splash7.gif','splash8.gif','splash9.gif','splash10.gif','splash11.gif','splash12.gif','splash13.gif','splash14.gif','splash15.gif','splash16.gif','splash17.gif','splash18.gif','splash19.gif','splash20.gif','splash21.gif','splash22.gif','splash23.gif','splash24.gif','splash25.gif','splash26.gif','splash27.gif','splash28.gif','splash29.gif','splash30.gif','splash31.gif','splash32.gif','splash33.gif','splash34.gif','splash35.gif','splash.png','splash.jpg'];
		var splashIndex = window.androidJs.JsGetCookie("splashIndex",0)?window.androidJs.JsGetCookie("splashIndex",0):0;
		splashIndex ++;
		if( splashIndex > splashArr.length-1 ){
			splashIndex = 0;
		}
		window.androidJs.JsSetCookie("splashIndex", splashIndex, '12h');
		function init() {
			stbInfo();
			var clientWidth = document.body.scrollWidth;
			var clientHeight = window.innerHeight;
			vodImgHeight = clientWidth * 9 / 16 + "px";
			getID('bodys').style.width = clientWidth + "px"; //全局宽
			getID("splash").style.height = clientHeight + "px"; 
			getID("splash").style.backgroundImage = 'url(./splash/'+splashArr[splashIndex]+')';
			startCircle();//右上角跳过圆圈
			getID("vodNav").style.top = (clientHeight - 90) + "px"; //底部导航栏
			getID("lock").style.height = clientHeight + "px"; //解锁页面的高，即全屏高度
			getID("cardKey").style.height = clientHeight + "px"; //注册VIP卡页面的高	
			scrollDisable();
			getTagData(0, 1, 10, "mobile"); //预加载	
			bindEvent();
			showTagNav(); //动态显示下方分类导航
			//	alert('网页可见区域宽：'+document.body.clientWidth+'\n网页可见区域高：'+document.body.clientHeight+'\n网页可见区域宽：'+document.body.offsetWidth+ '\n网页可见区域高：'+document.body.offsetHeight+ '\n网页正文全文宽：'+document.body.scrollWidth+ '\n网页正文全文高：'+document.body.scrollHeight+ '\n网页被卷去的高：'+document.body.scrollTop+ '\n网页被卷去的左：'+document.body.scrollLeft+'\n网页正文部分上：'+window.screenTop+ '\n网页正文部分左：'+window.screenLeft+ '\n屏幕分辨率的高：'+window.screen.height+ '\n屏幕分辨率的宽：'+window.screen.width+ '\n屏幕可用工作区高度：'+window.screen.availHeight+'\n屏幕可用工作区宽度：'+window.screen.availWidth+'\nwindow.innerHeight：'+window.innerHeight);

		}
	</script>
</head>

<body bgcolor="black" leftmargin="0" topmargin="0" onload="init();" onScroll="moveVideoWindow();">
	<div id="bodys" style="position:absolute;top:0px;left:0px;width:100%;display:block;">
		<div id="test" style="position:fixed;top:1000px;left:0px;width:100%;height:200px;z-index:20;background-color:white;font-size:100px;display:none;"></div>
		<!-- 分类导航栏 -->
		<div id="vodNav" style="position:fixed;top:0px;left:0px;width:100%;height:90px;line-height:90px;z-index:2;">
			<ul id="vodNavList" class="tab-head">
				<li class="tab-head-item" id="nav-1" onClick="showLiveList();">直播</li>
				<li class="tab-head-item" id="nav0" onClick="changeTagList(0);"></li>
				<li class="tab-head-item" id="nav1" onClick="changeTagList(1);"></li>
				<li class="tab-head-item" id="nav2" onClick="changeTagList(2);"></li>
				<li class="tab-head-item" id="nav3" onClick="changeTagList(3);"></li>
				<li class="tab-head-item" id="nav4" onClick="changeTagList(4);"></li>
				<li class="tab-head-item" id="nav5" onClick="changeTagList(5);"></li>
				<li class="tab-head-item" id="nav6" onClick="changeTagList(6);"></li>
				<li class="tab-head-item" id="nav7" onClick="changeTagList(7);"></li>
				<li class="tab-head-item" id="nav8" onClick="changeTagList(8);"></li>
				<li class="tab-head-item" id="nav9" onClick="changeTagList(9);"></li>
				<li class="tab-head-item" id="nav10" onClick="changeTagList(10);"></li>
				<li class="tab-head-item" id="nav11" onClick="changeTagList(11);"></li>
				<li class="tab-head-item" id="nav12" onClick="changeTagList(12);"></li>
				<li class="tab-head-item" id="nav13" onClick="changeTagList(13);"></li>
				<li class="tab-head-item" id="nav14" onClick="changeTagList(14);"></li>
				<li class="tab-head-item" id="nav15" onClick="changeTagList(15);"></li>
				<li class="tab-head-item" id="nav16" onClick="changeTagList(16);"></li>
				<li class="tab-head-item" id="nav17" onClick="changeTagList(17);"></li>
				<li class="tab-head-item" id="nav18" onClick="changeTagList(18);"></li>
				<li class="tab-head-item" id="nav19" onClick="changeTagList(19);"></li>
				<li class="tab-head-item" id="nav20" onClick="changeTagList(20);"></li>
				<li class="tab-head-item" onClick="showMe();" style="color:#FF8C00;text-shadow:-2px 5px 5px gray;line-height:80px;font-size:75px;">VIP&ensp;</li>
			</ul>
		</div>

		<!-- 直播频道列表 -->
		<div id="channel" style="position:absolute;top:0px;left:0px;width:100%;display:none;">
			<!-- 频道组 -->
			<div id="group" style="position:fixed;top:0px;left:0px;width:100%; height:90px;line-height:90px;z-index:2; border-bottom:1px gray solid;">
				<ul id="groups" class="tab-head">
					<!--li class="tab-head-item" id="group0" onClick="showVodList(0);"></li>
				<li class="tab-head-item" id="group1" onClick="showVodList(1);"></li>
				<li class="tab-head-item" id="group2" onClick="showVodList(2);"></li-->
				</ul>
				<!--span style="position:absolute;left:0px;width:50%;text-align:center;" onClick="showChannel(-1);"><<<<<<</span>&emsp;
			<span id="groupName">所有频道</span>&emsp;
			<span style="position:absolute;right:0px;width:50%;text-align:center;" onClick="showChannel(1);">>>>>>></span-->
			</div>

			<!-- 频道列表 -->
			<div id="channels" class="channels" style="position:absolute;left:0px;top:100px;">
				<!--div id="channels0" class="channels" onClick="startLive(5);" >
				<div id="channelId0" class="channelID"></div>
				<div id="channel0" class="channel"></div>
			</div-->

			</div>
		</div>

		<!-- 点播列表 -->
		<div id="vodList" style="position:absolute;top:0px;left:0px;width:100%;display:none;">
			<div id="vodListContent">
				<!--div id="vodListImg0" class="vodListImg" onClick="playVod(0);" ></div>
		<div id="vodListName0" class="vodListName"></div>
		
		<div id="vodListImg1" class="vodListImg" onClick="playVod(1);"></div>
		<div id="vodListName1" class="vodListName"></div>
		
		<div id="vodListImg2" class="vodListImg" onClick="playVod(2);"></div>
		<div id="vodListName2" class="vodListName"></div>
		
		<div id="vodListImg3" class="vodListImg" onClick="playVod(3);"></div>
		<div id="vodListName3" class="vodListName"></div>
		
		<div id="vodListImg4" class="vodListImg" onClick="playVod(4);"></div>
		<div id="vodListName4" class="vodListName"></div>
		
		<div id="vodListImg5" class="vodListImg" onClick="playVod(5);"></div>
		<div id="vodListName5" class="vodListName"></div>
		
		<div id="vodListImg6" class="vodListImg" onClick="playVod(6);"></div>
		<div id="vodListName6" class="vodListName"></div>
		
		<div id="vodListImg7" class="vodListImg" onClick="playVod(7);"></div>
		<div id="vodListName7" class="vodListName"></div>
		
		<div id="vodListImg8" class="vodListImg" onClick="playVod(8);"></div>
		<div id="vodListName8" class="vodListName"></div>
		
		<div id="vodListImg9" class="vodListImg" onClick="playVod(9);"></div>
		<div id="vodListName9" class="vodListName"></div-->
			</div>
			<!--div id="vodNextPage" class="vodListName" style="color:gray;">
			<span onClick="changePage(-1);" >Pre</span>&emsp;&emsp;&emsp;&emsp;
			<span onClick="changePage(1);" >Next</span>
		</div-->
			<div id="loadmore" class="vodListName" style="height:200px;"></div><br><br>
		</div>

		<!-- 解锁界面 -->
		<div id="lock" style="position:absolute;top:0px;left:0px;width:100%;height:0px;background-color:#39C5BB;display:none;text-align:center;font-size:80px;color:white; z-index:9;background:linear-gradient(to bottom,red,deeppink,orange,yellow,green,blue,indigo,violet);">
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

	</div>

</body>
</html>