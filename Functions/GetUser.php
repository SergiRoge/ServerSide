<?php
	
	include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\connection\connection.php');
	include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\classes\User.php');
	
	
	$UserName = "";		
	$Password = "aaaa";
	$Email = "aaaa@gmail.com";
	
	$Email = $_POST["email"];
	$Password = $_POST["password"];
	
	$EncryptedPassword = hash(ENCRYPTION_ALGORITHM ,$Password );

	/**
	*	Creating the User object
	*/
	$user = new User($UserName, $EncryptedPassword, $Email );
	
	$UserName = $user->checkUser();
	if($UserName = "")
	{
		$arr = array('UserName' => "");
		echo json_encode($arr);	
	}
	else
	{
	
		$JSON_User_Data = $user->GetUserData();
		
		echo json_encode($JSON_User_Data);
				
		
	}

?>