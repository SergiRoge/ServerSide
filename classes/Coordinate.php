 <?php

 include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\classes\SQLObject.php');
class Coordinate extends SQLObject
{
	public $XCoord;
	public $YCoord;
	

	function __construct($pXCoord,$pYCoord) 
	{
		$this->XCoord = $pXCoord;
		$this->YCoord = $pYCoord;
	}
	function saveCoord($pIDItem)
	{
		$strQuery = "INSERT INTO tCoordinate (IDItem, XCoord, YCoord) VALUES('$pIDItem','$this->XCoord','$this->YCoord')";	
		$strSQL_result = parent::ExecuteQuery($strQuery);
		return $strSQL_result;
	}

	
	function json_encode_coordinate()
	{		
		$array = ['XCoord' => $this->XCoord,'YCoord' => $this->YCoord];
		//return json_encode($array);
		return $array;
	}
	 
}

?> 