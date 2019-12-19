<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>频道管理</title>
<style>
table{border-collapse:collapse;}
td{border:1px #0066ff solid;height:25px;}
a{text-decoration:none;}
.groupLeft{position:relative;width:49%;height:30px;line-height:30px;text-align:center;border:blue 1px solid; float:left;}
.groupRight{position:relative;width:49%;height:30px;line-height:30px;text-align:center;border:blue 1px solid; float:left;}
</style>
</head>

<body background="bg.jpg" onload="init();">
<div style="position:absolute;top:920px;left:0px;width:90%;text-align:left;font-size:25px; padding-left:20px;">VC直播管理系统 1.0</div>

<div style="position:absolute;top:95px;left:5%; line-height:30px;">
<li onclick="showArea('editGroup');"><a href="#">编辑频道组<a></li>
<li onclick=""><a href="#">批量导入频道列表<a></li>
<li onclick="showArea('addChannel');"><a href="#">添加一个频道<a></li>
<li onclick="showArea('editChannel');"><a href="#">修改频道参数<a></li>
<li><a href="#">用户授权<a></li>
</div>

<!-- 频道组管理 -->
<div id="editGroup" style="position:absolute;top:50px;left:20%;width:75%;display:none;">
	<div style="position:relative;top:0px;left:0px;width:100%;height:30px; text-align:center; float:left;">频道组管理</div>
    <form action="update.php" method="post" id="addChannelForm">
    	<div class="groupLeft">频道组序号</div>        
    	<div class="groupRight">频道组名称</div>
       <div id="groupRow">
            <div class="groupLeft">
              <input style="width:99%;height:90%;border:none;text-align:center;" type="text" name="channelId" placeholder="请输入频道组序号，这里必需输入内容，否则无法提交！" value=""/>
            </div>
            <div class="groupRight">
                <input style="width:99%; height:90%;border:none;text-align:center;" type="text" name="channelId" placeholder="请输入频道组名称，这里必需输入内容，否则无法提交！" value=""/><button style="position:absolute;right:0px;" onclick="deleteGroupRow();">删除该组</button>
            </div>
        </div>
        <div style="position:relative;width:98.5%;height:30px; text-align:center;"><input type="submit" name="subEditGroup" value="提  交" style="width:100px;height:35px;color:blue;font-size:20px;" /></div>
    </form>
</div>

<!-- 新增频道 -->
<div id="addChannel" style="position:absolute;top:50px;left:20%;width:75%;display:none;">
    <form action="update.php" method="post" id="addChannelForm">
        <table width=100% border="1" cellpadding="0" cellspacing="0">
            <caption style="margin-bottom:20px;font-size:25px;">添加频道</caption>
    
            <tr>
                <td style="width:10%; text-align:center;">频道组名称</td>
                <td><!--<input style="width:99%; height:150%;border:none;padding-left:5px;" type="text" name="groupId"/>-->
                <select name="groupId" form="addChannelForm" style="height:25px;font-size:15px; padding-left:5px;">
                	<div id="selectGroup">
                        <option value="0">所有频道</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </div>
                </select>
                </td>
            </tr>
    
            <tr>
                <td style="width:10%; text-align:center;">频道号</td>
                <td> <input style="width:99.3%; height:25px;border:none;padding-left:5px;" type="text" name="channelId" required="required" placeholder="请输入频道号，这里必需输入内容，否则无法提交！"/></td>
            </tr>
    
            <tr>
                <td style="width:10%; text-align:center;">频道名称</td>
                <td> <input style="width:99.3%; height:25px;border:none;padding-left:5px;" type="text" name="channelName" required="required" placeholder="请输入频道名称，这里必需输入内容，否则无法提交！"/></td>
            </tr>
    
            <tr>
                <td style="width:10%; text-align:center;">播放地址</td>
                <td> <input style="width:99.3%; height:25px;border:none;padding-left:5px;" type="text" name="videoUrl" required="required" placeholder="请输入播放地址，这里必需输入内容，否则无法提交！"/></td>
            </tr>
    
            <tr align="center"><td colspan="2"><input type="submit" name="subAddChannel" value="提  交" style="width:100px;height:35px;color:blue;font-size:20px;" /></td></tr>
        </table>
    </form>
</div>

<!--修改频道参数-->
<div id="editChannel" style="position:absolute;top:50px;left:20%;width:75%;display:none;">
    <form action="update.php" method="post" id="editChannelForm">
        <table width=100% border="1" cellpadding="0" cellspacing="0">
            <caption style="margin-bottom:20px;font-size:25px;">修改频道参数</caption>
    
            <tr>
                <td style="width:10%; text-align:center;">原频道组名称</td>
                <td><!--<input style="width:99%; height:150%;border:none;padding-left:5px;" type="text" name="groupId"/>-->
                <select name="groupId" form="editChannelForm" style="height:25px;font-size:15px; padding-left:5px;">
                	<div id="selectGroup">
                        <option value="0">所有频道</option>
                        <option value="1">卫视频道</option>
                    </div>
                </select>
                </td>
                <td style="width:10%; text-align:center;">新频道组名称</td>
                <td><!--<input style="width:99%; height:150%;border:none;padding-left:5px;" type="text" name="groupId"/>-->
                <select name="groupId2" form="editChannelForm" style="height:25px;font-size:15px; padding-left:5px;">
                	<div id="selectGroup">
                        <option value="0">所有频道</option>
                        <option value="1">卫视频道</option>
                    </div>
                </select>
                </td>
                
            </tr>
    
            <tr>
                <td style="width:10%; text-align:center;">原频道号</td>
                <td> <input style="width:98%; height:25px;border:none;padding-left:5px;" type="text" name="channelId" required="required" placeholder="请输入频道号，这里必需输入内容，否则无法提交！"/></td>
                <td style="width:10%; text-align:center;">新频道号</td>
                <td> <input style="width:98%; height:25px;border:none;padding-left:5px;" type="text" name="channelId2" required="required" placeholder="请输入频道号，这里必需输入内容，否则无法提交！"/></td>
            </tr>
    
            <tr>
                <td style="width:10%; text-align:center;">原频道名称</td>
                <td> <input style="width:98%; height:25px;border:none;padding-left:5px;" type="text" name="channelName" required="required" placeholder="请输入频道名称，这里必需输入内容，否则无法提交！"/></td>
                <td style="width:10%; text-align:center;">新频道名称</td>
                <td> <input style="width:98%; height:25px;border:none;padding-left:5px;" type="text" name="channelName2" required="required" placeholder="请输入频道名称，这里必需输入内容，否则无法提交！"/></td>
            </tr>
    
            <tr>
                <td style="width:10%; text-align:center;">原播放地址</td>
                <td> <input style="width:98%; height:25px;border:none;padding-left:5px;" type="text" name="videoUrl" placeholder="这里可以不输入内容"/></td>
                <td style="width:10%; text-align:center;">新播放地址</td>
                <td> <input style="width:98%; height:25px;border:none;padding-left:5px;" type="text" name="videoUrl2" required="required" placeholder="请输入播放地址，这里必需输入内容，否则无法提交！"/></td>
            </tr>
    
            <tr align="center"><td colspan="4"><input type="submit" name="subEditChannel" value="提  交" style="width:100px;height:35px;color:blue;font-size:20px;" /></td></tr>
        </table>
    </form>
</div>

<div id="prompt" style="position:absolute;top:300px;left:0px;width:100%;height:200px;color:red;font-size:30px; text-align:center; display:none;">频道号重复了，<br />请核对修改后重新提交！<br /><br /><button onclick="getID('prompt').style.display = 'none';" style="width:100px;height:30px; line-height:20px;font-size:20px;color:blue;">确 定</button></div>

</body>
</html>

<script type=text/javascript src="groupArr.js"></script>
<script>
function getID(id){return document.getElementById(id);}
var currArea = 'editGroup';
function showArea(id){
	getID('editGroup').style.display = 'none';	
	getID('addChannel').style.display = 'none';	
	getID('editChannel').style.display = 'none';
	getID(id).style.display = 'block';
	currArea = id;
}

function showPrompt(){
	getID('prompt').style.display = 'block';
//	window.setTimeout("getID('prompt').style.display = 'none';",2000);
}


function showGroupTable(){//根据groupArr动态显示频道组表格
	for(var i=0;i<groupArr.length;i++){	
		getID('groupRow').innerHTML += '<div id=groupId'+i+' class="groupLeft"><input style="width:99%;height:90%;border:none;text-align:center;" type="text" name="channelId" required="required" placeholder="请输入频道组序号，这里必需输入内容，否则无法提交！" value='+groupArr[i].groupId+' /></div><div id=groupName'+i+' class="groupRight"><input style="width:99%; height:90%;border:none;text-align:center;" type="text" name="channelId" required="required" placeholder="请输入频道组名称，这里必需输入内容，否则无法提交！" value='+groupArr[i].groupName+' /><button style="position:absolute;right:0px;" onclick="deleteGroupRow('+i+');">删除该组</button></div>'
	}	
}

function insertGroupRow(){
	var row = getID('editGroupTb').rows.length;//一共多少行
	var newRow = getID('editGroupTb').insertRow(row-2);//插入新行
//	for(var i=0;i<2;i++){//依次向新行插入表格列数的单元格
//		var y=newRow.insertCell(i);
//		y.innerHTML="new cell"+i;
//	}
	var newCell0 = newRow.insertCell(0);
	newCell0.innerHTML = '<input style="width:99%; height:25px;border:none;text-align:center;" type="text" name=groupId'+(row-3)+' required="required" placeholder="请输入频道组序号，这里必需输入内容，否则无法提交！"/>';
	
	var newCell1 = newRow.insertCell(1);
	newCell1.innerHTML = '<input style="width:99%; height:25px;border:none;text-align:center;" type="text" name=groupName'+(row-3)+' required="required" placeholder="请输入频道组序号，这里必需输入内容，否则无法提交！"/>';
}

function deleteGroupRow(_num){
	getID("groupId"+_num).style.display = 'none';
	getID("groupName"+_num).style.display = 'none';
}

function init(){
	showGroupTable();
	showArea(currArea);
}

</script>


<?php
include "connectMysql.php";

// 从DBNAME中查询数据库
$sql = 'select * from groups'; 

// 结果集
$result = mysql_query($sql,$connect);

//总的频道组
$groupArr = array();

//初始化一个频道组 
$groupArrInit = array(
	"groupId" => 0,
	"groupName" => "",
);

//扫描数据库频道组，写入总的频道组数组
while( $row = mysql_fetch_assoc($result) ){
//	echo $row["groupName"].'<br>';
	$groupArrInit["groupId"] = $row["groupId"];
	$groupArrInit["groupName"] = $row["groupName"];
	array_push($groupArr,$groupArrInit);
}
echo "<pre>";
//print_r($groupArr);
//var_dump($groupArr);
echo "<pre>";

if( @$_POST['subEditGroup'] ){	//添加频道 
//	for($i=0;$i<$sizeofGroupArr;$i++)
	$sql = @mysql_query("TRUNCATE TABLE groups");
	$i = 0;
	while( $_POST['groupId'.$i] ){
		$groupId = (int)$_POST['groupId'.$i];
		$groupName = $_POST['groupName'.$i];
		$sql = @mysql_query("insert ignore groups(groupId,groupName) values ($groupId,'$groupName')") or die(mysql_error()) ;
		$i ++;
	}     
	if( $sql ){
		echo "<script>location.href='writeGroupArray.php'</script>";    
	}else{
		echo "Error";
	}
}else if( @$_POST['subAddChannel'] ){	//添加频道  
    $groupId = (int)$_POST['groupId'];
    $channelId = $_POST['channelId'];
    $channelName = $_POST['channelName'];
    $videoUrl = $_POST['videoUrl'];
	$query = "select * from channel where channelId='$channelId'";
	$result = @mysql_query($query,$connect);
	if( mysql_fetch_assoc($result) ){
		echo "<script type='text/javascript'>showPrompt();</script>"; 
	}else{
	//不存在，可插入
		$sql = mysql_query("insert into channel(groupId,channelId,channelName,videoUrl) values ('$groupId','$channelId','$channelName','$videoUrl')") or die(mysql_error()) ;
		if( $sql ){
			echo "<script>alert('添加成功');
			location.href='update.php'</script>";    
		}else{
			echo "Error";
		}
	}
    
}else if( @$_POST['subEditChannel'] ){	//修改频道参数 
    @$groupId = (int)$_POST['groupId'];
    $channelId = $_POST['channelId'];
    $channelName = $_POST['channelName'];

    @$groupId2 = (int)$_POST['groupId2'];
    $channelId2 = $_POST['channelId2'];
    $channelName2 = $_POST['channelName2'];
    $videoUrl2 = $_POST['videoUrl2'];
	
    $sql = mysql_query("update channel set groupId='$groupId2',channelId='$channelId2',channelName='$channelName2',videoUrl='$videoUrl2' where (channelId='$channelId' and channelName='$channelName') ") or die(mysql_error()) ;
    if( $sql ){
        echo "<script>alert('修改成功');
        location.href='update.php'</script>";    
    }else{
        echo "Error";
    }
}


?>