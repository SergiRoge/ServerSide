<?php
	include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\connection\connection.php');
	 include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\classes\SQLObject.php');

	
	$Email  = "aaaa@gmail.com";
	//$Email = htmlspecialchars($_POST["email"]);

	$sqlObject = new SQLObject();
	
	$strSQL3 = "SELECT TOP 1 ID FROM tMatchingItems WHERE IDItemFound = (SELECT ID FROM tItems WHERE FoundLost = 'Found' AND UserID = (SELECT ID FROM tUsers WHERE email = " + $Email + " ))" ;
	
	$strSQL3 = "SELECT MI.IDItemFound, MI.IDItemLost FROM tMatchingItems MI, tItems I WHERE IDItemFound = (SELECT ID FROM tItems WHERE FoundLost = 'Found' AND UserID = (SELECT ID FROM tUsers WHERE email = '$Email' ))";
	
	
	$strSQL3 = "SELECT MI.IDItemFound, MI.IDItemLost, (SELECT I.Description WHERE I.ID = MI.IDItemFound) As Description FROM tMatchingItems MI, tItems I WHERE IDItemFound = I.ID AND I.UserID = (SELECT ID FROM tUsers WHERE email = '$Email')";
	
	
	$strSQL3 = "SELECT MI.ID, MI.IDItemFound, MI.IDItemLost FROM tMatchingItems MI, tItems I WHERE MI.IDItemFound = I.ID AND Waiting = 1 AND I.UserID = (SELECT ID FROM tUsers WHERE email = '$Email') ";
	$strSQL_result = $sqlObject->ExecuteQuery($strSQL3);
	
	
	$array = array();
	while ($data = $strSQL_result->fetch_array(MYSQLI_ASSOC)) 
	{
		
		$ItemID = $data['IDItemLost'];
		
		$strSQL = " SELECT Type, Color, Material, Description FROM tItems WHERE ID = '$ItemID' ";
		$strSQL_result2 = $sqlObject->ExecuteQuery($strSQL);
		while ($data2 = $strSQL_result2->fetch_array(MYSQLI_ASSOC)) 
		{
			$array = ["IDItemFound" => $data['IDItemFound'], 
						'IDItemLost' => $data['IDItemLost'], 
						'Type' => $data2['Type'],
						'Color' => $data2['Color'],
						'Material' => $data2['Material'],
						'Description' => $data2['Description'],		
						'RowID' => $data['ID'],						
						];
		}
		//echo " ---> " . $data['IDItemFound'] . " -- " . $data['IDItemLost'] .- "<br>";
		
		
		
			
	}
							
							
	echo json_encode($array);
	//echo $array;
	
		
?>
