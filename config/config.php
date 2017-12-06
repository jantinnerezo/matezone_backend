<?php
	
	$server = 'localhost'; // server address

	// Define global variables
	define('ROOT_URL', 'http://'.$server.'/matezone'); // App root directory
	define('DB_SERVER', $server); // Database server
	define('DB_NAME', 'matezone_db'); // Database name
	define('DB_USERNAME', 'janerz2018'); // Database username
	define('DB_PASSWORD', 'AhfqiOXyhA3fKjXv'); // Database password
	 


	// Connection to database using PHP Database Object (PDO) method
	try {
    	$pdo = new PDO("mysql:host=" . DB_SERVER . ";dbname=" . DB_NAME, DB_USERNAME, DB_PASSWORD);
    	$pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
  	}catch(PDOException $e) {
    	die("ERROR: Could not connect. " . $e->getMessage());
  	}

