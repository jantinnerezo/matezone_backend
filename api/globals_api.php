<?php

	require_once('../config/config.php');


	// Insert new user to database
	function signUp($pdo, $data){

		$random_id = random_bytes(10);
		$user_id = bin2hex($random_id);

		$date_created = Date('Y-m-d'); // Get date signed up

		try{

			// Sql query
			$sql = 'INSERT INTO tbl_users(user_id, lastname, firstname,img,username, password, email, birth_date,gender,location,date_created) VALUES(:user_id,:lastname, :firstname,:img,:username, :password, :email, :birth_date,:gender,:location,:date_created)';

			$stmt    = $pdo->prepare($sql); // Prepared statement
	        $stmt->bindParam(':user_id', $user_id, PDO::PARAM_STR);
	        $stmt->bindParam(':lastname', $data['lastname'], PDO::PARAM_STR);
	        $stmt->bindParam(':firstname', $data['firstname'], PDO::PARAM_STR);
	        $stmt->bindParam(':img', $data['img'], PDO::PARAM_STR);
	        $stmt->bindParam(':username', $data['username'], PDO::PARAM_STR);
	        $stmt->bindParam(':password', $data['password'], PDO::PARAM_STR);
	        $stmt->bindParam(':email', $data['email'], PDO::PARAM_STR);
	        $stmt->bindParam(':birth_date', $data['birth_date'], PDO::PARAM_STR);
	        $stmt->bindParam(':gender', $data['gender'], PDO::PARAM_STR);
	        $stmt->bindParam(':location', $data['location'], PDO::PARAM_STR);
	        $stmt->bindParam(':date_created', $date_created, PDO::PARAM_STR);
	        $stmt->execute();

	        return true;

		}
		catch(PDOException $e){
            return false;
        }

		
        

	}