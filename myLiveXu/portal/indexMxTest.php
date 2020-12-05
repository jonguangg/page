<?php
	error_reporting(0);// 关闭所有PHP错误报告
	set_time_limit(0); //限制页面执行时间,0为不限制
	date_default_timezone_set('PRC');
	include_once "../connectMysql.php";
//	include_once "../readChannelArray.php";
//	include_once "readSplash.php";
	include_once "getXuDataHome.php";	//获取许首页数据

	function getIP(){	//获取用户真实 IP
		static $realip;
		if(isset($_SERVER)){
			if (isset($_SERVER["HTTP_X_FORWARDED_FOR"])) {
				$realip = $_SERVER["HTTP_X_FORWARDED_FOR"];
			} else if (isset($_SERVER["HTTP_CLIENT_IP"])) {
				$realip = $_SERVER["HTTP_CLIENT_IP"];
			} else {
				$realip = $_SERVER["REMOTE_ADDR"];
			}
		}else{
			if (getenv("HTTP_X_FORWARDED_FOR")) {
				$realip = getenv("HTTP_X_FORWARDED_FOR");
			} else if (getenv("HTTP_CLIENT_IP")) {
				$realip = getenv("HTTP_CLIENT_IP");
			} else {
				$realip = getenv("REMOTE_ADDR");
			}
		}
		if( strpos($realip,",")>0 ){//有两个IP
			$douHaoPos = strpos($realip,",");
			$realip = substr($realip,0,$douHaoPos);
		}
		setcookie("ip", $realip, time()+1*3600,"/"); //cookie存1小时
		return $realip;
	}

	function getCity(){		// 获取当前IP所在城市
		$tpyApi = "http://whois.pconline.com.cn/ip.jsp?ip=".getIP();
		$city = file_get_contents($tpyApi);
		$city = iconv('GBK', 'UTF-8', $city);
		$city = trim($city);
		setcookie("city",$city,time()+1*3600,"/");//cookie存1小时
	//	echo '<script>alert("City_'.$city.'")</script>';	
		return $city;
	}
	$ip = ($_COOKIE["ip"])?$_COOKIE["ip"]:getIP();
	$city = ($_COOKIE["city"])?$_COOKIE["city"]:getCity();

//	echo '<script>alert("'.$ip.'\n'.$city.'")</script>';
	$sn = $_COOKIE["sn"];//$_POST['imOnLineSN'];		//$_COOKIE["sn"];
	$mark = $_COOKIE["deviceInfo"];						//机顶盒备注
	$loginTime = date("Y-m-d"); 						//机顶盒打开APP的日期
	$intLloginTime = str_replace("-", "", $loginTime);	//为了便于比大小将时间内的-删掉
	$expireTime = date("Y-m-d", strtotime("+6 day")); 	//初次安装的授权到期时间
	$hiddenTime = ($_COOKIE["hiddenTime"])?$_COOKIE["hiddenTime"]:0;	// 切到后台的时间点
	$visibilityTime = time();							//此次打开的时间戳，精确到秒
	$lastTime = date("Y-m-d H:i:s"); 					//此次打开APP的时分秒
	$isOnLine = "在线";									//每次进入应用都激活在线状态
	$sql = mysqli_query($connect, "select * from client where sn='$sn' ") or die(mysqli_error($connect));

	if( mysqli_num_rows($sql) > 0 ){ //如果数据库中有当前机顶盒
	//	echo '<script>alert("'.((int)$visibilityTime-(int)$hiddenTime).'")</script>';
		if( (int)$visibilityTime-(int)$hiddenTime > 60 ){
			$sql = mysqli_query($connect, "UPDATE client set isOnLine='$isOnLine',ip='$ip',city='$city',lastTime='$lastTime' where sn='$sn' ") or die(mysqli_error($connect));	 //更新在线状态		
			$sql2 = mysqli_query($connect, "INSERT INTO login SET sn='$sn',ip='$ip',city='$city' ") or die(mysqli_error($connect)); 	//记录登陆时间
		}
	}else if( $sn!= "null" && $sn!= null && strlen($sn)>0 ) { //如果数据库中没有当前机顶盒，且当前机顶盒有SN
		$sql = mysqli_query($connect, "replace into client(sn,mark,ip,city,loginTime,expireTime,lastTime,isOnLine) values ('$sn','$mark','$ip','$city','$loginTime','$expireTime','$lastTime','$isOnLine')") or die(mysqli_error($connect));
	}
?>
<!--<script-- type="text/javascript" src="js/fingerprint2.js"></script-->
<script type="text/javascript" src="../jquery-1.11.0.min.js" charset=UTF-8></script>
<script type="text/javascript" src="js/initXu.js?v=4" charset=UTF-8></script>
<script type="text/javascript" src="js/registerXu.js?v=4" charset=UTF-8></script>
<script type="text/javascript" src="js/getXuDataToJs.js?v=1" charset=UTF-8></script>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>MixTVTest</title>
	<meta http-equiv="content-Type" content="text/html; charset=UTF-8">
	<meta name="apple-mobile-web-app-capable" content="yes"><!--iphone设备中的safari私有meta标签：全屏模式浏览 -->
	<meta name="apple-mobile-web-app-title" content="MixTV"><!-- 添加到主屏后默认的命名 -->
	<link rel="apple-touch-icon"  sizes="72x72"  href="./img/ic_launcher.png"><!-- 添加到主屏后的图标 -->
	<link rel="shortcut icon" href="./img/ic_launcher.png" type="image/x-icon"> <!-- 网页收藏夹图标 -->

	<!-- ios使用一个初始化图片来替代白色的浏览器屏幕-->
	<!-- iPhone 6/7/8 	Portrait -->
	<link rel="apple-touch-startup-image" href="./splash/750×1334.png" media="(device-width: 375px) and (device-height: 667px)" >
	<!-- iPhone 6Plus/7Plus/8Plus	Portrait -->
	<link rel="apple-touch-startup-image" href="./splash/1242x2208.png" media="(device-width: 414px) and (device-height: 736px)" >
	<!-- iPhone XR/11/11ProMax	Portrait -->
	<link rel="apple-touch-startup-image" href="./splash/828×1792.png" media="(device-width: 414px) and (device-height: 896px)" >
	<!-- iPhone X/Xs/11Pro	Portrait -->
	<link rel="apple-touch-startup-image" href="./splash/1125x2436.png" media="(device-width: 375px) and (device-height: 812px)" >
	<!-- iPhone XsMax	Portrait -->
	<link rel="apple-touch-startup-image" href="./splash/1242×2688.png" media="(device-width: 736px) and (device-height: 1344px)" >

	<link rel="stylesheet" type="text/css" href="styleXu.css?v=6" >
	<link rel="stylesheet" type="text/css" href="circle/css/style.css" />
	<link rel="stylesheet" type="text/css" href="circle/css/normalize.css" />
</head>
<script>
	var intLoginTime = <?php echo $intLloginTime ?>; //应用登陆时间，其实这个没必要去后台获取，只要取当前时间即可
	var channelDataArr = <?php echo json_encode($channelArr); ?>;
	
	var homeLoopArr = <?php echo json_encode($homeLoopArr); ?>;
	var homeZoneArr = <?php echo json_encode($homeZoneArr); ?>;
	var homeRecommendArr = <?php echo json_encode($homeRecommendArr); ?>;
	var hotArr = <?php echo json_encode($hotArr); ?>;
	var newArr = <?php echo json_encode($newArr); ?>;
	var highScoreArr = <?php echo json_encode($highScoreArr); ?>;
	var homeBottomZoneArr = <?php echo json_encode($homeBottomZoneArr); ?>;
	var hotSearchArr = <?php echo json_encode($hotSearchArr); ?>;

//	console.log(homeZoneArr);

	var userKey = (typeof(window.androidJs) != "undefined") ? window.androidJs.JsGetCookie("userKey", 0) : "9527";
	if (parseInt(userKey) == 0) { //没设置密码时获取到的密码为0，所以要改一下
		userKey = "9527";
	}
