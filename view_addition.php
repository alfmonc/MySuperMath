<?php
session_start();


?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="css/style_addition.css">
</head>


<body>
	
	
	<header class="row">


			<p class= "col-8-16 sign"><em>My Super Math</em></p>
			
			<img class="mainIcon" src="img/mysupermath.png" />
			
	</header>


	<a class="link back" href="view_home.php" >back</a>
	
	<p class="tags">Click here to start practicing  </p>
	
	<a class="link center_button" href="model.php" >Start</a>
	
	<hr/>
	
	<p class="tags">Click here to review your </p>
	
	<a class="link center_button" href="view_results.php" >Last Results</a>
	

	<p>Your level is <?php $_SESSION['level']?>  </p>




</body>


</html>

