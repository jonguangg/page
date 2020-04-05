<?php
//	header('Access-Control-Allow-Origin:*');
//	header("Content-type: text/html; charset=UTF-8");
include_once "./connectMysql.php";
ignore_user_abort(true);	//允许PHP后台运行
$tagTableDel = $_POST['tagTableDel'];

//在数据库内删除该分类
	$sql = mysqli_query($connect, "DELETE FROM tag WHERE tagTable='$tagTableDel' ") or die(mysqli_error());

//	$sql2 = mysqli_query($connect, "DROP TABLE $tagTableDel ;") or die(mysqli_error());


if ($sql) {
	$msg = '{"status":"succeed"}';
	echo $msg;
} else {
	echo "失败了";
}



?>