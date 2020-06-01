
function moveChannel(_num){//在频道列表上换台，即上下键移动选择频道
	try{
		window.clearTimeout(st);//不让频道列表隐藏
	}catch(err){
	}
	
	getID('channels'+channelPos).style.background = 'rgba(0,0,0,0)';
	getID('channel'+channelPos).innerText = channelTempArr[channelPos+channelPagePos*10].name.slice(0,9);
	channelPos += _num;
	if( channelPos<0){
		channelPos=9;//在第一个时向上，焦点移到最下面,暂时定为9，如果最后一个不是9，再改之  
		if( channelPagePos>0){//如果不在第一页，则向前翻一页
			channelPagePos--;
		}else{//如果已在第一页，则移到最后一页
			channelPagePos = channelPageAll-1;
			if( channelPos + channelPagePos*10>channelCount-1){
				channelPos = channelCount-channelPagePos*10-1;
			}
		}
	}
	if( channelPos+channelPagePos*10>channelCount-1 && _num>0){//在最后一页最后一条下移，跳到第一页第一个
		channelPagePos =0;
		channelPos = 0;
	}
	if( channelPos>9){
		channelPos=0;
		if( channelPagePos<channelPageAll-1){
			channelPagePos++;
		}
	}
	showChannel(0);
	var nameTemp = channelTempArr[channelPos+channelPagePos*10].name;
	if( nameTemp.length>9){
		getID('channel'+channelPos).innerHTML = '<marquee behavior="alternate" direction="left" width="100%" scrollamonut="100" scrolldelay="300" style="color:#f60;">'+nameTemp+'</marquee>'
	}
	getID('channels'+channelPos).style.background = 'rgba(0,0,255,0.7)';
//	st = window.setTimeout("showHiddenChannelList(0)", 3000);//3秒后自动隐藏频道列表 
}


function jumpTo(){// 数字键换台
	try{ window.androidJs.JsPlayLive(channelArr[parseInt(channelJump)-1].videoUrl); }catch(e){} 
	getID('jumpChannel').innerText = '';
	getID('jumpName').innerText = '';
	if( parseInt(channelJump)>0 ){//输入的值大于0才跳转频道
		groupId = -1;
		channelPagePos = parseInt((parseInt(channelJump)-1+10)/10)-1;
		moveChannel( parseInt(channelJump)%10-1-channelPos );
		//记录groupId channelPagePos channelPos channelJump
		updateCookie();
	}else{//如果输入的值是0，则还原当前频道号
		channelJump = ( window.androidJs.JsGetCookie("channelJump",0)=='0' )?'1':window.androidJs.JsGetCookie("channelJump",0);
	}
}

function jumpIf(){//换台时右上角显示频道名
	getID('jumpError').style.display = 'none';
	if( parseInt(channelJump)<channelArr.length+1 && channelJump.length<5){
		getID('jumpChannel').innerText = channelJump;
		if( parseInt(channelJump)>0 ){
			getID('jumpName').innerText = channelArr[parseInt(channelJump)-1].name;
		}
	}else if( parseInt(channelJump)>channelArr.length || channelJump.length>4 ){
		getID('jumpError').style.display = 'block';
		getID('jumpError').innerHTML = '最大频道号为 '+channelArr.length;
		window.setTimeout('getID("jumpError").innerHTML = ""', 2000);
		getID('jumpChannel').innerText = '';
		getID('jumpName').innerText = '';
	}
	stJump = window.setTimeout("jumpTo()", 3000);	
}

var numId = 4;
function changeNum(_num){//输入卡号卡密时选择数字
	numId += _num;
	if( numId < 0 ){
		numId = 11;
	}
	if( numId > 11 ){
		numId = 0;
	}
	getID("numBgImg").style.left = (numId%3)*100+490+"px";
	getID("numBgImg").style.top = parseInt( ((numId/3)%4))*70+235+"px";
}

