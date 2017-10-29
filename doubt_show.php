<?php
	require_once('header.php');
	if(!isset($_COOKIE['val']))
		setcookie('val',0,time()+999999);
	$email=$_SESSION['email'];
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);	
?>

<div id='outline_wrapper'>
<aside id="left">
 <div align="center">start a discussion</div>
    <form action="discuss_start.php" method='post'>
        <input type='text'  name='topic' id='discussion_input' maxlength="100">
        <input type='submit' value='start' class='button_submit discuss_start_button'/>
    </form>
<div align="center">recent discusssions</div>
<div class='sub_wrap'>
<?php
$query="select * from discuss";
$r=mysql_query($query,$db);
while($row=mysql_fetch_array($r)){
	$dis_id=$row['id'];
	$topic=htmlspecialchars($row['topic']);
	$count=0;
	$query="select distinct email from update_com where discuss_id='$dis_id'";
	$p=mysql_query($query,$db);
	while(mysql_fetch_array($p))
	 $count++;
	 echo "<div class='sub_name' align='center'><a href='discuss.php?dis_id={$dis_id}&topic={$topic}'>$topic($count)</a></div>"; 
}
?>
</div>

</aside>
<div id='middle2'>
    <div id='doubt_main'>
   		<?php
			if(isset($_POST['art_id']))
				$art_id=$_POST['art_id'];
			else if(isset($_GET['art_id']))
				$art_id=$_GET['art_id'];
			require_once('functions/functions.php');
			$cur_email=$_SESSION['email'];
			$values=get_info($email);
			$branch=$values['branch'];
			$query="select * from doubt where id='$art_id'";
			$ro=mysql_query($query,$db);
			$row=mysql_fetch_array($ro);
			$email=$row['email'];
			$email5=$email;
			$topic=htmlspecialchars($row['topic']);
			$time=$row['time'];
			$path=$row['path'];
			$id=$row['id'];
			$art=$id;
			$details=nl2br(htmlspecialchars($row['details']));
			$details=similey($details);
			$text = $details;	
			$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";		
			if(preg_match($reg_exUrl, $text, $url)) {
			       $details=preg_replace($reg_exUrl, '<a href="'.$url[0].'" rel="nofollow" target="_blank">'.$url[0].'</a>', $text);
			
			} else {
			       $details=$text;
			
			}
			$values=get_info($email);
			$src=$values['path'];
			$name=$values['firstname'];
			$college=$values['college'];
			echo"<div class='com_wrap1'>
				<div class='com_img1'><img src='$src' width='45' height='45'/></div>
				<div class='com_name1'><a href='other_student.php?email={$email}'>$name</a>,
				<a href='other_college.php?college={$college}'>$college</a></div>
				<div class='com_time1'>{$time}</div>
			<div class='com_con1'>$topic</div>
			<div class='com_con2'>$details</div>
			</div>
			<div class='news_wrapper' >
				<div class='news_content_d'>";
					 if($path!='no'){
						$e=get_type($path);
				 		echo $e;
					 }
					 echo"
				</div>
			</div>
		<div class='reply_form{$id}'>
		<output id='comment$id'>";	
			$query="select * from answer where art_id='$art_id'";
			$d=mysql_query($query,$db);
			while($row=mysql_fetch_array($d)){
				$email=$row['email'];
				$content=nl2br(htmlspecialchars($row['answer']));
				$content=similey($content);
				$text = $content;	
				$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";		
				if(preg_match($reg_exUrl, $text, $url)) {
				       $content=preg_replace($reg_exUrl, '<a href="'.$url[0].'" rel="nofollow" target="_blank">'.$url[0].'</a>', $text);
				
				} else {
				       $content=$text;
				
				}
				$time=$row['time'];
				$id=$row['id'];
				$recommended=$row['recommended'];
				$values=get_info($email);
				$src=$values['path'];
				$firstname=$values['firstname'];
				$college=$values['college'];
				$userid=$values['id'];		
			echo"<div class='comment_left1'><li>
			<div class='com_wrap_left1'>
				<div class='com_img_left4'><img src='$src' width='35' height='35' style='border:1px solid rgba(9,83,111,.5)'/></div>
				<div class='com_name_left1'><a href='other_student.php?email={$email}'>$firstname</a>,
				<a href='other_college.php?college={$college}'>$college</a></div>
				<div class='com_time_left1'>$time</div>
			<div class='com_con_left1'>$content</div>
			</div>
			 <div class='news_wrapper' >
				<div class='news_content1'>
					 <div class='news_buttons1'><a href='#' tbl='2' class='ans_recommended' article_id='$id' id='$userid' email='$email'> 
					 recommended($recommended)</a></div>
				</div>
			</div>
			 
			</li></div>";
				}
					echo "</output>
						<textarea id='area$art' class='comm doubt_com_feild' rows='6' cols='83%'></textarea>
						<br/><input type='submit' class='answer_submit button_submit' art_id='$art' email='$email' email5='$email5' value='reply'>
					</div>";			

?>

    </div>
</div>
</div>

<footer id="footer"><div id='foot'>Copyright &copy 2012 students-network.com. All pages of the website are subject to our terms and condition and privacy policy.U must not reproduce, duplicate, sell, resell or exploit any material on the website for any commercial purpose without written permission from admin.</div></footer></div>
<script type='text/javascript' src='js/jquery.js'></script>       
<script type='text/javascript' src='js/index.js'></script>
<?php 	mysql_close($db); ?>
</body>
</html>