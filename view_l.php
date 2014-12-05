<?php 
ob_start();
session_start();
require_once('connect.php');   // Call the connection file so it connect to the data base.

	


	if($_POST['use']) {

	try {  $user_database=$db->query('SELECT * FROM math_user');   } 
	catch (Exception $e) {echo "Data could not";}
	

	$user_information = $user_database->fetch(PDO::FETCH_ASSOC);
		
	

	$dbPassword = $user_information['password'];
	
	
	if($dbPassword == $_POST['pa']) {
	
		
		$_SESSION['use'] = $user_information['user_name'];

		$_SESSION['id'] = $user_information['user_id'];
		
		header("Location: view_home.php");
		
		
	
		
	} else {
		
	echo "<h2>Oops that username or password combination was incorrect.<br /> Please try again.</h2>";
		
	
	}  // end else
	
	
	
}  // end if
	
	
	
	// este es un trouble shooting
	
	echo "<h2>que putas pasa</h2>";
	
	echo '<pre>';
	echo var_dump($estado);
	echo var_dump($user_information);
	echo '</pre>';
		
	
	
	
?>



<!DOCTYPE html>

<html>

<head>


<title>Basic login system</title>



<style type="text/css">



html {

		font-family: Verdana, Geneva, sans-serif;

}



h1 {

	font-size: 24px;

	text-align: center;

}

#wrapper {

			position: absolute;

			width: 100%;

			top: 30%;

			margin-top: -50px; /* half of #content height*/

}

#form {

	margin: auto;

	widht: 200px;

	height: 100px;

	text-align: center;

}



</style>



</head>





<body>

<div id="wrapper">

<h1>Simple PHP Login</h1>

<form id="form" action="view_l.php" method="POST" enctype="multipart/from-data">

Use: <input type="text" name="use" /> <br />

Password: <input type="password" name="pa" /> <br />

<input type="submit" value="Login" name="Submit" />



</form>


</div>




</html>