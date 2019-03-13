function doSelect(){//确认键 
	setCookie("mineTypePos", mineTypePos, '10m');
	setCookie("minePagePos", minePagePos, '10m');
	setCookie("mineListPos", mineListPos, '10m');
	if(mineArea=='home'){
		location.href = closeWebPage();
	}else if(mineArea=='main'){
		location.href = 'index.htm';
	}else if(mineArea=='back'){
		history.go(-1);
	}else if(mineArea=='search'){
		location.href = 'search.htm';
	}else if(mineArea=='list'){
		fromPos = mineListPos;
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
			if(mineArea=='list'){
				if( mineListPos<5 && minePagePos==0){
					mineArea = 'home';
					changeList(0);
					changeRightCornerBg();
				}else if( mineListPos<5 && minePagePos>0){
					changePage(-1);
				}else if( mineListPos>4){
					changeList(-5);
				}
			}else if( mineArea=='mineCollect'){
				mineArea ='mineHistory';
				changeType(-1);
			}
			return 0;
			break;
			
		case "KEY_DOWN":
			if( mineArea=='home' || mineArea=='main' || mineArea=='back'|| mineArea=='search'){
				if( curPageCount>0){
					mineArea = 'list';
					changeList(0);
					changeRightCornerBg();
				}else{
					mineArea = (mineTypePos==0)?'mineHistory':'mineCollect';
					changeRightCornerBg();
					changeType(0);
				}
			}else if(mineArea=='list'){
				if( mineListPos<5){
					changeList(5);
				}else if(mineListPos>4){
					if( minePagePos<pageAll-1){
						changePage(1);
					}
				}
			}else if( mineArea=='mineHistory'){
				mineArea ='mineCollect';
				changeType(1);
			}
			return 0;
			break;
			
		case "KEY_LEFT": 
			if( mineArea=='search'){
				mineArea = 'back';
				changeRightCornerBg();
			}else if( mineArea=='back'){
				mineArea = 'main';
				changeRightCornerBg();
			}else if( mineArea=='main'){
				mineArea = 'home';
				changeRightCornerBg();
			}else if( mineArea=='home'){
				mineArea = (mineTypePos==0)?'mineHistory':'mineCollect';
				changeRightCornerBg();
				changeType(0);
			}else if(mineArea=='list'){
				if( mineListPos==0 || mineListPos==5 ){
					mineArea = (mineTypePos==0)?'mineHistory':'mineCollect';
					changeList(0);
					changeType(0);
				}else{
					changeList(-1);
				}
			}
			return 0;
			break;
			
		case "KEY_RIGHT": 
			if( mineArea=='home'){
				mineArea ='main';
				changeRightCornerBg();
			}else if( mineArea=='main'){
				mineArea = 'back';
				changeRightCornerBg();
			}else if( mineArea=='back'){
				mineArea = 'search';
				changeRightCornerBg();
			}else if(mineArea=='list'){
				changeList(1);
			}else if( mineArea=='mineHistory' || mineArea=='mineCollect'){
				if( curPageCount>0){
					mineArea = 'list';
					changeList(0);
					changeType(0);
				}else{
					mineArea = 'home';
					changeRightCornerBg();
					$('mineHistory').style.backgroundImage = 'url(img/mineHistory0.png)';
					$('mineCollect').style.backgroundImage = 'url(img/mineCollect0.png)';
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