<?php
session_start();
	if(!isset($_SESSION['email'])){	
    header("location:login.php");
	exit;
	}
	$email=$_SESSION['email'];
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	$topic=mysql_real_escape_string($_POST['topic']);
	$details=mysql_real_escape_string($_POST['details']);
	$private=$_POST['check'];
   	$time=date('d/m/y h:i:s a',time());
	require_once('functions/functions.php');
	$values=get_info($email);
	$college=$values['college'];
	if(($topic=='')|($details=='')){
        	header('location:'.$_SERVER['HTTP_REFERER']);
		exit;	
        }
	if(filter($details)){
        	header('location:'.$_SERVER['HTTP_REFERER']."?filtered=yes");
		exit;	
        }
	if($private=="on"){
	if(is_uploaded_file($_FILES['file']['tmp_name'])){
		$name=$_FILES['file']['name'];
		$tmp=$_FILES['file']['tmp_name'];
		$path="uploads/".$name;
		if(file_exists($path)){
			$t=explode(".",$name);
			$t1=$t[0].rand(1,10000);;
			$image_name=$t1.'.'.$t[1];
			$path="uploads/".$image_name;
		}
		move_uploaded_file($tmp,$path);
		
		$query="insert into updateall(email,college,topic,details,path,time,private) 
		value('{$email}','{$college}','{$topic}','{$details}','{$path}','{$time}','{$private}')";
	}
	else
	$query="insert into updateall (email,college,topic,details,time,private) 
			value('{$email}','{$college}','{$topic}','{$details}','{$time}','1')";
	mysql_query($query,$db);
	header('location:'.$_SERVER['HTTP_REFERER']);
	exit;	
	}
	else{
		if(is_uploaded_file($_FILES['file']['tmp_name'])){
		$name=$_FILES['file']['name'];
		$tmp=$_FILES['file']['tmp_name'];
		$path="uploads/".$name;
		if(file_exists($path)){
			$t=explode(".",$name);
			$t1=$t[0].rand(1,10000);;
			$image_name=$t1.'.'.$t[1];
			$path="uploads/".$image_name;
		}
		move_uploaded_file($tmp,$path);
		$query="insert into updateall(email,college,topic,details,path,time) 
		value('{$email}','{$college}','{$topic}','{$details}','{$path}','{$time}')";
	}
	else
	$query="insert into updateall (email,college,topic,details,time) 
			value('{$email}','{$college}','{$topic}','{$details}','{$time}')";
	mysql_query($query,$db);
	header('location:'.$_SERVER['HTTP_REFERER']);
	exit;	
	}
?>