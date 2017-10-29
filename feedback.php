<?php 
	session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
?>
<?php
$content=$_POST['content'];
$page=$_POST['page'];
$email=$_SESSION['email'];
$query="insert into feedback (email,page,feedback) value('{$email}','{$page}','{$content}')";
mysql_query($query,$db);
mysql_close($db);
?>