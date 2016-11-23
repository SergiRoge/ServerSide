 <?php



	
	$date = new DateTime('2001/01/03');
	echo "fecha normal : " . $date->format('Y/m/d');
	echo "<br>";
	echo "timestamp con segundos : " . $date->getTimestamp();
	$formatDate = new DateTime($date->format('Y/m/d'));
	echo "<br>";
	echo "fecha normal : " . $formatDate->format('Y/m/d');
	echo "<br>";
	echo "timestamp sin segundos ". $formatDate->getTimestamp();
	echo "<br>";
	
//	'2001/10/10' : 978303600 978390000
?>

