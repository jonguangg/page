<?php
$connect = mysqli_connect("localhost","root","123456");

if(!$connect){
	die("error".mysqli_error());
}else{
//	echo 'mysqlConnect!<br>';
}

mysqli_select_db($connect,"mylive");

mysqli_set_charset($connect,'utf8');
?>