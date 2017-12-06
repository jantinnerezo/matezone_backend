<?php


	require_once('globals_api.php');

	// Check for signup POST request
	if(isset($_POST['signup_post_request'])){

		// Filter POST request inputs
		$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);


        $data = array(
        	'lastname' => trim($_POST['lastname']),
        	'firstname' => trim($_POST['firstname']),
        	'img' => trim($_POST['img']),
        	'username' => trim($_POST['username']),
        	'password' => trim($_POST['password']),
        	'email' => trim($_POST['email']),
        	'birth_date' => trim($_POST['birth_date']),
        	'gender' => trim($_POST['gender']),
        	'location' => trim($_POST['location']),
        );

       
		// Execute sign up function
		$signed_up = signUp($pdo, $data);

		if($signed_up){

		}else{

		}

	}else{

		echo 'This page is not accessible';
		exit();
	}

