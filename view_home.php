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
</head>
	<p>Click here to <a href="logout.php">logout</a></p>
	<p>Click here to practice <a href="view_addition.php">addition</a> facts.</p>
	
<body>



<?php echo $result; ?>

</body>

</html>