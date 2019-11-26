<?php 
	date_default_timezone_set("Africa/Nairobi");
	session_start();
	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";
	$cdate = date("Y-d-m");
	$ctime = date("h:i a");

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'dkut_smart_salon');

	// LOGIN ADMINISTRATOR
	if (isset($_POST['login'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$password = mysqli_real_escape_string($db, $_POST['password']);

		if (empty($username)) {
			array_push($errors, "Username is required");
		}
		if (empty($password)) {
			array_push($errors, "Password is required");
		}

		if (count($errors) == 0) {
			$password = md5($password);
			$query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
			$results = mysqli_query($db, $query);

			if (mysqli_num_rows($results) == 1) {
				$_SESSION['username'] = $username;
				$_SESSION['success'] = "You are now logged in";
				header('location: index.php');
			}else {
				array_push($errors, "Wrong username/password combination");
			}
		}
	}

	// ==== == = == ==REG ADMIN

	if (isset($_POST['reg_user'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db,$_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		

		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		$sql_u = "SELECT * FROM users WHERE username='$username'";
		$res_u = mysqli_query($db, $sql_u);
		if (mysqli_num_rows($res_u) > 0) { array_push($errors, "Sorry Username has already been taken"); }
		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO users (username, email, password,datecreated) 
					  VALUES('$username', '$email', '$password', '$cdate')";
			mysqli_query($db, $query);

			$_SESSION['username'] = $username;
			$_SESSION['success'] = "You are now logged in";
			header('location: index.php');
		}
	}


	
	// LOGIN USER [ DONE ]
	if (isset($_POST['update_info'])) {
		$fname = mysqli_real_escape_string($db, $_POST['fname']);
		$lname = mysqli_real_escape_string($db, $_POST['lname']);
		$phone = mysqli_real_escape_string($db, $_POST['phone']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$gender = mysqli_real_escape_string($db, $_POST['gender']);
		
		$userid =mysqli_real_escape_string($db, $_POST['uid']);

		if (empty($fname)) { array_push($errors, "First name is required !"); }
		if (empty($lname)) { array_push($errors, "Last Name is required !"); }
		if (empty($phone)) { array_push($errors, "Phone Required !"); }
		if (empty($email)) { array_push($errors, "Email is Required !"); }
		
		
		// form validation: ensure that the form is correctly filled
		function validate_phone_number($phone)
		{
			// Allow +, - and . in phone number
			$filtered_phone_number = filter_var($phone, FILTER_SANITIZE_NUMBER_INT);
			// Remove "-" from number
			$phone_to_check = str_replace("-", "", $filtered_phone_number);
			// Check the lenght of number
			// This can be customized if you want phone number from a specific country
			if (strlen($phone_to_check) < 9 || strlen($phone_to_check) > 14) {
			return false;
			} else {
			return true;
			}
		}
		//VALIDATE PHONE NUMBER 
		if (validate_phone_number($phone) !=true) {
			array_push($errors, "Invalid phone number");
		}

		if (count($errors) == 0) {
			$query = "UPDATE users
						SET 

						email = '$email',
						telno = '$phone',
						fname = '$fname',
						lname = '$lname',
						gender = '$gender'
						
						WHERE id ='$userid'";
			$result = mysqli_query($db, $query);
		
			header('location:account.php');
		}


	}

	//OOK A SESSION
	if (isset($_POST['book'])) {
		$user = mysqli_real_escape_string($db, $_POST['user']);
		$salonist = mysqli_real_escape_string($db,$_POST['salonist']);
		$styleid = mysqli_real_escape_string($db, $_POST['styleid']);
		$otfrom = mysqli_real_escape_string($db, $_POST['otfrom']);
		$otto= mysqli_real_escape_string($db, $_POST['otto']);
		$bdate = mysqli_real_escape_string($db, $_POST['bdate']);
		$btime = mysqli_real_escape_string($db, $_POST['btime']);
		$bdescription = mysqli_real_escape_string($db, $_POST['bdescription']);
		$status = 'PENDING';
		$cdate = date("Y-m-d");
		
		// if ($bdate < $cdate ) { array_push($errors, "You Cant selext a date of the past"); }
		if (strtotime($bdate) < time()) { array_push($errors, "date is in the past");  }
		if (empty($bdescription)) { array_push($errors, "Add a brief description"); }

	
		if (count($errors) == 0) {
			// $password = md5($password_1);//encrypt the password before saving in the database
			 $query = "INSERT INTO bookings (username, salonist, styleid, datebooked, timeboked, prefereddate, preferdtime, description, status) 
		 						VALUES('$user','$salonist','$styleid', '$cdate','$ctime','$bdate','$btime','$bdescription','$status')";
			mysqli_query($db, $query);

			header('location: account.php');
		}
	}


	//AFFIRM COMPLETION & review
		if (isset($_POST['mcomplete'])) {
			$clienid = $_POST['cid'];
			$remarks= $_POST['bdescription'];
			$rating=$_POST['rating'];
			$sid = $_POST['sid'];
			$salid = $_POST['salid'];

			$bid = $_POST['bid'];
			$stat = 'COMPLETE';
	
			// form validation: ensure that the form is correctly filled
			if (empty($bid)) { array_push($errors, "Could not resolve the booking ID"); }
			
			if (count($errors) == 0) {
			  $sql = "UPDATE bookings SET status = '$stat' WHERE id='$bid' ";
			  if(mysqli_query($db, $sql)){

				$sql2= "INSERT INTO ratings (styleid, salonistid, review, clienid, rating) VALUES ('$sid','$salid','$remarks','$clienid','$rating')";
				mysqli_query($db, $sql2);

				header('location: account.php');
			  }
			  else{
				  echo 'some err occurred !!';
			  }
			}
		}
?>