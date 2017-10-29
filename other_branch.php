<?php 
	session_start();
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
?>

<?php
$college=$_POST['college'];
$branch=$_POST['branch'];
echo "<ul id='sub'>
            <h3>$branch</h3>";
            
        
$query="select subject from branch_subject where college='$college' and branch='$branch'";
$s=mysql_query($query,$db);
while($row=mysql_fetch_array($s)){
	$subject=$row['subject'];
	  echo"<div class='sub_wrap'><li class='sub_name'><a href='' class='branch_sub1'  subject='$subject' college='$college'>$subject</a></li></div>";
}
echo"</ul>
        <div class='sub_wrap'><div><a href='branch.php?college=$college'>other branch</a></div></div>
        <div class='sub_wrap'><div><a href='other_college.php?college=$college'>back to your branch</a></div></div>";
?>
<?php mysql_close($db);?>
	