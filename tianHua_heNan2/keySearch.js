function doSelect(){//确认键 
	if(searchArea=='home'){
		location.href = 'index.htm';
	}else if(searchArea=='main'){
		location.href = 'index.htm';
	}else if(searchArea=='back'){
		history.go(-1);
	}else if(searchArea=='T9'){
//		prompt('', $('searchKey').innerHTML)
		if( $('searchKey').innerHTML == "请输入首字母"){
			$('searchKey').innerHTML = '';
		}
		if(T9Pos==0 ||T9Pos==10){
			$('searchKey').innerHTML += $('T9num'+T9Pos).innerHTML.slice(0,1);
		}else if( T9Pos==9 ){//退格
			$('searchKey').innerHTML = $('searchKey').innerHTML.slice(0,$('searchKey').innerHTML.length-1);
		}else if( T9Pos==11 ){//清空
			$('searchKey').innerHTML = '';
		}else{
			searchArea = 'chooseKey';
			changeT9(0);
			showKeyWord();
			changeKey(0);
		}
		if( $('searchKey').innerHTML.length>14 ){//超长自动退格
			$('searchKey').innerHTML = $('searchKey').innerHTML.slice(0,$('searchKey').innerHTML.length-1);
		}
	}else if(searchArea=='chooseKey'){
		if( $('searchKey').innerHTML == "请输入首字母"){
			$('searchKey').innerHTML = '';
		}else{
			$('searchKey').innerHTML += $('chooseKey'+chooseKeyPos).innerHTML;
			if( $('searchKey').innerHTML.length>14 ){//超长自动退格 
				$('searchKey').innerHTML = $('searchKey').innerHTML.slice(0,$('searchKey').innerHTML.length-1);
			}
		}
		searchArea = 'T9';
		changeT9(0);
		changeKey(0);
	}else if( searchArea=='submit'){
		$('listDescribe').innerHTML = '搜索结果';
		$('page').style.display = 'none';
		for(i=0;i<8;i++){
			$('listImg'+i).src = 'img/null.png';//先清空
			$('listName'+i).innerHTML = '';
		}
		if( $('searchKey').innerHTML == '请输入首字母' || $('searchKey').innerHTML == ''){
			$('searchWarn').style.display = 'block';
			$('warnText').innerHTML = '您还没输入首字母<br />请输入首字母后再搜索！';
		}else{
			searchListType = 1;//使列表类型为1，即搜索结果
			changePage(-99999);//向上翻这么多页，即表示回到第一页
			if( curPageCount==0){
				$('searchWarn').style.display = 'block';
				$('warnText').innerHTML = '暂时没有搜索到您要的内容<br />试试别的关键词吧';
			}else{
				$('searchWarn').style.display = 'none';			
			}
		}
		searchListPos = 0;//加这个是避免从列表第5个向左移后，再搜索，如果结果没5个，那焦点却落在第5个
	}else if(searchArea=='list'){
		fromPos = searchListPos;
		setCookie("searchArea", searchArea, '10m');
		setCookie("from", from, '10m');
		setCookie("fromPos", fromPos, '10m');
		setCookie("searchListType", searchListType, '10m');
		setCookie("searchPagePos", searchPagePos, '10m');
		setCookie("searchListPos", searchListPos, '10m');
		location.href = 'detail.htm';
	}
} 

