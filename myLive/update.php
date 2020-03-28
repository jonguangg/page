<?php
//	echo "<pre>";
include_once "readGroupArray.php";	//为了快速预览,不从js文件读数据,而从mqsql读
include_once "readChannelArray.php"; //为了快速预览,不从js文件读数据,而从mqsql读		
include_once "readTagNav.php";
//	include_once "readStbArray.php";
$insertToday = date("Y-m-d");
$insertexpireTime = date("Y-m-d", strtotime("+1 day")); //新机顶盒默认授权1天免费观看

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="expires" content="Wed, 26 Feb 1997 08:21:57 GMT">
	<meta http-equiv="pragma" content="no-cache">
	<meta http-equiv="Cache-Control" content="no-cache, must-revalidate">
	<link rel="shortcut icon" href="portal/ic_launcher.png" type="image/x-icon"> <!-- 网页收藏夹图标 -->
	<title>TenStar视频管理系统</title>
	<style>
		* {}

		table {
			border-collapse: collapse;
		}

		td {
			border: 1px #0066ff solid;
			height: 25px;
			valign: middle;
			word-wrap: break-word;
		}

		a {
			text-decoration: none;
		}

		input {
			width: 99%;
			height: 99%;
			text-align: center;
			border: none;
			font-size: 17px;
			cursor: pointer;
		}

		button {
			cursor: pointer;
			color: blue;
		}

		.groupLeft {
			position: relative;
			width: 49%;
			height: 30px;
			line-height: 30px;
			text-align: center;
			border: blue 1px solid;
			float: left;
		}

		.groupRight {
			position: relative;
			width: 49%;
			height: 30px;
			line-height: 30px;
			text-align: center;
			border: blue 1px solid;
			float: left;
		}

		.button {
			width: 100px;
			height: 35px;
			color: blue;
			font-size: 20px;
			cursor: pointer;
		}

		.channels {
			position: relative;
			left: 0px;
			top: 0px;
			width: 100%;
			height: 9%;
			line-height: 50px;
			color: white;
		}

		.channel {
			position: absolute;
			top: 0px;
			left: 90px;
			width: 90%;
			height: 50px;
			line-height: 50px;
			text-align: center;
		}

		.channelID {
			position: absolute;
			top: 0px;
			left: 40px;
			width: 50px;
			height: 50px;
			line-height: 50px;
			text-align: left;
			color: white;
		}

		.pages {
			float: left;
			margin-left: 30px;
		}

		.userText {
			position: absolute;
			right: 0px;
			width: 60%;
			height: 30px;
		}
	</style>
</head>

