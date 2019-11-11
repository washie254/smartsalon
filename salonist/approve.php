<?php 
include('server.php');
//include('connect-db.php');
if (isset($_GET['id'])){
    $bid = $_GET['id'];
}

if (!isset($_SESSION['username'])) {
	$_SESSION['msg'] = "You must log in first";
	header('location: login.php');
}

if (isset($_GET['logout'])) {
	session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['id']);
	header("location: login.php");
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
			<h1><a href="index.html"><img src="images/logo.png" alt="Smart Salon" /></a></h1>
		</div>

		<!-- Menu -->
		<nav id="navigation" class="menu">
			<ul id="responsive">
                <li><button type="button" class="btn btn-success" style="width:100%" ><a href="requests.php" style="color:white;"> <-- Go Back</a> </button></li>
               
				<!-- <li><a href="blog.html">Blog</a></li> -->
			</ul>
            <ul class="float-center">
                <li><button type="button" class="btn btn-success" style="width:100%" >. [  APPROVE REQUEST  ]  . </button>  </li>
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
	<div class="container" id="addstyle">
		<div style="padding: 6px 12px; border: 1px solid #ccc;">
			<h3>Booking Details</h3> 
			<p> Here are the details pertaining the current booking entry </p>  

			<!-- get salonist id and username -->
			<?php 

			   $userl = $_SESSION['username'];
			   $query = "SELECT * FROM bookings WHERE id='$bid'";
			   $result = mysqli_query($db, $query);
			   
			   while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
				$client = $row[1];
				$style=$row[3];
                $datebooked = $row[4];
                $preferedtime =$row[6]." AT ".$row[7];
                $description = $row[8];
                $status = $row[10];
			   }
			?>
			<style>
				.error {
					width: 92%; 
					margin: 0px auto; 
					padding: 10px; 
					border: 1px solid #a94442; 
					color: #a94442; 
					background: #f2dede; 
					border-radius: 5px; 
					text-align: left;
				}
			</style>
			<form class="text-center border border-light p-5" action="styles.php" method="post" action = "approve.php">
				<?php include('errors.php'); ?>
				<!-- <p class="h4 mb-4">Add a new style </p> -->
				<!-- style name -->
                <label>OrderNo:  <b>#<?=$bid?></b> || Client: <b><?=$client?></b> || Date Booked: <b><?=$datebooked?></b> ||</label><br>
                <textarea disabled><?=$description?> <?="\n\n"?>preferred date :<?=$preferedtime?></textarea><br>
			
				<!-- Remarks -->
				<label>Add Remarks</label>
				<textarea type="number" id="remarks" class="form-control mb-4" name="remarks" placeholder="Insert a brief remark for your client, eg pertaining availabiliy or requirements"></textarea>
				<input name="bookid" value="<?=$bid?>" style="opacity: 0;"/>
				<!-- Sign in button -->
				<button class="btn btn-success btn-block my-4"  name="approve_booking" type="submit">Approve Booking</button>

			</form>

		</div>
	</div>
	<br>
	

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