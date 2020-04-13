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
    //    alert(getID('searchInput').value );
        searchTemp = getID('searchInput').value;
        showSHC("search",1,searchTemp);
        getID('searchInput').blur();
        getID('searchInput').style.top= '-110px';	
    }
    st = setTimeout(function() {
            getID('searchInput').blur();
            getID('searchInput').style.top= '-110px';						
        }, 60000);
}

//	显示搜索 历史 收藏列表
function showSHC(_area,_pageNum,_key){
    indexArea = _area;
    pageNow = _pageNum;
    getID("nav" + navPos).style.color = "white"; 
    getID("nav" + navPos).style.backgroundImage = "url(img/"+tagArr[1][navPos].tagTable+"0.png)"; 
    getID("vodList"+tag1).style.display = "none";
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
        url: './readSearchHistoryCollectJson.php',
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
            var list = json.list;
            $.each(list,
                function(index, array) { //遍历json数据列
                    var name = array['name'].slice(array['name'].lastIndexOf('/') + 1);
                    var father = array['father'];
                    name = name.slice(0,name.lastIndexOf('.') );
                //	alert(name);
                    if( father.length > 6){
                        var	father2 = '<marquee behavior="scroll" direction="left" width="100%" scrollamonut="100" scrolldelay="100">'+father +'</marquee>';
                    }else{
                        var father2 = father;
                    }
                    getID("shcContent").innerHTML += '<div class="listImg" style="background: url(../vod/'+name+'/'+name+'.jpg)" onClick=showDetail("'+father+'")><div class="listName">'+father2+'</div></div>';
                });

            vodPageAll = json.pageAll;
            if( vodPageAll == 0 || pageNow == vodPageAll){						
                getID("loadmoreSHC").innerHTML = "•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;no more&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•";
            }
            setTimeout(function() {
                changePageStatus = "t";
            }, 1000); // 加载完成后才将状态改为true
        },
        error: function() {
        	alert("error");
        }
    });
    
}