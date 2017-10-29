<?php
	session_start();
	if(!isset($_SESSION['email'])){	
		header("location:login.php");
		exit;
	}
	$email=$_SESSION['email'];
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	$id=$_POST['id'];
	$query="select distinct email from update_com where discuss_id='$id'";
	$ro=mysql_query($query,$db);
	require_once('functions/functions.php');
	while($row=mysql_fetch_array($ro)){
		$email=$row['email'];
		$values=get_info($email);
		$src=$values['path'];
		$name=$values['firstname'];
		$college=$values['college'];
		echo "<li class='net_wrap'>
				  <div class='network_image'><img src='{$src}' width='20' height='20'/></div>
				  <div class='network_names'>$name,$college</div>
			  </li>";
	}
?>