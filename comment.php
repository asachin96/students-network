 <?php 
	session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
?>

<?php
	require_once('functions/functions.php');
	$text=mysql_real_escape_string($_POST['content']);
	if(!(filter($text))){
		$art_id=$_POST['art'];
		$email=$_SESSION['email'];
		$values=get_info($email);
		$src=$values['path'];
		$firstname=$values['firstname'];
		$college=$values['college'];
		$time1=time();
	    	$time=date('d/m/y h:i:s a',time());
		$query="insert into comment(art_id,comment,email,time) value('{$art_id}','{$text}','{$email}','{$time}')";
		mysql_query($query,$db);
		$text=str_replace('\n','<br/>',$text);	
		$query="select email from updateall where id='{$art_id}' ";
		$p=mysql_query($query,$db);
		$r=mysql_fetch_array($p);
		$temail=$r['email'];
		$ref="article.php?art=".$art_id ;
		if($temail!=$email){
			$query="insert into event(femail,temail,ref,type,time) value('{$email}','{$temail}','{$ref}','6','{$time1}')";
			mysql_query($query,$db);
		}
	}
?>