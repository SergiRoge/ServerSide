<?php
	
	include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\connection\connection.php');
	include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\classes\Item.php');



	

	$Email = "aaaa@gmail.com";
	$Type = "Gafas";
	$Brand = "RayBan";
	$Material = "Cristal";
	$Color = "Negro";
	$When = 0;
	$FoundLost = "Lost";
	$Description = "Tipicas gafas RayBan";
	$NumOfCoords = 3;
	
	
	/*
	$Email = htmlspecialchars($_POST["Email"]);
	$Type = htmlspecialchars($_POST["Type"]);
	$Brand = htmlspecialchars($_POST["Brand"]);
	$Material = htmlspecialchars($_POST["Material"]);
	$Color = htmlspecialchars($_POST["Color"]);
	$When = htmlspecialchars($_POST["When"]);
	$FoundLost = htmlspecialchars($_POST["FoundLost"]);
	$Description = htmlspecialchars($_POST["Description"]);
	$NumOfCoords = $_POST["Coords"];
	*/
	

	
	$CoordinatesList = array();
	
	for ($i = 0; $i < $NumOfCoords; $i++) 
	{
		//$coord = new Coordinate($_POST["coordX"+$i],$_POST["coordY"+$i]);
		//$coord = new Coordinate($i,$i);
		$CoordinatesList[] = $i ;
		$CoordinatesList[] = $i ;

	}

	
	/**
	*	Creating the Item object
	*/
	
	//type=12&color=23&brand=34&material=56&when=4&description=asdasde123&status=Lost&coords=3&coordX0=41.3865&coordY0=2.1641&coordX1=42.5691&coordY1=47.468&coordX2=39.8754&coordY2=-41.7725
	
	$item = new Item($Type, $Brand, $Material, $Color, $When, $FoundLost, $Description);
	          
	$item->setCoordinateList($CoordinatesList);		  
	$return = $item->saveItem($Email);
	
	
	echo $return;
	
	

	
?>
