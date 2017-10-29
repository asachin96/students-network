<?php
	session_start();
	$email=$_SESSION['email'];
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
    	require_once("functions/functions.php");
        $_SESSION['email']=$email;
	$time=time();
	$ttime=$time-60*10;
	$query="delete from online where time < '{$ttime}'";
	mysql_query($query,$db);
	$query="delete from online where email='{$email}'";
	mysql_query($query,$db);
	$query="insert into online(email,time) values('{$email}','{$time}')";
	mysql_query($query,$db);
?>