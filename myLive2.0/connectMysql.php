<?php
$connect = mysqli_connect("127.0.0.1","root","10Star.925");

if(!$connect){
	die("mySQLerror".mysqli_error());
}else{
//	echo 'mysqlConnect!<br>';
}

mysqli_select_db($connect,"myLive1");

mysqli_set_charset($connect,'utf8');
?>