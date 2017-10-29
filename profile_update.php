<?php
	session_start();
	$email=$_SESSION['email'];
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db); 
	require_once("functions/functions.php");
	$values=get_info($email);
	$del_img=$values['path'];
	$temp=explode('/',$del_img);
	$temp1_big=explode('.',$temp[1]);
	$temp_big=$temp1_big[0]."big.".$temp1_big[1];
	$del_img_big1=explode(".",$del_img);
	$del_img_big=$del_img_big1[0]."big.".$del_img_big1[1];
	if(isset($_POST['name'])&&!empty($_POST['name'])){
		$name=$_POST['name'];
		$query="update details set firstname='{$name}' where email='{$email}'";
		mysql_query($query,$db);
	}
	if(is_uploaded_file($_FILES['image']['tmp_name'])){
		$image_name=$_FILES['image']['name'];
		$fil=$_FILES['image']['tmp_name'];
		$type=$_FILES['image']['type'];
		$t=explode("/",$type);
		if($t[0]!='image'){
			header("location:index.php");
			exit;
		}
		$path="images/".$image_name;
		/*if(file_exists($path)){
			header("location:index.php?img=122");
			exit;
		}*/
		$size=filesize($fil)/1000;
		if(strcmp($t[1],'jpg')){
			if($size>1000){
				$filp = imagecreatefromjpeg($fil);	
				imagejpeg($filp,"images/".$image_name, 5);
			}
			else if($size>500){
				$filp = imagecreatefromjpeg($fil);	
				imagejpeg($filp,"images/".$image_name, 10);
			}
			else if($size>200){
				$filp = imagecreatefromjpeg($fil);	
				imagejpeg($filp,"images/".$image_name, 25);
			}
			else{
				$filp = imagecreatefromjpeg($fil);	
				imagejpeg($filp,"images/".$image_name, 40);
			}
		}
		else if(strcmp($t[1],'png')){
			if($size>1000){
				$filp = imagecreatefrompng($fil);	
				imagepng($filp,"images/".$image_name, 5);
			}
			else if($size>500){
				$filp = imagecreatefrompng($fil);	
				imagepng($filp,"images/".$image_name, 10);
			}
			else if($size>200){
				$filp = imagecreatefrompng($fil);	
				imagepng($filp,"images/".$image_name, 25);
			}
			else{
				$filp = imagecreatefrompng($fil);	
				imagepng($filp,"images/".$image_name, 40);
			}
		}
		else{
			header("location:index.php?p=123454321");
			exit;
		}
		$image_name_big=explode(".",$image_name);
		$image_name_big=$image_name_big[0]."big.".$image_name_big[1];
		$path1="images/".$image_name_big;
		if(file_exists($path1)){
			$t=explode(".",$image_name_big);
			$t1=$t[0].rand(1,10000);;
			$image_name_big=$t1.'.'.$t[1];
			$path="images/".$image_name_big;
		}
		move_uploaded_file($fil,$path1);
		$query="update details set path='{$path}' where email='{$email}'";
		mysql_query($query,$db);
		
		if($temp_big!="defaultbig.jpg"){
			unlink($del_img_big);
		}
		if($temp[1]!="default.jpg"){
			unlink($del_img);
		}
	}	
	mysql_close($db);
	header('location:index.php');
	exit;
?>