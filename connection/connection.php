
<?php
include('C:\xampp\htdocs\TFG\ServerSide\Auxiliar\Constants.php');

class Connection
{
	function ConnectToServer()
	{
		$servername = "localhost";
		$username = "root";
		$password = "";
	
		// Create connection
		$conn = new mysqli($servername, $username, $password);
	
		// Check connection
		if ($conn->connect_error) 
		{
			die("Connection failed: " . $conn->connect_error);
		}
		return OK;
	}
		
}





?>
