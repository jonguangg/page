<?php
	//	header('Access-Control-Allow-Origin:*');
	//	header("Content-type: text/html; charset=UTF-8");
	include_once "./connectMysql.php";
	include_once "./readTagNav.php";
	ignore_user_abort(true);	//允许PHP后台运行

	$addTagLevel = $_POST['addTagLevel'];
	$addTagSort = $_POST['addTagSort'];
	$addTagName = $_POST['addTagName'];
	$addTagTable = $_POST['addTagTable'];
	
	$tagFather = "";
	for($i=1; $i<sizeof($tagArr)-1; $i++){
		if( (int)$addTagLevel > 1){ //只有2级地区和3级分类才有父级
			for($j=1; $j<sizeof($tagArr[$i]); $j++){
				if( (int)$addTagLevel > $i ){	//$i代表级别，新增的级别大于当前读取的，才需要将其写进父表
					$tagFather = $tagFather.$tagArr[$i][$j]['tagName']."/";
				}		
			}
		}
	}
	$tagFather = "/".$tagFather;

	//在数据库内添加分类
	$sql = mysqli_query($connect, "INSERT INTO tag(tagLevel,tagSort,tagName,tagTable,tagFather) values ('$addTagLevel','$addTagSort','$addTagName','$addTagTable','$tagFather' )") or die(mysqli_error());

	
/*
	$sql2 = mysqli_query($connect, "CREATE TABLE IF NOT EXISTS $addTagTable like tagModel;") or die(mysqli_error());

	$sql12 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`father`) REFERENCES `video`(`father`) ON DELETE CASCADE ON UPDATE CASCADE;");

	$sql7 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`region`) REFERENCES `video`(`region`) ON DELETE CASCADE ON UPDATE CASCADE;");

	$sql13 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`tag`) REFERENCES `video`(`tag`) ON DELETE CASCADE ON UPDATE CASCADE;");

	$sql13 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`poster`) REFERENCES `video`(`poster`) ON DELETE CASCADE ON UPDATE CASCADE;");


	$sql3 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`fileName`) REFERENCES `video`(`name`) ON DELETE CASCADE ON UPDATE CASCADE;");

	$sql4 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`title`) REFERENCES `video`(`title`) ON DELETE CASCADE ON UPDATE CASCADE;");

	$sql5 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`episode`) REFERENCES `video`(`episode`) ON DELETE CASCADE ON UPDATE CASCADE;");

	$sql6 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`episodes`) REFERENCES `video`(`episodes`) ON DELETE CASCADE ON UPDATE CASCADE;");

	$sql8 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`year`) REFERENCES `video`(`year`) ON DELETE CASCADE ON UPDATE CASCADE;");

	$sql9 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`director`) REFERENCES `video`(`director`) ON DELETE CASCADE ON UPDATE CASCADE;");

	$sql10 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`actor`) REFERENCES `video`(`actor`) ON DELETE CASCADE ON UPDATE CASCADE;");

	$sql11 = mysqli_query($connect, "ALTER TABLE  $addTagTable ADD FOREIGN KEY (`score`) REFERENCES `video`(`score`) ON DELETE CASCADE ON UPDATE CASCADE;");
*/
	if ($sql) {
		$msg = '{"status":"succeed"}';
		echo $msg;
	} else {
		echo '失败了';
	}









?>