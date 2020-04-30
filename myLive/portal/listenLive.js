var startTime = 0;
var lastGroupId = "0";
var lastGroupName = "";
var lastChannelId = "0";
var lastChannelName = "";
var lastUrl = "";
var listenNum = 0;

function listenLive(){	//每10秒换一个台
	startTime =  (new Date()).valueOf();
	lastGroupId = listenArr[0].groupId;
	lastGroupName = listenArr[0].groupName;
	lastChannelId = listenArr[0].channelId;
	lastChannelName = listenArr[0].channelName;
	lastUrl = listenArr[0].videoUrl;
	listenNum ++;
	getID("test").style.display = "block";
	getID("test").innerHTML = listenNum+"<br>"+lastUrl;
	window.androidJs.JsPlayLive( lastUrl );
	listenArr.splice(0,1);	//将数组第一个元素删除，下次再从新数组第1个开始检测
	if( listenArr.length == 0 ){
		alert("检测完成"+listenNum+"个");
	}else{
		st = setTimeout(function() {
			listenLive();
		}, 120000); //这个时间设太短会获取不到状态，因为app只发成功或失败的状态，如果设定时间内一直在加载中，则获取不到状态码
	}
}

setTimeout(function() {//启动后10秒开始检测
	listenLive();
}, 10000); 

var lastUrlArr = [];
function androidPlayState(_sta){
	if( lastUrlArr.indexOf(lastUrl)==-1 ){ //如果没写过记录才发ajax写记录
		$.ajax({
			type: 'POST',
			url: './listenLive.php',
			data: {
				'groupId': lastGroupId,
				'groupName': lastGroupName,
				'channelId': lastChannelId,
				'channelName':lastChannelName,
				'playUrl': lastUrl,
				'playState': _sta,
				'startTime': startTime,
			},
			dataType: 'json',
			beforeSend: function() {
				//这里一般显示加载提示;
			},
			success: function(json) {
			//	alert("success");
			},
			error: function() {
			//	alert("error");
			}
		});
		lastUrlArr.push(lastUrl);
		clearTimeout(st);
		listenLive();
	}
}	