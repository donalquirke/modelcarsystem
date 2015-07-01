<!DOCTYPE HTML>
<!-- Display a form to get user enter details for a model to be added to database -->
<html>
	<head>
		<title>"Classic Models: Error Consol"</title>
		<meta charset="utf-8">	
		<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>
	
	<body>
		
		<?php
		    session_start(); // Get the session
			require_once "definitions.php";
			include('header.html.php');  // Show banner at top of screen with login etc	
				
			if (isset($_SESSION["error"]))
			{
				echo '<div id="error_message">'; echo $_SESSION["error"]; echo '</div>';
				unset($_SESSION["error"]);				
			}	
			else {
				echo '<div id="error_message">'; echo 'Some nasty unspecified error just happened.'; echo '</div>';				
			}	
		?>
		
	</body>
</html> 
