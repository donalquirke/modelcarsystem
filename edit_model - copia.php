<?php	
 	// Controller to edit a model
	require_once("definitions.php");
	require_once('db_functions.inc'); 
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
		
	
 	//session_start();
	// track last user operation
	//$_SESSION["operation"]=CM_EDIT;	
		
	// Connect mysql as user root  
    $link=load_mysqli(CM_HOST,CM_USER,CM_PSW);  // get conection to mysql env
	select_db($link, DB_NAME);  // use the classicmodels database	
	
	$productCode=$_GET['id'];
	$query="SELECT * from products WHERE productCode={$productCode}";
	
	if(!($result=mysqli_query($link,$query)))
		error_handler("Error: Failed to read record from database" . mysqli_error($link));

	$model=mysqli_fetch_array($result);
	
	// Save the user stats
	if (isset($_SESSION["username"]))
			update_user_stats("Edited Model");
	
	// add these to a session variable and call the form
	// 
	$location="/modelcarsystem/model_form.html.php? status=CM_UPDATE&
		 	productCode={$model['productCode']}&  
			productName={$model['productName']}&
			productLine={$model['productLine']}&
			productScale={$model['productScale']}&
			productVendor={$model['productVendor']}&
			quantityInStock={$model['quantityInStock']}&
			buyPrice={$model['buyPrice']}&
			sellingPrice={$model['sellingPrice']}";
	header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location); /* Redirect user */

	exit();
	
	close_db($link);
?>
	