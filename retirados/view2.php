<?php
session_start();   // No se puede usar con include, por ejemplo para incluir el controller, 
				   // la unica forma es que esten juntos en la misma pagina para poder usar las funciones del controller.
				   // la otra solucion es usar ajax y eso es lo que se tratara de hacer.
?>
<!doctype html>

<html>

  <head>
    <title>Addition Facts</title>
    <meta charset="utf-8"/>
  </head>

  <body>
  
 	<P>Hellow <?php echo $_SESSION['user']; ?> </p>
	
	
	<p id="fact">Suma </p>
	
	
	
	
	<form name ="forma" action="prueba.php" method = "POST">
		
	<input type = "text" id = "answer_field" onkeydown= "if (event.keyCode == 13) { get_fact(), value =''; return false; }" name = "respuesta_usuario" value = "" size = "5" autocomplete="off" autofocus>  
	
	</form>
	
		
	
	
	<script>
	
	// When load the page call the function get_fact to start.
	window.onload = start_game;
	
	
	/*************************  Start the game *********************************************/
	//Function to be called when page load to start the game. Then it calls get_fact function.
	function start_game() {
		document.getElementById("answer_field").value = "Get Ready";
		get_fact();	
	}
	/***************************************************************************************/
	
	
	
	
	
	/************************** Ajax request.  **********************************************/
	// Function will request the server controller.php via ajax to get the new fact to show. Then call responseAjax function.
	function get_fact() {
		var url = "prueba.php";                           // Stores the url to be call.
		var randNum = parseInt(Math.random()*999999);    // Makes a long random number.
		var user_answer = document.getElementById("answer_field").value;   // Stores the text typed in the field answer_field in the var user_answer.
		
		var myRequest = new XMLHttpRequest();                     // Instance of the object XMLHttpRequest.
		myRequest.open("GET", url + "?answer=" + user_answer + " rand=" + randNum, true);  // Open the request. When set to true means is asynchronous, and needs function.    
		myRequest.onreadystatechange = responseAjax;            // Put in the object myRequest the function responseAjax inside onreadystatechange prop.
		myRequest.send();                                      // Send Ajax request.
	}
	/****************************************************************************************/

		
	
	/***************************** Ajax onReadyStateChangeResponse **************************/
	// Function to do when onreadystatechange change status. Call show_fact function.
	function responseAjax() {
		 if(myRequest.readyState == 4) {                   // If readyState is equal 4 means it is completed.
			if(myRequest.status == 200) {show_fact();}    // If status is equal 200 means it is OK. Then call show_fact function.
		else {document.getElementbyId("fact").innerHTML = "No connection" }   //Else show no connection message.
	}
	/*****************************************************************************************/

	

	/****************************** Called if Ajax succeed ************************************/ 
	// Function called from responseAjax function, if Ajax succeed.
	function show_fact() {   	                	
	  
		var server_data = myRequest.responseText;       // Data is stored in respnseText, we extract it and put it in the var server_data.
		
		if(server_data){                                     // If there are more in the list then:
			document.getElementbyId("fact").innerHTML = server_data;               // Show the fact gotten from the server.
			} else { 
				document.getElementbyId("fact").innerHTML = "No data is there.";   // Else end the game sending the user to the end game page.
			}
	}
	/*******************************************************************************************/

	
	
	
	
	
	</script>
	
  
  
  
  
  
  
  
  
  </body>
  
  
</html>
