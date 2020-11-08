//var sn = getCookie('sn');

var searchHistoryNum = ( getCookie("searchHistoryNum") )?getCookie("searchHistoryNum"):0;
var searchHistoryArr = [];
var searchTemp = "";

function showSearchInput(){
    getID('shcImg').style.backgroundImage = 'url(img/null.png)';
    getID('shcTitle').innerHTML = "";
    if( parseInt(getID('searchInput').style.top) < 0 ){
        indexArea = "search";
        getID('searchInput').style.top='60px';
        getID('searchInput').focus();
        getID("vodList"+tab1).style.display = "none";
        getID("loadingSHC").style.display = "none";
        getID("vodTab").style.display = "none";
        getID("hotSearch").style.display = "block";
        getID("searchHistory").style.display = "block";
        getID("searchHistoryCollect").style.display = "block";
        for(i=0;i<8;i++){
            getID("hotSearch"+i).innerHTML = hotSearchArr[i].name;
        }
        if( searchHistoryNum>0){
            getID("searchHistoryContent").innerHTML = "";
            for(j=0;j<searchHistoryNum;j++){
                var tempSearchHistory = getCookie("searchHistory"+j);
                getID("searchHistoryContent").innerHTML += '<span id=searchHistory'+j+' onclick=submitSearchHistory('+j+')>'+tempSearchHistory+'</span>&emsp;';
                searchHistoryArr.push(tempSearchHistory);
            }
        }else{
            getID("searchHistory").style.display = "none";
        }
    }else{
        indexArea = "home";
        searchTemp = getID('searchInput').value;
        getID("shcContent").innerHTML = "";
    //    getID("loadingSHC").style.display = "block";
        showSHC("search",1,searchTemp);
        getID('searchInput').blur();
    //    getID('searchInput').style.top= '-110px';	//  提交搜索后输入框马上消失
    }
    st = setTimeout(function() {
            getID('searchInput').blur();
            getID('searchInput').style.top= '-110px';
            getID('searchInput').value = "";					
        }, 30000);
}

function submitHotSearch(_num){
    getID("shcContent").innerHTML = "";
    showSHC("search",1,hotSearchArr[_num].name);
    scrollTo(0,0);
}

function submitSearchHistory(_num){
    getID("shcContent").innerHTML = "";
    showSHC("search",1,getID("searchHistory"+_num).innerText);
    scrollTo(0,0);
}

function deleteSearchHistory(){
    getID("searchHistoryContent").innerHTML = "";
    searchHistoryArr = [];
    searchHistoryNum = 0;
    delCookie("searchHistoryNum");
    for(k=0;k<searchHistoryNum;k++){
        delCookie("searchHistory"+k);
    }
    getID("searchHistory").style.display = "none";
}

//	显示搜索 历史 收藏列表
function showSHC(_area,_pageNum,_key){
    scrollEnable();
    indexArea = _area;
    pageNow = _pageNum;
    getID("nav" + tab1).style.color = "white"; 
    getID("nav" + tab1).style.backgroundImage = "url(img/"+tab1Arr["data"][tab1].channelName+"0.png)"; 
    getID("vodList"+tab1).style.display = "none";
    getID("vodTab").style.display = "none";
    getID("searchHistoryCollect").style.display = "block";
    getID('shcImg').style.backgroundImage = 'url(img/'+_area+'1.png)';
    getID("loadmoreSHC").innerHTML = "";
    getID("loadingSHC").style.display = "block";
    if( _area=="search" ){
        getID('shcTitle').innerHTML = "搜索结果";
    }else if( _area=="history" ){
        getID('shcTitle').innerHTML = "播放历史";
    }else if( _area=="collect" ){
        getID('shcTitle').innerHTML = "我的收藏";
    }
    if(_key=="0"){
        return ;
    }
    $.ajax({
        type: 'POST',
        url: './readSearchHistoryCollectXu.php',
        data: {
            'area': _area,
            'pageNow': _pageNum,
            'key': _key,
            'sn':sn,
        },
        dataType: 'json',
        beforeSend: function() {
            //这里一般显示加载提示;
        },
        success: function(json) {
            if(_key.length>0 && searchHistoryArr.indexOf(_key)==-1){
                setCookie("searchHistory"+searchHistoryNum,_key,"30d");
                getID("searchHistoryContent").innerHTML += '<span id=searchHistory'+searchHistoryNum+' onclick=submitSearchHistory('+searchHistoryNum+')>'+_key+'</span>&emsp;';
                searchHistoryNum ++;
                setCookie("searchHistoryNum",searchHistoryNum,"30d");
                getID("searchHistory").style.display = "block";
                searchHistoryArr.push(_key);
            }
            
            if( indexArea == "search"){
                getID("hotSearch").style.display = "block";
                vodPageAll = json.pages;
                if( vodPageAll == 0 ){
                    getID("loadmoreSHC").innerHTML = "•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;no more&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•";
                    getID("loadingSHC").style.display = "none";
                    return;
                }else if( vodPageAll == pageNow ){
                    getID("loadmoreSHC").innerHTML = "•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;no more&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•";
                    getID("loadingSHC").style.display = "none";
                }
                var list = json.records;
                $.each(list,
                    function(index, array) { //遍历json数据列
                        var id = array["id"];
                        var name = array['videoName'];
                        var poster = array['imgUrl'];
                        if( name.length > 7){
                            name = '<marquee behavior="scroll" direction="left" width="100%" scrollamonut="100" scrolldelay="100">'+name +'</marquee>';
                        }
						var score = (array["imdbScore"]==undefined)?"":array["imdbScore"];
						var scoreBg = (array["imdbScore"]==undefined)?"img/null.png":"img/scoreBg.png";
                        getID("shcContent").innerHTML += '<div class="listImg" style="background: url('+poster+')" onClick=getID("h5video").muted=false;showDetail("'+id+'")><div class="tab-score" style="background-image:url('+scoreBg+')">'+score+'</div><div class="listName">'+name+'</div></div>';
                    });	
                setTimeout(function() {
                    changePageStatus = "t";
                }, 1000); // 加载完成后才将状态改为true
            }else{
                getID("hotSearch").style.display = "none";
                getID("searchHistory").style.display = "none";
                vodPageAll = json.pageAll;
                if( vodPageAll == 0 ){
                    getID("loadmoreSHC").innerHTML = "•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;no more&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•";
                    getID("loadingSHC").style.display = "none";
                    return;
                }else if( vodPageAll == pageNow ){
                    getID("loadmoreSHC").innerHTML = "•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;no more&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•";
                    getID("loadingSHC").style.display = "none";
                }
                var list = json.list;
                $.each(list,
                    function(index, array) { //遍历json数据列
                        var id = array["id"];
                        var father = array['father'];
                        var poster = array['poster'];
                        if( father.length > 7){
                            father = '<marquee behavior="scroll" direction="left" width="100%" scrollamonut="100" scrolldelay="100">'+father +'</marquee>';
                        }
						var score = (array["imdbScore"]==undefined)?"":array["imdbScore"];
						var scoreBg = (array["imdbScore"]==undefined)?"img/null.png":"img/scoreBg.png";
                        getID("shcContent").innerHTML += '<div class="listImg" style="background: url('+poster+')" onClick=getID("h5video").muted=false;showDetail("'+id+'")><div class="tab-score" style="background-image:url('+scoreBg+')">'+score+'</div><div class="listName">'+father+'</div></div>';
                    });
                setTimeout(function() {
                    changePageStatus = "t";
                }, 1000); // 加载完成后才将状态改为true
            }
        },
        error: function() {
        //	alert("error");
        }
    });    
}