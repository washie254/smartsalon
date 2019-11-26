<?php 
include('server.php');
//session_start(); 

if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
	unset($_SESSION['username']);
	unset($_SESSION['id']);
	header("location: ../");
}
?>

<!DOCTYPE html>
<!--[if IE 8 ]><html class="ie ie8" lang="en"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--><html lang="en"> <!--<![endif]-->
<head>

<!-- Basic Page Needs
================================================== -->
<meta charset="utf-8">
<title>Smart Salon</title>

<!-- Mobile Specific Metas
================================================== -->
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

<!-- CSS
================================================== -->
<link rel="stylesheet" href="css/style.css">
<link rel="stylesheet" href="css/colors/green.css" id="colors">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script type="text/javascript" src="js/bootstrap.min.js"></script>

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body>
<div id="wrapper">


<!-- Header
================================================== -->
<header>
<div class="container">
	<div class="sixteen columns">
	
		<!-- Logo -->
		<div id="logo">
			<h1><a href="index.php"><img src="images/logo.png" alt="Work Scout" /></a></h1>
		</div>

		<!-- Menu -->
		<nav id="navigation" class="menu">
			<ul id="responsive">

				<li><a href="index.php">Home</a> </li>
				<li><a href="saloonists.php" id="current">saloonist</a></li>
				<li><a href="users.php">Users</a></li>
				<li><a href="reports.php">Reports</a></li>
				<!-- <li><a href="blog.html">Blog</a></li> -->
			</ul>

			<ul class="float-right">
				<li><a href="#"><?=$_SESSION["username"]?></a></li>
				<li><a href="index.php?logout='1'" style="color: red;">logout</a></li>
			</ul>

		</nav>

		<!-- Navigation -->
		<div id="mobile-navigation">
			<a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
		</div>

	</div>
</div>
</header>
<div class="clearfix"></div>


