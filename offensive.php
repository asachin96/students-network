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
	$query="select id from op where user_id='$userid' and art_id='$art'";
	$s=mysql_query($query,$db);
	if($row=mysql_fetch_array($s)){
		echo 1;
	}
	else{
		$query="select recommended,offensive from updateall where id='$art'";
		$p=mysql_query($query,$db);
		$row=mysql_fetch_array($p);
		$rec=$row['recommended'];
		$off=$row['offensive'];
		$off=$off+1;
		if(($off-$rec)>50){
			$query="delete from updateall where id='$art'";
			mysql_query($query,$db);
		}
		else{
		$query="insert into op(user_id,art_id,type) value('{$userid}','{$art}','1')";
		mysql_query($query,$db);
		$query="update updateall set offensive=offensive+1 where id='$art'";
		mysql_query($query,$db);
		$query="update details set points=points-1 where email='$up_email'";
		mysql_query($query,$db);
	}}
	
	
	mysql_close($db);
?>