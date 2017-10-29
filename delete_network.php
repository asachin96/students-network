<?php
	session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	$email=$_POST['email'];
	$semail=$_SESSION['email'];
	$query="delete from network where friend='{$email}'";
	mysql_query($query,$db);
	/*$query="delete from events where {{temail='{$email}' and femail='{$semail}'} or {temail='{$email}' and femail='{$semail}'}} and 
	{type='1' or type='2' or type='3' or type='4' }}";
	mysql_query($query,$db);
	echo mysql_affected_rows().mysql_error();*/
	mysql_close($db);
?>