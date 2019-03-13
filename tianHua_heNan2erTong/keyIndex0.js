function doSelect(){//确认键
	from = 'login';
	setCookie("from", from, '1d');
	setCookie("indexNavPos", 0, '1d');
	location.href = 'detail.htm';
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
			return 0;
			break;
			
		case "KEY_DOWN":
			return 0;
			break;
			
		case "KEY_LEFT": 
			return 0;
			break;
			
		case "KEY_RIGHT": 
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