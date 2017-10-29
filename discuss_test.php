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
	$query="select * from update_com";
	$s=mysql_query($query,$db);
	while($row=mysql_fetch_array($s)){
		$time1=$row['time'];
		$iad=$row['id'];
		if(($time-$time1)>60){
			$query="delete from update_com where id='$iad'";
			mysql_query($query,$db);
		}
	}
		$query="select * from discuss";
		$r=mysql_query($query,$db);
		while($row=mysql_fetch_array($r)){
		$dis_id=$row['id'];
		$topic=$row['topic'];
		$count=0;
		$query="select distinct email from update_com where discuss_id='$dis_id'";
		$p=mysql_query($query,$db);
		while(mysql_fetch_array($p))
		 $count++;
		 echo "<div class='sub_name' align='center'><a href='discuss.php?dis_id={$dis_id}&topic={$topic}'>$topic($count)</a></div>"; 
		}
?>