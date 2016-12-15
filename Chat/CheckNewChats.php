<?php
	include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\connection\connection.php');

	include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\classes\SQLObject.php');

	$Email = $_POST["email"];

	$sqlObject = new SQLObject;
	/*
	$strQuery = "SELECT Email, UserName FROM tUsers WHERE ID = (SELECT UserID FROM tChat WHERE OtherUserID = (SELECT ID FROM tUsers WHERE Email = '$Email') AND isNew = 1 )";

	$return = $sqlObject->ExecuteQuery($strQuery);	
	
	$array = array();
	while($data = $return->fetch_array(MYSQLI_ASSOC))
	{	
		$array[] = ["Email" => $data['Email'], "UserName" => $data['UserName']];
	}
	
	$strQuery = "UPDATE tChat SET isNew = 0 WHERE OtherUserID = (SELECT ID FROM tUsers WHERE Email = '$Email') ";

	$return = $sqlObject->ExecuteQuery($strQuery);	
	
	echo json_encode($array);
	//SELECT U.Email, U.UserName FROM tUsers U, tChat C WHERE C.OtherUserID IN (SELECT ID FROM tUsers WHERE Email = 'Email')


*/

	$strQuery = "SELECT Email, UserName FROM tUsers WHERE ID IN (SELECT UserID FROM tChat WHERE OtherUserID = (SELECT ID FROM tUsers WHERE Email = '$this->Email'))";
		
	$strSQL_result = sqlObject->ExecuteQuery($strQuery);		
	
	$ChatList = array();	

	while ($data = $strSQL_result->fetch_array(MYSQLI_ASSOC)) 
	{
		$ChatList[] = ["Email"=>$data["Email"], "UserName"=>$data["UserName"]];
			
	}
		
	$this->UserData[] = ["ChatList"=> $ChatList];
	
	echo json_encode($array);



?>