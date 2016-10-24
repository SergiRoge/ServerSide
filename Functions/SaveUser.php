<?php
	
	include('C:\xampp\htdocs\TFG\ServerSide\connection\connection.php');
	include('C:\xampp\htdocs\TFG\ServerSide\classes\User.php');
	
	
	$UserName = "pepe";		
	$Password = "pepe";		
	$Email = "pepe";
	
	
	$UserName = htmlspecialchars($_POST["name"]);
	$Password = htmlspecialchars($_POST["password"]);
	$Email = htmlspecialchars($_POST["email"]);
	
	/**
	*	Creating the User object
	*/
	$user = new User($UserName, $Password, $Email );
	          
	$return = $user->saveUser();
	echo $return;
	
	
	/*
	
	if(function_exists($_POST['f'])) 
	{
		$b = $_POST['b'];
		$a = $_POST['a'];
		$_POST['f']($a,$b);
	}
	else
	{
		/**
	*	Includes and Imports
	*/
	/*include('C:\xampp\htdocs\TFG\ServerSide\connection\connection.php');
	include('C:\xampp\htdocs\TFG\ServerSide\classes\User.php'); ///TFG/classes/User.php

	/**
	*	Getting all the data from the client side
	*/
 
	
	
	//echo $a;

	//something.com/myscript.php?f=hola	
	/*}

		//http://localhost/TFG/ServerSide/Functions/SaveUser.php?f=hola&a=a&b=b
	function hola($a,$b)
	{
	//$UserName = htmlspecialchars($_POST["name"]);
	//$Password = htmlspecialchars($_POST["password"]);
	//$Email = htmlspecialchars($_POST["email"]);
		

	$UserName = "pepe";		
	$Password = "pepe";		
	$Email = "pepe";
	/**
	*	Creating the User object
	*/
	/*$user = new User($UserName, $Password, $Email );
	          
	$user->saveUser();	  
	}
*/
?>
