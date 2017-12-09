<?php

	require_once('api_keys.php');
	require_once('globals_api.php');
	

	// Check for signup request with key
	if(isset($_GET['key']) || !empty($_GET['key'])){
		
		$key = $_GET['key'];
		

		// Check for signup POST request
		$postdata = file_get_contents("php://input");
		if (isset($postdata) || !empty($postdata)) {

			$request = json_decode($postdata);
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
	
				// Check username if already exist first
				if($key === check_username_key){

					
					if(checkIfUsernameExist($pdo, trim($request->username))){
						echo true;
					}else{
						echo false;
					}
				}
				
				// Check email if already exist
				if($key === check_email_key){

					$email = $_GET['email'];

					if(checkEmailExist($pdo, $email)){
						echo json_encode(true);
					}else{
						echo json_encode($email);
					}
				}

				if($key === signup_key){
				
					$data = array(
						'lastname' => trim($request->lastname),
						'firstname' => trim($request->firstname),
					//	'img' => trim($request->img),
						'username' => trim($request->username),
						'password' => trim($request->password),
						'email' => trim($request->email),
						'birth_date' => trim($request->birth_date),
						'gender' => trim($request->gender)
					);
					// Execute sign up function
					$signed_up = signUp($pdo, $data);

					if($signed_up){
						echo true;
					}else{
						echo false;
					}
				}
			


			}else{
				echo 'This page is not accessible';
				exit();
			}

		

	}
	else{
		echo 'API requires key';
		exit();
	}
	
 
