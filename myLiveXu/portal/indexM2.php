<script type=text/javascript src="js/global.js" charset=UTF-8></script>
<script type=text/javascript src="js/init2.js"></script>
<script type=text/javascript src="js/register2.js"></script>
<script type=text/javascript src="js/touchMove2.js" charset=UTF-8></script>
<script type=text/javascript src="../jquery-1.11.0.min.js" charset=UTF-8></script>
<script type=text/javascript src="js/zhiBo.js" charset=UTF-8></script>
<script type=text/javascript src="js/zhiBoArr.js" charset=UTF-8></script>

<?php
include_once "readSplash.php";
include_once "../connectMysql.php";
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

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8">
	<!-- <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />-->
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="0" />
	<title>mLive</title>
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

		var imgHeight = "280px"; //图片高度，会在init内根据屏幕宽按16:9重新计算
		var indexArea = "home";
		var navPos = 0; //当前分类 0为home 1为movie -1为直播

		function androidBack(){	//供返回键调用
			window.androidJs.JsClosePlayer();
			if( indexArea == "zhiBo"){
				if( isZhiBo ){	//先退出播放窗口
					isZhiBo = false;
					window.androidJs.JsSetPageArea("zhiBo");
				}else{	//再退出直播界面
					getID("zhiBo").style.display = "none";
					indexArea = "home";
					showTabList1(0);
					scrollTo(0,0);
				}
			}
		}
	
		//	显示分类列表
		var tag1 = 0;	//一级分类，即电影 电视剧……
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

		function rePlay(){
			window.androidJs.JsPlayVod(playUrls);
		}

		function showTabList1(_tag1){	//点击一级分类
			getID("zhiBo").style.display = "block";
			getID("zhiBoContent").innerHTML = "";
			if( pageZhiBo*10 > zhiBoArr.length-11 ){	//上次在最后一页，则显示第1页
				pageZhiBo = 0;
			}
			showZhiBoList(0);
			scrollTo(0,0);
			return;
		}
		
		st2 = setTimeout(function(){ }, 1000);	//防止scrollWindow第一次执行找不到st2
		function scrollWindow(){
			clearTimeout(st2);
			changeZhiBo();		
			st2 = setTimeout(function() {
				scrollTo(0,zhiBoPos*clientHeight);
				if( zhiBoPos%10 >7 && changePageStatus == "t" ){
					showZhiBoList(1);
				}
			}, 50);	//0.05秒后将当前窗口的top放到屏幕顶端
		}

		function loadMore() { //加载下一页
			var loadMoreBottom = $(document).height() - document.body.scrollTop - $(window).height();			
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
		//	scrollDisable();		//禁止页面滚动	
			bindEvent();		//绑定滑动事件
			clientWidth = document.body.scrollWidth;
			clientHeight = window.innerHeight;			
			getID('bodys').style.width = clientWidth + "px"; //全局宽
		//	showSplash();		//显示第二个启动图片
			showTabList1(6);
		}
	</script>
</head>

<body bgcolor="black" leftmargin="0" topmargin="0" onload="init();"  onScroll="scrollWindow();">
<div id="bodys" style="position:absolute;top:0px;left:0px;width:100%;display:block;">
	<div id="test" style="position:fixed;top:100px;left:0px;width:100%;max-height:900px;overflow:auto;line-height:100px;z-index:9999;background-color:white;font-size:100px;color:red;display:none;"></div>

	<!-- 主播 -->
	<div id="zhiBo" style="background-color:black;display:none;z-index:2;">	
		<div style="position:fixed;left:0px;top:0px;width:100%;height:2000px;background:url(./img/loading.gif);background-size:100% 100%;z-index:2;"></div>
		<div id="zhiBoContent"></div>
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

<script type=text/javascript src="js/detail.js" charset=UTF-8></script>