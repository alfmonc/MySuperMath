<?php


	// No dejar espacios entre por ejemplo host = 50.... o dbname = mydatabase estos espacios no generan error statment y parece que
	// se hubiera hecho la coneccion.
	$db_host_names = "mysql:dbname=alfmonc_mysupermath;host=50.87.144.187";
	$user="alfmonc_math";
	$password="math78";

	

	try {

		$db = new PDO($db_host_names,$user,$password);
			
		echo "Woo-hoo!". "<br />";
				
		} 	catch(PDOException $e) { echo "Could not connect ". $e->getMessage();     
								  exit(); 
								}
	
		
		
	
	try {
	//$numbers = $db->query("SELECT user_numbers FROM math_user WHERE user_id = 1"); 
	$numbers=$db->query("SELECT * FROM math_user"); 
	} catch (Exception $e) {echo "Data could not";}
	

	echo $numbers->rowCount().'<br />';
	
	echo var_dump($numbers).'<br />';
	
	$data = $numbers->fetch(PDO::FETCH_ASSOC);
	
	echo '<pre>';
	echo var_dump($data).'<br />';
	
	echo $data["user_numbers"].'<br />';
	
	
		
	//fetch es para una fila, la primera solamente, fetchAll es para todas las filas obtenidas.
	//$data = $numbers->fetchAll(PDO::FETCH_ASSOC); 
	//echo '<pre>';
	//echo var_dump($data).'<br />';
	//echo $data[0]["user_numbers"].'<br />';
	
	
	
	////////////////////////////////////////////////////////////////////////////////////
	
	
	// Otros estilos de fetch:
	//$numbers = $db->fetch(PDO::FETCH_ASSOC);
	//$data = $numbers->fetch(PDO::FETCH_NUM);
	//print_r("PDO::FETCH_BOTH");
	
	/////////////////////////////////////////////////////////////////////////////////////
	
	//Para ver los errores:
	//var_dump($sth->errorInfo());
	
	
	
	
	
?>
	