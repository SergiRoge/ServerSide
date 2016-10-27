<?php
	
	include('C:\xampp\htdocs\TFG\ServerSide\connection\connection.php');
	include('C:\xampp\htdocs\TFG\ServerSide\classes\User.php');
	
	
	$UserName = "";		
	$Password = "aaaa";
	$Email = "aaaa@gmail.com";
	
	//$Email = $_POST["email"];
	//$Password = $_POST["password"];
	
	$EncryptedPassword = hash(ENCRYPTION_ALGORITHM ,$Password );

	/**
	*	Creating the User object
	*/
	$user = new User($UserName, $EncryptedPassword, $Email );
	
	$JSON_userName = $user->checkUser();	

	echo $JSON_userName;
	
?>