<?php
session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
?>

<?php
$user=$_SESSION['email'];
$network=$_POST['network'];
$time1=time();
$query="select id from network where email='$user' and friend='$network'";
mysql_query($query,$db);
if(mysql_affected_rows()){
	echo "In Your Network";
}
else{
if($network!=$user) {
$query="insert into event(femail,temail,type,time) values('{$user}','{$network}','3','{$time1}')" ;
mysql_query($query,$db);}
$query="insert into network(email,friend) value('{$user}','{$network}')";
if(mysql_query($query,$db)){echo "Successfully Added";}
}
?>