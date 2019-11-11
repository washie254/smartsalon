<?php 
include ('server.php');	
//session_start(); 

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
			<h1><a href="index.html"><img src="images/logo.png" alt="Work Scout" /></a></h1>
		</div>

		<!-- Menu -->
		<nav id="navigation" class="menu">
			<ul id="responsive">

                <li><a href="index.php" >Home</a> </li>
				<li><a href="requests.php">Manage Requests</a></li>
				<li><a href="styles.php" id="current">Portfolio</a></li>
				<li><a href="account.php">Account</a></li>
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

	<div class="container" id="mystyles">
		<div style="padding: 6px 12px; border: 1px solid #ccc;">
			<h3>My styles</h3> 
			<p>Styles we add will be in this page </p>  


			<?php 
			$user = $_SESSION['username'];
			  $query0 = "SELECT * FROM styles  WHERE salonistname='$user'";
			  $result0 = mysqli_query($db, $query0);
			  $count=1;
			  echo '<div class="card-group">';
			  while($row = mysqli_fetch_array($result0, MYSQLI_NUM)){
				  echo '
					<div class="col-sm-3">
						<div class="card">
							<img src="styleimages/'.$row[1].'" style="width:300px; height:200px;" class="card-img-top" alt="...">
							<div class="card-body">
								<h5 class="card-title"><b>'.$row[2].'</b></h5>
								<h5 class="card-title"><b>Price:  @ </b>'.number_format($row[4],2). ' Ksh</h5>
								<p class="card-text">'.$row[5].'</p>
								<p class="card-text"><small class="text-muted"><b>Category: </b>'.$row[3].' cnt : '.$count.'</small></p>
							</div>
						</div>
					</div>';

				 	 $count = $count + 1;
			  		if ($count % 3 == 1){
				  echo '<br>';
				  }
				  
				echo  '&nbsp;&nbsp;&nbsp;';
			
			  }
			  echo '</div>';
			?>
			
			<!-- <div class="card-group">
				<div class="card">
					<img src="styleimages/" class="card-img-top" alt="...">
					<div class="card-body">
					<h5 class="card-title">Card title</h5>
					<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>
					<p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>
					</div>
				</div>
				&nbsp;&nbsp;&nbsp;
			</div> -->


		</div>
	</div>
 <br>
	<div class="container" id="addstyle">
		<div style="padding: 6px 12px; border: 1px solid #ccc;">
			<h3>add Styles</h3> 
			<p> We can add styles we offer here </p>  

			<!-- get salonist id and username -->
			<?php 

			   $userl = $_SESSION['username'];
			   $query = "SELECT * FROM salonist WHERE username='$userl'";
			   $result = mysqli_query($db, $query);
			   
			   while($row = mysqli_fetch_array($result, MYSQLI_NUM)){
				$salonistid=$row[0];
				$salonistname=$row[1];
				$acntstat = $row[15];
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
			<?php if($acntstat != 'APPROVED'){
				   echo '<p class="error"> Your Account is not APPROVED! <br>thus u cant add a style </p>';
				}
				?>
			<form class="text-center border border-light p-5" action="styles.php" method="post" enctype="multipart/form-data" action = "<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
				<?php include('errors.php'); ?>
				<!-- <p class="h4 mb-4">Add a new style </p> -->
				<input name="acntstat" value="<?=$acntstat?>" style="opacity: 0;"/>
				<input type="file" class="form-control mb-4" name="image">

				<!-- style name -->
				<input type="Text" id="name" class="form-control mb-4" name="sname" placeholder="Style Name">
				<!-- category -->
				<label>Category</label>
				<?php
					//$conn = new mysqli('localhost', 'root', '', 'mojor') 
					///or die ('Cannot connect to db');                     
					$result = $db->query("select id, name from hairCategories");
					echo "<select name='scategory' id='category' class='form-control mb-4'>";
						while ($row = $result->fetch_assoc()) {
						unset($id, $name);
						$id = $row['id'];
						$name = $row['name']; 
						echo '<option value="'.$name.'">'.$name.'</option>';      
						}
					echo "</select>";
				?>
				
				<!-- price -->
				<input type="number" id="price" class="form-control mb-4" name="sprice" placeholder="Price">

				<!-- price -->
				<textarea type="number" id="description" class="form-control mb-4" name="sdescription" placeholder="Insert a brief description"></textarea>
				<input name="salonistname" value="<?=$salonistname?>" style="opacity: 0;"/>
                <input name="salonistid" value="<?=$salonistid?>" style="opacity: 0;"/>
				<!-- Sign in button -->
				<button class="btn btn-success btn-block my-4"  name="add_style" type="submit">ADD STYLE</button>


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