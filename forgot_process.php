<?php 
$db=mysql_connect('localhost','students_sachin','!sn;2614');
mysql_select_db('students_network',$db);
$pass1=$_POST['pass1'];
$pass2=$_POST['pass2'];
$email=$_POST['email'];

if($pass1==$pass2)
{
	$pass1=sha1($pass1);
	$query="update details set password='{$pass1}' where email='$email'";
	mysql_query($query,$db);
	header("location:login.php");
	exit();
}
else
{
	header("location:forgot3.php?z=0&email=$email");
	exit();
}
?>
