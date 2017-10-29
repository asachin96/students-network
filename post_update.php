<?php
	session_start();
	if(!isset($_SESSION['email'])){	
		header("location:login.php");
		exit;
	}
	require_once("functions/functions.php");
	$email=$_SESSION['email'];
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	$dis_id=$_POST['dis_id'];
	if(isset($_SESSION['time']))
		$rec_time=$_SESSION['time'];
	else 
		$rec_time=time();
	$query="select * from update_com where discuss_id='$dis_id'";
	$ro=mysql_query($query,$db);
	while($row=mysql_fetch_array($ro)){
		$email1=$row['email'];
		$id=$row['id'];
		$comment=htmlspecialchars($row['comment']);
		$ti=$row['time'];
		$time=date('d/m/y h:i:s a',$ti);
		if($ti<$rec_time){
			continue;
		}
		if($email1!=$email){
			$values=get_info($email1);
			$firstname=$values['firstname'];
			$college=$values['college'];
			$src=$values['path'];
			echo"<div class='discuss_wrap'>
				<div class='discuss_img'><img src='$src' width='30' height='30' /></div>
				<div class='discuss_name'>$firstname</div>
				<div class='discuss_college'>$college</div>
				<div class='discuss_comment'>$comment</div>
				</div>";	
		}
	}
	$_SESSION['time']=time();
  ?>  