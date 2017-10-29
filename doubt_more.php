<?php 
	session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
?>
<?php
require_once("functions/functions.php");
$email=$_SESSION['email'];
$values=get_info($email);
$branch=$_POST['branch'];
$page=$_POST['page']-1;
$page=$page*10;
echo"<div class='discuss_sub_heading'>$branch</div>";
$query="select * from doubt where sub_cat='$branch' order by id desc";
$s=mysql_query($query,$db);
for($i=1;$i<=$page;$i++)
  $row=mysql_fetch_array($s);
  
  $j=1;
  while( ($row=mysql_fetch_array($s)) && ($j<=10) )
  {
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
				$j++;			
  }
?>
  <div class='page_link_wrap'>
	 <?php
        $branch=$_POST['branch'];
        $total=0;
        $page=$_POST['page'];
        $query="select id from doubt where sub_cat='$branch'";
        echo "<div class='doubt_more_first' branch='$branch'  id='1'><a href='answer_cat.php?branch=$branch' class='pages_no'>first</a></div>";
        $s=mysql_query($query,$db);
        while($r=mysql_fetch_array($s))
        $total++;
        $n=$total/10;
        $n=ceil($n);
		$offset=3;
		if($n>=15){
			if($page<=$offset){
				for($i=1;$i<=$offset+2;$i++){  
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
			else if($page<=($n-$offset-2)){
				for($i=$page-$offset;$i<=$page+$offset;$i++){  
					echo"<div class='doubt_more doubt$i' branch='$branch'  id='$i'><a href='' class='pages_no link$i'>$i</a></div>";
				}
				echo"<div class='doubt_more'>....</div>";
					for($i=$n-$offset;$i<=$n;$i++){  
						echo"<div class='doubt_more doubt$i' branch='$branch'  id='$i'><a href='' class='pages_no link$i'>$i</a></div>";
				}
			}
			else{
				for($i=1;$i<=$offset;$i++){  
						echo"<div class='doubt_more doubt$i' branch='$branch'  id='$i'><a href='' class='pages_no link$i'>$i</a></div>";
				 }
				echo"<div class='doubt_more'>....</div>";
				for($i=$page-4;$i<=$n;$i++){  
						echo"<div class='doubt_more doubt$i' branch='$branch'  id='$i'><a href='' class='pages_no link$i'>$i</a></div>";
				}			
			}
		}
		else{
			for($i=1;$i<=$n;$i++){  
						echo"<div class='doubt_more doubt$i' branch='$branch'  id='$i'><a href='' class='pages_no link$i'>$i</a></div>";
				 }		
		}
			echo "<div class='doubt_more' branch='$branch'  id='$n'><a href='' class='pages_no'>last</a></div>";		 
    
    ?>
</div>
<?php mysql_close($db);?>
       