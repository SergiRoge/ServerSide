 <?php



	
	$date = new DateTime();
	echo "fecha normal : " . $date->format('Y/m/d');
	echo "<br>";
	echo "timestamp con segundos : " . $date->getTimestamp();
	$formatDate = new DateTime($date->format('Y/m/d'));
	echo "<br>";
	echo "fecha normal : " . $formatDate->format('Y/m/d');
	echo "<br>";
	echo "timestamp sin segundos ". $formatDate->getTimestamp();
	echo "<br>";
	
?>

