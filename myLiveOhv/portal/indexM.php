<script type=text/javascript src="js/global.js" charset=UTF-8></script>
<script type=text/javascript src="js/fingerprint2.js"></script>
<script type=text/javascript src="../jquery-1.11.0.min.js" charset=UTF-8></script>
<script type=text/javascript src="js/init.js?v=3"></script>
<script type=text/javascript src="js/register.js?v=3"></script>
<?php
//	error_reporting(0);// 关闭所有PHP错误报告
//	error_reporting(-1);// 报告所有 PHP 错误=error_reporting(E_ALL);
//	error_reporting(E_ERROR | E_WARNING | E_PARSE | E_NOTICE);// 报告 E_NOTICE也挺好 (报告未初始化的变量或者捕获变量名的错误拼写)
	error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);
	set_time_limit(0); //限制页面执行时间,0为不限制
	include_once "readSplash.php";
	include_once "../connectMysql.php";
	include_once "../readChannelArray.php";
	include_once "../readTabNav.php";	//获取分类标签
	include_once "readCollectArray.php";	//获取收藏id

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
		return $realip;
	}
	
	function getCity(){			// 获取当前IP所在城市 
		$tpyApi = "http://whois.pconline.com.cn/ip.jsp?ip=".getIP();
		$city = file_get_contents($tpyApi);
		$city = iconv('GBK', 'UTF-8', $city);
		$city = trim($city);
		return $city;
	}
	$ip = ($_COOKIE["ip"])?$_COOKIE["ip"]:getIP();
	$city = ($_COOKIE["city"])?$_COOKIE["city"]:getCity();

	$sn = $_COOKIE["sn"];//$_POST['imOnLineSN'];	//$_COOKIE["sn"];//
	$mark = $_COOKIE["deviceInfo"];	//机顶盒备注
	$loginTime = date("Y-m-d"); 						//机顶盒打开APP的日期
	$intLloginTime = str_replace("-", "", $loginTime);	//为了便于比大小将时间内的-删掉
	$expireTime = date("Y-m-d", strtotime("+0 day")); 	//初次安装的授权到期时间
	//	$intExpireTime = str_replace("-","",$expireTime);	//为了便于比大小将时间内的-删掉
	$hiddenTime = ($_COOKIE["hiddenTime"])?$_COOKIE["hiddenTime"]:0;	// 切到后台的时间点
	$visibilityTime = time();							//此次打开的时间戳，精确到秒
	$lastTime = date("Y-m-d H:i:s"); 					//此次打开APP的时分秒
	$isOnLine = "在线";									//每次进入应用都激活在线状态
	$sql = mysqli_query($connect, "select * from client where sn='$sn' ") or die(mysqli_error($connect));

	if( mysqli_num_rows($sql) > 0 ){ //如果数据库中有当前机顶盒
		if( (int)$visibilityTime-(int)$hiddenTime > 600 ){
			$sql = mysqli_query($connect, "UPDATE client set isOnLine='$isOnLine',ip='$ip',city='$city',lastTime='$lastTime' where sn='$sn' ") or die(mysqli_error($connect));	 //更新在线状态		
			$sql2 = mysqli_query($connect, "INSERT INTO login SET sn='$sn',ip='$ip',city='$city' ") or die(mysqli_error($connect)); 	//记录登陆时间
		}
	}else if( $sn!= "null" && $sn!= null && strlen($sn)>0 ) { //如果数据库中没有当前机顶盒，且当前机顶盒有SN
		$sql = mysqli_query($connect, "replace into client(sn,mark,ip,city,loginTime,expireTime,lastTime,isOnLine) values ('$sn','$mark','$ip','$city','$loginTime','$expireTime','$lastTime','$isOnLine')") or die(mysqli_error($connect));
	}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>Oh!V</title>
	<meta charset="utf-8">
	<meta http-equiv="content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="keywords" content="keyword1,keyword2,keyword3"><!-- 搜索关键字 -->
	<meta http-equiv="description" content="This is my page"><!-- 页面描述 -->
    <meta http-equiv="X-UA-Compatible" content="ie=edge" /--><!-- 定义IE显示模式，在移动端页面没什么用 -->
	<meta http-equiv="Expires" content="0" /><!-- 可以用于设定网页的到期时间。一旦网页过期，必须到服务器上重新传输 -->
	<meta http-equiv="Pragma" content="no-cache"><!-- 这样设定，访问者将无法脱机浏览 -->
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" /><!--清除缓存-->
	<meta http-equiv="Window-target" content="_top"><!-- 强制页面在当前窗口以独立页面显示，防止别人在框架里调用自己的页面-->
	<meta http-equiv="Page-Enter" contect="revealTrans(duration=1.0,transtion=12)">
	<meta http-equiv="Page-Exit" contect="revealTrans(duration=1.0,transtion=12)">
	<!-- 设定进入页面时的特殊效果 
			Duration的值为网页动态过渡的时间，单位为秒。  
			Transition是过渡方式，它的值为0到23，分别对应24种过渡方式。如下表：  
			0    盒状收缩    1    盒状放射  
			2    圆形收缩    3    圆形放射  
			4    由下往上    5    由上往下  
			6    从左至右    7    从右至左  
			8    垂直百叶窗    9    水平百叶窗  
			10    水平格状百叶窗    11垂直格状百叶窗  
			12    随意溶解    13从左右两端向中间展开  
			14从中间向左右两端展开    15从上下两端向中间展开  
			16从中间向上下两端展开    17    从右上角向左下角展开  
			18    从右下角向左上角展开    19    从左上角向右下角展开  
			20    从左下角向右上角展开    21    水平线状展开  
			22    垂直线状展开    23    随机产生一种过渡方式	
	-->

	<!--meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,minimum-scale=1,user-scalable=no" /><!--强制让文档的宽度与设备的宽度保持1:1，并且文档最大的宽度比例是1.0，且不允许用户点击屏幕放大浏览-->
	<meta name="apple-mobile-web-app-capable" content="yes"><!--safari私有,允许全屏模式浏览，用户将网页添加到主屏后，再从主屏幕打开这个网页，可以隐藏浏览器的地址栏和下面的toolbar-->
	<meta name="apple-mobile-web-app-title" content="Oh!V"><!-- 在发送到屏幕的时候默认的命名 -->
	<meta name="apple-mobile-web-app-status-bar-style" content="black" /><!-- iphone中safari顶端的状态条的样式，其值有三个：default、black、black-translucent -->
	<meta name='full-screen' content='true' />
	<meta name='x5-fullscreen' content='true' />
	<meta name='360-fullscreen' content='true' />

	<link rel="apple-touch-icon"  sizes="72x72"  href="./img/ic_launcher.png">
	<!--link rel="apple-touch-icon-precomposed"  sizes="72x72"  href="apple-touch-icon-precomposed.png">添加到主屏后的图标，以上只能选其一，区别在于如果使用apple-touch-icon，iOS会给icon加上一些NB的效果，包括圆角，阴影，反光。如果使用apple-touch-icon-precomposed则iOS不会加这个效果。如果你的网站也要可以在Ipad上访问，那么你还要针对不同的设备准备不同尺寸的icon，你可以通过sizes属性来指定icon的尺寸，如果你不指定size属性，那么默认为57x57 -->
	<!-- ios使用一个初始化图片来替代白色的浏览器屏幕-->
	<!-- iPhone 6/7/8 	Portrait -->
	<link rel="apple-touch-startup-image" href="./splash/750×1334.png" media="(device-width: 375px) and (device-height: 667px)" >
	<!-- iPhone 6Plus/7Plus/8Plus	Portrait -->
	<link rel="apple-touch-startup-image" href="./splash/1242x2208.png" media="(device-width: 414px) and (device-height: 736px)" >
	<!-- iPhone XR/11/11ProMax	Portrait -->
	<link rel="apple-touch-startup-image" href="./splash/828×1792.png" media="(device-width: 414px)and (device-height: 896px)" >
	<!-- iPhone X/Xs/11Pro	Portrait -->
	<link rel="apple-touch-startup-image" href="./splash/1125x2436.png" media="(device-width: 375px)and (device-height: 812px)" >
	<!-- iPhone XsMax	Portrait -->
	<link rel="apple-touch-startup-image" href="./splash/1242×2688.png" media="(device-width: 736px)and (device-height: 1344px)" >

	<link rel="stylesheet" type="text/css" href="style.css?v=1" >
	<link rel="stylesheet" type="text/css" href="circle/css/style.css" />
	<link rel="stylesheet" type="text/css" href="circle/css/normalize.css" />
	<link rel="shortcut icon" href="./img/ic_launcher.png" type="image/x-icon"> <!-- 网页收藏夹图标 -->
