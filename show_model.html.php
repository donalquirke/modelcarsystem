<!DOCTYPE html>
<!-- Displays the list of cars read by earlier database query-->
<html>
	<head>
		<title>View Model</title>
		<meta charset="utf-8">	
		<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>
	
	<body>
		<?php
		    require_once("definitions.php");			
			session_start();
		    include('header.html.php');  // Show banner at top of screen with login etc
		    
		    // authenticate 
			// Redirect illegal attempt - only logged in users allowed past here		
			if (!isset($_SESSION["username"]))
			{
				$location="/modelcarsystem/index.php?";  	
				header("Location: " . "http://" . $_SERVER['HTTP_HOST'] . $location); 
				exit();
			}
		    
			$status=$_GET['status'];
			$productCode=$_GET['productCode'];
			$productName=$_GET['productName'];
			$productLine=$_GET['productLine'];
			$productScale=$_GET['productScale'];
			$productVendor=$_GET['productVendor'];
			$productDescription=$_GET['productDescription'];
			$quantityInStock=$_GET['quantityInStock'];
			$buyPrice=$_GET['buyPrice'];
			$sellingPrice=$_GET['sellingPrice'];
			
			// Sort out what message to show the user. Depends on if they just added a new record or updated an existing one or a delete
			switch ($status)
			{
				case "new":
					echo '<h2 id=index_h2>You\'re great</h2>';
					echo '<h2 id=success_1_h2>Model successfully added</h2>';
					break;	
				case "CM_UPDATE":
					echo '<h2 id=index_h2>You\'re great</h2>';
					echo '<h2 id=success_1_h2>Model successfully updated</h2>';	
					break;
			    case "CM_CONFIRM_DELETE":
					echo '<div id="confirm_message">'; echo 'Are you sure you want to delete this record?'; echo '</div>';
					echo '<form method="POST" action="delete_model.php">';
					break;
			}
		?>   
				
		<div id="main_list">
			<strong><?php echo $productName; ?></strong>						
					<p></p>
					<p>
						<div>Line:
							<?php echo $productLine;?>
						</div>
						<div>Scale:
							<?php echo $productScale;?>
						</div>
						<div>Vendor:
							<?php echo $productVendor;?>
						</div>
						<div>Description:
							<?php echo $productDescription;?>
						</div>
						<div>Quantity in stock:
							<?php echo $quantityInStock; ?>
						</div>						
						<div>Buy price:
							<?php echo $buyPrice; ?>
						</div>						
						<div>Selling price:
							<?php echo $sellingPrice; ?>
						</div>						
					</p>	
					<p>
						<?php
							switch ($status)
							{
								case "new":
								case "CM_UPDATE":
									// Build the urls to be redirected to for another edit or to add a new model						
									echo '<a href="/modelcarsystem/edit_model.php?id=' . $productCode . '">[Edit]</a>';						
									echo '<a href="/modelcarsystem/model_form.html.php?status='; echo CM_ADD; echo '">[Add Another]</a>';
									break;
			    				case "CM_CONFIRM_DELETE":
									echo '<a id="delete_button" href="/modelcarsystem/delete_model.php?id='; echo $productCode; echo'&productName='; echo $productName; echo'">'; echo '[Delete]';  echo '</a>';
									break;
							}
							
						?>
					</p>	
		</div>

		
	</body>	
</html>