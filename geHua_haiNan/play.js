
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
	return 'û��Cookie!';
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
//����ҳͼ��
var btnArray = [
	["../img/play0.png","../img/play1.png"], //��������
	["../img/exit0.png","../img/exit1.png"], //�˳�
	["../img/buy0.png","../img/buy1.png"]	 //����
];

//��ֵ
var url = window.location.href;
if(url.indexOf("?") > -1){
	url = url.substr(url.indexOf("?")+1);
	url = url.split("&");
	menuPos = parseInt(url[0]);
	listPos = parseInt(url[1]);
}

//�ж��ڵ�ǰҳ��btnPos���ڵ�λ��
function focusPos(){
	if(PREV_URL==""&&NEXT_URL!=""){ //��һҳ
		btnPos = 0;
		btnFocus(0);
	}
	else if(NEXT_URL!=""&&PREV_URL!=""){ //�м�ҳ
		btnPos = 0;
		btnFocus(0);
	}
	else if(PREV_URL!=""&&NEXT_URL==""){ //���һҳ
		btnPos = 0;
		//$("btn1").src = "tm.gif";
		btnFocus(0);
	}
	else if(PREV_URL==""&&NEXT_URL==""){ //ֻ��һҳ
		btnPos = 0;
		btnFocus(0);
//		$("btn0").src = "tm.gif";
//		$("btn1").src = "tm.gif";
	}
}

//�򻯴���
function $(id){
	return document.getElementById(id);
}

//��ť����
function btnFocus(__num){//����ͼ��
	if(buy==false){
		btnArray[0][0]=btnArray[2][0];	
		btnArray[0][1]=btnArray[2][1];	
	}
	$("btn"+btnPos).src = btnArray[btnPos][0];//�ȱ��֮ǰ�Ľ���ͼ��
	btnPos+=__num;
	if(btnPos<0){ btnPos=0; }
	else if(btnPos>1){ btnPos = 1; }
	$("btn"+btnPos).src = btnArray[btnPos][1];//�ٵ���֮��Ľ���ͼ��
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

function promptAlert(){//��ʾ������
	area=1;
	if(account<price){//����
		$("buy").style.backgroundImage = "url(../img/buyBg1.png)";
		$("promptNo").style.backgroundImage = "url(../img/back1.png)";
		$("promptServicePhone").style.display = "block";
	}else {
		PromptPos = 1;
		$("buy").style.backgroundImage = "url(../img/buyBg0.png)";	
		$("promptYes").style.backgroundImage = "url(../img/enter1.png)";
		$("promptServicePhone").style.display = "block";
		movieNames=$("movieName").innerHTML;			
		$("prompt").innerHTML = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;���������ǡ�"+movieNames+"��,�۸�"+price+"Ԫ��������72Сʱ��ʹ�õ�ǰ�����з����ۿ���<br />&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;������ȷ�Ϲ�����";
	}
}

function promptBtn(_num){//������ʾ��ʾ
	if(_num==0){
			area=0;//������ʾ����
			btnPos=1;//����ת���ң��˳���
			PromptPos=0;//������ʾ����
			$("buy").style.backgroundImage = "url()";//������ʾ����
			$("prompt").innerHTML = "";//������ʾ����
			$("promptYes").style.backgroundImage = "url()";//������ʾ����
			$("promptNo").style.backgroundImage = "url()";//������ʾ����
			$("promptServicePhone").style.display = "none";
			$("btn0").src = btnArray[0][0];			
			$("btn1").src = btnArray[1][1];//����ת���ң��˳����������˳���ť
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

//ȷ�ϼ���Ӧ����
function doSelect(){
	if(area==0){//���������δ��ʾ
		if(btnPos==0){//�����������
			if(PREV_URL=="")return;
//		else location.href = PREV_URL+"?"+menuPos+"&"+listPos;
			else if(buy==0){//���û����
				promptAlert();//���ù�����ʾ��
			}else location.href = "../boFangYeMian.htm";
		}else if(btnPos==1){//�����������
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
//����ȷ��
function promptSelect(){
	if(PromptPos==1)location.href = "../gouMaiYeMian.htm";
	else promptBtn(0);
	}

//ң�ؼ�ֵ2
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

//ҳ����غ��Զ�ִ��
function init(){
	$("brief").innerHTML =$("brief").innerHTML.slice(0,190)+"����";
	focusPos();
	btnFocus(0);
	$("price").innerHTML=price;
}