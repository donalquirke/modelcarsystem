<?php	
	// Controller to login a user
	require_once("user_functions.inc");
	
	session_start();
	
	// authenticate 
	// Redirect illegal attempt - only logged in users allowed past here		
	if (!isset($_SESSION["username"]))
	{
		$location="/modelcarsystem/index.php?";  	
		header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location); 
		exit();
	}
	// track last user operation
	// $_SESSION["operation"]=CM_LOGOUT;   // Doesn't make sense to track this
			// Save the user stats
	if (isset($_SESSION["username"]))
		update_user_stats("Logged out");
		
	// Kill the session and redirect to home page
	if (isset($_SESSION["message"]))
		unset($_SESSION["message"]);
	session_destroy();	

	$location="/modelcarsystem/index.php"; 
	header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location); /* Redirect user */
	exit();	
?>