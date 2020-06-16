//var sn = getCookie('sn');

var searchTemp = "";
function showSearchInput(){
    if( parseInt(getID('searchInput').style.top) < 0 ){
        indexArea = "search";
        getID('searchInput').style.top=(typeof(window.androidJs)=="undefined")?"20px":'60px';
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
function showSHC(_area,_pageNum,_key){    
	console.log(collectArr);
    scrollEnable();
    indexArea = _area;
    pageNow = _pageNum;
    getID("nav" + navPos).style.color = "white"; 
//    getID("nav" + navPos).style.backgroundImage = "url(img/"+tabArr[1][navPos].tagTable+"0.png)"; 
    getID("vodList"+tab1).style.display = "none";
//    getID("vodTab").style.display = "none";
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
            vodPageAll = json.pageAll;
            if( vodPageAll == 0 && indexArea == "search"){						
                getID("loadmoreSHC").innerHTML = "•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;no more&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•&nbsp;•";
            }
            var list = json.list;
            $.each(list,
                function(index, array) { //遍历json数据列
                    var id = array["id"];
                    var name = array['name'].slice(array['name'].lastIndexOf('/') + 1);
                    var father2 = array['father'];
                    name = name.slice(0,name.lastIndexOf('.') );
                    var playUrl = "http://158.69.108.183:8080/myLiveOhv/vod/"+name+"/index.m3u8";
                    var collectImg = (collectArr.includes(id))?"img/collect1.png":"img/collect0.png";
                    if( typeof(window.androidJs) != "undefined"){
                        getID("shcContent").innerHTML += '<div id=videoImg'+id+' class="vodListImg" style="height:'+imgHeight+';background:url(../vod/'+name+'/poster.jpg)" ><div style="float:left;left:0px;top:0px;width:80%;height:100%;" onClick=window.androidJs.JsPlayVod("'+playUrl+'");></div><img id=collectImgs'+id+' src='+collectImg+' style="float:left;margin-left:20px;margin-top:20px;width:100px;height:100px;" onClick=changeCollect('+id+') /></div><div class="vodListName">'+father2+'</div>';
                    }else{
                        getID("shcContent").innerHTML += '<div id=videoImg'+id+' class="vodListImg" style="height:'+imgHeight+';" ><video id=h5Video'+id+' style="object-fit:fill;" width="100%" height="100%" controls preload="auto" type="application/x-mpegURL" poster="../vod/'+name+'/poster.jpg" src='+playUrl+' playsinline x5-playsinline webkit-playsinline x-webkit-airplay="true" x5-video-player-fullscreen="true" x5-video-orientation="landscape"></video></div><div class="vodListNameBrowser">'+father2+'</div><img id=collectImgs'+id+' src='+collectImg+' style="float:left;width:100px;height:100px;" onClick=changeCollect('+id+') />';
                    }
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