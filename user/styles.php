<?php 
include('server.php');	
//session_start(); 
  

// if (!isset($_SESSION['username'])) {
// 	$_SESSION['msg'] = "You must log in first";
// 	header('location: login.php');
// }

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
				<li><a href="salonist.php">Salonists</a></li>
				<li><a href="styles.php" id="current">styles</a></li>
				<li><a href="account.php">Account</a> </li>
				<li><a href="reports.php" >Reports</a></li>
				<!-- <li><a href="blog.html">Blog</a></li> -->
			</ul>

			<!-- <ul class="float-right">
				<li><a href="#"><?=$_SESSION["username"]?></a></li>
				<li><a href="index.php?logout='1'" style="color: red;">logout</a></li>
			</ul> -->

		</nav>

		<!-- Navigation -->
		<div id="mobile-navigation">
			<a href="#menu" class="menu-trigger"><i class="fa fa-reorder"></i> Menu</a>
		</div>

	</div>
</div>
</header>
<div class="clearfix"></div>

<!-- card stykes -->
<style>
	.w-20 {
	-webkit-box-flex: 0;
	-ms-flex: 0 0 20%;
	flex: 0 0 20%;
	max-width: 20%;
	}

	@media (min-width: 576px) {
	.w-sm-20 {
		-webkit-box-flex: 0;
		-ms-flex: 0 0 20%;
		flex: 0 0 20%;
		max-width: 20%;
	}
	}

	@media (min-width: 768px) {
	.w-md-20 {
		-webkit-box-flex: 0;
		-ms-flex: 0 0 20%;
		flex: 0 0 20%;
		max-width: 20%;
	}
	}

	@media (min-width: 992px) {
	.w-lg-20 {
		-webkit-box-flex: 0;
		-ms-flex: 0 0 20%;
		flex: 0 0 20%;
		max-width: 20%;
	}
	}

	@media (min-width: 1200px) {
	.w-xl-20 {
		-webkit-box-flex: 0;
		-ms-flex: 0 0 20%;
		flex: 0 0 20%;
		max-width: 20%;
	}
	}
</style>
<section class="section intro">

	<div class="container" id="approved">
		<div style="padding: 6px 12px; border: 1px solid #ccc;">
			<h3>Styles Available</h3> 
			<p> We can add styles we offer here </p>  
		

			<?php 
			//$user = $_SESSION['username'];
			  $query0 = "SELECT * FROM styles ";
			  $result0 = mysqli_query($db, $query0);
			  
			  $count=1;
			  echo '<div class="card-group">';
			  while($row = mysqli_fetch_array($result0, MYSQLI_NUM)){

					echo '
					<div class="col s12 m7">
						<div class="card horizontal">
		
						<table class="table table-striped">
							<thead>
								<tr>
									<th sope="col">'.$row[3].'</th>
									<th scope="col" colspan="2"><b>'.$row[2].'</b></th>
								</tr>
							</thead>
							<tr>
								<td tyle="width:50%">
									<div class="card-image">
										<img src="../salonist/styleimages/'.$row[1].'" style="width: 190px; height:160px;">
									</div>
								</td>
								<td style="width:%">
									<div class="card-stacked">
										<div class="card-content">
	
											price : <b>'.number_format($row[4],2).'</b> Kshs<br>By: '.$row[7].'
										</div>
									</div>
								</td>
								<td>
									<a href="booking.php?id='.$row[0].'"><button class="btn btn-success">Book </button><br>
									<a href="salonistinfo.php?id='.$row[7].'"><button class="btn btn-primary">Saloninfo</button>
								</td>
							</tr>
							<tr>
								<td colspan="3">'.$row[5].'</td>
							</tr>
						</table>
						</div><br>
					</div><br>
					';
			  }
			?>
			





		</div>
	</div>
	<br>

</section>
<br>
<div class="clearfix"></div>
<!-- Infobox -->
<div class="infobox">
	<div class="container">
		<div class="sixteen columns">Smartr Salon Dashboard <a href="#">USER</a></div>
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