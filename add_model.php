<?php	
	// Controller to insert a new model to the database 
	require_once("definitions.php");
	require_once("db_functions.inc");  
	require_once("error_handler.inc");
	require_once("user_functions.inc");
	require_once("validation_functions.inc");
		
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
		
	// Make sure the data set just entered by user is complete before adding record to database. If not, show a warning and exit	
	$array=verify_form_fields($link,CM_ADD);

	$query = "INSERT INTO products SET productName='{$array["productName"]}', 
								 productLine='{$array["productLine"]}',
								 productScale='{$array["productScale"]}',
								 productVendor='{$array["productVendor"]}',
								 productDescription='{$array["productDescription"]}',
								 quantityInStock='{$array["quantityInStock"]}',
								 buyPrice='{$array["buyPrice"]}',
								 sellingPrice='{$array["sellingPrice"]}'";								 
	
	$result = mysqli_query($link, $query);
	if (!$result) 	
		error_handler("ERROR: Failed to add record to database."  . mysqli_error($link));
	else 
	{
		// Save the user stats
		if (isset($_SESSION["username"]))
			update_user_stats("Added Model");
		
		$productCode=mysqli_insert_id($link);	// Get the Id for the record just inserted	
		// Build redirect and url variables
		$location="/modelcarsystem/show_model.html.php? status=new& productCode=$productCode& productName='{$array["productName"]}'& productLine='{$array["productLine"]}'& productScale='{$array["productScale"]}'& productVendor='{$array["productVendor"]}'& productDescription='{$array["productDescription"]}'& quantityInStock='{$array["quantityInStock"]}'& buyPrice='{$array["buyPrice"]}'& sellingPrice='{$array["sellingPrice"]}'";
		header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location); /* Redirect user */
		exit();
	}	
?>