function doSelect(){//确认键 
	setCookie("pagePos", pagePos, '10m');
	setCookie("listPos", listPos, '10m');
	if(listArea=='home'){
		location.href = closeWebPage();
	}else if(listArea=='main'){
		location.href = 'index.htm';
	}else if(listArea=='back'){
		history.go(-1);
	}else if(listArea=='search'){
		location.href = 'search.htm';
	}else if(listArea=='list'){
		fromPos = listPos;
		setCookie("from", from, '10m');
		setCookie("fromPos", fromPos, '10m');
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
			if(listArea=='list'){
				if( listPos<5 && pagePos==0){
					listArea = 'home';
					changeList(0);
					changeRightCornerBg();
				}else if( listPos<5 && pagePos>0){
					changePage(-1);
				}else if( listPos>4){
					changeList(-5);
				}
			}
			return 0;
			break;
			
		case "KEY_DOWN":
			if( listArea=='home' || listArea=='main' || listArea=='back'|| listArea=='search'){
				listArea = 'list';
				changeList(0);
				changeRightCornerBg();
			}else if(listArea=='list'){
				if( listPos<5){
					changeList(5);
				}else if(listPos>4){
					if( pagePos<pageAll-1){
						changePage(1);
					}
				}
			}
			return 0;
			break;
			
		case "KEY_LEFT": 
			if( listArea=='search'){
				listArea = 'back';
				changeRightCornerBg();
			}else if( listArea=='back'){
				listArea = 'main';
				changeRightCornerBg();
			}else if( listArea=='main'){
				listArea = 'home';
				changeRightCornerBg();
			}else if(listArea=='list'){
				changeList(-1);
			}
			return 0;
			break;
			
		case "KEY_RIGHT": 
			if( listArea=='home'){
				listArea ='main';
				changeRightCornerBg();
			}else if( listArea=='main'){
				listArea = 'back';
				changeRightCornerBg();
			}else if( listArea=='back'){
				listArea = 'search';
				changeRightCornerBg();
			}else if(listArea=='list'){
				changeList(1);
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