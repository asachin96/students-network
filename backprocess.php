<?php
	session_start();
	$email=$_SESSION['email'];
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	require_once("functions/functions.php");
	$values=get_info($email);
	$del_img=$values['backimage'];
	if(is_uploaded_file($_FILES['image']['tmp_name'])){
		$image_name=$_FILES['image']['name'];
		$fil=$_FILES['image']['tmp_name'];
		$path="images/".$image_name;	
		if(file_exists($path)){
			$t=explode(".",$image_name);
			$t1=$t[0].rand(1,10000);;
			$image_name=$t1.'.'.$t[1];
			$path="images/".$image_name;
		}
		move_uploaded_file($fil,$path);
		$query="update details set backimage='{$path}' where email='{$email}'";
		mysql_query($query,$db);
		if($del_img!="images/defaultback.jpg")
			unlink($del_img);
	}		
	mysql_close($db);
	header("location:index.php");
	exit;
?>