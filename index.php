<?php
	require_once "definitions.php";
	require_once('db_functions.inc'); 
	require_once("user_functions.inc"); 
	
    //	Lets see if we have a healthy connection now we're trying web hosting and not local
	//$connect = mysqli_connect(CM_HOST, CM_USER, CM_PSW, DB_NAME);
    //if (mysqli_connect_errno())
    //{
    //echo "Failed to connect to MySQL: " . mysqli_connect_error();
    //}
	//else
	//{
	//echo "Connected to MySQL: " . mysqli_connect_error();
	//}
	
    // Get the models from the database into an array       
    $link=load_mysqli(CM_HOST,CM_USER,CM_PSW);  // get conection to mysql env
	select_db($link, DB_NAME);  // use the classicmodels database	
				
	$query = "SELECT productCode, productName, productDescription, sellingPrice, quantityInStock FROM products ORDER BY productName ASC";
	$result=query_db($link,$query);

	// Populate an array to display in the view
	while ($row = mysqli_fetch_array($result))
		$models[] = $row;		
	
	close_db($link);
                
	include('list_models.html.php');  // Show the models 
	
	// Save the user stats
	if (isset($_SESSION["username"]))
		update_user_stats("Home page/Show list");		
		
?>
	
