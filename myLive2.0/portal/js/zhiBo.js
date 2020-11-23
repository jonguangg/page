
	var pageZhiBo = 0;//getCookie("pageZhiBo")?parseInt(getCookie("pageZhiBo")):0;
	var isZhiBo = false;
	var poster = "";

	function showZhiBoList(_pageNum){
		pageZhiBo += _pageNum;
		if( pageZhiBo*10 > zhiBoArr.length-1 ){
			pageZhiBo = 0;
			getID("zhiBoContent").innerHTML = "";
		}
		setCookie("pageZhiBo", pageZhiBo, '30m'); 
		changePageStatus = "f";
		for(i=0; i<10; i++){			
			poster = zhiBoArr[(i+pageZhiBo*10)].poster ;
			getID("zhiBoContent").innerHTML += '<div id=zhiBoImg'+(i+pageZhiBo*10)+' class="zhiBoImg" style="height:'+clientHeight+'px; background:url('+poster+')" onclick=playZhiBo("'+zhiBoArr[(i+pageZhiBo*10)].url+'") ><div class="zhiBoName">'+decodeURIComponent(zhiBoArr[(i+pageZhiBo*10)].title)+'</div></div>';			
			checkPoster( poster ,i+pageZhiBo*10);

		//	getID("zhiBoContent").innerHTML += '<div class="zhiBoImg" onclick=playZhiBo("'+zhiBoArr[i+pageZhiBo*10].url+'")><video id=zhiBo'+(i+pageZhiBo*10)+' width="100%" height='+clientHeight+'px'+' poster="'+zhiBoArr[(i+pageZhiBo*10)].poster+'" preload="auto" src='+zhiBoArr[i+pageZhiBo*10].url+' style="object-fit:fill"  x5-video-player-fullscreen="true" x5-video-orientation="landscape" x5-playsinline="true" playsinline="true" webkit-playsinline="true" x-webkit-airplay="true" ></video></div>';
		}
		setTimeout(function() {
			changePageStatus = "t";
		}, 1000); // 加载完成后才将状态改为true
	}
	
	//判断是否加载完成
	function checkPoster(url,_id){
		var img = new Image();
		img.src = url;
		img.onerror=function(){
			getID("zhiBoImg"+_id ).style.backgroundImage = 'url("./img/loading.gif")';
		}
	}

	function playZhiBo(_playUrl){
	//	alert(_playUrl);
		isZhiBo = true;
		window.androidJs.JsPlayZhiBo(_playUrl,screen.availHeight*window.devicePixelRatio);
	}
