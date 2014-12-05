<?php 
	// No dejar espacios entre por ejemplo host = 50.... o dbname = mydatabase estos espacios no generan error statment y parece que
	// se hubiera hecho la coneccion.
	$db_host_names = "mysql:dbname=alfmonc_mysupermath;host=50.87.144.187";
	$user="alfmonc_math";
	$password="math78";
	
	try {
	$db = new PDO($db_host_names,$user,$password);

	} 	catch(PDOException $e) 
	
				{ echo "Could not connect ". $e->getMessage();
				  exit; }
	
	
?>