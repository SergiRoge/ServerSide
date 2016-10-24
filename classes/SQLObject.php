 <?php
class SQLObject
{
	
	private $URL;
	
	
	function save($strQuery)
	{
		/**
		*	Creating the connection with de database
		*/
		$connection = new Connection;
		$return = $connection->Save($strQuery);			
		
		
		
		
		
		
		return $return;
	}

	
	
	
}

?> 