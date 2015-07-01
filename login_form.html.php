<!DOCTYPE HTML>
<!-- Display a form to get user enter details for a model to be added to database -->
<html>
	<head>
		<title>"Classic Models: Login"</title>
		<meta charset="utf-8">	
		<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>
	
	<body>
		<?php
		    session_start(); // Get the session
			require_once "definitions.php";
			include('header.html.php');  // Show banner at top of screen with login etc		
							// If there is an error message, from a failed login, show it here
				if (isset($_GET["status"]) && (strcmp($_GET["status"],"fail")==0))
				{
					echo '<div id="login_message">'; echo $_SESSION["message"]; echo '</div>';
					unset($_SESSION["message"]);
				} 		
		?>
		<!-- DQ ADD USER AUTHENTICATION -->
		

		<!-- Show the form to get the model info -->
		<div id="login_form">
			<form method="POST" action="login.php">
				<table>
					<tr>
						<td>Username</td>
						<td><input type="text" size="20" name="username"></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="password" size="20" name="password"></td>
					</tr>																
            	</table>
            	<p><input id="login_form_submit" type="submit" value="Log In"></p>
		</div>		
	</body>
</html> 
