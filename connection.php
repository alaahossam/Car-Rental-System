<?php

function Connect()
{
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "CAR_RENTAL";

	//Create Connection
	$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname,"3307") or die($conn->connect_error);

	return $conn;
}
?>



