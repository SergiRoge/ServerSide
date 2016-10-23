<?php

	/**
	*	Includes and Imports
	*/
	include('C:\xampp\htdocs\TFG\ServerSide\connection\connection.php');
	include('C:\xampp\htdocs\TFG\ServerSide\classes\User.php'); ///TFG/classes/User.php

	/**
	*	Getting all the data from the client side
	*/
	//$UserName = htmlspecialchars($_POST["name"]);
	//$Password = htmlspecialchars($_POST["password"]);
	//$Email = htmlspecialchars($_POST["email"]);
		

	$UserName = "pepe";		
	$Password = "pepe";		
	$Email = "pepe";
	/**
	*	Creating the User object
	*/

	$user = new User($UserName, $Password, $Email );
	          
	$user->saveUser();	   
	
	
	//echo $a;


?>
