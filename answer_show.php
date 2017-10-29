<?php 
session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
?>

<?php
	if(isset($_POST['art_id']))
	$art_id=$_POST['art_id'];
	else if(isset($_GET['art_id']))
	$art_id=$_GET['art_id'];
	require_once('functions/functions.php');
	$query="select * from answer where art_id='$art_id'";
	$d=mysql_query($query,$db);
	$i=1;
	while($row=mysql_fetch_array($d)){
		$email=$row['email'];
		$content=htmlspecialchars($row['answer']);
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
						<div class='com_img_left'><img src='$src' width='45' height='45' style='border:1px solid rgba(9,83,111,.5)'/></div>
						<div class='com_name_left1'>$firstname,$college</div>
						<div class='com_time_left1'>$time</div>
					</div>
					<div class='com_con_left1'>$content</div>
					
					 <div class='news_wrapper' >
					<div class='news_content1'>
						 <div class='news_buttons1'><a href='#' tbl='2' class='ans_recommended' article_id='$id' id='$userid' email='$email'> 
						 recommended($recommended)</a></div>
					</div>
				    </div>
					 
				</li></div>";
		echo "</div>";
	}

?>