 <?php
 include('C:\xampp\htdocs\TFG\ServerSide\classes\SQLObject.php');
class User extends SQLObject
{
	private $UserName;
	private $Email;
	private $Password;
	
	
	
	
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
	
	
}

?> 