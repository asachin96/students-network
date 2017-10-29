<?php
	if(!isset($_GET['dis_id'])||!isset($_GET['topic'])){
		header('location:discussion.php');
		exit;
	}
	ini_set('error_reporting','On');
	$email=$_SESSION['email'];
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);		
	require_once('header.php');
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
			$count=mysql_affected_rows();
			 echo "<div class='sub_name' align='center'><a href='discuss.php?dis_id={$dis_id}&topic={$topic}'>$topic($count)</a></div>"; 
		}
    ?>
    </div>

</aside>
<div id='middle'>
    
    <?php
		$topic=$_GET['topic'];
		$dis_id=$_GET['dis_id'];
		echo "<div class='discuss_sub_heading'>$topic</div><div id='mid_wrap'>";
		require_once("functions/functions.php");
		$query="select * from discuss_members where discuss_id='$dis_id'";
		$s=mysql_query($query,$db);
		while($row=mysql_fetch_array($s)){
			$email=$row['email'];
			$comment=htmlspecialchars($row['comment']);
			$comment=similey($comment);
			$time=$row['time'];
			$values=get_info($email);
			$firstname=$values['firstname'];
			$college=$values['college'];
			$src=$values['path'];
			echo"<div class='discuss_wrap'>
			<div class='discuss_img'><img src='$src' width='30' height='30' /></div>
			<div class='discuss_name'>$firstname</div>
			<div class='discuss_college'>$college</div>
			<div class='discuss_comment'>$comment</div>
			</div>";
		}
    ?>
    </div>
<form>
	<input type='text' height='2em' class='dis_comment' maxlength="73">  
    <input type='submit' dis_id=<?php echo "{$_GET['dis_id']}"; ?> class='dis_submit button_submit' >
</form>
</div>
<aside id="right">
    <h4>Online</h4>
    <div class='online_wrap'>
    <?php
        $dis_id=$_GET['dis_id'];
        echo"<div id='online_users' p='$dis_id'><br/>No one in discussion</div>";
    ?>
    </div>
    <br/>
    <h4>Invite Network</h4>
    <div class='invitation_wrap'>
    <div id='online_users' class='onlin'><br/>No one to invite</div>
    <div class='invitation_wrap'>
</aside>
</div>
<footer id="footer"><div id='foot'>Copyright &copy 2012 students-network.com. All pages of the website are subject to our terms and condition and privacy policy.U must not reproduce, duplicate, sell, resell or exploit any material on the website for any commercial purpose without written permission from admin.</div></footer>
</div>
<script type='text/javascript' src='js/jquery.js'></script>       
<script type='text/javascript' src='js/discuss.js'></script>       
<?php 	mysql_close($db); ?>
</body>
</html>