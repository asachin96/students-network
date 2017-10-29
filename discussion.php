<?php
	require_once('header.php');
	$email=$_SESSION['email'];
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	$query="optimize table update_com ";
	mysql_query($query,$db);		
?>
<div id='outline_wrapper'>
<aside id="left">
 <div align="center">start a discussion</div>
    <form action="discuss_start.php" method='post'>
        <input type='text'  name='topic' id='discussion_input' maxlength="15">
        <input type='submit' value='start' class='button_submit discuss_start_button'/>
    </form>
    
<div align="center">recent discusssions</div>
<div class='sub_wrap'>
<?php
$time=time()-60*60*2;
$query="delete from discuss where time < '{$time}'";
mysql_query($query,$db);
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
	<div class='ask_doubt_wrap'><a href='' id='ask_doubt'>ask a doubt<img src='images/expand.png' width='14' height='14' id='doubt_img'/></a></div>
	<div id='doubt_wrap'> 
        <form action='doubt_process.php' enctype='multipart/form-data' method='post'>
            <label class='req'>topic:<input type='text' class='topic greytext' name='topic' maxlength='15'></label><br/>		
            <label class='req2'>choose category:
                <select id='main_cat' name='main_cat' class='cate greytext'>
                    <option  >select category</option>
                    <option>technical</option>
                    <option>general</option>
                </select>
            </label>
            <select id='sub_cat' style="width:110px;" name='sub_cat' class='greytext'>
                <option>subcategory</option>
            </select><br/>
            <label class='req1' >details:<br/><textarea  cols='89%' rows='4' name='details' maxlength='500' class='details greytext'></textarea></label><br/>
            <label>attachments(optional):<input type='file' name='file'/></label><br/>
            <input type='submit' class='share button_submit'/>
        </form>
    </div>
    <div id='doubt_main'>
     	<?php
			require_once('functions/functions.php');
			$cur_email=$_SESSION['email'];
			$values=get_info($email);
			$branch=$values['branch'];
			$query="select ex_branch from branches where branch='$branch'";
			$ro=mysql_query($query,$db);
			$ex_branch=mysql_fetch_array($ro);
			$ex_branch=$ex_branch['ex_branch'];
			echo"<div class='discuss_sub_heading'>
			<a href='answer_cat.php?branch=$branch'>$ex_branch
			<img src='images/plus.png' class='plus_image'></a></div>";
        	$query="select * from doubt where sub_cat='$branch' order by id desc";
			$ro=mysql_query($query,$db);
			$i=0;
			while($row=mysql_fetch_array($ro)){
				if($i++==3)
					break;
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
		?>
        <div class='discuss_sub_heading'><a href='other_doubt.php' id="other_doubt">check other branches</a>
        <img src='images/plus.png' class='plus_image'></div>
    	<div class='discuss_sub_heading'><a href='answer_cat.php?branch=general'>general</a>
        <img src='images/plus.png' class='plus_image'></div>
        	<?php
			require_once('functions/functions.php');
        	$query="select * from doubt where sub_cat='general' order by id desc";
			$ro=mysql_query($query,$db);
			$i=0;
			while($row=mysql_fetch_array($ro)){
				if($i++==3)
					break;
				$email=$row['email'];
				$topic=$row['topic'];
				$time=$row['time'];
				$id=$row['id'];
				$art=$id;
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
				$path=$values['path'];
				$name=$values['firstname'];
				$college=$values['college'];
								echo"<div class='com_wrap'>
						<div class='com_img'><img src='$path' width='45' height='45'/></div>
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
		?>

    </div>
</div>
</div>
<footer id="footer"><div id='foot'>Copyright &copy 2012 students-network.com. All pages of the website are subject to our terms and condition and privacy policy.U must not reproduce, duplicate, sell, resell or exploit any material on the website for any commercial purpose without written permission from admin.</div></footer>
</div>
<script type='text/javascript' src='js/jquery.js'></script>       
<script type='text/javascript' src='js/discuss.js'></script>
<?php 	mysql_close($db); ?>
</body>
</html>