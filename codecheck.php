<?php
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	$ecode=$_POST['ecode'];
	$ucode=$_POST['ucode'];
	if($ecode==$ucode)
		echo "equal";
	else
		echo "not equal";
?>