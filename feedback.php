<?php

	//variable decleration
	include 'vars.php';
        include 'secrets.php';
	//variable import
	$feedback = $_POST['feedback'];
	$feedback = trim(preg_replace('/\s+/', ' ', $feedback));
	$feedback = ltrim($feedback);
	$feedback = strtolower($feedback);

	$email = $_POST['email'];
	$email = trim(preg_replace('/\s+/', ' ', $email));
        $email = ltrim($email);
        $email = strtolower($email);

	$name = $_POST['name'];

	if ($feedback === '') {
                echo 'You entered an empty input!</br>';
                echo 'You shall now die.</br>';
                echo 'Now go back and remember this as your last vision</br>';
		//header("Location: {$_SERVER['HTTP_REFERER']}");

		exit();
        }



	//establish connection
 	$mysqli = new mysqli($host, $username, $password, $db_name );
	if ($mysqli->connect_error) {
    		die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
	}


	//insert information into table "entry"
	$feedback=mysqli_real_escape_string($mysqli,$feedback);
	$name=mysqli_real_escape_string($mysqli,$name);
	$email=mysqli_real_escape_string($mysqli,$email);
	$feedback=htmlentities($feedback, ENT_QUOTES);
	$name=htmlentities($name, ENT_QUOTES);
	$email=htmlentities($email, ENT_QUOTES);

	$sql="INSERT INTO $table2 (datetime, entry, name, email) VALUES (now(),'$feedback','$name', '$email')";
	mysqli_query($mysqli,$sql);



	// close connection
	$mysqli->close();

?>


<!DOCTYPE html PUBLIC "-//W2C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<title>Black Hole of the Internet</title>
	<link rel='stylesheet' type='text/css' href='css/gumby.css' />
	<link rel='stylesheet' type='text/css' href='css/style.css' />
</head>

</body>
	<div class="success alert">Thank you for your feedback!</div></br></br>
	<div class="response">
		<div class="response2">
			</br>
			<h6>From the ether you see these words:</br></br></h6>
			<h6>Thanks for your feedback</h6>
		</br></br></br></br>
		<div class="random_button">
				<div class="large primary btn"><a href="random.php">See Another Random Entry</a></div>
		</div>
		</div>
		<div class="links">
			<a href="index.html">  Home   </a>|
			<a href="about.html">  About  </a>|
			<a href="random.php">  Random Entry   </a>
		</div>
		</div>
	</div>
</html>
