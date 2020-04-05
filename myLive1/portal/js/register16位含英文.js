function checkInput(){
	var clientHeight  = window.innerHeight;
	getID("msg").style.lineHeight = clientHeight*0.35+"px";
	if( getID("card_id").value.length<19 ){
		getID("msg").style.backgroundColor = "#234567";	
		getID("msg").innerHTML = "Please enter the card key!";
	}else if( getID("card_key").value.length<19 ){
		getID("msg").style.backgroundColor = "#234567";	
		getID("msg").innerHTML = "Please enter the PIN code!";
	}else{
		var cardIdPost = getID("card_id").value.replace(/-/g, "");//把每4位中间的横杠删掉
		var cardKeyPost = getID("card_key").value.replace(/-/g, "");
	//	getID("msg").innerHTML = sn;
		sendAjax("./ajax.php","sn="+sn+"&cardId="+cardIdPost+"&cardKey="+cardKeyPost);
	}
}

//监听input value
var lastLength = 0;
// Firefox, Google Chrome, Opera, Safari, Internet Explorer from version 9
function onInputHandler(event,_id) {
//    console.log("刚输入的是："+event.target.value);
	if( lastLength < event.target.value.length ){	//上次字数少于当前字数，说明新加了，否则就是删除
		if( event.target.value.length==4 ||  event.target.value.length==9 ||  event.target.value.length==14 ){
		/*	if( _id=="card_id" ){
				getID("card_id").value += "-"
			}else if( _id=="card_key" ){
				getID("card_key").value += "-"
			}*/
			event.target.value += "-"
		}
	}
	lastLength = event.target.value.length;	//存储当前字数
	if( event.target.value.length==16 && event.target.value.indexOf("-")<0){//16位没有横杠，说明是直接复制过来的
		var temp = event.target.value;
		temp = temp.slice(0, 4) + "-" + temp.slice(4);
		temp = temp.slice(0, 9) + "-" + temp.slice(9);
		temp = temp.slice(0, 14) + "-" + temp.slice(14);
		event.target.value = temp;
	}
}
// Internet Explorer 目前这个是手机页面，这个函数可以不用
function onPropertyChangeHandler(event) {
    if (event.propertyName.toLowerCase () == "value") {
//        console.log(event.srcElement.value);
		if( event.target.value.length==4 ||  event.target.value.length==9 ||  event.target.value.length==14 ){
			getID("card_key").value += "-"
		}
    }
}