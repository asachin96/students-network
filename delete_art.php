<?php
session_start();
	if(!isset($_SESSION['email'])){	
    header("location:login.php");
	exit;
	}
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
?>
<?php
	$user_email=$_SESSION['email'];
	$email=$_POST['email'];
	$id=$_POST['id'];
	if($user_email==$email){
		$query="select * from updateall where id='$id'";
		$ro=mysql_query($query,$db);
		$row=mysql_fetch_array($ro);
		$src=$row['path'];
		if($src!='no')
			unlink($src);
		$query="delete from updateall where id='$id'";
         	mysql_query($query,$db);
		 $query="delete from comment where art_id='$id'";
		 mysql_query($query,$db);
		 
	}

?>
<?php mysql_close($db); ?>