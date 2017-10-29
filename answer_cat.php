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
        <input type='submit' value='start' class='button_submit'/>
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
	$query="select distinct email from discuss_members where discuss_id='$dis_id'";
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
			require_once('functions/functions.php');
			$cur_email=$_SESSION['email'];
			$branch=$_GET['branch'];
			$query="select * from branches where branch='{$branch}'";
			$ro=mysql_query($query,$db);
			$row=mysql_fetch_array($ro);
			$ex=$row['ex_branch'];
			echo"<div class='discuss_sub_heading'>$ex</div>";
        		$query="select * from doubt where sub_cat='$branch' order by id desc";
			$ro=mysql_query($query,$db);
			$k=1;
			while(($row=mysql_fetch_array($ro)) && ($k<=10)){
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
						<div class='com_name'><a href='other_student.php?email={$email}'>$name</a>
						<a href='other_college.php?college={$college}'>$college</a></div>
						<div class='com_time'>{$time}</div>
						<div class='com_con'>$topic</div>
						<a href='doubt_show.php?art_id=$art'><div class='discuss_image_wrap'>
							<div class='com_reply'>
								<img src='images/arrow.png' width='25' height='25'/>
							</div>
						</div></a>					</div>				
					<div class='reply_form{$id}' style='display:none'>
						<output id='comment$id'></output>
						<textarea id='area$id' class='comm' rows='2' cols='62'></textarea>
						<input type='submit' class='answer_submit' art_id='$art' email='$email' value='reply'>
					</div>
				";
							
			}
		?>
        <div class='page_link_wrap'>
        <?php
		$branch=$_GET['branch'];
		$total=0;
		$query="select id from doubt where sub_cat='$branch'";
		$s=mysql_query($query,$db);
		 $total=mysql_affected_rows();
		  if($total>10){
		echo "<div class='doubt_more_first' branch='$branch'  id='1'><a href='answer_cat.php?branch=$branch' class='pages_no'>first</a></div>";
			$n=$total/10;
			$n=ceil($n);
			$offset=2;
			if($n<=15){
				for($i=1;$i<=$n;$i++){  
					echo"<div class='doubt_more doubt$i' branch='$branch'  id='$i'><a href='' class='pages_no link$i'>$i</a></div>";
				}
			}
			else{
				for($i=1;$i<=$offset+1;$i++){  
					echo"<div class='doubt_more doubt$i' branch='$branch'  id='$i'><a href='' class='pages_no link$i'>$i</a></div>";
				}
	             echo"<div class='doubt_more'>....</div>";
				for($i=floor($n/2);$i<=floor($n/2)+$offset;$i++){  
					echo"<div class='doubt_more doubt$i' branch='$branch'  id='$i'><a href='' class='pages_no link$i'>$i</a></div>";
				}
	             echo"<div class='doubt_more'>....</div>";
				for($i=$n-$offset;$i<=$n;$i++){  
					echo"<div class='doubt_more doubt$i' branch='$branch'  id='$i'><a href='' class='pages_no link$i'>$i</a></div>";
				}
			}
		echo "<div class='doubt_more' branch='$branch'  id='$n'><a href='' class='pages_no'>last</a></div>";		 
		  }
		?>
       </div>

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