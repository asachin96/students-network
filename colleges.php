<?php
	require_once('header.php');
	$email=$_SESSION['email'];
	$db=mysql_connect('localhost','students_sachin','!sn;2614');
	mysql_select_db('students_network',$db);		
?>
<div id='outline_wrapper'>
<aside id="left">
	<div class='colleges_heading' align='center'>
		colleges
	</div>
	<div class='colleges_links_wrap'>
		<div class='colleges_links'><a href='colleges.php?select=a'>A</a></div>
		<div class='colleges_links'><a href='colleges.php?select=b'>B</a></div>
		<div class='colleges_links'><a href='colleges.php?select=c'>C</a></div>
		<div class='colleges_links'><a href='colleges.php?select=d'>D</a></div>
		<div class='colleges_links'><a href='colleges.php?select=e'>E</a></div>
		<div class='colleges_links'><a href='colleges.php?select=f'>F</a></div>
		<div class='colleges_links'><a href='colleges.php?select=g'>G</a></div>
		<div class='colleges_links'><a href='colleges.php?select=h'>H</a></div>
		<div class='colleges_links'><a href='colleges.php?select=i'>I</a></div>
		<div class='colleges_links'><a href='colleges.php?select=j'>J</a></div>
		<div class='colleges_links'><a href='colleges.php?select=k'>K</a></div>
		<div class='colleges_links'><a href='colleges.php?select=l'>L</a></div>
		<div class='colleges_links'><a href='colleges.php?select=m'>M</a></div>
		<div class='colleges_links'><a href='colleges.php?select=n'>N</a></div>
		<div class='colleges_links'><a href='colleges.php?select=o'>O</a></div>
		<div class='colleges_links'><a href='colleges.php?select=p'>P</a></div>
		<div class='colleges_links'><a href='colleges.php?select=q'>Q</a></div>
		<div class='colleges_links'><a href='colleges.php?select=r'>R</a></div>
		<div class='colleges_links'><a href='colleges.php?select=s'>S</a></div>
		<div class='colleges_links'><a href='colleges.php?select=t'>T</a></div>
		<div class='colleges_links'><a href='colleges.php?select=u'>U</a></div>
		<div class='colleges_links'><a href='colleges.php?select=v'>V</a></div>
		<div class='colleges_links'><a href='colleges.php?select=w'>W</a></div>
		<div class='colleges_links'><a href='colleges.php?select=x'>X</a></div>
		<div class='colleges_links'><a href='colleges.php?select=y'>Y</a></div>
		<div class='colleges_links'><a href='colleges.php?select=z'>Z</a></div>
	</div>
</aside>
<div id='middle2'>
	<?php
		if($_GET['select']){
			$select=$_GET['select'];
			echo "<div class='goal'>colleges starting with ".$select."</div>";
			$query="select * from colleges where college like '$select%' order by college";
			$ro=mysql_query($query,$db);
			$count=mysql_affected_rows();
			if($count!=0){
				while($row=mysql_fetch_array($ro)){
					$college=$row['college'];
					$path=$row['logo'];
					$place=$row['place'];
					echo "<a href='colleges.php?co_select={$college}'><div class='colleges_results'>
						<div class='colleges_img'><img src='{$path}' width='89' height='50'/></div>
						<div class='colleges_name' align='center'>$college,$place</div>
					</div></a>";
				}
			}
			else
				echo "no colleges found";
		}
		if($_GET['co_select']){
			$co_select=$_GET['co_select'];
			$query="select * from colleges where match(college) against('$co_select' in boolean mode)";
			$ro=mysql_query($query,$db);
			$row=mysql_fetch_array($ro);
			$college=$row['college'];
			$ex_college=$row['college_ex'];
			$path=$row['path'];
			$address=$row['address'];
			$address1=nl2br($address);
			$description=$row['description'];
			$description=nl2br($description);
			$website=$row['official_website'];
			$website="http://".$website;
			$place=$row['place'];
			echo "<div class='goal'>".$ex_college.",(<span id='tr'>".$college."</span>),".$place."</div>";
			echo "<a href='other_college.php?college=$college'><div class='panel'>posts</div></a>";
			echo "<div class='ex_colleges_img' align='center'><img src='$path' width='784' height='350'/></div>";			
			echo "<div class='colleges_description'><h3>Details</h3>{$description}</div>";
			echo "<div class='colleges_website'><h3>Website</h3><a href='{$website}'>{$website}</a></div>";	
			echo "<div class='colleges_add'><h3>Contact info</h3>{$address1}</div>";
		}
	?>
</div>
<footer id="footer"><div id='foot'>Copyright &copy 2012 students-network.com. All pages of the website are subject to our terms and condition and privacy policy.U must not reproduce, duplicate, sell, resell or exploit any material on the website for any commercial purpose without written permission from admin.</div></footer>
</div>
<script type='text/javascript' src='js/jquery.js'></script>       
<script type='text/javascript' src='js/discuss.js'></script>
<?php 	mysql_close($db); ?>
</body>
</html>