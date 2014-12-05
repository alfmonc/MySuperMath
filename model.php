<?php
session_start();
require_once('connect.php');   // Call the connection file so it connect to the data base.
//ob_start(); 

//Seesion_start pleased at the begging with no spaces or any other info so it can be send with the header. 
//Encoding must be set to UTF-8 with no BOM in the code editor.



	/***************** STARTS CONNECTION WITH DATABASE *********************
	
	// Call the connection file so it connect to the data base.
	//require_once("model_connect.php");
	$db_host_names = "mysql:dbname=alfmonc_mysupermath;host=50.87.144.187";
	$user="alfmonc_math";
	$password="math78";
	
	try {
	$db = new PDO($db_host_names,$user,$password);

	} 	catch(PDOException $e) 
	
				{ echo "Could not connect ". $e->getMessage();
				  exit; }
	
		
	/*********************** CONNECTED ************************/
	

	
	
	
	
	// Send the query. Extract all user info in table math_user. 
	try {  $user_info=$db->query("SELECT * FROM math_user");   } 
	catch (Exception $e) {echo "Data could not";}
	
	// Fetch the data in the argument object $numbers in a associative way and place the information in the $data variable.
	$data = $user_info->fetch(PDO::FETCH_ASSOC);
	
	
	try {  $facts_data=$db->query("SELECT * FROM numbers_operations WHERE level_id=".$data['user_level']."");   } 
	catch (Exception $e) {echo "Data could not";}
	
			
	$factsData = $facts_data->fetch(PDO::FETCH_ASSOC);
	
	
	 $level_facts_array = explode(",", $factsData['addition_facts']);  // All the facts in the user level.

	
	// if worng_ answers contains some wrong answer facts then:
	if (!empty($data['wrong_answers'])) { 
		
		// Split the string making an array separating values by the coma. This are the operations the user will solve.
		$wrong_facts_stored = explode(",", $data['wrong_answers']);

		//  We need to join two arrays. Wrong_facts_stored and level fast array that contains all the facts for that level.
		$merged = array_merge($wrong_facts_stored,$level_facts_array);
		
		$_SESSION['facts_array'] = $merged;   // Stores the merged array in the global session facts_array.
		
	} else {    //  else if there there are any wrong fracts stored then
		
		$_SESSION['facts_array'] = $level_facts_array;     //  Stored the facts in that array with not merging just the level.
		
		$wrong_facts_stored = array();     //  Sets wrong fracts stored as an empty array.
			
	}
	
		
	
	$_SESSION['wrong_facts_stored'] = $wrong_facts_stored;  // In here we will store a list of facts that could not answer the user and needs more practice. They will be saved in the data base.
	
	
	$_SESSION['wrong_facts'] = array();  // Where the wrong facts will be stored.
	
	
	
	
	
	
	
	
		
	
	// Assigns the array $myvar to facts_array as index, in the super global $_SESSION.
	// $_SESSION['facts_array'] = $myvar; // sustituido
	$_SESSION['user'] = $data['user_name'];    //Assigns the user name in the super global array $_SESSION as user_name as index.
	$_SESSION['level'] = $data['user_level'];  //Assigns the user level contained in $data array, in the super global array $_SESSION['level'].
	$_SESSION['user_id'] = $data['user_id'];   // Assigns the user id to the super global variable $_SESSION['user_id'].
	
	// Count the elements in the sub array $_SESSION['facts_array'] and stores it in the $array_total variable.
	$array_total = count($_SESSION['facts_array']);
	
	// Declares arrays and fill the arrays with 0 integer value.
	// array_fill is a function that accepts three parameters, 1st starting point to fill, 2nd end point to fill, 3rd the value used to fill each element.
	// array_fill will fill the array with zero value depending of how many elements the $_SESSION['facts_array'] sub array has.
	$_SESSION['right_answers'] = array_fill(0, $array_total, 0); // In here we will store a list of the good answer for each fact.
	$_SESSION['wrong_answers'] = array_fill(0, $array_total, 0); // In here we will store a list of how many wrong answers for each fact.
	

	
	//if ($_SESSION['wrong_facts'] == "") {$_SESSION['wrong_facts'] = null;}
	
	$_SESSION['computer_answer'] = null; // Is not an array, it is just a variable. 
	$_SESSION['current_fact'] = null;    // Is not an array it is just a variable.
	$_SESSION['index'] = null;           // Is not an array we are using it as just a variable.
	$_SESSION['message'] = null;         // // Is not an array we are using it as just a string to let user know if pass or not the level.
	
	
	
	
	
	
	// Now we need to add some more facts from the levels below from wich the user is, so the user dont forget them.
	// If user level is greater than level 0 then.
	if($_SESSION[''])
	
		// Ramdomly select 5 facts of each level and put it in the selected facts array.
		// Merge the array with the facts array.
	
	
	
	
	
	
	
	/**************/
	// Trouble shoot show the var.
	//echo '<pre>';
	//echo var_dump($data);
	
	// Trouble shoot show the var.
	// echo '<pre>';
	// echo var_dump($_SESSION);
		
	// Trouble shoot show the session id.
	//echo "<p>Session ID is ".session_id().".</p>";
	
	
	//ob_start();

	/******/
	
	
	
	
	//Redirect user to the view.php file to start. The variables stored in $_SESSION will be available there too.
	 header('Location: view.php');
?>