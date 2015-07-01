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
		
	$array=verify_form_fields($link,CM_UPDATE);
		
	// Grab the productCode from sessions variable
	$productCode=$_SESSION["productCode"];
	
	// Build the SQL
	$query = "UPDATE products SET productName='{$array["productName"]}', 
								 productLine='{$array["productLine"]}',
								 productScale='{$array["productScale"]}',
								 productVendor='{$array["productVendor"]}',
								 productDescription='{$array["productDescription"]}',
								 quantityInStock='{$array["quantityInStock"]}',
								 buyPrice='{$array["buyPrice"]}',
								 sellingPrice='{$array["sellingPrice"]}' 
							WHERE productCode={$productCode}";  
	
	$result = mysqli_query($link, $query);
	if (!$result) 
		error_handler("ERROR: Failed to update the record."  . mysqli_error($link));
	else 
	{
		// Save the user stats
		if (isset($_SESSION["username"]))
			update_user_stats("Updated Model");
		
		// Would be better to do a select from database to be certain of clean update select.  For now use productCode below based on session variable
		// Build redirect and url variables
		$location="/modelcarsystem/show_model.html.php?";
		$location="/modelcarsystem/show_model.html.php? status=CM_UPDATE& productCode=$productCode& productName={$array["productName"]}& productLine={$array["productLine"]}& productScale={$array["productScale"]}& productVendor={$array["productVendor"]}& productDescription={$array["productDescription"]}& quantityInStock={$array["quantityInStock"]}& buyPrice={$array["buyPrice"]}& sellingPrice={$array["sellingPrice"]}";
		header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location); /* Redirect user */
		exit();
	}	
?>