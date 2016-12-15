 <?php
include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\classes\Item.php');

class User extends SQLObject
{
	private $UserName;
	private $Email;
	private $Password;
	
	private $UserData = array();
	
	private $Chats = array();
	
	private $Data = array();
	
	
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
	
	
	
	
	function GetUserData()
	{




		
		$strQuery = "SELECT I.ID As ID, I.type As Type, I.brand As Brand, I.material As Material, I.color As Color, I.whenDate As WhenDate, I.foundlost As FoundLost, I.Description As Description FROM tItems I WHERE I.UserID = (SELECT ID FROM tUsers WHERE Email = '$this->Email') AND I.itemStatus = 0";								
							
		$strSQL_result = parent::ExecuteQuery($strQuery);	
		
		

		$this->UserData[] = ["UserName" => $this->UserName];		
				
		
		$ItemList = array();
			
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
			
			$ItemList[] = $item->json_encode_item();
		}
		$this->UserData[] = ["ItemList" => $ItemList];
		
		
		

		//Cogemos los chats que iniciamos nosotros, es decir, de los items que hemos encontrado
		$strQuery11 = "SELECT Email, UserName As OtherUserID FROM tUsers WHERE ID IN (SELECT OtherUserID FROM tChat WHERE UserID = (SELECT ID FROM tUsers WHERE Email = '$this->Email'))";
		
		$strSQL_result11 = parent::ExecuteQuery($strQuery11);
		
		
		$ChatList = array();

		while ($data = $strSQL_result11->fetch_array(MYSQLI_ASSOC)) 
		{
			$ChatList[] = ["ChatEmail"=>$data["Email"], "ChatUserName"=>$data["OtherUserID"]];
			
		}
		
		
		//Cogemos los chats iniciaron otros usuarios, de los items que perdimos nosotros
		$strQuery11 = "	SELECT Email, UserName As OtherUserID FROM tUsers WHERE ID IN (SELECT UserID FROM tChat WHERE OtherUserID = (SELECT ID FROM tUsers WHERE Email = '$this->Email'))";
		
		$strSQL_result11 = parent::ExecuteQuery($strQuery11);
		
		

		while ($data = $strSQL_result11->fetch_array(MYSQLI_ASSOC)) 
		{
			$ChatList[] = ["ChatEmail"=>$data["Email"], "ChatUserName"=>$data["OtherUserID"]];
			
		}
		
		$this->UserData[] = ["ChatList"=> $ChatList];
		
		
		
		
		//$this->ItemList[0] = ["chat"=> "".$counter];
		//for ($i = 1; $i < $counter; $i++) 
		//{
		//	$this->ItemList[$i] = $array[$i];
		//}
		//$this->ItemList = $array;	

		
		
		
		
		
		
		//return json_encode($this->ItemList);
		return $this->UserData;
		//echo $this->ItemList;
		
		
		
		
	
	
	}
	
}

?> 