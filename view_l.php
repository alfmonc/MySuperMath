<?php 
ob_start();
session_start();
require_once('connect.php');   // Call the connection file so it connect to the data base.

	


	if(isset($_POST['userName'])) {

		
	$pass = strip_tags($_POST['password']);
	$user_name = strip_tags($_POST['userName']);
	
	try {  $user_database=$db->prepare('SELECT * FROM math_user WHERE user_name=? LIMIT 1');   
	
//	$user_database->bindParam(1, $pass);
	$user_database->bindParam(1, $user_name);
	
	$user_database->execute();   //  execute prepare  if not specified prepare will not apply.
	
	} catch (Exception $e) {echo "Data could not";}
	
	
	
	
	$user_information = $user_database->fetch(PDO::FETCH_ASSOC);
	
	
	
	$dbPassword = $user_information['password'];
	
	
	/*
	echo var_dump($dbPassword); 
	echo var_dump($user_information['user_id']);
	exit;
	*/
	
	if(password_verify($pass,$dbPassword)) {
	
		
		$_SESSION['use'] = $user_information['userName'];
		
		$_SESSION['id'] = $user_information['user_id'];
		
		header("Location: view_home.php");
		
		echo "<h2>You are loged in.</h2>";
	
		
	} else {
		
	echo "<h2>Oops that username or password combination was incorrect.<br /> Please try again.</h2>";
		
	
	}  // end else
	
	
	
}  // end if
	
	
	//	echo '<pre>'; echo var_dump($_SESSION['facts_array']);exit;   // Trouble shoot .
	
?>



<!DOCTYPE html>

<html>

<head>


<title>Basic login system</title>





<link rel="stylesheet" href="css/style_form.css">







</head>





<body>

<div id="wrapper">

<h1>Enter your username and password</h1>

<form id="form" action="view_l.php" method="POST" enctype="multipart/from-data">

<label for = "userName">Username:</label>
<input type="text" id ="userName" name="userName" maxlength="20" required /> <br />

<label for = "password">Password:</label>
<input type="password" id = "password" name="password" maxlength="20" required /> <br />

<button type="submit" value="Login" name="Submit">Login</button>



</form>


</div>




</html>