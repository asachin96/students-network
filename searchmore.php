<?php	
	require_once("header.php");
	$email=$_SESSION['email'];
	if(!isset($_GET['cat'])){
		header("location:search.php");
		exit;
	}
	require_once("functions/functions.php");
	if(!isset($_GET['search'])||!isset($_GET['cat'])||!isset($_GET['count'])){
		header("location:index.php");
		exit;
	}
	$search=$_GET['search'];
	$cat=$_GET['cat'];
	$count=$_GET['count'];
	$cur_email=$_SESSION['email'];
	$values=get_info($cur_email);
	$cur_college=$values['college'];
	$cur_branch=$values['branch'];
?>
<div class="outline_wrapper">

<div id='middle1'>
<?php 
	$off=10;
	echo"<div class='ask_doubt_wrap'><div id='ask_doubt' align='center'>$cat</div></div>";
	switch($cat){
		case 'people':$query="select *,match(firstname,lastname,branch,college) against('<$cur_branch <$cur_college >$search*'in boolean mode) as relevance
	 					from details where match(firstname,lastname,branch,college) against('<$cur_branch <$cur_college >$search*' in boolean mode) order by relevance desc";
		$ro=mysql_query($query,$db);
		$total=mysql_affected_rows();
		$k=1;
		while(($row=mysql_fetch_array($ro)) && ($k<=$off)){
			$k++;
			$name=$row['firstname'];
			$college=$row['college'];
			$path=$row['path'];
			$email=$row['email'];
			$values=get_info($email);
			$branch=$values['branch'];
			if($email==$cur_email)
				continue;
			echo "
				<a href='other_student.php?email=$email'><div class='colleges_results'>
						<div class='colleges_img'><img src='{$path}' width='89' height='50'/></div>
						<div class='colleges_name' align='center'>$name,$college</div>
				</div></a>";
				
		}
		if($k>=10)
			echo "<div class='people_link'><a href='searchnext.php?cat=$cat&loaded=$off&dir=next&search=$search&count=$count' class='people_a'>next</a></div>";
		break;
case 'colleges':$query="select * from colleges where match(college,college_ex) against('$search*' in boolean mode)";
		$ro=mysql_query($query,$db);
		$total=mysql_affected_rows();
		$k=1;
		while(($row=mysql_fetch_array($ro)) && ($k<=$off)){
		$k++;
		$college=$row['college'];
		$path=$row['path'];
		$place=$row['place'];
		echo "<a href='colleges.php?co_select={$college}'><div class='colleges_results'>
			<div class='colleges_img'><img src='{$path}' width='89' height='50'/></div>
			<div class='colleges_name' align='center'>$college,$place</div>
		     </div></a>";
		}
		if($k>=10)
		echo "<div class='people_link'><a href='searchnext.php?cat=$cat&loaded=$off&dir=next&search=$search&count=$count' class='people_a'>next</a></div>";
		break;
		case 'general news':$query="select *,match(subject,topic,details,college) against('<$cur_college >$search*'in boolean mode) as relevance 
						from updateall where match(subject,topic,details,college) against('<$cur_college >$search*' in boolean mode) and type=2 and private=0 order by relevance desc";
						$ro=mysql_query($query,$db);
						$total=mysql_affected_rows();
						$k=1;
						while(($row=mysql_fetch_array($ro)) && ($k<=$off)){
						$k++;
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
						if($k>=10)
						echo "<div class='people_link'><a href='searchnext.php?cat=$cat&loaded=$off&dir=next&search=$search&count=$count' class='people_a'>next</a></div>";
						break;
		case 'academic news':$query="select *,match(subject,topic,details,college) against('<$cur_college >$search*'in boolean mode) as relevance
	 					from updateall where match(subject,topic,details,college) against('<$cur_college >$search*' in boolean mode) and type=1 and private=0 order by relevance desc";
	 					$ro=mysql_query($query,$db);
						$total=mysql_affected_rows();
						$k=1;
						while(($row=mysql_fetch_array($ro)) && ($k<=$off)){
						$k++;
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
						$details=nl2br(htmlspecialchars($x['details']));
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
						if($k>=10)
						echo "<div class='people_link'><a href='searchnext.php?cat=$cat&loaded=$off&dir=next&search=$search&count=$count' class='people_a'>next</a></div>";
						break;
		case 'doubts':  $query="select *,match(main_cat,topic,details,sub_cat) against('<$cur_branch >$search*'in boolean mode) as relevance
	 					from doubt where match(main_cat,topic,details,sub_cat) against('<$cur_college >$search*' in boolean mode) order by relevance desc";
	 					$ro=mysql_query($query,$db);
						$total=mysql_affected_rows();
						$k=1;
						while(($row=mysql_fetch_array($ro)) && ($k<=$off)){
						$k++;
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
						</div>";
						}
						if($k>=10)
						echo "<div class='people_link'><a href='searchnext.php?cat=$cat&loaded=$off&dir=next&search=$search&count=$count' class='people_a'>next</a></div>";
						break;
	}
?>
</div>
</div>
<footer id="footer"><div id='foot'>Copyright &copy 2012 students-network.com. All pages of the website are subject to our terms and condition and privacy policy.U must not reproduce, duplicate, sell, resell or exploit any material on the website for any commercial purpose without written permission from admin.</div></footer>
<script type='text/javascript' src='js/jquery.js'></script> 
<script type='text/javascript' src='js/index.js'></script>
<script type='text/javascript' src='js/correct.js'></script>
<?php 	mysql_close($db); ?>
</body>
</html>