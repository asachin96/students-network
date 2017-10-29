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
        $query="select * from branches";
        $p=mysql_query($query,$db);
        while($r=mysql_fetch_array($p)){
            require_once("functions/functions.php");
            $email=$_SESSION['email'];
            $values=get_info($email);
            $urbranch=$values['branch'];
            $branch=$r['branch'];
            if($branch!=$urbranch){
			$query="select ex_branch from branches where branch='$branch'";
			$ro=mysql_query($query,$db);
			$ex_branch=mysql_fetch_array($ro);
			$ex_branch=$ex_branch['ex_branch'];
			echo"<div class='discuss_sub_heading'>
			<a href='answer_cat.php?branch=$branch'>$ex_branch</a>
			<a href='' p='$branch' class='doubt_expand'><img src='images/plus.png' class='plus_image p{$branch}'></a></div>";  
            $query="select * from doubt where sub_cat='$branch' ";
            $s=mysql_query($query,$db);
			$i=0;
            while($row=mysql_fetch_array($s)){
				if($i++==2)
					break;
           	    		$email=$row['email'];
				$id=$row['id'];
				$art=$id;
				$topic=htmlspecialchars($row['topic']);
				$time=$row['time'];
				$details=nl2br(htmlspecialchars($x['details']));
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
				echo"<div class='com_wrap $branch' style='display:none;'>
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
					</div>";			
            }
            echo "<br/>";
            }
                
        }
        ?>
    </div>
</div>
</div>

<footer id="footer"><div id='foot'>Copyright &copy 2012 students-network.com. All pages of the website are subject to our terms and condition and privacy policy.U must not reproduce, duplicate, sell, resell or exploit any material on the website for any commercial purpose without written permission from admin.</div></footer>
</div>
<script type='text/javascript' src='js/jquery.js'></script>       
<script type='text/javascript' src='js/index.js'></script>
<?php 	mysql_close($db); ?>
</body>
</html>