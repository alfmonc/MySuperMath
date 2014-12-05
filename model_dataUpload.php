<?php
session_start();
require_once('connect.php');   // Call the connection file so it connect to the data base.
	
	$wrong_facts = implode(",",$_SESSION['wrong_facts']); // implode function creates a string representation of the array using the "," as the glue.
	
	// Update the wrong_answers, means the facts that user did not answer well three times. It saves them in the data base.
	// Object $user_data is now an object argument metaphorically it is like the return of a function.
	try {  $user_data=$db->query('UPDATE math_user SET wrong_answers="'.$wrong_facts.'" WHERE user_id='.$_SESSION['user_id'].'');   } 
	catch (Exception $e) {echo "Data could not";}

	// If user has less or equal than 0 wrong answers then;
	if(count($_SESSION['wrong_facts']) <= 4 && $_SESSION['level'] < 10) { 
		
		$new_level = $_SESSION['level'] + 1 ;  // Gets one level up.
		
		$_SESSION['message'] = 'You pass the level, now you are in level '.$new_level;
		
		// Send the new level to the data base.
		try {  $user_data=$db->query('UPDATE math_user SET user_level="'.$new_level.'" WHERE user_id='.$_SESSION['user_id'].'');   } 
		catch (Exception $e) {echo "Data could not";}
	
	} else {  // else if not 0 wrong answers
		
						
		$_SESSION['message'] = 'Current level '.$_SESSION['level'];
		
		
		// We will find out in what level user should be placed
		
		//  We need to classify the wrong answers in levels
		
		// Using the fist number in each fact as a clue we can know what level that fact is
		
		// We will use an array levels, each position is one level starting from zero, so if first nomber in the fact is two the level is two
		// and should add one to the position two in the array levels
		
		
		// Depending on the how many mistakes in each we will determing the level in witch the user is
		
		// if user has two or more in that one level, that should be the level that user is and then stop looking.
		
		// if user dont have two in 
		
	}
	
	

	
	
	
	//Redirect user to the view.php file to start. The variables stored in $_SESSION will be available there too.
	 header('Location: view_results.php');
	
	
	// "UPDATE math_user SET wrong_answers=".$_SESSION['wrong_answers']."WHERE user_id=".$_SESSION['user_id']

	
?>