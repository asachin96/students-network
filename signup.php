<?php
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);
	if(isset($_POST['submit'])){
		$fname=strtolower($_POST['fname']);
		$sname=strtolower($_POST['sname']);
		$college=strtolower($_POST['college']);
		$branch=strtolower($_POST['branch']);
		$email=$_POST['email'];
		if($_POST['lecture']==TRUE)
			$lec=1;
		else
			$lec=0;
		$q=strtolower($_POST['question']);
		$ans=strtolower($_POST['answer']);
		$password=sha1($_POST['password']);
		if(($fname=='')|($college=='')|($branch=='')|($email=='')|($q=='')|($ans=='')|($password=='')|($college=='select your college')|($branch=='select your branch')){
		header("location:signup.php");
		exit();
		}
		$query="insert into details(firstname,lastname,email,branch,college,password,path,question,answer,lecture)							   		
		value('{$fname}','{$sname}','{$email}','{$branch}','{$college}','{$password}','images/default.jpg','{$q}','{$ans}',$lec)";
		$row=mysql_query($query,$db);
		header("location:login.php");
		exit();
	}
?>
<!doctype html>
<html>
<head>
	<meta charset="utf-8">
	<title>signup</title>
    <link rel="shortcut icon" href="images/logo.png">
    <link rel="stylesheet" href="css/signup.css" />
	<link href='http://fonts.googleapis.com/css?family=Pinyon+Script' rel='stylesheet' type='text/css'>    
	<link href='http://fonts.googleapis.com/css?family=Condiment' rel='stylesheet' type='text/css'>  
</head>

<body>
<div class='full_wrap'>
	<div class='signup_left'>
    <div class='signup_heading'>sign up</div>
        <div class='signup_wrap'>
            <form action='signup.php' method='post'>
                 <div class='signip_subwrap'><div class='signup_name'>first name:</div><label><input type='text' id='name' maxlength='11' name="fname"><div id='name1'></div><br/></label></div>
                 <div class='signip_subwrap'><div class='signup_name'>last name:</div><label><input type='text' name="sname"><br/></label></div>
                 <div class='signip_subwrap'><div class='signup_name'>college:</div><label><select id='college' name="college" >
											                																	<?php 
echo "<option >select your college</option>";												                																	$query="select * from colleges order by college";
																																		$ro=mysql_query($query,$db);
																																		while($row=mysql_fetch_array($ro)){
																																			$college=$row['college'];
$college1=$row['college_ex'];																																			
																																			$place=$row['place'];																							
																																		echo "<option value='$college'>$college1,$place</option>";		
																																}?>	 
		                 																	 <div id="college1"></div><br/></select><a href='' class='bug'>request here for new college</a></label></div>
		                 																	 <div class='feed'>
  <div class='feedback' style="display:none">
    <textarea id='area' rows="1"; cols="10" value='college name'></textarea>
    <input type='submit' value='col name' page=<?php echo $_SERVER['REQUEST_URI'];?> class='bug_class button_submit'  />
  </div>
</div>
                 <div class='signip_subwrap'><div class='signup_name'>branch:</div><label><select id='branch' name="branch">
 

                 <?php
                  echo "<option value='$option'>select your branch</option>"; 
                 $query="select * from branches order by branch";
																						$ro=mysql_query($query,$db);
																						while($row=mysql_fetch_array($ro)){
																							$option=$row['branch'];
																							$option1=$row['ex_branch'];
																						echo "<option value='$option'>$option1</option>";
																					} ?>
                 																		<div id="branch1"> </div><br/></select></label></div>
                 <div class='signip_subwrap'><div class='signup_name'>Lecturer:</div><label><input type='checkbox' id='lecture' name="lecture">
                 <br/></label></div>																	
                 <div class='signip_subwrap'><div class='signup_name'>valid email-address:</div><label><input type='email' id='email' name="email">
                 <div id="email1"></div><br/></label></div>
                 <div class='signip_subwrap'><div class='signup_name'>password:</div><label><input type='password' id='password' name="password"> 
                 <div id="password1"></div><br/></label></div>
                 <div class='signip_subwrap'><div class='signup_name'>re-enter password:</div><label><input type='password' id='repassword' name="password">
                 <div id="repassword1"></div><br/></label></div>
                 <div class='signip_subwrap'><div class='signup_name'>password reset question:</div>
                 <label><input type='text' id='ques' name='question'><div id="ques1"></div><br/></label></div>
                 <div class='signip_subwrap'><div class='signup_name'>your answer:</div>
                 <label><input type='text' id='answer' name='answer'><div id="answer1"></div><br/></label></div>
                 <div class='signip_subwrap confirm_code' style="display:none">
                 <div class='signup_name'>enter the code sent your mail:</div>
                 <label><input type='text' class='code'><div id="code"></div><br/></label></div>
                 <div class='signup_last'>by clicking signup i agree all terms and conditions<input type='submit' id="signup_submit" class='button_submit'name="submit" value="signup"></div>
                 <div class='signup_last' id='resnd'>did not got mail? click here to resend
                 <input type='submit' id="resend" class='button_submit' name="submit" value="resend"></div>
            </form>
        </div>
    </div>
    <div class='signup_right'>
    	<div class='terms_wrap'>
        	<div class='heading' align="center">terms and conditions</div>
            <ul class='terms_list'>
                <li>Before sharing content on students-network, please be sure you have the right to do so. We ask that you respect copyrights, trademarks, and other legal rights.</li><br/>
                <li>It is a serious violation to attack a person based on their race, ethnicity, national origin, religion, sex, gender, sexual orientation, disability or medical condition.</li><br/>
                <li>You own all of the content and information you post on students-network, and you can control how it is shared through.</li><br/>
                <li>We respect other people's rights, and expect you to do the same.</li><br/>
                <li>students-network users provide their real names and information, and we need your help to keep it that way.</li><br/>
                <li>students-network users should not share the copyrighted material and user will be held responsible, if he break copyright infringement.</li>
            </ul>
        </div>
        <a href='index.php'><div class='logo_down'><span class='logo_first'>students</span><img src='images/rotating.gif'/><span class='logo_last'>network</span></a></div>
    </div>
</div>

<script type='text/javascript' src='js/jquery.js'></script>       
<script type='text/javascript' src='js/signup.js'></script>
</body>

</html>