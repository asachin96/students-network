<?php
	session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	require_once('functions/functions.php');
	$email=$_SESSION['email'];
	echo "<ul>
	<li class='events_heading'><h5 align='center'>Discussion Invitation</h5><li> ";
	$i=0;
	$time1=time();
	$ttime=$time1-60*60*24*10;
	$query="delete from event where time < '{$ttime}'";
	mysql_query($query,$db);
	$query="select * from event where type=1 and temail='{$email}' order by id desc ";
	$r=mysql_query($query,$db);
	while($row=mysql_fetch_array($r)) {
		if($i++==5) { break; }
		$friend=$row['femail'];
		$ref=$row['ref'];
		$time=$row['time'];
		$seen=$row['seen'];
		$top=explode('=',$ref);
		$topic=$top[1];
		$date=date('d/m/y h:i a',$time);;
		$value=get_info($friend);
		$name=$value['firstname'];
		$src=$value['path'];
		$query="select * from discuss where id='{$topic}' ";
		$f=mysql_query($query,$db);
		$s=mysql_fetch_array($f);
		$topi=$s['topic'];
		
		$ref=$ref."&topic=".$topi ;
		if(strlen($topi)>20) {
			$topi=substr($topi,0,17)."...";
		}
		echo "	<li class='events_event";
		if($seen==0)
			echo ' highlight';
		echo "' ref='{$ref}'><img src='{$src}' width='20' height='25' class='events_img'/>
		<div class='events_details'>$name invite you to discussion<br/>'$topic' at $date</div></li> "; 
	}				
	echo "<li class='events_heading'><h5 align='center'>Recommends</h5></li>";
	$i=0;
	$query="select * from event where temail='{$email}' and type=2 order by id desc";
	$r=mysql_query($query,$db);
	while($row=mysql_fetch_array($r)) {
		if($i++==5) { break; }
		$friend=$row['femail'];
		$ref=$row['ref'];
		$time=$row['time'];
		$seen=$row['seen'];
		$top=explode('=',$ref);
		$topic=$top[1];
		$date=date('d/m/y h:i a',$time);;
		$value=get_info($friend);
		$name=$value['firstname'];
		$src=$value['path'];
		$query="select * from updateall where id='{$topic}' ";
		$f=mysql_query($query,$db);
		$s=mysql_fetch_array($f);
		$topi=$s['topic'];
		if(strlen($topi)>20) {
			$topi=substr($topi,0,17)."...";
		}
		$email1=$s['email'];
		$val=get_info($email1);
		$name2=$val['firstname'];			
		echo "	<li class='events_event";
		if($seen==0)
			echo ' highlight';
		echo "' ref='{$ref}'><img src='{$src}' width='20' height='25' class='events_img'/>
		<div class='events_details'>$name recommended ";
		if($email1==$_SESSION['email'])
			echo "your";
		else
			echo $name2."'s";
		echo"  <br/>post &nbsp'$topi' </div></li>";
        }	
	echo "<li class='events_heading'><h5 align='center'>Networking</h5></li>";
	$i=0;
	$query="select * from event where type=3 and temail='{$email}' order by id desc ";
	$r=mysql_query($query,$db);
	while($row=mysql_fetch_array($r)) {
		if($i++==5) { break; }
		$friend=$row['femail'];
		$ref="other_student.php?email=". $friend ; 
		$time=$row['time'];
		$seen=$row['seen'];
		$date=date('d/m/y h:i a',$time);;
		$value=get_info($friend);
		$name=$value['firstname'];
		$src=$value['path'];
		echo "	<li class='events_event";
		if($seen==0)
			echo ' highlight';
		echo "' ref='{$ref}'><img src='$src' width='20' height='25' class='events_img'/>
		<div class='events_details'>$name added you to his/her<br/>network on $date</div></li>"; 
	}
	echo "<li class='events_heading'><h5 align='center'>Doubts</h5></li>";
	$i=0;
	 $query="select * from event where temail='{$email}' and type=5 order by id desc";
	$r=mysql_query($query,$db);
	while($row=mysql_fetch_array($r)) {
		if($i++==3) { break; }
		$friend=$row['femail'];
		$ref=$row['ref'];
		$time=$row['time'];
		$seen=$row['seen'];
		$top=explode('=',$ref);
		$topic=$top[1];
		$date=date('d/m/y h:i a',$time);
		$value=get_info($friend);
		$name=$value['firstname'];
		$src=$value['path'];
		$query="select * from doubt where id='{$topic}' ";
		$f=mysql_query($query,$db);
		$s=mysql_fetch_array($f);
		$topi=$s['topic'];
		if(strlen($topi)>20) {
			$topi=substr($topi,0,17)."...";
		}			
		echo "	<li class='events_event";
		if($seen==0)
			echo ' highlight';
		echo "' ref='{$ref}'><img src='{$src}' width='20' height='25' class='events_img'/>
		<div class='events_details'>$name has answered your<br/>doubt $topi </div></li>";
            }	
	 $i=0;
	$query="select * from event where temail='{$email}' and type=4 order by id desc";
	$r=mysql_query($query,$db);
	while($row=mysql_fetch_array($r)) {
		if($i++==3) { break; }
		$friend=$row['femail'];
		$ref=$row['ref'];
		$time=$row['time'];
		$seen=$row['seen'];
		$top=explode('=',$ref);
		$topic=$top[1];
		$date=date('d/m/y h:i a',$time);;
		$value=get_info($friend);
		$name=$value['firstname'];
		$src=$value['path'];
		$query="select * from doubt where id='{$topic}' ";
		$f=mysql_query($query,$db);
		$s=mysql_fetch_array($f);
		$topi=$s['topic'];
		if(strlen($topi)>20) {
			$topi=substr($topi,0,17)."...";
		}			
		
		echo "	<li class='events_event";
		if($seen==0)
			echo ' highlight';
		echo "' ref='{$ref}'><img src='{$src}' width='20' height='25' class='events_img'/>
		<div class='events_details'>$name has asked a doubt about $topi </div></li>";
            }	
            
          echo  "<li class='events_heading'><h5 align='center'>Comments</h5><li> ";
          $query="select * from event where type=6 and temail='{$email}' order by id desc ";
	$r=mysql_query($query,$db);
	while($row=mysql_fetch_array($r)) {
		if($i++==5) { break; }
		$friend=$row['femail'];
		$ref=$row['ref'];
		$time=$row['time'];
		$seen=$row['seen'];
		$top=explode('=',$ref);
		$topic=$top[1];
		$date=date('d/m/y h:i a',$time);;
		$value=get_info($friend);
		$name=$value['firstname'];
		$src=$value['path'];
		$query="select * from updateall where id='{$topic}' ";
		$f=mysql_query($query,$db);
		$s=mysql_fetch_array($f);
		$topi=$s['topic'];
		if(strlen($topi)>20) {
			$topi=substr($topi,0,17)."...";
		}			
		echo "	<li class='events_event";
		if($seen==0)
			echo ' highlight';
		echo "' ref='{$ref}'><img src='{$src}' width='20' height='25' class='events_img'/>
		<div class='events_details'>$name has commented on your<br/>post: '$topi'</div></li> "; 
	}				
        $query="update event set seen='1' where temail='{$email}' ";
	mysql_query($query,$db);    
	 echo "<ul> ";
?>