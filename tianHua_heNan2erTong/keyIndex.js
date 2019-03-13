function doSelect(){//确认键
	if(indexArea=='home'){
		location.href = '';
	}else if(indexArea=='search'){
	//	var searchListType = 0;
	//	var searchPagePos = 0;
	//	var searchListPos = 0;
		setCookie("searchListType", 0, '1d');
		setCookie("searchPagePos", 0, '1d');
		setCookie("searchListPos", 0, '1d');
		location.href = 'search.htm';
	}else if(indexArea=='nav'){
		indexListPos = 0;
		setCookie("indexListPos", indexListPos, '1d');
		setCookie("indexNavPos", indexNavPos, '1d');
		setCookie("indexArea", indexArea, '1d');
		setCookie("listPos", 0, '1d');
		setCookie("pagePos", 0, '1d');	
		if(indexNavPos==7){
			location.href = 'zoneList.htm';
		}else if( indexNavPos>0){
			location.href = 'list.htm';
		}else if( indexNavPos==0){
			location.href = 'index.htm';
		}
	}else if(indexArea=='list'){
		setCookie("indexListPos", indexListPos, '1d');	
		setCookie("indexLoopPos", indexLoopPos, '1d');
		setCookie("indexArea", indexArea, '1d');
		if(indexListPos<2){
			from = 'indexLoop';
		}else{
			from = 'indexList';
		}
		setCookie("from", from, '1d');
		if( indexListPos==5){
		//	var pagePos = indexArr[5].zonePagePos;
		//	var listPos = indexArr[5].zoneListPos;
			from = 'indexListPos5';
			setCookie("pagePos", indexArr[5].zonePagePos, '1d');
			setCookie("listPos", indexArr[5].zoneListPos, '1d');
			setCookie("from", from, '1d');
			location.href = 'zoneDetail.htm';
		}else{
			location.href = 'detail.htm';
		}
	}else if(indexArea=='follow'){
		from = 'follow';
		fromPos = followPos+followHidden;
		setCookie("from", from, '1d');
		setCookie("fromPos", fromPos, '1d');
		setCookie("followPos", followPos, '1d');
		setCookie("followHidden", followHidden, '1d');
		location.href = 'detail.htm';
	}else if(indexArea=='mine'){
	//	var mineTypePos = 0;
	//	var minePagePos = 0;
	//	var mineListPos = 0;
		setCookie("mineTypePos", 0, '1d');
		setCookie("minePagePos", 0, '1d');
		setCookie("mineListPos", 0, '1d');
		setCookie("indexArea", indexArea, '1d');
		location.href = 'mine.htm';
	}else if( indexArea=="versionPrompt" ){
		indexArea ="nav";
		$("versionPrompt").style.display = "none";
		changeNav(0);
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
			if(indexArea=='mine'){
				indexListPos = 0;
				indexArea = 'list';
				changeList(0);
				changeMyBg();
			}else if(indexArea=='list'){
				/*if(indexListPos==3 || indexListPos==4){
					indexListPos = 0;
				}else if(indexListPos==5){
					indexListPos = 2;
				}*/
				if( indexListPos==3 || indexListPos==5){
					changeList(-3);
				}else if(indexListPos==4){
					changeList(-4);
				}else{
					indexArea = 'nav';
					changeList(-100);
					changeNav(0);
				}				
			}else if(indexArea=='nav'){
				indexArea = 'home';
				changeRightCornerBg();
				changeNav(0);
			}
			changeFocusBg();
			return 0;
			break;
			
		case "KEY_DOWN":
			if( indexArea=='home' || indexArea=='search'){
				indexArea = 'nav';
				changeRightCornerBg();
				changeNav(0);
			}else if(indexArea=='nav'){
				indexArea = 'list';
				changeNav(0);
				changeList(0);
			}else if(indexArea=='list'){
				if( indexListPos==0 || indexListPos==2){
					changeList(3);
				//	indexListPos = 3;
				}/*else if(indexListPos==2){
					indexListPos = 5;
				}*/
			}else if(indexArea=='follow'){
				indexArea = 'nav';
				$('follow').style.display = 'none';
			}
		    changeFocusBg();
			return 0;
			break;
			
		case "KEY_LEFT": 
			if( indexArea=='search'){
				indexArea = 'home';
				changeRightCornerBg();
			}else if(indexArea=='nav'){
				changeNav(-1);
			}else if(indexArea=='list'){
				/*if(indexListPos==2 || indexListPos==5){
					indexListPos = 1;
				}else if(indexListPos==1){
					indexListPos = 0;
				}else if(indexListPos==4){
					indexListPos = 3;
				}*/
				if( indexListPos==1 || indexListPos==2 || indexListPos==4){
					changeList(-1);
				}else if(indexListPos==5){
					changeList(-4);
				}else if(indexListPos==3){
					indexArea = 'mine'; 
					changeList(0);
					changeMyBg();
				}
			}else if(indexArea=='follow'){
				changeFollow(-1);
			}
			changeFocusBg();
			return 0;
			break;
			
		case "KEY_RIGHT": 
			if( indexArea=='home'){
				indexArea = 'search';
				changeRightCornerBg();
			}else if(indexArea=='nav'){
				changeNav(1);
			}else if(indexArea=='list'){
				/*if(indexListPos==0){
					indexListPos = 1;
				}else if(indexListPos==1){
					indexListPos = 2;
				}else if(indexListPos==3){
					indexListPos = 4;
				}else if(indexListPos==4){
					indexListPos = 1;
				}*/
				if(indexListPos<2 || indexListPos==3 ){
					changeList(1);
				}else if( indexListPos==4){
					changeList(-3);
				}
			}else if(indexArea=='mine'){
				indexListPos = 3;
				indexArea = 'list';
				changeList(0);
				changeMyBg();
				
			}else if(indexArea=='follow'){
				changeFollow(1);
			}
			changeFocusBg();
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
			indexArea = 'nav';
			$('follow').style.display = 'none';
			changeFocusBg();
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