<?php
session_start();
ob_start();
require_once('FirePHPCore/fb.php');

/**************************** Controller Easy to read summary **********************************/

/* Synopsis: Controller.php will be called from the view.html then it will verify if the value sent in the $_GET['answer'] variable is equal to
$_SESSION['computer_answer'] 


*/

				/********** Main Controller ********************/

	//A1- Check if answer is right or not. If right then:
		
		//B1-- Add one point.
		//B1-- If user have more or equal to 3 points in that fact then:	
			//C1-- Erase the fact from the list in the $_SESSION super global.
			//C2-- Check if there are still more facts to do -> (Function).
			//C3-- Build a new fact ->(Function).
			//C4-- Send the fact and the good job message. 
		//B2-- Else, not more than 3 points, then:
			//C1-- Build a new fact ->(Function) and the good job message.
	
	//A2-- Else, not right answer, then:
		
		//B1-- Check if this is a new game(Ajax sends $_GET['answer'] value of "Get Ready"), then:
			//C1-- Build a new fact.
			//C2-- Send the fact.
		//B2-- else, not a new game, then:
			//C1-- Add one point to the wrong list for that fact.
			//C2-- If user have more than 3 points in that fact then:
				//D1-- If user wrong answer is equal 3 then:
					//E1-- Add the fact in the wrong fact list.
				//D2-- Send the show answer message.
			//C3-- Else, not more than 3 points, then:
				//D1-- Send try again message.
	
	
			/**************End Main controller ************/
	
	
// Functions: 
// build_fact (build a new fact).
// check_end_game (check if there are more facts to do in the array $_SESSION['facts_array'] if array empty returns true)

// Variables:
// $_SESSION['index'] (Stores the index of the chosen fact in the sub array $_SESSION['facts_array']) -> from build_fact function 
// $_SESSION['computer_answer'] (We have stored the right answer) -> from build_fact function
// $_SESSION['current_fact'] (Store the fact the user is working on at this moment.) -> from build_fact function
// server_data (Store the message to send back as a Jason object) -> first if in this page controller.php 

// Arrays:
//Parallel arrays:
// $_SESSION['facts_array'] (In here is the list of all the facts user should answer) -> from model.php 
// $_SESSION['right_answers'] (In here we have a list of the good answer for each fact)  -> from model.php
// $_SESSION['wrong_answers'] (In here we have the list of how many wrong answers for each fact)  -> from model.php

// None parallel array:
// $_SESSION['wrong_facts'] (In here we have the list of facts that could not answer the user and needs more practice. They will be saved in the data base.)  -> from model.php
// $_GET['user_answer'] (Is where the user answer is, it is send via Ajax) -> send via Ajax.



/**************************************** End Summary ********************************************************/


	
	
/******************************************** Function build_fact ********************************************/
	
	// Creates a new fact, taking it from the list of facts stored in $_SESSION['facts_array']
	// it also gets the right answer of the fact chosen and store it in the $_SESSION['computer_answer']
	// it also stores the index of the fact chosen from the sub array facts_array in the variable $_SESSION['index'].
	// the index is necessary because the three sub arrays are parallel and erase data or add data as user answer.
	// it is also necessary when we store the facts that user could not answer right for three times.
	function build_fact() {

		
		
		
		
		// Stores the sub array facst_array in to $facts_array to work with it more directly. This are the facts user should solve.
		$facts_array = $_SESSION['facts_array'];   // This are the facts user should solve.
	//	fb($facts_array, 'facts_array');
		
		
		$i = 0;
		while($i == 0) {  // Loop to get a fact different from the last one.
			
			
			
			// Count the elements in the array $facts_array to store how many facts are still there. This is used for the rand function below.
			$total_facts = count($facts_array);
			--$total_facts; // -- takes minus one because the array is base zero, this function starts counting in one.
			fb($total_facts, 'total_facts');
			// Creates a random number with the rand function, 1st parameter min to 2nd parameter max number witch is
			// the count of the array stored in $total_facts.
			$random_number = rand(0,$total_facts);
			//	fb($total_facts, 'total_facts2');	
			// Gets a fact from the array $facts_array using the random number stored in the variable $random_number.
			$fact = $facts_array[$random_number];

			
			if($fact != $_SESSION['current_fact'] || $total_facts <= 0 ) { 	   //  If fact is not equal the last fact made by user or the there are more than one fact still left.
				$i = 1;  // Exit loop 
			
			}	// End if			
		
		}  // End loop
		
		
			
		// Create an array $addends splitting the string each + symbol. Same as explode but split support regular expressions in case needed.
		$addends = explode('+',$fact);
		// Gets the right answer from the fact chosen.
		$comp_answer = $addends[0] + $addends[1];
		// Store the answer in the $_SESSION['computer_answer'] sub array.
		$_SESSION['computer_answer'] = $comp_answer;
		// Store the random number chosen in the $_SESSION['index'] sub array.
		unset($_SESSION['index']);             // Just for precaution we destroy the last value in index to make sure we store a new index.
		$_SESSION['index'] = $random_number;   // stores the value index where the fact is.
		// Stores the fact the user is working on at this moment in the $_SESSION['current_fact']sub array.		
		$_SESSION['current_fact'] = $fact;
		// Returns the fact randomly chosen.
		return $fact;
					
	}
	
/***************************************** End build_fact Function ****************************************/





/*************************************** Function check_end_game *******************************************/


	// This function checks if facts_array is empty, if so the game will be ended returning true if not the game will continue returning false.
	function check_end_game() {
		$facts_arr = $_SESSION['facts_array'];  // Stores the array facts_array into the var facts_arr
		$total_facts_array = count($facts_arr); // count() count all elements in the array
		if($total_facts_array > 0) {            // if $total_facts_array is greater than zero, then:
		return false;       // return false, this stores false in the $is_end var, look from where the functions was called
		} else {            //  After return key word nothing else is executed.
		return true;
		}
	}