</head>
<style>
	.full{
		transform:rotate(90deg);
		-ms-transform:rotate(90deg); 	/* IE 9 */
		-moz-transform:rotate(90deg); 	/* Firefox */
		-webkit-transform:rotate(90deg); /* Safari 和 Chrome */
		-o-transform:rotate(90deg); 	/* Opera */
	}

	:-webkit-full-screen video {width: 100%;height: 100%;}
	:-moz-full-screen video{width: 100%;height: 100%;}
</style>
<script>
	var intLoginTime = <?php echo $intLloginTime ?>; //应用登陆时间，其实这个没必要去后台获取，只要取当前时间即可
	var tabArr = <?php echo json_encode($tabArr); ?>;	
	var collectArr = <?php echo json_encode($collectArr); ?>;
	var channelDataArr = <?php echo json_encode($channelArr); ?>;
//	console.log(collectArr);

	var currentTime = 0;   //播放位置 单位秒
	function playVod(_id,_playUrl) {
	//	alert(sn+"\r\n"+intLoginTime+"-"+intExpireTime);
		if( parseInt(intLoginTime) > parseInt(intExpireTime) ){	//授权过期了
	//		alert("过期了");
			registedVipCard();
			return;
		}else{
			if (typeof(window.androidJs) != "undefined") {
				window.androidJs.JsPlayVod(_playUrl);
			}
		}

		$.ajax({
			type: 'POST',
			url: './playVod.php',	//写当前的播放记录
			data: {
				'sn':sn,
				'id':_id
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
	}

	function changePage(_num) { //VOD列表换页
		pageNow += _num;
		if (pageNow > vodPageAll || pageNow < 1) {
			pageNow = vodPageAll;
		}
		if( indexArea == "search" || indexArea == "history" ||indexArea == "collect" ){
			showSHC(indexArea,pageNow,searchTemp);
		}else{
			getTabData(tab1,tab2,tab3,pageNow,5);
		}
	}

	//	显示海报列表
	var tab1 = 0;	//一级分类，即电影 电视剧……
	var tab2 = 0;	//二级分类，即地区
	var tab3 = 0;	//三级分类，即爱情、动作、喜剧之类的分类标签
	var pageNow = 1; //第一页是1
	var pageNow0=0,pageNow1=0, pageNow2=0, pageNow3=0, pageNow4=0, pageNow5=0, pageNow6=0, pageNow7=0, pageNow8=0, pageNow9=0, pageNow10=0, pageNow11=0, pageNow12=0, vodPageAll = 1, vodPageAll0 = 1, vodPageAll1 = 1, vodPageAll2 = 1, vodPageAll3 = 1, vodPageAll4 = 1, vodPageAll5 = 1, vodPageAll6 = 1, vodPageAll7 = 1, vodPageAll8 = 1, vodPageAll9 = 1, vodPageAll10 = 1, vodPageAll11 = 1, vodPageAll12 = 1 ;
	var changePageStatus = "f"; //；加载状态，f为未完成，此时不加载下一页

	function getTabData(_tab1, _tab2,_tab3,_pageNow, _pageSize){
		pageNow = eval("pageNow"+tab1)+1; //当前请求页码为已显示页面+1，即下一页
		$.ajax({
			type: 'POST',
			url: '../readTabJson.php',
			data: {
				'tag1': tabArr[1][_tab1].tagName,
				'tag2': "全部",
				'tag3': "全部",
				'pageNow': pageNow,
				'pageSize': _pageSize,
				'mobile': "mobile",
			},
			dataType: 'json',
			beforeSend: function() {
				//这里一般显示加载提示;
			},
			success: function(json) {
				eval("pageNow"+tab1+"="+pageNow);			//请求成功才更新当前页码
				eval("vodPageAll"+tab1+"="+json.pageAll);	//请求成功才更新总页数
				vodPageAll = json.pageAll;
			//	alert("当前页："+eval("pageNow"+tab1));	
				if( vodPageAll == 0 || pageNow == vodPageAll || pageNow > vodPageAll){	//打开这段就直接显示no more，否则需上拉一下			
					getID("loadmore"+tab1).innerHTML = "•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;&nbsp;no more&nbsp;&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•";
					eval("pageNow"+tab1+"="+vodPageAll);
				}else{
					getID("loadmore"+tab1).innerHTML = "";
					getID("loading"+tab1).style.display = "block";
				}
				var list = json.list;
				$.each(list,
					function(index, array) { //遍历json数据列
						var name = array['name'].slice(array['name'].lastIndexOf('/') + 1);
						var father2 = array['father'];
						var id = array["id"];
						var poster = array['poster'];
					//	console.log(poster);
						name = name.slice(0,name.lastIndexOf('.') );
					
				//		var playUrl = "http://videofile1.cutv.com/originfileg/010002_t/2017/02/14/G15/G15fgfffhgjnmfnhnhkkjk_cug.mp4";
				//		var playUrl = "http://158.69.108.183:8080/myLiveOhv/vod/fsyy.ts";
				//		var playUrl = "http://mixtvapi.mixtvapp.com:8080/rmt/0fc71333f8f349f79b4ce7125b302dcf.mp4";
				//		var playUrl = "http://183.207.249.15/PLTV/2/224/3221226037/index.m3u8";
				//		var playUrl = "http://tenstar.synology.me:10025/myLive/vod/"+name+"/index.m3u8";
						var playUrl = "http://158.69.108.183:8080/myLiveOhv/vod/"+name+"/index.m3u8";

						var collectImg = (collectArr.includes(id))?"img/collect1.png":"img/collect0.png";
						if( typeof(window.androidJs) != "undefined"){
							getID("vodListContent"+_tab1).innerHTML += '<div id=videoImg'+id+' class="vodListImg" style="height:'+imgHeight+';background:url(../vod/'+name+'/'+poster+')" ><div style="float:left;left:0px;top:0px;width:80%;height:100%;" onClick=playVod('+id+',"'+playUrl+'");></div><img id=collectImg'+id+' src='+collectImg+' style="float:left;margin-left:20px;margin-top:20px;width:100px;height:100px;" onClick=changeCollect('+id+') /></div><div class="vodListName">'+father2+'</div>';
						}else{
							getID("vodListContent"+_tab1).innerHTML += '<div id=videoImg'+id+' class="vodListImg" style="height:'+imgHeight+';" ><video id=h5Video'+id+' style="object-fit:fill;" width="100%" height="100%" controls preload="auto" type="application/x-mpegURL" poster="../vod/'+name+'/'+poster+'" src='+playUrl+' playsinline x5-playsinline webkit-playsinline x-webkit-airplay="true" x5-video-player-fullscreen="true" x5-video-orientation="landscape"></video></div><div class="vodListNameBrowser">'+father2+'</div><img id=collectImg'+id+' src='+collectImg+' style="float:left;width:100px;height:100px;" onClick=changeCollect('+id+') />';
						}
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

	function showTab1(){	//启动APP时根据后台数据动态显示一级影视类型		
		for(i=0;i<tabArr[1].length;i++){
		//	getID('vodTab1').innerHTML += '<li class="tab-tab1-item" id=nav'+i+' onClick="clickTab1('+i+')" style="background:url(img/'+tabArr[1][i].tagTable+'0.png) center no-repeat" >'+tabArr[1][i].tagName+'</li>';
			getID('vodTab1').innerHTML += '<li class="tab-tab1-item" id=nav'+i+' onClick="clickTab1('+i+')" >'+tabArr[1][i].tagName+'</li>';

			getID("vod").innerHTML += '<div id=vodList'+i+' class="vodList" style="top:'+vodListTop+'"><div id=vodListContent'+i+'></div><div id=loading'+i+' class="vodListName" style="width:100%;height:100px;background:url(img/loading2.gif) center center no-repeat; background-size:10% 30%;padding-top:200px;">loading</div><div id=loadmore'+i+' class="vodListName" style="height:100px;color:gray;"></div></div>';
		}
	}

	stLoad = setTimeout(function(){ }, 1000);	//防止第一次执行找不到定时器
	function clickTab1(_tab1){	//点击一级分类
		scrollTo(0, 0); 
		indexArea = "vod";
		getID("vodList"+tab1).style.display = "none";			//	隐藏当前栏目 海报列表
		getID("nav" + tab1).style.color = "white"; 
	//	getID("nav" + tab1).style.backgroundImage = "url(img/"+tabArr[1][tab1].tagTable+"0.png)"; 
		navPos = _tab1;	//注释掉看看有没有影响，之前很多地方是用navPos来定位的，后来统一改为tab1了
		tab1 = _tab1;
		getID("nav" + tab1).style.color = "f7a333";
	//	getID("nav" + tab1).style.backgroundImage = "url(img/"+tabArr[1][tab1].tagTable+"1.png)"; 
		getID("vodTab1").scrollLeft = ( (tab1-2)>0 )?(tab1-2)*200:0;
		getID("searchHistoryCollect").style.display = "none";	//..隐藏搜索 历史 收藏 海报列表
		
		getID("vodList"+tab1).style.display = "block";	//	显示当前栏目 海报列表
	//	getID("vodTab").style.display = "block";
	//	showTab2and3( _tab1 );	//动态显示二三级分类
		clearTimeout(stLoad);	
		stLoad = setTimeout(function() {	// 	防止用户快速点击栏目，所以延时1秒再请求数据
			getTabData(_tab1,0,0,1,5);		//	请求数据，显示海报列表
		}, 1000);
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
		stbInfo();
		scrollDisable();		//禁止页面滚动
		showSplash();			//显示启动图片	
		bindEvent();			//绑定滑动事件

		clientWidth = document.body.scrollWidth;
		clientHeight = window.innerHeight;
		imgHeight = clientWidth*9/16+"px";
		getID('bodys').style.width = clientWidth + "px"; //全局宽

		showTab1();				//显示一级分类
		clickTab1(0);
		scrollTo(0,0)
		preLoadImages();
		changeTop();
	}

</script>

<body bgcolor="black" leftmargin="0" topmargin="0" onload="init();"  onScroll="scrollWindow();">
<div id="bodys" style="position:absolute;top:0px;left:0px;width:100%;display:block;">
	<div id="test" style="position:fixed;top:100px;left:0px;width:100%;max-height:900px;overflow:auto;line-height:100px;z-index:9999;background-color:white;font-size:100px;color:red;display:none;"></div>
	<!--非直播 -->
	<div id="vod" style="position:absolute;left:0px;width:100%;opacity:0;-webkit-transition:1s;">
		<!-- 顶部黑底 -->
		<div id="topBlack" style="position:fixed;width:100%;height:230px;background-color:black;z-index:1;"></div>
		<!-- 左上角头像 -->
		<div id="meImg" style="position:fixed;top:50px;left:50px;width:200px;height:100px;line-height:110px; background:url(img/vip.png) no-repeat;background-size:33% 100% !important; background-color:#000;color:white;font-size:40px;padding-left:100px;z-index:1;" onclick="showMe();">Oh!V</div>

		<!-- 搜索框 -->
		<input type="text" id="searchInput" class="homeTop" style="left:290px;top:-90px;width:370px;height:80px;line-height:80px;font-size:45px;text-align:center;border-radius:50px;background:transparent;color:white;-webkit-transition:1s;outline:none;" autofocus="autofocus" onclick="getID('searchInput').focus();window.androidJs.JsShowImm();" />

		<!-- 搜索图标 -->
		<div id="searchImg" style="position:fixed;top:65px;left:680px;width:80px;height:80px;z-index:1;" onclick="showSearchInput();getID('shcContent').innerHTML = '';"><img src="img/search0.png" /></div>

		<!-- 历史图标 -->
		<div id="historyImg" style="position:fixed;top:65px;left:820px;width:80px;height:80px;z-index:1;" onclick="showSHC('history',1,'h');getID('shcContent').innerHTML = '';"><img src="img/history0.png" /></div>

		<!-- 收藏图标 --
		<div-- style="position:fixed;top:65px;left:870px;width:80px;height:80px;z-index:1;" onclick="getID('h5video').muted=false;showSHC('collect',1,'c');getID('shcContent').innerHTML = '';"><img src="img/collect0.png" /></div-->

		<!-- 首页一级分类导航 -->
		<div id="tab1" class="homeTop" style="top:150px;left:5%;width:95%;">
			<ul id="vodTab1" class="tab-head">
				<!--li class="tab-tab1-item" id="nav0" onClick="clickTab1(0);" style="margin-left:15px;background: url(img/null.png) center no-repeat;">首页</li-->
			</ul>
			<div style="position:fixed;top:300px;left:5%;width:90%;height:0px;background-color:#333333;"></div>
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

		<!-- 点播 分类 列表 --
		<div id="vodList0" class="vodList" style="top:230px;">
			<div id="vodListContent0">
				<!--div id="vodListImg0" class="vodListImg" onClick="playVod(0);" ></div>
				<div id="vodListName0" class="vodListName"></div--
			</div>
			<div id="loading0" class="vodListName" style="width:100%;height:100px;background:url(img/loading2.gif) center center no-repeat; background-size:10% 30%;padding-top:200px;">loading</div>
			<div id="loadmore0" class="vodListName" style="height:100px;color:gray;"></div>
		</div-->
		
		<div id="promptCollect" class="promptCollect">已收藏</div>

	</div><!-- 点播尾 -->

	<!-- 主播 -->
	<div id="zhiBo" style="background-color:black;display:none;z-index:2;">	
		<div style="position:fixed;left:0px;top:0px;width:100%;height:2000px;background:url(./img/loading.gif);background-size:100% 100%;z-index:2;"></div>
		<div id="zhiBoContent"></div>
	</div>

	<!-- 搜索 历史 收藏 列表页 -->	
	<div id="searchHistoryCollect" class="homeList" style="top:230px;display:none;">
		<span id="shcTitle" style="position:relative;left:15%;color:#f7a333;">搜索结果</span>
		<div id="shcImg" style="background:url(img/null.png) no-repeat;background-size:100% 100% !important;" class="homeListLogo"></div>
		<div id="delHistoryCollect" style="left:85%;top:-190px;background:url(img/delete.png) no-repeat;background-size:80% 80% !important;display:block;" class="homeListLogo" onClick="deleteHistoryCollect();"></div>
		<div style="position:absolute;left:0%;top:110px;width:100%;">
			<div id="shcContent" ></div>
			<div id="loadingSHC" class="vodListName" style="width:100%;height:100px;background:url(img/loading2.gif) center center no-repeat; background-size:10% 30%;padding-top:200px;">loading</div>
			<div id="loadmoreSHC" class="vodListName" style="height:100px;color:gray;"></div>
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
	<div id="cardKey" style="position:absolute;top:0px;left:0px;width:100%;height:0px;background:linear-gradient(to bottom,black,white);display:none;text-align:center;font-size:80px;color:white; z-index:10;">
		<h1 id="title" style="position:absolute;left:0px;top:3%;width:100%;height:100px;text-align:center;font-size:90px;text-shadow:-5px 5px 5px #000;">Registered VIP Card</h1>

		<div style="position:absolute;left:5%;top:16%;width:90%;height:70px;font-size:60px;text-align:left;text-shadow:-5px 5px 5px #000;">Card Number</div>
		<!-- 卡号输入框 -->
		<input type="number" id="card_id" style="position:absolute;left:5%;top:21%;width:90%;height:100px;font-size:60px;text-align:center;border-radius:10px 10px 10px 10px;background:transparent;color:black;" maxlength="8" oninput="onInputHandler(event,'card_id')" autofocus="autofocus" onkeyup="value=value.replace(/[^-\d]/g,'')" />

		<div style="position:absolute;left:40%;top:21%;width:50%;height:100px;" onClick="getID('card_id').focus();window.androidJs.JsShowImm();"></div>

		<div style="position:absolute;left:5%;top:30%;width:90%;height:70px;font-size:60px;text-align:left;text-shadow:-5px 5px 5px #000;">PIN Code</div>
		<!-- 卡密输入框 -->
		<input type="number" id="card_key" style="position:absolute;left:5%;top:35%;width:90%;height:100px;font-size:60px;text-align:center;border-radius:10px 10px 10px 10px;background:transparent;color:black;" maxlength="8" oninput="onInputHandler(event,'card_key')" onkeyup="value=value.replace(/[^-\d]/g,'')" />

		<div style="position:absolute;left:40%;top:35%;width:50%;height:100px;" onClick="getID('card_key').focus();window.androidJs.JsShowImm();"></div>

		<div id="back" style="position:absolute;left:5%;top:45%;width:40%;line-height:120px;font-size:80px;text-align:center; border-radius:60px 60px 60px 60px;background:linear-gradient(to bottom,gray,white);color:gold;text-shadow:-5px 5px 5px #000;" onClick="back();"><b>back</b></div>

		<div id="ok" style="position:absolute;left:55%;top:45%;width:40%;line-height:120px;font-size:80px;text-align:center; border-radius:60px 60px 60px 60px;background:linear-gradient(to bottom,gray,white);color:gold;text-shadow:-5px 5px 5px #000;" onClick="checkInput()"><b>submit</b></div>

		<div id="img" style="position:absolute;left:5%;top:58%;width:90%;height:35%;background:url(img/vipCard.png) no-repeat;background-size:100% 100% !important;"></div>

		<div id="exp" style="position:absolute;left:13%;top:63%;width:77%;height:100px;color:gold;font-size:60px;text-align:left;text-shadow:0px 3px 3px gold;"></div>

		<div id="msg" style="position:absolute;left:5%;top:58%;width:90%;height:35%;text-align:center;font-size:70px;font-weight:900;border-radius:55px 55px 55px 55px;color:red;cursor:pointer;"></div>
	</div>

	<!-- 个人中心 -->
	<div id="me" style="position:absolute;top:0px;left:0px;width:100%;height:0px;background:linear-gradient(to bottom,black,white);display:none;text-align:center;font-size:80px;color:white; z-index:1;-webkit-transition:1s;">
		<h1 class="PersonalCenter" style="margin-top:15%;width:80%;text-align:center;font-size:90px;" id="titleMe" >Personal center</h1>
		<div id="usernameDiv">
			<div class="PersonalCenter" style="margin-top: 100px;">Username</div>
			<div class="PersonalCenterR" style="margin-top: 100px;" id="usernameH5" onclick="indexArea='login'">
				<input id="usernameInput" type="text" style="width:80%;text-align:center;border-radius:50px;background:transparent;outline:none;color:white;" maxlength="11" onkeyup="value=value.replace(/[\W]/g,'')" onkeydown="fncKeyStop(event)" onpaste="return false" oncontextmenu="return false" />		
			</div>
		</div>
	<!--	<div-- class="PersonalCenterR" style="margin-top: 100px;display:block;" id="usernameInputDiv">
			<input id="usernameInput" type="text" style="width:100%;text-align:center;border-radius:50px;background:transparent;outline:none;color:white;" maxlength="11" onkeyup="value=value.replace(/[\W]/g,'')" onkeydown="fncKeyStop(event)" onpaste="return false" oncontextmenu="return false" />
		</div-->
		<div class="PersonalCenter">Expire time</div>
		<div class="PersonalCenterR" id="expireTimeH5"></div>
		<div onclick="registedVipCard();">
			<div class="PersonalCenter">VIP</div>
			<div class="PersonalCenterR">></div>
		</div>
		<div onclick="share();" style="display:none;">
			<div class="PersonalCenter">Share</div>
			<div class="PersonalCenterR">></div>
		</div>
		<div onclick="getID('me').style.display='none';showSHC('history',1,'h');getID('shcContent').innerHTML = '';">
			<div class="PersonalCenter">History</div>
			<div class="PersonalCenterR">></div>
		</div>
		<div onclick="getID('me').style.display='none';showSHC('collect',1,'c');getID('shcContent').innerHTML = '';">
			<div class="PersonalCenter" >Collection</div>
			<div class="PersonalCenterR" >></div>
		</div>
		<!--div>
			<div class="PersonalCenter">Clear cache</div>
			<div class="PersonalCenterR">></div>
		</div-->
		<div id="speedDiv" onclick="changeDefaultSpeed();">
			<div class="PersonalCenter">Default speed</div>
			<div class="PersonalCenterR" id="defaultSpeed">1.0</div>
		</div>		
		<div id="promptMe" class="promptCollect" style="top:45%;">Success</div>
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

</div><!-- bodys尾 -->

<!-- 预加载图片 -->
<div id="preLoadImg" style="position: absolute;left:0px;top:0px;width:1px;height:1px;opacity:0;"></div>

</body></html>
<script type=text/javascript src="js/initS.js?v=3" charset=UTF-8></script>
<script type=text/javascript src="js/live.js?v=1"></script>
<script type=text/javascript src="js/touchMove.js?v=3" charset=UTF-8></script>
<script type=text/javascript src="js/searchHistoryCollect.js" charset=UTF-8></script>
<script>



</script>