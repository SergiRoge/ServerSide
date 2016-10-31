<?php
	
	include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\connection\connection.php');
	include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\classes\User.php');

	//$UserName  ="pepe";
	///$Password  ="pepe";
	//$Email ="pepe";
	$UserName = htmlspecialchars($_POST["name"]);
	$Password = htmlspecialchars($_POST["password"]);
	$Email = htmlspecialchars($_POST["email"]);
	

	$EncryptedPassword = hash(ENCRYPTION_ALGORITHM ,$Password );
	
	/**
	*	Creating the User object
	*/
	$user = new User($UserName, $EncryptedPassword, $Email );
	          
	$return = $user->saveUser();
	
	echo $return;
	
?>