/**********************************************************************************************************/


// array_splice accepts 4 parameters, here just 3 are specified. Only the first 2 are required.
		// 1st parameter is the array to be modify, 2nd parameter starting point to modify, 3rd parameter the end point to modify if 
		// not specify will erase all to the end, here it is not specify in this script. 4th parameter is the value to be placed.

	
/************************************** Main controller ***************************************************/	
	
	  
	// Check if answer is right or not. If right then:
	if ($_GET['user_answer'] == $_SESSION['computer_answer'] ) {
		// Gets the index of the facts that user is working.
		$index = $_SESSION['index'];
		// Adds one point int the right_answer list sub array parallel to the facts_array.
		$_SESSION['right_answers'][$index] = $_SESSION['right_answers'][$index] + 1;		
	
		// If user have more or equal to 3 points in that fact then:
		if ($_SESSION['right_answers'][$index] >= 3) {
			// Erase the fact from the list in the $_SESSION super global. And its parallel arrays.
			array_splice($_SESSION['facts_array'],$index, 1);      // unset($_SESSION['facts_array'][$index]); don't work because unset erase the index number as well
			array_splice($_SESSION['right_answers'], $index, 1);   // array_splice borra el elemento pero no el indice, dando el nuevo indice correspondiente al numero de elementos.
			array_splice($_SESSION['wrong_answers'], $index, 1);    // ej. unset borra el elemento 1 y queda indices 0,2,3 usando splice indices 0,1,2 poniendo nuevos indices a los elementos que quedan dentras del borrado.
			
			// Check if there are still more facts to do.
			$is_end = check_end_game();
			// Build a new fact ->(Function).
			$fact = build_fact();
			// Send the fact and the good job message.
			$server_data = array("message"=>"good Work!! last fact erased. ","fact"=>$fact,"end_game"=>$is_end);
			echo json_encode($server_data);        	// else, if not a new game, then:
		
		// Else, not more than 3 points, then:
		} else {
			// Build a new fact ->(Function).
			$fact = build_fact();
			// Send the fact and the good job message.
			$server_data = array("message"=>"good, new fact!! ","fact"=>$fact,"end_game"=>false);
			echo json_encode($server_data);
			//echo "good, new fact!! ".$fact;
		}
	
	// Else, not right answer, then: 
	} else { 
		
		// Checks if this is an starting game, if it is, then Ajax sends a string "Get Ready" as the user_answer value.
		// If $_GET['user_answer'] is equal to Get Ready then:
		if ($_GET['user_answer'] == "Get Ready") {
			
			// Build a new fact ->(Function).
			$fact = build_fact();
			// Send the fact and the good job message.
			$server_data = array("message"=>"The game has started. ","fact"=>$fact,"end_game"=>false);
			echo json_encode($server_data);        	
			
		// else, if not a new game, then:
		} else {
			// Gets the index of the facts that user is working.
			$index = $_SESSION['index'];			
			// Add one point to the wrong list for that fact. The ++ operator adds one to the value on the left side, same as just + 1.
			$_SESSION['wrong_answers'][$index] = $_SESSION['wrong_answers'][$index] + 1;			
			// If user have more or equal to 3 points in that fact then:		
			if ($_SESSION['wrong_answers'][$index] >= 3) {
				
					// If user worng answer is equal 3 then:
					if ($_SESSION['wrong_answers'][$index] == 3) {
					// Add the fact in the wrong fact list. array_push adds an element at the begging of the array.
					array_push($_SESSION['wrong_facts'], $_SESSION['current_fact']); 
					}
				
				// Send the show answer message.
				$server_data = array("message"=>"The right answer is ".$_SESSION['computer_answer'],"fact"=>$_SESSION['current_fact'],"end_game"=>false);
				echo json_encode($server_data);     
			
			// Else, not more than 3 points, then:
			} else {
				// Send the show answer message.
				$server_data = array("message"=>"Try again.","fact"=>$_SESSION['current_fact'],"end_game"=>false);
				echo json_encode($server_data);
			} 
		
		}
	
	}

/********************************************************************************************************/




/************************** Trouble shoot *********************************/

			fb($_SESSION['computer_answer'], 'computer_answer');
			fb($_SESSION['index'], 'index');
			fb($_SESSION['current_fact'], 'current_fact');
			fb($_SESSION['facts_array'], 'facts_array');  
			fb($_SESSION['wrong_facts'], 'wrong_facts');
			fb($_SESSION['wrong_answers'], 'wrong_answers');
			fb($_SESSION['right_answers'], 'right_answers');
			fb($_GET, 'Get');
			fb($_GET['user_answer'] , 'answer');
			fb($server_data, 'server_data');
			fb($is_end, 'is_end');
			fb($fact, 'fact');
			fb($_SESSION['user_id'],'user_id');
			fb($_SESSION['level'],'user_level');
			

	/**************
	// Trouble shoot show the session id.
	echo "<p>Session ID is ".session_id().".</p>";
	// Trouble shoot show the var.
	echo '<pre>';
	echo var_dump($_SESSION['facts_array']);
	exit;
	echo "<p>The user name is ".$_SESSION['user'].".</p>";
	
	
		FB::log($fact,'Log message');
		FB::info($fact,'Info message');
		FB::warn($fact,'Warn message');
		FB::error($fact,'Error message');
		FB::trace($fact,'Simple Trace');
	
	
************************************************************/
	
?>