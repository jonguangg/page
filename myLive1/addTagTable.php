<?php
//	header('Access-Control-Allow-Origin:*');
//	header("Content-type: text/html; charset=UTF-8");
include_once "./connectMysql.php";
ignore_user_abort(true);	//允许PHP后台运行

$addTagSort = $_POST['addTagSort'];
$addTagName = $_POST['addTagName'];
$addTagTable = $_POST['addTagTable'];

//在数据库内添加分类
$sql = mysqli_query($connect, "insert into tag(tagSort,tagName,tagTable) values ('$addTagSort','$addTagName','$addTagTable')") or die(mysqli_error());

$sql2 = mysqli_query($connect, "CREATE TABLE IF NOT EXISTS $addTagTable like tagModel;") or die(mysqli_error());

$sql3 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`fileName`) REFERENCES `video`(`name`) ON DELETE CASCADE ON UPDATE CASCADE;");

$sql4 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`title`) REFERENCES `video`(`title`) ON DELETE CASCADE ON UPDATE CASCADE;");

if ($sql) {
	$msg = '{"status":"succeed"}';
	echo $msg;
} else {
	echo '{"status":"error"}';
}
