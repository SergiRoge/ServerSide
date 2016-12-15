<?php

	include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\classes\SQLObject.php');
	include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\connection\connection.php');


	$Email = $_POST["email"];
	$OtherEmail = $_POST["otherEmail"];

	$sqlObject = new SQLObject;
	
	$strQuery = "INSERT INTO tChat (UserID, OtherUserID, isNew) VALUES ((SELECT ID FROM tUsers WHERE Email = '$Email'), (SELECT ID FROM tUsers WHERE Email = '$OtherEmail '), 1) ";

	$return = $sqlObject->ExecuteQuery($strQuery);	


	echo 1;


?>