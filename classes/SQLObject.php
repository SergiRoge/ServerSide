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
		$a = $connection->Save($strQuery);			
		
		
		
		
		
		
		return 1;
	}

	
	
	
}

?> 