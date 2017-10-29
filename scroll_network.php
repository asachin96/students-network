<?php 
    session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
?>
<?php
	require_once('functions/functions.php');
	if(!isset($_SESSION['val'])){
		 $val=10;
	}
	else{
	
		$val=$_SESSION['val'];
	}
	$i=0;
	$query="select * from updateall order by id DESC";
   	$r=mysql_query($query,$db);
	for($j=0;$j<$val;$j++)
	$x=mysql_fetch_array($r);
	$email1=$_SESSION['email'];         
	while($x=mysql_fetch_array($r)){
		++$j;
		$_SESSION['val']=$j;
		$details=nl2br(htmlspecialchars($x['details']));
		$details=similey($details);
		$text = $details;	
		$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";		
		if(preg_match($reg_exUrl, $text, $url)) {
		       $details=preg_replace($reg_exUrl, '<a href="'.$url[0].'" rel="nofollow" target="_blank">'.$url[0].'</a>', $text);
		
		} else {
		       $details=$text;
		
		}
		$email=$x['email'];
		$recommended=$x['recommended'];
		$id=$x['id'];
		$date=$x['time'];
		$path=$x['path'];
		$values=get_info($email);
		$src=$values['path'];
		$name=$values['firstname'];
		$college=$values['college'];
		require_once("functions/functions.php");	
		$user=get_info($email1);
		$userid=$user['id'];			   
		$art=$id;
		$query="select friend from network where email='$email1'";
		$p=mysql_query($query,$db);
		while($friend=mysql_fetch_array($p)){
			$frnd_email=$friend['friend'];
			if($frnd_email==$email){
				$i++;
				if($i%10==0){
				goto t;
			}
		echo"<div class='news' i='$id' id='art$id'>
			<div class='news_top'>
				<div class='news_image'>			
					<img src='{$src}' width='40' height='40'>
				</div>
				<div class='news_user'>
					<a href='other_student.php?email={$email}'>{$name}</a>,<a href='other_college.php?college={$college}'>{$college}</a>
					<div class='date'>$date</div>
				</div>
			 </div>";
		if($_SESSION['email']==$email)
				echo "<div><a href='' email='$email' class='delete_art' id='del$art' oid='$art'>del</a></div>";
			echo "<div class='news_details'>{$details}</div>
			<div class='down_sec' align='center'>";
			if($path!='no'){
						$e=get_type($path);
					 	echo $e;
				 }
				 echo"
			</div>
		  <div><a href='' id='$id' class='comments'>comments";
		   $query="select * from comment where art_id='{$id}'";
		   mysql_query($query,$db);
		  echo "<span class='commcount'>(".mysql_affected_rows().")</span>";
		   echo "<img src='images/collapse.png'  class='doubt_img'/></a></div>
	
	<div class='com_waiting$id commm' style='position:absolute; left:230px; display:none'><img src='images/waiting.gif' width='30' 
	height='30'/></div>
		     <div ><a href='' id='c$id' pa='$art' style='display:none' class='clo'>comments<img src='images/expand.png'  class='doubt_img'/></a></div>
			<div class='reply_form{$id}' style='display:none'>
				<output id='comment$id'></output>
				<textarea id='area$id' class='comm' rows='2' cols='62'></textarea>
				<input type='submit' class='subm button_submit' art_id='$art' email='$email' value='reply'>
			</div>
		<div class='news_wrapper' >
			<div class='news_content'>
				 <div class='news_buttons'><a href='#' tbl='2' class='recommended' article_id='$id' id='$userid' email='$email'> 
				 recommended($recommended)</a></div>
				 <div class='news_buttons'><a href='#' tbl='2'class='offensive' article_id='$id' email='$email'>offensive</a></div>";
			echo "	 
			</div>
		</div>
</div >";
	}
		}
	}
t:	
?>