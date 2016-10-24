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
		$return = parent::save($strQuery);
		return $return;
	}
	
	
}

?> 