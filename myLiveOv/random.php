<?php
echo "<pre>";

//	计算当前时间 精确到毫秒 这个用来生成卡号
function getMilliSecond( $num ){
    list($msec, $sec) = explode(' ', microtime());
    $msectime =  (float)sprintf('%.0f', (floatval($msec) + floatval($sec)) * 10000);
//    return $msectimes = substr($msectime,0,14);
	$cardIdArr = array();
	for($i=0;$i<$num;$i++){
		$cardIdArr[$i] = substr($msectime,0,14)+$i;
		//接下来写进数据库
	}
//	var_dump( $cardIdArr );
//	print_r ($cardIdArr);
	return $cardIdArr;
}

$arr = getMilliSecond(9);
echo "第一个".$arr[0]."</br>";

/*	利用md5加密当前时间算随机密码
	1、time() 获取当前的 Unix 时间戳
	2、将第一步获取的时间戳进行 md5() 加密
	3、将第二步加密的结果，截取 n 位即得想要的密码
*/
function getPassword( $length ){	//这个用来生成密码，length是密码位数
	$start = mt_rand(0,15);//生成一个随机起始数
	echo $start.PHP_EOL."随机起始数</br>";;
	$str = substr(md5(time()), $start, $length);
	return $str;
}


	echo microtime(true).PHP_EOL."php microtime</br>";
	echo time().PHP_EOL."php time()</br>";
	echo md5( time() ).PHP_EOL."当前时间md5值</br>";
	echo getPassword(16).PHP_EOL."用time生成的16位密码</br>";



echo "</pre>";
?>