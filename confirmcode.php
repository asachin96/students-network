<?php
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	$email=$_POST['email'];
	$code=rand(10000,99999);
	$message="confirmation code: ".$code."\n
	dont reply to this mail and delete this mail asap";
	$subject="please use this code for completion of your signup";
	if(mail($email,$subject,$message))
		echo $code;
	else
		echo "failed";
?>