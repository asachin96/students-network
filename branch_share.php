<?php
session_start();
	if(!isset($_SESSION['email'])){	
    header("location:login.php");
	exit;
	}
	$email=$_SESSION['email'];
	require_once('functions/functions.php');
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	$subject=$_POST['subject'];
	$topic=htmlspecialchars($_POST['topic']);
	$details=htmlspecialchars($_POST['details']);		
	$time1=date('d/m/y h:i:s a',time());
	$values=get_info($email);
        $college=$values['college'];
        $link="location:branch_middle.php?college={$college}&subject={$subject}";
        if(($topic=='')|($details=='')){
        	header('location:'.$_SERVER['HTTP_REFERER']);
		exit;	
        }
        if(filter($details)){
        	header($link."&filtered=yes");
		exit;	
        }
	if(is_uploaded_file($_FILES['file']['tmp_name'])){
		$name=$_FILES['file']['name'];
		$tmp=$_FILES['file']['tmp_name'];
		$path="uploads/".$name;
		if(file_exists($path)){
			$t=explode(".",$name);
			$t1=$t[0].rand(1,10000);
			$image_name=$t1.'.'.$t[1];
			$path="uploads/".$image_name;
		}
		move_uploaded_file($tmp,$path);
		$query="insert into updateall (email,college,topic,details,path,subject,time,type) 
		value('{$email}','{$college}','{$topic}','{$details}','{$path}','{$subject}','{$time1}',1)";
	}
	else
	$query="insert into updateall (email,college,topic,details,subject,time,type) 
			value('{$email}','{$college}','{$topic}','{$details}','{$subject}','{$time1}',1)";	
	mysql_query($query,$db);
	header($link);
	exit; 
?>