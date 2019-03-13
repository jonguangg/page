
var SiHua_Event = {
	mapping: function(__event){
		var	keycode = __event.which|| __event.keyCode;
//	  alert(areaSearch+"\nfocusWordPos"+focusWordPos+"\nfocusmineListPos"+focusmineListPos+"\nhidden"+hidden);
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

function iPanelKey(){
	var key_codes = event.which;
	var codes = "";
	switch(key_codes){
		case 65362:
			codes ="KEY_UP";
			break;
		case 65364:
			codes ="KEY_DOWN";
			break;
		case 65361:
			codes ="KEY_LEFT";
			break;
		case 65363:
			codes ="KEY_RIGHT";
			break;	
		case 65293:
			codes ="KEY_SELECT";
			break;
		case 65367:
		case 8:
		case 340:
		case 640:
			codes ="KEY_BACK";
			break;
		case 26:
			codes ="PAGE_DOWN";
			break;
		case 25:
			codes ="PAGE_UP";
			break;	
		case 149:
			codes ="KEY_NUMERIC49";
			break;
		case 150:
			codes ="KEY_NUMERIC50";
			break;
		case 151:
			codes ="KEY_NUMERIC51";
			break;	
	}
	return codes;
}

function $(_id){return document.getElementById(_id);}


//Cookie
function setCookie(name, value,time){
	var msec = getMsec(time); //获取毫秒
    var exp = new Date(); 
    exp.setTime(exp.getTime() + msec*1);//小时*分钟*秒*毫秒
    window.document.cookie = name + "=" + escape (value) + "; expires=" + exp.toGMTString();
}

function getMsec(DateStr){//将字符串时间转换为毫秒,1秒=1000毫秒
    var timeNum = DateStr.substring(0,DateStr.length-1)*1; //时间数量
    var timeStr = DateStr.substring(DateStr.length-1,DateStr.length); //时间单位后缀，如h表示小时
    
	if (timeStr=="s"){ //20s表示20秒
         return timeNum*1000;
    }else if (timeStr=="m"){//10m表示10分钟
        return timeNum*60*1000;
    }else if (timeStr=="h"){//12h表示12小时
        return timeNum*60*60*1000;
    } else if (timeStr=="d"){//30d表示30天
        return timeNum*24*60*60*1000; 
    }
}

function getCookie(sName){
  var aCookie = document.cookie.split("; ");
  for (var i=0; i < aCookie.length; i++)
  {
    var aCrumb = aCookie[i].split("=");
    if (sName == aCrumb[0]){
      return unescape(aCrumb[1]);
    }
  }
  return null;
}

function delCookie(name){ 
  var exp = new Date(); 
  exp.setTime(exp.getTime() -1000);
  window.document.cookie = name + "= null; expires=" + exp.toGMTString();
}

function loadJsCssFile(filename, filetype){ //动态外联js或css文件
    if(filetype == "js"){
        var fileref = document.createElement('script');
        fileref.setAttribute("type", "text/javascript");
        fileref.setAttribute("src", filename);
    }else if (filetype == "css"){ 
        var fileref = document.createElement('link');
        fileref.setAttribute("rel", "stylesheet");
        fileref.setAttribute("type", "text/css");
        fileref.setAttribute("href", filename);
    }
    if(typeof fileref != "undefined"){
        document.getElementsByTagName("head")[0].appendChild(fileref);
    } 
}

function removeJsCssfile(filename, filetype){//移除已经加载过的js/css
	var targetelement=(filetype=="js")? "script" : (filetype=="css")? "link" : "none";
	var targetattr=(filetype=="js")? "src" : (filetype=="css")? "href" : "none";
	var allsuspects=document.getElementsByTagName(targetelement);
	for (var i=allsuspects.length; i>=0; i--){
		if (allsuspects[i] && allsuspects[i].getAttribute(targetattr)!=null && allsuspects[i].getAttribute(targetattr).indexOf(filename)!=-1){		
		   allsuspects[i].parentNode.removeChild(allsuspects[i])
		}
	}
}