<body background="bg.jpg" onload="init();" onunload="exit2();">
	<div style="position:absolute;left:30px;top:5%;width:90%;text-align:left;font-size:25px;">TenStar 视频管理系统</div>
	<div style="position:absolute;left:70px;top:15%;width:150px;height:80%;line-height:15px;text-align:left;">
		<div style="cursor:pointer;position:relative;top:20px;" onclick="showArea('stb');" class="stb">客户管理</div><br />
		<div style="cursor:pointer;position:relative;top:20px;" onclick="showArea('sold');" class="sold">销售记录</div><br />
		<div style="cursor:pointer;position:relative;top:20px;" onclick="showArea('vipCard');" class="vipCard">库存管理</div><br />
		<div style="cursor:pointer;position:relative;top:20px;" onclick="showArea('video');" class="video">媒资管理</div><br />
		<div style="cursor:pointer;position:relative;top:20px;" onclick="showArea('sale');" class="sale">上架管理</div>
		<div id="sale" style="display:none;">
			<!--div onclick="getTagData('tagChinese',1,15);" id="tagChinese" style="cursor:pointer;position:relative;top:20px;">&emsp;&emsp;中文字幕</div><br />
			<div onclick="getTagData('tagJapan',1,15);" id="tagJapan" style="cursor:pointer;position:relative;top:20px;">&emsp;&emsp;日本</div><br>
			<div onclick="getTagData('tagEurUSA',1,15);" id="tagEurUSA" style="cursor:pointer;position:relative;top:20px;">&emsp;&emsp;欧美</div><br>
			<div onclick="getTagData('tagMosaic',1,15);" id="tagMosaic" style="cursor:pointer;position:relative;top:20px;">&emsp;&emsp;马赛克</div><br>
			<div onclick="getTagData('tagNP',1,15);" id="tagNP" style="cursor:pointer;position:relative;top:20px;">&emsp;&emsp;多人</div><br>
			<div onclick="getTagData('tagRole',1,15);" id="tagRole" style="cursor:pointer;position:relative;top:20px;">&emsp;&emsp;角色</div-->
		</div><br>
		<div style="cursor:pointer;position:relative;top:20px;" onclick="showArea('tagNav');" class="tagNav">栏目分类</div><br>
		<div style="cursor:pointer;position:relative;top:20px;" onclick="showArea('upLoadCard');" class="upLoadCard">导入卡密</div><br />
		<div style="cursor:pointer;position:relative;top:20px;" onclick="showArea('upLoad');" class="upLoad">导入直播</div><br />
		<!--li style="cursor:pointer;" onclick="showArea('editGroup');" class="editGroup">修改分类</div><br />
	<div style="cursor:pointer;" onclick="showArea('addChannel');" class="addChannel">添加频道</div><br />
	<div style="cursor:pointer;" onclick="showArea('editChannel');" class="editChannel">修改频道</div><br />
	<div style="cursor:pointer;" onclick="showArea('editChannelList');" class="editChannelList">编辑列表</div><br /-->
		<div style="cursor:pointer;position:relative;top:20px;" onclick="showArea('preview');" class="preview">预览频道</div><br />

		<div style="cursor:pointer;position:relative;top:20px;" onclick="showArea('user');" class="user">用户管理</div>
		<div id="user" style="display:none;"><br />
			<div onclick="showArea('editUser');" class="editUser" style="cursor:pointer;position:relative;top:20px;">&emsp;&emsp;修改用户</div><br />
			<div onclick="showArea('addUser');" class="addUser" style="cursor:pointer;position:relative;top:20px;">&emsp;&emsp;新增用户</div><br>
		</div><br>
		<div style="cursor:pointer;position:relative;top:20px;" onClick="exit();">退出系统</div>

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
					<td colspan="2"><button onclick="insertGroupRow();">添加频道组</button></td>
				</tr>

				<tr align="center">
					<td colspan="2">
						<!--<button class="button" onclick="window.location.reload();">刷新</button>&nbsp;--><input type="submit" name="subEditGroup" value="提  交" class="button" /><span style="color:red;"><br />请谨慎操作，提交后将清空之前的数据，然后再写入当前数据</span></td>
				</tr>
			</table>
		</form>
	</div>
	<!--</div-->

	<!-- 新增频道 -->
	<div id="addChannel" style="position:absolute;top:50px;left:20%;width:75%;display:none;">
		<form action="update.php" method="post" id="addChannelForm">
			<table width=100% border="1" cellpadding="0" cellspacing="0">
				<caption style="margin-bottom:20px;font-size:25px;">添加频道</caption>

				<tr>
					<td style="width:10%; text-align:center;">频道组名称</td>
					<td>
						<!--<input style="width:99%; height:150%;border:none;padding-left:5px;" type="text" name="groupId"/>-->
						<select id="selectGroup" name="groupId" form="addChannelForm" style="height:25px;font-size:15px; padding-left:5px;">
							<!-- <option value="0">所有频道</option>
                    <option value="1">1</option>
                    <option value="2">2</option>-->
						</select>
					</td>
				</tr>

				<tr>
					<td style="width:10%; text-align:center;">频道排序</td>
					<td> <input style="width:99.3%; height:25px;border:none;padding-left:5px;" type="text" name="channelId" required="required" placeholder="请输入频道号，这里必需输入内容，否则无法提交！" autocomplete="off" /></td>
				</tr>

				<tr>
					<td style="width:10%; text-align:center;">频道名称</td>
					<td> <input style="width:99.3%; height:25px;border:none;padding-left:5px;" type="text" name="channelName" required="required" placeholder="请输入频道名称，这里必需输入内容，否则无法提交！" autocomplete="off" /></td>
				</tr>

				<tr>
					<td style="width:10%; text-align:center;">播放地址</td>
					<td> <input style="width:99.3%; height:25px;border:none;padding-left:5px;" type="text" name="videoUrl" required="required" placeholder="请输入播放地址，这里必需输入内容，否则无法提交！" /></td>
				</tr>

				<tr align="center">
					<td colspan="2"><input type="submit" name="subAddChannel" value="提  交" style="width:100px;height:35px;color:blue;font-size:20px; " autocomplete="off" /></td>
				</tr>
			</table>
		</form>
		<br>
		<div>请先添加频道组，再在相应组内添加频道<br /><br />频道号会按大小重新排序，所以只需填写不重复的即可</div>
	</div>

	<!--修改频道参数-->
	<div id="editChannel" style="position:absolute;top:50px;left:20%;width:75%;display:none;">
		<form action="update.php" method="post" id="editChannelForm">
			<table width=100% border="1" cellpadding="0" cellspacing="0">
				<caption style="margin-bottom:20px;font-size:25px;">修改频道参数</caption>

				<tr>
					<td style="width:10%; text-align:center;">原频道组名称</td>
					<td>
						<!--<input style="width:99%; height:150%;border:none;padding-left:5px;" type="text" name="groupId"/>-->
						<select id="selectGroup1" name="groupId" form="editChannelForm" style="height:25px;font-size:15px; padding-left:5px;">
							<!--                    <option value="0">所有频道</option>
                    <option value="1">卫视频道</option>-->
						</select>
					</td>
					<td style="width:10%; text-align:center;">新频道组名称</td>
					<td>
						<!--<input style="width:99%; height:150%;border:none;padding-left:5px;" type="text" name="groupId"/>-->
						<select id="selectGroup2" name="groupId2" form="editChannelForm" style="height:25px;font-size:15px; padding-left:5px;">
							<!--                    <option value="0">所有频道</option>
                    <option value="1">卫视频道</option>-->
						</select>
					</td>

				</tr>

				<tr>
					<td style="width:10%; text-align:center;">原频道号</td>
					<td> <input style="width:98%; height:25px;border:none;padding-left:5px;" type="text" name="channelId" required="required" placeholder="请输入频道号，这里必需输入内容，否则无法提交！" autocomplete="off" /></td>
					<td style="width:10%; text-align:center;">新频道号</td>
					<td> <input style="width:98%; height:25px;border:none;padding-left:5px;" type="text" name="channelId2" required="required" placeholder="请输入频道号，这里必需输入内容，否则无法提交！" autocomplete="off" /></td>
				</tr>

				<tr>
					<td style="width:10%; text-align:center;">原频道名称</td>
					<td> <input style="width:98%; height:25px;border:none;padding-left:5px;" type="text" name="channelName" required="required" placeholder="请输入频道名称，这里必需输入内容，否则无法提交！" autocomplete="off" /></td>
					<td style="width:10%; text-align:center;">新频道名称</td>
					<td> <input style="width:98%; height:25px;border:none;padding-left:5px;" type="text" name="channelName2" required="required" placeholder="请输入频道名称，这里必需输入内容，否则无法提交！" autocomplete="off" /></td>
				</tr>

				<tr>
					<td style="width:10%; text-align:center;">原播放地址</td>
					<td> <input style="width:98%; height:25px;border:none;padding-left:5px;" type="text" name="videoUrl" placeholder="这里可以不输入内容" autocomplete="off" /></td>
					<td style="width:10%; text-align:center;">新播放地址</td>
					<td> <input style="width:98%; height:25px;border:none;padding-left:5px;" type="text" name="videoUrl2" required="required" placeholder="请输入播放地址，这里必需输入内容，否则无法提交！" autocomplete="off" /></td>
				</tr>

				<tr align="center">
					<td colspan="4"><input type="submit" name="subEditChannel" value="提  交" style="width:100px;height:35px;color:blue;font-size:20px; " /></td>
				</tr>
			</table>
		</form><br />频道号在机顶盒上会按大小重新排序，所以只需填写不重复的即可
	</div>

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
					<td colspan="5"><button onclick="insertChannelListRow();">添加频道</button></td>
				</tr>
				<tr align="center">
					<td colspan="5"><input type="submit" name="subEditChannelList" value="提  交" class="button" /><span style="color:red;"><br />请谨慎操作，提交后将清空之前的数据，然后再写入当前数据<br /></span><span>经测试，在这里提交，服务器响应很慢，故修改较多时请使用 excel 表格上传<br />若修改较少，请使用 ”修改频道参数“</span></td>
				</tr>
			</table>
		</form>
	</div>

	<!--  批量导入VIP卡密 -->
	<div id="upLoadCard" style="position:absolute;top:120px;left:15%;width:78%;height:120px;text-align:center; display:none;">
		<h1>请选择VIP卡密表格文件再上传</h1><br /><br />
		<form enctype="multipart/form-data" action="./upLoadCard.php?action=excel" method="post">
			<!-- name="excelCard" id="excelCard"-->
			<input type="hidden" name="MAX_FILE_SIZE" value="104857600" /><!-- value单位是字节（Bytes），除以1024得到KB，再除以1024得到MB，10485760是10M -->
			<input type="file" name="excelCard" accept=".xls,.xlsx" style="width:50%;font-size:30px;" />
			<input type="submit" value="上传VIP卡密" style="width:150px;height:50px;background:transparent url(upLoad.png);border:0px; font-size:20px; font-weight:900;cursor:pointer;" />
		</form>
		<!-- br><br><button onclick="window.open('download.php');" style="width:120px;height:50px;background:transparent url(upLoad.png);background-size:100% 100%;border:0px; font-size:20px; font-weight:900;cursor:pointer;">下载样表</button><br><br -->
		<span style="color:red;"><br /><br /><br />请仔细核对 excel 表格的格式，上传后将增量更新之前的数据！</span>
	</div>

	<!--  批量导入频道列表  -->
	<div id="upLoad" style="position:absolute;top:120px;left:15%;width:78%;height:120px;text-align:center; display:none;">
		<h1>请选择excel文件再上传</h1><br /><br />
		<form enctype="multipart/form-data" action="./upLoadChannel.php?action=excel" method="post">
			<!--name="excel" id="excel"-->
			<input type="hidden" name="MAX_FILE_SIZE" value="104857600" /><!-- value单位是字节（Bytes），除以1024得到KB，再除以1024得到MB，10485760是10M -->
			<input type="file" name="excel" accept=".xls,.xlsx" style="width:50%;font-size:30px;" />
			<input type="submit" value="上传频道列表" style="width:150px;height:50px;background:transparent url(upLoad.png);border:0px; font-size:20px; font-weight:900; " />
		</form>
		<!-- br><br><button onclick="window.open('download.php');" style="width:120px;height:50px;background:transparent url(upLoad.png);background-size:100% 100%;border:0px; font-size:20px; font-weight:900;cursor:pointer;">下载样表</button><br><br -->
		<span style="color:red;"><br /><br /><br>请仔细核对 excel 表格的格式，上传后将增量更新之前的数据!</span>
	</div>

	<!-- 预览频道列表   -->
	<div id="preview" style="position:absolute;top:0px;left:20%;width:80%;height:100%;background:rgba(0,0,0,0.6);display:none;">
		<!-- 频道组 -->
		<div id="group" style="top:0px;left:0px;width:100%;height:10%;line-height:70px;text-align:center;color:white;">
			<&emsp;<span id="groupName">所有频道</span>&emsp;>
		</div>
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
	<div id="stb" style="position:absolute;top:80px;left:15%;width:84%; text-align:center;display:none;">
		<div>
			<table id="stbTb" style="table-layout: fixed" width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:34%;"><b>客户号</b></td>
					<td style="width:8%;"><b>备注</b></td>
					<td style="width:11%;"><b>登陆IP</b></td>
					<td style="width:10%;"><b>登陆地区</b></td>
					<td style="width:9%;"><b>注册日期</b></td>
					<td style="width:9%;"><b>到期日期</b></td>
					<td style="width:9%;"><b>最近登陆</b></td>
					<td style="width:5%;"><b>状态</b></td>
					<td style="width:5%;"><b>修改</b></td>
				</tr>
			</table>
		</div>
		<div style="position:relative;left:39%;top:10px;width:60%;height:30px;">
			<div class="pages"><span id="pageNow"></span>-<span id="pageAll"></span></div>
			<div onclick="pageUp()" style="cursor:pointer;color:blue;" class="pages">上一页</div>
			<div onclick="pageDown()" style="cursor:pointer;color:blue;" class="pages">下一页</div>
			<div class="pages"><input style="width:40px;"><button onclick="goTo1(this)">转到</button></div>
			<div id="stbTotal" class="pages"></div>
			<button onclick="exportExcel()" class="pages">导出</button>
		</div>
	</div>

	<!-- 销售记录 -->
	<div id="sold" style="position:absolute;top:115px;left:15%;width:84%; text-align:center;display:none;">
		<div>
			<table id="soldTb" style="table-layout: fixed" width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:15%;"><b>激活时间</b></td>
					<td style="width:40%;"><b>客户号</b></td>
					<td style="width:12%;"><b>登陆IP</b></td>
					<td style="width:12%;"><b>登陆地区</b></td>
					<td style="width:14%;"><b>VIP卡号</b></td>
					<td style="width:7%;"><b>授权天数</b></td>
				</tr>
			</table>
		</div>
		<div style="position:relative;left:39%;top:10px;width:60%;height:30px;">
			<div class="pages"><span id="pageNowSold"></span>-<span id="pageAllSold"></span></div>
			<div onclick="pageUp()" style="cursor:pointer;color:blue;" class="pages">上一页</div>
			<div onclick="pageDown()" style="cursor:pointer;color:blue;" class="pages">下一页</div>
			<div class="pages"><input style="width:40px;"><button onclick="goTo1(this)">转到</button></div>
			<div id="soldTotal" class="pages"></div>
			<button onclick="exportExcel()" class="pages">导出</button>
		</div>
	</div>

	<!-- VIP卡库存查询 -->
	<div id="vipCard" style="position:absolute;top:115px;left:30%;width:50%; text-align:center;display:none;">
		<div id="showVipCard">
			<table id="vipCardTb" style="table-layout: fixed" width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:80%;"><b>卡号</b></td>
					<td style="width:20%;"><b>授权天数</b></td>
				</tr>
			</table>
			<div style="position:relative;left:5%;top:10px;width:100%;height:30px;">
				<div class="pages"><span id="pageNowVipCard"></span>-<span id="pageAllVipCard"></span></div>
				<div onclick="pageUp()" style="cursor:pointer;color:blue;" class="pages">上一页</div>
				<div onclick="pageDown()" style="cursor:pointer;color:blue;" class="pages">下一页</div>
				<div class="pages"><input style="width:40px;"><button onclick="goTo1(this)">转到</button></div>
				<div id="vipCardTotal" class="pages"></div>
				<button onclick="exportExcel()" class="pages">导出</button>
				<button onclick="getID('showVipCard').style.display = 'none';getID('addVipCard').style.display = 'block';setTimeout(function(){getID('showVipCard').style.display = 'block';getID('addVipCard').style.display = 'none';},60000);" class="pages">生成</button>
			</div>
		</div>

		<!-- 生成卡号卡密 -->
		<div id="addVipCard" style="position:absolute;left:20%;top:90px;width:50%;height:200px;text-align:center;display:none;">
			请输入生成多少张卡：
			<input id="addCardNum" style="width:40px;height:30px;"></br></br>
			输入每张卡授权天数：
			<input id="addCardDays" style="width:40px;height:30px;"></br></br></br>
			<button onclick='getID("addVipCard").style.display="none";getID("showVipCard").style.display="block";'>取消</button>&emsp;&emsp;
			<button onclick='addVipCard();'>提交</button>
		</div>
	</div>

	<!-- 媒资管理 -->
	<div id="video" style="position:absolute;top:80px;left:15%;width:84%; text-align:center;display:none;">
		<div>
			<table id="videoTb" style="table-layout: fixed" width="100%" border="1" cellpadding="0" cellspacing="0">
				<tr>
					<td style="width:5%;"><b>ID</b></td>
					<td style="width:15%;"><b>文件名</b></td>
					<td style="width:25%;"><b>描述</b></td>
					<td style="width:25%;"><b>分类</b></td>
					<td style="width:7%;"><b>时长</b></td>
					<!--td style="width:5%;"><b>码率</b></td>
			<td style="width:8%;"><b>分辨率</b></td>
			<td style="width:7%;"><b>视频编码</b></td>
			<td style="width:10%;"><b>视频格式</b></td>
			<td style="width:7%;"><b>音频编码</b></td>
			<td style="width:8%;"><b>音频采样率</b></td-->
					<td style="width:8%;"><b>大小</b></td>
					<td style="width:10%;"><b>上传时间</b></td>
					<td style="width:5%;"><b>删除</b></td>
				</tr>
			</table>
		</div>
		<div style="position:relative;left:29%;top:10px;width:70%;height:30px;">
			<div class="pages"><span id="pageNowVideo"></span>-<span id="pageAllVideo"></span></div>
			<div onclick="pageUp()" style="cursor:pointer;color:blue;" class="pages">上一页</div>
			<div onclick="pageDown()" style="cursor:pointer;color:blue;" class="pages">下一页</div>
			<div class="pages">每页
				<select id="setVideoPageSize"> 
					<option value=10> 10</option>
					<option value=20> 20</option>
					<option value=50> 50</option>
					<option value=100>100</option>
					<option value=200>200</option>
					<option value=500>500</option>
				</select>
			</div>
			<div class="pages"><input style="width:40px;"><button onclick="goTo1(this)">转到</button></div>
			<div id="videoTotal" class="pages"></div>
			<button onclick="exportExcel()" class="pages">导出</button>
			<button style="cursor:pointer;color:blue;margin-left:-30px;" onclick="showArea('upLoadTag');" class="upLoadTag">导入</button>
		</div>
	</div>

	<!-- 上架管理 -->
	<div id="tag" style="position:absolute;top:115px;left:15%;width:84%; text-align:center;display:none;">
		<div>
			<table id="tagTb" style="table-layout: fixed" width="100%" border="1" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<td style="width:5%;cursor:pointer;" onClick="onOffAll()"><b>全选</b></td>
						<td style="width:5%;"><b>排序</b></td>
						<td style="width:20%;"><b>文件名</b></td>
						<td style="width:26%;"><b>描述</b></td>
						<td style="width:7%;"><b>在线状态</b></td>
						<td style="width:6%;"><b>上下架</b></td>
						<td style="width:15%;"><b>修改时间</b></td>
						<td style="width:10%;"><b>操作者</b></td>
						<td style="width:6%;"><b>删除</b></td>
					</tr>
				</thead>
			</table>
		</div>
		<div style="position:relative;left:10%;top:10px;width:90%;height:30px;">
			<button onclick="onOffDeleteSale(0,0,0)" class="pages">批量上架</button>
			<button onclick="onOffDeleteSale(0,1,0)" class="pages">批量下架</button>
			<button onclick="onOffDeleteSale(0,1,1)" class="pages">批量删除</button>
			<div class="pages"><span id="pageNowtag"></span>-<span id="pageAlltag"></span></div>
			<div onclick="pageUp()" style="cursor:pointer;color:blue;" class="pages">上一页</div>
			<div onclick="pageDown()" style="cursor:pointer;color:blue;" class="pages">下一页</div>
			<div class="pages">每页
				<select id="setPageSize"> 
					<option value=10> 10</option>
					<option value=20> 20</option>
					<option value=50> 50</option>
					<option value=100>100</option>
					<option value=200>200</option>
					<option value=500>500</option>
				</select>
				<!--input id="pageSizeCurr" style="width:40px;" oninput="onInputHandler(event,'pageSizeCurr')"-->
			</div>
			<div class="pages"><input style="width:40px;"><button onclick="goTo1(this)">转到</button></div>
			<div id="tagTotal" class="pages"></div>
			<button onclick="exportExcel()" class="pages">导出</button>
		</div>
	</div>

	<!-- 分类管理 -->
	<div id="tagNav" style="position:absolute;top:115px;left:30%;width:50%; text-align:center;display:none;">
		<form action="update.php" method="post" id="editTagNavForm-can_delete-">
			<!--div-->
			<table id="tagNavTb" style="table-layout: fixed" width="100%" border="1" cellpadding="0" cellspacing="0">
				<thead>
					<tr>
						<td style="width:10%;"><b>排序</b></td>
						<td style="width:30%;"><b>分类名</b></td>
						<td style="width:30%;"><b>分类表</b></td>
						<td style="width:15%;"><b>分类级别</b></td>
						<td style="width:15%;"><b>删除</b></td>
					</tr>
				</thead>
			</table>
			<!--/div-->
			<div style="position:relative;left:70%;top:10px;width:20%;height:30px;">
				<button type="submit" name="subEditTagNav" class="pages" value="这里必需写点东西">提交修改</button>
			</div>
		</form>
		<button onclick="getID('tagNav').style.display = 'none';getID('addTag').style.display = 'block';currArea='addTag'" style=" position:relative;top:-20px;left:308px;">添加分类</button>
	</div>

	<!-- 添加分类 -->
	<div id="addTag" class="addTag" style="position:absolute;top:120px;left:40%;width:20%;font-size:20px;display:none;">
		<form action="update.php" method="post" id="addtagForm">
			<a style="font-size:25px;">&emsp;&emsp;&emsp;新增栏目</a></br></br>
			栏目名：
			<input type="text" id="addTagName" name="addTagName" required="required" placeholder="" class="userText"></br></br>
			<br />
			栏目表：
			<input type="text" id="addTagTable" name="addTagTable" required="required" placeholder="" class="userText"></br></br><br>
			栏目级别：
			<input type="text" id="addTagLevel" name="addTagLevel" placeholder="默认为1" class="userText"></br></br><br>

			<input type="button" name="submitAddTag" value="提  交" onclick="addTag()" style="width:45%;height:30px;background-color:green;color:yellow;cursor:pointer;">

			<input type="reset" name="reset" value="重  置" style="position:absolute;width:45%;height:30px;right:0px;background-color:green;color:yellow;cursor:pointer;">
		</form>
	</div>

	<!--  批量导入节目分类 -->
	<div id="upLoadTag" style="position:absolute;top:120px;left:15%;width:78%;height:120px;text-align:center; display:none;">
		<h1>请选择节目分类表格文件再上传</h1><br /><br />
		<form enctype="multipart/form-data" action="./upLoadTag.php?action=excel" method="post">
			<input type="hidden" name="MAX_FILE_SIZE" value="104857600" /><!-- value单位是字节（Bytes），除以1024得到KB，再除以1024得到MB，10485760是10M -->
			<input type="file" name="excelTag" accept=".xls,.xlsx" style="width:50%;font-size:30px;" />
			<input type="submit" value="上传节目信息" style="width:150px;height:50px;background:transparent url(upLoad.png);border:0px; font-size:20px; font-weight:900;cursor:pointer;" />
		</form>
		<span style="color:red;"><br /><br /><br />请仔细核对 excel 表格的格式，上传后将更改之前的数据！<br><br>需先将视频文件上传至服务器upload文件夹，待显示出文件名才能导入</span>
	</div>

	<!-- 编辑用户 -->
	<div id="editUser" style="position:absolute;top:120px;left:40%;width:20%;font-size:20px;display:none;">
		<form action="update.php" method="post" id="editUserForm">
			<a style="font-size:25px;">&emsp;&emsp;&emsp;修改用户</a></br></br>
			用户名：
			<input type="text" id="editUserInput" name="editUserInput" required="required" disabled="disabled" class="userText"></br></br>
			中文名：
			<input type="text" id="markInput" name="markInput" required="required" placeholder="请输入中文名" class="userText"></br></br>

			密&emsp;码：
			<input type="password" id="password1" name="password1" required="required" placeholder="请输入密码" class="userText"><br><br />

			<input type="password" id="password2" name="password2" required="required" placeholder="请再次输入密码" class="userText"><br><br>

			<input type="button" value="提  交" onclick="checkEditUser()" style="width:45%;height:30px;background-color:green;color:yellow;cursor:pointer;">

			<input type="hidden" id="deleteUserInput" name="deleteUserInput">
			<input type="button" name="submitDeleteUser" value="删除此用户" onclick="deleteUser()" style="position:absolute;width:45%;height:30px;right:0px;background-color:green;color:yellow;cursor:pointer;">
		</form>
	</div>

	<!-- 新增用户 -->
	<div id="addUser" style="position:absolute;top:120px;left:40%;width:20%;font-size:20px;display:none;">
		<form action="update.php" method="post" id="addUserForm">
			<a style="font-size:25px;">&emsp;&emsp;&emsp;新增用户</a></br></br>
			用户名：
			<input type="text" id="addUserInput" name="addUserInput" required="required" placeholder="请输入用户名" class="userText"></br></br>
			用户权限：
			<select name="userRole" form="addUserForm" class="userText" style="text-align:center;text-align-last: center;">
				<option value="2">日常用户</option>
				<option value="1">管理员</option>
				<option value="0">后台运维</option>
			</select><br /><br />
			中文名：
			<input type="text" name="markInput" required="required" placeholder="请输入中文名" class="userText"></br></br>
			密&emsp;码：
			<input type="password" id="password3" name="password3" required="required" placeholder="请输入密码" class="userText"><br><br>
			<input type="password" id="password4" name="password4" required="required" placeholder="请再次输入密码" class="userText"><br><br>

			<input type="button" name="submitAddUser" value="提  交" onclick="checkAddUser()" style="width:45%;height:30px;background-color:green;color:yellow;cursor:pointer;">

			<input type="reset" name="reset" value="重  置" style="position:absolute;width:45%;height:30px;right:0px;background-color:green;color:yellow;cursor:pointer;">
		</form>
	</div>

	<div id="prompt" style="position:absolute;top:300px;left:0px;width:100%;height:200px;color:red;font-size:30px; text-align:center; display:none;">频道号重复了，<br />请核对修改后重新提交！<br /><br /><button onclick="getID('prompt').style.display = 'none';" style="width:100px;height:30px; line-height:20px;font-size:20px;color:blue;">确 定</button></div>

