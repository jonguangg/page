var episodes = 1;
var episodePos = 0;
var from = "home";
//sn = (getCookie('sn') && getCookie('sn').length>0)?getCookie('sn'):"";
//alert("detail"+sn);
var id = 0;
var father = "";
var poster = "";
var isCollect = 0;  //默认0未收藏
var list = [];
function showDetail( _id ){
    getID("loading").style.display = "block";
//  getID("detail").style.display = "none"; //这是为了点击猜您喜欢后详情马上消失
    getID("detail").style.left = "-2000px"; //这是为了获取到数据后从左边进入的效果
    getID("detailPoster").style.height = clientWidth*9/16+"px";
    if( indexArea=="detail"){
        updateCurrentTime();                //点击猜您喜欢时记录当前播放位置
    }
    scrollTops = document.body.scrollTop;   //先记录滚动了多少，回到上一级页面再滚回去 
	if (typeof(window.androidJs) != "undefined") {
		window.androidJs.JsClosePlayer();
	}else{        
        getID("h5video").src = "";
    }
    if( indexArea!="detail" ){  //详情页点击猜您喜欢，不改变from，这样回到首页才正常
        from = indexArea;
    }    
    indexArea = "detail";
    id = _id;
   
    if( from=="search" || from=="history" || from=="collect"){
        getID("searchHistoryCollect").style.display = "none";
    //    alert("隐藏搜索历史收藏");
    }
    $.ajax({
        type: 'POST',
        url: './getXuDataDetail.php',
        data: {
            'id': _id,
            'sn':sn,
        },
        dataType: 'json',
        beforeSend: function() {
            //这里一般显示加载提示;
        },
        success: function(json) {
        //    console.log(json);                        //滚到最顶
            currentTime = json["currentTime"];  //  视频上次播放的位置
            getID("vod").style.opacity = 0;
            getID("detail").style.display = "block";
            setTimeout(function(){getID("vod").style.display = "none";},1000); 
            setTimeout(function() {
                getID("detail").style.left = "0px";
                scrollTo(0, 0); 
            }, 100);
            
			var videoType = json["data"].videoType;
			father = json["data"].videoName;
			poster = json["data"].imgUrl;      
			getID("detailName").innerHTML = father;//"<&ensp;"+father;
			getID("detailDescription").innerHTML = json["data"].videoBriefing;	
			
			if( json["data"].showRegion==null ){
				getID("region").style.display = "none";
			}else{
				getID("region").style.display = "block";
				getID("detailRegion").innerHTML = json["data"].showRegion;
			}
			
			if( json["data"].videoTopic==null ){
				getID("tab").style.display = "none";
			}else{
				getID("tab").style.display = "block";
				getID("detailTab").innerHTML = json["data"].videoTopic;
			}
			
			if( json["data"].tostar==null ){
				getID("actor").style.display = "none";
			}else{
				getID("actor").style.display = "block";
				getID("detailActor").innerHTML = json["data"].tostar;
			}

			if( json["data"].director==null ){
				getID("director").style.display = "none";
			}else{
				getID("director").style.display = "block";
				getID("detailDirector").innerHTML = json["data"].director;
			}

			if( json["data"].showTime==null){
				getID("year").style.display = "none";
			}else{
				getID("year").style.display = "block";
				getID("detailYear").innerHTML = json["data"].showTime;
			}
								
			if(json["data"].videoLength==null){
				getID("duration").style.display = "none";
			}else{
				getID("duration").style.display = "block";
				getID("detailDuration").innerHTML = json["data"].videoLength;
			}
				
			if(json["data"].imdbScore==null){
				getID("score").style.display = "none";				
			}else{
				getID("score").style.display = "block";	
				getID("detailScore").innerHTML = json["data"].imdbScore;
			}				
					
            isCollect = json["isCollect"];
        //    alert(json["urlXuGuess"]);
            if(isCollect==1){
            //    getID("collectImg").style.backgroundImage = 'url(img/collect1.png)';
                getID("collectImg").src = 'img/collect1.png';
            }else{
            //    getID("collectImg").style.backgroundImage = 'url(img/collect0.png)';
                getID("collectImg").src = 'img/collect0.png';
            }

            episodes = (json["data"].videoTvList==null)?1:json["data"].videoTvList.length;	//集数
			if( episodes>1){	//多集的才需显示选集
				list = json["data"].videoTvList;
			//	list.sort(orderBy("videoSort"));	//选集排序乱序才需要
				getID("chooseChapterNum").innerHTML = "";
				$.each(list,
					function(index, array) { //遍历json数据列
					//	var id = array['id'];   //用于点击选集的播放
					//	var episode = list[index].videoSort+1;
						var playUrl = list[index].videoPath;

						getID("chooseChapterNum").innerHTML += '<div class="tab-chooseChapter-item" id=chooseChapter'+index+' onClick=playVod("'+id+'","'+playUrl+'","'+father+'","'+poster+'",'+index+','+episodes+');>'+(index+1)+'</div>';						
					});
			//	getID("collectImg").style.top = "-360px";
			}else{
			//	getID("collectImg").style.top = "-360px";
			}

            initDetailArea();
            episodePos = json["episodePos"];
			var playUrl = (videoType==2)?json["data"].videoPath:json["data"].videoTvList[episodePos]["videoPath"];
            playVod( id,playUrl,father,poster,episodePos,episodes ); 

            var guess = json["guess"];
            getID("guesses").innerHTML = "";
            $.each(guess,
                function(index, array) { //遍历json数据列
                    var id = guess[index].id;
                    var name = guess[index].videoName;
					var poster = guess[index].imgUrl;
                    if( name.length > 6){
                        var	name = '<marquee behavior="scroll" direction="left" width="100%" scrollamonut="100" scrolldelay="100">'+name +'</marquee>';
                    }
                    getID("guesses").innerHTML += '<div class="tab-guess-item" style="background: url('+poster+')" onClick=showDetail("'+id+'")><div class="tab-guessName">'+name+'</div></div>';
                }
            );
            if( isGuideDetail==1 ){
                scrollDisable();
                getID("guide").style.display = "block";
                getID("redArrow").style.display = "none";
                getID("guideContent").innerHTML = (language=="c")?"<br>在视频区域向任意方向滑动<br>在主演上方左右滑动<br>在视频下方向下滑动<br>均可离开当前页面<br>&ensp;":"Slide to any direction<br>in the video area<br>Slide left or right up the actor<br>Slide down in the video below<br>Can also back";
            }else{
                getID("guide").style.display = "none";
            }
		    getID("loading").style.display = "none";
        },
        error: function() {
            //	alert("error");
        }
    });
}

