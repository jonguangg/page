
var btnPos = 0;
var menuPos = 0;
var tipPos=0;
var listPos = 0;
var area=0;
var movieNames = " ";
var PromptPos = 0;
var account  = 88;
//播放页图标
var btnArray = [
	["../img/play0.png","../img/play1.png"], //立即播放
	["../img/exit0.png","../img/exit1.png"], //退出
	["../img/buy0.png","../img/buy1.png"]	 //购买
];

//传值
var url = window.location.href;
if(url.indexOf("?") > -1){
	url = url.substr(url.indexOf("?")+1);
	url = url.split("&");
	menuPos = parseInt(url[0]);
	listPos = parseInt(url[1]);
}

//判断在当前页中btnPos所在的位置
function focusPos(){
	if(PREV_URL==""&&NEXT_URL!=""){ //第一页
		btnPos = 0;
		btnFocus(0);
	}
	else if(NEXT_URL!=""&&PREV_URL!=""){ //中间页
		btnPos = 0;
		btnFocus(0);
	}
	else if(PREV_URL!=""&&NEXT_URL==""){ //最后一页
		btnPos = 0;
		//$("btn1").src = "tm.gif";
		btnFocus(0);
	}
	else if(PREV_URL==""&&NEXT_URL==""){ //只有一页
		btnPos = 0;
		btnFocus(0);
//		$("btn0").src = "tm.gif";
//		$("btn1").src = "tm.gif";
	}
}

//简化代码
function $(id){
	return document.getElementById(id);
}

//按钮焦点
function btnFocus(__num){//焦点图标
	if(buy==false){
		btnArray[0][0]=btnArray[2][0];	
		btnArray[0][1]=btnArray[2][1];	
		}
	$("btn"+btnPos).src = btnArray[btnPos][0];
	btnPos+=__num;
	if(btnPos<0)btnPos=0;
	else if(btnPos>1)btnPos = 1;
	$("btn"+btnPos).src = btnArray[btnPos][1];
}

//页面加载后自动执行
function init(){
	focusPos();
	btnFocus(0);
	$("price").innerHTML=price;
}

function promptAlert(){//提示框内容
	area=1;
	//alert($("promptYes").style.backgroundImage);
	if(account<price){
	    $("buy").style.backgroundImage = "url(../img/buyBg1.png)";
	    $("promptNo").style.backgroundImage = "url(../img/back1.png)";			
	}else {
		PromptPos = 1;
//		$("buyimg").src="../img/buyBg0.png";
		$("buy").style.backgroundImage = "url(../img/buyBg0.png)";	
		$("promptYes").style.backgroundImage = "url(../img/enter1.png)";
		movieNames=$("movieName").innerHTML;			
		$("prompt").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;您订购的是“"+movieNames+"”,价格："+price+"元，可以在48小时内使用当前机顶盒反复观看。<br />&nbsp;&nbsp;&nbsp;&nbsp;请问您确认购买吗？";
	}
}

function promptBtn(_num){//购买提示显示
	if(_num==0){
			area=0;
			btnPos=1;
			PromptPos=0;
			$("buy").style.backgroundImage = "url()";
			$("prompt").innerHTML = "";
			$("promptYes").style.backgroundImage = "url()";
			$("promptNo").style.backgroundImage = "url()";
			$("btn0").src = btnArray[0][0];			
			$("btn1").src = btnArray[1][1];
		}else if(_num==1){
			if(account<price){
			area=1;
			PromptPos=1;
			$("promptNo").style.backgroundImage = "url()";	
			$("promptYes").style.backgroundImage = "url(../img/retry1.png)";				
				}else {
			area=1;
			PromptPos=1;
			$("promptNo").style.backgroundImage = "url()";	
			$("promptYes").style.backgroundImage = "url(../img/enter1.png)";
			}
		}else if(_num==2){
			area=1;
			PromptPos=0;
			$("promptNo").style.backgroundImage = "url(../img/back1.png)";	
			$("promptYes").style.backgroundImage = "url()";	
			}
}

//确认键响应函数
function doSelect(){
	if(area==0){
		if(btnPos==0){
			if(PREV_URL=="")return;
//		else location.href = PREV_URL+"?"+menuPos+"&"+listPos;
			else if(buy==0){
				promptAlert();
			}else location.href = "../boFangYeMian.htm";
		}else if(btnPos==1){
			if(NEXT_URL=="")return;
//		else location.href = NEXT_URL+"?"+menuPos+"&"+listPos;
			else location.href = "../index.htm";
	}
	}else if(area==1) promptSelect();
}
//购买确认
function promptSelect(){
	if(PromptPos==1)location.href = "../gouMaiYeMian.htm";
	else promptBtn(0);
	}

//遥控键值2
document.onsystemevent = grabEvent;
//document.onkeypress = grabEvent;
document.onirkeypress=grabEvent;
function grabEvent(){
	var key_code = event.which;
	switch(key_code){
		case 38://up
			return 0;
			break;
			
		case 40://down
		if(area==1) promptBtn(0);
			return 0;
			break;
			
		case 37://left
		if(area==0)
		{
			btnFocus(-1);
		}else if(area==1) promptBtn(1);
			return 0;
			break;
			
		case 39: //right
			if(area==0)
		{
			btnFocus(1);
		}else if(area==1) promptBtn(0);
			return 0;
			break;
			
		case 13: //enter
			doSelect();
		    return 0;
			break;

		case 340: //back
			history.go(-1);
			break;	
			
		case 339:
			window.close();
			return 0;
			break;
	}
}

//电脑键值，上线后需删掉
function eventHandler(e,type){
	var key_code = e.code;
	switch(key_code){
		case "KEY_UP":
			return 0;
			break;
			
		case "KEY_DOWN":
		if(area==1) promptBtn(0);
			return 0;
			break;
			
		case "KEY_LEFT":
		if(area==0)
		{
			btnFocus(-1);
		}else if(area==1) promptBtn(1);
			return 0;
			break;
			
		case "KEY_RIGHT": //right
			if(area==0)
		{
			btnFocus(1);
		}else if(area==1) promptBtn(0);
			return 0;
			break;
			
		case "KEY_SELECT": //enter
			doSelect();
		    return 0;
			break;

		case "KEY_BACK": //back
			history.go(-1);
			break;	
			
		case "KEY_EXIT":
			window.close();
			return 0;
			break;
	}
}