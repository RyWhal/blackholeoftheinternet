<?php
	include '/var/www/blackhole/functions/random_func.php';
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
	<div class="info alert">You should consider making a submission!</div></br></br>
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
