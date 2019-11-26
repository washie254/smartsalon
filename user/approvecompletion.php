<?php 
include('server.php');	
//session_start(); 
if(isset($_GET['id'])){
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
				<li><a href="requests.php">Manage Requests</a></li>
				<li><a href="styles.php">Portfolio</a></li>
				<li><a href="account.php">Account</a> </li>
				<li><a href="reports.php">Reports</a></li>
				<!-- <li><a href="blog.html">Blog</a></li> -->
			</ul>

			<ul class="float-right">
				<li><a href="account.php"><?=$_SESSION["username"]?></a></li>
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


<!-- Banner
================================================== -->



<!-- Content
================================================== -->

<!-- Categories -->
<div class="container">
	<div class="sixteen columns">
		<h3 class="margin-bottom-25">Booking Information</h3>
		

        <div class="card">
            <div class="card-body">
                Mark the following Order as complete<br>
                <?php
                    $sql = "SELECT * FROM bookings WHERE id='$bid'";
                    $res=mysqli_query($db, $sql);
                    while($row = mysqli_fetch_array($res, MYSQLI_NUM)){
                        $client = $row[1];
                        $styleid= $row[3];
                        $datebooked= $row[5];
                        $description= $row[8];
                    }
                    $sq = "SELECT * FROM styles WHERE id='$styleid'";
                    $re = mysqli_query($db, $sq);
                    while($ro = mysqli_fetch_array($re, MYSQLI_NUM)){
                        $salonistid = $ro[6];
                    }

                    $cli = $_SESSION["username"];
                    $sq1 = "SELECT * FROM users WHERE username='$cli'";
                    $re1 = mysqli_query($db, $sq1);
                    while($ro = mysqli_fetch_array($re1, MYSQLI_NUM)){
                        $cid = $ro[0];
                    }
                ?>
                <div class="card">
                    <div class="card-body">
                       <b>Booking information</b><br>
                       <b>Clinet :</b><?=$client?><br>
                       <b>Style ID:</b><?=$styleid?><br>
                       <b>Dated Booked:</b><?=$datebooked?><br>
                       <b>Salonist:</b><?=$salonistid?><br>
                       <b>Clinet Description :</b><?=$description?><br>

                        <form action="approvecompletion.php" method="post">
                            <input type="text" name="salid" value="<?=$salonistid?>" style="opacity:0.3;" readonly>
                            <input type="text" name="sid" value="<?=$styleid?>" style="opacity:0.3;" readonly>
                            <input type="text" name="bid" value="<?=$bid?>" style="opacity:0.3;" readonly>
                            <input type="text" name="cid" value="<?=$cid?>" style="opacity:0.3;" readonly>
                            <div class="form-group">
                                <label for="Time Sample">Booking remarks</label>
                                <textarea type="text" class="form-control" name="bdescription" id="remarks" placeholder="provide some remarks on the style ans salonist" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="Time Sample">Rate </label>
                                <select type="text" class="form-control" name="rating" required>
                                 <option value="1">1</option>
                                 <option value="2">2</option>
                                 <option value="3" selected>3</option>
                                 <option value="4">4</option>
                                 <option value="5">5</option>
                                </select>
                            </div>

                            <button type="submit" class="btn btn-primary" name="mcomplete" style="width:100%;">Mark as complete</button>

                        </form>

                    </div>
                </div>
            </div>
        </div>
        

		<div class="clearfix"></div>
		<div class="margin-top-30"></div>

		<a href="#" class="button centered">Other Functions</a>
		<div class="margin-bottom-50"></div>
	</div>
</div>




<!-- Testimonials -->
<div id="testimonials">
	<!-- Slider -->
	<div class="container">
		<div class="sixteen columns">
			<div class="testimonials-slider">
				  <ul class="slides">
				    <li>
				      <p>A saloonist art is via the complexity of the design and flow of the style
				      <span>No 1 , nose</span></p>
				    </li>

				    <li>
				      <p>Mgala muue, na haki yake umpe. 
				      <span>Mwarabu Fulani</span></p>
				    </li>
				    
				    <li>
				      <p> the art of beauty is the unverse' untold perfection 
				      <span>Tom Smith</span></p>
				    </li>

				  </ul>
			</div>
		</div>
	</div>
</div>


<!-- Infobox -->
<!-- <div class="infobox">
	<div class="container">
		<div class="sixteen columns">Smartr Salon Dashboard <a href="#">ADMIN</a></div>
	</div>
</div> -->



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
				<li><a href="saloonists.php">saloonist</a></li>
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