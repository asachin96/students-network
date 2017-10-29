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
	$main_cat=$_POST['main_cat'];
	if(($topic=='')|($details=='')){
        	header('location:'.$_SERVER['HTTP_REFERER']);
		exit;	
        }
	if(is_uploaded_file($_FILES['file']['tmp_name'])){
		$name=$_FILES['file']['name'];
		$tmp=$_FILES['file']['tmp_name'];
		$path="uploads/".$name;
		if(file_exists($path)){
			$t=explode(".",$image_name);
			$t1=$t[0].rand(1,10000);;
			$image_name=$t1.'.'.$t[1];
			$path="images/".$image_name;
		}
		move_uploaded_file($tmp,$path);
		if($main_cat=="technical"){
			$sub_cat=$_POST['sub_cat'];
			$time=date('d/m/y h:i:s a',time());
			$query="insert into doubt(topic,email,details,time,main_cat,sub_cat,path) 
			values('{$topic}','{$email}','{$details}','{$time}','{$main_cat}','{$sub_cat}','{$path}')";
			mysql_query($query,$db);
			
			$time1=time();
			$query="select id from doubt where topic='{$topic}' ";
			$r=mysql_query($query,$db);
			$r1=mysql_fetch_array($r);
			$art=$r1['id'];
			$ref="doubt_show.php?art_id=".$art ;
			$query="select * from network where email='{$email}' ";
			$r2=mysql_query($query,$db);
			while($r3=mysql_fetch_array($r2)) {
				$friend=$r3['friend']; 
				$query="insert into event(femail,temail,ref,type,time) values('{$email}','{$friend}','{$ref}','4','{$time1}') ";
				mysql_query($query,$db);
			}
			header("location:discussion.php");
		}
		elseif($main_cat=="general"){
			$time=date('d/m/y h:i:s a',time());
			$query="insert into doubt(topic,email,details,time,main_cat,path) 
			values('{$topic}','{$email}','{$details}','{$time}','{$main_cat}','{$path}')";
			mysql_query($query,$db);
			$time1=time();
			$query="select id from doubt where topic='{$topic}' ";
			$r=mysql_query($query,$db);
			$r1=mysql_fetch_array($r);
			$art=$r1['id'];
			$ref="doubt_show.php?art_id=".$art ;
			$query="select * from network where email='{$email}' ";
			$r2=mysql_query($query,$db);
			while($r3=mysql_fetch_array($r2)) {
				$friend=$r3['friend']; 
				$query="insert into event(femail,temail,ref,type,time) values('{$email}','{$friend}','{$ref}','4','{$time1}') ";
				mysql_query($query,$db);
			}
			header("location:discussion.php");
		}
	}
	else{
		if($main_cat=="technical"){
			$sub_cat=$_POST['sub_cat'];
			$time=date('d/m/y h:i:s a',time());
			$query="insert into doubt(topic,email,details,time,main_cat,sub_cat) 
			values('{$topic}','{$email}','{$details}','{$time}','{$main_cat}','{$sub_cat}')";
			mysql_query($query,$db);
			
			$time1=time();
			$query="select id from doubt where topic='{$topic}' ";
			$r=mysql_query($query,$db);
			$r1=mysql_fetch_array($r);
			$art=$r1['id'];
			$ref="doubt_show.php?art_id=".$art ;
			$query="select * from network where email='{$email}' ";
			$r2=mysql_query($query,$db);
			while($r3=mysql_fetch_array($r2)) {
				$friend=$r3['friend']; 
				$query="insert into event(femail,temail,ref,type,time) values('{$email}','{$friend}','{$ref}','4','{$time1}') ";
				mysql_query($query,$db);
			}
			header("location:discussion.php");
		}
		elseif($main_cat=="general"){
			$time=date('d/m/y h:i:s a',time());
			$query="insert into doubt(topic,email,details,time,main_cat) 
			values('{$topic}','{$email}','{$details}','{$time}','{$main_cat}')";
			mysql_query($query,$db);
			$time1=time();
			$query="select id from doubt where topic='{$topic}' ";
			$r=mysql_query($query,$db);
			$r1=mysql_fetch_array($r);
			$art=$r1['id'];
			$ref="doubt_show.php?art_id=".$art ;
			$query="select * from network where email='{$email}' ";
			$r2=mysql_query($query,$db);
			while($r3=mysql_fetch_array($r2)) {
				$friend=$r3['friend']; 
				$query="insert into event(femail,temail,ref,type,time) values('{$email}','{$friend}','{$ref}','4','{$time1}') ";
				mysql_query($query,$db);
			}
			header("location:discussion.php");
		}
	}
?>