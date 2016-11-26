<?php
	include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\connection\connection.php');
	 include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\classes\SQLObject.php');

	
	$Email  = "aaaa@gmail.com";
	//$Email = htmlspecialchars($_POST["email"]);

	$sqlObject = new SQLObject();
	
	$strSQL3 = "SELECT TOP 1 ID FROM tMatchingItems WHERE IDItemFound = (SELECT ID FROM tItems WHERE FoundLost = 'Found' AND UserID = (SELECT ID FROM tUsers WHERE email = " + $Email + " ))" ;
	
	$strSQL3 = "SELECT IDItemFound, IDItemLost FROM tMatchingItems WHERE IDItemFound = (SELECT ID FROM tItems WHERE FoundLost = 'Found' AND UserID = (SELECT ID FROM tUsers WHERE email = '$Email' ))";
	
	$strSQL_result = $sqlObject->ExecuteQuery($strSQL3);
	
	
	$array = array();
	while ($data = $strSQL_result->fetch_array(MYSQLI_ASSOC)) 
	{
		//echo " ---> " . $data['IDItemFound'] . " -- " . $data['IDItemLost'] .- "<br>";
		
		
		$array = ["IDItemFound" => $data['IDItemFound'], 'IDItemLost' => $data['IDItemLost']];
			
	}
							
							
	echo json_encode($array);
	//echo $array;
	
		
?>
