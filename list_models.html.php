<!DOCTYPE html>
<!-- Displays the list of cars read by earlier database query-->
<html>
	<head>
		<title>Model Car System - Daniel Quirke SOFT7008</title>
		<meta charset="utf-8">	
    	<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>
	
	<body>
		
		<?php
			include('header.html.php');  // Show banner at top of screen with login etc
			// if there is a message to show the user, do it now
			if (isset($_SESSION["message"]))
			{
				echo '<div id="good_message">'; echo $_SESSION["message"]; echo '</div>';
				unset($_SESSION["message"]);
			}
			
		?>
		<div id="main_list">
			<h2 id=index_h2>Our Models</h2> 
			<?php			    
				foreach ($models as $model)
				{
					?>
					<strong><?php echo $model['productName']; ?></strong>	
					<?php 
						if (isset($_SESSION["username"]))
						{
							echo '<a href="/modelcarsystem/edit_model.php?id='; echo $model["productCode"]; echo'">[Edit]</a>';
							echo '<a href="/modelcarsystem/confirm_delete.php?id='; echo $model["productCode"]; echo'">[Delete]</a>';
														
						}					
					?>
					<!-- </a><a href="/modelcarsystem/edit_model.php?id=">[Edit]</a>	-->			
					<p></p>
					<?php echo $model['productDescription']; ?>
					<p>
						<div>Price:
							<?php echo $model['sellingPrice'];?>
						</div>
					</p>
					<p>
						<div id=index_stock>Quantity in stock:
							<?php echo $model['quantityInStock']; ?>
						</div>
						
					</p>
				<?php } ?>			
		</div>
		
		<div class="footer">
			<div>
				<a href="http://www.donalquirke.com/modelcarsystem/add_user_form.html.php">
					<img id="index-img-car", src="images/main-page-img.png">
				</a>
			</div>
		</div>

		
	</body>	
</html>