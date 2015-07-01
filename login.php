<?php	
	// Controller to login a user
	require_once("user_functions.inc");
	
	session_start();
	// track last user operation
	$_SESSION["operation"]=CM_LOGIN;
	
	// Reset the message token
	if (isset($_SESSION["message"]))
		unset($_SESSION["message"]);
		
	require_once("definitions.php");
	require_once("db_functions.inc"); 
	require_once("authentication.inc");
	
	// Grab the login details just entered by user
	$username=$_POST["username"];
	$password=$_POST["password"];
	
	// Connect to mysql as user root  
    $link=load_mysqli(CM_HOST,CM_USER,CM_PSW);  // get conection to mysql env
	select_db($link, DB_NAME);  // use the classicmodels database	
	
	// Authenticate the user
	if (authenticateUser($link, $username, $password))
	{
		// Register the username
		$_SESSION["username"]=$username;
		
		// Save the user stats
		if (isset($_SESSION["username"]))
			update_user_stats("Logged in");
		
		// Redirect back to home page
		$location="/modelcarsystem/index.php";		
		header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);
		exit;
	}
	else {
		// Authentication Failed
		$_SESSION["message"]="Sorry, seems to be something wrong with either your username or password";
		
		// Redirect back to login
		$location="/modelcarsystem/login_form.html.php?status=fail";		
		header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location);
		exit;				
	}
?>