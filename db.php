<?php  

	
	$host = 'localhost';
	$user = 'root';
	$pass = 'root';
	$db = 'profiles';

	$conn = mysqli_connect($host, $user, $pass, $db);

	if(!$conn){
		die('Failed to connect to Database : ' . mysqli_connect_error());
	}

?>