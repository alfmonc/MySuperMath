<?php
session_start();
if(isset($_SESSION['id']))  {
	// Put stored session variables into local PHP variable
	$uid = $_SESSION['id'];
	$usname = $_SESSION['use'];
	$result = "Username: ".$usname. "<br /> Id: ".$uid;
} else {
	$result = "You are not logged in yet";
}

/*
 
session_start();

if (!(isset($_SESSION['login']) && $_SESSION['login'] != '')) {

header ("Location: login.php");

}

 */

?>

<!DOCTYPE html>
<html>
<head>
<title>Home</title>
<link rel="stylesheet" href="css/style_home.css">
</head>

<body>
	
	

	
	<header class="row">


			<p class= "col-8-16 sign"><em>My Super Math</em></p>
			
			<img class="mainIcon" src="img/mysupermath.png" />
			
	</header>


	<p class="logout" >Click here to </p>
	
	<a class="link" href="logout.php">logout</a>
	
	<p class="practice" >Click here to practice facts.</p>
	
	<a class="link center_button" href="view_addition.php">Practice addition facts</a>
	
	<a class="link center_button disabled" href="#">Practice substraction facts</a>
	
	<a class="link center_button disabled" href="#">Practice multiplication facts</a>
	
	<a class="link center_button disabled" href="#">Practice division facts</a>
	
	
	
	
	
	
</body>



<?php echo $result; ?>

</body>

</html>