function initDetailArea(){
    if( episodes>1 ){
        getID("guess").style.top = "100px";
        getID("chooseChapter").style.display = "block";
    }else{
        getID("guess").style.top = "0px";
        getID("chooseChapter").style.display = "none";
    }
}

function moreDescription(){	//展开或收缩影片简介全文
    if( getID("description").style.maxHeight == "150px"){
        getID("description").style.maxHeight = "10000px";
    }else{
        getID("description").style.maxHeight = "150px";
    }
}
function moreZoneRemark(){
    if( getID("zoneRemark").style.maxHeight == "250px"){
        getID("zoneRemark").style.maxHeight = "10000px";
    }else{
        getID("zoneRemark").style.maxHeight = "250px";
    }
}
function moreZoneRemarkC(){
    if( getID("zoneRemarkC").style.maxHeight == "250px"){
        getID("zoneRemarkC").style.maxHeight = "10000px";
    }else{
        getID("zoneRemarkC").style.maxHeight = "250px";
    }
}

function changeCollect( ){
    getID("collectImg").src = ( isCollect==0 )?'img/collect1.png':'img/collect0.png'; 
    isCollect = ( isCollect==0 )?1:0;
    getID("promptCollect").innerHTML = ( isCollect ==1 )?"<b>已收藏</br>":"<b>已取消收藏</b>";
    getID("promptCollect").style.opacity = 1;
    getID("promptCollect").style.display = "block";
    setTimeout(function() {
        getID("promptCollect").style.opacity = 0;
        getID("promptCollect").style.display = "none";
	}, 1500);
//	alert(sn+"_"+id+"_"+father+"_"+poster);
    $.ajax({
        type: 'POST',
        url: './collectXu.php',
        data: {
            'id':id,
            'sn':sn,
			'father':father,
			'poster':poster,
            'isCollect': isCollect
        },
        dataType: 'json',
        beforeSend: function() {
            //这里一般显示加载提示;
        },
        success: function(json) {
        //    alert("success");        
        },
        error: function() {
        //    alert("error");
        }
    });
}

function orderBy(propertyName){ //  选集排序乱序才需要
    return function(object1,object2){
        var value1 = object1[propertyName];
        var value2 = object2[propertyName];
        if(value1 < value2){
            return -1;
        }else if(value1 > value2){
            return 1;
        }else{
            return 0;
        }
    }
}

function updateCurrentTime(){   //  更新播放视频位置进数据库
    if( typeof(window.androidJs) != "undefined") {
	    currentTime = window.androidJs.JsCurrentPosition();
	}else{
        currentTime = Math.floor(getID("h5video").currentTime);
    }
    if( id == 0 || currentTime==0 ){
        return;
    }
    $.ajax({
        type: 'POST',
        url: './writeCurrentTimeXu.php',
        data: {
            'sn':sn,
            'id':id,
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
        //	alert("写入失败!");
        }
    });
}

function changeSpeedH5(){
    if( typeof(window.androidJs) == "undefined" ){
        if( speed<2.5 ){
            speed += 0.25;
        }else{
            speed = 0.5;
        }
        setCookie("speed",speed,"30d");
        getID('h5video').playbackRate = speed;
        getID("speedNum").innerHTML = speed;
    }
}