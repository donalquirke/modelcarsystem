<?php	
	// Controller to insert a new model to the database 
	require_once('definitions.php');
	require_once('db_functions.inc'); 
	require_once('validation_functions.inc');
	require_once("error_handler.inc");
	require_once("user_functions.inc");
	
	// authenticate 
	// Redirect illegal attempt - only logged in users allowed past here		
	if (!isset($_SESSION["username"]))
	{
		$location="/modelcarsystem/index.php?";  	
		header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location); 
		exit();
	}
	
 	
	// Connect mysql as user root  
    $link=load_mysqli(CM_HOST,CM_USER,CM_PSW);  // get conection to mysql env
	select_db($link, DB_NAME);  // use the classicmodels database	
		
	if (isset($_GET["id"]))
		$productCode=$_GET["id"];
	else 
		error_handler("ERROR: Failed to delete the record. No productCode passed");
		
	// Build the SQL
	$query = "DELETE FROM products WHERE productCode={$productCode}";  
	
	$result = mysqli_query($link, $query);
	if (!$result) 
		error_handler("ERROR: Failed to delete the record."  . mysqli_error($link));
	else 
	{
		// Save the user stats
		if (isset($_SESSION["username"]))
			update_user_stats("Deleted Model");
		
		// Would be better to do a select from database to be certain of clean update select.  For now use productCode below based on session variable
		// Store a message to confirm to user that the delte happened
		$_SESSION["message"]="Successfully deleted model: " . $_GET["productName"] ;
		// redirect and url variables
		$location="/modelcarsystem/index.php";
		header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location); /* Redirect user */
		exit();
	}	
?>