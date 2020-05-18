var episodes = 1;
//var episodePos = 0;
var from = "home";
var sn = getCookie('sn');
var id = 0;
var father = "";
var poster = "";
var isCollect = 0;  //默认0未收藏

function showDetail( _id ){
    scrollTops = document.body.scrollTop;   //先记录滚动了多少，回到上一级页面再滚回去 
    scrollTo(0, 0);                         //再滚到最顶
	if (typeof(window.androidJs) != "undefined") {
		window.androidJs.JsClosePlayer();
	}
    if( indexArea!="detail" ){  //详情页点击猜您喜欢，不改变from，这样回到首页才正常
        from = indexArea;
    }    
    indexArea = "detail";
    id = _id;

    getID("detail").style.display = "block";
    getID("vod").style.display = "none";
    if( from=="search" || from=="history" || from=="collect"){
        getID("searchHistoryCollect").style.display = "none";
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
			var videoType = json["data"].videoType;
			father = json["data"].videoName;
			poster = json["data"].imgUrl;      
			getID("detailName").innerHTML = father;
			getID("detailRegion").innerHTML = json["data"].showRegion;
			getID("detailTag").innerHTML = json["data"].videoTopic;
			getID("detailDescription").innerHTML = json["data"].videoBriefing;	
			

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
            if(isCollect==1){
                getID("collectImg").style.backgroundImage = 'url(img/collect1.png)';
            }else{
                getID("collectImg").style.backgroundImage = 'url(img/collect0.png)';
            }

            episodes = (json["data"].videoTvList==null)?1:json["data"].videoTvList.length;	//集数
			if( episodes>1){	//多集的才需显示选集
				var list = json["data"].videoTvList;
			//	list.sort(orderBy("videoSort"));	//选集排序乱序才需要
				getID("chooseChapterNum").innerHTML = "";
				$.each(list,
					function(index, array) { //遍历json数据列
					//	var id = array['id'];   //用于点击选集的播放
					//	var episode = list[index].videoSort+1;
						var playUrl = list[index].videoPath;

						getID("chooseChapterNum").innerHTML += '<div class="tab-chooseChapter-item" id=chooseChapter'+index+' onClick=playVod("'+id+'","'+playUrl+'","'+father+'","'+poster+'",'+index+','+videoType+');>'+(index+1)+'</div>';
						
					});
				getID("collectImg").style.top = "-120px";
			}else{
				getID("collectImg").style.top = "-160px";
			}

            initDetailArea();
            var episodePos = json["episodePos"];
			var playUrl = (videoType==2)?json["data"].videoPath:json["data"].videoTvList[episodePos]["videoPath"];
            playVod( id,playUrl,father,poster,episodePos,videoType ); 

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
                });  
        },
        error: function() {
            //	alert("error");
        }
    });
}

function initDetailArea(){
    if( episodes>1 ){
        getID("guess").style.top = "70px";
        getID("chooseChapter").style.display = "block";
    //    getID("chooseChapterNum").scrollLeft = ( (episodePos-5)>0 )?(episodePos-5)*100:0;
    }else{
        getID("guess").style.top = "-40px";
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

function changeCollect( ){
    getID("collectImg").style.backgroundImage = ( isCollect==0 )?'url(img/collect1.png)':'url(img/collect0.png)'; 
    isCollect = ( isCollect==0 )?1:0;
    getID("promptCollect").innerHTML = ( isCollect ==1 )?"<b>已收藏</b>":"<b>已取消收藏</b>";
    getID("promptCollect").style.opacity = 1;
    setTimeout(function() {
		getID("promptCollect").style.opacity = 0;
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


function orderBy(propertyName){
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










