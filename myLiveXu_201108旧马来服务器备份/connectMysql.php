<?php
$connect = mysqli_connect("128.1.160.114:33306","root","10Star.925");

if(!$connect){
//	die("mySQLerror".mysqli_error());
//	echo '<script>alert("'.mysqli_error().'")</script>';
}else{
//	echo '<script>alert("mysqlConnect!")</script>';
}

mysqli_select_db($connect,"myLive");

mysqli_set_charset($connect,'utf8');
?>