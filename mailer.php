<?php

$to  = 'hod.cse@rvce.edu.in'; 


$subject = 'Invitation';


$message = "
<html>
<head>
  <title>Students-Network</title>
</head>
<body>
  <div style='background-color:rgba(50,79,105,1);width:100%;height:50px;'>
  		<div align='center' style='color:#DBDBDB;font-size:25px;padding:10px 0 10px 0;font-style:oblique;'>Invitation from Students-Network.com</div>
  </div>
  <div style='background-color:rgba(23,53,79,1);color:#DBDBDB;padding:50px 50px 50px 50px;'>
  		<div style=''>Hello everyone. We're excited to bring you our online students portal, www.students-network.com.<br/>
        There are lot of features to explore like
        <ul>
            <li>Discussion Room</li>
            <li>Doubt Section</li>
            <li>Easy sharing learning material</li>
            <li>Friends Group</li> and more to come.
        </ul>
        Without users website can get success, so we request you to be part of our success by joining our website.
        We would love to hear any kind of feedback.<br/> 
       		<a href='http://www.students-network.com/signup.php' style='color:white;font-size:20px;font-style:italic; margin:40px 40px 40px 400px;'>Sign up for students-Network.com</a><br/>
        <div style='float:right;'>You may contact us at<br/>
        email:asachin96@yahoo.in<br/>
        ph-no:8892257027<br/></div>
        Looking forward to meet you @ Students-Network.com,<br/>
        Students-Network team  
        </div>      
  </div>
</body>
</html>
";


$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

if(mail($to, $subject, $message, $headers))
	echo "sent";
?> 