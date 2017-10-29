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
	$time=time();
	$ref="article.php?art=".$art;
	$query="select id from op where user_id='$userid' and art_id='$art'";
	$s=mysql_query($query,$db);
	if($row=mysql_fetch_array($s)){
		echo 1;
	}
	else{ if($email1!=$up_email){
		$query="select * from network where email='{$email1}' and email!='{$up_email}'";
		$r=mysql_query($query,$db);
		while($r1=mysql_fetch_array($r)){
			$email2=$r1['friend'];
		        $query="insert into event(femail,temail,ref,type,time) values('{$email1}','{$email2}','{$ref}','2','{$time}') ";
		        mysql_query($query,$db);
	        }}
		$query="insert into op(user_id,art_id) value('{$userid}','{$art}')";
		mysql_query($query,$db);
		$query="update updateall set recommended=recommended+1 where id='$art'";
		mysql_query($query,$db);
		$query="update details set points=points+1 where email='$up_email'";
		mysql_query($query,$db);
		$query="select recommended from updateall where id='{$art}'";
		$row=mysql_query($query,$db);
		$values=mysql_fetch_array($row);
		$recommended=$values['recommended'];
		echo"recommended({$recommended})";		
	}
	mysql_close($db);
?>