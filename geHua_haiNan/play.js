
function setCookie(name, value, iDay)
{
	var oDate=new Date();
	oDate.setDate(oDate.getDate()+iDay);
	
	document.cookie=name+'='+value+';expires='+oDate;path='/'
}
function removeCookie(name)
{
	setCookie(name, 1, -1);
}
function getCookie(name)
{
	var arr=document.cookie.split('; ');
	
	for(var i=0;i<arr.length;i++)
	{
		var arr2=arr[i].split('=');
		
		if(arr2[0]==name)
		{
			return arr2[1];
		}
	}	
	return '没有Cookie!';
}
var btnPos = 0;
var menuPos = 0;
var tipPos=0;
//var listPos = 0;
var area=0;
var movieNames = " ";
var PromptPos = 0;
var account  = 6.99999999;
var focusImgs = false;
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
	$("btn"+btnPos).src = btnArray[btnPos][0];//先变灰之前的焦点图标
	btnPos+=__num;
	if(btnPos<0){ btnPos=0; }
	else if(btnPos>1){ btnPos = 1; }
	$("btn"+btnPos).src = btnArray[btnPos][1];//再点亮之后的焦点图标
}

function focusImg(areas){
	if(areas=="null"){
		$("focusBg").style.backgroundImage = "url()";
	}else {
		$("focusBg").style.backgroundImage = "url(../img/focusPage.png)";
		$("focusBg").style.left = $(areas).style.left;
		$("focusBg").style.top = $(areas).style.top;
	}
}

function promptAlert(){//提示框内容
	area=1;
	if(account<price){//余额不足
		$("buy").style.backgroundImage = "url(../img/buyBg1.png)";
		$("promptNo").style.backgroundImage = "url(../img/back1.png)";
		$("promptServicePhone").style.display = "block";
	}else {
		PromptPos = 1;
		$("buy").style.backgroundImage = "url(../img/buyBg0.png)";	
		$("promptYes").style.backgroundImage = "url(../img/enter1.png)";
		$("promptServicePhone").style.display = "block";
		movieNames=$("movieName").innerHTML;			
		$("prompt").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;您订购的是“"+movieNames+"”,价格："+price+"元，可以在72小时内使用当前机顶盒反复观看。<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;请问您确认购买吗？";
	}
}

function promptBtn(_num){//购买提示显示
	if(_num==0){
			area=0;//购买提示隐藏
			btnPos=1;//焦点转至右（退出）
			PromptPos=0;//购买提示隐藏
			$("buy").style.backgroundImage = "url()";//购买提示隐藏
			$("prompt").innerHTML = "";//购买提示隐藏
			$("promptYes").style.backgroundImage = "url()";//购买提示隐藏
			$("promptNo").style.backgroundImage = "url()";//购买提示隐藏
			$("promptServicePhone").style.display = "none";
			$("btn0").src = btnArray[0][0];			
			$("btn1").src = btnArray[1][1];//焦点转至右（退出），点亮退出按钮
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
	if(area==0){//如果购买提未显示
		if(btnPos==0){//如果焦点在左
			if(PREV_URL=="")return;
//		else location.href = PREV_URL+"?"+menuPos+"&"+listPos;
			else if(buy==0){//如果没购买
				promptAlert();//调用购买提示框
			}else location.href = "../boFangYeMian.htm";
		}else if(btnPos==1){//如果焦点在右
			if(NEXT_URL=="")return;
//		else location.href = NEXT_URL+"?"+menuPos+"&"+listPos;
			else location.href = "../index.htm";
		}/*else if(btnPos==2){
			location.href = "shouye.htm";
		}else if(btnPos==3){
			location.href = "zhuye.htm";
		}else if(btnPos==4){
			history.go(-1);
		}*/
	}else if(area==1){
		promptSelect();
	}else if(area==2){
		location.href = "../index.htm";
	}
}
//购买确认
function promptSelect(){
	if(PromptPos==1)location.href = "../gouMaiYeMian.htm";
	else promptBtn(0);
	}

//遥控键值2
document.onsystemevent = eventHandler;
//document.onkeypress    = eventHandler;
document.onirkeypress  = eventHandler;
function eventHandler(e,type){
	var key_code = "";
	if(navigator.userAgent.indexOf('iPanel')!=-1){
		   key_code = iPanelKey();
	}else  key_code = e.code || event.which;
	switch(key_code){
//		case "KEY_UP":
//			return 0;
//			break;
			
//		case "KEY_DOWN":
//		if(area==1) promptBtn(0);
//			return 0;
//			break;
			
		case "KEY_LEFT":
		    if(area==0){
			    btnFocus(-1);
			}else if(area==1) promptBtn(1);
			return 0;
			break;
			
		case "KEY_RIGHT": //right
			if(area==0){
				btnFocus(1);
			}else if(area==1) promptBtn(2);
			return 0;
			break;
			
		case "KEY_SELECT": //enter
			doSelect();
		    return 0;
			break;

		case "KEY_BACK": //back
		alert("haha");
//			location.href = "../index.htm";
            document.onkeypress    = eventHandler;
//			history.go(-1);
            location.href = "../paiHang/paihang7.htm";
			break;	
		case 283:
			location.href = "index.htm";
			return 0;
			break;
	}
}

//页面加载后自动执行
function init(){
	$("brief").innerHTML =$("brief").innerHTML.slice(0,190)+"……";
	focusPos();
	btnFocus(0);
	$("price").innerHTML=price;
}