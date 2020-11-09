<?php
$connect = mysqli_connect("128.1.52.178:33306","root","10Star.925");

if(!$connect){
	die("mySQLerror".mysqli_error());
}else{
//	echo 'mysqlConnect!<br>';
}

mysqli_select_db($connect,"myLive");

mysqli_set_charset($connect,'utf8');
?>