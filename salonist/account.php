
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
<!-- <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script> -->

<!--[if lt IE 9]>
	<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
<![endif]-->

</head>

<body>
<div id="wrapper">


<!-- Header
================================================== -->
<header>


	<!-- :::::::::: get currently logedin USER DETAILS :::::::::::::::::::: -->
	<?php
	  $username = $_SESSION['username'];
	  
	  $query = "SELECT * FROM salonist WHERE username='$username'";
	  $result = mysqli_query($db, $query);
	  while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
		  $uid = $row[0]; //user id
		  $uname = $row[1]; //username
		  $uemail = $row[2]; //email
	  }
	?>
<div class="container">
	<div class="sixteen columns">
	
		<!-- Logo -->
		<div id="logo">
			<h1><a href="index.html"><img src="images/logo.png" alt="Work Scout" /></a></h1>
		</div>

		<!-- Menu -->
		<nav id="navigation" class="menu">
			<ul id="responsive">

                <li><a href="index.php" >Home</a> </li>
				<li><a href="requests.php">Manage Requests</a></li>
				<li><a href="styles.php">Portfolio</a></li>
				<li><a href="account.php" id="current">Account</a></li>
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

<!-- ====================================MAPS -->
<script>
    if(!navigator.geolocation){
    alert('Your Browser does not support HTML5 Geo Location. Please Use Newer Version Browsers');
    }
    navigator.geolocation.getCurrentPosition(success, error);
    function success(position){
    var latitude  = position.coords.latitude;	
    var longitude = position.coords.longitude;	
    var accuracy  = position.coords.accuracy;
    document.getElementById("lat").value  = latitude;
    document.getElementById("lng").value  = longitude;
    document.getElementById("acc").value  = accuracy;
    }
    function error(err){
    alert('ERROR(' + err.code + '): ' + err.message);
    }
</script>
<!-- ====================================MAPS -->



<div class="clearfix"></div>


