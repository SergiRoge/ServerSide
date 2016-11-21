 <?php
include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\classes\Coordinate.php');

class Item extends SQLObject
{
	public $ItemType;
	public $Brand;
	public $Material;
	public $Color;
	public $When;
	public $FoundLost;
	public $Status;
	public $Description;
	
	public $UserID;
	
	public $RegisterDate;
	
	public $ID;
	
	public $CoordinatesList;
	
		

		
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
		
		$date = new DateTime();
		$formatDate = new DateTime($date->format('Y/m/d'));			
		$this->RegisterDate = $formatDate->format('Y/m/d');
	}
	
	
	function saveItem($pEmail)
	{

		
		//Prepare the query
		$strQuery = " INSERT INTO tItems(UserID,foundlost,type,color,brand,material,whenDate,itemStatus, Description, RegisterDate)". 
					" VALUES".
					" ((SELECT ID FROM tUsers WHERE Email = '$pEmail'),'$this->FoundLost','$this->ItemType','$this->Color','$this->Brand','$this->Material','$this->When','$this->Status', '$this->Description', '$this->RegisterDate')";	
		
		$strSQL_result = parent::ExecuteQuery($strQuery);
		
		//Getting the ID of the inserted item
		$this->ID = parent::last_inserted_id();
		
		//If the item saved succesfully, we proceed to save the coords
		if($strSQL_result == 1)
		{
			//For each coordinate in the list, we save it
			for ($i = 0; $i < count($this->CoordinatesList); $i = $i + 1) 
			{				
				$coord = $this->CoordinatesList[$i];
				$strSQL_result = $coord->saveCoord($this->ID);
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
	
	

	
}

?> 