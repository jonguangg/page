<?php
//	header('Access-Control-Allow-Origin:*');
//	header("Content-type: text/html; charset=UTF-8");
include_once "./connectMysql.php";
ignore_user_abort(true);	//允许PHP后台运行

$addTagSort = $_POST['addTagSort'];
$addTagName = $_POST['addTagName'];
$addTagTable = $_POST['addTagTable'];
$addTagLevel = $_POST['addTagLevel'];

//在数据库内添加分类
$sql = mysqli_query($connect, "insert into tag(tagSort,tagName,tagTable,tagLevel) values ('$addTagSort','$addTagName','$addTagTable','$addTagLevel')") or die(mysqli_error());

$sql2 = mysqli_query($connect, "CREATE TABLE IF NOT EXISTS $addTagTable like tagModel;") or die(mysqli_error());

$sql3 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`fileName`) REFERENCES `video`(`name`) ON DELETE CASCADE ON UPDATE CASCADE;");

$sql4 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`title`) REFERENCES `video`(`title`) ON DELETE CASCADE ON UPDATE CASCADE;");

$sql5 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`episode`) REFERENCES `video`(`episode`) ON DELETE CASCADE ON UPDATE CASCADE;");

$sql6 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`episodes`) REFERENCES `video`(`episodes`) ON DELETE CASCADE ON UPDATE CASCADE;");

$sql7 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`region`) REFERENCES `video`(`region`) ON DELETE CASCADE ON UPDATE CASCADE;");

$sql8 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`year`) REFERENCES `video`(`year`) ON DELETE CASCADE ON UPDATE CASCADE;");

$sql9 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`director`) REFERENCES `video`(`director`) ON DELETE CASCADE ON UPDATE CASCADE;");

$sql10 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`actor`) REFERENCES `video`(`actor`) ON DELETE CASCADE ON UPDATE CASCADE;");

$sql11 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`score`) REFERENCES `video`(`score`) ON DELETE CASCADE ON UPDATE CASCADE;");

if ($sql) {
	$msg = '{"status":"succeed"}';
	echo $msg;
} else {
	echo '{"status":"error"}';
}