function doSelect(){//确认键
	if( indexArea=="live" ){	
		if( getID('channel').style.display=='block'){ //如果频道列表已显示，则播放焦点所在的频道
			window.androidJs.JsPlayLive( channelTempArr[channelPos+channelPagePos*10].videoUrl );
			channelJump = channelTempArr[channelPos+channelPagePos*10].channelId.toString();
			updateCookie(); //记录groupId channelPagePos channelPos channelJump
		}else{//如果频道列表未显示，则判断播放状态，执行不同的OK操作
			if( window.androidJs.JsPlayStatus()==5 ){//播放完毕
				window.androidJs.JsRePlay();
			}else{
				if( window.androidJs.JsPlayStatus()==-1 ){//播放失败
					window.androidJs.JsRePlay();
				}
				getID('channel').style.display = 'block';
				try{ window.androidJs.JsShowHiddenChannelList() }catch(e){};
				showChannel(0);
				moveChannel(0);
			//	moveChannel( parseInt(channelJump)%10-1-channelPos );
			}
		}
		channelPagePosTemp = channelPagePos;
		channelPosTemp = channelPos;	
	}else if( indexArea=="card_id"){//输入卡号
		if( numId==10 ){//删除
			if( getID("card_id").innerText.indexOf("Please") < 0 ){//显示区为数字才能删除
				getID("card_id").innerText = getID("card_id").innerText.slice(0,getID("card_id").innerText.length-1);
				if( getID("card_id").innerText.length==0 ){//当显示区没内容时，显示提示语
					getID("card_id").innerText = "Please enter your card number";
				}
			}
		}else if( numId==11){//输入cardId后的GO
			if( getID("card_id").innerText.indexOf("Please")>-1 ){//有Please，说明没输入卡号，此时按确定跳出二维码
				sendAjax("./ajax.php","qrCode="+sn);
			}else{
				indexArea = "card_key";
				changeNum(-7);//焦点移到数字5
				//密码区有内容就保留，没内容就显示提示语（初如状态是没内容的， 如果卡号错了，返回时，密码区就会有密码）
				getID("card_key").innerText = "Please enter your PIN code";//(getID("card_key").innerText.length>0 )?getID("card_key").innerText:"Please enter your PIN code";
			}
		}else{//数字
			if( getID("card_id").innerText.indexOf("Please")>-1 ){//第一次输入数字
				getID("card_id").innerText = (numId==9)?0:numId+1;
			}else{
				getID("card_id").innerText += (numId==9)?0:numId+1;
			}
		}
	}else if( indexArea=="card_key"){//输入卡密
		if( numId==10 ){//删除
			if( getID("card_key").innerText.indexOf("Please") < 0 ){//显示区为数字才能删除
				getID("card_key").innerText = getID("card_key").innerText.slice(0,getID("card_key").innerText.length-1);
				if( getID("card_key").innerText.length==0 ){//当显示区没内容时，显示提示语
					getID("card_key").innerText = "Now you are edit card number";
					setTimeout(function(){ getID("card_key").innerText = ""; }, 2000);
					indexArea = 'card_id';
				}
			}
		}else if( numId==11){//输入key后的GO
		//	if( getID("card_key").innerText.indexOf("Please")>-1 || getID("card_key").innerText.length==0){	//没输入卡密
		//		changeNum(-7);
		//	}else{
				sendAjax("./ajax.php","sn="+sn+"&cardId="+getID("card_id").innerText+"&cardKey="+getID("card_key").innerText);
		//	}
		}else{//数字
			if( getID("card_key").innerText.indexOf("Please")>-1 ){//第一次输入数字
				getID("card_key").innerText = (numId==9)?0:numId+1;
			}else{
				getID("card_key").innerText += (numId==9)?0:numId+1;
			}
		}
	}else if( indexArea == "vipSuccess"){	//成功授权 进入直播
		indexArea = "live";
		getID("cardKey").style.display = "none";
		try{ window.androidJs.JsPlayLive( videoUrlCookie ); }catch(e){}
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
	getID("cardKey").innerHTML = key_code;
	switch(key_code){		
		case "KEY_UP":
			if( indexArea=="live" ){//正常播放状态
				if( getID('channel').style.display=='block' ){
					moveChannel(-1);
				}else{
					changeChannel(1);
				}
			}else if( indexArea=="lock"){//锁定状态
				indexArea = "lock1";
				backLock = setTimeout( "indexArea = 'lock';" , 3000);//3秒后按键状态返回锁定状态
			}else if( indexArea=="lock1"){//输入了一次 上 键
				indexArea = "lock2";
				clearTimeout(backLock);
				backLock = setTimeout( "indexArea = 'lock';" , 3000);//3秒后按键状态返回锁定状态
			}else if( indexArea=="lock2"){//输入了两次 上 键
				indexArea = "lock3";
				clearTimeout(backLock);
				backLock = setTimeout( "indexArea = 'lock';" , 3000);//3秒后按键状态返回锁定状态
			}else if( indexArea=="lock3"){//输入了三次 上 键
				indexArea = "lock";
				clearTimeout(backLock);
				backLock = setTimeout( "indexArea = 'lock';" , 3000);//3秒后按键状态返回锁定状态
			}else if( indexArea=="card_id" || indexArea=="card_key"){
				if( numId<3){
				//	changeNum(9);
				}else{
					changeNum(-3);
				}
			}else if( indexArea=="ewm"){
				indexArea = "card_id";
				getID("ewm").style.display = "none";
				getID("card_id").innerText = "Please enter your card number";
				getID("card_key").innerText = "";
			}
			return 0;
			break;
			
		case "KEY_DOWN":
			if( indexArea=="live" ){
				if( getID('channel').style.display=='block' ){
					moveChannel(1);
				}else{
					changeChannel(-1);
				}
			}else if( indexArea=="lock3"){
				clearTimeout(backLock);	//清除定时锁定
				getID("lockImg").style.display = "none";
				checkLicense();	//检查授权情况
				try{ window.androidJs.JsPlayLive( videoUrlCookie ); }catch(e){}
			}else if( indexArea=="card_id" || indexArea=="card_key"){
				if(numId>8){
				//	changeNum(-9);
				}else{
					changeNum(3);
				}
			}else if( indexArea=="ewm"){
				indexArea = "card_id";
				getID("ewm").style.display = "none";
				getID("card_id").innerText = "Please enter your card number";
				getID("card_key").innerText = "";
			}
			return 0;
			break;
			
		case "KEY_LEFT":
		/*	if( indexArea=="live" ){
				if( getID('channel').style.display=='block' ){
					moveChannel(-9);
					channelPagePos = 0;
					moveChannel(-channelPos);
					showChannel(-1);
				}	
			}else if( indexArea=="card_id" || indexArea=="card_key"){
				changeNum(-1);
			}else if( indexArea=="ewm"){
				indexArea = "card_id";
				getID("ewm").style.display = "none";
				getID("card_id").innerText = "Please enter your card number";
				getID("card_key").innerText = "";
			}
			return 0;
			break;*/
			
		case "KEY_RIGHT":
			if( indexArea=="live" ){
				if( getID('channel').style.display=='block' ){
					moveChannel(-9);
					channelPagePos = 0;
					moveChannel(-channelPos);
					showChannel(1);
				}else{
					indexArea = "ewm";
					getID("cardKey").style.display = "block";
					getID("ewm").style.background = "url(clientQr/"+sn+".png)";
					setTimeout(function(){ getID("card_key").innerText = ""; }, 5000);
				}
			}else if( indexArea=="card_id" || indexArea=="card_key"){
				changeNum(1);
			}else if( indexArea=="ewm"){
				indexArea = "card_id";
				getID("ewm").style.display = "none";
				getID("card_id").innerText = "Please enter your card number";
				getID("card_key").innerText = "";
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
		//    document.onkeypress    = eventHandler;
		//	return false;
			return 0;
			break;	
			
		case "KEY_EXIT":
		//    document.onkeypress    = eventHandler;
			return false;
			break;
		/*	
		case "KEY_NUMERIC48":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'0';
				jumpIf();				
			}
			return 0;
			break;
			
		case "KEY_NUMERIC49":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'1';
				jumpIf();				
			}
			return 0;
			break;
			
		case "KEY_NUMERIC50":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'2';
				jumpIf();				
			}
			return 0;
			break;
			
		case "KEY_NUMERIC51":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'3';
				jumpIf();				
			}
			return 0;
			break;
			
		case "KEY_NUMERIC52":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'4';
				jumpIf();				
			}
			return 0;
			break;
			
		case "KEY_NUMERIC53":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'5';
				jumpIf();				
			}
			return 0;
			break;
			
		case "KEY_NUMERIC54":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'6';
				jumpIf();				
			}
			return 0;
			break;
			
		case "KEY_NUMERIC55":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'7';
				jumpIf();				
			}
			return 0;
			break;
			
		case "KEY_NUMERIC56":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'8';
				jumpIf();				
			}
			return 0;
			break;
			
		case "KEY_NUMERIC57":
			if( getID('channel').style.display=='none' ){
				try{
					window.clearTimeout(stJump);
				}catch(err){
				}
				channelJump = getID('jumpChannel').innerText+'9';
				jumpIf();				
			}
			return 0;
			break;*/
	}
}
