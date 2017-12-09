<?php

	require_once('api_keys.php');
	require_once('globals_api.php');
	

	// Check for login request with key
	if(isset($_GET['key']) || !empty($_GET['key'])){
		
		$key = $_GET['key'];
		
		// Check for login POST request
		$postdata = file_get_contents("php://input");
		if (isset($postdata) || !empty($postdata)) {

			$request = json_decode($postdata);
			$_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);
			
				if($key === login_key){
			
                    $username = trim($request->username);
                    $password = rim($request->password);
					
					// Execute login function
					$logged_in = login($pdo, $username, $password);

					if($logged_in){
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
	
 
