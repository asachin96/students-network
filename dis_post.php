<?php
	session_start();
	if(!isset($_SESSION['email'])){	
		header("location:login.php");
		exit;
	}
	$email=$_SESSION['email'];
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	$dis_id=$_POST['dis_id'];
	$comment=$_POST['comment'];
	require_once("functions/functions.php");
	if(!filter($comment)){
		$time=date('d/m/y h:i:s a',time()+60*60*5.5);
		$time1=time();
		$query="insert into update_com(email,comment,discuss_id,time) value('{$email}','{$comment}','{$dis_id}','{$time1}')";
		mysql_query($query,$db);
	    	$query="insert into discuss_members(email,comment,discuss_id,time) value('{$email}','{$comment}','{$dis_id}','{$time1}')";
		mysql_query($query,$db);
		$values=get_info($email);
		$firstname=$values['firstname'];
		$college=$values['college'];
		$src=$values['path'];
		echo"<div class='discuss_wrap'>
			<div class='discuss_img'><img src='$src' width='30' height='30' /></div>
			<div class='discuss_name'>$firstname</div>
			<div class='discuss_college'>$college</div>
			<div class='discuss_comment'>$comment</div>
		</div>";
		mysql_close($db);
	}
?>