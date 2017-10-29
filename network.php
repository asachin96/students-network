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

if(isset($_POST['email'])){
	$femail=$_POST['email'];
	require_once("functions/functions.php");
	$val=get_info($femail);
	$name=$val['firstname'];
	echo"<div id='middle'> <div class='discuss_sub_heading '>$name 's posts</div>
         	<div id='waiting'><img src='images/waiting.gif' width='30' height='30'/></div>";
			        $email=$_POST['email'];
				require_once('functions/functions.php');
				$query="select * from updateall where email='$email' order by id desc";
				$p=mysql_query($query,$db);
				$j=0;
				while($sub=mysql_fetch_array($p)){
				   $j++;
				   if($j==25) 
				   break;
				   $path=$sub['path'];
				    $details=nl2br(htmlspecialchars($sub['details']));
				    $details=similey($details);
					$text = $details;	
					$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";		
					if(preg_match($reg_exUrl, $text, $url)) {
					       $details=preg_replace($reg_exUrl, '<a href="'.$url[0].'" rel="nofollow" target="_blank">'.$url[0].'</a>', $text);
					
					} else {
					       $details=$text;
					
					}
				   $values=get_info($email);
				   $name=$values['firstname'];
				   $college=$values['college'];
				   $src=$values['path'];
				   $recommended=$sub['recommended'];
				   $offensive=$sub['offensive'];
				   $email1=$_SESSION['email'];
				   $id=$sub['id'];
				   $user=get_info($email1);
				   $userid=$user['id'];			
					$art=$id;								
			   echo"<div class='news' i='$id' id='art$id'>
			   
						<div class='news_top'>
							<div class='news_image'>			
								<img src='{$src}' width='40' height='40'>
							</div>
							<div class='news_user'>
								<a href='other_student.php?email=$email'>{$name}</a><br/>
								<a href='other_college.php?college=$college'>{$college}</a>
							</div>
						 </div>";
				if($_SESSION['email']==$email)
						echo "<div><a href='' email='$email' class='delete_art' id='del$art' oid='$art'>del</a></div>";
					echo "<div class='news_details'>{$details}</div>
				   <div><a href='' id='$id' class='comments'>comments";
				   $query="select * from comment where art_id='{$id}'";
				   mysql_query($query,$db);
				  echo "<span class='commcount'>(".mysql_affected_rows().")</span>";
				   echo "<img src='images/collapse.png'  class='doubt_img'/></a></div>
	
				<div class='com_waiting$id commm' style='position:absolute; left:230px; display:none'><img src='images/waiting.gif' width='30' 
				height='30'/></div>
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
						 if($path!='no')
							 echo "<div class='news_buttons'><a href='{$path}' email='$email' class='download'>download</a></div> ";
						 echo"
					</div>
				</div>
        	</div >";			
				}
		echo "</div>";
		mysql_close($db);
}
?>
 