<?php

	require_once('../config/config.php');

	// Login user
	function login($pdo, $username, $password){

		$sql = 'SELECT* FROM tbl_users WHERE username = :username';
		
		// Prepare statement
		if($stmt = $pdo->prepare($sql)){

			 // Bind params
			 $stmt->bindParam(':username', $username, PDO::PARAM_STR);

			 // Attempt execute
			 if($stmt->execute()){
				  // Check if email exists
				  if($stmt->rowCount() === 1){
					if($result = $stmt->fetch()){
						$hashed_password = $result->password;
						if(password_verify($password, $hashed_password)){
						  // SUCCESSFUL LOGIN
						  // Store user data to array and convert to 
						} else {
						  // Display wrong password message
						  $password_err = 'The password you entered is not valid';
						}
					  }
				  }else{

				  }

			 }else{

			 }

		}else{

		}


	}
	// Insert new user to database
	function signUp($pdo, $data){

		$random_id = random_bytes(10);
		$user_id = bin2hex($random_id);

		$date_created = Date('Y-m-d H:i:s'); // Get date signed up
		$password = password_encrypter($data['password']); // encrypt password

		try{

			// Sql query
			$sql = 'INSERT INTO tbl_users(user_id, lastname, firstname,img,username, password, email, birth_date,gender,date_created) VALUES(:user_id,:lastname, :firstname,:img,:username, :password, :email, :birth_date,:gender,:date_created)';

			$stmt    = $pdo->prepare($sql); // Prepared statement
	        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	        $stmt->bindParam(':lastname', $data['lastname'], PDO::PARAM_STR);
	        $stmt->bindParam(':firstname', $data['firstname'], PDO::PARAM_STR);
	        $stmt->bindParam(':img', $data['img'], PDO::PARAM_STR);
	        $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
	        $stmt->bindParam(':password', $password, PDO::PARAM_STR);
	        $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
	        $stmt->bindParam(':birth_date', $data['birth_date'], PDO::PARAM_STR);
	        $stmt->bindParam(':gender', $data['gender'], PDO::PARAM_STR);
	        $stmt->bindParam(':date_created', $date_created, PDO::PARAM_STR);
	        $stmt->execute();

	        return true;

		}
		catch(PDOException $e){
            return false;
        }


	}


	// Check username if already exist
	function checkIfUsernameExist($pdo, $username){

		$sql = 'SELECT username FROM tbl_users WHERE username = :username';

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':username', $username, PDO::PARAM_STR);
		$stmt->execute();

		if($stmt->rowCount() === 1){
			return true;
		}else{
			return false;
		}

	}

	function checkEmailExist($pdo, $email){
		
		$sql = 'SELECT email FROM tbl_users WHERE email = :email';

		$stmt = $pdo->prepare($sql);
		$stmt->bindParam(':email', $email, PDO::PARAM_STR);
		$stmt->execute();

		if($stmt->rowCount() > 0){
			return true;
		}else{
			return false;
		}
		
	}

	function password_encrypter($password){

		$options = [
			'cost' => 12,
		];
		
		return password_hash($password, PASSWORD_BCRYPT,$options);
	}