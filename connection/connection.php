
<?php
include('C:\xampp\htdocs\TFG\ServerSide\Auxiliar\Constants.php');

class Connection
{
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $database = "tfg";
	
	
	function ExecuteQuery($pstrQuery)
	{

	
		// Create connection
		$conn = new mysqli($this->servername, $this->username, $this->password, $this->database);
	
		// Check connection
		if ($conn->connect_error) 
		{
			die("Connection failed: " . $conn->connect_error);
		}
		if (!$result = $conn->query($pstrQuery)) 
		{
			
			return $conn->errno;
			exit;
		}	

		
		
		return $result;
	}
	
		
}





?>
