<?php 
	session_start();
	// variable declaration
	$username = "";
	$email    = "";
	$errors = array(); 
	$_SESSION['success'] = "";
	$cdate = date("Y-m-d");
	$ctime = date("h:i:s");

	// connect to database
	$db = mysqli_connect('localhost', 'root', '', 'smart_salon');

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
			$query = "SELECT * FROM salonist WHERE username='$username' AND password='$password'";
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

	if (isset($_POST['reg_salon'])) {
		$username = mysqli_real_escape_string($db, $_POST['username']);
		$email = mysqli_real_escape_string($db,$_POST['email']);
		$password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
		$password_2 = mysqli_real_escape_string($db, $_POST['password_2']);
		$pen = 'PENDING APPROVAL';

		if (empty($username)) { array_push($errors, "Username is required"); }
		if (empty($password_1)) { array_push($errors, "Password is required"); }

		if ($password_1 != $password_2) {
			array_push($errors, "The two passwords do not match");
		}

		if (count($errors) == 0) {
			$password = md5($password_1);//encrypt the password before saving in the database
			$query = "INSERT INTO salonist (username, email, password,datecreated, status) 
					  VALUES('$username', '$email', '$password','$cdate', '$pen')";
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
		$salonname = mysqli_real_escape_string($db, $_POST['salonname']);
		$category =  mysqli_real_escape_string($db, $_POST['category']);
		$phone = mysqli_real_escape_string($db, $_POST['phone']);
		$location = mysqli_real_escape_string($db, $_POST['location']);
		$email = mysqli_real_escape_string($db, $_POST['email']);
		$tfrom = mysqli_real_escape_string($db, $_POST['tfrom']);
		$tto = mysqli_real_escape_string($db, $_POST['tto']);
		$userid =mysqli_real_escape_string($db, $_POST['uid']);

		$lat = mysqli_real_escape_string($db, $_POST['lat']);
		$lng =mysqli_real_escape_string($db, $_POST['lng']);

		if (empty($fname)) { array_push($errors, "First name is required"); }
		if (empty($lname)) { array_push($errors, "Last Name is required"); }
		if (empty($phone)) { array_push($errors, "Phone Required"); }
		if (empty($salonname)) { array_push($errors, "Input your Salon name"); }
		if (empty($location)) { array_push($errors, "Insertyou location"); }
		
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
			$query = "UPDATE salonist
						SET
							email ='$email',
							fname = '$fname',	
							lastname = '$lname',	
							salonname = '$salonname',	
							category = '$category',
							phone ='$phone',	
							location = '$location',	
							tfrom ='$tfrom',
							tto = '$tto',
							lat = '$lat',	
							lng  ='$lng'
						
						WHERE id ='$userid'";
			$result = mysqli_query($db, $query);
		
			header('location:account.php');
		}


	}


	//ADD A STYLE 
	// If upload button is clicked ...
	if (isset($_POST['add_style'])) {

		$sname = $_POST['sname'];
		$scategory = $_POST['scategory'];
		$sprice = $_POST['sprice'];	
		$sdescription = $_POST['sdescription'];
		$salonistname = $_POST['salonistname'];
		$salonistid = $_POST['salonistid'];

		$acntstat = $_POST['acntstat'];
	
		$image = $_FILES['image']['name'];
		
		$target = "styleimages/".basename($image);
		
		// Get text
		//$image_text = mysqli_real_escape_string($db, $_POST['image_text']);
		// image file directory
		// Get image name
		// form validation: ensure that the form is correctly filled
		if (empty($sname)) { array_push($errors, "insert a style name"); }
		if (empty($sprice)) { array_push($errors, "Add a price of the style"); }
		if (empty($sdescription)) { array_push($errors, "insert a brief description about the style"); }
		if (empty($_FILES['image']['name'])) { array_push($errors, "You have not chosen any image"); }
		
		if($acntstat != 'APPROVED'){ array_push($errors, "Your account is innactive"); }
		if (count($errors) == 0) {
		  $sql = "INSERT INTO styles (image, sname, scategory, sprice, sdescription, salonistid, salonistname) 
								VALUES ('$image','$sname','$scategory','$sprice','$sdescription','$salonistid','$salonistname')";
		  // execute query
		  if(mysqli_query($db, $sql)){
			header('location: styles.php');
		  }
		  if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
			$msg = "Image uploaded successfully";
		  }else{
			$msg = "Failed to upload image";
		  }
		}
	}
?>