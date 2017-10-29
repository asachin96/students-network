<?php 
session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	?>
<?php
$email=$_SESSION['email'];
$subject=$_POST['subject'];
$college=$_POST['college'];
$query="insert into subscription(email,subject,college) value('{$email}','{$subject}','{$college}')";
mysql_query($query,$db)
?>

<?php mysql_close($db); ?>