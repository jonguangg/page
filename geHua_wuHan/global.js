//??
//Event 匿名对象覆盖了浏览器内置 Event 对象, 导致按键等事件无法触发.

var SiHua_Event = {
	mapping: function(__event){
		var keycode = __event.which||__event.keyCode;	
//		alert(keycode);
		var code = "";
		var name = "";
		var args = {};
		
		if(keycode < 58 && keycode > 47){//脢脳录眉rgs = {modifiers: __event.modifiers, value: (keycode - 48), type: 0, isGlobal: false};
			code = "KEY_NUMERIC"+keycode;
		} else {
			var args = {modifiers: __event.modifiers, value: keycode, type: 0, isGlobal: false};
			switch(keycode){
				case 1://裕隆小遥控
				case 28:
				case 38:				
				case 87://山西九联
				case 269://湖南
				case 65362://河南
					code = "KEY_UP";
					break;
					
				case 2://裕隆小遥控
				case 31:
				case 40:				 
				case 83://山西九联
				case 270://湖南
				case 65364://河南
					code = "KEY_DOWN";
					break;
					
				case 3:	//裕隆小遥控
				case 29:				
				case 37:				
				case 65://山西九联
				case 271://湖南
				case 65361://河南
					code = "KEY_LEFT";
					break;
					
				case 4:	//裕隆小遥控
				case 39:
				case 30: 
				case 68://山西九联
				case 272://湖南
				case 65363://河南
					code = "KEY_RIGHT";
					break;
					
				case 13:
				case 19:
				case 65293://河南
					code = "KEY_SELECT";
					break;
					
				case 5:
				case 33:
				case 306:
				case 372:
				case 25://河南
					code = "PAGE_UP";
					break;
					
				case 6:
				case 34:
				case 307:
				case 373:
				case 26://
					code = "PAGE_DOWN";
					break;
					
				case 27:	
				case 339:
					code = "KEY_EXIT";
					break;
					
				case 258:
					code="KEY_STANDBY";
					args.type = 1;
					break;
					
				case 8:
				case 340://裕隆小遥控
				case 65367://河南
					code = "KEY_BACK";
					break;
					
				case 372:
					code = "KEY_PAGE_UP";
					break;
				case 373:
					code = "KEY_PAGE_DOWN";
					break;
					
				case 512:
					code = "KEY_HOMEPAGE";
					break;
					
				case 513:
					code = "KEY_MENU";
					break;
					
				case 514:
					code = "KEY_EPG";
					break;
					
				case 515:
					code = "KEY_HELP";
					break;
					
				case 517:
					code = "KEY_VOD";
					break;
					
				case 518:
					code = "KEY_NVOD";
					break;
					
				case 771:
					code = "KEY_F4";
					break;
					
				case 520:
					code = "KEY_STOCK";
					break;
				case 769:
					code = "KEY_F2";
					break;
					
				case 770:
					code = "KEY_F3";
					break;
					
				case 768:
					code = "KEY_F1";
					break;
					
				case 515:
					code = "KEY_HELP";
					break;
				case 521:
					code="KEY_MAIL";
					break;
					
				case 561://脢脠路篓
					code = "KEY_IME";
					break;
					
				case 562:
					code = "KEY_BROADCAST";
					break;
					
				case 563:
					code = "KEY_TV";
					break;
				case 564:
					code = "KEY_AUDIO";
					break;
					
				case 567:
					code = "KEY_INFO";
					break;
					
				case 570:
					code = "KEY_FAVORITE";
					break;
					
				case 595:
					code="KEY_VOLUME_UP";
					break;
					
				case 596:
					code="KEY_VOLUME_DOWN";
					break;
					
				case 593:
					code = "KEY_CHANNEL_UP";
					break;
					
				case 594:
					code = "KEY_CHANNEL_DOWN";
					break;
				case 597:
					code = "KEY_MUTE";
					args.type = 1;
					break;
				case 802:
				case 598:
					code = "KEY_AUDIO_MODE";
					break;
					
				case 832:
					code = "KEY_RED";
					break;
					
				case 833:
					code = "KEY_GREEN";
					break;
				case 834:
					code = "KEY_YELLOW";
					break;
					
				case 835:
					code = "KEY_BLUE";
					break;
					
				case 269:
					code = "269";
					break;
			}
			
		}
		return {code: code, args: args, name: name};
	}
};
document.onkeydown=function (__event) {
	__event=__event||window.event;	
	try
	{			
		g_delayExit.stop();
	}
	catch( E )
	{
		//alert( 'doPageLoad() say:\n\n' + E.message );
	}
	return typeof eventHandler == 'function' ? eventHandler(SiHua_Event.mapping(__event), 1) : true;
};
document.onirkeypress = function (__event) {
	__event=__event||window.event;
	return  eventHandler ? eventHandler(Event.mapping(__event), 1) : true;
};
document.onsystemevent = function (__event) {
	__event=__event||window.event;
	return eventHandler ? eventHandler(Event.mapping(event), 2) : true;
};

function $(_id){
	return document.getElementById(_id);
}