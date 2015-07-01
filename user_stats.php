<?php	
	// Admin controller to add a new user
	require_once("definitions.php");
	require_once("db_functions.inc"); 
	require_once("authentication.inc");
	require_once("error_handler.inc");
	
	session_start();
	
	// authenticate 
	// Redirect illegal attempt - only logged in users allowed past here		
	if (!isset($_SESSION["username"]))
	{
		$location="/modelcarsystem/index.php?";  	
		header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location); 
		exit();
	}
		
	// grab the details login details just entered by user
	if (!isset($_SESSION["username"]))
		error_handler("Error: Failed to get good user id to read stats from database" );
	else 
		$username=$_SESSION["username"];

	
	// Connect to mysql as user root  
    $link=load_mysqli(CM_HOST,CM_USER,CM_PSW);  // get conection to mysql env
	select_db($link, DB_NAME);  // use the classicmodels database	
							
	// Build the query
	$query="SELECT user_name, last_op, user_id, use_count, last_op FROM users WHERE user_name='{$username}'";
	$result=query_db($link,$query);	
	if (!$result=mysqli_query($link,$query))
		error_handler("ERROR: Something happened trying to read user from database"  . mysqli_error($link));

	// Exactly one row? if not, something nasty happened. There should only be one row for a given username
	if (mysqli_num_rows($result)!=1)
		error_handler("ERROR: Seems to be two accounts with username " . $username  . mysqli_error($link));			
	else {
		$row=mysqli_fetch_array($result);
		$user=$row;
		
		$uses=$user["use_count"];
		$operation=$user["last_op"];									
		}			

	$_SESSION["message"]="Usage: " .$uses . " Last action: " .$operation;
	$location="/modelcarsystem/user_stats.html.php?";  	
	header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location); /* Redirect user */

	exit();
	
?>