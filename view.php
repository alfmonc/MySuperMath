<?php
session_start();   // No se puede usar con include, por ejemplo para incluir el controller, 
				   // la unica forma es que esten juntos en la misma pagina para poder usar las funciones del controller.
				   // la otra solucion es usar ajax y eso es lo que se tratara de hacer.
				   
				   // ESTA LINEA NO FUNCIONARA SI NO SE GUARDA CON EXTENCION .PHP ESTE ARCHIVO.
				   // EL SERVIDOR NO LEERA NI UNA LINEA DE PHP, SI EL FILE NO TIENE EXTENCION PHP
?>
<!doctype html>

<html>

  <head>
    <title>Addition Facts</title>
    <meta charset="utf-8"/>
	<link rel="stylesheet" href="css/style_view.css">
	
	
  </head>

  <body>
  
 
  
  <div class= "row header_view">


			<p class= "col-8-16 sign"><em>My Super Math</em></p>
			
			<img class="mainIcon_view" src="img/mysupermath.png" />
			
	</div>

	
<!--  <div class = "wrapper">-->

	<a class="link back" href="view_home.php" >back</a>
  
  
 	<P class="computer">Hello <?php echo $_SESSION['user']; ?> </p>
	
	
	<p class="fact" id = "fact"></p>
	
	<p class="message" id = "messages"></p>
	
	
	
	
	
	<p class="timer" id="timer" class="timerClass col-8-16">2</p>
	
	<form class="form" name ="forma" action="" method = "POST">
		<input class="userfield" type = "text" id = "answer_field"  name = "respuesta_usuario" value = "" maxlength="5" size = "10" autocomplete="off" autofocus>  
	</form>
	
	
	<button class="go" onclick = "get_fact()" >Go</button>
	
	
	
	
	<button class="erase" onclick = "erase()" >Erase</button>
	
	
	<div class = "group2">
	
	<span class = "number uno" onclick="writeMynumber(this)">0</span><span class = "number" onclick= "writeMynumber(this)">1</span><span class = "number" onclick= "writeMynumber(this)">2</span><span class = "number" onclick= "writeMynumber(this)">3</span><span class = "number" onclick= "writeMynumber(this)">4</span>
	
	</div>
	
	<div class = "group2">
	
	<span class = "number uno" onclick= "writeMynumber(this)">5</span><span class = "number" onclick= "writeMynumber(this)">6</span><span class = "number" onclick= "writeMynumber(this)">7</span><span class = "number" onclick= "writeMynumber(this)">8</span><span class = "number" onclick= "writeMynumber(this)">9</span>
	
	</div>
	
	

	
	
	<script src="js/numbers.js"></script> 
	
	<script type="text/javascript">



	


	
	
	
	
	// When load the page call the function start_game to start.
	window.onload = start_game;
	
	
	
	var myRequest = new XMLHttpRequest();     	// Instance of the object XMLHttpRequest.
	
	var answer_field = document.getElementById("answer_field");
	
	//var seg = 5;
	//timer = setInterval('display_time()', 1000);    // setInterval is an internal function, it calls display_time() function every 1sec. time needs to be give in milliseconds 
				                                     
	
	/*************************  Start the game *********************************************/
	//Function to be called when page load to start the game. Then it calls get_fact function.
	function start_game() {
		
		document.getElementById("answer_field").value = "Get Ready";
			
		answer_field.addEventListener("keydown",pressed, false);    // Before I used	onkeydown= "if (event.keyCode == 13) { get_fact(), value =''; return false; }"
																	// But to separate code from HTML tags used the new addEventListener this could
																	// make the code more expandable in the future, with this it is possible to add
																	// more event handlers if necessary.
	
		answer_field.addEventListener("keyup",pressed_up, false);

		get_fact();	

	}
	/***************************************************************************************/
	
	
	
	
	
	/************************  Timer  *********************************/
		
		// Funcion llamada por setInterval().
		function display_time() {
			
			
			document.getElementById("timer").innerHTML = seg;   // Muestra los segundos en el tag etiqueta.


			--seg;  // Take one second down.
			
			// Si llega a mas de los segundos permitidos clearInterval detiene el timer que tiene la funcion setInterval, ve la arriba.
			if(seg < 0) { 
				                     
				document.getElementById("answer_field").style.visibility = "hidden";
				document.getElementById("answer_field").value = 99999;
				clearInterval(timer);
				get_fact();
				// Timer is reseted it at the end of get_fact() function.
					
			}  // End if.		
		
		}  // End display_time() function. 
		
		
		/************************** end Timer ***************************************/
	
	
	
	
	
	
	/********************************  When user keyUp    *************************************/
	// This function prevent blank space or letters input in the user_field.
	function pressed_up (event) {    // I tried to use event.key but mozila does not support it yet. if event.keyCode gets deprecated use event.key probably then it
		var answer = document.getElementById("answer_field").value;                                   // will be supported by Mozilla as now is supported by IE and Chrome.
		// If not other but a number is been entered and the entered is not a return, then:
		if (/[^0-9]/.test(answer) && event.keyCode != 13) {                      //  Regular expression ^ means not, not a digit from 0 to 9
		  document.getElementById("messages").innerHTML = "Type Only numbers";   //  method test compares the regular expression against string in var answer returns a boolean.
		  document.getElementById("answer_field").value = "";                    //  != means is not equal.
		 }  // End if.
	}  // End function.
	/*****************************************************************************************/
	
	
	
	
	/*************************** When user keydown *******************************************/
	// This function prevent default behavior when the return key is pressed by the user and trim or erase the white spaces in the check if is a number.
	// This function is called from start_game function in the addEventListener. get_fact function is called within this function.
	// event parameter value is internal in javaScript, to be able to use it needs to be included as parameter.
	function pressed(event) {                
		var answer = document.getElementById("answer_field").value;
		if (event.keyCode == 13) {   // KeyCode is the code of the key pressed, 13 is the return key code, it is stored in the keyCode by javaScript.
			event.preventDefault();  // Prevent from default behavior when press return and submit the form.		
			// if value entered is different from empty "" and entered is a number with any digit, then:
			if(answer.trim() != "" && /[0-9]/.test(answer)) {   // trim() takes away all the blank space.
			document.getElementById("fact").innerHTML = "Listened";
			get_fact();           // Call get_fact function to build a fact.
			}
		}	
	}
	/******************************************************************************************/
	
	
	

	/************************** Ajax request.  **********************************************/
	// This function will send the request to the server.
	// This function will request the server controller.php via ajax to get the new fact to show. Then call responseAjax function.
	function get_fact() {
		var url = "controller.php";                           // Stores the url to be call.
		var randNum = parseInt(Math.random()*999999);    // Makes a long random number.
		var user_answer = document.getElementById("answer_field").value;   // Stores the text typed in the field answer_field in the var user_answer.
		
		
		myRequest.open("GET", url + "?user_answer=" + user_answer + "&rand=" + randNum, true);  // Open the request. When set to true means is asynchronous, and needs function.    
		myRequest.onreadystatechange = responseAjax;            // Put in the object myRequest the function responseAjax inside onreadystatechange prop.
		myRequest.send();                                      // Send Ajax request.
	}
	/****************************************************************************************/

		
	
	
	
	/***************************** Ajax onReadyStateChangeResponse **************************/
	// This function is executed when onreadystatechange change status. When the response is good then it calls show_fact function.
	function responseAjax() {
		 if(myRequest.readyState == 4) {                   // If readyState is equal 4 means it is completed.
			if(myRequest.status == 200) {show_fact();}    // If status is equal 200 means it is OK. Then call show_fact function.
				else {
					document.getElementById("fact").innerHTML = "No connection";     //Else show no connection message.
					}   
		}		
	}
	/*****************************************************************************************/

	
	/****************************** show_fact function ****************************************/
	// This function is called from responseAjax function if Ajax succeeded, if Ajax succeed. It gets a new fact from server controller and shows it to the user.
	function show_fact() {   	                	
	  
		var server_data = myRequest.responseText;       // Data is stored in respnseText, we extract it and put it in the var server_data.
		var json_object = JSON.parse(server_data);      // When is an associative array it becomes and object. Needs to be deposit into a var.
		if(server_data){                                     // If server_data is true, means if has data stored, then:
			
				// Check if there are still more facts to do, If end game is false, then:
				// php function check_end_game sends true or false to it.
				if(json_object['end_game'] == false) {
				document.getElementById("messages").innerHTML = json_object['message'];    // Show the fact gotten from the server.
				document.getElementById("fact").innerHTML = json_object['fact'];
				
		
				// else if end game false, there are no more facts, then:
				} else { window.location = "model_dataUpload.php";	}
			
			
		} else { 
				document.getElementById("messages").innerHTML = "No data is there.";   // Else end the game sending the user to the end game page.
		}	
	
		document.getElementById("answer_field").value = ""; 
		document.getElementById("answer_field").style.visibility = "visible";
		
		// Reset the timer.
		seg = 5;		
		clearInterval(timer);
		timer = setInterval('display_time()', 1000);  
		
	}
	/*******************************************************************************************/

	
	
	</script>
	
	
	
  
	
  
  
  
  
  
  
  </body>
  
  
</html>
