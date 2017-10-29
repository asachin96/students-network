<?php		
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	require_once('header.php');
	$_SESSION['val']=0;
?>
<div id='outline_wrapper'>
<aside id="left">

<div id="Profile">
    <div id="profile1">
        <div id="profile_top">
            <?php 
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
                	name <input type='text' value='{$name}' id='profile_text' name='name'/>
                	image<input type='file' name='image' id='profile_img'/>
                    <input type='submit' value='save' id='change_save'/>
					<div id='change_upload'>uploading...</div>
                </form>
            </div>";		
      echo "<div id='profile_image'><a href=''><img src='{$src}' height='63' width='70' id='pic' ></a></div>
            <div id='profile_name' >$name<a href=''><div align='center' id='change_button'>change</div></a></div>
        </div>
        <div id='profile_bottom'>
		<ul>
            <li class='profile'><a href='college.php' id='col'>$college</a></li>";
	?>
        </div>
    </div>
</div>


</aside>


<div id='outline'>
<?php
	echo"<div id='middle'><div class='discuss_sub_heading'> My Network </div>";
			 $email1=$_SESSION['email'];         
				require_once('functions/functions.php');
		$query="select * from updateall  order by id desc";
		$r=mysql_query($query,$db);
		$i=0; 
		$j=0;
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
	        	$path=$x['path'];
			$date=$x['time'];						
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
					if($i==10){
					goto t;
				}
			$i++;
       echo "<div class='news' i='$id' id='art$id'>
				<div class='news_top'>
					<div class='news_image'>			
						<a href='' upid='$id' class='news_img'><img src='{$src}' width='40' height='40'></a>
					</div>
					<div class='news_user'>
						<a href='other_student.php?email={$email}'>{$name}</a>,<a href='other_college.php?college={$college}'>{$college}</a>
						<div class='date'>$date</div>
					</div>
					
					<div class='$id news_points' style='display:none'>
						<div class='news_po'>
							<span>rank($rank)<br/>points($points)</span>
						</div>
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
					 echo"
					</div>
				</div>
        	</div >";

						}
				}
		}
t:
echo "</div>";
?>
</div>

<aside id="right">
     <?php
require_once("functions/functions.php");
    echo"   <ul id='sub'>
            <h4>My Network</h4>";
	$email=$_SESSION['email'];
	$query="select friend from network where email='{$email}' order by friend";
	$s=mysql_query($query,$db);
	if(mysql_affected_rows()==0){
		echo "No one in your network";
	}
	else{
		while($row=mysql_fetch_array($s)){
			$friend=$row['friend'];
			$values=get_info($friend);
			$network_email=$values['email'];
			$name=$values['firstname'];
			$src=$values['path'];
			$college=$values['college'];
			echo"<div class='net_wrap'><li class='net_image_name'><img src='{$src}' width='30' height='28' class='network_image'/>
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a href='' class='network_name' email='{$network_email}'>{$name},{$college}</a></li>
			<a href=''><img email='{$friend}' src='images/close.png' width='15px' height='15px' class='del_net'></a></div>";
		}
	}
		echo"</ul>
        <div class='sub_wrap'><div id='man'><a href='#' id='my_net' >manage myNetworks</a></div></div>";
?>
 </aside>
</div>
<footer id="footer"><div id='foot'>Copyright &copy 2012 students-network.com. All pages of the website are subject to our terms and condition and privacy policy.U must not reproduce, duplicate, sell, resell or exploit any material on the website for any commercial purpose without written permission from admin.</div></footer></div>
</body>
</div>
<script type='text/javascript' src='js/jquery.js'></script>       
	<script type='text/javascript' src='js/network.js'></script>
    <?php mysql_close($db);
    ?>
</html>