<?php
	include '../vars.php';
        include '../secrets.php';
	include 'spam_func.php';

	//establish connection
 	$mysqli = new mysqli($host, $username, $password, $db_name);
	if ($mysqli->connect_error) {
    		die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
	}



	$query="SELECT id,text,spam_score FROM entry";
	if ($result = $mysqli->query( $query)) {

    		// select the one row that should have been returned
    		$result->data_seek(0);
    		// fetch row
		$row = $result->fetch_row();


	}

	//insert information into table "entry"
	$sql="UPDATE $table SET spam_score = $scr ;
	$result = mysqli_query($mysqli,$sql); 

	// close connection
	$mysqli->close();




?>
