<?php
	include "readGroupArray.php";	//为了快速预览,不从js文件读数据,而从mqsql读
	include "readChannelArray.php"; //为了快速预览,不从js文件读数据,而从mqsql读	
	include "readStbArray.php";
	$insertToday = date("Y-m-d");
	$insertExpiretime = date("Y-m-d",strtotime("+31 day"));
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<meta http-equiv="pragma" content="no-cache">
<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
<meta http-equiv="expires" content="0">
<title>VC直播管理系统</title>
<style>
	*{}
	table{border-collapse:collapse;}
	td{border:1px #0066ff solid;height:25px;valign:middle;}
	a{text-decoration:none;}
	.groupLeft{position:relative;width:49%;height:30px;line-height:30px;text-align:center;border:blue 1px solid; float:left;}
	.groupRight{position:relative;width:49%;height:30px;line-height:30px;text-align:center;border:blue 1px solid; float:left;}
	.button{width:100px;height:35px;color:blue;font-size:20px;}

	.channels{position:relative;left:0px;top:0px;width:450px;height:9%;line-height:50px;color:white;}
	.channel{position:absolute;top:0px;left:90px;width:360px;height:50px;line-height:50px;text-align:center;}
	.channelID{position:absolute;top:0px;left:40px;width:50px;height:50px;line-height:50px;text-align:left;color:white;}
	
</style>
</head>

<body background="bg.jpg" onload="init();">
<div style="position:fixed;top:20px;left:0px;width:90%;text-align:left;font-size:25px; padding-left:20px;">VC直播管理系统 1.0</div>

<div style="position:fixed;top:95px;left:5%; line-height:30px;">
<a id="a0" name="editGroup" onclick="showArea('editGroup');" href="#">编辑频道组</a><br />
<a id="a1" name="addChannel" onclick="showArea('addChannel');" href="#">添加一个频道</a><br />
<a id="a2" name="editChannel" onclick="showArea('editChannel');" href="#">修改频道参数</a><br />
<a id="a3" name="editChannelList" onclick="showArea('editChannelList');" href="#">编辑频道列表</a><br />
<a id="a4" name="upLoad" onclick="showArea('upLoad');" href="#">批量导入频道列表</a><br />
<a id="a5" name="preview" onclick="showArea('preview');" href="#">预览频道列表</a><br />
<a id="a6" name="stb" onclick="showArea('stb');" href="#">客户端管理</a><br />
</div>

<!-- 频道组管理 -->
<div id="editGroup" style="position:absolute;top:50px;left:20%;width:75%;display:none;">
	<form action="update.php" method="post" id="editGroupForm">
<!--        <div id="groupRow"> -->
        <table id="editGroupTb" width=100% border="1" cellpadding="0" cellspacing="0">
            <caption style="margin-bottom:20px;font-size:25px;">频道组管理</caption>
            <tr>
                <td style="width:50%; text-align:center;"><b>频道组序号</b></td>
                <td style="width:50%; text-align:center;"><b>频道组名称</b></td>
            </tr>
            <!--<tr>
                <td> <input style="width:99%; height:25px;border:none;text-align:center;" type="text" name="groupId0" required="required" placeholder="请输入频道组序号，这里必需输入内容，否则无法提交！"/></td>
                <td> <input style="width:84%; height:25px;border:none;text-align:center;" type="text" name="groupName0" required="required" placeholder="请输入频道组名称，这里必需输入内容，否则无法提交！"/><button style="position:absolute;right:0px;" onclick="deleteGroupRow();">删除该组</button></td>
            </tr>
        </div>-->
            <tr align="right">
                <td  colspan="2"><button onclick="insertGroupRow();">添加频道组</button></td>
            </tr>    
    
            <tr align="center"><td colspan="2"><!--<button class="button" onclick="window.location.reload();">刷新</button>&nbsp;--><input type="submit" name="subEditGroup" value="提  交" class="button" /><span style="color:red;"><br />请谨慎操作，提交后将清空之前的数据，然后再写入当前数据</span></td></tr>
        </table>
    </form>
</div><!--</div>

 新增频道 -->
<div id="addChannel" style="position:absolute;top:50px;left:20%;width:75%;display:none;">
    <form action="update.php" method="post" id="addChannelForm">
        <table width=100% border="1" cellpadding="0" cellspacing="0">
            <caption style="margin-bottom:20px;font-size:25px;">添加频道</caption>
    
            <tr>
                <td style="width:10%; text-align:center;">频道组名称</td>
                <td><!--<input style="width:99%; height:150%;border:none;padding-left:5px;" type="text" name="groupId"/>-->
                <select id="selectGroup" name="groupId" form="addChannelForm" style="height:25px;font-size:15px; padding-left:5px;">
                   <!-- <option value="0">所有频道</option>
                    <option value="1">1</option>
                    <option value="2">2</option>-->
                </select>
                </td>
            </tr>
    
            <tr>
                <td style="width:10%; text-align:center;">频道排序</td>
                <td> <input style="width:99.3%; height:25px;border:none;padding-left:5px;" type="text" name="channelId" required="required" placeholder="请输入频道号，这里必需输入内容，否则无法提交！" autocomplete="off"/></td>
            </tr>
    
            <tr>
                <td style="width:10%; text-align:center;">频道名称</td>
                <td> <input style="width:99.3%; height:25px;border:none;padding-left:5px;" type="text" name="channelName" required="required" placeholder="请输入频道名称，这里必需输入内容，否则无法提交！" autocomplete="off"/></td>
            </tr>
    
            <tr>
                <td style="width:10%; text-align:center;">播放地址</td>
                <td> <input style="width:99.3%; height:25px;border:none;padding-left:5px;" type="text" name="videoUrl" required="required" placeholder="请输入播放地址，这里必需输入内容，否则无法提交！"/></td>
            </tr>
    
            <tr align="center"><td colspan="2"><input type="submit" name="subAddChannel" value="提  交" style="width:100px;height:35px;color:blue;font-size:20px;" autocomplete="off"/></td></tr>
        </table>
    </form>
	<br>
	<li>请先添加频道组，再在相应组内添加频道</li>
</div>

<!--修改频道参数-->
<div id="editChannel" style="position:absolute;top:50px;left:20%;width:75%;display:none;">
    <form action="update.php" method="post" id="editChannelForm">
        <table width=100% border="1" cellpadding="0" cellspacing="0">
            <caption style="margin-bottom:20px;font-size:25px;">修改频道参数</caption>
    
            <tr>
                <td style="width:10%; text-align:center;">原频道组名称</td>
                <td><!--<input style="width:99%; height:150%;border:none;padding-left:5px;" type="text" name="groupId"/>-->
                <select id="selectGroup1" name="groupId" form="editChannelForm" style="height:25px;font-size:15px; padding-left:5px;">
<!--                    <option value="0">所有频道</option>
                    <option value="1">卫视频道</option>-->
                </select>
                </td>
                <td style="width:10%; text-align:center;">新频道组名称</td>
                <td><!--<input style="width:99%; height:150%;border:none;padding-left:5px;" type="text" name="groupId"/>-->
                <select id="selectGroup2" name="groupId2" form="editChannelForm" style="height:25px;font-size:15px; padding-left:5px;">
<!--                    <option value="0">所有频道</option>
                    <option value="1">卫视频道</option>-->
                </select>
                </td>
                
            </tr>
    
            <tr>
                <td style="width:10%; text-align:center;">原频道号</td>
                <td> <input style="width:98%; height:25px;border:none;padding-left:5px;" type="text" name="channelId" required="required" placeholder="请输入频道号，这里必需输入内容，否则无法提交！" autocomplete="off"/></td>
                <td style="width:10%; text-align:center;">新频道号</td>
                <td> <input style="width:98%; height:25px;border:none;padding-left:5px;" type="text" name="channelId2" required="required" placeholder="请输入频道号，这里必需输入内容，否则无法提交！" autocomplete="off"/></td>
            </tr>
    
            <tr>
                <td style="width:10%; text-align:center;">原频道名称</td>
                <td> <input style="width:98%; height:25px;border:none;padding-left:5px;" type="text" name="channelName" required="required" placeholder="请输入频道名称，这里必需输入内容，否则无法提交！" autocomplete="off"/></td>
                <td style="width:10%; text-align:center;">新频道名称</td>
                <td> <input style="width:98%; height:25px;border:none;padding-left:5px;" type="text" name="channelName2" required="required" placeholder="请输入频道名称，这里必需输入内容，否则无法提交！" autocomplete="off"/></td>
            </tr>
    
            <tr>
                <td style="width:10%; text-align:center;">原播放地址</td>
                <td> <input style="width:98%; height:25px;border:none;padding-left:5px;" type="text" name="videoUrl" placeholder="这里可以不输入内容" autocomplete="off"/></td>
                <td style="width:10%; text-align:center;">新播放地址</td>
                <td> <input style="width:98%; height:25px;border:none;padding-left:5px;" type="text" name="videoUrl2" required="required" placeholder="请输入播放地址，这里必需输入内容，否则无法提交！" autocomplete="off"/></td>
            </tr>
    
            <tr align="center"><td colspan="4"><input type="submit" name="subEditChannel" value="提  交" style="width:100px;height:35px;color:blue;font-size:20px;" /></td></tr>
        </table>
    </form>
</div>

<!-- 加载提示 -->
<div id="loading" style="position:fixed;top:260px;left:10%;width:80%;height:50px; font-size:30px; text-align:center;">正在努力加载数据<br />请稍候片刻！</div>

<!-- 编辑频道列表 -->
<div id="editChannelList" style="position:absolute;top:50px;left:20%;width:75%;display:none;">
	<form action="update.php" method="post" id="editChannelListForm">
        <table id="editChannelListTb" width=100% border="1" cellpadding="0" cellspacing="0">
            <caption style="margin-bottom:20px;font-size:25px;">编辑频道列表</caption>
            <tr>
                <td style="width:8%; text-align:center;"><b>频道组号</b></td>
                <td style="width:8%; text-align:center;"><b>频道组名</b></td>
                <td style="width:8%; text-align:center;"><b>频道序号</b></td>
                <td style="width:20%; text-align:center;"><b>频道名称</b></td>
                <td style="width:56%; text-align:center;"><b>播放地址</b></td>
            </tr>
            <tr align="right">
                <td  colspan="5"><button onclick="insertChannelListRow();">添加频道</button></td>
            </tr>    
            <tr align="center"><td colspan="5"><input type="submit" name="subEditChannelList" value="提  交" class="button" /><span style="color:red;"><br />请谨慎操作，提交后将清空之前的数据，然后再写入当前数据<br /></span><span>经测试，在这里提交，服务器响应很慢，故修改较多时请使用 excel 表格上传<br />若修改较少，请使用 ”修改频道参数“</span></td></tr>
        </table>
    </form>
</div><!--</div>-->

<!--  批量导入频道列表  -->
<div id="upLoad" style="position:absolute;top:80px;left:20%;width:75%;height:120px;text-align:center; display:none;">
	<h1>请选择excel文件再上传</h1><br /><br />
    <form enctype="multipart/form-data" action="./upLoad.php?action=excel" method="post" name="excel" id="excel">
        <input type="hidden" name="MAX_FILE_SIZE" value="104857600" /><!-- value单位是字节（Bytes），除以1024得到KB，再除以1024得到MB，10485760是10M -->
        <input type="file" name="excel" accept=".xls,.xlsx" style="font-size:35px;"/>
        <input type="submit" value="上传频道列表" style="width:150px;height:50px;background:transparent url(upLoad.png);border:0px; font-size:20px; font-weight:900;cursor:pointer;"/>
    </form>
	<br><br><button onclick="window.open('download.php');" style="width:120px;height:50px;background:transparent url(upLoad.png);background-size:100% 100%;border:0px; font-size:20px; font-weight:900;cursor:pointer;">下载样表</button><br><br>
    <span style="color:red;"><br />请仔细核对 excel 表格的格式，上传后将清空之前的数据！然后再写入新表格内的数据</span>
</div>

<!-- 预览频道列表   
<div id="preview" style="position:absolute;top:0px;right:0px;width:450px;height:100%;display:none;">
	<iframe align="absmiddle" src="myLive/preview.html" style="position:absolute;left:0px;top:0px;width:450px;height:100%;" frameborder="no" border="0" marginwidth="0" marginheight="0" scrolling="no" allowTransparency="yes"></iframe>
</div>-->
<div id="preview" style="position:absolute;top:0px;right:0px;width:450px;height:100%;background:rgba(0,0,0,0.6);display:none;">
	<!-- 频道组 -->
	<div id="group" style="top:0px;left:5px;width:450px;height:10%;line-height:70px;text-align:center;color:white;"><&emsp;<span id="groupName">所有频道</span>&emsp;></div>
    <!-- 频道列表 -->
    <div id="channels0" class="channels" style="background:rgba(0,0,0,0);">
        <div id="channelId0" class="channelID"></div>
        <div id="channel0" class="channel"></div>
    </div>
    
    <div id="channels1" class="channels" style="background:rgba(0,0,0,0);">
        <div id="channelId1" class="channelID"></div>
        <div id="channel1" class="channel"></div>
    </div>
    
    <div id="channels2" class="channels" style="background:rgba(0,0,0,0);">
        <div id="channelId2" class="channelID"></div>
        <div id="channel2" class="channel"></div>
    </div>
    
    <div id="channels3" class="channels" style="background:rgba(0,0,0,0);">
        <div id="channelId3" class="channelID"></div>
        <div id="channel3" class="channel"></div>
    </div>
    
    <div id="channels4" class="channels" style="background:rgba(0,0,0,0);">
        <div id="channelId4" class="channelID"></div>
        <div id="channel4" class="channel"></div>
    </div>
    
    <div id="channels5" class="channels" style="background:rgba(0,0,0,0);">
        <div id="channelId5" class="channelID"></div>
        <div id="channel5" class="channel"></div>
    </div>
    
    <div id="channels6" class="channels" style="background:rgba(0,0,0,0);">
        <div id="channelId6" class="channelID"></div>
        <div id="channel6" class="channel"></div>
    </div>
    
    <div id="channels7" class="channels" style="background:rgba(0,0,0,0);">
        <div id="channelId7" class="channelID"></div>
        <div id="channel7" class="channel"></div>
    </div>
    
    <div id="channels8" class="channels" style="background:rgba(0,0,0,0);">
        <div id="channelId8" class="channelID"></div>
        <div id="channel8" class="channel"></div>
    </div>
    
    <div id="channels9" class="channels" style="background:rgba(0,0,0,0);">
        <div id="channelId9" class="channelID"></div>
        <div id="channel9" class="channel"></div>
    </div>
</div>

<!-- 客户端管理 -->
<div id="stb" style="position:absolute;top:50px;left:15%;width:84%; text-align:center;display:none;">
	<form action="update.php" method="post" id="stbForm" name="stbForm">
        <table id="stbTb" width=100% border="1" cellpadding="0" cellspacing="0">
            <caption style="margin-bottom:20px;font-size:25px;">客户端管理</caption>
            <tr>
                <td style="width:22%; text-align:center;"><b>客户号</b></td>
                <td style="width:9%; text-align:center;"><b>备注</b></td>
                <td style="width:10%; text-align:center;"><b>登陆IP</b></td>
                <td style="width:10%; text-align:center;"><b>登陆地区</b></td>
                <td style="width:12%; text-align:center;"><b>注册日期</b></td>
                <td style="width:12%; text-align:center;"><b>到期日期</b></td>
                <td style="width:12%; text-align:center;"><b>最近登陆</b></td>
                <td style="width:7%; text-align:center;"><b>是否在线</b></td>
                <td style="width:6%; text-align:center;"><b>提交更新</b></td>
            </tr>
            <tr align="right">
                <td  colspan="9"><button onclick="insertStbRow();">添加机顶盒</button></td>
            </tr>    
            <tr align="center"><td colspan="9"><input type="submit" name="subStb" value="批量提交" class="button" /></td></tr>
        </table>
    </form>
    <br />
    <li>注册用户总数：<span id="stbCount"></span></li>
    <li>在线用户总数：<span id="stbOnline"></span></li>
	<br>
	<button class="button" onclick="window.open('excelExportStb.php');" style="cursor:pointer;">下 载</button>
</div>

<div id="prompt" style="position:absolute;top:300px;left:0px;width:100%;height:200px;color:red;font-size:30px; text-align:center; display:none;">频道号重复了，<br />请核对修改后重新提交！<br /><br /><button onclick="getID('prompt').style.display = 'none';" style="width:100px;height:30px; line-height:20px;font-size:20px;color:blue;">确 定</button></div>

</body>
</html>

<script type=text/javascript src="global.js"></script>
<script type=text/javascript src="key.js"></script>
<!-- <script type=text/javascript src="groupArr.js"></script> -->
<script type=text/javascript src="dataJs.js"></script>
<script src="jquery-1.11.0.min.js"></script>
<script>
function getID(id){return document.getElementById(id);}
var currArea = getCookie("currArea")?getCookie("currArea"):'editGroup';
//var tbRow = 3;
var groupArr = <?php echo json_encode($groupArr);?>;
var dataArr = <?php echo json_encode($channelArr);?>;
var stbArr = <?php echo json_encode($stbArr);?>;
//console.log(stbArr[6].lasttime);
//console.log(dataArr);
//console.log(stbArr);
var groupId = 0;
var channelPos = 0;
var channelPagePos = 0;
var channelPageAll = parseInt((channelCount-1+10)/10);
var channelCount = 0;
//var channelPagePosTemp = 0;
//var channelPosTemp = 0;
var channelArr = [];
for(i=0;i<dataArr.length;i++){//合并所有频道为一个数组 
	channelArr = channelArr.concat( dataArr[i].channel );
}

//console.log(channelArr[ channelArr.length-1 ].name);

var channelTempArr = [];//当前显示的频道组 
var groupSizeArr = [];//每个频道的节目数  
for(i=0;i<dataArr.length;i++){
	groupSizeArr.push( dataArr[i].channel.length );
}
//	console.log( groupSizeArr );

function showArea(id){
/*	getID('editGroup').style.display = 'none';	
	getID('addChannel').style.display = 'none';	
	getID('editChannel').style.display = 'none';
	getID('editChannelList').style.display = 'none';
	getID('upLoad').style.display = 'none';	
	getID('preview').style.display = 'none';
	*/
	getID(currArea).style.display = 'none';
	getID(id).style.display = 'block';
	currArea = id;
	for(i=0;i<7;i++){
		getID('a'+i).style.color = 'blue';
		if( getID('a'+i).name == id ){
			getID('a'+i).style.color = 'red';
		}
	}
	if( currArea=='addChannel'){
		getID('selectGroup').innerHTML = '';
		for(i=0;i<groupArr.length;i++){
			getID('selectGroup').innerHTML += '<option value='+groupArr[i].groupId+'>'+groupArr[i].groupName+'</option>';
		}
	}
	if( currArea=='editChannel'){
		getID('selectGroup1').innerHTML = '';
		getID('selectGroup2').innerHTML = '';
		for(i=0;i<groupArr.length;i++){
			getID('selectGroup1').innerHTML += '<option value='+groupArr[i].groupId+'>'+groupArr[i].groupName+'</option>';
			getID('selectGroup2').innerHTML += '<option value='+groupArr[i].groupId+'>'+groupArr[i].groupName+'</option>';
		}
	}
	if( currArea=='editChannelList'){
		getID('loading').style.display = 'block';
	}else{
		getID('loading').style.display = 'none';
	}
	if( currArea=='preview'){
		showChannel(0);
		moveChannel(0);
	}
	setCookie("currArea", currArea, '1d');
}

function showPrompt(){
	getID('prompt').style.display = 'block';
	window.setTimeout("getID('prompt').style.display = 'none';",5000);
}

function showGroupTable(){//根据groupArr动态显示频道组表格
	for(var i=0;i<groupArr.length;i++){	
		var row = getID('editGroupTb').rows.length;//一共多少行
		var newRow = getID('editGroupTb').insertRow(row-2);//插入新行
		var newCell0 = newRow.insertCell(0);
		newCell0.innerHTML = '<input id=input'+i+' style="width:99%; height:25px;border:none;text-align:center;" type="text" name=groupId'+i+' required="required" placeholder="请输入频道组序号，这里必需输入内容，否则无法提交！" autocomplete="off" value='+groupArr[i].groupId+' />';
		
		var newCell1 = newRow.insertCell(1);
		newCell1.innerHTML = '<input style="width:99%; height:25px;border:none;text-align:center;" type="text" name=groupName'+i+' required="required" placeholder="请输入频道组序号，这里必需输入内容，否则无法提交！" autocomplete="off" value='+groupArr[i].groupName+' /><button style="position:absolute;right:0px;" onclick="deleteGroupRow('+groupArr[i].groupId+');">删除该组</button>';
	}	
	setCookie("tbRow", row, '1d');
}

function showChannelList(){//根据channelArr动态显示频道组表格	
//	alert("一共有"+channelArr.length+"个频道");
	for(var i=0;i<channelArr.length;i++){
		var row = getID('editChannelListTb').rows.length;//一共多少行
		var newRow = getID('editChannelListTb').insertRow(row-2);//插入新行	
		
		var newCell0 = newRow.insertCell(0);
		newCell0.innerHTML = '<input id=input'+i+' style="width:99%; height:25px;border:none;text-align:center;" type="text" name=groupId'+i+' required="required" placeholder="请输入频道组序号，这里必需输入内容，否则无法提交！" autocomplete="off" value='+channelArr[i].groupId+' />';
		
		var newCell1 = newRow.insertCell(1);
		newCell1.innerHTML = '<input style="width:99%; height:25px;border:none;text-align:center;" type="text" name=groupName'+i+' required="required" placeholder="请输入频道组序号，这里必需输入内容，否则无法提交！" autocomplete="off" value='+channelArr[i].groupName+' />';
		
		var newCell2 = newRow.insertCell(2);
		newCell2.innerHTML = '<input style="width:99%; height:25px;border:none;text-align:center;" type="text" name=channelId'+i+' required="required" placeholder="请输入频道组序号，这里必需输入内容，否则无法提交！" autocomplete="off" value='+channelArr[i].channelId+' />';
		
		var newCell3 = newRow.insertCell(3);
		newCell3.innerHTML = '<input style="width:99%; height:25px;border:none;text-align:center;" type="text" name=channelName'+i+' required="required" placeholder="请输入频道组序号，这里必需输入内容，否则无法提交！" autocomplete="off" value='+channelArr[i].name+' />';
		
		var newCell4 = newRow.insertCell(4);
		newCell4.innerHTML = '<input style="width:99%; height:25px;border:none;text-align:center;" type="text" name=videoUrl'+i+' required="required" placeholder="请输入频道组序号，这里必需输入内容，否则无法提交！" autocomplete="off" value='+channelArr[i].videoUrl+' /><button style="position:absolute;right:0px;" onclick="deleteChannelListRow('+channelArr[i].channelId+');">删除</button>';
		
	}	
//	alert("频道列表表格一共有"+getID('editChannelListTb').rows.length+"行");
	setCookie("tbRowChannelList", row, '1d');
}

var stbOnline = 0;
function showStbList(){
	for(var i=0;i<stbArr.length;i++){	
		var row = getID('stbTb').rows.length;//一共多少行
		var newRow = getID('stbTb').insertRow(row-2);//插入新行
		var newCell0 = newRow.insertCell(0);
		newCell0.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="text" name=sn'+i+' required="required" placeholder="请输入机顶盒号" autocomplete="off" value='+stbArr[i].sn+' />';
		
		var newCell1 = newRow.insertCell(1);
		newCell1.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="text" name=mark'+i+' placeholder="备注" autocomplete="off" value="'+stbArr[i].mark+'" />';
		
		var newCell2 = newRow.insertCell(2);
		newCell2.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="text" name=ip'+i+' placeholder="登陆IP" autocomplete="off" value='+stbArr[i].ip+' />';
		
		var newCell3 = newRow.insertCell(3);
		newCell3.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="text" name=city'+i+' placeholder="登陆地区" autocomplete="off" value='+stbArr[i].city+' />';
		
		var newCell4 = newRow.insertCell(4);
		newCell4.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="date" name=logintime'+i+' required="required" placeholder="请输入注册日期" autocomplete="off" value='+stbArr[i].login_time+' />';
		
		var newCell5 = newRow.insertCell(5);
		newCell5.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="date" name=expiretime'+i+' required="required" placeholder="到期日期，或续费天数" autocomplete="off" value='+stbArr[i].expire_time+' />';
		
		var newCell6 = newRow.insertCell(6);
		newCell6.innerHTML = stbArr[i].last_time;
				
		var newCell7 = newRow.insertCell(7);
		newCell7.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="text" name=isonline'+i+' required="required" placeholder="0否1是" value='+stbArr[i].isonline+' />';
				
		var newCell8 = newRow.insertCell(8);
		newCell8.innerHTML = '<input type="submit" name="subStb1" value="提交" onclick="submitStb('+i+');" />';
		
		if( stbArr[i].isonline == "在线" || stbArr[i].isonline== 1 ){
		//	console.log(newCell3.firstChild);
			newCell7.firstChild.style.background = '#66cc33';
			newCell7.firstChild.style.color = 'yellow';
			stbOnline ++;
		}
	}	
	getID('stbCount').innerText = stbArr.length;
	getID('stbOnline').innerText = stbOnline;
	setCookie("tbRowStb", row, '1d');
}

function insertGroupRow(){
	var row = getID('editGroupTb').rows.length;//一共多少行	
//	alert("表格之前有"+row+"行");
	var newRow = getID('editGroupTb').insertRow(row-2);//插入新行	
	var newCell0 = newRow.insertCell(0);
	newCell0.innerHTML = '<input style="width:99%; height:25px;border:none;text-align:center;" type="text" name=groupId'+(row-3)+' required="required" placeholder="请输入频道组序号，这里必需输入内容，否则无法提交！" autocomplete="off" value='+(row-3)+' />';
	
	var newCell1 = newRow.insertCell(1);
	newCell1.innerHTML = '<input style="width:99%; height:25px;border:none;text-align:center;" type="text" name=groupName'+(row-3)+' required="required" placeholder="请输入频道组序号，这里必需输入内容，否则无法提交！" autocomplete="off"/><button style="position:absolute;right:0px;" onclick="deleteGroupRow('+(row-3)+');">删除该组</button>';
	setCookie("tbRow", row, '1d');
}

function insertChannelListRow(){
	var row = getID('editChannelListTb').rows.length;//一共多少行	
//	alert("表格之前有"+row+"行");
	var newRow = getID('editChannelListTb').insertRow(row-2);//插入新行
	var newCell0 = newRow.insertCell(0);
	newCell0.innerHTML = '<input style="width:99%; height:25px;border:none;text-align:center;" type="text" name=groupId'+(row-3)+' required="required" placeholder="组序号" autocomplete="off" />';
	
	var newCell1 = newRow.insertCell(1);
	newCell1.innerHTML = '<input style="width:99%; height:25px;border:none;text-align:center;" type="text" name=groupName'+(row-3)+' required="required" placeholder="组名称" autocomplete="off"/>';
	
	var newCell2 = newRow.insertCell(2);
	newCell2.innerHTML = '<input style="width:99%; height:25px;border:none;text-align:center;" type="text" name=channelId'+(row-3)+' required="required" placeholder="频道排序" value='+(row-2)+' autocomplete="off"/>';
	
	var newCell3 = newRow.insertCell(3);
	newCell3.innerHTML = '<input style="width:99%; height:25px;border:none;text-align:center;" type="text" name=channelName'+(row-3)+' required="required" placeholder="频道名称" autocomplete="off"/>';
	
	var newCell4 = newRow.insertCell(4);
	newCell4.innerHTML = '<input style="width:99%; height:25px;border:none;text-align:center;" type="text" name=videoUrl'+(row-3)+' required="required" placeholder="请输入频道播放地址，这里必需输入内容，否则无法提交！" autocomplete="off"/><button style="position:absolute;right:0px;" onclick="deleteChannelListRow('+(row-2)+');">删除</button>';
	
	setCookie("tbRowChannelList", row, '1d');
}

function insertStbRow(){
	var row = getID('stbTb').rows.length;//一共多少行	
//	alert("表格之前有"+row+"行");
	var newRow = getID('stbTb').insertRow(row-2);//插入新行	
	var newCell0 = newRow.insertCell(0);
	newCell0.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="text" name=sn'+(row-3)+' required="required" placeholder="请输入机顶盒号" />';
	
	var newCell1 = newRow.insertCell(1);
	newCell1.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="text" name=mark'+(row-3)+' placeholder="请输入备注" />';
	
	var newCell2= newRow.insertCell(2);
	newCell2.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="text" name=ip'+(row-3)+' placeholder="登陆IP" />';
	
	var newCell3 = newRow.insertCell(3);
	newCell3.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="text" name=city'+(row-3)+' placeholder="登陆地区" />';
	
	var newCell4 = newRow.insertCell(4);
	newCell4.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="date" name=logintime'+(row-3)+' required="required" placeholder="请输入注册日期" autocomplete="off" value='+<?php echo json_encode($insertToday);?>+' />';
	
	var newCell5 = newRow.insertCell(5);
	newCell5.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="date" name=expiretime'+(row-3)+' required="required" placeholder="到期日期，或续费天数" autocomplete="off" value='+<?php echo json_encode($insertExpiretime);?>+' />';
	
	var newCell6 = newRow.insertCell(6);
	newCell6.innerHTML = '0000-00-00 00:00:00';
	
	var newCell7 = newRow.insertCell(7);
	newCell7.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="text" name=isonline'+(row-3)+' required="required" placeholder="0否1是" value=0 />';
				
	var newCell8 = newRow.insertCell(8);
	newCell8.innerHTML = '<input type="submit" name="subStb1" value="提交" onclick="submitStb('+(row-3)+');" />';
	
	
	setCookie("tbRowStb", row, '1d');
}

function submitStb(stbRow){
	setCookie("stbRow", stbRow, '1d'); 
}
		
function deleteGroupRow(groupId){
	var row = getID('editGroupTb').rows.length;
	for(i=1;i<row-2;i++){
		if( getID('editGroupTb').rows[i].cells[0].firstChild.value==groupId ){			
			document.getElementById("editGroupTb").deleteRow(i);//删除一行
			return 0;		
		}
	}
	setCookie("tbRow", row, '1d');
}

function deleteChannelListRow(channelId){
	var row = getID('editChannelListTb').rows.length;
	for(i=1;i<row-2;i++){
		if( getID('editChannelListTb').rows[i].cells[2].firstChild.value==channelId ){			
			document.getElementById("editChannelListTb").deleteRow(i);//删除一行
			return 0;		
		}
	}
	setCookie("tbRowChannelList", row, '1d');
}

var groupStartArr = [1];//每个频道组第一个频道号 
for( i=1;i<groupSizeArr.length;i++ ){
	var groupStart = 1;
	for( j=0;j<i;j++ ){
		groupStart += groupSizeArr[j];
	}
	groupStartArr.push( groupStart );
}
//console.log( groupStartArr );

function showChannel(_num){	//	预览用的	
	groupId += _num;
	if( groupId<-1){
		groupId= dataArr.length-1;
	}
	if( groupId>dataArr.length-1){
		groupId=-1;
	}
	channelTempArr = [];
	channelTempArr = ( groupId==-1 )?channelArr:channelTempArr.concat( dataArr[groupId].channel );
	if( groupId>-1 ){
		for(i=0;i<channelTempArr.length;i++){//改写频道号 
			channelTempArr[i].channelId = groupStartArr[groupId]+i;
		}
	}else{
		for(i=0;i<channelArr.length;i++){//改写频道号  
			channelArr[i].channelId = i+1;
		}
	}
	channelCount = channelTempArr.length;
	channelPageAll = parseInt((channelCount-1+10)/10);
	getID('groupName').innerText = ( groupId==-1 )?'所有频道':dataArr[groupId].group;
	for(i=0;i<10;i++){
		getID('channel'+i).innerHTML = '';
		getID('channelId'+i).innerHTML = '';
		if( channelTempArr[i+channelPagePos*10]  ){ 
			getID('channelId'+i).innerText = channelTempArr[i+channelPagePos*10].channelId;
			getID('channel'+i).innerText = channelTempArr[i+channelPagePos*10].name.slice(0,9);
		}
	}		
}

function moveChannel(_num){	//	预览用的	
	try{
		window.clearTimeout(st);
	}catch(err){
	}	
	getID('channels'+channelPos).style.background = 'rgba(0,0,0,0)';
	getID('channel'+channelPos).innerText = channelTempArr[channelPos+channelPagePos*10].name.slice(0,9);
	channelPos += _num;
	if( channelPos<0){
		channelPos=9;//在第一个时向上，焦点移到最下面,暂时定为9，如果最后一个不是9，再改之  
		if( channelPagePos>0){//如果不在第一页，则向前翻一页
			channelPagePos--;
		}else{//如果已在第一页，则移到最后一页
			channelPagePos = channelPageAll-1;
			if( channelPos + channelPagePos*10>channelCount-1){
				channelPos = channelCount-channelPagePos*10-1;
			}
		}
	}
	if( channelPos+channelPagePos*10>channelCount-1 && _num>0){//在最后一页最后一条下移，跳到第一页第一个
		channelPagePos =0;
		channelPos = 0;
	}
	if( channelPos>9){
		channelPos=0;
		if( channelPagePos<channelPageAll-1){
			channelPagePos++;
		}
	}
	showChannel(0);
	var nameTemp = channelTempArr[channelPos+channelPagePos*10].name;
	if( nameTemp.length>9){
		getID('channel'+channelPos).innerHTML = '<marquee behavior="alternate" direction="left" width="80%" scrollamonut="100" scrolldelay="300" style="color:#f60;">'+nameTemp+'</marquee>'
	}
	getID('channels'+channelPos).style.background = 'rgba(0,0,255,0.7)';
//	st = window.setTimeout("showHiddenChannelList(0)", 600000);//600秒后自动隐藏频道列表 
}

function init(){
	showGroupTable();
	showChannelList();
	showStbList();
	showArea(currArea);
}

</script>

<?php
error_reporting(E_ALL^E_NOTICE);
include "connectMysql.php";
set_time_limit(0); //	设置超时时间
//	header('Access-Control-Allow-Origin:*');

/*
// 从DBNAME中查询数据库
$sql = 'select * from groups'; 

// 结果集
$result = mysqli_query($connect,$sql);

//总的频道组
$groupArr = array();

//初始化一个频道组 
$groupArrInit = array(
	"groupId" => 0,
	"groupName" => "",
);

//扫描数据库频道组，写入总的频道组数组
while( $row = mysqli_fetch_assoc($result) ){
	$groupArrInit["groupId"] = $row["groupId"];
	$groupArrInit["groupName"] = $row["groupName"];
	array_push($groupArr,$groupArrInit);
	echo $row["groupName"].'<br>';
}
*/

$tbRow = $_COOKIE["tbRow"];
$tbRowChannelList = $_COOKIE["tbRowChannelList"];
$tbRowStb = $_COOKIE["tbRowStb"];

if( @$_POST['subEditGroup'] ){	//编辑频道组 	
	$sql = mysqli_query($connect,"TRUNCATE TABLE groups");//	先清空	
	for($i=0;$i<$tbRow-2;$i++){
		if( $_POST['groupId'.$i] > -1 ){
			$groupId = (int)$_POST['groupId'.$i];
			$groupName = $_POST['groupName'.$i];
		//	echo $groupName.'<br>';
			$sql = mysqli_query($connect,"insert ignore groups(groupId,groupName) values ($groupId,'$groupName')") or die(mysqli_error()) ;
		}
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
	$result = mysqli_query($connect,$query);
	if( mysqli_fetch_assoc($result) ){
		echo "<script type='text/javascript'>showPrompt();</script>"; 
	}else{//不存在，可插入
		$sql = mysqli_query($connect,"insert into channel(groupId,channelId,channelName,videoUrl) values ('$groupId','$channelId','$channelName','$videoUrl')") or die(mysqli_error()) ;
		if( $sql ){
			echo "<script>location.href='writeChannelArray.php'</script>";    
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
	
	$query = "select * from channel where channelId='$channelId2'";
	$result = mysqli_query($connect,$query);
	if( mysqli_fetch_assoc($result) ){
		echo "<script type='text/javascript'>showPrompt();</script>"; 
	}else{		
		$sql = mysqli_query($connect,"update channel set groupId='$groupId2',channelId='$channelId2',channelName='$channelName2',videoUrl='$videoUrl2' where (channelId='$channelId' and channelName='$channelName') ") or die(mysqli_error()) ;
		if( $sql ){
			echo "<script>location.href='writeChannelArray.php'</script>";    
		}else{
			echo "Error";
		}
	}
}else if( @$_POST['subEditChannelList'] ){	//编辑频道列表	
	$sql = mysqli_query($connect,"TRUNCATE TABLE groups");//	先清空	
	$sql = mysqli_query($connect,"TRUNCATE TABLE channel");//	先清空	
	for($i=0;$i<$tbRowChannelList-2;$i++){
		if( $_POST['groupId'.$i] > -1 ){
		//	echo "<script>alert('成功提交'); </script>"; 
			$groupId = (int)$_POST['groupId'.$i];
			$groupName = $_POST['groupName'.$i];
			$channelId = (int)$_POST['channelId'.$i];
			$channelName = $_POST['channelName'.$i];
			$videoUrl = $_POST['videoUrl'.$i];
		//	echo $groupName.'<br>';
			$sql = mysqli_query($connect,"replace into groups(groupId,groupName) values ($groupId,'$groupName')") or die(mysqli_error()) ;
			$sql = mysqli_query($connect,"replace into channel(groupId,groupName,channelId,channelName,videoUrl) values ($groupId,'$groupName',$channelId,'$channelName','$videoUrl')") or die(mysqli_error()) ;
		}
	}     
	if( $sql ){
		echo "<script>location.href='writeChannelArray.php'</script>";    
	}else{
		echo "Error";
	}
}else if( @$_POST['subStb'] ){	//机顶盒批量管理	
//	echo "<script>alert('成功提交'); </script>"; 	
	for($i=0;$i<$tbRowStb-2;$i++){
        $sn = $_POST['sn'.$i];		
        $mark = $_POST['mark'.$i];
        $ip = $_POST['ip'.$i];
        $city = $_POST['city'.$i];
        $logintime = $_POST['logintime'.$i];
        $expiretime = $_POST['expiretime'.$i];
		$lasttime = $stbArr[$i][lasttime];
		if( strlen($_POST['expiretime'.$i]) <8){
			$addDays = (int)$_POST['expiretime'.$i].day;
			$expiretime = date('Y-m-d',strtotime( $addDays,strtotime($logintime) ));
		}

        if( $_POST['isonline'.$i]==1 || $_POST['isonline'.$i]=="在线"){
        	$isonline = "在线";
        }else{
        	$isonline = "离线";
        }
        $sql = mysqli_query($connect,"replace into license(sn,mark,ip,city,logintime,expiretime,lasttime,isonline) values ('$sn','$mark','$ip','$city','$logintime','$expiretime','$lasttime','$isonline')") or die(mysqli_error($connect)) ;
	}     
	if( $sql ){
	//	echo "<script>location.href='excelExportStb.php'</script>";  
		echo "<script>location.href='update.php?'+Math.random()</script>";    
	}else{
		echo "Error";
	}
}else if( @$_POST['subStb1'] ){	//机顶盒管理	
//	echo "<script>alert('成功提交'); </script>"; 
	$stbRow = $_COOKIE["stbRow"];
	$sn = $_POST['sn'.$stbRow];
	$mark = $_POST['mark'.$stbRow];
	$ip = $_POST['ip'.$stbRow];
	$city = $_POST['city'.$stbRow];
	$logintime = $_POST['logintime'.$stbRow];
	$expiretime = $_POST['expiretime'.$stbRow];
	$lasttime = $stbArr[$stbRow][lasttime];
	if( strlen($_POST['expiretime'.$stbRow]) <8){
		$addDays = (int)$_POST['expiretime'.$stbRow].day;
		$expiretime = date('Y-m-d',strtotime( $addDays,strtotime($logintime) ));
	}

	if( $_POST['isonline'.$stbRow]==1 || $_POST['isonline'.$stbRow]=="在线"){
		$isonline = "在线";
	}else{
		$isonline = "离线";
	}
	$sql = mysqli_query($connect,"replace into license(sn,mark,ip,city,logintime,expiretime,lasttime,isonline) values ('$sn','$mark','$ip','$city','$logintime','$expiretime','$lasttime','$isonline')") or die(mysqli_error($connect)) ;
   
	if( $sql ){
		echo "<script>location.href='update.php'</script>";    
	}else{
		echo "Error";
	}
}

?>