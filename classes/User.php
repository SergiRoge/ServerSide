 <?php
 include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\classes\SQLObject.php');
class User extends SQLObject
{
	private $UserName;
	private $Email;
	private $Password;
	
	private $ItemList = array();
	
	
	function __construct($pUserName,$pPassword,$pEmail) 
	{
		$this->UserName = $pUserName;
		$this->Email = $pEmail;
	    $this->Password = $pPassword;
	}
	function saveUser()
	{
		$strQuery = "INSERT INTO tUsers(UserName,Password,Email) VALUES('$this->UserName','$this->Password','$this->Email')";	
		$strSQL_result = parent::ExecuteQuery($strQuery);
		return $strSQL_result;
	}
	
	function checkUser()
	{
		$strQuery = "SELECT UserName FROM tUsers WHERE Email = '$this->Email' AND Password = '$this->Password' ";	
		
		$strSQL_result = parent::ExecuteQuery($strQuery);		
		
		$data = $strSQL_result->fetch_array(MYSQLI_ASSOC);
		
		$arr = array('UserName' => $data["UserName"]);

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
		
	
	
	}
	
}

?> 