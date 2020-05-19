//var sn = getCookie('sn');

var searchTemp = "";
function showSearchInput(){
    if( parseInt(getID('searchInput').style.top) < 0 ){
        indexArea = "search";
        getID('searchInput').style.top='60px';
        getID('searchInput').focus();
        window.androidJs.JsShowImm();
    }else{
        indexArea = "home";
        searchTemp = getID('searchInput').value;
        getID("shcContent").innerHTML = "";
        showSHC("search",1,searchTemp);
        getID('searchInput').blur();
    //    getID('searchInput').style.top= '-110px';	
    }
    st = setTimeout(function() {
            getID('searchInput').blur();
            getID('searchInput').style.top= '-110px';						
        }, 30000);
}

//	显示搜索 历史 收藏列表
var SHCimgArr = ["","",""];
function showSHC(_area,_pageNum,_key){
    indexArea = _area;
    pageNow = _pageNum;
    getID("nav" + navPos).style.color = "white"; 
    getID("nav" + navPos).style.backgroundImage = "url(img/"+tab1Arr["data"][navPos].channelName+"0.png)"; 
    getID("vodList"+tab1).style.display = "none";
    getID("vodTab").style.display = "none";
    getID("searchHistoryCollect").style.display = "block";
    getID('shcImg').style.backgroundImage = 'url(img/'+_area+'1.png)';
    getID("loadmoreSHC").innerHTML = "";
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
            vodPageAll = json.pageAll;
            if( vodPageAll == 0 && indexArea == "search"){						
                getID("loadmoreSHC").innerHTML = "•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;no more&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•";
            }
            var list = json.list;
            $.each(list,
                function(index, array) { //遍历json数据列
                    var id = array["id"];
                    var father = array['father'];
                    var poster = array['poster'];
                    if( father.length > 6){
                        var	father2 = '<marquee behavior="scroll" direction="left" width="100%" scrollamonut="100" scrolldelay="100">'+father +'</marquee>';
                    }else{
                        var father2 = father;
                    }
                    getID("shcContent").innerHTML += '<div class="listImg" style="background: url('+poster+')" onClick=showDetail("'+id+'")><div class="listName">'+father2+'</div></div>';
                });
            setTimeout(function() {
                changePageStatus = "t";
            }, 1000); // 加载完成后才将状态改为true
        },
        error: function() {
        	alert("error");
        }
    });
    
}