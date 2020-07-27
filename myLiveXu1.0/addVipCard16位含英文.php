<?php
//echo "<pre>"; 
set_time_limit(0); //	设置超时时间 

	$addCardNum = $_POST["addCardNum"];//$_GET["addCardNum"];
	$days = $_POST["days"];//$_GET["days"];

function getMilliSecond( $num ){//	计算当前时间 精确到毫秒(14位) 这个用来生成卡号
    list($msec, $sec) = explode(' ', microtime());
    $msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 10000);
    $msectimes = substr($msectime,0,14);	//14位时间戳
	$msectimes = $msectimes*100;			//加00变为16位
//	echo $msectimes;
	$cardId = array();
	for($i=0;$i<$num;$i++){
		$cardId[$i] = $msectimes+$i;
	}
//	var_dump( $cardId );
//	print_r ($cardId);
	return $cardId;
}

/*	利用md5加密当前时间算随机密码
	1、time() 获取当前的 Unix 时间戳
	2、将第一步获取的时间戳进行 md5() 加密
	3、生成一个随机起始数,将第二步加密的结果，从起始数开始截取 n 位即得想要的密码
*/
function getPassword( $length ){	//这个用来生成一个密码，length是密码位数
	$start = mt_rand(0,15);//生成一个随机起始数(没有太大的必要，从0开始也是可以的)
//	echo "随机起始数 ".$start.PHP_EOL."</br>";
	$str = substr(md5(time()), $start, $length);
	$str = strtoupper($str);	//转大写
	return $str;
}

function addPassword($num){
	$cardKeyArr = array();	//定义一个数组，用来存储密码
	for($i=0;$i<$num;$i++){
		$cardKey = getPassword(16);	//生成1个密码
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

*/

//	echo "</pre>";
?>
