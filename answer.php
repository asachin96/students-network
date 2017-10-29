<?php 
	session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
?>

<?php
	require_once('functions/functions.php');
	$text=mysql_real_escape_string($_POST['content']);
	if(!filter($text)){
		$art_id=$_POST['art'];
		$d_email=$_POST['email5'];
		$email=$_SESSION['email'];
		$values=get_info($email);
		$userid=$values['id'];
		$src=$values['path'];
		$firstname=$values['firstname'];
		$college=$values['college'];
		$recommended=0;
		$time1=time();
	        $time=date('d/m/y h:i:s a',time());
		$query="insert into answer(art_id,answer,email,time) values('{$art_id}','{$text}','{$email}','{$time}')";
		mysql_query($query,$db);
		$ref="doubt_show.php?art_id=".$art_id ;
		if($email!=$d_email){
		$query="insert into event(femail,temail,ref,type,time) values('{$email}','{$d_email}','{$ref}','5','{$time1}')";
		mysql_query($query,$db);}
		
		$query="select id from answer where time='$time'";
		$g=mysql_query($query,$db);
		$p=mysql_fetch_array($g);
		$id=$p['id'];
		$text=htmlspecialchars($text);
		$text=similey($text);
		$text=stripslashes(str_replace('\n','<br/>',$text));
		echo "<div class='comment_left1'><li>
				<div class='com_wrap_left1'>
					<div class='com_img_left4'><img src='$src' width='30' height='30' style='border:1px solid rgba(9,83,111,.5)'/></div>
					<div class='com_name_left1'>$firstname,$college</div>
					<div class='com_time_left1'>$time</div>
				<div class='com_con_left1'>$text</div>
				</div>
				 <div class='news_wrapper' >
				<div class='news_content1'>
					 <div class='news_buttons1'><a href='#' tbl='2' class='ans_recommended' article_id='$id' id='$userid' email='$email'> 
					 recommended($recommended)</a></div>
				</div>
				</div>
							 
			</li></div>";	
	}
?>