<?php 
	session_start();
	$email=$_SESSION['email'];
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	$query="delete from usersonline where email='{$email}'";
	mysql_query($query,$db);
	$_SESSION[]=array();
	setcookie(session_name(),'',time()-1111,'/');
	session_destroy();
	session_unset();
	setcookie(ln,'',time()-99,'/');
	setcookie(nm,'',time()-99,'/');
	header("location:login.php");
	exit;

?>