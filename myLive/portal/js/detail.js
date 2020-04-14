var episodes = 1;
var episodePos = 1;
var from = "home";
var sn = getCookie('sn');
var detailId = 0;
var father = "";
var isCollect = 0;  //默认0未收藏


function showDetail( _father ){
    from = indexArea;
    indexArea = "detail";
    father = _father;
    getID("detail").style.display = "block";
    getID("vod").style.display = "none";
    if( from=="search" || from=="history" || from=="collect"){
        getID("searchHistoryCollect").style.display = "none";
    }
//    alert(from);
    $.ajax({
        type: 'POST',
        url: './readDetailJson.php',
        data: {
            'father': _father,
            'sn':sn,
        },
        dataType: 'json',
        beforeSend: function() {
            //这里一般显示加载提示;
        },
        success: function(json) {
            var list = json.list;
            var guess = json.guess;
            var detailName = json.detailName;
            var detailDirector = json.detailDirector;
            var detailActor = json.detailActor;
            var detailYear = json.detailYear;
            var detailRegion = json.detailRegion;
            var detailDuration = json.detailDuration.slice(0,8);
            var detailScore = json.detailScore;
            var detailTag = json.detailTag;
            var detailDescription = json.detailDescription;
            detailId = json.detailId;
            episodePos = json.episodePos;            
            episodes = json.detailEpisodes;
            isCollect = json.isCollect;
            if(isCollect==1){
                getID("collectImg").style.backgroundImage = 'url(img/collect1.png)';
            }else{
                getID("collectImg").style.backgroundImage = 'url(img/collect0.png)';
            }
            
            getID("detailName").innerHTML = detailName;
            getID("detailDirector").innerHTML = detailDirector;
            getID("detailActor").innerHTML = detailActor;
            getID("detailYear").innerHTML = detailYear;
            getID("detailRegion").innerHTML = detailRegion;
            getID("detailDuration").innerHTML = detailDuration;
            getID("detailScore").innerHTML = detailScore;
            getID("detailTag").innerHTML = detailTag;
            getID("detailDescription").innerHTML = detailDescription;

            getID("chooseChapterNum").innerHTML = "";
            $.each(list,
                function(index, array) { //遍历json数据列
                    var detailId = array['id'];
                //    var name = array['name'].slice(array['name'].lastIndexOf('/') + 1);
                    var episode = array['episode'];
                //    name = "http://tenstar.synology.me:10025/myLive/vod/" + name.slice(0,name.lastIndexOf('.') ) + "/index.m3u8";
                    getID("chooseChapterNum").innerHTML += '<div class="tab-chooseChapter-item" id=chooseChapter'+index+' onClick=playVod('+index+','+detailId+');>'+episode+'</div>';
                    
                });

            getID("guesses").innerHTML = "";
            $.each(guess,
                function(index, array) { //遍历json数据列
                //  var guessId = array['id'];                    
                    var name = array['name'].slice(array['name'].lastIndexOf('/') + 1);
                    var father = array['father'];
                    name = name.slice(0,name.lastIndexOf('.') );   
                    if( father.length > 6){
                        var	father2 = '<marquee behavior="scroll" direction="left" width="100%" scrollamonut="100" scrolldelay="100">'+father +'</marquee>';
                    }else{
                        var father2 = father;
                    }                 

                    getID("guesses").innerHTML += '<div class="tab-guess-item" style="background: url(../vod/'+name+'/'+name+'.jpg)" onClick=showDetail("'+father+'")><div class="tab-guessName">'+father2+'</div></div>';
                    
                });

            initDetailArea();
            playVod( episodePos-1 ,detailId);   //集数是从1开始，id从0开始，所以减1
        },
        error: function() {
            //	alert("error");
        }
    });
    scrollTo(0, 0);
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

    $.ajax({
        type: 'POST',
        url: './collect.php',
        data: {
            'id':detailId,
            'sn':sn,
            'father': father,
            'isCollect': isCollect,
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












