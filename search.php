<?php	
	require_once("header.php");
	$email=$_SESSION['email'];
	if(!isset($_GET['query'])){
		header("location:index.php");
		exit;
	}
	require_once("functions/functions.php");
	$search=$_GET['query'];
	$temp=explode(' ',$search);
	$search='';
	foreach($temp as $t){
		$search=$search.'+'.$t;
	}
?>

<div class="outline_wrapper">

<div id='middle1'>
<div class='ask_doubt_wrap'><div id='ask_doubt'>search results</div></div>
<?php
	$cur_email=$_SESSION['email'];
	$values=get_info($cur_email);
	$cur_college=$values['college'];
	$cur_branch=$values['branch'];
	$query="select *,match(firstname,lastname,branch,college) against('<$cur_branch <$cur_college >$search*'in boolean mode) as relevance
	 from details where match(firstname,lastname,branch,college) against('<$cur_branch <$cur_college >$search*' in boolean mode) order by relevance desc";
	$ro=mysql_query($query,$db);
	$count=mysql_affected_rows();
	if($count!=0){
	echo "<div class='discuss_sub_heading'><a href='searchmore.php?cat=people&search=$search&count=$count'>people($count)<img src='images/plus.png' class='plus_image'></a></div>";
	$i=0;
	while($row=mysql_fetch_array($ro)){
		if($i++==4){
		 	break;
		}
		$name=$row['firstname'];
		$college=$row['college'];
		$path=$row['path'];
		$email=$row['email'];
		$values=get_info($email);
		$branch=$values['branch'];
		if($email==$cur_email)
			continue;
		echo "<div class='people_wrap'>
				<div class='people_img'><img src='$path' width='50' height='50'/></div>
				<div class='people_name'><a href='other_student.php?email=$email'>$name</a></div>
				<div class='people_college'><a href='other_college.php?college=$college'>$branch,$college</a></div>
			</div>";
	}
	}
?>
<?php
	$query="select * from colleges where match(college,college_ex) against('$search*' in boolean mode)";
	$ro=mysql_query($query,$db);
	$count=mysql_affected_rows();
	if($count!=0){
	echo "<div class='discuss_sub_heading'><a href='searchmore.php?cat=colleges&search=$search&count=$count'>colleges($count)<img src='images/plus.png' class='plus_image' /></a></div>";
		$i=0;
	while($row=mysql_fetch_array($ro)){
		if($i++==4){
			break;
		}
		$college=$row['college'];
		$place=$row['place'];
		$path=$row['path'];
		echo "<div class='people_wrap'>
				<div class='people_img'><img src='$path' width='100' height='50'/></div>
				<div class='people_colleg'><a href='other_college.php?college=$college'>$college,$place</a></div>
			</div>";
	}
	}
?>
<?php
	$query="select *,match(subject,topic,details,college) against('<$cur_college >$search*'in boolean mode) as relevance
	 from updateall where match(subject,topic,details,college) against('<$cur_college >$search*' in boolean mode) and type=2 and private=0 order by relevance desc";
	$ro=mysql_query($query,$db);
	echo mysql_error();
	$count=mysql_affected_rows();
	if($count!=0){
	echo "<div class='discuss_sub_heading'><a href='searchmore.php?cat=general news&search=$search&count=$count'>general news($count)<img src='images/plus.png' class='plus_image'></a></div>";
	$i=0;
	while($row=mysql_fetch_array($ro)){
		if($i++==4){
			break;
		}
		$email=$row['email'];
		$email1=$_SESSION['email'];
		$values=get_info($email);
		$src=$values['path'];
		$upid=$values['id'];
		$name=$values['firstname'];
		$college=$values['college'];
		$email1=$_SESSION['email'];
		$user=get_info($email1);
		$userid=$user['id'];
		$id=$row['id'];
		$date=$row['time'];
		$details=nl2br(htmlspecialchars($row['details']));
		$details=similey($details);
		$text = $details;	
		$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";		
		if(preg_match($reg_exUrl, $text, $url)) {
		       $details=preg_replace($reg_exUrl, '<a href="'.$url[0].'" rel="nofollow" target="_blank">'.$url[0].'</a>', $text);
		
		} else {
		       $details=$text;
		
		}
		$recommended=$row['recommended'];
		$path=$row['path'];
		$art=$id;
		echo "<div class='news' i='$id' id='art$id'>
				<div class='news_top'>
					<div class='news_image'>			
						<a href='other_student.php?email=$email' upid='$id' class='news_img'><img src='{$src}' width='40' height='40'></a>
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
						 if($path!='no')
							 echo "<div class='news_buttons'><a href='{$path}' email='$email' class='download'>download</a></div> ";
						 echo"
					</div>
				</div>
        	</div >";
	}}
