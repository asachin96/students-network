<?php
	session_start();
	if(!isset($_SESSION['email'])){	
		header("location:login.php");
		exit;
	}
	$femail=$_SESSION['email'];
	$ref=$_POST['ref'];
	$temail=$_POST['temail'];
	$time=time();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
    	require_once("functions/functions.php");
    	$query="delete from event where femail='{$femail}' and temail = '{$temail}' and ref='{$ref}' and type='1'";
    	mysql_query($query,$db);
        $query="insert into event(femail,temail,ref,type,time) values('{$femail}','{$temail}','{$ref}','1','{$time}')";
        $r=mysql_query($query,$db);
        mysql_affected_rows();
?>   