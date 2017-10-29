<?php 
	session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
?>
<?php
$time=time();
$tt=$time-7200;
$query="delete from event where type=1 and time<$tt";
mysql_query($query,$db);
$query="select id,time from discuss";
$p=mysql_query($query,$db);
while($q=mysql_fetch_array($p)){
	$id=$q['id'];
	$time1=$q['time'];
	$query="select time from discuss_members where discuss_id='$id'";
	mysql_query($query,$db);
	if(!mysql_affected_rows()){
			if(($time-$time1)>60*60*2){
			$query="delete from discuss where id='$id'";
			mysql_query($query,$db);
			}
		}
	
	
}
?>
<?php
$time=time();
$query="select time,discuss_id from discuss_members";
$r=mysql_query($query,$db);
while($row=mysql_fetch_array($r)){
	$time1=$row['time'];
	$dis_id=$row['discuss_id'];
	if(($time-$time1)>7200){
	$query="delete from discuss where id='$dis_id'";
	mysql_query($query,$db);
	$query="delete from discuss_members where discuss_id='$dis_id'";
	mysql_query($query,$db);	
	}
}
 
?>