/*	var groupId = (typeof(window.androidJs) != "undefined") ? parseInt(window.androidJs.JsGetCookie("groupId", 0)) : 0;
	var channelPagePos = (typeof(window.androidJs) != "undefined") ? parseInt(window.androidJs.JsGetCookie("channelPagePos", 0)) : 0;
	var channelPos = (typeof(window.androidJs) != "undefined") ? parseInt(window.androidJs.JsGetCookie("channelPos", 0)) : 0;
	var channelCount = 0;
	var channelPageAll = parseInt((channelCount - 1 + 10) / 10);
	var channelArr = [];
	var videoUrlCookie = 0;

	for (i = 0; i < channelDataArr.length; i++) { //合并所有频道为一个数组，便于显示所有频道和跳转
		channelArr = channelArr.concat(channelDataArr[i].channel);
	}

	var channelTempArr = []; //当前显示的频道组 
	var groupSizeArr = []; //每个组的节目数  
	for (i = 0; i < channelDataArr.length; i++) {	//每个直播组的内容数量
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
	var tempTab1 = 0;
	function showLiveList(_num) {	//显示直播列表
		from = indexArea;
		tempTab1 = tab1;
		for (i = 0; i < channelDataArr.length; i++) { //显示频道组
			getID("groups").innerHTML += '<li class=tab-live-item id=group' + i + ' onClick=showChannel(' + i + ');>'+channelDataArr[i].group+'</li>';
		//	getID("group" + i).innerHTML = channelDataArr[i].group;
		}
		channelPos = (groupId == _num)?channelPos:0;	//如果回上次看的组，则不变频道，否则播放第1个
		tab1 = -1;	//当前区域定为直播
		groupId = _num;
		showChannel(groupId); 
		getID("vod").style.display = "none";
		getID("searchHistoryCollect").style.display = "none";	//	隐藏搜索 历史 收藏 海报列表
		getID("channel").style.display = "block";
		getID("channel" + channelPos).style.color = "#f7a333";
		getID("channelId" + channelPos).style.color = "#f7a333";

	//	getID("liveVideoDiv").style.height = (clientWidth * 9 / 16 - 1) + "px";	//视频窗口
		getID('liveVideo').height = (window.orientation==0)?clientWidth*9/16:clientWidth-120;
		getID("group").style.top = (window.orientation==0)?(clientWidth * 9 / 16 - 1)+"px":(clientWidth-120)+"px";//频道组
		getID("channels").style.top = (clientWidth * 9 / 16 + 90) + "px";		 //频道列表	
		getID("channels").style.height = (clientHeight-clientWidth*9/16-90)+"px";	

		if (typeof(window.androidJs) != "undefined") {
			window.androidJs.JsPlayLive(channelTempArr[channelPos].videoUrl);
			window.androidJs.JsSetPageArea("live");
		}else{
			getID("liveVideo").src = channelTempArr[channelPos].videoUrl;			
			getID("liveVideo").addEventListener("play",function(){
				
			},false);
		}		
		groupScrollL = (groupId - 1) * 150;//大概两个汉字150，4个汉字300
		getID("groups").scrollLeft = groupScrollL;
		indexArea = "live";
	}

	function startLive(_num) {	//播放直播频道
		if (parseInt(intLoginTime) > parseInt(intExpireTime)) { //授权已过期
			scrollTo(0, 0);
			registedVipCard();
			return;
		}
		getID("channel" + channelPos).style.color = "white";
		getID("channelId" + channelPos).style.color = "white";
		channelPos = _num;
		getID("channel" + channelPos).style.color = "#f7a333";
		getID("channelId" + channelPos).style.color = "#f7a333";
		updateCookie();
		if (typeof(window.androidJs) != "undefined") {
			window.androidJs.JsPlayLive(channelTempArr[_num].videoUrl);
		}else{
			getID("liveVideo").src = channelTempArr[_num].videoUrl;
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
		getID("channel").style.left = "0px";
		getID("channels").innerHTML = "";
		getID("channels").scrollTop = 0;
		for (i = 0; i < channelTempArr.length; i++) {
			getID("channels").innerHTML += '<div id=channels' + i + ' class="channels" ><div id=channelId' + i + ' class="channelID" ><img class="liveListImg" src=live/'+channelTempArr[i].channelLogo+' /><div class="liveLine" ></div></div><div id=channel' + i + ' class="channel" onClick=startLive(' + i + ')></div></div>';
			getID('channel' + i).innerText = channelTempArr[i].name.slice(0, 50);
		}
	}
*/
	var scrollTops = 0;
	var imgHeight = "280px"; //图片高度，会根据屏幕宽按16:9重新计算
	var indexArea = "home";