</body>

</html>

<script type=text/javascript src="global.js"></script>
<script type=text/javascript src="keyForPreview.js"></script>
<!-- <script type=text/javascript src="groupArr.js"></script> -->
<!-- script type=text/javascript src="dataJs.js"></script -->
<script type=text/javascript src="jquery-1.11.0.min.js" charset=UTF-8></script>
<script>
	function getID(id) {
		return document.getElementById(id);
	}

	var currUser = getCookie("currUser") ? getCookie("currUser") : 'null';
	var currUserMark = getCookie("currUserMark") ? decodeURI(getCookie("currUserMark")) : '';
	if (getCookie("currUser") == null) { //没有用户即为非正常登陆，则立即退出
		location.href = "login.php";
	}

	var currArea = getCookie("currArea") ? getCookie("currArea") : 'stb';
	//var tbRow = 3;
	var groupArr = <?php echo json_encode($groupArr); ?>; //从readGroupArray.php读取到的频道组数组，供预览使用
	var dataArr = <?php echo json_encode($channelArr); ?>; //从readChannelArray.php读取到的频道数组，供预览使用
	var tagArr = <?php echo json_encode($tagArr); ?>;
	var tagNow = (tagArr[1][0])?tagArr[1][1].tagTable:"";
	function showTagName() {
		for (i = 1; i < tagArr[1].length; i++) {
		//	if( tagArr[1][i].tagLevel==1 ){
				getID("sale").innerHTML += '<br><div id=' + tagArr[1][i].tagTable + ' onclick=getTagData(\'' + tagArr[1][i].tagTable + '\',1,15); style="cursor:pointer;position:relative;top:20px;" > &emsp; &emsp;' + tagArr[1][i].tagName + '</div>';
		//	}
		}
	}
	showTagName();

	/*
	var stbArr = <?php echo json_encode($stbArr); ?>;		//从readStbArray.php读取到的机顶盒数组
	//	console.log(stbArr[6].lastTime);
	//	console.log(dataArr);
	//	console.log(stbArr);
	*/
	var groupId = 0;
	var channelPos = 0;
	var channelPagePos = 0;
	var channelCount = 0;
	var channelPageAll = parseInt((channelCount - 1 + 10) / 10);
	//var channelPagePosTemp = 0;
	//var channelPosTemp = 0;
	var channelArr = []; //合并所有频道为一个数组 
	for (i = 0; i < dataArr.length; i++) { //合并所有频道为一个数组 
		channelArr = channelArr.concat(dataArr[i].channel);
	}
	//console.log(channelArr[ channelArr.length-1 ].name);

	var channelTempArr = []; //当前显示的频道组 
	var groupSizeArr = []; //每个频道的节目数  
	for (i = 0; i < dataArr.length; i++) {
		groupSizeArr.push(dataArr[i].channel.length);
	}
	//	console.log( groupSizeArr );

	//	点击左侧菜单，显示右侧不同内容
	function showArea(id) {
		console.log(currArea);
		if (currArea == "addTag") {
			currArea = "tagNav";
		}
		document.getElementsByClassName(currArea)[0].style.color = "black";
		getID(currArea).style.display = 'none';
		getID(id).style.display = 'block';
		currArea = id;
		document.getElementsByClassName(currArea)[0].style.color = "blue";
		if (currArea != "sale") {
			getID("tag").style.display = "none";
		}

		if (currArea == "stb") { //客户端管理
			getStbData(1);
		} else if (currArea == "sold") { //已售查询
			getSoldData(1);
		} else if (currArea == "vipCard") { //库存查询
			getVipCardData(1);
		} else if (currArea == "video") { //媒资管理
			pageSize = 10;
			getVideoData(1, pageSize);
		} else if (currArea == "sale") { //上架管理
			getTagData(tagNow, 1, 15);
		} else if (currArea == "tagNav") {
			showTagList();
		} else if (currArea == 'editGroup') { //频道组
			showGroupTable();
		} else if (currArea == 'addChannel') { //添加频道
			getID('selectGroup').innerHTML = '';
			for (i = 0; i < groupArr.length; i++) {
				getID('selectGroup').innerHTML += '<option value=' + groupArr[i].groupId + '>' + groupArr[i].groupName + '</option>';
			}
		} else if (currArea == 'editChannel') { //修改一个频道
			getID('selectGroup1').innerHTML = '';
			getID('selectGroup2').innerHTML = '';
			for (i = 0; i < groupArr.length; i++) {
				getID('selectGroup1').innerHTML += '<option value=' + groupArr[i].groupId + '>' + groupArr[i].groupName + '</option>';
				getID('selectGroup2').innerHTML += '<option value=' + groupArr[i].groupId + '>' + groupArr[i].groupName + '</option>';
			}
		} else if (currArea == 'editChannelList') { //编辑频道列表
			showChannelList();
		} else if (currArea == 'preview') { //预览
			showChannel(0);
			moveChannel(0);
		}
		if (currArea == 'user') { //点击 用户管理 焦点马上到修改用户
			getID("user").style.display = 'block';
			currArea = "editUser";
			showArea('editUser');
			//	getID("editUserInput").value = currUser;
			//	getID("markInput").value = currUserMark;
		} else {
			document.getElementsByClassName("user")[0].style.color = "black";
		}

		if (currArea == 'editUser' || currArea == 'addUser') { //修改或增加用户
			getID("user").style.display = 'block';
			getID("editUserInput").value = currUser;
			getID("markInput").value = currUserMark;
		} else {
			getID("user").style.display = 'none';
		}

		if (currArea == "addTag") {
			getID("addTag").style.display = "block";
		} else {
			getID("addTag").style.display = "none";
		}
		setCookie("currArea", currArea, '1d');
		console.log(currArea);
	}

	function showPrompt() {
		getID('prompt').style.display = 'block';
		window.setTimeout("getID('prompt').style.display = 'none';", 5000);
	}
	/*根据groupArr动态显示频道组表格
	function showGroupTable(){
		for(var i=0;i<groupArr.length;i++){	
			var row = getID('editGroupTb').rows.length;//一共多少行
			var newRow = getID('editGroupTb').insertRow(row-2);//插入新行
			var newCell0 = newRow.insertCell(0);
			newCell0.innerHTML = '<input id=input'+i+' style="width:99%; height:25px;border:none;text-align:center;" type="text" name=groupId'+i+' required="required" placeholder="请输入频道组序号，这里必需输入内容，否则无法提交！" autocomplete="off" value='+groupArr[i].groupId+' />';
			
			var newCell1 = newRow.insertCell(1);
			newCell1.innerHTML = '<input style="width:99%; height:25px;border:none;text-align:center;" type="text" name=groupName'+i+' required="required" placeholder="请输入频道组序号，这里必需输入内容，否则无法提交！" autocomplete="off" value='+groupArr[i].groupName+' /><button style="position:absolute;right:0px;" onclick="deleteGroupRow('+groupArr[i].groupId+');">删除该组</button>';
		}	
		setCookie("tbRow", row, '1d');//存储总行数给php使用
	}
	*/

	/*根据channelArr动态显示频道表格	
	function showChannelList(){
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
		setCookie("tbRowChannelList", row, '1d');	//存储总行数给php使用
	}
	*/

	/*这个可以不要了，已改为getStbData()分页显示
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
			newCell4.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="date" name=loginTime'+i+' required="required" placeholder="请输入注册日期" autocomplete="off" value='+stbArr[i].loginTime+' />';
			
			var newCell5 = newRow.insertCell(5);
			newCell5.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="date" name=expireTime'+i+' required="required" placeholder="到期日期，或续费天数" autocomplete="off" value='+stbArr[i].expireTime+' />';
			
			var newCell6 = newRow.insertCell(6);
			newCell6.innerHTML = stbArr[i].lastTime;
					
			var newCell7 = newRow.insertCell(7);
			newCell7.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="text" name=isOnLine'+i+' required="required" placeholder="0否1是" value='+stbArr[i].isOnLine+' />';
					
			var newCell8 = newRow.insertCell(8);
			newCell8.innerHTML = '<input type="submit" name="subStb1" value="提交" onclick="submitStb('+i+');" />';
			
			if( stbArr[i].isOnLine == "在线" || stbArr[i].isOnLine== 1 ){
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
	*/

	/*插入频道组
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
	*/

	/*插入频道
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
	*/

	/*插入一个机顶盒
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
		newCell4.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="date" name=loginTime'+(row-3)+' required="required" placeholder="请输入注册日期" autocomplete="off" value='+<?php echo json_encode($insertToday); ?>+' />';
		
		var newCell5 = newRow.insertCell(5);
		newCell5.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="date" name=expireTime'+(row-3)+' required="required" placeholder="到期日期，或续费天数" autocomplete="off" value='+<?php echo json_encode($insertexpireTime); ?>+' />';
		
		var newCell6 = newRow.insertCell(6);
		newCell6.innerHTML = '0000-00-00 00:00:00';
		
		var newCell7 = newRow.insertCell(7);
		newCell7.innerHTML = '<input style="width:99%; height:37px;border:none;text-align:center;" type="text" name=isOnLine'+(row-3)+' required="required" placeholder="0否1是" value=0 />';
					
		var newCell8 = newRow.insertCell(8);
		newCell8.innerHTML = '<input type="submit" name="subStb1" value="提交" onclick="submitStb('+(row-3)+');" />';
		
		
		setCookie("tbRowStb", row, '1d');
	}

	function submitStb(stbRow){	//缓存记录机顶盒数量，即行数
		setCookie("stbRow", stbRow, '1d'); 
	}
	*/

	/*删除频道组
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
	*/

	/*删除频道
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
	*/

	var groupStartArr = [1]; //每个频道组第一个频道号 
	for (i = 1; i < groupSizeArr.length; i++) {
		var groupStart = 1;
		for (j = 0; j < i; j++) {
			groupStart += groupSizeArr[j];
		}
		groupStartArr.push(groupStart);
	}
	//console.log( groupStartArr );

	//	预览用的，显示频道列表
	function showChannel(_num) {
		groupId += _num;
		if (groupId < -1) {
			groupId = dataArr.length - 1;
		}
		if (groupId > dataArr.length - 1) {
			groupId = -1;
		}
		channelTempArr = [];
		channelTempArr = (groupId == -1) ? channelArr : channelTempArr.concat(dataArr[groupId].channel);
		if (groupId > -1) {
			for (i = 0; i < channelTempArr.length; i++) { //改写频道号 
				channelTempArr[i].channelId = groupStartArr[groupId] + i;
			}
		} else {
			for (i = 0; i < channelArr.length; i++) { //改写频道号  
				channelArr[i].channelId = i + 1;
			}
		}
		channelCount = channelTempArr.length;
		channelPageAll = parseInt((channelCount - 1 + 10) / 10);
		getID('groupName').innerText = (groupId == -1) ? '所有频道' : dataArr[groupId].group;
		for (i = 0; i < 10; i++) {
			getID('channel' + i).innerHTML = '';
			getID('channelId' + i).innerHTML = '';
			if (channelTempArr[i + channelPagePos * 10]) {
				getID('channelId' + i).innerText = channelTempArr[i + channelPagePos * 10].channelId;
				getID('channel' + i).innerText = (channelTempArr[i + channelPagePos * 10].name.length > 20) ? channelTempArr[i + channelPagePos * 10].name.slice(0, 9) : channelTempArr[i + channelPagePos * 10].name;
			}
		}
	}

	//	预览用的，移到光标
	function moveChannel(_num) {
		try {
			window.clearTimeout(st);
		} catch (err) {}
		getID('channels' + channelPos).style.background = 'rgba(0,0,0,0)';
		getID('channel' + channelPos).innerText = channelTempArr[channelPos + channelPagePos * 10].name.slice(0, 9);
		channelPos += _num;
		if (channelPos < 0) {
			channelPos = 9; //在第一个时向上，焦点移到最下面,暂时定为9，如果最后一个不是9，再改之  
			if (channelPagePos > 0) { //如果不在第一页，则向前翻一页
				channelPagePos--;
			} else { //如果已在第一页，则移到最后一页
				channelPagePos = channelPageAll - 1;
				if (channelPos + channelPagePos * 10 > channelCount - 1) {
					channelPos = channelCount - channelPagePos * 10 - 1;
				}
			}
		}
		if (channelPos + channelPagePos * 10 > channelCount - 1 && _num > 0) { //在最后一页最后一条下移，跳到第一页第一个
			channelPagePos = 0;
			channelPos = 0;
		}
		if (channelPos > 9) {
			channelPos = 0;
			if (channelPagePos < channelPageAll - 1) {
				channelPagePos++;
			}
		}
		showChannel(0);
		var nameTemp = channelTempArr[channelPos + channelPagePos * 10].name;
		if (nameTemp.length > 20) {
			getID('channel' + channelPos).innerHTML = '<marquee behavior="alternate" direction="left" width="80%" scrollamonut="100" scrolldelay="300" style="color:#f60;">' + nameTemp + '</marquee>'
		}
		getID('channels' + channelPos).style.background = 'rgba(0,0,255,0.7)';
		//	st = window.setTimeout("showHiddenChannelList(0)", 600000);//600秒后自动隐藏频道列表 
	}

	//获取客户端数据 
	var pageNow = 1;
	var pageAll = 1;
	var pageSize = getCookie("pageSize") ? getCookie("pageSize") : 15;
	var onLine = 0;

	function getStbData(_pageNum) {
		setCookie("pageNow", _pageNum, '1h');
		$.ajax({
			type: 'POST',
			url: 'readStbJson.php',
			data: {
				'pageNow': _pageNum - 1
			},
			dataType: 'json',
			beforeSend: function() {
				//这里一般显示加载提示
			},
			success: function(json) {
				$("#stbTb tr:not(:eq(0))").remove();
				pageSize = json.pageSize; //每页显示条数  
				pageNow = _pageNum; //当前页  
				stbTotal = json.stbTotal; //总记录数 
				onLine = json.onLine; //在线人数 
				pageAll = json.pageAll; //总页数
				getID("pageNow").innerHTML = pageNow;
				getID("pageAll").innerHTML = pageAll;
				getID("stbTotal").innerHTML = "注册总数：" + stbTotal + "&emsp;当前在线：" + onLine;
				var tr = "";
				var list = json.list;
				$.each(list,
					function(index, array) { //遍历json数据列
						if (array['isOnLine'] == "在线") {
							tr += "<tr><td>" + array['sn'] + "</td><td><input style='BACKGROUND-COLOR:transparent;' value=\"" + array['mark'] + "\" ></input></td><td>" + array['ip'] + "</td><td>" + array['city'] + "</td><td>" + array['loginTime'] + "</td><td><input style='BACKGROUND-COLOR:transparent;' type='text' value=" + array['expireTime'] + "></input></td><td>" + array['lastTime'] + "</td><td style='color:red;background-color:yellow;'>" + array['isOnLine'] + "</td><td><button onClick='updateStb(this)'>提交</button></td></tr>";
						} else {
							tr += "<tr><td>" + array['sn'] + "</td><td><input style='BACKGROUND-COLOR:transparent;' value=\"" + array['mark'] + " \"></input></td><td>" + array['ip'] + "</td><td>" + array['city'] + "</td><td>" + array['loginTime'] + "</td><td><input style='BACKGROUND-COLOR:transparent;' type='text' value=" + array['expireTime'] + "></input></td><td>" + array['lastTime'] + "</td><td>" + array['isOnLine'] + "</td><td><button onClick='updateStb(this)'>提交</button></td></tr>";
						}
					});
				$("#stbTb tr").eq(0).after(tr);
			},
			error: function() {
				getID("pageNowtag").innerHTML = 0;
				getID("pageAlltag").innerHTML = 0;
				getID("tagTotal").innerHTML = "库存总数：" + 0;
				$("#tagTb tr:not(:eq(0))").remove();
			}
		});
	}

	//获取销售数据  
	function getSoldData(_pageNum) {
		setCookie("pageNow", _pageNum, '1h');
		$.ajax({
			type: 'POST',
			url: 'readSoldJson.php',
			data: {
				'pageNow': _pageNum - 1
			},
			dataType: 'json',
			beforeSend: function() {
				//这里一般显示加载提示
			},
			success: function(json) {
				$("#soldTb tr:not(:eq(0))").remove();
				pageSize = json.pageSize; //每页显示条数  
				pageNow = _pageNum; //当前页  
				soldTotal = json.soldTotal; //总记录数 
				pageAll = json.pageAll; //总页数
				getID("pageNowSold").innerHTML = pageNow;
				getID("pageAllSold").innerHTML = pageAll;
				getID("soldTotal").innerHTML = "已售总数：" + soldTotal;
				var tr = "";
				var list = json.list;
				$.each(list,
					function(index, array) { //遍历json数据列
						tr += "<tr><td>" + array['soldTime'] + "</td><td>" + array['sn'] + "</td><td>" + array['ip'] + "</td><td>" + array['city'] + "</td><td>" + array['cardId'] + "</td><td>" + array['licenseDays'] + "</td></tr>";
					});
				$("#soldTb tr").eq(0).after(tr);
			},
			error: function() {
				getID("pageNowtag").innerHTML = 0;
				getID("pageAlltag").innerHTML = 0;
				getID("tagTotal").innerHTML = "库存总数：" + 0;
				$("#tagTb tr:not(:eq(0))").remove();
			}
		});
	}

	//获取VIP卡库存数据  
	function getVipCardData(_pageNum) {
		setCookie("pageNow", _pageNum, '1h');
		$.ajax({
			type: 'POST',
			url: 'readVipCardJson.php',
			data: {
				'pageNow': _pageNum - 1
			},
			dataType: 'json',
			beforeSend: function() {
				//这里一般显示加载提示
			},
			success: function(json) {
				$("#vipCardTb tr:not(:eq(0))").remove();
				pageSize = json.pageSize; //每页显示条数  
				pageNow = _pageNum; //当前页  
				vipCardTotal = json.vipCardTotal; //总记录数 
				pageAll = json.pageAll; //总页数
				getID("pageNowVipCard").innerHTML = pageNow;
				getID("pageAllVipCard").innerHTML = pageAll;
				getID("vipCardTotal").innerHTML = "库存总数：" + vipCardTotal;
				var tr = "";
				var list = json.list;
				$.each(list,
					function(index, array) { //遍历json数据列
						tr += "<tr><td>" + array['cardId'] + "</td><td>" + array['licenseDays'] + "</td></tr>";
					});
				$("#vipCardTb tr").eq(0).after(tr);
			},
			error: function() {
				getID("pageNowtag").innerHTML = 0;
				getID("pageAlltag").innerHTML = 0;
				getID("tagTotal").innerHTML = "库存总数：" + 0;
				$("#tagTb tr:not(:eq(0))").remove();
			}
		});
	}

	//获取媒资库 
	function getVideoData(_pageNum, _pageSize) {
		setCookie("pageNow", _pageNum, '1h');
		$.ajax({
			type: 'POST',
			url: 'readVideoJson.php',
			data: {
				'pageNow': _pageNum - 1,
				'pageSize': _pageSize
			},
			dataType: 'json',
			beforeSend: function() {
				//这里一般显示加载提示;
			},
			success: function(json) {
				$("#videoTb tr:not(:eq(0))").remove();
				pageSize = json.pageSize; //每页显示条数  
				pageNow = _pageNum; //当前页  
				videoTotal = json.videoTotal; //总记录数 
				pageAll = json.pageAll; //总页数
				getID("pageNowVideo").innerHTML = pageNow;
				getID("pageAllVideo").innerHTML = pageAll;
				getID("videoTotal").innerHTML = "库存总数：" + videoTotal;
				var tr = "";
				var list = json.list;
				$.each(list,
					function(index, array) { //遍历json数据列
						var name = array['name'].slice(array['name'].lastIndexOf('/') + 1);
						name = name.slice(0, name.length - 4);
						if (array['duration']) {
							var duration = array['duration'].slice(0, 8);
						} else {
							var duration = "";
						}
						tr += "<tr><td>" + (parseInt(pageNow - 1) * pageSize + index + 1) + "</td><td>" + name + "<input type='hidden' value=\'" + array['name'] + "\' /></td><td>" + array['title'] + "</td><td>" + array['tag'] + "</td><td>" + duration + "</td><td>" + array['size'] + "</td><td>" + array['uploadTime'] + "</td><td><button onClick='deleteVideo(this)'>删除</button></td></tr>";
						//	tr += "<tr><td></td><td>"+ name + "<input type='hidden' value=\'"+array['name']+"\' /></td><td>显示名</td><td>分类</td><td>"+array['duration']+"</td><td>"+array['bitrate']+"</td><td>"+array['resolution']+"</td><td>"+vcodec+"</td><td>"+array['vformat']+"</td><td>"+acodec+"</td><td>"+array['asamplerate']+"</td><td>"+array['size']+"</td><td>"+array['uploadTime']+"</td><td><button onClick='deleteVideo(this)'>删除</button></td></tr>";				
					});
				$("#videoTb tr").eq(0).after(tr);
			},
			error: function() {
				getID("pageNowtag").innerHTML = 0;
				getID("pageAlltag").innerHTML = 0;
				getID("tagTotal").innerHTML = "库存总数：" + 0;
				$("#tagTb tr:not(:eq(0))").remove();
			}
		});
	}

	//显示节目上下架列表
	function getTagData(_tag1, _pageNum, _pageSize) {
		if (getID("tag").style.display == "none") {
			getID("tag").style.display = "block";
		}
		getID(tagNow).style.color = "black";
		tagNow = _tag1;
		//	setCookie("pageNow", _pageNum, '1h');
		//	setCookie("tagNow", tag, '1h');
		getID(tagNow).style.color = "blue";
		$.ajax({
			type: 'POST',
			url: 'readTagJson.php',
			data: {
				'tag1': _tag1,
				'pageNow': _pageNum,
				'pageSize': _pageSize
			},
			dataType: 'json',
			beforeSend: function() {
				//这里一般显示加载提示;
			},
			success: function(json) {
				$("#tagTb tr:not(:eq(0))").remove();
				pageSize = json.pageSize; //每页显示条数  
				pageNow = _pageNum; //当前页  
				tagTotal = json.tagTotal; //总记录数 
				pageAll = json.pageAll; //总页数
				getID("pageNowtag").innerHTML = pageNow;
				getID("pageAlltag").innerHTML = pageAll;
				getID("tagTotal").innerHTML = "库存总数：" + tagTotal;
				var tr = "";
				var list = json.list;
				$.each(list,
					function(index, array) { //遍历json数据列
						var name = array['fileName'].slice(array['fileName'].lastIndexOf('/') + 1);
						name = name.slice(0, name.length - 4);
						if (array['status'] == 1) {
							var saling = "已上架";
							var onOff = "<button onClick='onOffDeleteSale(this," + array['status'] + ",0)'>下架</button>";
						} else {
							var saling = "待上";
							var onOff = "<button onClick='onOffDeleteSale(this," + array['status'] + ",0)' style='color:red'>上架</button>";
						}

						tr += "<tr><td><input id=checkBox" + index + " type='checkbox' style='width:18px;height:18px;' onClick='addOnOffSale(this)' /></td><td>" + array['sort'] + "</td><td>" + name + "<input type='hidden' value=\'" + array['fileName'] + "\' /></td><td>" + array['title'] + "</td><td>" + saling + "</td><td>" + onOff + "</td><td>" + array['editTime'] + "</td><td>" + array['editor'] + "</td><td><button onClick='onOffDeleteSale(this,0,1)'>删除</button></td></tr>";
					});
				$("#tagTb tr").eq(0).after(tr);
			},
			error: function() {
				getID("pageNowtag").innerHTML = 0;
				getID("pageAlltag").innerHTML = 0;
				getID("tagTotal").innerHTML = "库存总数：" + 0;
				$("#tagTb tr:not(:eq(0))").remove();
			}
		});
	}

	//	显示栏目分类
	var tbRowTagNav = 0;
	var tags = "分类标签";
	function showTagList() {
		$("#tagNavTb tr:not(:eq(0))").remove();
		tr = "";
		for(j=0;j<tagArr.length;j++){
			for (i = 0; i < tagArr[j].length; i++) {
				tr += "<tr><td><input type='text' name=tagSort" + i + " style='BACKGROUND-COLOR:transparent;' value='" + tagArr[j][i].tagSort + "' autocomplete='off' ></input></td><td><input type='text' name=tagName" + i + " style='BACKGROUND-COLOR:transparent;' value='" + tagArr[j][i].tagName + "'></input></td><td><input type='text' name=tagTable" + i + " style='BACKGROUND-COLOR:transparent;' readonly='true' value='" + tagArr[j][i].tagTable + "'</input></td><td>"+tagArr[j][i].tagLevel+"</td><td><button onClick='deleteTag(this)'>删除</button></td></tr>";
				tags += "|" + tagArr[j][i].tagTable;
			}
		}
		$("#tagNavTb tr").eq(0).after(tr);
		tbRowTagNav = getID('tagNavTb').rows.length; //一共多少行
		setCookie("tbRowTagNav", tbRowTagNav, '1d');
	}

	//添加分类
	function addTag() {
		currArea = "tagNav";
		var addTagName = document.getElementById("addTagName").value;
		var addTagTable = document.getElementById("addTagTable").value;
		var addTagLevel = parseInt(document.getElementById("addTagLevel").value)>-1?document.getElementById("addTagLevel").value:1;
		if (tags.indexOf(addTagTable) > -1) {
			alert("数据库已有这个表名了！");
		} else {
			$.ajax({
				type: 'POST',
				url: 'addTagTable.php',
				dataType: 'json',
				data: {
					"addTagSort": tbRowTagNav,
					"addTagName": addTagName,
					"addTagTable": addTagTable,
					"addTagLevel": addTagLevel
				},
				beforeSend: function() {
					//这里一般显示加载提示
				},
				success: function(data) {
					console.log("success:" + data.status);
					if (data.status == "succeed") {
						alert("\n提交成功");
						location.href = "update.php?" + Math.random();
						//	showTagList();
					}
				},
				error: function(data) {
					console.log(data.responseText);
					alert(data.responseText);
				}
			});
		}
	}

	//删除分类
	function deleteTag(obj) {
		var x = $(obj).parent().parent().find("td");
		var tagTableDel = x.eq(2).find("input").val();
		//	alert(tagTableDel);
		$.ajax({
			type: 'POST',
			url: 'deleteTagTable.php',
			dataType: 'json',
			data: {
				"tagTableDel": tagTableDel
			},
			beforeSend: function() {
				//这里一般显示加载提示
			},
			success: function(data) {
				console.log("success:" + data.status);
				if (data.status == "succeed") {
					alert("\n提交成功");
					location.href = "update.php?" + Math.random();
					//	showTagList();
				}
			},
			error: function(data) {
				console.log(data.responseText);
				alert(data.responseText);
			}
		});
	}

	//	新增VIP卡
	function addVipCard() {
		var addCardNum = (getID("addCardNum").value) ? parseInt(getID("addCardNum").value) : 0;
		var addCardDays = (getID("addCardDays").value) ? parseInt(getID("addCardDays").value) : 0;
		//	alert(addCardNum+"_"+addCardDays);
		if (addCardNum <= 0) {
			alert("请填入希望生成卡的数量！");
		} else if (addCardDays <= 0) {
			alert("请填入每张卡授权天数！");
		} else if (addCardNum > 0 && addCardDays > 0) {
			//	location.href = "addVipCard.php?addCardNum="+addCardNum+"&days="+addCardDays;
			$.ajax({
				type: 'POST',
				url: 'addVipCard.php',
				dataType: 'json',
				data: {
					"addCardNum": addCardNum,
					"days": addCardDays
				},
				beforeSend: function() {
					//这里一般显示加载提示
				},
				success: function(data) {
					//	console.log("success:"+data.status);
					if (data.status == "succeed") {
						alert("成功生成 " + addCardNum + " 张卡\n马上为您下载到本机！");
						//	setCookie("from", "addVipCard", '1d');
						//	setCookie("addCardNum", "addCardNum", '1d');	放在addVipCard.php一起存
						location.href = "excelExport.php?from=addVipCard";
					}
				},
				error: function(data) {
					//	console.log(data.responseText);
					alert(data.responseText);
				}
			});
		}
		getID("addCardNum").value = "";
		getID("addCardDays").value = "";
	}

	//修改机顶盒信息（备注，到期时间）
	function updateStb(obj) {
		var x = $(obj).parent().parent().find("td");
		var sn = x.eq(0).text();
		var mark = x.eq(1).find("input").val();
		var expireTime = x.eq(5).find("input").val();
		$.ajax({
			type: 'POST',
			url: 'updateStb.php',
			dataType: 'json',
			data: {
				"sn": sn,
				"mark": mark,
				"expireTime": expireTime
			},
			beforeSend: function() {
				//这里一般显示加载提示
			},
			success: function(data) {
				//	console.log("success:"+data.status);
				if (data.status == "succeed") {
					alert("\n            提交成功");
					getStbData(pageNow);
				}
			},
			error: function(data) {
				//	console.log(data.responseText);
				alert(data.responseText);
			}
		});
	};

	//删除媒资
	function deleteVideo(obj) {
		var x = $(obj).parent().parent().find("td");
		var name = x.eq(1).find("input").val();
		//	alert(name);
		$.ajax({
			type: 'POST',
			url: 'deleteVideo.php',
			dataType: 'json',
			data: {
				"name": name
			},
			beforeSend: function() {
				//这里一般显示加载提示
			},
			success: function(data) {
				console.log("success:" + data.status);
				if (data.status == "succeed") {
					alert("\n提交成功");
					getVideoData(pageNow, pageSize);
				}
			},
			error: function(data) {
				console.log(data.responseText);
				alert(data.responseText);
				getVideoData(pageNow, pageSize);
			}
		});
	}

	//上下架，删除
	var onOffArr = [];

	function onOffDeleteSale(obj, onOff, isDelete) {
		if (obj != 0) { //没有this就是批量操作
			var x = $(obj).parent().parent().find("td");
			var name = x.eq(2).find("input").val();
			onOffArr[0] = name;
		}
		var postUrl = (isDelete == 1) ? "deleteTag.php" : "onOffSale.php";
		//	alert(onOffArr[0]);
		//	alert(name);
		if (onOffArr.length == 0) { //加这个兼容批量操作
			alert("请选择需批量操作的内容");
			return;
		}
		$.ajax({
			type: 'POST',
			url: postUrl,
			dataType: 'json',
			data: {
				"tagNow": tagNow,
				"onOffArr": JSON.stringify(onOffArr),
				"onOff": (onOff == 1) ? 0 : 1
			},
			traditional: false,
			beforeSend: function() {
				//这里一般显示加载提示
			},
			success: function(data) {
				//	console.log("success:"+data.status);
				if (data.status == "succeed") {
					alert("\n提交成功");
					getTagData(tagNow, pageNow, 15);
				}
			},
			error: function(data) {
				//	console.log(data.responseText);
				alert(data.responseText);
				getTagData(tagNow, pageNow, 15);
			}
		});
		onOffArr = []; //提交操作后清空批量选择的数组
	}

	//添加批量操作元素
	function addOnOffSale(obj) {
		var x = $(obj).parent().parent().find("td");
		var name = x.eq(2).find("input").val();
		if ($(obj).prop("checked")) {
			onOffArr.push(name);
		} else {
			for (i = 0; i < onOffArr.length; i++) {
				if (onOffArr[i] == name) {
					onOffArr.splice(i, 1);
				}
			}
		}
		console.log(onOffArr);
		return onOffArr;
	}

	//全选
	var checkAll = 0;

	function onOffAll() {
		if (checkAll == 0) { //如果原来没选中
			checkAll = 1;
		} else {
			checkAll = 0;
		}
		for (i = 0; i < pageSize; i++) {
			var x = $(getID("checkBox" + i)).parent().parent().find("td");
			var name = x.eq(2).find("input").val();
			if (name) { //如果此行有内容
				if (checkAll == 1) { //如果全选
					getID("checkBox" + i).checked = true;
					onOffArr.push(name);
				} else { //如果全不选
					getID("checkBox" + i).checked = false;
					onOffArr = [];
				}
			}
		}
		console.log(onOffArr);
	}

	/*批量上下架，改成onOffDeleteSale了
	function onOffSales(onOff){
		if( onOffArr.length==0){
			alert("请选择需批量操作的内容");
			return ;
		}
		$.ajax({
			type: 'POST',
			url: 'onOffSale.php',
			dataType: 'json',
			data: {
				"onOffArr": JSON.stringify(onOffArr),
				"onOff": onOff
			},
			traditional:false,
			beforeSend: function() {
				//这里一般显示加载提示
			},
			success: function(data){
			//	console.log("success:"+data.status);
				if( data.status=="succeed"){
					alert("\n提交成功");
					getTagData(tagNow,pageNow);
				}
			},
			error: function(data) {
			//	console.log(data.responseText);
				alert(data.responseText);
				getTagData(tagNow,pageNow);
			}
		});
		onOffArr = [];//提交操作后清空批量选择的数组
	}*/

	function pageUp() { //上一页
		if (pageNow > 1) {
			pageNow--;
			if (currArea == "stb") {
				getStbData(pageNow);
			} else if (currArea == "sold") {
				getSoldData(pageNow);
			} else if (currArea == "vipCard") {
				getVipCardData(pageNow);
			} else if (currArea == "video") {
				getVideoData(pageNow, pageSize);
			} else if (currArea == "sale") {
				getTagData(tagNow, pageNow, pageSize);
			}
		}
	}

	function pageDown() { //下一页
		if (pageNow < pageAll) {
			pageNow++;
			if (currArea == "stb") {
				getStbData(pageNow);
			} else if (currArea == "sold") {
				getSoldData(pageNow);
			} else if (currArea == "vipCard") {
				getVipCardData(pageNow);
			} else if (currArea == "video") {
				getVideoData(pageNow, pageSize);
			} else if (currArea == "sale") {
				getTagData(tagNow, pageNow, pageSize);
			}
		}
	}

	function goTo1(obj) { //跳转页码
		var goTo = $(obj).prev().val();
		if (goTo > pageAll) {
			goTo = pageAll;
		}
		if (goTo < 1) {
			goTo = 1;
		}
		if (currArea == "stb") {
			getStbData(goTo);
		} else if (currArea == "sold") {
			getSoldData(goTo);
		} else if (currArea == "vipCard") {
			getVipCardData(goTo);
		} else if (currArea == "video") {
			getVideoData(goTo, pageSize);
		} else if (currArea == "sale") {
			getTagData(tagNow, goTo, pageSize);
		}
		$(obj).prev().val(""); //清空input内的数字
	}

	function exportExcel() { //导出记录表
		//	alert(currArea);
		location.href = "./excelExport.php?from=" + currArea;
	}

	function checkEditUser() {
		var password1 = document.getElementById("password1").value;
		var password2 = document.getElementById("password2").value;
		if (password1.length < 1) {
			alert("请输入新密码");
		} else if (password2.length < 1) {
			alert("请再次输入新密码");
		} else if (password1 == password2) {
			document.getElementById('editUserForm').submit(); //验证成功进行表单提交
		} else {
			alert("两次输入的密码不一致，请重新输入");
		}
	}

	function checkAddUser() {
		var password3 = document.getElementById("password3").value;
		var password4 = document.getElementById("password4").value;
		if (document.getElementById("addUserInput").value.length > 0) {
			if (password3.length < 1) {
				alert("请输入密码");
			} else if (password4.length < 1) {
				alert("请再次输入密码");
			} else if (password3 == password4) {
				document.getElementById('addUserForm').submit(); //验证成功进行表单提交
			} else {
				alert("两次输入的密码不一致，请重新输入");
			}
		} else {
			alert("请输入用户名");
		}
	}

	function deleteUser() {
		document.getElementById("password1").value = " ";
		document.getElementById("password1").value = " ";
		document.getElementById('deleteUserInput').value = " ";
		document.getElementById('editUserForm').submit();
	}

	function onInputHandler(event, _id) { //监听input输入变化，Firefox, Google Chrome, Opera, Safari, Internet Explorer from version 9
		console.log("刚输入的是：" + event.target.value);
		if (event.target.value > 10) {
			pageSize = event.target.value;
			setCookie("pageSize", pageSize, "1h");
			getTagData(tagNow, pageNow, pageSize);
		}
	}

	function onPropertyChangeHandler(event) { //监听input输入变化，Internet Explorer
		if (event.propertyName.toLowerCase() == "value") {
			console.log(event.srcElement.value);
			if (event.srcElement.value > 10) {
				pageSize = event.srcElement.value;
				setCookie("pageSize", pageSize, "1h");
				getTagData(tagNow, pageNow, pageSize);
			}
		}
	}

	$("#setPageSize").change(function() { //按每页显示数量重新显示当前分类列表
		//	alert($(this).children('option:selected').val()); 				
		pageSize = $(this).children('option:selected').val();
		setCookie("pageSize", pageSize, "1h");
		getTagData(tagNow, pageNow, pageSize);
	})

	$("#setVideoPageSize").change(function() { //按每页显示数量重新显示所有视频列表
		//	alert($(this).children('option:selected').val()); 				
		pageSize = $(this).children('option:selected').val();
		setCookie("pageSize", pageSize, "1h");
		getVideoData(pageNow, pageSize);
	})

	function init() {
		showArea(currArea);
	}

	function exit() { //放body的onunload内，退出浏览器清除登陆信息
		delCookie("currUser");
		delCookie("pageSize");
		location.href = "login.php";
	}
