<?php

	//variable decleration
	include '../vars.php';
        include '../secrets.php';
	//variable import
	$ip = $_SERVER['REMOTE_ADDR'];

 	$mysqli = new mysqli($host, $username, $password, $db_name);
	if ($mysqli->connect_error) {
    		die('Connect Error (' . $mysqli->connect_errno . ') '. $mysqli->connect_error);
	}



	//select a random row from the table "entry"
	$query="SELECT id,text,name,spam FROM entry WHERE spam < 1 ORDER BY RAND() limit 1";
	if ($result = $mysqli->query( $query)) {

    		// select the one row that should have been returned
    		$result->data_seek(0);
    		// fetch row
		$row = $result->fetch_row();

		if ($row[2] == ''){
			$row[2]="Anonymous";
		}
	}



	// close connection
	$mysqli->close();

?>
