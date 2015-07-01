<!DOCTYPE HTML>
<!-- Display a form to get user enter details for a model to be added to database -->
<html>
	<head>
		<title>"Classic Models: User Stats"</title>
		<meta charset="utf-8">	
		<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>
	
	<body>
		
		<?php
		    session_start(); // Get the session
			require_once "definitions.php";
			include('header.html.php');  // Show banner at top of screen with login etc	
				
			if (isset($_SESSION["message"]))
			{
				echo '<div id="good_message">'; echo $_SESSION["message"]; echo '</div>';
				unset($_SESSION["message"]);
			}
			else {
				echo '<div id="good_message">'; echo "Nothing to Show"; echo '</div>';
			}
								
		?>
		
	</body>
</html> 
