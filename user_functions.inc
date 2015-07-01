<?php
	/* Controller to handle tracking user activity */
	require_once("definitions.php");
	require_once("db_functions.inc"); 
		
	function update_user_stats($action)
	{
		// get the current count
		// Get the models from the database into an array       
    	$link=load_mysqli(CM_HOST,CM_USER,CM_PSW);  // get conection to mysql env
		select_db($link, DB_NAME);  // use the classicmodels database	
				
		$username=$_SESSION["username"];
		
		// Build the query
		$query="SELECT user_name, last_op, user_id, use_count, last_op FROM users WHERE user_name='{$username}'";
		// Hit the database
		$result=query_db($link,$query);	
		if (!$result=mysqli_query($link,$query))
			error_handler("ERROR: Something happened trying to read user from database"  . mysqli_error($link));

		// Exactly one row? if not, something nasty happened. There should only be one row for a given username
		if (mysqli_num_rows($result)!=1)
			error_handler("ERROR: Seems to be two accounts with username " . $username  . mysqli_error($link));			
		else {
			$row=mysqli_fetch_array($result);
			$user=$row;
			// set the id for the upcoming db update
			$user_id=$user["user_id"];
			// grab the courrent count so as to increment it.
			$count=$user["use_count"]+1;  // do i need to do a string to int conversion

			// save $count and last action to the database;
			$query="UPDATE users SET use_count=$count, last_op='{$action}' WHERE user_id=$user_id";
			
			
			$result=query_db($link,$query);	
			if (!$result){
				error_handler("ERROR: Something happened trying to write user stats to database"  . mysqli_error($link));
			}						
		}	
	}
?>