<?php

class Auxiliar
{
	
	function __construct() 
	{
		
	}

	function construct_type_SQL($pstrValue)
	{
		
		$strQuery = " I.Type IN ";
		
		if( in_array($pstrValue , array("Bufanda", "Panuelo", "Pareo")) )
		{		
			$strQuery = $strQuery . " ('Bufanda', 'Panuelo', 'Pareo') ";
		}			
		elseif( in_array($pstrValue , array("Bolso", "Bolsa", "Mochila")) )
		{
			$strQuery = $strQuery . " ('Bolso', 'Bolsa', 'Mochila') ";
		}
		elseif( in_array($pstrValue , array("Zapato", "Bota", "Botin", "Sandalia", "Bamba", "Zapatilla")) )
		{
			$strQuery = $strQuery . " ('Zapato', 'Bota', 'Botin','Sandalia', 'Bamba', 'Zapatilla') ";
		}
		elseif( in_array($pstrValue , array("Chaqueta", "Abrigo", "Sudadera", "Jersey", "Anorak")) )
		{
			$strQuery = $strQuery . " ('Chaqueta', 'Abrigo', 'Sudadera', 'Jersey', 'Anorak') ";
		}
		elseif( in_array($pstrValue , array("Anillo", "Cadena", "Joya")) )
		{
			$strQuery = $strQuery . " ('Anillo', 'Cadena', 'Joya') ";
		}
		elseif( in_array($pstrValue , array("Libreta", "Libro", "Cuaderno", "Diario")) )
		{
			$strQuery = $strQuery . " ('Libreta', 'Libro', 'Cuaderno', 'Diario') ";
		}
		elseif( in_array($pstrValue , array("Movil", "Telefono", "Tablet")) )
		{
			$strQuery = $strQuery . " ('Movil','Telefono','Tablet') ";
		}
		else
		{
			$strQuery = " I.Type = '$pstrValue' ";
		}
		
		return $strQuery;
	
	}
	
	function construct_brand_SQL($pstrValue)
	{
		if($pstrValue == "")
		{
			return "";
		}
		else
		{
			return " AND I.Brand = '$pstrValue' ";
		}
		
	}
	
	/*
	*	$pstrWhen 	->	-1, unknown
	*				->	1, Today
	*				->	2, Yesterday
	*				->	3, 2 days ago
	*				->	4, A week ago
	*				->	5, A month ago
	*	$pstrDate 
	*/
	function construct_date_SQL($pstrWhen, $pstrDate)
	{
		if($pstrValue == -1)
		{
			return "";
		}
		else
		{	
	
				$date = new DateTime($pstrDate);
				$intDate = $date->getTimestamp();
	
			switch ($i) {
				//Today
			case 1:
				//Si se ha perdido hoy, todos los items registrados desde ayer no se deben comprobar
				$strQuery = " AND I.RegisterDate  ";
				echo "i es igual a 0";
				break;
				//Yesterday
			case 2:
				echo "i es igual a 1";
				break;
				//2 days ago
			case 3:
				//Si se ha perdido hace dos dias , todos los items registrados desde hace 2 dias no se deben comprobar
				echo "i es igual a 2";
				break;
				//A week ago
			case 4:
				echo "i es igual a 1";
				break;
				//A month ago
			case 5:
				echo "i es igual a 2";
				break;
}		
	
			if( in_array($pstrValue , array("Verde","Azul","Turquesa") ))
			{
				$strQuery = " AND I.Color IN  ('Verde', 'Azul', 'Turquesa') ";
			}		
			else
			{
				$strQuery = " AND I.Color = '$pstrValue' ";
			}
			return $strQuery;
		}
	}
	
	function construct_color_SQL($pstrValue)
	{
		if($pstrValue == "")
		{
			return "";
		}
		else
		{		
			if( in_array($pstrValue , array("Verde","Azul","Turquesa") ))
			{
				$strQuery = " AND I.Color IN  ('Verde', 'Azul', 'Turquesa') ";
			}		
			else
			{
				$strQuery = " AND I.Color = '$pstrValue' ";
			}
			return $strQuery;
		}
	}
	
	
	
	function construct_material_SQL($pstrValue)
	{
		if($pstrValue == "")
		{
			return "";
		}
		else
		{
			$strQuery = "AND I.Material IN ";
			
			if( in_array($pstrValue , array("Cemento", "Piedra", "Ladrillo", "Arcilla", "Ceramica") ))
			{
				$strQuery = $strQuery . " ('Cemento', 'Piedra', 'Ladrillo', 'Arcilla', 'Ceramica') ";
			}
			elseif( in_array($pstrValue , array("Hierro", "Aluminio", "Metal", "Acero", "Oro", "Plata", "Platino", "Bronce", "Cobre") ))
			{
				$strQuery = $strQuery . " ('Hierro', 'Aluminio', 'Metal', 'Acero', 'Oro', 'Plata','Platino', 'Bronce', 'Cobre' ) ";
			}
			elseif( in_array($pstrValue , array("Diamante", "Joya", "Perla", "reloj")))
			{
				$strQuery = $strQuery . " ('Diamante', 'Joya', 'Perla', 'reloj')";
			}			
			elseif( in_array($pstrValue , array("Tela", "Tejido", "Cuero", "Piel", "Algodon", "Poliester", "Seda", "Pana") ))
			{
				$strQuery = $strQuery . " ('Tela', 'Tejido','Cuero', 'Piel','Algodon','Poliester','Seda','Pana') ";
			}	
			elseif( in_array($pstrValue , array("Madera") ))
			{
				$strQuery = $strQuery . " ('Madera') ";
			}	
			elseif( in_array($pstrValue , array("Plastico") ))
			{
				$strQuery = $strQuery . " ('Plastico') ";
			}
			elseif( in_array($pstrValue , array("Cristal", "Vidrio") ))
			{
				$strQuery = $strQuery . " ('Cristal', 'Vidrio') ";
			}
			elseif( in_array($pstrValue , array("Papel", "Carton") ))
			{
				$strQuery = $strQuery . " ('Papel', 'Carton') ";
			}	
			else
			{
				$strQuery = " AND I.Material = '$pstrValue' ";
			}
			return $strQuery;		
		}		
	}
	function similar_coords($pCoord1, $pCoord2)
	{
		$tol = 0.00015;
		if (($pCoord1 - $pCoord2) < $tol)
		{
			return 1;
		}
		return 0;
	}
	
	function coordinates_match($lstLostCoordinates, $strFoundCoordinates)
	{


		for ($i = 0; $i < count($lstLostCoordinates); $i= $i + 2) 
		{
			//echo "for i : " . $i;
			for ($j = 0; $j < count($strFoundCoordinates); $j = $j + 2) 
			{
				//echo "for j : " . $j;
				
				if($this->similar_coords($lstLostCoordinates[$i],$strFoundCoordinates[$j]) and $this->similar_coords($lstLostCoordinates[$i+1],$strFoundCoordinates[$j+1]))
				{
					return 1;
				}
				
			}
				
			
			
		}
		
		return 0;
		
		
	}	
}



?>