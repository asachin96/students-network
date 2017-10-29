<?php
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	$email=$_POST['email'];
	$query="select * from details where email='{$email}'";
	mysql_query($query,$db);
	if(mysql_affected_rows()!=0)
		echo "already used";	
?>