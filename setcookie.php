<?php 
    	session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	if(isset($_GET['i']))
		setcookie('val',$_GET['i']);
?>