 <?php
 include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\classes\Item.php');
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
		
		$this->UserName = $data["UserName"];
		return $this->UserName;

		
	}
	
	function GetItemList()
	{

							
		$strQuery = "SELECT I.ID As ID, I.type As Type, I.brand As Brand, I.material As Material, I.color As Color, I.whenDate As WhenDate, I.foundlost As FoundLost, I.Description As Description FROM tItems I WHERE I.UserID = (SELECT ID FROM tUsers WHERE Email = 'aaaa@gmail.com') AND I.itemStatus = 0";								
							
		$strSQL_result = parent::ExecuteQuery($strQuery);	
		
				
		$this->ItemList[] = ["UserName" => $this->UserName];		
			
		while ($data = $strSQL_result->fetch_array(MYSQLI_ASSOC)) 
		{
			
			
			$Type = $data["Type"];
			$Brand = $data["Brand"];
			$Material = $data["Material"];
			$Color = $data["Color"];
			$When = $data["WhenDate"];
			$FoundLost = $data["FoundLost"];
			$Description = $data["Description"];

			$item = new Item($Type, $Brand, $Material, $Color, $When, $FoundLost, $Description);
			$item->retrieveCoordinateList($data["ID"]);
			
			$this->ItemList[] = $item->json_encode_item();
		}
		//return json_encode($this->ItemList);
		return $this->ItemList;
		//echo $this->ItemList;
		
		
	
	
	}
	
}

?> 