//	var navPos = 0; //当前分类 0为home 1为movie -1为直播
	var currentTime = 0;   //播放位置 单位秒
	var isNext = true;		//是否可以播放下一集
	function playVod(_id,_playUrl,_father,_poster,_episodePos,_episodes) {
	//	var playUrl = _playUrl.replace("128.1.160.114","mixtvapi.mixtvapp.com");
		if (typeof(window.androidJs) != "undefined") {
			window.androidJs.JsClosePlayer();
			window.androidJs.JsSetPageArea("vod");
			if( episodePos==_episodePos ){	//播上次那集，就从上次位置继续播，否则换集了，就从头播
				window.androidJs.JsLastPosition(parseInt(currentTime));
			}else{
				window.androidJs.JsLastPosition(0);
			}
			window.androidJs.JsPlayVod(_playUrl);
			getID("speeds").style.opacity = 0;
			getID("fullscreens").style.opacity = 0;
		}else{
			getID("h5video").src = _playUrl;			
			if(isAndroid){
				getID("speeds").style.opacity =0;
			}else{
				getID("speeds").style.opacity = 1;
				getID("speedNum").innerHTML = speed;
			}
			getID("fullscreens").style.opacity = (isAndroid)?1:0;
			document.title = _father;
			//监听播放结束
			getID("h5video").addEventListener('ended',function(){				
				if( _episodePos<_episodes-1 && isNext){//自动播放下一集
					playVod( id,list[parseInt(episodePos)+1].videoPath,father,poster,(parseInt(episodePos)+1),episodes );
					isNext = false;
					setTimeout(function(){isNext = true;},60000);	//防止连续播放下一集
				}
			});
			//使用事件监听方式捕捉事件， 此事件可作为实时监测video播放状态
			getID("h5video").addEventListener("timeupdate",function(){
				var timeDisplay = Math.floor(getID("h5video").currentTime);
				if( timeDisplay == 1 ){
					if( currentTime>5 ){ 
						getID("h5video").currentTime = currentTime-5;	//从上次离开时前5秒开始播放
					}
					getID("h5video").playbackRate = speed;				//用上次使用的速度播放
				}
			},false);
		}
		$.ajax({
			type: 'POST',
			url: './playVodXu.php',	//写当前的播放记录
			data: {
				'sn':sn,
				'id':_id,
				'father':_father,
				'poster':_poster,
				'episodePos':_episodePos,
				'currentTime':currentTime
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
		if( _episodes>1 ){	//多集的才需定位当前集
			getID('chooseChapter'+episodePos).style.backgroundColor = "snow";
			episodePos = _episodePos;
			getID('chooseChapter'+episodePos).style.backgroundColor = "#ff9933";			
			getID("chooseChapterNum").scrollLeft = ( (episodePos-3)>0 )?(episodePos-3)*126:0;	
			document.title = _father+"(第"+(parseInt(episodePos)+1)+"集)";
		}
		if (parseInt(intLoginTime) > parseInt(intExpireTime)) { //授权已过期
			scrollTo(0, 0);
			registedVipCard();
			indexArea = "detail";
		}
	}

	//	显示海报列表
	var tab1 = 0;	//一级分类，即电影 电视剧……
	var tab2 = 0;	//二级分类，即地区
	var tab3 = 0;	//三级分类，即爱情、动作、喜剧之类的分类标签
	var pageNow = 1; //第一页是1
	var pageNow1=0, pageNow2=0, pageNow3=0, pageNow4=0, pageNow5=0, pageNow6=0, pageNow7=0, pageNow8=0, pageNow9=0, pageNow10=0, pageNow11=0, pageNow12=0, vodPageAll = 1, vodPageAll1 = 1, vodPageAll2 = 1, vodPageAll3 = 1, vodPageAll4 = 1, vodPageAll5 = 1, vodPageAll6 = 1, vodPageAll7 = 1, vodPageAll8 = 1, vodPageAll9 = 1, vodPageAll10 = 1, vodPageAll11 = 1, vodPageAll12 = 1 ;
	var changePageStatus = "f"; //；加载状态，f为未完成，此时不加载下一页

	function getXuList(_tab1, _tab2,_tab3,_pageNow, _pageSize) {
		pageNow = eval("pageNow"+tab1)+1; //当前请求页码为已显示页面+1，即下一页
		if( eval("vodPageAll"+tab1)==eval("pageNow"+tab1) ){	//如果总页数 == 已显示的页码，则不再请求
			pageNow = eval("vodPageAll"+tab1);
		//	alert("没有了");
			return;
		}
		$.ajax({
			type: 'POST',
			url: './getXuDataList.php',
			data: {
				'channelId': tab1Arr["data"][_tab1].channelId,
				'tab2': ( _tab2==0 || !tab2Arr[_tab1][_tab2-1] )?"":tab2Arr[_tab1][_tab2-1]["name"],
				'tab3': ( _tab3==0 || !tab3Arr[_tab1][_tab3-1] )?"":tab3Arr[_tab1][_tab3-1]["name"],
				'pageNow': pageNow,
				'pageSize': 12
			},
			dataType: 'json',
			beforeSend: function() {
				//这里一般显示加载提示;
			},
			success: function(json) {
				eval("pageNow"+tab1+"="+pageNow);	//请求成功才更新当前页码
				eval("vodPageAll"+tab1+"="+json.pages);	//请求成功才更新总页数
				vodPageAll = json.pages;
			//	alert("当前页："+eval("pageNow"+tab1));
				if( vodPageAll == 0 || pageNow == vodPageAll || pageNow > vodPageAll){	//打开这段就直接显示no more，否则需上拉一下			
					getID("loadmore"+tab1).innerHTML = "•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;&nbsp;no more&nbsp;&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•";
					getID("loading"+tab1).style.display = "none";
					eval("pageNow"+tab1+"="+vodPageAll);
				}else{
					getID("loadmore"+tab1).innerHTML = "";
					getID("loading"+tab1).style.display = "block";
				}
				var list = json.records;
				$.each(list,
					function(index, array) { //遍历json数据列
						var id = array["id"];
						var name = array['videoName'];
						var poster = array['imgUrl'];
						if( name.length > 6){
							name = '<marquee behavior="scroll" direction="left" width="100%" scrollamonut="100" scrolldelay="100">'+name +'</marquee>';
						}
						var score = (array["imdbScore"]==undefined)?"":array["imdbScore"];
						var scoreBg = (array["imdbScore"]==undefined)?"img/null.png":"img/scoreBg.png";
						getID("vodListContent"+_tab1).innerHTML += '<div class="listImg" style="background: url('+poster+')" onClick=getID("h5video").muted=false;showDetail('+'"'+id+'"'+'); ><div class="tab-score" style="background-image:url('+scoreBg+')">'+score+'</div><div class="listName">'+name+'</div></div>';
					});	
				setTimeout(function() {
					changePageStatus = "t";
				}, 1000); // 加载完成后才将状态改为true
			},
			error: function() {
			//	alert("something error");
			}
		});
	}

	function changePage(_num) { //VOD列表换页
		pageNow += _num;
		if (pageNow > vodPageAll || pageNow < 1) {
			pageNow = vodPageAll;
		}
		if( indexArea == "search" || indexArea == "history" ||indexArea == "collect" ){
			showSHC(indexArea,pageNow,searchTemp);
		}else{
			getXuList(tab1,tab2,tab3,pageNow, 12);
		}
	}

	function loadMore() { //加载下一页
		var loadMoreBottom = $(document).height() - document.body.scrollTop - $(window).height();
		if (loadMoreBottom < 3000 && pageNow < vodPageAll && tab1 > -20 && changePageStatus == "t") { //loadMoreBottom数字越大，就越早加载下一页
			changePage(1);
			changePageStatus = "f"; //运行一次加载后马上将状态置为假，不允许继续加载，防止滑动屏幕时多次运行changePage(1);
		}			
		if( vodPageAll == 0 || pageNow == vodPageAll ){		
			if( indexArea=="vod" ){
				getID("loadmore"+tab1).innerHTML = "•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;&nbsp;no more&nbsp;&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•";
				getID("loading"+tab1).style.display = "none";
			}else{
				getID("loadmoreSHC").innerHTML = "•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;no more&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•";
				getID("loadingSHC").style.display = "none";
			}
		}
	}	

	var homeLoopIndex = 0;
	var	homeLoopLength = homeLoopArr.length;
	function showHomeLoop(){
		for(i=0;i<homeLoopLength-1;i++){
			getID("homeLoopDiv").innerHTML += '<div class="homeLoopImg" style="background:url('+homeLoopArr[i].imgUrl+');"><div class="homeLoopTitle" >'+homeLoopArr[i].title+'</div></div>';
			getID("homeLoopCircle").innerHTML += '<div id=homeLoopCircle'+i+' class="homeLoopCircle"></div>';
		}
		getID("homeLoopCircle0").style.backgroundColor = "#ff9933";
	}
	function showHomeLoopDetail(){
		if( homeLoopArr[homeLoopIndex%homeLoopLength].type==0){
			showDetail(homeLoopArr[homeLoopIndex%homeLoopLength].videoId);
		}else{
			showZoneList(homeLoopArr[homeLoopIndex%homeLoopLength].columnId);
		}
	}	

	var homeLoopDivLeft = 0 ;
	var homeLoopMove = 1;	//1向左移，-1向右移
	function moveHomeLoop(_num){
		getID("homeLoopCircle"+homeLoopIndex).style.backgroundColor = "white";
		homeLoopIndex += _num;	//第几个图片
		homeLoopMove = _num;	//向左或向右，默认1左，-1向右
		if( homeLoopIndex < 0 ){	//如果当前在第1个图片，则转为向左滑
			homeLoopMove = 1;
			homeLoopIndex ++;
		}else if( homeLoopIndex > homeLoopLength-2 ){	//如果当前在最后一个图片，则转为向右滑
			homeLoopMove = -1;
			homeLoopIndex --;
		}
		getID("homeLoopDiv").style.left = "-"+homeLoopIndex*100+"%";
		getID("homeLoopCircle"+homeLoopIndex).style.backgroundColor = "#ff9933";
		if( ifMoveLoop == false){			
			if( homeLoopMove==1){
				setTimeout(function(){moveHomeLoop(1);},5000);
			}else{
				setTimeout(function(){moveHomeLoop(-1);},5000);
			}
		}		
	}

	function showHomeZoneTop(){	//显示首页专栏入口
		var zoneLogoHeight = clientWidth*0.19;
		for(i=0;i<homeZoneArr.length;i++){
			getID('homeNavLive').innerHTML += '<div class="tab-homeLive-item" id=homeLiveGroup'+i+' onClick=showZoneList("'+homeZoneArr[i].columnId+'"); style="height:'+zoneLogoHeight+';background:url('+homeZoneArr[i].imgUrl+') no-repeat center"><div class="tab-homeLive-groupName" style="top:'+(zoneLogoHeight-10)+'px;">'+homeZoneArr[i].title+'</div></div>';
		}
	}

	function showHomeRecommend(){	//显示首页Mix推荐
		for(i=0;i<4;i++){
			getID("homeRecommendImg"+i).style.backgroundImage = 'url('+homeRecommendArr[i].imgUrl+')';
			getID("homeRecommendName"+i).innerText = homeRecommendArr[i].title;
			getID("homeRecommendNames"+i).innerText = homeRecommendArr[i].remark;
			var tempEpisode = "";
			if( homeRecommendArr[i].videoState ){
				if( homeRecommendArr[i].videoState=="已完结" ){
					tempEpisode = "全"+homeRecommendArr[i].episodes+"集";
				}else if( homeRecommendArr[i].videoState=="更新中" ){
					tempEpisode = "更新至"+homeRecommendArr[i].episodes+"集";
				}				
			}
			getID("homeRecommendEpisode"+i).innerText = tempEpisode;
		}
	}
	function showRecommendDetail(_recommendIndex){
		showDetail(homeRecommendArr[_recommendIndex].videoId);
	}

	var hotTemp = 0;
	function showHomeHot(_channelId){	//显示首页Hot榜
		getID("hot"+hotTemp).style.color = "white";
		hotTemp = _channelId;
		getID("hot"+hotTemp).style.color = "#ff9933";
		getID("hotContent").innerHTML = "";
		for(i=0;i<hotArr[hotTemp]["records"].length;i++){
			var hotScore = (hotArr[hotTemp]["records"][i].imdbScore==undefined)?"":hotArr[hotTemp]["records"][i].imdbScore;
			getID("hotContent").innerHTML += '<div class="tab-hot-item" onClick=getID("h5video").muted=false;showDetail("'+hotArr[hotTemp]["records"][i].id+'"); style="background:url('+hotArr[hotTemp]["records"][i].imgUrl+')"><div id=hotScore'+i+' class="tab-score" >'+hotScore+'</div><div class="tab-hotName">'+hotArr[hotTemp]["records"][i].videoName+'</div></div>';
			if(hotScore==""){
				getID("hotScore"+i).style.backgroundImage = "url(img/null.png)";
			}
		}
	}

	var newTemp = 0;
	function showHomeNew(_channelId){	//显示首页New榜
		getID("new"+newTemp).style.color = "white";
		newTemp = _channelId;
		getID("new"+newTemp).style.color = "#ff9933";
		getID("newContent").innerHTML = "";
		for(i=0;i<newArr[newTemp]["records"].length;i++){			
			var newScore = (newArr[newTemp]["records"][i].imdbScore==undefined)?"":newArr[newTemp]["records"][i].imdbScore;
			var scoreBg = (newArr[newTemp]["records"][i].imdbScore==undefined)?"img/null/png":"img/scoreBg.png";
			getID("newContent").innerHTML += '<div class="tab-hot-item" onClick=getID("h5video").muted=false;showDetail("'+newArr[newTemp]["records"][i].id+'"); style="background:url('+newArr[newTemp]["records"][i].imgUrl+')" ><div class="tab-score" style="background-image:url('+scoreBg+')" >'+newScore+'</div><div class="tab-hotName">'+newArr[newTemp]["records"][i].videoName+'</div></div>';
		}
	}

	function showHighScore(){	//显示首页近期高分口碑剧
		getID("highScoreContent").innerHTML = "";
		for(i=0;i<highScoreArr.length;i++){
			getID("highScoreContent").innerHTML += '<div class="tab-highScore-item" onClick=getID("h5video").muted=false;showDetail("'+highScoreArr[i].videoId+'"); style="background:url('+highScoreArr[i].imgUrl+') no-repeat;"></div><div class="tab-highScore-item2" onClick=getID("h5video").muted=false;showDetail("'+highScoreArr[i].videoId+'");><div class="tab-highScoreName" style="font-size:40px;line-height:80px;" >'+highScoreArr[i].videoName+'</div><div class="tab-highScoreName"><span style="color:#f7a333;">'+highScoreArr[i].imdbScore+'</span>&ensp;<span>'+highScoreArr[i].showRegion+'</span></div><div class="tab-highScoreName" >'+highScoreArr[i].videoTopic+'</div><div class="tab-highScoreName" style="color:gray" >'+highScoreArr[i].remark+'</div>	</div>';
		}
	}

	function showHomeBottomZone(){
		for(i=0;i<homeBottomZoneArr.length;i++){
			getID("vodList0").innerHTML += '<div class="homeList" style="width:96%;height:450px;top:0px;"><div><span style="position:relative;left:5%;background-color:#ff9933;" >&emsp;</span><span style="position:relative;overflow:hidden;left:6%;" onClick=showZoneList("'+homeBottomZoneArr[i].id+'")>'+homeBottomZoneArr[i].title+'</span><span style="position:relative;top:-100px;margin-left:95%;font-size:80px;" onClick=showZoneList("'+homeBottomZoneArr[i].id+'")> > </span></div>	<div style="position:relative;left:4%;top:-80px;"><ul id=bottomZontContent'+i+' class="tab-head"></ul></div></div>';
			for(j=0;j<homeBottomZoneArr[i].videoList.length;j++){			
				var score = (homeBottomZoneArr[i].videoList[j].imdbScore==undefined)?"":homeBottomZoneArr[i].videoList[j].imdbScore;
				var scoreBg = (homeBottomZoneArr[i].videoList[j].imdbScore==undefined)?"img/null.png":"img/scoreBg.png";
				var tempImg = (homeBottomZoneArr[i].videoList[j].imgUrl)?homeBottomZoneArr[i].videoList[j].imgUrl:homeBottomZoneArr[i].videoList[j].columnImgUrl;
				var tempName = (homeBottomZoneArr[i].videoList[j].videoName)?homeBottomZoneArr[i].videoList[j].videoName:homeBottomZoneArr[i].videoList[j].childColumnName;
				var tempId = (homeBottomZoneArr[i].videoList[j].videoId)?homeBottomZoneArr[i].videoList[j].videoId:homeBottomZoneArr[i].videoList[j].columnCid;
				var bottomTpye = (homeBottomZoneArr[i].videoList[j].videoId)?0:1;	//1是专栏，0是单片

				getID("bottomZontContent"+i).innerHTML += '<div class="tab-hot-item" onClick=getID("h5video").muted=false;showBottomDetail('+bottomTpye+',"'+tempId+'"); style="background:url('+tempImg+')"><div class="tab-score" style="background-image:url('+scoreBg+')">'+score+'</div><div class="tab-hotName">'+tempName+'</div></div>';
			}
		}
	}
	
	function showBottomDetail(_BottomType,_BottomId){
		if(_BottomType==0){
			showDetail( _BottomId );
		}else if(_BottomType==1){
			showZoneList( _BottomId );
		}
	}

	function showZoneList(_columnId){	//显示专栏
		getID("loading").style.display = "block";
		scrollTops = document.body.scrollTop;   //先记录滚动了多少，回到上一级页面再滚回去
		indexArea = "zone";
		getID("zoneContent").innerHTML = "";
	//	getID("zone").style.height = clientHeight+"px";
		$.ajax({
			type: 'POST',
			url: './getXuZone.php',
			data: {
				'columnId': _columnId
			},
			dataType: 'json',
			beforeSend: function() {
				//这里一般显示加载提示;
			},
			success: function(json) {
				getID("loading").style.display = "none";
				getID("vod").style.display = "none";
				getID("zone").style.display = "block";
				getID("zoneBg").style.backgroundImage = (json.backgroundImgUrl==null)?"url(img/null.png)":"url("+json.backgroundImgUrl+")";
				getID("zoneName").innerHTML = json.title;
				getID("zoneRemark").innerHTML = (json.remark==null)?"":json.remark;
				getID("zoneContent").style.height = (clientHeight-200-getID("zoneRemark").clientHeight)+"px";
				getID("zoneRemark").style.maxHeight = "250px";
				for(i=0;i<json.list.length;i++){
					if(json.list[i].videoName==undefined){	//有子专栏的，点击后显示子专栏
						getID("zoneContent").innerHTML += '<div style="margin-bottom:50px;width:100%;height:360px;float:left;" onclick=showZoneListC("'+json.list[i].columnCid+'")><div id=zoneContentImg'+i+' class="zoneImg" style="background:url('+json.list[i].columnImgUrl+');"></div><div id=zoneContentName'+i+' class="zoneText" style="color:#ff9933">'+json.list[i].childColumnName+'</div><div id=zoneContentRegion'+i+' class="zoneText2">'+json.list[i].remark+'</div></div>';

					}else{	//没子专栏的，点击后显示详情页
						var tempDuration = (json.list[i].videoType==2)?"时长："+json.list[i].videoLength+"分钟":"状态:"+json.list[i].videoState;
						getID("zoneContent").innerHTML += '<div style="margin-bottom:50px;width:100%;height:360px;float:left;" onclick=indexArea="zone";getID("zone").style.display="none";getID("h5video").muted=false;showDetail("'+json.list[i].videoId+'")><div id=zoneContentImg'+i+' class="zoneImg" style="background:url('+json.list[i].imgUrl+');"></div><div id=zoneContentName'+i+' class="zoneText" style="color:#ff9933">'+json.list[i].videoName+'</div><div id=zoneContentRegion'+i+' class="zoneText">'+json.list[i].showRegion+'</div><div id=zoneContentType'+i+' class="zoneText">'+json.list[i].videoTopic+'</div><div id=zoneContentDuration'+i+' class="zoneText">'+tempDuration+'</div></div>';
					}
				}
				if( isGuideZone==1 ){
					scrollDisable();
					getID("guide").style.display = "block";
					getID("redArrow").style.display = "block";
					getID("redArrow").style.left = clientWidth*0.5+"px";
					getID("zoneLogo").style.border = "5px red solid";
					getID("guideContent").innerHTML = (language=="c")?"<br>点击箭头指向的区域<br>离开当前页面<br>&ensp;":"<br>Leave current page<br>&ensp;";
				}
			},
			error: function() {
			//	alert("something error");
			}
		});
	}

	function showZoneListC(_columnId){	//显示子专栏
		getID("loading").style.display = "block";
		scrollTops = document.body.scrollTop;   //先记录滚动了多少，回到上一级页面再滚回去
		indexArea = "zoneC";
		getID("zoneContentC").innerHTML = "";
	//	getID("zoneC").style.height = (clientHeight-0)+"px";
		$.ajax({
			type: 'POST',
			url: './getXuZone.php',
			data: {
				'columnId': _columnId
			},
			dataType: 'json',
			beforeSend: function() {
				//这里一般显示加载提示;
			},
			success: function(json){
			//	console.log(json);
				getID("loading").style.display = "none";
				getID("zone").style.display = "none";
				getID("zoneC").style.display = "block";
				getID("zoneBgC").style.backgroundImage = (json.backgroundImgUrl==null)?"url(img/null.png)":"url("+json.backgroundImgUrl+")";
				getID("zoneNameC").innerHTML = json.title;
				getID("zoneRemarkC").innerHTML = (json.remark==null)?"":json.remark;
				getID("zoneContentC").style.height = (clientHeight-190-getID("zoneRemarkC").clientHeight)+"px";
				getID("zoneRemarkC").style.maxHeight = "250px";
				for(i=0;i<json.list.length;i++){
					if(json.list[i].videoName==undefined){	//有子专栏的，点击后显示子专栏
						getID("zoneContentC").innerHTML += '<div style="margin-bottom:50px;width:100%;height:360px;float:left;" onclick=getID("zone").style.display="none";showZoneListC("'+json.list[i].columnCid+'")><div id=zoneContentImgC'+i+' class="zoneImg" style="background:url('+json.list[i].columnImgUrl+');"></div><div id=zoneContentNameC'+i+' class="zoneText" style="color:#ff9933">'+json.list[i].childColumnName+'</div><div id=zoneContentRegionC'+i+' class="zoneText2">'+json.list[i].remark+'</div></div>';

					}else{	//没子专栏的，点击后显示详情页
						var tempDuration = (json.list[i].videoType==2)?"时长："+json.list[i].videoLength+"分钟":"状态:"+json.list[i].videoState;
						getID("zoneContentC").innerHTML += '<div style="margin-bottom:50px;width:100%;height:360px;float:left;" onclick=getID("zoneC").style.display="none";getID("h5video").muted=false;showDetail("'+json.list[i].videoId+'")><div id=zoneContentImgC'+i+' class="zoneImg" style="background:url('+json.list[i].imgUrl+');"></div><div id=zoneContentNameC'+i+' class="zoneText" style="color:#ff9933">'+json.list[i].videoName+'</div><div id=zoneContentRegionC'+i+' class="zoneText">'+json.list[i].showRegion+'</div><div id=zoneContentTypeC'+i+' class="zoneText">'+json.list[i].videoTopic+'</div><div id=zoneContentDurationC'+i+' class="zoneText">'+tempDuration+'</div></div>';
					}
				}				
			},
			error: function() {
			//	alert("something error");
			}
		});
	}

	function showTab1(){	//显示一级影视类型		
		for(i=1;i<tab1Arr["data"].length;i++){
		//	var channelNameTemp = tab1Arr["data"][i].channelName.replace("/","<br>");		//显示中英文	
			var channelNameTemp = tab1Arr["data"][i].channelName.slice( tab1Arr["data"][i].channelName.indexOf("/")+1 );		//只显示中文
			getID('vodTab1').innerHTML += '<li class="tab-tab1-item" id=nav'+i+' onClick="clickTab1('+i+')" >'+channelNameTemp+'</li>';
		}
		getID("nav0").style.color = "#ff9933";
	}

	function showTab2and3(_tab1){		//显示二三级分类
		tab2 = 0;
		getID('vodTabRegion').innerHTML = "";
		getID('vodTab3').innerHTML = "";

		if( tab2Arr[_tab1].length>0 ){	//如果有二级分类
			getID("vodTabRegion").style.height = "60px";
			getID("vodTabRegion").style.backgroundColor = "#212121";
			getID('vodTabRegion').innerHTML = '<li class="tab-tag2_3-item" id=region0 onClick="clickTab2(0)" >全部</li>';
			getID("region0").style.color = "#ff9933";
			for(i=0;i<tab2Arr[_tab1].length;i++){
				getID('vodTabRegion').innerHTML += '<li class="tab-tag2_3-item" id=region'+(i+1)+' onClick="clickTab2('+(i+1)+')" >'+tab2Arr[_tab1][i].name+'</li>';
			}
			getID("vodTabRegion").scrollLeft = 0;
			if( tab3Arr[_tab1].length>0 ){	//如果有三级分类
				getID("vodTab3").style.height = "60px";
				getID("vodTab3").style.backgroundColor = "#333333";
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

	stLoad = setTimeout(function(){ }, 1000);	//防止第一次执行找不到定时器
	function clickTab1(_tab1){	//点击一级分类
		scrollTo(0, 0); 
		indexArea = "vod";
		getID("vodList"+tab1).style.display = "none";			//	隐藏当前栏目 海报列表
		getID("nav" + tab1).style.color = "white";
		getID("nav" + tab1).style.fontSize = "40px"; 
	//	getID("nav" + tab1).style.backgroundImage = "url(img/"+tab1Arr["data"][tab1].channelName+"0.png)"; 
	//	navPos = _tab1;	//注释掉看看有没有影响，后来统一改为tab1了
		tab1 = _tab1;
		getID("nav" + tab1).style.color = "f7a333";
		getID("nav" + tab1).style.fontSize = "50px"; 
	//	getID("nav" + tab1).style.backgroundImage = "url(img/"+tab1Arr["data"][tab1].channelName+"1.png)"; 
		getID("vodTab1").scrollLeft = ( (tab1-2)>0 )?(tab1-2)*200:0;
		getID("searchHistoryCollect").style.display = "none";	//	隐藏搜索 历史 收藏 海报列表

		if(_tab1==0){	//显示首页
			indexArea = "home";
			getID("vodTab").style.display = "none";			//	隐藏分类标签
			getID("vodList0").style.display = "block";		//	显示首页
			return;
		}else{
			getID("vodTab").style.display = "block";
			getID("vodList0").style.display = "none";
		}

		getID("vodList"+tab1).style.display = "block";	//	显示当前栏目 海报列表
		showTab2and3( _tab1 );	//动态显示二三级分类
		clearTimeout(stLoad);	
		stLoad = setTimeout(function() {	// 	防止用户快速点击栏目，所以延时1秒再请求数据
			getXuList(_tab1,0,0,1,12);		//	请求数据，显示海报列表
		}, 1000);
	}

	function clickTab2(_num){	//点击二级地区
		getID("vodListContent"+tab1).innerHTML = "";
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
		eval("vodPageAll"+tab1+"=1");	//总页数置1，否则因请求页大于总页数，而不会请求数据
		getID("region"+tab2).style.backgroundColor = "#ff9933";
		getID("vodTabRegion").scrollLeft = ((_num-3) * 138<0)?0:(_num-3) * 138;
		getXuList(tab1,_num,0,1,12);
		getID("loadmore"+tab1).innerHTML = "";
		getID("loading"+tab1).style.display = "block";
	}

	function clickTag3(_num){	//点击三级标签
		getID("vodListContent"+tab1).innerHTML = "";
		getID("region"+tab2).style.backgroundColor = "";			
		getID("region"+tab2).style.color = "#ff9933";
		getID("tag3_"+tab3).style.backgroundColor = "";			
		getID("tag3_"+tab3).style.color = "white";		
		tab3 = _num;
		eval("pageNow"+tab1+"=0");	//当前页置0，否则因当前页可能大于请求页，而不会请求数据
		eval("vodPageAll"+tab1+"=1");	//总页数置1，否则因请求页大于总页数，而不会请求数据
		getID("tag3_"+tab3).style.backgroundColor = "#ff9933";
		getID("vodTab3").scrollLeft = ((_num-3) * 138<0)?0:(_num-3) * 138;
		getXuList(tab1,tab2,_num,1,12);
		getID("loadmore"+tab1).innerHTML = "";
		getID("loading"+tab1).style.display = "block";
	}	

	var isShowSplash = 0;	//0为不显示启动图片，其它数字都代表显示启动图片 
	function showSplash(){
		if( isShowSplash ){
			getID("splash").style.display = "block";
			getID("splash").style.height = clientHeight + "px"; 
			var splashArr = <?php echo json_encode($splashArr); ?>;	
			var splashIndex = getCookie("splashIndex")?getCookie("splashIndex"):0;
			splashIndex ++;
			if( splashIndex > splashArr.length-1 ){
				splashIndex = 0;
			}
			setCookie("splashIndex", splashIndex, '12h');
			getID("splash").style.backgroundImage = 'url(./splash/'+splashArr[splashIndex]+')';
			startCircle();	//右上角跳过圆圈
			setTimeout(function() {	//延时启动上报在线状态的定时器，同时检查授权日期（为兼容用户直接点击跳过，检查授权代码写在splashJump内）
				imOnLine();
				splashJump();
			}, 10000);
		}else{
			getID("vod").style.display = "block";
			getID("vod").style.opacity = 1;
			getID("splash").style.display = "none";
			scrollEnable();
			imOnLine();
			splashJump();
		}
	}
	
	function init() {
		clientWidth = document.body.scrollWidth;
		clientHeight = window.innerHeight;//screen.availHeight * window.devicePixelRatio;   //手机的物理分辨率高（乘以像素比）
		getID('bodys').style.width = clientWidth + "px"; //全局宽

		stbInfo();
		scrollDisable();		//禁止页面滚动
		showSplash();			//显示启动图片	
        bindEvent();			//绑定滑动事件

		showTab1();				//显示一级分类
		showHomeLoop();
		showHomeZoneTop();		//显示首页上端专栏入口
		showHomeRecommend();
		showHomeHot(0);
		showHomeNew(0);
		showHighScore();
		showHomeBottomZone();
		scrollTo(0,0);		
		setTimeout(function(){moveHomeLoop(1);preLoadImages();},10000);
		showGuide();
		getID("loading").style.display = "none";
		setCookie("isGuideZone",1,"1d");
	}	
</script>

<body bgcolor="black" leftmargin="0" topmargin="0" onload="init();" >
<div id="bodys" style="position:absolute;top:0px;left:0px;width:100%;display:block;">
	<!--非直播 -->
	<div id="vod" style="position:absolute;left:0px;width:100%;opacity:0;-webkit-transition:1s;">
		<!-- 顶部黑底 -->
		<div style="position:fixed;width:100%;height:315px;background-color:#000;z-index:1;"></div>
		<!-- 左上角头像 -->
		<div id="leftUpLogo" style="position:fixed;top:50px;left:50px;width:200px;height:100px;line-height:110px; background:url(img/vip.png) no-repeat;background-size:33% 100% !important; background-color:#000;color:white;font-size:40px;padding-left:100px;z-index:1;" onclick="showMe();">Mix TV</div>

		<!-- 搜索框 -->
		<input type="text" id="searchInput" class="homeTop" style="left:315px;top:-90px;width:370px;height:80px;line-height:80px;font-size:45px;text-align:center;border-radius:50px;background:transparent;color:white;-webkit-transition:1s;outline:none;" autofocus="autofocus" onclick="getID('searchInput').focus();" />

		<!-- 搜索图标 -->
		<div id="searchImg" style="position:fixed;top:65px;left:720px;width:80px;height:80px;z-index:1;" onclick="showSearchInput();getID('shcContent').innerHTML = '';"><img src="img/search0.png" /></div>

		<!-- 历史图标 -->
		<div id="historyImg" style="position:fixed;top:65px;left:850px;width:80px;height:80px;z-index:1;" onclick="showSHC('history',1,'');getID('shcContent').innerHTML = '';"><img src="img/history0.png" /></div>

		<!-- 首页一级分类导航 -->
		<div class="homeTop" style="top:180px;left:0px;width:100%;">
			<ul id="vodTab1" class="tab-head">
				<!--li class="tab-tab1-item" id="nav-1" onClick="getID('liveVideo').muted=false;showLiveList(0);" style="margin-left:15px;">Live<br>直播</li-->
				<li class="tab-tab1-item" id="nav0" onClick="clickTab1(0);" style="margin-left:15px;font-size:50px;">精选</li>
			</ul>
		<div style="position:fixed;top:300px;left:5%;width:90%;height:0px;background-color:#333333;"></div>
		</div>

		<!-- 首页列表 -->
		<div id="vodList0" style="position: absolute;left:0%;top:285px;width:100%;display:block;">
			<!-- 首页 轮图 -->
			<div style="position:relative;top:0px;left:4%;width:92%;height:500px;overflow:hidden;">
				<div id="homeLoopDiv" style="position:absolute;left:0%;width:2000%;-webkit-transition:1s;" onclick="getID('h5video').muted=false;showHomeLoopDetail()"><!--
					<div-- class="homeLoopImg" style="background:url(img/null.png);">
						<div class="homeLoopTitle" ></div>
					</div-->
				</div>
				<div id="homeLoopCircle" style="position:absolute;left:60%;top:460px;width:40%;height:50px;text-align:center;"><!--
					<div-- id="homeLootCirle0" class="homeLoopCircle"></div-->
				</div>
			</div>

			<!-- 首页 专栏入口 -->
			<div class="homeList" style="width:96%;height:230px;top:0px;">
				<div style="position: relative;left:4%;">	
					<ul id="homeNavLive" class="tab-head">
						<!--div class="tab-homeLive-item" id="homeLiveGroup0" onClick="showLiveList(0);" style="background:url(img/null.png)"><div class="tab-homeLive-groupName">央视</div></div-->
					</ul>
				</div>	
			</div>

			<!-- 首页 Mix推荐 -->
			<div class="homeList" style="width:96%;height:750px;top:0px;" >
				<div><span style="position:relative;left:5%;width:10px;background-color:#ff9933;" >&ensp;</span><span style="position:relative;left:6%;">Mix推荐</span></div>
				<div id="homeRecommendImg0" class="homeRecommendImg" style="background: url(img/null.png) no-repeat" onclick="getID('h5video').muted=false;showRecommendDetail(0);">
					<div id="homeRecommendEpisode0" class="homeRecommendEpisode"></div>
					<div id="homeRecommendName0" class="homeRecommendName"></div>
					<div id="homeRecommendNames0" class="homeRecommendName" style="color:gray;"></div>
				</div>
				<div id="homeRecommendImg1" class="homeRecommendImg" style="background: url(img/null.png) no-repeat" onclick="getID('h5video').muted=false;showRecommendDetail(1);"> 
					<div id="homeRecommendEpisode1" class="homeRecommendEpisode"></div>
					<div id="homeRecommendName1" class="homeRecommendName"></div>
					<div id="homeRecommendNames1" class="homeRecommendName" style="color:gray;"></div>
				</div>
				<div id="homeRecommendImg2" class="homeRecommendImg" style="margin-top:110px;background: url(img/null.png) no-repeat" onclick="getID('h5video').muted=false;showRecommendDetail(2);">
					<div id="homeRecommendEpisode2" class="homeRecommendEpisode"></div>
					<div id="homeRecommendName2" class="homeRecommendName"></div>
					<div id="homeRecommendNames2" class="homeRecommendName" style="color:gray;"></div>
				</div>
				<div id="homeRecommendImg3" class="homeRecommendImg" style="margin-top:110px;background: url(img/null.png) no-repeat" onclick="getID('h5video').muted=false;showRecommendDetail(3);">
					<div id="homeRecommendEpisode3" class="homeRecommendEpisode"></div>
					<div id="homeRecommendName3" class="homeRecommendName"></div>
					<div id="homeRecommendNames3" class="homeRecommendName" style="color:gray;"></div>
				</div>
			</div>

			<!-- 首页 Hot榜 -->
			<div class="homeList" style="width:96%;height:450px;top:0px;">
				<div>
					<span style="position:relative;left:5%;width:10px;background-color:#ff9933;" >&ensp;</span>
					<span style="position:relative;left:6%;">Hot</span>
					<span style="position:relative;margin-left:10%;font-size:35px;" id="hot0" onClick="showHomeHot(0);">电影榜</span>
					<span style="position:relative;margin-left:4%;font-size:35px;" id="hot1" onClick="showHomeHot(1);">剧集榜</span>
					<span style="position:relative;margin-left:4%;font-size:35px;" id="hot2" onClick="showHomeHot(2);">短视频榜</span>
					<span style="position:relative;margin-left:4%;font-size:35px;" id="hot3" onClick="showHomeHot(3);">综艺榜</span>
				</div>		
				<div style="position:relative;left:4%;">
					<ul id="hotContent" class="tab-head" >
						<div class="tab-hot-item" onClick="showLiveList(0);" style="background:url(img/null.png)">
							<div id="hotScore0" class="tab-score" >9.9</div>
							<div class="tab-hotName">热播名称</div>
						</div>
					</ul>
				</div>
			</div>

			<!-- 首页 New榜 -->
			<div class="homeList" style="width:96%;height:450px;top:0px;">
				<div>
					<span style="position:relative;left:5%;width:10px;background-color:#ff9933;" >&ensp;</span>
					<span style="position:relative;left:6%;">New</span>
					<span style="position:relative;margin-left:10%;font-size:35px;" id="new0" onClick="showHomeNew(0);">电影榜</span>
					<span style="position:relative;margin-left:4%;font-size:35px;" id="new1" onClick="showHomeNew(1);">剧集榜</span>
					<span style="position:relative;margin-left:4%;font-size:35px;" id="new2" onClick="showHomeNew(2);">短视频榜</span>
					<span style="position:relative;margin-left:4%;font-size:35px;" id="new3" onClick="showHomeNew(3);">综艺榜</span>
				</div>				
				<div style="position:relative;left:4%;">
					<ul id="newContent" class="tab-head"></ul>
				</div>
			</div>

			<!-- 首页 近期高分口碑剧 -->
			<div class="homeList" style="width:96%;height:400px;top:0px;">
				<div>
					<span style="position:relative;left:5%;width:10px;background-color:#ff9933;" >&ensp;</span>
					<span style="position:relative;left:6%;">近期高分口碑剧</span>
				</div>				
				<div style="position:relative;left:0%;">
					<ul id="highScoreContent" class="tab-head">
						<div class="tab-highScore-item" onClick="showLiveList(0);" style="background:url(img/null.png) no-repeat;"></div>
						<div class="tab-highScore-item2" >
							<div class="tab-highScoreName" style="font-size:40px;line-height:80px;" id="highScoreName0"></div>
							<div class="tab-highScoreName"><span id="highScores0" style="color:#f7a333;"></span>&ensp;<span></span></div>
							<div class="tab-highScoreName" id="highScoreType0"></div>
							<div class="tab-highScoreName" id="highScoreMarks0" style="color:gray;"></div>				
						</div>
					</ul>
				</div>
			</div>

			<!-- 首页 下方专题 --
			<div-- class="homeList" style="height:450px;">
				<div>
					<span style="position:relative;left:5%;background-color:#ff9933;" >&emsp;</span>
					<span style="position:relative;overflow:hidden;left:6%;">好像青春故事总发生在夏天</span>
					<span style="position:relative;top:-100px;margin-left:95%;font-size:80px;" onClick="showHomeNew(0);"> > </span>
				</div>				
				<div style="position:relative;left:4%;">
					<ul id="bottomZoneContent0" class="tab-head"></ul>
				</div>
			</div-->			
		
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

		<!-- 电影 列表 -->
		<div id="vodList1" class="vodList" style="top:455px;">
			<div id="vodListContent1">
				<!--div id="vodListImgTest" class="listImg" style="background: url(img/null.png);" onClick="playVod(0);" >
					<div class="tab-score" >9.9</div>
					<div id="vodListNameTest" class="listName">测试电影名称</div>
				</div-->				
			</div>
			<div id="loading1" class="vodListName" style="width:100%;height:100px;background:url(img/loading2.gif) center center no-repeat; background-size:10% 30%;padding-top:200px;">loading</div>
			<div id="loadmore1" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

		<!-- 电视剧 列表 -->
		<div id="vodList2" class="vodList" style="top:455px;">
			<div id="vodListContent2"></div>
			<div id="loading2" class="vodListName" style="width:100%;height:100px;background:url(img/loading2.gif) center center no-repeat; background-size:10% 30%;padding-top:200px;">loading</div>
			<div id="loadmore2" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

		<!-- 短视频 列表 -->
		<div id="vodList3" class="vodList" style="top:455px;">
			<div id="vodListContent3"></div>
			<div id="loading3" class="vodListName" style="width:100%;height:100px;background:url(img/loading2.gif) center center no-repeat; background-size:10% 30%;padding-top:200px;">loading</div>
			<div id="loadmore3" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

		<!-- 综艺 列表 -->
		<div id="vodList4" class="vodList" style="top:455px;">
			<div id="vodListContent4"></div>
			<div id="loading4" class="vodListName" style="width:100%;height:100px;background:url(img/loading2.gif) center center no-repeat; background-size:10% 30%;padding-top:200px;">loading</div>
			<div id="loadmore4" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

		<!-- 纪录片 列表 -->
		<div id="vodList5" class="vodList" style="top:455px;">
			<div id="vodListContent5"></div>
			<div id="loading5" class="vodListName" style="width:100%;height:100px;background:url(img/loading2.gif) center center no-repeat; background-size:10% 30%;padding-top:200px;">loading</div>
			<div id="loadmore5" class="vodListName" style="height:100px;color:gray;"></div>
		</div>	

		<!-- 点播 体育 列表 -->
		<div id="vodList6" class="vodList" style="top:455px;">
			<div id="vodListContent6"></div>
			<div id="loading6" class="vodListName" style="width:100%;height:100px;background:url(img/loading2.gif) center center no-repeat; background-size:10% 30%;padding-top:200px;">loading</div>
			<div id="loadmore6" class="vodListName" style="height:100px;color:gray;"></div>
		</div>

	</div><!-- 点播尾 -->

	<!-- 专栏 -->
	<div id="zone" style="position: absolute; left:0px;top:50px;width:100%;background-color:black;display:none;z-index:99;-webkit-transition:1s;">
		<div id="zoneBg" style="position: fixed;left:0px;top:0px;width:100%;height:1920px;background:url(img/null.png); background-size:100% 100%;"></div>
		<div id="zoneLogo" style="position:relative;top:0px;left:0%;width:100%;height:150px;line-height:150px;font-size:90px;color:white;background:url(img/mixtv.png) no-repeat center; padding-left:4%;" onclick="androidBack()"> < </div>
		<div id="zoneName" style="position:relative;top:0px;width:90%;max-height:140px;line-height:70px;font-size:60px;color:#ff9933;padding-left:4%;"></div>
		<div id="zoneRemark" style="position:relative;top:20px;width:90%;max-height:250px;line-height:50px;font-size:40px;color:#cccccc;padding-left:5%;overflow:auto;" onclick="moreZoneRemark();"></div>
		<div id="zoneContent" style="position:relative;top:50px;width:100%;overflow:scroll;font-size:60px;color:white;">
			<div style="margin-bottom:50px;height:360px;float:left;" onclick="alert(0)">
				<div id="zoneContentImg" class="zoneImg" style="background:url(img/null.png);"></div>
				<div id="zoneContentName" class="zoneText" style="color:#ff9933"></div>
				<div id="zoneContentRegion" class="zoneText"></div>
				<div id="zoneContentType" class="zoneText"></div>
				<div id="zoneContentDuration" class="zoneText"></div>
			</div>
		</div>	
	</div><!-- 专栏尾 -->

	<!-- 子专栏 -->
	<div id="zoneC" style="position: absolute; left:0px;top:0px;width:100%;background-color:black;display:none;z-index:99;-webkit-transition:1s;">
		<div id="zoneBgC" style="position: fixed;left:0px;top:0px;width:100%;height:1920px;background:url(img/null.png); background-size:100% 100%;"></div>
		<div style="position:relative;top:0px;left:0%;width:100%;height:150px;line-height:150px;font-size:90px;color:white;background:url(img/mixtv.png) no-repeat center; padding-left:4%;" onclick="androidBack()"> < </div>
		<div id="zoneNameC" style="position:relative;top:0px;width:90%;max-height:100px;line-height:70px;font-size:60px;color:#ff9933;padding-left:4%;"></div>
		<div id="zoneRemarkC" style="position:relative;top:20px;width:90%;max-height:250px;line-height:50px;font-size:40px;color:#cccccc;padding-left:5%;overflow:auto;" onclick="moreZoneRemarkC();"></div>
		<div id="zoneContentC" style="position:relative;top:50px;width:100%;overflow:scroll;font-size:60px;color:white;">
			<div style="margin-bottom:50px;height:360px;float:left;" onclick="alert(0)">
				<div id="zoneContentImgC" class="zoneImg" style="background:url(img/null.png);"></div>
				<div id="zoneContentNameC" class="zoneText2" style="color:#ff9933"></div>
				<div id="zoneContentRegionC" class="zoneText"></div>
				<div id="zoneContentTypeC" class="zoneText"></div>
				<div id="zoneContentDurationC" class="zoneText"></div>
			</div>
		</div>	
	</div><!-- 子专栏尾 -->

	<!-- 搜索 历史 收藏 列表页 -->	
	<div id="searchHistoryCollect" class="homeList" style="top:335px;display:none;">
		<span id="shcTitle" style="position:relative;left:15%;color:#f7a333;"></span>
		<div id="shcImg" style="background:url(img/null.png) no-repeat;background-size:100% 100% !important;" class="homeListLogo"></div>
		<div style="position:absolute;left:0%;top:110px;width:100%;">
			<div id="shcContent" ></div>
			<div id="loadingSHC" class="vodListName" style="width:100%;height:100px;background:url(img/loading2.gif) center center no-repeat; background-size:10% 30%;padding-top:200px;">loading</div>
			<div id="hotSearch" class="vodListName" style="max-height: 800px;display:none;">
				<div style="position: relative;left:5%;width:90%;height:100px;text-align:left;"><span style="background-color:#ff9933;font-size:42px;">&ensp;</span>&nbsp;热门搜索</div>
				<div class="hotSearch"><span class="hotSearchNum" style="background-color:#F00;color:white;">&nbsp;1&nbsp;</span>&nbsp;<span id="hotSearch0" onclick="submitHotSearch(0)"></span></div>
				<div class="hotSearch"><span class="hotSearchNum" style="background-color:#F60;color:white;">&nbsp;2&nbsp;</span>&nbsp;<span id="hotSearch1" onclick="submitHotSearch(1)"></span></div>
				<div class="hotSearch"><span class="hotSearchNum" style="background-color:#FF0;color:#699;">&nbsp;3&nbsp;</span>&nbsp;<span id="hotSearch2" onclick="submitHotSearch(2)"></span></div>
				<div class="hotSearch"><span class="hotSearchNum" style="background-color:#0C0;color:white;">&nbsp;4&nbsp;</span>&nbsp;<span id="hotSearch3" onclick="submitHotSearch(3)"></span></div>
				<div class="hotSearch"><span class="hotSearchNum" style="background-color:#699;color:white;">&nbsp;5&nbsp;</span>&nbsp;<span id="hotSearch4" onclick="submitHotSearch(4)"></span></div>
				<div class="hotSearch"><span class="hotSearchNum" style="background-color:#06C;color:white;">&nbsp;6&nbsp;</span>&nbsp;<span id="hotSearch5" onclick="submitHotSearch(5)"></span></div>
				<div class="hotSearch"><span class="hotSearchNum" style="background-color:#909;color:white;">&nbsp;7&nbsp;</span>&nbsp;<span id="hotSearch6" onclick="submitHotSearch(6)"></span></div>
				<div class="hotSearch"><span class="hotSearchNum" style="background-color:darkgray;color:white;">&nbsp;8&nbsp;</span>&nbsp;<span id="hotSearch7" onclick="submitHotSearch(7)"></span></div>
			</div>
			<div id="searchHistory" class="vodListName" style="top:20px;max-height:800px;display:none;">
				<div style="position:relative;left:5%;width:40%;height:100px;text-align:left;"><span style="background-color:#ff9933;font-size:42px;">&ensp;</span>&nbsp;搜索记录</div>
				<div style="position:relative;left:80%;top:-100px;width:100px;height:100px;background:url(img/delete.png) no-repeat right;background-size:70% 70%;" onclick="deleteSearchHistory()"></div>
				<div id="searchHistoryContent" class="searchHistory" style="top:-100px;">
					<!--span id="searchHistory0" onclick="submitSearchHistory(0)">1</!--span-->
				</div>
			</div>
			<div id="loadmoreSHC" class="vodListName" style="height:100px;color:gray;"></div>
		</div>		
	</div><!-- 搜索 历史 收藏 列表尾 -->

	<!-- 直播频道列表 --
	<div id="channel" style="position:absolute;top:0px;left:0px;width:100%;display:none;">
		<div id="liveVideoDiv" style="position:fixed;left:0%;top:0px;width:100%;height:0px;background-color:black;background:url(../loading.gif);background-size:100% 100% !important;z-index:2;-webkit-overflow-scroll:touch;">
			<video id="liveVideo" style="object-fit:fill" width="100%" height="100%" autoplay controls muted preload="auto" type="application/x-mpegURL" src="" playsinline x5-playsinline webkit-playsinline x-webkit-airplay="true" x5-video-player-fullscreen="true" x5-video-orientation="landscape" ></video>
		</div>
		<!-- 频道组 --
		<div id="group" style="position:fixed;top:0px;left:0px;width:100%; height:90px;line-height:90px;z-index:2;">
			<ul id="groups" class="tab-head" style="background-color:#333333;">
				<!--li class="tab-head-item" id="group0" onClick="showVodList(0);"></li-->
			</ul>
		</div>

		<!-- 频道列表 --
		<div id="channels" class="channels" style="position:absolute;left:0px;top:100px;overflow-y:scroll;    -webkit-overflow-scrolling:touch;"></div>
		<img id="liveBack" style="position:fixed;left:80px;top:1300px;width:150px;height:150px;display:none;" src="img/back1.png" onclick="androidBack();"/>
	</div><!-- 直播频道尾 -->

	<!-- 详情页 -->
	<div id="detail" style="position:absolute;left:-2000px;top:0px;width:100%;z-index:2;background-color:black;display:none;-webkit-transition:1s;">
		<div id="detailPoster" style="position:relative;left:0%;top:0px;width:100%;height:0px;background-color:black; background:url(img/null.png);background-size:100% 100% !important;" >
			<video id="h5video" style="object-fit:fill" width="100%" height="100%" autoplay controls muted preload="auto" src="" playsinline x5-playsinline webkit-playsinline x-webkit-airplay="true" x5-video-player-fullscreen="true" x5-video-orientation="landscape" ></video>
		</div>

		<div style="position:relative;top:20px;left:70%;width:30%;height:50px;z-index:3;">
			<table><tr>
				<td id="fullscreens" onclick="fullscreenH5();" style="opacity:0;"><img src=img/fullscreen.png style="width:50px;height:50px;"/>&emsp;</td>
				<td onClick="changeCollect()"><img src=img/collect0.png style="width:70px;height:70px;" id="collectImg" />&emsp;</td>
				<td id="speeds" onclick="changeSpeedH5();" style="color:white;font-size:40px;opacity:0;">x <span id="speedNum">1</span></td>
			</tr></table>
		</div>

		<div class="detailText" style="top:-20px;width:80%;font-size:50px;color:#f7a333;" id="detailName" onclick="updateCurrentTime();getID('detail').style.left = '-2000px';setTimeout(function(){androidBack();},300);"></div>
		<div class="detailText" style="top:0px;" id="tab"><b>类型：</b><span id="detailTab"></span></div>
		<div class="detailText" style="top:0px;" id="region"><b>地区：</b><span id="detailRegion"></span></div>
		<div class="detailText1" style="top:0px;" id="actor"><b>主演：</b><span id="detailActor" ></span></div>
		<div class="detailText1" style="top:0px;" id="director"><b>导演：</b><span id="detailDirector" ></span></div>
		<div class="detailText" style="top:0px;width:45%" id="duration"><b>时长：</b><span id="detailDuration"></span></div>
		<div class="detailText" style="top:0px;width:45%;" id="score"><b>IMDB评分：</b><span id="detailScore" style="color:#f7a333;"></span></div>
		<div class="detailText" style="top:0px;width:45%;" id="year" ><b>上映年份：</b><span id="detailYear"></span></div>
		<div class="detailText" style="top:0px;" id="description" onclick="moreDescription()"><b>剧情：</b><span id="detailDescription"></span></div>
		<div class="detailText2" style="top:0px;display:none;" id="chooseChapter">选集&emsp;<span id="episodes"></span>
			<ul id="chooseChapterNum" class="tab-head">
				<!--div class="tab-chooseChapter-item" onClick="showLiveList(0);" style="">1</!-div-->
			</ul>
		</div>
		<!--div class="detailText" style="top:-220px;left:84%;width:100px;height:100px;background:url(img/collect0.png);"  ></div-->
		<div id="guess" class="detailText2" style="top:0px;">猜您喜欢
			<!--img style="position:relative;left:65%;top:10px;width:70px;height:70px;" src="img/back0.png" onclick="updateCurrentTime();getID('vod').style.display = 'block';getID('detail').style.left = '-2000px';setTimeout(function(){androidBack();},300);" /-->
			<div style="position:relative;left:0%;top:0px;">
				<!--div id="guess0" class="guess" style="margin-right:3%;background:url(img/null.png);"></div>
				<div id="guess1" class="guess" style="margin-right:3%;float:left;background-size:100% 100% !important;background:url(img/null.png);"></div>
				<div id="guess2" class="guess" style="margin-right:0%;margin-bottom:30px;background:url(img/null.png);"></div-->
				<ul id="guesses" class="tab-head" >
					<!--div class="tab-guess-item" onClick="showLiveList(0);" style="background:url(img/null.png)"><div class="tab-guessName">猜您喜欢之一</div></div-->
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
	<div id="cardKey" style="position:fixed;top:0px;left:0px;width:100%;height:0px;background:linear-gradient(to bottom,black,black);display:none;text-align:center;font-size:80px;color:white; z-index:10;">
		<h1 id="title" style="position:absolute;left:0px;top:3%;width:100%;height:100px;text-align:center;font-size:90px;text-shadow:-5px 5px 5px #000;">Registered VIP Card</h1>
<!--
		<div style="position:absolute;left:5%;top:16%;width:90%;height:70px;font-size:60px;text-align:left;text-shadow:-5px 5px 5px #000;">Card Number</div>
		 卡号输入框 
		<input type="number" id="card_id" style="position:absolute;left:5%;top:21%;width:90%;height:100px;font-size:60px;text-align:center;border-radius:10px 10px 10px 10px;background:transparent;color:white;" maxlength="8" oninput="onInputHandler(event,'card_id')" autofocus="autofocus" onkeyup="value=value.replace(/[^-\d]/g,'')" />

		<div style="position:absolute;left:40%;top:21%;width:50%;height:100px;" onClick="getID('card_id').focus();window.androidJs.JsShowImm();"></div>-->

		<div id="cardKeyTitle" style="position:absolute;left:5%;top:20%;width:90%;height:70px;font-size:60px;text-align:center;text-shadow:-5px 5px 5px #000;">请输入卡密</div>
		<!-- 卡密输入框 -->
		<input type="number" id="card_key" style="position:absolute;left:5%;top:30%;width:90%;height:100px;font-size:60px;text-align:center;border-radius:10px 10px 10px 10px;background:transparent;color:white;" maxlength="12" oninput="onInputHandler(event,'card_key')" onkeyup="value=value.replace(/[^-\d]/g,'')" />

		<div style="position:absolute;left:40%;top:30%;width:50%;height:100px;" onClick="getID('card_key').focus();window.androidJs.JsShowImm();"></div>

		<div id="back" style="position:absolute;left:5%;top:45%;width:40%;line-height:110px;font-size:80px;text-align:center; border-radius:60px 60px 60px 60px;background:linear-gradient(to right,#6633cc,#000066);color:white;text-shadow:-5px 5px 5px #000;" onclick="back()"><b>返&emsp;回</b></div>

		<div id="ok" style="position:absolute;left:55%;top:45%;width:40%;line-height:110px;font-size:80px;text-align:center; border-radius:60px 60px 60px 60px;background:linear-gradient(to right,#6633cc,#000066);color:white;text-shadow:-5px 5px 5px #000;" onclick="checkInput()"><b>提&emsp;交</b></div>

		<div id="img" style="position:absolute;left:5%;top:58%;width:90%;height:35%;background:url(img/vipCard.png) no-repeat;background-size:100% 100% !important;"></div>

		<div id="exp" style="position:absolute;left:13%;top:63%;width:77%;height:100px;color:gold;font-size:60px;text-align:left;text-shadow:0px 3px 3px gold;"></div>

		<div id="msg" style="position:absolute;left:5%;top:58%;width:90%;height:35%;text-align:center;font-size:70px;font-weight:900;border-radius:55px 55px 55px 55px;color:red;"></div>
	</div>

	<!-- 个人中心 -->
	<div id="me" style="position:absolute;top:0px;left:0px;width:100%;height:0px;background:linear-gradient(to bottom,black,black);display:none;text-align:center;font-size:80px;color:white; z-index:10;-webkit-transition:1s;">
		<div style="position:absolute;top:50px;left:0%;width:90%;height:150px;line-height:150px;text-align:left; font-size:90px;color:white;background:url(img/mixtv.png) no-repeat center; padding-left:10%;" onclick="androidBack()"> < </div>
		<h1 class="PersonalCenter" style="margin-top:200px;width:80%;text-align:center;font-size:90px;" id="meTitle" >個人中心</h1>
		<div id="usernameDiv">
			<div class="PersonalCenter" style="margin-top:0px;" id="meUser">用戶名</div>
			<div class="PersonalCenterR" style="margin-top:0px;" id="usernameH5" >	
			</div>
		</div>
		<div class="PersonalCenter" id="meExpire">有效期</div>
		<div class="PersonalCenterR" id="expireTimeH5"></div>
		<div onclick="registedVipCard();">
			<div class="PersonalCenter" id="meLicense">授权</div>
			<div class="PersonalCenterR">></div>
		</div>
		<div onclick="showShare();" style="display: block;">
			<div class="PersonalCenter" id="meShare">分享</div>
			<div class="PersonalCenterR">></div>
		</div>
		<div onclick="if(backArea=='true'){getID('me').style.display='none';showSHC('history',1,'');getID('shcContent').innerHTML = '';}">
			<div class="PersonalCenter" id="meHistory">播放歷史</div>
			<div class="PersonalCenterR">></div>
		</div>
		<div onclick="if(backArea=='true'){getID('me').style.display='none';showSHC('collect',1,'');getID('shcContent').innerHTML = '';}">
			<div class="PersonalCenter" id="meCollect">收藏</div>
			<div class="PersonalCenterR" >></div>
		</div>
		<!--div>
			<div class="PersonalCenter">Clear cache</div>
			<div class="PersonalCenterR">></div>
		</div-->
		<div id="speedDiv" onclick="changeDefaultSpeed();">
			<div class="PersonalCenter" id="meSpeed">播放速度</div>
			<div class="PersonalCenterR" id="defaultSpeed">1.0</div>
		</div>
		<div id="languageDiv" onclick="changeLanguage();">
			<div class="PersonalCenter" style="width:60%;" id="meLanguage">系统语言</div>
			<div class="PersonalCenterR" style="width:28%" id="defaultLanguage">中文</div>
		</div>
		<div id="changePasswordDiv" onclick="changePassword();">
			<div class="PersonalCenter" style="width:60%;" id="mePassword">修改密码</div>
			<div class="PersonalCenterR" style="width:28%">></div>
		</div>
		<div id="logOutDiv" onclick="logout();">
			<div class="PersonalCenter" id="meLogout">退出登陸</div>
			<div class="PersonalCenterR" id="logOut">></div>
		</div>
		<div id="share" style="position:absolute;left:0px;top:350px;width:100%;height:2500px;background-color:#000;display:none;">
			<div id="shareImg" class="shareImg" ><img src="img/shareIOS.png"/></div>
			<div id="shareShare" class="shareButton" onclick="shareDownload2()" >Share</div>
			<div id="shareDownload" class="shareButton" onclick="shareDownload();" ><div id="shareDownloads">Download</div></div>
			<div id="shareCancle" class="shareButton" onclick="indexArea='me';getID('share').style.display='none';" >Cancle</div>
		</div>
	</div>

	<!-- 登陆 注册 -->
	<div id="login" style="position:fixed;left:0px;top:0px;width:100%;height:3000px;background:url(img/loginBg.jpg) no-repeat;background-size:100% 100%;z-index:10;display:none;">
		<div class="login-top" style="width:80%;background-color:white;border:gray 1px solid;"></div>
		<div id="loginType" class="login" style="top:30.5%;left:35%;width:45%;background:linear-gradient(to right,#6633cc,#000066);border-radius:5em;-webkit-transition:1s;"></div>
		<div class="login-top" style="left:10%;color:black;" onclick="changeLoginType();" id="login-login"><b>登 陆<br>Log in</b></div>
		<div class="login-top" style="left:45%;color:white;" onclick="changeLoginType();" id="login-register"><b>注 册<br>Register</b></div>

		<div class="login" style="top:37%;background:url(img/login_email.png) no-repeat right;background-size:10% 70%;">
			<input id="emailInput" type="text" class="login-input" placeholder="邮箱 (Email)" />
		</div>
		<!--
		<div class="login" style="top:40%;background:url(img/login_username.png) no-repeat right;background-size:7% 70%;">
			<input id="usernameInput" type="text" class="login-input" placeholder="用户名 (Username)" maxlength="20" onkeyup="value=value.replace(/[\W]/g,'')" onkeydown="fncKeyStop(event)" onpaste="return false" oncontextmenu="return false" />
		</div>
		-->
		<div class="login" style="top:43%;background:url(img/login_password.png) no-repeat right;background-size:7% 70%;" onclick="indexArea='login'">
			<input id="passwordInput" type="password" class="login-input" placeholder="密码 (Password)" maxlength="20" onkeyup="value=value.replace(/[\W]/g,'')" onkeydown="fncKeyStop(event)" onpaste="return false" oncontextmenu="return false" />		
		</div>
		<div class="login-prompt" style="top:46%;display:none;" id="resetPassword" onclick="resetPassword();">重置密码</div>
		<div class="login-submit" onclick="login();" id="loginSubmit">注&emsp;册</div>
		<div class="login-prompt" style="top:55%;" id="login_type" onclick="changeLoginType()">已有账号，点击这立即登陆</div>
	</div>

	<!-- 修改密码 -->
	<div id="changePassword" style="position:fixed;left:0px;top:0px;width:100%;height:3000px;background:url(img/loginBg.jpg) no-repeat;background-size:100% 100%;z-index:11;display:none;">
		<div class="login-submit" style="top:30%;height:120px;line-height:120px;" id="changePasswordTitle">修改密碼</div>
		<div class="login" style="top:37%;background:url(img/login_password.png) no-repeat right;background-size:7% 70%;">
			<input id="passwordOld" type="password" class="login-input" placeholder="原密码 (Old Password)" onkeyup="value=value.replace(/[\W]/g,'')" />		
		</div>
		<div class="login" style="top:40%;background:url(img/login_password.png) no-repeat right;background-size:7% 70%;">
			<input id="passwordNew0" type="text" class="login-input" placeholder="新密码 (New Password)" onkeyup="value=value.replace(/[\W]/g,'')" />
		</div>
		<div class="login" style="top:43%;background:url(img/login_password.png) no-repeat right;background-size:7% 70%;">
			<input id="passwordNew1" type="text" class="login-input" placeholder="确认密码 (New Password)" onkeyup="value=value.replace(/[\W]/g,'')" />		
		</div>
		<div class="login-submit-small" onclick="getID('changePassword').style.display='none';showMe();" id="changePasswordCancle">取 消(</div>
		<div class="login-submit-small" onclick="submitChangePassword();" id="changePasswordSubmit">提 交</div>
	</div>

	<!-- 默认语言 -->
	<div id="language" style="position:fixed;left:0px;top:0px;width:100%;height:3000px;background:url(img/loginBg.jpg) no-repeat;background-size:100% 100%;z-index:11;display:none;">
		<div style="position: absolute;top:40%;width:100%;text-align:center;font-size:55px;">選擇語言<br>Language choice</div>
		<div class="login-submit" style="top:55%;" onclick="changeLanguages('c')">中&emsp;文</div>
		<div class="login-submit" style="top:60%;" onclick="changeLanguages('e')">English</div>
		<div style="position:absolute;top:75%;width:100%;text-align:center;font-size:50px;color:gray;">可以在個人中心切換語言<br>Switch language in the personal center</div>
	</div>

	<!-- 启动图片 -->
	<div id="splash" style="position: absolute;left:0px;top:0px;width:100%;height:0px;background:url(img/null.png);background-size:100% 100%;display:none;z-index:99;">	
		<div onclick="splashJump();" style="position: absolute;right:100px;">
			<div class="flex-container" >
				<div class="outbox" id="splashJump">跳過</div>
				<svg class="svg">
					<circle id="cls" class="cls run-anim" cx="70" cy="70" r="65"></circle>
				</svg>
			</div>
		</div>
	</div>

	<div id="loading" style="position:fixed;left:0px;top:40%; width:100%;height:100px;background:url(img/loading2.gif) center center no-repeat; background-size:10% 30%;padding-top:200px;color:white;text-align:center;font-size:50px;z-index:9;display:block;">loading</div>

	<div id="guide" style="position:absolute;top:0px;left:0px;width:100%;height:3000px;z-index:999;display: none;">
		<div id="redArrow" class="line" style="top:0px;left:180px;width:50px;height:0px;background:url(img/redArrow.png);background-size:100% 100%;"></div>
		<div id="guideContent" class="guide" style="top:900px;"></div>
		<div id="guideOk" class="guide" style="top:1550px;" onclick="guideIndex++;showGuide();">朕 知 道 了</div>
	</div>

</div><!-- bodys尾 -->

<!-- 预加载图片 -->
<div id="preLoadImg" style="position: absolute;left:0px;top:0px;width:1px;height:1px;opacity:0;"></div>

</body></html>

<script type=text/javascript src="js/global.js?v=14" charset=UTF-8></script>
<script type=text/javascript src="js/initS.js?v=6" charset=UTF-8></script>
<script type=text/javascript src="js/touchMoveXu.js?v=3" charset=UTF-8></script>
<script type=text/javascript src="js/detailXu.js?v=1" charset=UTF-8></script>
<script type=text/javascript src="js/searchHistoryCollectXu.js?v=1" charset=UTF-8></script>