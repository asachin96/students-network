<?php 
	session_start();
	if(!isset($_SESSION['email'])){	
    header("location:login.php");
	exit;
	}
	$email=$_SESSION['email'];
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	$time=time();
	$query="update usersonline set time='{$time}' where email='{$email}'";
	mysql_query($query,$db);
	$query="select * from usersonline";
	$row=mysql_query($query,$db);
	while($r=mysql_fetch_array($row)){
		$usertime=$r['time'];
		$email=$r['email'];
		$n=time();
		if($n-$usertime==40){
			$query="delete from usersonline where email='{$email}'";
			mysql_query($query,$db);
		}
	}
?>
