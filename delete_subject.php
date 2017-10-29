<?php
session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);

$college=$_POST['college'];
$subject=$_POST['subject'];
$query="delete from subscription where subject='{$subject}' and college='{$college}'";
mysql_query($query,$db);
echo mysql_affected_rows();
mysql_close($db);

?>