<?php
session_start();


?>

<!DOCTYPE html>
<html>
<head>
</head>


<body>
	
	
	<p>Go <a href="view_home.php" >back</a> </p>
	
	<p>Click here to start practicing <a href="model.php" >Addition Facts</a> </p>
	
	
	<p>Click here to review your <a href="view_results.php" >Last Results</a> </p>
	

	<p>Your level is <?php $_SESSION['level']?>  </p>




</body>


</html>