?>
<?php
	$query="select *,match(subject,topic,details,college) against('<$cur_college >$search*'in boolean mode) as relevance
	 from updateall where match(subject,topic,details,college) against('<$cur_college >$search*' in boolean mode) and type=1 and private=0 order by relevance desc";
	$ro=mysql_query($query,$db);
	$count=mysql_affected_rows();
	if($count!=0){
	echo "<div class='discuss_sub_heading'><a href='searchmore.php?cat=academic news&search=$search&count=$count'>academic news($count)<img src='images/plus.png' class='plus_image'></a></div>";
	$i=0;
	while($row=mysql_fetch_array($ro)){
		if($i++==4){
			break;
		}
		$email=$row['email'];
		$email1=$_SESSION['email'];
		$values=get_info($email);
		$src=$values['path'];
		$upid=$values['id'];
		$name=$values['firstname'];
		$college=$values['college'];
		$email1=$_SESSION['email'];
		$user=get_info($email1);
		$userid=$user['id'];
		$id=$row['id'];
		$date=$row['time'];
		$details=nl2br(htmlspecialchars($row['details']));
		$details=similey($details);
		$text = $details;	
		$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";		
		if(preg_match($reg_exUrl, $text, $url)) {
		       $details=preg_replace($reg_exUrl, '<a href="'.$url[0].'" rel="nofollow" target="_blank">'.$url[0].'</a>', $text);
		
		} else {
		       $details=$text;
		
		}
		$recommended=$row['recommended'];
		$path=$row['path'];
		$art=$id;
		echo "<div class='news' i='$id' id='art$id'>
				<div class='news_top'>
					<div class='news_image'>			
						<a href='other_student.php?email=$email' upid='$id' class='news_img'><img src='{$src}' width='40' height='40'></a>
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
						 if($path!='no')
							 echo "<div class='news_buttons'><a href='{$path}' email='$email' class='download'>download</a></div> ";
						 echo"
					</div>
				</div>
        	</div >";
	}
	}
?>
<?php
	$query="select *,match(main_cat,topic,details,sub_cat) against('<$cur_branch >$search*'in boolean mode) as relevance
	 from doubt where match(main_cat,topic,details,sub_cat) against('<$cur_college >$search*' in boolean mode) order by relevance desc";
	$ro=mysql_query($query,$db);
	echo mysql_error();
	$count=mysql_affected_rows();
		if($count!=0){
	echo "<div class='discuss_sub_heading'><a href='searchmore.php?cat=doubts&search=$search&count=$count'>doubts($count)<img src='images/plus.png' class='plus_image'></a></div>";
	$i=0;
	while($row=mysql_fetch_array($ro)){
		if($i++==4){
			break;
		}
		$email=$row['email'];
		$topic=$row['topic'];
		$time=$row['time'];
		$id=$row['id'];
		$art=$id;
		$values=get_info($email);
		$src=$values['path'];
		$name=$values['firstname'];
		$college=$values['college'];
		echo"<div class='com_wrap'>
				<div class='com_img'><img src='$src' width='45' height='45'/></div>
				<div class='com_name'><a href='other_student.php?email={$email}'>$name</a>,
				<a href='other_college.php?college={$college}'>$college</a></div>
				<div class='com_time'>{$time}</div>
				<div class='com_con'>$topic</div>
				<a href='doubt_show.php?art_id=$art'><div class='discuss_image_wrap'>
					<div class='com_reply'>
						<img src='images/arrow.png' width='25' height='25'/>
					</div>
				</div></a>
			</div>				
		<div class='reply_form{$id}' style='display:none'>
			<output id='comment$id'></output>
			<textarea id='area$id' class='comm' rows='2' cols='62'></textarea>
			<input type='submit' class='answer_submit' art_id='$art' email='$email' value='reply'>
		</div>
		";			
	}
	}
?>

</div>
<footer id="footer"><div id='foot'>Copyright &copy 2012 students-network.com. All pages of the website are subject to our terms and condition and privacy policy.U must not reproduce, duplicate, sell, resell or exploit any material on the website for any commercial purpose without written permission from admin.</div></footer>

</div>
<script type='text/javascript' src='js/jquery.js'></script> 
<script type='text/javascript' src='js/index.js'></script>
<script type='text/javascript' src='js/correct.js'></script>
<?php 	mysql_close($db); ?>
</body>
</html>