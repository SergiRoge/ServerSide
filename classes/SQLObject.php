 <?php
class SQLObject
{
	
	private $URL;
	
	
	
	function ExecuteQuery($strQuery)
	{
		/**
		*	Creating the connection with de database
		*/
		$connection = new Connection;
		$return = $connection->ExecuteQuery($strQuery);			
		
		return $return;
	}	
	
	
	
	
}

?> 