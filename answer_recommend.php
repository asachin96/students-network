<?php 
	session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	
	$email1=$_SESSION['email'];
	$art=$_POST['art'];
	$up_email=$_POST['email'];
	require_once("functions/functions.php");				  
	$user=get_info($email1);
	$userid=$user['id'];
	$query="select id from op2 where user_id='$userid' and art_id='$art'";
	$s=mysql_query($query,$db);
	if($row=mysql_fetch_array($s)){
		echo 1;
	}
	else{
		$query="insert into op2(user_id,art_id) value('{$userid}','{$art}')";
		mysql_query($query,$db);
		$query="update answer set recommended=recommended+1 where id='$art'";
		mysql_query($query,$db);
		$query="update details set points=points+1 where email='$up_email'";
		mysql_query($query,$db);
		$query="select recommended from answer where id='{$art}'";
		$row=mysql_query($query,$db);
		$values=mysql_fetch_array($row);
		$recommended=$values['recommended'];
		echo"recommended({$recommended})";		
	}
	mysql_close($db);
?>
