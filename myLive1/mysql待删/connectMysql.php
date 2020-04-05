<?php
$connect = @mysql_connect("localhost","root","123456");
if(!$connect){die("error".mysql_error());}
mysql_select_db("mylive",$connect);
mysql_query("set names utf8",$connect);

?>