<?php
	require_once("definitions.php");
	require_once("db_functions.inc"); 
	require_once("authentication.inc");
	require_once("error_handler.inc");
	
	// Grab the details login details just entered by user
	$username=$_POST["username"];
	$password=$_POST["password"];
	
	// Connect to mysql as user root  
    $link=load_mysqli(CM_HOST,CM_USER,CM_PSW);  // get conection to mysql env
	select_db($link, DB_NAME);  // use the classicmodels database
	
	// Make sure the fields are good
	if (!isset($username) || !isset($password))
	{
		printf("Seems to be something wrong with the username or password");
		return false;	
	}
		// Build the query
	$query="INSERT into users SET password='$stored_password', user_name='$username', use_count=0";	
	if (!$result=mysqli_query($link,$query))
		error_handler("Something happened adding the user to tha database"  . mysqli_error($link));
		
	$_SESSION["message"]="Added User: " . $username . " to the application";
	$location="/modelcarsystem/index.php?";

	error_reporting(E_ALL | E_WARNING | E_NOTICE);
	ini_set('display_errors', TRUE);
	flush();
	if (!headers_sent($filename, $linenum)) {
		header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location); /* Redirect user */
		exit;
	}else{
		echo "Headers already sent in $filename on line $linenum\n" .
		"Cannot redirect, for now please click this <a " .
		"href=\"http://www.google.com\">link</a> instead\n";
	exit;
}