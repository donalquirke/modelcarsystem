<?php
	/* Controller to show user error messages */
	//session_start();
			
	function error_handler($output)
	{
		$_SESSION["error"]=$output;
		$location="/modelcarsystem/error.html.php"; 
		header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location); /* Redirect user */
		exit();		
	}
	
	function handle_bad_modelform_data($field,$errType,$action)
	{
		switch ($errType)
		{
			case "blank":
				$output=$field . " can't be blank";
				break;
			case "not_numeric":
				$output=$field . " must be numeric";
				break;
			case "not_price":
				$output=$field . " must be a price";
				break;				
		}
		
		$_SESSION["message"]=$output;

		switch ($action)
		{
			case CM_UPDATE:
				update_redirect();  // had to do it this crazy way because couldn't figure out how to set status properly
				break;              // DQ NOTE could try "' . $action . '"
			case CM_ADD:
				add_redirect();
				break;
		}		
	}	
	
	function update_redirect ()
	{
		$location="/modelcarsystem/model_form.html.php? status=CM_UPDATE& productName={$_POST['productName']}& productLine={$_POST['productLine']}& productScale={$_POST['productScale']}& productVendor={$_POST['productVendor']}& productDescription={$_POST['productDescription']}& quantityInStock={$_POST['quantityInStock']}& buyPrice={$_POST['buyPrice']}& sellingPrice={$_POST['sellingPrice']}";	
		header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location); /* Redirect user */
		exit();
	}
	
	function add_redirect ()
	{
		$location="/modelcarsystem/model_form.html.php? status=CM_ADD& productName={$_POST['productName']}& productLine={$_POST['productLine']}& productScale={$_POST['productScale']}& productVendor={$_POST['productVendor']}& productDescription={$_POST['productDescription']}& quantityInStock={$_POST['quantityInStock']}& buyPrice={$_POST['buyPrice']}& sellingPrice={$_POST['sellingPrice']}";	
		header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location); /* Redirect user */
		exit();
	}
?>