<section class="section intro">

	<div class="container">
		<div style="padding: 6px 12px; border: 1px solid #ccc;">
			YOUR DASHBOARD | ACCOINT INFORMATION
		</div>
	</div>
	<br>
	
    <div class="container">
        <div  style="padding: 6px 12px; border: 1px solid #ccc;">

            <div class="tab">
                <button class="tablinks" onclick="openCity(event, 'View')" id="defaultOpen">View Profile</button>
                <button class="tablinks" onclick="openCity(event, 'Update')">Update Profile</button>
                <button class="tablinks" onclick="openCity(event, 'Tokyo')">More</button>
            </div>

            <div id="View" class="tabcontent">
                <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
                <h3>Bio Information</h3>
                <p>the folowing are your details.</p>
                <style>
                    .label{
                        color: #58BA2B;
                    }
                </style>
                <table class="table table-dark">
                    <thead>
                        <tr>
                            <th sope="col">Avatar</th>
                            <th scope="col">Personal</th>
                            <th scope="col">About Salon</th>
                        </tr>
                    </thead>
                    <?php
                        $user = $_SESSION['username'];
    ;                   $query2 = "SELECT * FROM salonist WHERE username='$user'";
                        $result2 = mysqli_query($db, $query2);
                        while($row = mysqli_fetch_array($result2, MYSQLI_NUM)){
                            $salid = $row[0]; 
                            $names = $row[4]." ".$row[5];
                            $salonname = $row[6];
                            $location = $row[9];
                            $datecreated =$row[14];
                            $accountstatus = $row[15];
                            $hours = $row[10]. " to ".$row[11];
                            $phone = $row[8];
                            $category = $row[7];

                        }
                    
                    ?>
                    <tr> <td>ACCOUNT STATUS : <b style="color: #58BA2B;"> <?=$accountstatus?></b></td> </tr>
                    <tr>
                        <td><img src="images/avatar.jpg" style="width:150px; height:150px;"> </td>
                        <td>
                            <label class="label">User Id:</label><?php echo $uid; ?><br>
                            <label class="label">Username :</label> <?php echo $uname; ?><br>
                            <label class="label">Other Names:</label> <?php echo $names; ?><br>
                            <label class="label">Email:</label><?php echo $uemail; ?><br>
                        </td>
                        <td>
                            <label class="label">Salon Name:</label><?php echo $salonname; ?><br>
                            <label class="label">Location:</label><?php echo $location; ?><br>
                            <label class="label">Date Created:</label><?php echo $datecreated; ?><br>
                            <label class="label">Operating Hours:</label><?php echo $hours; ?><br>
                        
                        </td>
                    </tr>
                </table>
            </div>

            <div id="Update" class="tabcontent">
                <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
                <h3>Update Profile</h3>
                <p>Update your Bio Information.</p> 
                <style>
                    .error {
                        width: 100%; 
                        margin: 0px auto; 
                        padding: 10px; 
                        border: 1px solid #a94442; 
                        color: #a94442; 
                        background: #f2dede; 
                        border-radius: 5px; 
                        text-align: left;
                    }
				</style>
                <?php require('errors.php'); ?>
                <?php 
                    $resultz = mysqli_query($db,"SELECT * FROM salonist WHERE id='$uid'");
                    $rowz= mysqli_fetch_array($resultz);
                ?>
				<form class="form" action="account.php" method="post">
					<div class="form-group">
                        <div class="col-xs-6">
                            <label for="first_name"><h4>First name</h4></label>
                            <input type="text" class="form-control" name="fname" id="fname" value="<?php echo $rowz['fname']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="last_name"><h4>Last name</h4></label>
                            <input type="text" class="form-control" name="lname" id="lname" value="<?php echo $rowz['lastname']; ?>">
                        </div>
                    </div>
                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="last_name"><h4>Salon Name</h4></label>
                            <input type="text" class="form-control" name="salonname" id="salonname" value="<?php echo $rowz['salonname']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="category"><h4>Category</h4></label>
                            <select name="category" class="form-control" type="text">
                                <option value="Business">Business</option>
                                <option value="Freelance">Freelance</option>
                                <option value="Both">Both</option>
                            <select>
                        </div>
                    </div>
							
                    <div class="form-group">	
                        <div class="col-xs-6">
                            <label for="phone"><h4>Phone</h4></label>
                            <input type="text" class="form-control" name="phone" id="phone" value="<?php echo $rowz['phone']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="email"><h4>Email</h4></label>
                            <input type="email" class="form-control" name="email" id="email" value="<?php echo $rowz['email']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="county"><h4>Location</h4></label>
                            <input type="text" class="form-control" name="location" value="<?php echo $rowz['location']; ?>">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-6">
                            <label for="county"><h4>Working hours</h4></label>
                            from
                            <input type="time" class="form-control" name="tfrom" value="<?php echo $rowz['tfrom']; ?>">
                            to
                            <input type="time" class="form-control" name="tto" value="<?php echo $rowz['tto']; ?>">
                        </div>
                    </div>


                    <div class="form-group">
                        <input type="text" id="lat" name="lat" style="opacity: 0.3;" readonly/>
                        <input type="text" id="lng" name="lng" style="opacity: 0.3;" readonly/>
                        <input type="text" id="uid" name="uid" style="opacity: 0;" value="<?=$uid?>"/>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <br>
                            <button class="btn btn-lg btn-success" type="submit" name="update_info"><i class="glyphicon glyphicon-ok-sign"></i> UPDATE PROFILE</button>
                        </div>
                    </div>
                </form>

            </div>


            <div id="Tokyo" class="tabcontent">
                <span onclick="this.parentElement.style.display='none'" class="topright">&times</span>
                <h3>MORE INFO</h3>
                <p> Upload your Identity Card Will be reviewed for Account Approval.</p>
                
                <form class="form-group" action="account.php"  enctype="multipart/form-data" method="post" style="width:98%;" >
                    <?php include('errors.php');?>
                    <input name="salonid" value="<?=$salid?>" style="opacity: 0.2;" readonly/>
                    <div class="form-group">	
                        <div class="col-xs-6">
                            <label for="em_tImage"><h4>Attach Image</h4></label>
                            <input type="file" class="form-control" name="image" id="emTitle" required>
                        </div>
                    </div>
                    
                    <div class="form-group">
                        <div class="col-xs-12">
                            <br>
                            <button class="btn btn-lg btn-success" type="submit" name="UploadId"><i class="glyphicon glyphicon-ok-sign"></i> Upload ID</button>
                        </div>
                    </div>
						
				</form>
            </div>

            <script>
                function openCity(evt, cityName) {
                    var i, tabcontent, tablinks;
                    tabcontent = document.getElementsByClassName("tabcontent");
                    for (i = 0; i < tabcontent.length; i++) {
                        tabcontent[i].style.display = "none";
                    }
                    tablinks = document.getElementsByClassName("tablinks");

                    for (i = 0; i < tablinks.length; i++) {
                        tablinks[i].className = tablinks[i].className.replace(" active", "");
                    }
                    document.getElementById(cityName).style.display = "block";
                    evt.currentTarget.className += " active";
                }

                // Get the element with id="defaultOpen" and click on it
                document.getElementById("defaultOpen").click();
            </script>
        </div><!--/col-9-->
    </div><!--/row-->
</div>
</div>	
		<!-- End home-about Area -->	

    ////////////////////////////////////////////////////////////////////////////////////////////
</section>
<br>
<div class="clearfix"></div>
<!-- Infobox -->


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
			<h4>Add Hair Styles</h4>
			<ul class="footer-links">
				<li><a href="styles.php">Add Hairstyles</a></li>
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