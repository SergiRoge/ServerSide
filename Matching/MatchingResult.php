<?php
	include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\connection\connection.php');

	 include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\classes\SQLObject.php');

	$result = htmlspecialchars($_POST["result"]);
	$rowID = htmlspecialchars($_POST["rowid"]);
	
	//$result="NO";
	//$rowID = 11;
	
	$strQuery = "";
	
	$sqlObject = new SQLObject;
	
	/*
	*	Si el resultado es YES, el item perdido coincide con el encontrado, actualizamos el waiting a 0, es decir, ya no espera, ya ha encontrado a su pareja
	*
	*	Sin embargo es NO, no han coincidido, ponemos la pareja de items, perdido y encontrado, en la tabla de items que no coincidieron tNonMatchingItems y eliminamos la entrada en la tabla tMatchingItems
	*/
	
	if($result == "YES")
	{
		$strQuery = "UPDATE tMatchingItems SET waiting = 0 WHERE ID = $rowID";
		$return = $sqlObject->ExecuteQuery($strQuery);	
	}
	else if($result == "NO")
	{
		
		
		$strQuery2 = "insert into tNonMatchingItems (IDItemLost, IDItemFound) SELECT IDItemLost, IDItemFound FROM tMatchingItems WHERE id = $rowID";
				
		$return = $sqlObject->ExecuteQuery($strQuery2);	

		$strQuery = "DELETE FROM tMatchingItems WHERE ID = $rowID";	
		
		$return = $sqlObject->ExecuteQuery($strQuery);	
	}
	
	
	
?>