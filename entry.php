
<?php

	//variable decleration
	include 'vars.php';
	include 'secrets.php';
        include 'functions/check_ip.php';

	//variable import
	$submission = $_POST['submission'];
	include 'functions/spam_func.php'; //runs submission through spam detection
	$submission = trim(preg_replace('/\s+/', ' ', $submission));//trim whitespace tabs
	$submission = ltrim($submission); //trim leading space
	$submission_lower = strtolower($submission);//converts to lower case for md5 creation
	$submission_nospec = preg_replace('/[^0-9a-zA-Z_]/',"",$submission_lower);//removes all space and special chars for md5
	include 'functions/check_ip.php';//checks ip
	$name = $_POST['name'];//imports name variable from input

	//error for empty input
	if ($submission === '') {
                echo 'You entered an empty input!</br>';
                echo 'You shall now die.</br>';
                echo 'Now go back and remember this as your last vision</br>';

		exit();
        }


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

	//calls the function to pull a random database entry
	include "/var/www/blackhole/functions/random_func.php";
?>


<!DOCTYPE html PUBLIC "-//W2C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv='Content-Type' content='text/html; charset=UTF-8' />
	<title>Black Hole of the Internet</title>
	<link rel='stylesheet' type='text/css' href='css/gumby.css' />
	<link rel='stylesheet' type='text/css' href='css/style.css' />
</head>

<body>
	<div class="success alert">Thank you for your submission!</div></br></br>
	<div class="response">
		<div class="response2">
			</br>
			<div class="random_text">
				<h6>From the ether you see these words:</br></br>
				<?php printf("<i>'".$row[1]."'</i>");
					echo "</br></br>Said by: ";
					printf($row[2]);
					$result->close();
	 			?></h6>
			</div>
			<div class="random_button">
				<div class="large primary btn"><a href="random.php">See Another Random Entry</a></div>
			</div>
		</br></br>

		<div class="links">
			<a href="index.html">  Home   </a>|
			<a href="about.html">  About  </a>|
			<a href="feedback.html">   Feedback   </a>
		</div>
		</div>
	</div>

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-42406702-1', 'blackholeoftheinternet.com');
  ga('send', 'pageview');

</script>
</body>
</html>
