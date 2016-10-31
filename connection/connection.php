
<?php
include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\Auxiliar\Constants.php');

class Connection
{
	private $servername = "localhost";
	private $username = "root";
	private $password = "";
	private $database = "tfg";
	
	private $IDLastInsert;
	
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
		
		$this->IDLastInsert = mysqli_insert_id($conn);
		
		
		return $result;
	}
	
	
	function last_inserted_id()
	{
		return $this->IDLastInsert;
	}
		
}





?>
