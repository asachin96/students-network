<?php 
	session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	
	$query="select * from branch_subject";
	$s=mysql_query($query,$db);
	while($r=mysql_fetch_array($s))
	{
	 $sub=$r['subject'];
	 $b=$r['branch'];
	$query="select college from colleges";
	$f=mysql_query($query,$db);
	while($d=mysql_fetch_array($f))
	{
	echo $col=$d['college'];
	
	$query="insert into branch_subject(subject,branch,college) value('{$sub}','{$b}','{$col}')";
	mysql_query($query,$db);
	
	}
	}