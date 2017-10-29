<?php
	
	$email=$_SESSION['email'];
	
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	$OptimizationSQL = "OPTIMIZE TABLE discuss";
        $rs2 = mysql_query($OptimizationSQL);
        $OptimizationSQL = "OPTIMIZE TABLE discuss_members";
        $rs2 = mysql_query($OptimizationSQL);
        $OptimizationSQL = "OPTIMIZE TABLE usersonline";
        $rs2 = mysql_query($OptimizationSQL);	
        $OptimizationSQL = "OPTIMIZE TABLE update_com";
        $rs2 = mysql_query($OptimizationSQL);
        $OptimizationSQL = "OPTIMIZE TABLE event";
        $rs2 = mysql_query($OptimizationSQL);		
?>
<?php
	 $topic=mysql_real_escape_string($_POST['topic']);
	$email=$_SESSION['email'];
	$time=time();
	$query="select topic from discuss";
	$r=mysql_query($query,$db);
	 while($x=mysql_fetch_array($r)){
	  $top=$x['topic'];
	 if($top==$topic) {  header("location:discussion.php"); exit(1); }
	 
	 }
	$query="insert into discuss(email,topic,time) value('{$email}','{$topic}','{$time}')";
	mysql_query($query,$db);
	$query="select id from discuss where topic='$topic'";
	$s=mysql_query($query,$db);
	$r=mysql_fetch_array($s);
	$dis_id=$r['id'];
	header("location:discuss.php?dis_id=$dis_id&topic=$topic");
	exit(1); 
	mysql_close($db);
?>