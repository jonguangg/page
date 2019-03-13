function doSelect(){//确认键 
	if(zoneArea=='home'){
		location.href = closeWebPage();
	}else if(zoneArea=='main'){
		location.href = 'index.htm';
	}else if(zoneArea=='back'){
		location.href = 'zoneList.htm';
	}else if(zoneArea=='list'){
		setCookie("zoneListPos", zoneListPos, '10m');
		setCookie("zoneListHidden", zoneListHidden, '10m');
		fromPos = zoneListPos+zoneListHidden;
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
			if( zoneArea=='list'){
				zoneArea = 'home';
				changeList(0);
				changeRightCornerBg();
				$('focusImg').src = 'img/null.png';
			}
			return 0;
			break;
			
		case "KEY_DOWN":
			if( zoneArea=='home' || zoneArea=='main' || zoneArea=='back' ){
				zoneArea = 'list';
				changeList(0);
				changeRightCornerBg();
			}
			return 0;
			break;
			
		case "KEY_LEFT": 
			if( zoneArea=='back'){
				zoneArea = 'main';
				changeRightCornerBg();
			}else if( zoneArea=='main'){
				zoneArea = 'home';
				changeRightCornerBg();
			}else if(zoneArea=='list'){
				changeList(-1);
			}
			return 0;
			break;
			
		case "KEY_RIGHT": 
			if( zoneArea=='home'){
				zoneArea ='main';
				changeRightCornerBg();
			}else if( zoneArea=='main'){
				zoneArea = 'back';
				changeRightCornerBg();
			}else if(zoneArea=='list'){
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
			if( from=='zone'){
				location.href = 'zoneList.htm';
			}else{
				location.href = 'index.htm';
			}			
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