<?php 
include('server.php');
//session_start(); 
if (isset($_GET['id'])){
    $styleid = $_GET['id'];
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
<title>Work Scout</title>

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

				<li><a href="styles.php"> <b><<[[ -- go back</b> </a> </li>
				
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
			<h3>  Fill in the following details to make a booking  </h3>
		</div>
	</div>
	<br>
	
	<div class="container" id="pending">
		<div style="padding: 6px 12px; border: 1px solid #ccc;">
            <?php 
                $user = $_SESSION['username'];
                $query0 = "SELECT * FROM styles WHERE id='$styleid' ";
                $result0 = mysqli_query($db, $query0);

                while($row = mysqli_fetch_array($result0, MYSQLI_NUM)){
                    // $styid = $row[0];
                    $styname = $row[2];
                    $stycategory = $row[3];
                    $styprice = number_format($row[4],2)." Ksh";
                    $stydesc = $row[5]; 
                    $stysalonistid = $row[6]; 
                    $stysalonist = $row[7];
                    
                }
            ?>
            <?php 
                $query1 = "SELECT * FROM salonist WHERE id='$stysalonistid' ";
                $result1 = mysqli_query($db, $query1);
            
                while($row = mysqli_fetch_array($result1, MYSQLI_NUM)){
                   $workinghours = "From ".$row[10]." To ".$row[11]; 
                   $otfrom = $row[10];
                   $otto = $row[11];
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
            <form action="booking.php" method="post" style="width:98%;">
                <?php include('errors.php')?>
                <div class="form-group">
                    <label>style information:</label><br>
                    <label><b>Name:</b> <?=$styname?></label>&nbsp;&nbsp; || &nbsp;&nbsp;
                    <label><b>Category:</b><?=$stycategory?></label> ||&nbsp;&nbsp;
                    <label><b>Price:</b><?=$styprice?></label>|| &nbsp;&nbsp;
                    <label><b>Salonistid:</b><?=$stysalonistid?></label>|| &nbsp;&nbsp;
                    <label><b>SalonistName:</b><?=$stysalonist?></label>|| &nbsp;&nbsp;<br>
                    <label><b>booking hours:</b><?=$workinghours?></label>
                    <input type="hidden" name="user" value="<?php echo $user; ?>">
                    <input type="hidden" name="salonist" value="<?php echo $stysalonist; ?>">
                    <input type="hidden" name="styleid" value="<?php echo $styleid; ?>">
                    <input type="hidden" name="otfrom" value="<?php echo $otfrom; ?>">
                    <input type="hidden" name="otto" value="<?php echo $otto; ?>">
                </div>

                <div class="form-group">
                    <label for="Time Sample">Schedule your Booking</label><br>
                    Date:<input type="date" class="form-control" name="bdate" id="date" >
                    Time:<input type="time" class="form-control" name="btime" id="date" >
                </div>

                <div class="form-group">
                    <label for="Time Sample">Description</label>
                    <textarea type="text" class="form-control" name="bdescription" id="description" placeholder="Add a brief description  pertaining your booking"></textarea>
                </div>
                <button type="submit" class="btn btn-primary" name="book" style="width:100%;">Make Booking</button>
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