<?php
	
	require_once("header.php");
	
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
?>
<div id='outline_wrapper'>

<aside id="left">

<div id="Profile">
    <div id="profile1">
        <div id="profile_top">
            <?php
				if(isset($_GET['img'])){
					echo "<div class='img_er'>file already exists (rename the file)</div>";
				}
				$email=$_SESSION['email'];
				$query="select * from details where email='$email'";
				$row=mysql_query($query,$db);
				$values=mysql_fetch_array($row);
				$name=$values['firstname'];
				$college=$values['college'];
				$points=$values['points'];	
				$src=$values['path'];
				$src=explode("/",$src);			
				$src=explode(".",$src[1]);
				$src="images/".$src[0].'big.'.$src[1];
				echo"<div id='change'>
					<a href='' id='close'>close</a>
					<form action='profile_update.php' enctype='multipart/form-data' method='post' id='change_form'>
						name<input type='text' value='{$name}' id='profile_text' name='name'/>
						image<input type='file' name='image' id='profile_img'/>
						<input type='submit' value='save' id='change_save'/>
						<div id='change_upload'>uploading...</div>
					</form>
				</div>";		
		  echo "<div id='profile_image'><img src='{$src}' height='63' width='70' id='pic' ></div>
				<div id='profile_name' >$name<a href=''><div align='center' id='change_button'>change</div></a></div>
			</div>
			<div id='profile_bottom'>
			<ul>
				<li class='profile'><a href='college.php' id='col'>$college</a></li>";
				?>
				<?php 
				$email=$_SESSION['email'];
				mysql_query("set @row:=0",$db);
				$query="select rank,email,points from(select @row:=@row+1 as rank,id,email,points from details order by points desc)as result 
				where email='{$email}'"; 
				$s=mysql_query($query,$db);
				$row=mysql_fetch_array($s);
				$rank=$row['rank'];
				$points=$row['points'];
				echo "<li class='profile'><span >Rank($points):$rank</span></li>
				</ul>";
				?>
			</div>
		</div>
	</div>
	
	<div id="my_network"><a href="mynetwork.php"><div align="center"></div></a></div>	

</aside>


<div id='outline'>		
<?php


echo"<div id='middle'>
	<div class='discuss_sub_heading'> Post </div>	
	
	<div id='doubt_wrap'> 
	<div id='college_share_wrap'>
		
	</div>
	</div>";
         	echo "<div id='waiting'><img src='images/waiting.gif' width='30' height='30'/></div>";
		 	require_once('functions/functions.php');
		 	$art=$_GET['art'];
            $query="select * from updateall where id='{$art}' ";
            $r=mysql_query($query);

            while($x=mysql_fetch_array($r)){
				
				$email=$_SESSION['email'];
				$values=get_info($email);
				$college=$values['college'];
				$d_college=$x['college'];
				$private=$x['private'];
				$details=nl2br(htmlspecialchars($x['details']));
				$details=similey($details);
				$text = $details;	
				$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";		
				if(preg_match($reg_exUrl, $text, $url)) {
		      		 $details=preg_replace($reg_exUrl, '<a href="'.$url[0].'" rel="nofollow" target="_blank">'.$url[0].'</a>', $text);
		
				} else {
		    		   $details=$text;
		
				}
				$topic=$x['topic'];
				$email=$x['email'];
				$recommended=$x['recommended'];
				$offensive=$x['offensive'];
				$path=$x['path'];
                		$id=$x['id'];
				$date=$x['time'];
				mysql_query("set @row:=0",$db);
				$query="select rank,email,points from(select @row:=@row+1 as rank,id,email,points from details order by points desc)as result 
				where email='{$email}'"; 
				$s=mysql_query($query,$db);
				$row=mysql_fetch_array($s);
				$rank=$row['rank'];
				$points=$row['points'];
				$values=get_info($email);
				$src=$values['path'];
				$upid=$values['id'];
				$name=$values['firstname'];
				$college=$values['college'];
				$email1=$_SESSION['email'];
				$user=get_info($email1);
				$userid=$user['id'];
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
				<input type='submit' class='subm button_submit' art_id='$art' email='$email' value='reply'>
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
        
    echo "</div>";
?>
</div>

<aside id="right">
        <ul id="sub">
            <h4>My Subscriptions</h4>
            <?php
				$email=$_SESSION['email'];
				$query="select subject,college from subscription where email='{$email}' ";
				$s=mysql_query($query,$db);
				while($row=mysql_fetch_array($s)){
					$sub=$row['subject'];
					$college=$row['college'];
					echo"<div class='sub_wrap'><li class='sub_name'><a href='' college='{$college}' subject='{$sub}' class='subscription'>
					{$sub},{$college}</a>
					<a href=''><img  college='{$college}' subject='{$sub}' src='images/close.png' width='15px' height='15px' class='del'>
					</a></li></div>";
				}
			?>
       <div class='sub_wrap'><div id='man'><a href='' id='manage'>manage subjects</a></div></div>
	 </ul>
</aside>
</div>




<footer id="footer"><div id='foot'>Copyright &copy 2012 students-network.com. All pages of the website are subject to our terms and condition and privacy policy.U must not reproduce, duplicate, sell, resell or exploit any material on the website for any commercial purpose without written permission from admin.</div></footer>
</div>
<script type='text/javascript' src='js/jquery.js'></script>       
<script type='text/javascript' src='js/index.js'></script>
<?php 	mysql_close($db); ?>
</body>
</html>