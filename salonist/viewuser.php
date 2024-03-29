<?php 
include('server.php');	
//session_start(); 
if (isset($_GET['id'])){
    $userid = $_GET['id'];
}

if (isset($_GET['logout'])) {
	session_destroy();
    unset($_SESSION['username']);
    unset($_SESSION['id']);
	header("location: ../");
}
?>
<?php
    $query2 = "SELECT * FROM users  WHERE username='$userid'";
    $result2 = mysqli_query($db, $query2);
    while($row = mysqli_fetch_array($result2, MYSQLI_NUM)){
        $username = $row[1];
        $email = $row[2];
        $tel =$row[4];
        $fname =$row[6];
        $lname =$row[7];
        $gender =$row[8];
        $coords =$row[9].", ".$row[10];

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
<style>   
    /* Set the size of the div element that contains the map */
    #map {
    height: 400px;  /* The height is 400 pixels */
    width: 98%;  /* The width is the width of the web page */
    }
</style>

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

			    <li><a href="requests.php"> <b><<--- [ ___Go Back___]</b></a> </li>
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

    <table class="table table-bordered">
        <thead>
            <tr>
                <th sope="col" colspan=""><b>Avatar</b></th>
                <th scope="col" colspan=""><b>Personal Info</b></th>
                <th scope="col" colspan=""><b>Salon Info</b></th>
            </tr>
        </thead>
        <tr>
            <td style="width:20%">
                <div class="card-image">
                    <img src="images/sa.png" style="width: 100%; height:100%;">
                </div>
            </td>
            <td style="width:40%;">
                <ul class="list-group">
                    <li class="list-group-item"><b>Usename:</b><?=$username?></li>
                    <li class="list-group-item"><b>Names:</b><?=$fname." ".$lname?></li>
                    <li class="list-group-item"><b>Email  :</b><?=$email?></li>
                    <li class="list-group-item"><b>Tel NO :</b><?=$tel?></li>
                    <li class="list-group-item"><b>Gneder:</b><?=$gender?></li>
                </ul>
            </td>
            <td>
                <ul class="list-group">
                    <li class="list-group-item"><b>Cordinsates</b><?=$coords?></li>
                </ul>
            </td>
        </tr>
    </table>
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB2yA5YuLgx_YR4klxs93zoS9Ez7onQF6k"></script>
    <script>

      var map;
      function initialize() {
        var mapOptions = {
          zoom: 14,
		  center: {lat:-1.28696, lng: 36.8353}
        //   center: {lat: -34.397, lng: 150.644}
        };
        map = new google.maps.Map(document.getElementById('map'),
            mapOptions);

        var marker = new google.maps.Marker({
          // The below line is equivalent to writing:
          // position: new google.maps.LatLng(-34.397, 150.644)
          position: {lat:-1.28696, lng: 36.8353},
          map: map
        });

        var infowindow = new google.maps.InfoWindow({
          content: '<p>Marker Location:' + marker.getPosition() + '</p>'
        });

        google.maps.event.addListener(marker, 'click', function() {
          infowindow.open(map, marker);
        });
      }

      google.maps.event.addDomListener(window, 'load', initialize);
    </script>
<div class="row">
    Map is here
    <div id="map"></div>
  
</div>
	

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