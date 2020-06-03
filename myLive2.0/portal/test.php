<?php


?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta charset="utf-8">
	<!-- <meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.0,minimum-scale=1.0,user-scalable=no" />-->
	<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate" />
	<meta http-equiv="Pragma" content="no-cache" />
	<meta http-equiv="Expires" content="0" />
	<title>mixTVx</title>

	<script>

 
function cans() {
		var canvas = document.createElement('canvas');
		var ctx = canvas.getContext('2d');
		var txt = 'http://security.tencent.com/';
		ctx.textBaseline = "top";
		ctx.font = "14px 'Arial'";
		ctx.textBaseline = "tencent";
		ctx.fillStyle = "#f60";
		ctx.fillRect(125, 1, 62, 20);
		ctx.fillStyle = "#069";
		ctx.fillText(txt, 2, 15);
		ctx.fillStyle = "rgba(102, 204, 0, 0.7)";
		ctx.fillText(txt, 4, 17);
 
		var b64 = canvas.toDataURL().replace("data:image/png;base64,", "");
		var bin = atob(b64);
		var crc = bin2hex(bin.slice(-16, -12));
		//var crc = bin.slice(-16,-12);
		alert(crc);
	}
 
function bin2hex(str) {
		var result = "";
		for (i = 0; i < str.length; i++) {
			result += int16_to_hex(str.charCodeAt(i));
		}
		return result;
	}
 
function int16_to_hex(i) {
	var result = i.toString(16);
	var j = 0;
	while (j + result.length < 4) {
		result = "0" + result;
		j++;
	}
	return result;
}

cans();


	</script>
</head>
<body>
</body>
</html>