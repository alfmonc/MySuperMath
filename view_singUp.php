<?php
require_once('connect.php');   // Call the connection file so it connect to the data base.




	
	if(isset($_POST['userName'])) {
	

//	echo "Bcryp: ";
	$pass = strip_tags($_POST['password']);
	$hash = password_hash($pass, PASSWORD_DEFAULT);
	$name = strip_tags($_POST['userName']);
	
	
	
	
	$email = strip_tags($_POST['email']);
	
	/*
	if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		$emailErr = "Invalid email format";
	}
	*/
	
	
	
	
	
	
	////////////////   Uploading userName and password
	
	
	
	// '".$hash."'  si se usara directo
    // Se puede usar ? o :placeholder pero sin comillas.  No se pueden combinar, no usar ambos en la misma query.
	try {  $user_database=$db->prepare("INSERT INTO alfmonc_mysupermath.math_user (user_name, password, email) VALUES (?,?,?)");
			
	//INSERT INTO `alfmonc_mysupermath`.`math_user` (`user_id`, `user_name`, `password`, `user_level`, `activated`, `wrong_answers`) VALUES (NULL, '', '', '', '0', '');
	
	// $user_database->bindParam(':name', $name);  si se usara con :name placeholder.
	$user_database->bindParam(1, $name);
	$user_database->bindParam(2, $hash);
	$user_database->bindParam(3, $email);
	
	
	$user_database->execute();   //  execute prepare  if not specified prepare will not apply.
	
	} catch (PDOException $e) {echo "Data could not".$e->getMessage();}


	// errorInfo is the default error array given by prepare or query  with the PDO object
	// errirInfo gives you an array with 3 elemets, 0 element SQLSTATE error code, 1 elememtne Driver specific error code, 2 element Driver specific error message
		if($user_database->errorInfo()[0] == "23000") {    // Es el SQLSTATE error code
			
			print_r($user_database->errorInfo()[0]);
			print_r($user_database->errorInfo());
			
				if($user_database->errorInfo()[2] == "Duplicate entry '".$name."' for key 'user_name'") {
					
					echo "<p>Tu user name esta repetido </p>";
				}
				
				if($user_database->errorInfo()[2] == "Duplicate entry '".$email."' for key 'email'") {
						
					echo "<p>Tu email ya esta registrado </p>";
				}
		
			
		}  // End if
		else if($user_database->errorInfo()[0] != "00000"){
				echo "<p>No se que paso</p>";
				print_r($user_database->errorInfo());
		}  // End else if
		
	
	}  // End if  isset POST. Look all the way up
	

	
	
	
	
/*

	$options = [
			'cost' => 12;
	];
	echo password_hash("rasmuslerdorf", PASSWORD_BCRYPT, $options)

*/



?>








<!DOCTYPE>
<html>
<head>


</head>


<body>

<!-- pattern="[A-Za-z]{5-20}" title="Five letter minimum required max 20" -->

<form id="form" action="view_singUp.php" method="POST" enctype="multipart/from-data">

Username: <input type="text" name="userName" maxlength="20" required /> <br />

email: <input type="email" name="email" maxlength="20" required /> <br />

Password: <input type="password" name="password" maxlength="20" required /> <br />

 


<input type="submit" value="Login" name="Submit" />


</form>




</body>




</html>







