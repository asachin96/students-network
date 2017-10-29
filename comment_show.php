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
	$query="select * from comment where art_id='$art_id'";
	$d=mysql_query($query,$db);
	$i=1;
	while($row=mysql_fetch_array($d)){
		$email=$row['email'];
		$content=htmlspecialchars($row['comment']);
		$content=similey($content);
		$time=$row['time'];
		$values=get_info($email);
		$src=$values['path'];
		$firstname=$values['firstname'];
		$college=$values['college'];		
			if($i%2==0){
				echo"<div class='comment_left'><li>
					<div class='com_wrap_left'>
						<div class='com_img_left'><img src='$src' width='30' height='30'/></div>
						<div class='com_name_left'>$firstname,$college</div>
						<div class='com_time_left'>$time</div>
					</div>
					<div class='com_con_left'>$content</div>
				</li></div>";
			}
			else{
				echo"<div class='comment_right'><li>
					<div class='com_wrap_right'>
						<div class='com_img_right'><img src='$src' width='30' height='28'/></div>
						<div class='com_name_right'>$firstname,$college</div>
						<div class='com_time_right'>$time</div>
					</div>
					<div class='com_con_right'>$content</div>
				</li></div>";
			}
			$i++;
		echo "</div>";
	}

?>