<?php

	//variable decleration
	include '../vars.php';
        include '../secrets.php';
	include '../functions/check_ip.php';

	//variable import
	$submission = $_POST['submission'];
	$name = $_POST['name'];//imports name variable from input
	include '/var/www/blackhole/functions/spam_func.php'; //runs submission through spam detection

	if(strlen($submission >= 250){
		$submission = substr($submission, 0, 250);
	}
	if(strlen($name >= 30){
		$name = substr($name, 0, 30);
	}

	$submission = trim(preg_replace('/\s+/', ' ', $submission));//trim whitespace tabs
	$submission = ltrim($submission); //trim leading space
	$submission_lower = strtolower($submission);//converts to lower case for md5 creation
	$submission_nospec = preg_replace('/[^0-9a-zA-Z_]/',"",$submission_lower);//removes all space and special chars for md5
	include '/var/www/blackhole/functions/check_ip.php';//checks ip


	//generate md5 hash of the string
	$string_md5 = md5($submission_nospec);

	//establish connection
 	$mysqli = new mysqli($host, $username, $password, $db_name);
	if ($mysqli->connect_error) {
    		die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
	}

	//escape characters and convert to html representations of special chars
	$submission=mysqli_real_escape_string($mysqli,$submission);
	$name=mysqli_real_escape_string($mysqli,$name);
	$submission=htmlentities($submission, ENT_QUOTES);
	$name=htmlentities($name, ENT_QUOTES);


	//insert information into table "entry"
	$sql="INSERT INTO $table (datetime, text, md5, name, spam_score, spam, ip) VALUES (now(),'$submission','$string_md5','$name','$spam_score', '$spam', INET_ATON('$IP'))";
	$result = mysqli_query($mysqli,$sql);

	$result->close();


?>




