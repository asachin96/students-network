<?php
	session_start();
	if(!isset($_SESSION['email'])){	
    header("location:login.php");
	exit;
	}
	$email=$_SESSION['email'];
	$option=$_POST['option'];
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	if($option=='technical')
		$query="select * from branches";
	else
		$query='select * from non_technical';
	$q=mysql_query($query,$db);
	while($r=mysql_fetch_array($q)){
		$branch=$r['branch'];
		echo"<option>$branch</option>";									
	}
?>