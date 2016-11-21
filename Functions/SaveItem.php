<?php
	
	include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\Matching\Matching.php');

	


	$Email = "aaaa@gmail.com";
	$Type = "Pimiento";
	$Brand = "del piquillo";
	$Material = "pimiento";
	$Color = "Rojo";
	$When = 0;
	$FoundLost = "Lost";
	$Description = "Tipicas gafas RayBan";
	$NumOfCoords = 3;
	
	
	$Email = htmlspecialchars($_POST["user"]);
	$Type = htmlspecialchars($_POST["type"]);
	$Brand = htmlspecialchars($_POST["brand"]);
	$Material = htmlspecialchars($_POST["material"]);
	$Color = htmlspecialchars($_POST["color"]);
	$When = htmlspecialchars($_POST["when"]);
	$FoundLost = htmlspecialchars($_POST["foundLost"]);
	$Description = htmlspecialchars($_POST["description"]);
	$NumOfCoords = $_POST["coordsnumber"];
	
	

	
	$CoordinatesList = array();
	
	if($NumOfCoords >= 1)
	{
		$CoordinatesList[] = new Coordinate($_POST["coordX0"],$_POST["coordY0"]);		
	}
	
	if($NumOfCoords >= 2)
	{
		$CoordinatesList[] = new Coordinate($_POST["coordX1"],$_POST["coordY1"]);		
	}

	if($NumOfCoords >= 3)
	{
		$CoordinatesList[] = new Coordinate($_POST["coordX2"],$_POST["coordY2"]);
	}



	
	/**
	*	Creating the Item object
	*/
	
	//type=12&color=23&brand=34&material=56&when=4&description=asdasde123&status=Lost&coords=3&coordX0=41.3865&coordY0=2.1641&coordX1=42.5691&coordY1=47.468&coordX2=39.8754&coordY2=-41.7725
	
	$item = new Item($Type, $Brand, $Material, $Color, $When, $FoundLost, $Description);
	          
	$item->setCoordinateList($CoordinatesList);		  
	$return = $item->saveItem($Email);
	
	//If the item was saved properly, the matching algorithm will launch
	
	
	
	
	
	
	
	echo $return;
	
	

	
?>
