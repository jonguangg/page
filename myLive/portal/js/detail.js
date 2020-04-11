var episodes = 1;
var episodesPos = 2;
var from = "home";
var listArrTemp = [];

function showDetail( _father ){
    from = indexArea;
//    alert(from);
    indexArea = "detail";
    getID("detail").style.display = "block";
    getID("vod").style.display = "none";
    $.ajax({
        type: 'POST',
        url: '../readDetailJson.php',
        data: {
            'father': _father,
        },
        dataType: 'json',
        beforeSend: function() {
            //这里一般显示加载提示;
        },
        success: function(json) {
            var list = json.list;
            var detailName = json.detailName;
            var detailDirector = json.detailDirector;
            var detailActor = json.detailActor;
            var detailYear = json.detailYear;
            var detailRegion = json.detailRegion;
            var detailDuration = json.detailDuration.slice(0,8);
            var detailScore = json.detailScore;
            var detailTag = json.detailTag;
            var detailDescription = json.detailDescription;
            episodes = json.detailEpisodes;
            
            getID("detailName").innerHTML = detailName;
            getID("detailDirector").innerHTML = detailDirector;
            getID("detailActor").innerHTML = detailActor;
            getID("detailYear").innerHTML = detailYear;
            getID("detailRegion").innerHTML = detailRegion;
            getID("detailDuration").innerHTML = detailDuration;
            getID("detailScore").innerHTML = detailScore;
            getID("detailTag").innerHTML = detailTag;
            getID("detailDescription").innerHTML = detailDescription;

            listArrTemp = [];
            getID("chooseChapterNum").innerHTML = "";
            $.each(list,
                function(index, array) { //遍历json数据列
                    var name = array['name'].slice(array['name'].lastIndexOf('/') + 1);
                    var episode = array['episode'];
                    name = "http://tenstar.synology.me:10025/myLive/vod/" + name.slice(0,name.lastIndexOf('.') ) + "/index.m3u8";
                    listArrTemp.push(name);
                    getID("chooseChapterNum").innerHTML += '<div class="tab-chooseChapter-item" onClick=playVod('+index+');>'+episode+'</div>';
                });

            initDetailArea();
            playVod( 0 );
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
        getID("chooseChapterNum").scrollLeft = episodesPos*100;    
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












