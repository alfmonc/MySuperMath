<?php
session_start();session_destroy();
if(isset($_SESSION['username'])) {
	$msg = "You are now logged out";
} else {
	$msg = "<h2>Could not log you out</h2>";
}
?>

<!DOCTYPE html>
<html>
<head>

<title></title>
</head>
<body>
<?php echo $msg; ?><br/>
<p><a href="view_l.php">Click here</a> to return to our home page </p>
</body>
</html>
