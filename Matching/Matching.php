<?php



//"C:\xampp\php\php.exe"
	include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\connection\connection.php');
	include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\classes\Item.php');

	include($_SERVER['DOCUMENT_ROOT'].'\TFG\ServerSide\Matching\Auxiliar.php');



			
			
			$connection = new Connection;
			
			$datetimearray =  getdate();
			$date = $datetimearray['mday']."/".$datetimearray['month']."/".$datetimearray['year'];
			$time = $datetimearray["hours"]."/".$datetimearray["minutes"]."/".$datetimearray["seconds"];
			
			$strQuery = "INSERT INTO tMatchingExecution (LastExecutionDate, LastExecutionTime) VALUES ('$date','$time')";
			
			
			$return = $connection->ExecuteQuery($strQuery);	
			

			//Start the matching algorithm
			//Tolerancia seran 6 decimales
			
			//itemStatus = 0 means that the itemLost is still on the matching process, for those which have itemStatus = 1, means that 
			//have already retrieved to the user who lost it
			
			
			//Devolvemos las coordenadas del itemLost tambien, nos devolverá 1, 2 o 3 filas, dependiendo del numero de coordenadas
			$strSQLLostItems = "SELECT I.Description, I.ID, I.UserID, I.Type, I.Brand, I.Material, I.Color, I.WhenDate, I.RegisterDate FROM tItems I WHERE I.itemStatus = 0 AND I.foundlost = 'Lost' " ;
			
			$connection = new Connection;
			$return = $connection->ExecuteQuery($strSQLLostItems);	
			//echo "---> " . $strSQLLostItems;
			
			$aux = new Auxiliar();
			
			$i = 0;
			//Para cada uno de los items que se han perdido
			try {

				while ($data = $return->fetch_array(MYSQLI_ASSOC)) 
				{
					
					$itemLost = new Item($data['Type'], $data['Brand'], $data['Material'], $data['Color'], $data['WhenDate'], "Lost", $data['Description']);
					
					$itemLost->Status = 0;
					$itemLost->UserID = $data['UserID'];
					$itemLost->ID = $data['ID'];
					
					
					$strSQLCoordsList = "SELECT XCoord, YCoord FROM tCoordinate WHERE IDItem = $itemLost->ID";
					$return2 = $connection->ExecuteQuery($strSQLCoordsList);	
					
					//Obtenemos todas las coordenadas del itemLost
					$CoordinatesList = array();
					while ($data2 = $return2->fetch_array(MYSQLI_ASSOC)) 
					{
						$XCoord = $data2['XCoord'];
						$YCoord = $data2['YCoord'];
						
						$CoordinatesList[] = $XCoord;
						$CoordinatesList[] = $YCoord;

					}					

					//Seteamos la lista de coordenadas
					$itemLost->CoordinatesList = $CoordinatesList;
					
					//En este punto tenemos el itemLost con sus coordenadas, ahora toca buscar items similares
					$i = $i + 1;
					$strSQLItemAttributes = "";
					
					
							
					echo " <br>---------------- ". $i ." itemLost id : " . $itemLost->ID . " --------------------- <br>";

				
					$strSQLType = $aux->construct_type_SQL($itemLost->ItemType);
					//echo "primer trozo : ", $strSQLItemAttributes;
					$strSQLBrand = $aux->construct_brand_SQL($itemLost->Brand);
					//echo "segundo trozo : ", $strSQLItemAttributes;
					$strSQLMaterial = $aux->construct_material_SQL($itemLost->Material);
					//echo "tercer trozo : ", $strSQLItemAttributes;
					$strSQLColor = $aux->construct_color_SQL($itemLost->Color);
					//echo "caurto trozo : ", $strSQLItemAttributes;
					$strSQLDate = $aux->construct_date_SQL($itemLost->When, $itemLost->RegisterDate);
	
					$strSQLFinalPart = " AND I.itemStatus = 0 AND I.foundlost = 'Found' AND I.UserID <> $itemLost->UserID ";
					
					
					
					
					//Este trozo de query, une todas las condiciones del WHERE
					$strSQL2 = $strSQLType . $strSQLBrand . $strSQLMaterial . $strSQLColor . $strSQLDate . $strSQLFinalPart;
					
					//Este trozo de query, mira que estos 2 items no esten en la tabla de items que no coinciden(Por si en el pasado han coincidido y se descartó por parte de algun usuario)
					$strSQL3 = " AND (SELECT COUNT(*) FROM tNonMatchingItems WHERE IDItemFound = $itemLost->ID) = 0 ";
					$strSQL4 = " AND (SELECT COUNT(*) FROM tMatchingItems WHERE IDItemFound = I.ID) = 0 ";
					$strSQL5 = " AND I.WhenDate <= $itemLost->When ";
					$strQuery = "SELECT I.ID As IDMatchingItem FROM tItems I WHERE " . $strSQL2 . $strSQL3 . $strSQL4 . $strSQL5;
					echo $strQuery;

					$return3 = $connection->ExecuteQuery($strQuery);	
					
					
					
					//En este punto tenemos los items que se parecen al nuestro
					while (( $return3 != null) and ($data3 = $return3->fetch_array()))
					{
						
						$IDItem = $data3['IDMatchingItem'];
						$strSQLCoordsList = "SELECT XCoord, YCoord FROM tCoordinate WHERE IDItem = $IDItem ";
						$return4 = $connection->ExecuteQuery($strSQLCoordsList);	
						
						echo "---Item similar : ITEMID --> " . $IDItem;

						
						//Obtenemos todas las coordenadas del itemLost para descartar los que por cercania no encajan
						$CoordinatesListFound = array();
						while ($data4 = $return4->fetch_array(MYSQLI_ASSOC)) 
						{
							$XCoord = $data4['XCoord'];
							$YCoord = $data4['YCoord'];
							
							$CoordinatesListFound[] = $XCoord;
							$CoordinatesListFound[] = $YCoord;
								
						}					

						if ($aux->coordinates_match($itemLost->CoordinatesList, $CoordinatesListFound) == 1)
						{
							//Si entro aqui, hemos encontrado un posible candidato
							$strQuery = "INSERT INTO tMatchingItems (IDItemLost, IDItemFound, Waiting) VALUES ($itemLost->ID, $IDItem, 1)";
							$connection->ExecuteQuery($strQuery);
							echo "encaja";
							
							
						}
						else
						{
							$strQuery = "INSERT INTO tNonMatchingItems (IDItemLost, IDItemFound) VALUES ($itemLost->ID, $IDItem)";
							$connection->ExecuteQuery($strQuery);

							echo "no encaja";
							//Si entramos aqui, lo añadimos a la tabla de descartes tNonMatchingItems 
						}
						
						
					}
					
					
					
					
					
					//$item = new Item($Type, $Brand, $Material, $Color, $When, $FoundLost, $Description);
					//$item->retrieveCoordinateList($data["ID"]);
					
					//$this->ItemList[] = $item->json_encode_item();

				
			}
		} 
		catch (Exception $e) 
		{
			echo 'Excepción capturada: ',  $e->getMessage(), "\n";
		} 

?>