<?php
	/* Controller to handle common validations */
	include_once("definitions.php");
	include_once("error_handler.inc");
		
	function verify_form_fields($link,$action)  // $action is passed straight through to show_model_form, via the error handler. Used to call appropriate controller
	{
		// Make sure the data set just entered by user is complete before adding record to database. If not, show a warning and exit

		if (empty($_POST['productName']))
			handle_bad_modelform_data("Model Name","blank",$action); 
		if (empty($_POST['productLine']))
			handle_bad_modelform_data("Line","blank",$action);	
		if (empty($_POST['productScale']))
			handle_bad_modelform_data("Scale","blank",$action);	
		if (empty($_POST['productVendor']))
			handle_bad_modelform_data("Vendor","blank",$action);
		if (empty($_POST['productDescription']))
			handle_bad_modelform_data("Description","blank",$action);	
		if (empty($_POST['quantityInStock']))
			handle_bad_modelform_data("Quantity in stock","blank",$action);
		if (empty($_POST['buyPrice']))
			handle_bad_modelform_data("Buying price","blank",$action);	
		if (empty($_POST['sellingPrice']))
			handle_bad_modelform_data("Selling price","blank",$action);	
		if (!is_numeric($_POST['quantityInStock']))	
			handle_bad_modelform_data("Quantity in stock","not_numeric",$action);	
		//if (!ereg("^[0-9]{1,3}[.][0-9]{2}$", $_POST['buyPrice']))
		if (!is_numeric($_POST['buyPrice']))		
			handle_bad_modelform_data("Buying price","not_price",$action);
		//if (!ereg("^[0-9]{1,3}[.][0-9]{2}$", $_POST['sellingPrice']))
		if (!is_numeric($_POST['sellingPrice']))	
			handle_bad_modelform_data("Selling price","not_price",$action);					
											

		// Sanatise submitted data from form
		$array["productName"]= mysqli_real_escape_string($link,$_REQUEST["productName"]); 
		$array["productLine"]= mysqli_real_escape_string($link,$_REQUEST["productLine"]);
		$array["productScale"]= mysqli_real_escape_string($link,$_REQUEST["productScale"]);	
		$array["productVendor"]= mysqli_real_escape_string($link,$_REQUEST["productVendor"]);	
		$array["productDescription"]= mysqli_real_escape_string($link,$_REQUEST["productDescription"]);	
		$array["quantityInStock"]= mysqli_real_escape_string($link,$_REQUEST["quantityInStock"]);	
		$array["buyPrice"]= mysqli_real_escape_string($link,$_REQUEST["buyPrice"]);	
		$array["sellingPrice"]= mysqli_real_escape_string($link,$_REQUEST["sellingPrice"]);												
		return($array);

	}
?>