<?php
$connect = mysqli_connect("158.69.108.183:33306","root","10Star.925");

if(!$connect){
	die("mySQLerror".mysqli_error());
}else{
//	echo 'mysqlConnect!<br>';
}

mysqli_select_db($connect,"myLive2.1");

mysqli_set_charset($connect,'utf8');
?>