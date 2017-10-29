<?php
	$email=$_GET['email'];
	setcookie('condition',"email='{$email}'",time()+9999999);
	require_once('header.php');
	$_SESSION['val']=10;
?>
<div id='outline_wrapper'>

<aside id="left">

<div id="Profile">
    <div id="profile1">
        <div id="profile_top">
            <?php 
			$email=$_GET['email'];
			$query="select * from details where email='$email'";
			$row=mysql_query($query,$db);
			$values=mysql_fetch_array($row);
			$name=$values['firstname'];
			$lname=substr($values['lastname'],0,15);
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
      echo "<div id='profile_image'><img src='{$src}' height='63' width='70' id='pic' class='focus_img' ></div>";
	  if($email==$_SESSION['email'])
      	echo "<div id='profile_name' >$name<a href=''><div align='center' id='change_button'>change</div></a></div>";
	  else
	        echo "<div id='profile_name' >$name<div align='center'>$lname</div></div>";
			echo "</div>
        <div id='profile_bottom'>
		<ul>
            <li class='profile'><a href='other_college.php?college=$college' id='col'>$college</a></li>";
			?>
            <?php 
			$email=$_GET['email'];
			mysql_query("set @row:=0",$db);
			$query="select rank,email,points from(select @row:=@row+1 as rank,id,email,points from details order by points desc)as result where email='{$email}' order by id desc"; 
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
<?php
	$email=$_SESSION['email'];
	$email1=$_GET['email'];
	$query="select * from network where email='{$email}' and friend='{$email1}'";
	mysql_query($query,$db);
	if(mysql_affected_rows()==0)
echo "<div id='my_network' class='add_network sub_name' user='$email' network='$email1'><a href=''>add to my-network<div align='center'></div></a></div>";
	else
echo "<div id='my_network' class='add_network sub_name' user='$email' network='$email1'><a href=''><div align='center'></div></a></div>";
?>
<output class='result_suc'></output>
</aside>



<div id='outline'>
<?php
$email=$_GET['email'];
require_once("functions/functions.php");
$r=get_info($email);
$name=$r['firstname'];
echo"<div id='middle'><div class='discuss_sub_heading'>$name's posts</div> 
         	<div id='waiting'><img src='images/waiting.gif' width='30' height='30'/></div>";
		 	require_once('functions/functions.php');
            $query="select * from updateall where email='$email' and private='0' order by id desc";
            $r=mysql_query($query,$db);
			$i=0;
            while($x=mysql_fetch_array($r)){
		if($i==10){
			break;
		}
		$i++;
		$details=nl2br(htmlspecialchars($x['details']));
		$details=similey($details);
		$text = $details;	
		$reg_exUrl = "/(http|https|ftp|ftps)\:\/\/[a-zA-Z0-9\-\.]+\.[a-zA-Z]{2,3}(\/\S*)?/";		
		if(preg_match($reg_exUrl, $text, $url)) {
		       $details=preg_replace($reg_exUrl, '<a href="'.$url[0].'" rel="nofollow" target="_blank">'.$url[0].'</a>', $text);
		
		} else {
		       $details=$text;
		
		}
		$topic=htmlspecialchars($x['topic']);
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
		require_once("functions/functions.php");	
		$user=get_info($email1);
		$userid=$user['id'];
		$art=$id;
		 echo "<div class='news' i='$id' id='art$id'>
		<div class='news_top'>
			<div class='news_image' email='$email' >			
				<a href='other_student.php?email=$email' upid='$id' class='news_img' i='$id' email='$email' rank='$rank' points='$points'>
				<img src='{$src}' width='40' height='40'></a>
			</div>
			<div class='news_user'>
				<a href='other_student.php?email={$email}'>{$name}</a>,<a href='other_college.php?college={$college}'>{$college}</a>
				<div class='date'>$date</div>
			</div>
			</div>
			<div class='$id news_points'  style='display:none' >
				<div class='news_po' email='$email' i='$id' id='net$id'>
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
        
    echo "</div>";
?>
</div>

<aside id="right">
        <ul id="sub">
          
            <?php
		$email=$_GET['email'];
		require_once("functions/functions.php");
		$values=get_info($email);
		$name=$values['firstname'];
		echo "<h4> $name 's Subscriptions</h4>";
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
     
	 </ul>
</aside>
</div>
<footer id="footer"><div id='foot'>Copyright &copy 2012 students-network.com. All pages of the website are subject to our terms and condition and privacy policy.U must not reproduce, duplicate, sell, resell or exploit any material on the website for any commercial purpose without written permission from admin.</div></footer><script type='text/javascript' src='js/jquery.js'></script>       
<script type='text/javascript' src='js/index.js'></script>
</div>
<?php 	mysql_close($db); ?>
</body>
</html>