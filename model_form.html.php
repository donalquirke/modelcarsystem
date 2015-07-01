<!DOCTYPE HTML>
<!-- Display a form to get user enter details for a model to be added to database -->
<html>
	<head>
		<title>"Classic Models: Model"</title>
		<meta charset="utf-8">	
		<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>
	
	<body>	
		<?php
		    session_start(); // Get the session
			require_once "definitions.php";
			include('header.html.php');  // Show banner at top of screen with login etc		
			
			// authenticate 
			// Redirect illegal attempt - only logged in users allowed past here		
			if (!isset($_SESSION["username"]))
			{
				$location="/modelcarsystem/index.php?";  	
				header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location); 
				exit();
			}

			if (isset($_SESSION["message"]))
			{
				echo '<div id="error_message">'; echo $_SESSION["message"]; echo '</div>';
				unset($_SESSION["message"]);
			}					
		?>
		<!-- DQ ADD USER AUTHENTICATION -->
				

		<!-- Show the form to get the model info -->
		<div id="add_model_form">
			<?php
			// find the scenario, add, edit or delete
			if (isset($_GET['status']))
			{				
				// Store the productCode into sessions for use by other controllers	
				if (isset($_GET["productCode"]))
					$_SESSION["productCode"]=$_GET["productCode"];
				switch($_GET['status'])
				{
					case "CM_UPDATE":
						$buttonText=CM_UPDATE;
						echo '<form method="POST" action="update_model.php">';	
						break;								
					case "CM_ADD":
					default:
						$buttonText=CM_ADD;
						echo '<form method="POST" action="add_model.php">';
						break;						
				}
			}
			else
			{
				echo '<form method="POST" action="add_model.php">';
				$buttonText=CM_ADD;
			}
				
					
			?>
				<table>
					<tr>
						<td>Model Name</td>
						<td><input type="text" size="70" name="productName" value="<?php if(isset($_GET['productName'])) echo $_GET['productName']; ?>"/></td>
					</tr>
					<tr>
						<td>Line</td>
						<td><input type="text" size="50" name="productLine" value="<?php if(isset($_GET['productLine'])) echo $_GET['productLine']; ?>"/></td>
					</tr>
					<tr>
						<td>Scale</td>
						<td><input type="text" size="10" name="productScale" value="<?php if(isset($_GET['productScale'])) echo $_GET['productScale']; ?>"/></td>
					</tr>
					<tr>
						<td>Vendor</td>
						<td><input type="text" size="50" name="productVendor" value="<?php if(isset($_GET['productVendor'])) echo $_GET['productVendor']; ?>"/></td>
					</tr>	
					<!--<tr>
						  
						<td>Description</td>
						<td><input type="text" size="100" name="productDescription" value="<?php if(isset($_GET['productDescription'])) echo $_GET['productDescription']; ?>"/></td>
					</tr> -->
					<tr>
						<td>Description</td>
						<td><textarea rows="5" cols="80" name="productDescription" ><?php if(isset($_GET['productDescription'])) echo $_GET['productDescription']; ?></textarea></td>
						
					</tr>
					<tr>
						<td>Quantity in Stock</td>
						<td><input type="int" name="quantityInStock" value="<?php if(isset($_GET['quantityInStock'])) echo $_GET['quantityInStock']; ?>"/></td>
					</tr>
					<tr>
						<td>Buying Price</td>
						<td><input type="float" name="buyPrice" value="<?php if(isset($_GET['buyPrice'])) echo $_GET['buyPrice']; ?>"/></td>
					</tr>
					<tr>
						<td>Selling Price</td>
						<td><input type="float" name="sellingPrice" value="<?php if(isset($_GET['sellingPrice'])) echo $_GET['sellingPrice']; ?>"/></td>
					</tr>																
            	</table>
            	<p><input id="add_model_form_submit" type="submit" value="<?php echo $buttonText; ?>"></p>
		</div>		
	</body>
</html> 
