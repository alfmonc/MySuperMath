<?php
session_start();

	echo nl2br("Hello this is view_results page.\n");
	echo "<br/>";
	echo "\n You have to practice ".$_SESSION['wrong_facts'];
	echo "<br/>";
	
	// if wrong_facts is not empty.
	if(!empty($_SESSION['wrong_facts'])){       // implode convert the array into a string using the , as reference to join elements.
		$myvar = implode(",", $_SESSION['wrong_facts']);   // Then it store the string in $myvar  variable.
		echo '<script> wrong_facts_string="'. $myvar . '"; </script>';  // we echo javascript code to store the string in the myarray variable.
	} else {
		$myvar = "";	
		echo '<script> wrong_facts_string="'. $myvar . '"; </script>';
	}
		echo '<script>var user_level="'.$_SESSION['level'].'"; </script>'; // We are not implode this array because it is just one parameter, is not array it is just a variable.
		
		echo '<script>var message= "'.$_SESSION['message'].'"; </script>';
		
	?>


<html>

  <head>
    <title>View Results</title>
    <meta charset="utf-8"/>
	<link rel="stylesheet" href="css/view_results_style.css">
  
  <script>
  
  
  // This function creates all the p elements, p elements contain the facts students can see on the page.
  function create_p_element(level) {  // This function accepts the level and automatically writes all the fields needed.
	
		var b = 10;
		var limit = 10 - level;
		var li = limit;
		var a = level;
		//var user_level = "2";
		
		
		// This loop creates the top row on each level.
		for (i=0; i < li; i++) { 	
			
			// If var level passed from parameter function is equal to var user_level passed from session super global, then;
			if( i >= (10-Number(user_level))  ){
			var theClass = "user_level";} else { var theClass = "not_user_level"; 	}  // End if.
			// The class to pass will be user_level   else   the class to pass will be not_user_level.
			
			
			var newP = document.createElement("p");   // Creates a new p element, is not visible, we need to apped it so is in the DOM.
			newP.setAttribute("class","col-1-16 "+theClass);    // Applies the class col-1-16 to the new element.
			var text = document.createTextNode(b+"+"+a);  // Creates a text node.
			newP.appendChild(text);                    // We append the text node in the new p element so it has some text.
			document.body.appendChild(newP);  // We append the new p element in the DOM so it gets visible.
			b--;                              // Withdraw one point to b.
		}  // end for loop.
	
		
		var b = 10;
		li = limit + 1;
		// This loop creates the second row on each level.
		for (i=0; i < li; i++) { 	
		
			// If var level passed from parameter function is equal to var user_level passed from session super global, then;
			if(level <= Number(user_level)) { 
			var theClass = "user_level";} else { var theClass = "not_user_level"; 	}  // End if.
			// The class to pass will be user_level   else   the class to pass will be not_user_level.
		
		
			var newP = document.createElement("p");   // Creates a new p element, is not visible, we need to apped it so is in the DOM.
			if(i == 0) {newP.setAttribute("class","col-1-16 clear "+theClass);    // Applies the class col-1-16  and class clear to the new element.
			} else {
			newP.setAttribute("class","col-1-16 "+theClass);    // Applies the class col-1-16 to the new element.
			}
			var text = document.createTextNode(a+"+"+b);  // Creates a text node.
			newP.appendChild(text);                    // We append the text node in the new p element so it has some text.
			document.body.appendChild(newP);  // We append the new p element in the DOM so it gets visible.
			b--;                              // Withdraw one point to b.
		} // end for loop.
		
	} // end create_p_element() function.
		
		
	
	
		
	</script>
  
  
  </head>

  
  
  
  <body>
  
	<div id="view">You need to practice </div>
	
	<div id="view_level"></div>
	
	<a href="view_addition.php" >back</a>
  
  <script>

		var newHr = document.createElement("hr"); 
		document.body.appendChild(newHr);
				
		for (ii=10; ii >= 0; ii--) { 	
				
				
				create_p_element(ii);       // Call the function create_p_element() accepts 1 parameter witch is the level.  
				
				var newDiv = document.createElement("div");    // Creates a new p element, is not visible, we need to append it so is in the DOM.
				newDiv.setAttribute("class","col-3-16 label");  // Applies the class col-1-16 to the new element.
				var text = document.createTextNode("Level "+ii);   // Creates a text node.
				newDiv.appendChild(text);                        // We append the text node in the new div element so it has some text. 
				document.body.appendChild(newDiv);              // We append the new p element in the DOM so it gets visible.
				
				var newHr = document.createElement("hr"); 
				document.body.appendChild(newHr);
				
				
				
			}  // end for loop.


	// if wrong_facts_string is not emty then there are some wrong answers.
	if(wrong_facts_string != "") { 

	// split separate information in the string using the , as reference and convert it in to an array.
	wrong_facts_array = wrong_facts_string.split(",");   // Usamos split para separar el string en partes usando la "," como referencia
	document.getElementById("view").innerHTML += wrong_facts_array;
		
	// We color red all the wrong answers.
	var x = document.querySelectorAll("p");
	//var wrong_facts_array = ["0+2","9+0","0+0","1+0"];
	
		for (i = 0; i < x.length; i++) {
		 for (ii = 0; ii < wrong_facts_array.length; ii++) {
		   if (x[i].innerHTML == wrong_facts_array[ii]) { x[i].className += " malas"; }
		 }
		}


	}
	
	// Shows user level.
	document.getElementById("view_level").innerHTML = message;

		
  
  </script>
  
  
  
  
  
  </body>
  
  
</html>