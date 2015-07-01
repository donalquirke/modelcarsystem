<?php
	/* Controller to retrieve models from database */
	session_start();
	include_once("error_handler.inc");
			
	function load_mysqli($server,$user,$psw)
	// Connect mysql as user root
	{
		$link=mysqli_connect($server,$user,$psw);
		if (mysqli_connect_errno() || !$link)
			error_handler("Error: Failed to make a connection to mysql" . mysqli_connect_error($link));
		else 
			return($link);		
	}
	
	function select_db($link,$db)
	{
		if (!mysqli_select_db($link,$db))
			error_handler("Error: Failed to select the database: " . $db);
	}
	
	function query_db($link,$query)
	{
		$result = mysqli_query($link, $query);
		if (!$result) 
			error_handler("Error: Failed to read anything from database" . mysqli_error($link));
		else 
			return($result);				
	}
	
	function close_db($link)
	{
		mysqli_close($link);
	}
?>