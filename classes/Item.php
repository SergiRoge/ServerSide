 <?php
include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\classes\Coordinate.php');

class Item extends SQLObject
{
	private $ItemType;
	private $Brand;
	private $Material;
	private $Color;
	private $When;
	private $FoundLost;
	private $Status;
	private $Description;
	
	private $CoordinatesList;
	
						
	function __construct($pItemType, $pBrand, $pMaterial, $pColor, $pWhen, $pFoundLost, $pDescription) 
	{
		$this->ItemType = $pItemType;
		$this->Brand = $pBrand;
		$this->Material = $pMaterial;
		$this->Color = $pColor;
		$this->When = $pWhen;
		$this->FoundLost = $pFoundLost;
		$this->Description = $pDescription;
		$this->Status = 0;
		$this->CoordinatesList = array();
	}
	
	
	function saveItem($pEmail)
	{
		//Prepare the query
		$strQuery = " INSERT INTO tItems(UserID,foundlost,type,color,brand,material,whenDate,itemStatus, Description)". 
					" VALUES".
					" ((SELECT ID FROM tUsers WHERE Email = '$pEmail'),'$this->FoundLost','$this->ItemType','$this->Color','$this->Brand','$this->Material','$this->When','$this->Status', '$this->Description')";	
		
		$strSQL_result = parent::ExecuteQuery($strQuery);
		
		//Getting the ID of the inserted item
		$IDItem = parent::last_inserted_id();
		
		//If the item saved succesfully, we proceed to save the coords
		if($strSQL_result == 1)
		{
			//For each coordinate in the list, we save it
			for ($i = 0; $i < count($this->CoordinatesList); $i = $i + 2) 
			{				
				$coord = new Coordinate($this->CoordinatesList[$i],$this->CoordinatesList[$i+1]);			
				$strSQL_result = $coord->saveCoord($IDItem);
			}
		}
		return $strSQL_result;
	}
	
	function retrieveCoordinateList($pID)
	{
		
		$strQuery = "SELECT XCoord, YCoord FROM tCoordinate WHERE IDItem = '$pID'";								
					
		$strSQL_result = parent::ExecuteQuery($strQuery);	
		$i = 0;
		while ($data = $strSQL_result->fetch_array(MYSQLI_ASSOC)) 
		{
			$XCoord = $data["XCoord"];
			$YCoord = $data["YCoord"];
			
			$coordinate = new Coordinate($XCoord,$YCoord);
			$this->CoordinatesList[] = $coordinate->json_encode_coordinate();
			$i = $i + 1;
	
		}			
	}
	function json_encode_item()
	{		
		$array = ["ItemType" => $this->ItemType,
							'Brand' => $this->Brand,
							'Material' => $this->Material,
							'Color' => $this->Color,
							'When' => $this->When,
							'FoundLost' => $this->FoundLost,
							'Description' => $this->Description,
							'Status' => $this->Status,
							'CoordinatesList' => $this->CoordinatesList];
							
		//return json_encode($array);
			return $array;
							
	}
	
	//$pCoordinatesList format : [Xcoord1,Ycoord1,XCoord2,Ycoord2,XCoord3,YCoord3]
	function setCoordinateList($pCoordinatesList)
	{
		$this->CoordinatesList = $pCoordinatesList;
		
	}
	/*
	function GetCoordinateList($pItemID)
	{
		$strQuery = "SELECT C.XCoord As XCoord, C.YCoord As YCoord FROM tCoordinate C WHERE IDItem = '$pItemID'";	
		
		$strSQL_result = parent::ExecuteQuery($strQuery);		
		
		$data = $strSQL_result->fetch_array(MYSQLI_ASSOC);
		
		$arr = array('XCoord' => $data["XCoord"], 'YCoord' => $data["YCoord"]);

		return json_encode($arr);	
		
	}
	
	function GetItemList()
	{
		$strQuery  = "SELECT C.XCoord As XCoord, C.YCoord As YCoord,I.type As Type, I.brand As Brand, I.material As Material, I.color As Color, I.whenDate As When, I.foundlost As FoundLost
						FROM 
						tCoordinate C, tItems I 
						WHERE I.UserID = (SELECT ID FROM tUsers WHERE Email = '$this->Email') 
							AND I.itemStatus = 0";
							
							
		$strSQL_result = parent::ExecuteQuery($strQuery);	
		
		$array[] = "item";
		$array[$key] = "item";
		array_push($array, "item", "another item");
				
		while ($data = $strSQL_result->fetch_array(MYSQLI_ASSOC)) 
		{
			printf("ID: %s  Nombre: %s", $data["XCoord"], $data["nombre"]);
		}
	
		
		
		$arr = array('UserName' => $data["UserName"]);

		return json_encode($arr);	
		
	
	
	}*/
	
}

?> 