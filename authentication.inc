<?php
	/* Controller to authenticate users */
	include_once("error_handler.inc");
	
	function authenticateUser($link, $username, $password)
	{
		// Make sure the fields are good
		if (!isset($username) || !isset($password))
			return false;
		
		// Create a digest of the password
		$password_digest=md5(trim($password));
		
		// Build the query
		$query="SELECT password FROM users WHERE user_name='{$username}' AND password='{$password_digest}'";
		
		// Hit the database
		if (!$result=mysqli_query($link,$query))
			error_handler("ERROR: Something happened trying to read user from database"  . mysqli_error($link));
				
		// Exactly one row? then we have found the user
		if (mysqli_num_rows($result)==1)
			return true;
		else 
			return false;		
	}
?>