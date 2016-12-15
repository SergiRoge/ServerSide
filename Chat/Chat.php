 <?php

class Chat extends SQLObject
{
	public $UserID;
	public $OtherUserID;
	
	public $UserEmail;
	public $UserUserName;
	
	public $OtherUserEmail;
	public $OtherUserUserName;	
	
	function __construct($pUserID, $pOtherUserID) 
	{
		$this->UserID = $pUserID;
		$this->OtherUserID = $pOtherUserID;
		
	}

	
	
	
	
	

	
}

?> 