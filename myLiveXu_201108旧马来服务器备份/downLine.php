<?php
	include_once "connectMysql.php";
//	include_once "readStbArray.php";
//	echo '数据库中有 '.count($stbArr).' 个机顶盒';
	error_reporting(E_ALL^E_NOTICE^E_WARNING);
	set_time_limit(0); //	设置超时时间
//	00,05,10,15,20,25,30,35,40,45,50,55 * * * * /usr/bin/php /usr/local/nginx/html/myLive/downLine.php



//	$sql = mysqli_query($connect,"update client set isonline='离线' where sn='1713238039586400-00-00-00-00-00-00-00-00-00-00-00-00-00-00-00ecfa5c213097' ") or die(mysqli_error()) ;


	$sql = mysqli_query($connect,"update client set isOnLine='离线' ")or die(mysqli_error()) ;



?>