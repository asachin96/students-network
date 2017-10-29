<?php
session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
?>

<?php
	require_once("functions/functions.php");
	$user=$_SESSION['email'];
	$network=$_POST['email'];
	$value=get_info($network);
	$path=$value['path'];
	$points=$_POST['points'];
	$rank=$_POST['rank'];
	$fname=$value['firstname'];
	$lname=$value['lastname'];
	$branch=$value['branch'];
	$college=$value['college'];
	echo "<div class='expand_wrap'>	
		<img src='{$path}' width='50' height='50' class='expand_img'/>
		<div class='expand_fname'>$fname</div>
		<div class='expand_lname'>$lname</div>
		<div class='expand_col'>$branch,$college</div>
		<div class='expand_rank'>rank(".$rank."), points(".$points.")</div>
	</div>";
	$query="select id from network where email='$user' and friend='$network'";
	mysql_query($query,$db);
	if(mysql_affected_rows()){
		echo "<div  style='position:relative;top:7px'>In Your Network</div>";
	}
	else{
		echo "<div class='add_network1' email='{$network}' style='position:relative;top:7px'><a href='' >Add To My Network</a></div>";
	}
?>