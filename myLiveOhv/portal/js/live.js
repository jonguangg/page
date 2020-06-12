	var groupId = (typeof(window.androidJs) != "undefined") ? parseInt(window.androidJs.JsGetCookie("groupId", 0)) : 0;
	var channelPagePos = (typeof(window.androidJs) != "undefined") ? parseInt(window.androidJs.JsGetCookie("channelPagePos", 0)) : 0;
	var channelPos = (typeof(window.androidJs) != "undefined") ? parseInt(window.androidJs.JsGetCookie("channelPos", 0)) : 0;
	var channelCount = 0;
	var channelPageAll = parseInt((channelCount - 1 + 10) / 10);
//	var channelPagePosTemp = 0;
//	var channelPosTemp = channelPos;
	var channelArr = [];
	var videoUrlCookie = 0; //( window.androidJs.JsGetCookie("videoUrlCookie",0)=='0' )?channelDataArr[0].channel[0].videoUrl:window.androidJs.JsGetCookie("videoUrlCookie",0);

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
		for (i = 0; i < channelDataArr.length; i++) { //显示频道组
			getID("groups").innerHTML += '<li class=tab-live-item id=group' + i + ' style="font-weight:500" onClick=showChannel(' + i + ');></li>';
			getID("group" + i).innerHTML = channelDataArr[i].group;
		}
		channelPos = (groupId == _num)?channelPos:0;	//如果回上次看的组，则不变频道，否则播放第1个
		tab1 = -1;	//当前区域定为直播
		groupId = _num;
		showChannel(groupId); 
		getID("vod").style.display = "none";
		getID("channel").style.display = "block";
		getID("channel" + channelPos).style.color = "#f7a333";
		getID("channelId" + channelPos).style.color = "#f7a333";

	//	getID("liveVideoDiv").style.height = (clientWidth * 9 / 16 - 1) + "px";	//视频窗口
		getID('liveVideo').height = (window.orientation==0)?clientWidth*9/16:clientWidth-120;
		getID("group").style.top = (window.orientation==0)?(clientWidth * 9 / 16 - 1)+"px":(clientWidth-120)+"px"; 			//频道组
		getID("channels").style.top = (clientWidth * 9 / 16 + 90) + "px";		 //频道列表		

	//	if (parseInt(intLoginTime) < parseInt(intExpireTime)) { //授权没过期
			if (typeof(window.androidJs) != "undefined") {
				window.androidJs.JsPlayLive(channelTempArr[channelPos].videoUrl);
				window.androidJs.JsSetPageArea("live");
			//	window.androidJs.JsMovePlayerWindow(0);	//2.0版小窗口固定在上方，不需移动
			}else{
				getID("liveVideo").src = channelTempArr[channelPos].videoUrl;			
				getID("liveVideo").addEventListener("play",function(){
			//	getID("liveVideo").muted = (isAndroid)?false:true;
				getID("liveVideo").muted = false;
				},false);
			}
	//	}		
		groupScrollL = (groupId - 1) * 150;//大概两个汉字150，4个汉字300
		getID("groups").scrollLeft = groupScrollL;
		indexArea = "live";
	}

	function startLive(_num) {	//播放直播频道
		if (parseInt(intLoginTime) > parseInt(intExpireTime)) { //授权已过期
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
	//	scrollTo(0, 0);
		getID("channel").style.left = "0px";
		getID("channels").innerHTML = "";
		getID("channels").scrollTop = 0;
		for (i = 0; i < channelTempArr.length; i++) {
			getID("channels").innerHTML += '<div id=channels' + i + ' class="channels" onClick=startLive(' + i + ');><div id=channelId' + i + ' class="channelID" ><img class="liveListImg" src=live/'+channelTempArr[i].channelLogo+' /><div class="liveLine" ></div></div><div id=channel' + i + ' class="channel"></div></div>';
			getID('channel' + i).innerText = channelTempArr[i].name.slice(0, 50);
		}
	}