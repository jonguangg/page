<?php
//echo "<pre>"; 
set_time_limit(0); //	设置超时时间 

	$addCardNum = $_POST["addCardNum"];		//$_GET["addCardNum"];
	$days = $_POST["days"];					//$_GET["days"];

function getMilliSecond( $num ){//	计算当前时间 精确到毫秒(14位) 这个用来生成卡号，$num是一次生成的数量
    list($msec, $sec) = explode(' ', microtime());
    $msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 10000);
    $msectimes = substr($msectime,5,8);		//8位时间戳，最长支持14位，所以8前面的数字不能大于6
//	$msectimes = $msectimes*100;			//加00变为16位
//	echo $msectimes;
	$cardId = array();
	for($i=0;$i<$num;$i++){
		$cardId[$i] = $msectimes+$i;
	}
//	var_dump( $cardId );
//	print_r ($cardId);
	return $cardId;
}

//随机生成8位数字
function getPassword() {
	$seed = array(0,1,2,3,4,5,6,7,8,9);
	$str = '';
	for($i=0;$i<8;$i++) {
		$rand = rand(0,count($seed)-1);
		$temp = $seed[$rand];
		$str .= $temp;
		unset($seed[$rand]);
		$seed = array_values($seed);
	}
	return $str;
}

function addPassword($num){
	$cardKeyArr = array();	//定义一个数组，用来存储密码
	for($i=0;$i<$num;$i++){
		$cardKey = getPassword();	//生成1个密码
		$cardKeyArr[$i] = $cardKey;	//存储密码
	}
	return $cardKeyArr;
}

function addCardIdAndKey($num,$days){
	$cardIdArray = getMilliSecond($num);	
	$cardKeyArray = addPassword($num);
	include('connectMysql.php'); 
	for($i=0;$i<$num;$i++){	
	//	echo "</br>第".$i."个卡号".$cardIdArray[$i]."</br>";
	//	echo "第".$i."个密码".$cardKeyArray[$i]."</br>";
		$sql = mysqli_query($connect,"replace into vipCard(cardId,cardKey,licenseDays) values ('$cardIdArray[$i]','$cardKeyArray[$i]','$days')") or die(mysqli_error($connect)) ;
	}
	setcookie("addCardNum", $num, time()+3600);//一共多少张，cookie存60分钟，给readVipCardArray.php用来下载新生成的卡
	setcookie("startCardId", $cardIdArray[0], time()+3600);//第一个卡号，cookie存60分钟，给readVipCardArray.php用
}

if($addCardNum >0 && $days >0){
	addCardIdAndKey($addCardNum,$days);	
}

//	$statusJsonStr = '{"status":"succeed"}';	//定义一个JSON格式的字符串
//	echo $statusJsonStr;						//直接返回给前端
	
	$statusArr = array(
		"status"=>"succeed"
	);
	$json_obj = json_encode($statusArr);		//转换成JSON格式
	echo $json_obj;	

//	echo json_encode($statusArr);
//	echo "succeed";


/*
	echo microtime(true).PHP_EOL."php microtime</br>";
	echo time().PHP_EOL."php time()</br>";
	echo md5( time() ).PHP_EOL."当前时间md5值</br>";
	echo getPassword(16).PHP_EOL."用time生成的16位密码</br>";

	echo "</pre>";
*/
?>