<section class="section intro">

	<div class="container">
		<div style="padding: 6px 12px; border: 1px solid #ccc;">
			QUICK LINKS:   
			<a href="#pending"><button type="button" class="btn btn-outline-secondary">Pending </button></a>
			<a href="#approved"><button type="button" class="btn btn-outline-secondary">Approved </button></a>
			<a href="#rejected"><button type="button" class="btn btn-outline-secondary">Rejected </button></a>
		</div>
	</div>
	<br>
	
	<div class="container" id="pending">
		<div style="padding: 6px 12px; border: 1px solid #ccc;">
			<h3>Applications</h3> 
			<p>The following are the accounts pending approval</p>  

			<table class="table table-bordered table-striped">
				<thead>
					<tr>
					<th scope="col">S.Id</th>
					<th scope="col">Username </th>
					<th scope="col">Names</th>
					<th scope="col">location</th>
					<th scope="col">Date Created</th>
					<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<!-- [ LOOP THE REGISTERED AGENTS ] -->
					<?php

					$sql = "SELECT * FROM salonist WHERE status='PENDING APPROVAL'";
					$result = mysqli_query($db, $sql);
					while($row = mysqli_fetch_array($result, MYSQLI_NUM))
					{	
					
						echo '<tr>';
							echo '<td>'.$row[0].'</td> '; // l ID 
							echo '<td>'.$row[1].'</td> '; //MEM ID
							echo '<td>'.$row[4].' '.$row[5].'</td> '; //MEM USERNAME
							echo '<td>'.$row[9].'<br>LatLng:'.$row[12].','.$row[13].'</td> '; //Amount
							echo '<td>'.$row[14].'</td> '; //DATE APPLIED
							echo '<td><a href="approves.php?id='.$row[0] .'"><button class="btn btn-success">APPROVE</button></a> 
									<a href="rejects.php?id=' . $row[0] . '"><button class="btn btn-danger">REJECT</button></a></td>'; //Purpose
						echo '</tr>';
					}
					?>
				</tbody>
			</table>

		</div>
	</div>

	<br>
	<div class="container" id="rejected">
		<div style="padding: 6px 12px; border: 1px solid #ccc;">
			<h3>Rejected Accounts</h3> 
			<p>Saloonists Whoes accounts have been rejaected</p>  

			<table class="table table-bordered table-striped">
				<thead>
					<tr>
					<th scope="col">S.Id</th>
					<th scope="col">Username </th>
					<th scope="col">Names</th>
					<th scope="col">location</th>
					<th scope="col">Date Created</th>
					<th scope="col">Action</th>
					</tr>
				</thead>
				<tbody>
					<!-- [ LOOP THE REGISTERED AGENTS ] -->
					<?php

					$sql = "SELECT * FROM salonist WHERE status='REJECTED'";
					$result = mysqli_query($db, $sql);
					while($row = mysqli_fetch_array($result, MYSQLI_NUM))
					{	
					
						echo '<tr>';
							echo '<td>'.$row[0].'</td> '; // l ID 
							echo '<td>'.$row[1].'</td> '; //MEM ID
							echo '<td>'.$row[4].' '.$row[5].'</td> '; //MEM USERNAME
							echo '<td>'.$row[9].'<br>LatLng:'.$row[12].','.$row[13].'</td> '; //Amount
							echo '<td>'.$row[14].'</td> '; //DATE APPLIED
							echo '<td><a href="approves.php?id=' . $row[0] . '"><button class="btn btn-success">APPROVE</button></a> 
							</td>'; //Purpose
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
		</div>
	</div>

	<br>
	<div class="container" id="approved">
		<div style="padding: 6px 12px; border: 1px solid #ccc;">
			<h3>Approved Saloonist Accounts</h3> 
			<p> The Following are the Approved accounts </p>  
		</div>
		<table class="table table-bordered table-striped">
				<thead>
					<tr>
					<th scope="col">S.Id</th>
					<th scope="col">Username </th>
					<th scope="col">Names</th>
					<th scope="col">location</th>
					<th scope="col">Date Created</th>
					<!-- <th scope="col">Action</th> -->
					</tr>
				</thead>
				<tbody>
					<!-- [ LOOP THE REGISTERED AGENTS ] -->
					<?php

					$sql = "SELECT * FROM salonist WHERE status='APPROVED'";
					$result = mysqli_query($db, $sql);
					while($row = mysqli_fetch_array($result, MYSQLI_NUM))
					{	
					
						echo '<tr>';
							echo '<td>'.$row[0].'</td> '; // l ID 
							echo '<td>'.$row[1].'</td> '; //MEM ID
							echo '<td>'.$row[4].' '.$row[5].'</td> '; //MEM USERNAME
							echo '<td>'.$row[9].'<br>LatLng:'.$row[12].','.$row[13].'</td> '; //Amount
							echo '<td>'.$row[14].'</td> '; //DATE APPLIED
							//echo '<td><a href="rejects.php?id=' . $row[0] . '"><button class="btn btn-danger">REJECT</button></a></td>'; //Purpose
						echo '</tr>';
					}
					?>
				</tbody>
			</table>
	</div>

</section>
<br>
<div class="clearfix"></div>
<!-- Infobox -->
<div class="infobox">
	<div class="container">
		<div class="sixteen columns">Smartr Salon Dashboard <a href="#">ADMIN</a></div>
	</div>
</div>



<!-- Footer
================================================== -->
<!-- <div class="margin-top-15"></div> -->

<div id="footer">
	<!-- Main -->
	<div class="container">

		<div class="seven columns">
			<h4>About</h4>
			<p>Smart salon is a web appplication that assists to bridge a gap between the saloonist in a given location 
				and the prospective clients.</p>
			<a href="#" class="button">Get Started</a>
		</div>

		<div class="three columns">
			<h4>Company</h4>
			<ul class="footer-links">
				<li><a href="users.php">users</a></li>
				<li><a href="saloonists.php">saloonists</a></li>
				<li><a href="index.php">Home</a></li>
			</ul>
		</div>
		
		<div class="three columns">
			<h4>Press</h4>
			<ul class="footer-links">
				<li><a href="#">In the News</a></li>
				<li><a href="#">Press Releases</a></li>
				<li><a href="#">Awards</a></li>
				<li><a href="#">Testimonials</a></li>
				<li><a href="#">Timeline</a></li>
			</ul>
		</div>		

		<div class="three columns">
			<h4>Some other Info</h4>
			<ul class="footer-links">
				<li><a href="#">Kenya's Finest</a></li>
				<li><a href="#">More Systems by Me</a></li>

			</ul>
		</div>

	</div>

	<!-- Bottom -->
	<div class="container">
		<div class="footer-bottom">
			<div class="sixteen columns">
				<h4>Follow Us</h4>
				<ul class="social-icons">
					<li><a class="facebook" href="#"><i class="icon-facebook"></i></a></li>
					<li><a class="twitter" href="#"><i class="icon-twitter"></i></a></li>
					<li><a class="gplus" href="#"><i class="icon-gplus"></i></a></li>
					<li><a class="linkedin" href="#"><i class="icon-linkedin"></i></a></li>
				</ul>
				<div class="copyrights">©  Copyright 2019 by <a href="#">Washington</a>. All Rights Reserved.</div>
			</div>
		</div>
	</div>

</div>

<!-- Back To Top Button -->
<div id="backtotop"><a href="#"></a></div>

</div>
<!-- Wrapper / End -->


<!-- Scripts
================================================== -->
<script src="scripts/jquery-2.1.3.min.js"></script>
<script src="scripts/custom.js"></script>
<script src="scripts/jquery.superfish.js"></script>
<script src="scripts/jquery.themepunch.tools.min.js"></script>
<script src="scripts/jquery.themepunch.revolution.min.js"></script>
<script src="scripts/jquery.themepunch.showbizpro.min.js"></script>
<script src="scripts/jquery.flexslider-min.js"></script>
<script src="scripts/chosen.jquery.min.js"></script>
<script src="scripts/jquery.magnific-popup.min.js"></script>
<script src="scripts/waypoints.min.js"></script>
<script src="scripts/jquery.counterup.min.js"></script>
<script src="scripts/jquery.jpanelmenu.js"></script>
<script src="scripts/stacktable.js"></script>



</body>
</html>