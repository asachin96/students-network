<?php 

$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
function get_info($email){
	$query="select * from details where email='$email'";
	$s=mysql_query($query);
	$row1=mysql_fetch_array($s);
	return($row1);
}
function get_type($pa){
	$temp=explode('/',$pa);
	$temp1=explode('.',$temp[1]);
	if(strlen($temp1[0])>40)
		$temp1[0]=substr($temp1[0],0,40).'....';
	switch($temp1[1]){
		case "jpg":
		case "JPG":
		case "png":
		case "PNG":
		case "jpeg":
		case "JPEG":
		case "BMP":
		case "bmp":
			$s="<div class='down_img '><img src='{$pa}' width='370' height='208' class='focus_image'/></div>";
			return $s;
			break;
		case "pdf":
		case "PDF":
			$s="<div class='down_sub'>Download: <img src='images/pdf.jpg' width='17' height='17'class='download_img'/><a href='{$pa}'> ".$temp1[0]."</a></div>";
			return $s;
			break;
		case "DOC":
		case "doc":
		case "DOCX":
		case "docx":
		case "txt":
		case "TXT":		
			$s="<div class='down_sub'>Download: <a href='{$pa}'> <img src='images/word.jpg' width='17' height='17' class='download_img'/>".$temp1[0]."</a></div>";
			return $s;
			break;
		case "ppt":
		case "PPT":
		case "pptx":
		case "PPTX":		
			$s="<div class='down_sub'>Download: <img src='images/ppt.jpg' width='17' height='17' class='download_img'/><a href='{$pa}'> ".$temp1[0]."</a></div>";
			return $s;
			break;
		default:
			$s="<div class='down_sub'>Download: <img src='images/defaulticon.jpg' width='17' height='17' class='download_img'/><a href='{$pa}'> ".$temp1[0]."</a></div>";
			return $s;
			break;
	}
}

function check_login(){
	$email=$_COOKIE['nm'];
	$query="optimise table online";
	mysql_query($query);
	$query="select password from details where email='{$email}'";
	$s=mysql_query($query);
	$row=mysql_fetch_array($s);
	$pass=$row['password'];
	$cook=$pass+$email;
	$cook=sha1($cook);
	if(isset($_COOKIE['ln'])){
		if($cook!=$_COOKIE['ln']){	
			header("location:login.php?redirect=".$_SERVER['REQUEST_URI']);
			exit;
		}
		else{	
			$_SESSION['email']=$email;
			$time=time();
			$ttime=$time-60*10;
			$query="delete from online where time < '{$ttime}'";
			mysql_query($query);
			$query="delete from online where email='{$email}'";
			mysql_query($query);
			$query="insert into online(email,time) values('{$email}','{$time}')";
			mysql_query($query);
		}
	}
	else{
		header("location:login.php?redirect=".$_SERVER['REQUEST_URI']);
			exit;
	}
}

function suggest(){
	$email2=$_SESSION['email'];
	echo "<div class='rank'>Recommended people</div><div id='rank_top'>
	<div id='rank_top'>";
	echo $query="select * from network where email='{$email2}'"; 
	$ss=mysql_query($query,$db);
	
	$i=0;
	while($row=mysql_fetch_array($ss)){
		$email1=$row['friend'];
		echo $email1;
		$query="select * from network where email='{$email}'"; 
		$s1=mysql_query($query,$db);
		while($row1=mysql_fetch_array($s1)){
			$email1=$row1['friend'];
			if(isset($array[$email1])){
				$array[$email1]++;
			}
			else{
				$array[$email1]=0;
			}
		}
		sort($array);
		foreach($array as $temp){
			if($i++==3){
				break;
			}
		}
	}
	
echo"</div></div>";
}

function similey($content){
	$smiley = array(':)',':D',':(');
    	$graph = array(' <img src="images/similey/happy.png" width="14" height="14" class="similey"/> ',
    	' <img src="images/similey/happy.png" width="14" height="14" class="similey"/> ', 
    	' <img src="images/similey/sad.png" width="14" height="14" class="similey"/> ');
    	return str_replace($smiley, $graph, $content);
}

function filter($content){
	$reg="/fuck|f\*\*k|ass|a\*\*|cock|c\*\*k|pussy|dick|d\*\*k|sample/i";
	if(preg_match($reg,$content))
		return TRUE;
	else
		return FALSE;
}
?>