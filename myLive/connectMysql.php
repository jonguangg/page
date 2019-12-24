<?php
$connect = mysqli_connect("localhost","root","10Star.925");

if(!$connect){
	die("error".mysqli_error());
}else{
//	echo 'mysqlConnect!<br>';
}

mysqli_select_db($connect,"myLive");

mysqli_set_charset($connect,'utf8');
?>