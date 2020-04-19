
	var pageZhiBo = getCookie("pageZhiBo")?parseInt(getCookie("pageZhiBo")):0;
	var isZhiBo = false;

	function showZhiBoList(_pageNum){
		pageZhiBo += _pageNum;
		if( pageZhiBo*10 > zhiBoArr.length-1 ){
			pageZhiBo = 0;
			getID("zhiBo").innerHTML = "";
		}
		setCookie("pageZhiBo", pageZhiBo, '30m'); 
		changePageStatus = "f";
		for(i=0; i<10; i++){
			getID("zhiBo").innerHTML += '<div class="zhiBoImg" style="height:'+clientHeight+'px; background:url('+zhiBoArr[(i+pageZhiBo*10)].poster+')" onclick=playZhiBo("'+zhiBoArr[(i+pageZhiBo*10)].url+'") ><div class="zhiBoName">'+decodeURIComponent(zhiBoArr[(i+pageZhiBo*10)].title)+'</div></div>';

		//	getID("zhiBo").innerHTML += '<div class="zhiBoImg" onclick=playZhiBo("'+zhiBoArr[i+pageZhiBo*10].url+'")><video id=zhiBo'+(i+pageZhiBo*10)+' width="100%" height='+clientHeight+'px'+' poster="'+zhiBoArr[(i+pageZhiBo*10)].poster+'" preload="auto" src='+zhiBoArr[i+pageZhiBo*10].url+' style="object-fit:fill"  x5-video-player-fullscreen="true" x5-video-orientation="landscape" x5-playsinline="true" playsinline="true" webkit-playsinline="true" x-webkit-airplay="true" ></video></div>';
		}
		setTimeout(function() {
			changePageStatus = "t";
		}, 1000); // 加载完成后才将状态改为true
	}

	function playZhiBo(_playUrl){
	//	alert(_playUrl);
		isZhiBo = true;
		window.androidJs.JsPlayZhiBo(_playUrl);
	}