//按键
document.onsystemevent = eventHandler;
//document.onkeypress    = eventHandler;
document.onirkeypress  = eventHandler; 
function eventHandler(e,type){
	var key_code = "";
	if(navigator.userAgent.indexOf('iPanel')!=-1){
		key_code=iPanelKey();
	}else key_code = e.code ;
	switch(key_code){		
		case "KEY_UP": 
			if(searchArea=='T9'){
				if(T9Pos<3){
					searchArea = 'submit';
				//	$('searchKey').style.border = 'rgba(0,0,255,1) 4px groove';	
					$('searchImg').style.backgroundImage = 'url(img/search1.png)';			
					changeT9(0);
				}else{
					changeT9(-3);
				}
			}else if(searchArea == 'submit'){
				searchArea = 'home';
				changeRightCornerBg();
			//	$('searchKey').style.border = 'rgba(0,0,0,0) 4px groove';
				$('searchImg').style.backgroundImage = 'url(img/search0.png)';	
			}else if(searchArea=='chooseKey'){
				if( chooseKeyPos==2 ||chooseKeyPos==4){
					changeKey(-2);
				}else{
					searchArea = 'T9';
					changeT9(0);
					changeKey(0);
				}
			}else if(searchArea=='list'){
				if( searchListPos<4){//在第一行
					if( searchPagePos==0){//在第一页就上移至主页
						searchArea = 'main';
						changeList(0);
						changeRightCornerBg();
					}else{//不在第一页就上翻一页
						changePage(-1);
					}				
				}else{//在第二行
					changeList(-4);
				}
			}
			return 0;
			break;
			
		case "KEY_DOWN":
			if( searchArea=='home' || searchArea=='main' || searchArea=='back'){
				if( $('listImg0').src.indexOf('img/null.png')==-1 ){
					searchArea = 'list';
					changeList(0);
				}else{
					searchArea = 'T9';
				//	changeList(0);
					changeT9(0);
				}
				changeRightCornerBg();
			}else if(searchArea=='submit'){
				searchArea ='T9'
				changeT9(0);
			//	$('searchKey').style.border = 'rgba(0,0,0,0) 4px groove';
				$('searchImg').style.backgroundImage = 'url(img/search0.png)';
			}else if(searchArea=='T9'){
				changeT9(3);
			}else if(searchArea=='chooseKey'){
				if( chooseKeyPos==0 ){
					changeKey(2);
				}else if( chooseKeyPos==2 && (T9Pos==6 || T9Pos==8)){
					changeKey(2);
				}else{
					searchArea = 'T9';
					changeT9(0);
					changeKey(0);
				}
			}else if(searchArea=='list'){
				if( searchListPos<4){//在第一行 
					changeList(4);
				}else{//在第二行 
					if( searchPagePos<searchPageAll-1){//有下一页
						changePage(1);
					}
				}
			}
			return 0;
			break;
			
		case "KEY_LEFT": 
			if( searchArea=='back'){
				searchArea = 'main';
				changeRightCornerBg();
			}else if( searchArea=='main'){
				searchArea = 'home';
				changeRightCornerBg();
			}else if( searchArea=='home'){
					searchArea = 'T9';
			//		changeList(0);
					changeT9(0);
					changeRightCornerBg();
			}else if(searchArea=='list'){
				if( searchListPos==0 || searchListPos==4){
					searchArea = 'T9';
					changeList(0);
					changeT9(0);
				}else{
					changeList(-1);
				}
			}else if(searchArea=='T9'){
				changeT9(-1);
			}else if(searchArea=='chooseKey'){
				if( chooseKeyPos==2 || chooseKeyPos==3){
					changeKey(-1);
				}else{
					searchArea = 'T9';
					changeT9(0);
					changeKey(0);
				}
			}
			return 0;
			break;
			
		case "KEY_RIGHT": 
			if( searchArea=='home'){
				searchArea ='main';
				changeRightCornerBg();
			}else if( searchArea=='main'){
				searchArea = 'back';
				changeRightCornerBg();
			}else if(searchArea=='list'){
				changeList(1);
			}else if(searchArea=='T9'){
				if(T9Pos%3==2){
					if($('listImg0').src.indexOf('img/null.png')==-1){//如果第一个位置的海报不是空的，说明有数据，那就可以右移
						searchArea = 'list';
						changeList(0);
						changeT9(0);
					}else{
						searchArea = 'home';
						changeRightCornerBg();
						changeT9(0);
					}
				}else{
					changeT9(1);
				}
			}else if(searchArea=='chooseKey'){
				if( chooseKeyPos==1 || chooseKeyPos==2){
					changeKey(1);
				}else{
					searchArea = 'T9';
					changeT9(0);
					changeKey(0);
				}
			}else if(searchArea=='submit'){
			//	$('searchKey').style.border = 'rgba(0,0,0,0) 4px groove';
				$('searchImg').style.backgroundImage = 'url(img/search0.png)';
				if( $('listImg0').src.indexOf('img/null.png')==-1 ){
					searchArea = 'list';
					changeList(0);
				}else{
					searchArea = 'home';
					changeRightCornerBg();
				}
			}
			return 0;
			break;	
			
		case "PAGE_DOWN":
		    return 0;
			break;	
			
		case "PAGE_UP":
		case 25:
		    return 0;
			break;		
				
		case "KEY_SELECT":
			doSelect();
			return 0;
			break;
			
		case "KEY_BACK":
		    document.onkeypress    = eventHandler;
			location.href = 'index.htm';
			return false;
			break;	
			
		case "KEY_EXIT":
			return 0;
			break;
			
		case "KEY_NUMERIC49":
			return 0;
			break;
			
		case "KEY_NUMERIC50":
			return 0;
			break;
			
		case "KEY_NUMERIC51":
			return 0;
			break;
	}
}