</script>

<?php
//	error_reporting(E_ALL^E_NOTICE^E_WARNING);
date_default_timezone_set('PRC'); // 切换到中国的时间
include_once "connectMysql.php";
set_time_limit(0); //	设置超时时间
//	header('Access-Control-Allow-Origin:*');
//	$tbRowStb = ($_COOKIE["tbRowStb"])?$_COOKIE["tbRowStb"]:0;

if (@$_POST['subEditGroup']) {	//编辑频道组 	
	$tbRow = ($_COOKIE["tbRow"]) ? $_COOKIE["tbRow"] : 0;
	$sql = mysqli_query($connect, "TRUNCATE TABLE groups"); //	先清空	
	for ($i = 0; $i < $tbRow - 2; $i++) {
		if ($_POST['groupId' . $i] > -1) {
			$groupId = (int) $_POST['groupId' . $i];
			$groupName = $_POST['groupName' . $i];
			//	echo $groupName.'<br>';
			$sql = mysqli_query($connect, "insert ignore groups(groupId,groupName) values ($groupId,'$groupName')") or die(mysqli_error());
		}
	}
	if ($sql) {
		echo "<script>location.href='writeGroupArray.php'</script>";
	} else {
		echo "Error";
	}
} else if (@$_POST['subAddChannel']) {	//添加频道  
	$groupId = (int) $_POST['groupId'];
	$groupName = $groupArr[$groupId]['groupName'];
	$channelId = $_POST['channelId'];
	$channelName = $_POST['channelName'];
	$videoUrl = $_POST['videoUrl'];
	$query = "select * from channel where channelId='$channelId'";
	$result = mysqli_query($connect, $query);
	if (mysqli_fetch_assoc($result)) {
		echo "<script type='text/javascript'>showPrompt();</script>";
	} else { //不存在，可插入
		$sql = mysqli_query($connect, "insert into channel(groupId,groupName,channelId,channelName,videoUrl) values ('$groupId','$groupName','$channelId','$channelName','$videoUrl')") or die(mysqli_error());
		if ($sql) {
			echo "<script>location.href='writeChannelArray.php'</script>";
		} else {
			echo "Error";
		}
	}
} else if (@$_POST['subEditChannel']) {	//修改频道参数 
	@$groupId = (int) $_POST['groupId'];
	$channelId = $_POST['channelId'];
	$channelName = $_POST['channelName'];

	@$groupId2 = (int) $_POST['groupId2'];
	$channelId2 = $_POST['channelId2'];
	$channelName2 = $_POST['channelName2'];
	$videoUrl2 = $_POST['videoUrl2'];

	$query = "select * from channel where channelId='$channelId2'";
	$result = mysqli_query($connect, $query);
	if (mysqli_fetch_assoc($result)) {
		echo "<script type='text/javascript'>showPrompt();</script>";
	} else {
		$sql = mysqli_query($connect, "update channel set groupId='$groupId2',channelId='$channelId2',channelName='$channelName2',videoUrl='$videoUrl2' where (channelId='$channelId' and channelName='$channelName') ") or die(mysqli_error());
		if ($sql) {
			echo "<script>location.href='writeChannelArray.php'</script>";
		} else {
			echo "Error";
		}
	}
} else if (@$_POST['subEditTagNav']) {
	$tbRowTagNav = ($_COOKIE["tbRowTagNav"]) ? $_COOKIE["tbRowTagNav"] : 0;
	for ($i = 0; $i < $tbRowTagNav; $i++) {
		if (@$_POST['tagSort' . $i]) {
			$tagSortTemp = $_POST['tagSort' . $i];
			$tagNameTemp = $_POST['tagName' . $i];
			$tagTableTemp = $_POST['tagTable' . $i];
			$sql = mysqli_query($connect, "update tag set tagSort=$tagSortTemp, tagName='$tagNameTemp' where tagTable='$tagTableTemp' ") or die(mysqli_error());
			echo "<script>location.href = 'update.php?'+Math.random();</script>";
		}
	}
} else if (@$_POST['subEditChannelList']) {	//编辑频道列表	这里不成功八成是因为post内容太大，需改php.ini的max_input_vars = 100000 
	$tbRowChannelList = ($_COOKIE["tbRowChannelList"]) ? $_COOKIE["tbRowChannelList"] : 0;
	$sql = mysqli_query($connect, "TRUNCATE TABLE groups"); //	先清空	
	$sql = mysqli_query($connect, "TRUNCATE TABLE channel"); //	先清空	
	for ($i = 0; $i < $tbRowChannelList - 2; $i++) {
		if ($_POST['groupId' . $i] > -1) {
			$groupId = (int) $_POST['groupId' . $i];
			$groupName = $_POST['groupName' . $i];
			$channelId = (int) $_POST['channelId' . $i];
			$channelName = $_POST['channelName' . $i];
			$videoUrl = $_POST['videoUrl' . $i];
			//	echo $groupName.'<br>';
			$sql = mysqli_query($connect, "replace into groups(groupId,groupName) values ($groupId,'$groupName')") or die(mysqli_error());
			$sql = mysqli_query($connect, "replace into channel(groupId,groupName,channelId,channelName,videoUrl) values ($groupId,'$groupName',$channelId,'$channelName','$videoUrl')") or die(mysqli_error());
		}
	}
	if ($sql) {
		echo "<script>location.href='writeChannelArray.php'</script>";
	} else {
		echo "Error";
	}
} else if (@$_POST['deleteUserInput']) {	//删除用户
	$username = $_COOKIE["currUser"];
	$sql = mysqli_query($connect, "DELETE FROM user WHERE username='$username' ") or die(mysqli_error());
	echo "<script>location.href = 'login.php';</script>";
} else if (@$_POST['password1']) {		//编辑用户	 
	$username = $_COOKIE["currUser"];
	$markInput = $_POST['markInput'];
	$password1 = $_POST['password1'];
	$password = password_hash($password1, PASSWORD_BCRYPT);
	$sql = mysqli_query($connect, "update user set password='$password',mark='$markInput' where username='$username' ") or die(mysqli_error());
	if ($sql) {
		echo "<script>alert('修改成功，\\n您的新密码是：" . $password1 . "\\n请注意保存！');</script>";
		//	echo "<script>location.href = 'sms'+Math.random();</script>"; 
	} else {
		echo "Error";
	}
	echo "<script>showArea('editUser');</script>";
} else if (@$_POST['addUserInput']) {	//添加用户 
	$userRole = $_POST['userRole'];
	$username = $_POST['addUserInput'];
	$markInput = $_POST['markInput'];
	$password3 = $_POST['password3'];
	$password = password_hash($password3, PASSWORD_BCRYPT);
	$query = "select * from user where username='$username'";
	$result = mysqli_query($connect, $query);
	if (mysqli_fetch_assoc($result)) {
		echo "<script type='text/javascript'>alert('该用户已存在！\\n请换一个用户名');</script>";
	} else { //不存在，可插入
		$sql = mysqli_query($connect, "insert into user(role,username,mark,password) values ('$userRole','$username','$markInput','$password')") or die(mysqli_error());
		if ($sql) {
			echo "<script>alert('添加成功，\\n您的用户名是：" . $username . "\\n您的密码是：" . $password3 . "\\n请注意保存！');</script>";
			//	echo "<script>location.href = 'sms'+Math.random();</script>";     
		} else {
			echo "Error";
		}
	}
	echo "<script>showArea('addUser');</script>";
}

?>