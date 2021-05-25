<?php
	// Report all PHP errors (see changelog)
	error_reporting(E_ALL);
	
	$host = 'localhost'; // MYSQL database host adress
	$db = ''; // MYSQL database name
	$user = ''; // Mysql Datbase user
	$pass = ''; // Mysql Datbase password
	$callback_url = "http://www.yourdomain.co.uk/scan/?barcode=CODE&type=FORMAT";
	$homepage_url = "http://www.yourdomain.co.uk/scan/";
	
	// Connect to the database
	$link = mysqli_connect($host, $user, $pass, $db);
		
	// Check connection
	if (mysqli_connect_errno())
	  {
	  echo "Failed to connect to MySQL: " . mysqli_connect_error();
	  }
?>