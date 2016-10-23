<?php

	/**
	*	Includes and Imports
	*/
	include('C:\xampp\htdocs\TFG\ServerSide\connection\connection.php');
	include('C:\xampp\htdocs\TFG\ServerSide\classes\User.php'); ///TFG/classes/User.php

	/**
	*	Getting all the data from the client side
	*/
	$name = htmlspecialchars($_POST["name"]);
	$password = htmlspecialchars($_POST["password"]);
	$email = htmlspecialchars($_POST["email"]);
		
	/**
	*	Creating the connection with de database
	*/
	
	$connection = new Connection;
	$a = $connection->ConnectToServer();
	
	/**
	*	Creating the User object
	*/

	$user = new User;
	
	
	
	
	//echo $a;


?>
