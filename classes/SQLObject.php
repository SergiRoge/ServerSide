 <?php



 
class SQLObject
{
	
	private $URL;
	private $connection;
	
	
	function ExecuteQuery($strQuery)
	{
		/**
		*	Creating the connection with de database
		*/
		$this->connection = new Connection;
		$return = $this->connection->ExecuteQuery($strQuery);			
		
		return $return;
	}	
	
	
	function last_inserted_id()
	{
		return $this->connection->last_inserted_id();
	}
	
	
	
	
}

?> 