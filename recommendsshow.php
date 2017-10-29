<?php
	session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	require_once("functions/functions.php");
	$art=$_POST['art'];
	$up_email=$_POST['email'];
	$query="select user_id from op where  art_id='$art' and type='0'";
	$s=mysql_query($query,$db);
	echo "<h4 align='center' class='rec_head'>Recommended By</h4><ul class='rec_hwrap'>";
	while($row=mysql_fetch_array($s)){
		$query="select * from details where id='{$row['user_id']}'";
		$s1=mysql_query($query,$db);
		$row1=mysql_fetch_array($s1);
		$email1=$row1['email'];
		$ref="other_student.php?email=$email1";
		echo "<li class='rec_wrap' ref ='{$ref}'><img src='{$row1['path']}' height='25' width='25' class='rec_img'/>
		<div class='rec_details'>{$row1['firstname']} {$row1['lastname']},{$row1['college']}</div></li>";
	}
?>