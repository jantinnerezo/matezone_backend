<?php

	

	$data = array(
		'field1' => 1,
		'field2' => 2
	);
	$bytes = random_bytes(10);
	echo bin2hex($bytes);