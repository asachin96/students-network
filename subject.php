<?php

session_start();

	if(!isset($_SESSION['email'])){	
    header("location:login.php");
	exit;
	}
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	 $college=$_POST['college'];
	 $subject=$_POST['subject']; 
	$_SESSION['val']=10;		
	setcookie('condition',"college='$college' and subject='$subject' and type=1",time()+9999999);
	

if(isset($_POST['subject'])){
$subject= $_POST['subject'];
	echo"<div id='middle'> <div class='discuss_sub_heading'> latest in $subject  </div>
         	<div id='waiting'><img src='images/waiting.gif' width='30' height='30'/></div>";
			 $college=$_POST['college'];
			 $subject=$_POST['subject'];         
			require_once('functions/functions.php');
			$query="select * from updateall where college='$college' and subject='$subject' and type=1 order by id desc";
			$p=mysql_query($query,$db);
			$i=0;
			while($sub=mysql_fetch_array($p)){
				if($i==10){
				break;
			}
			   $i++;
			   $email=$sub['email'];
			   $details=nl2br(htmlspecialchars($x['details']));
			   $details=similey($details);
				$text = $details;	
				$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";		
				if(preg_match($reg_exUrl, $text, $url)) {
				       $details=preg_replace($reg_exUrl, '<a href="'.$url[0].'" rel="nofollow" target="_blank">'.$url[0].'</a>', $text);
				
				} else {
				       $details=$text;
				
				}
				   $id=$sub['id'];
				   $date=$sub['time'];
				   $path=$sub['path'];
				   $values=get_info($email);
				   $name=$values['firstname'];
				   $src=$values['path'];
				   $recommended=$sub['recommended'];
				   $offensive=$sub['offensive'];
				   $email1=$_SESSION['email'];
				require_once("functions/functions.php");	
				$user=get_info($email1);
				$userid=$user['id'];
				mysql_query("set @row:=0",$db);
				$query="select rank,email,points from(select @row:=@row+1 as rank,id,email,points from details order by points desc)as result 
				where email='{$email}'"; 
				$s=mysql_query($query,$db);
				$row=mysql_fetch_array($s);
				$rank=$row['rank'];
				$points=$row['points'];
				$art=$id;								
	  echo "<div class='news' i='$id' id='art$id'>
		<div class='news_top'>
			<div class='news_image' email='$email' >			
				<a href='other_student.php?email=$email' upid='$id' class='news_img' i='$id' email='$email'>
				<img src='{$src}' width='40' height='40'></a>
			</div>
			<div class='news_user'>
				<a href='other_student.php?email={$email}'>{$name}</a>,<a href='other_college.php?college={$college}'>{$college}</a>
				<div class='date'>$date</div>
			</div>
			</div>
			<div class='$id news_points'  style='display:none'>
				<div class='news_po'>
					<span>rank($rank),points($points)</span>";
					
					echo "<div class='add_network1' email='$email' i='$id' id='net$id'></div>
				</div>
			</div>
		"; 
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
			<input type='submit' class='subm' art_id='$art' email='$email' value='reply'>
		</div>
	<div class='news_wrapper' >
		<div class='news_content'>
			 <div class='news_buttons'><a href='#' tbl='2' class='recommended' article_id='$id' id='$userid' email='$email'> 
			 recommended($recommended)</a></div>
			 <div class='news_buttons'><a href='#' tbl='2'class='offensive' article_id='$id' email='$email'>offensive</a></div>";
				 echo"
				</div>
			</div>
        	</div >";

				}
		echo "
</div>";
				
}
 	mysql_close($db); 

?>