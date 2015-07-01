<!DOCTYPE HTML>
<!-- Display a form to get user enter details for a model to be added to database -->
<html>
	<head>
		<title>"Classic Models: Login"</title>
		<meta charset="UTF-8 (Without BOM)">	
		<link rel="stylesheet" type="text/css" href="main.css"/>
	</head>
	
	<body>
		<?php
			require_once "definitions.php";
			include('header.html.php');  // Show banner at top of screen with login etc	
		?>
		<!-- DQ ADD USER AUTHENTICATION -->
		

		<!-- Show the form to get the model info -->
		<div id="login_form">
			<form method="POST" action="add_user.php">
				<table>
					<tr>
						<td>Username</td>
						<td><input type="text" size="20" name="username" value=""/></td>
					</tr>
					<tr>
						<td>Password</td>
						<td><input type="password" size="20" name="password" value=""/></td>
					</tr>																
            	</table>
            	<p><input id="login_form_submit" type="submit" value="Add User"></p>
		</div>		
	</body>
</html> 
