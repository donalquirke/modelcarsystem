<!-- Loads the banner for top of page -->		
	<div class=container>
		<div id="main_banner">
			<!-- <img id="logo_banner" src="http://localhost:8090/modelcarsystem/images/classicmodels-logo.png"> -->
			<a id="header_logo" href="index.php">
				Classic Models
			</a>
			<?php			
				if (isset($_SESSION["username"]))
				{
					echo '<a id="header_signin" href="/modelcarsystem/logout.php">log out</a>';
					echo '<a id="header_signin" href="/modelcarsystem/user_stats.php">'; echo $_SESSION["username"]; echo '</a>';	
					echo '<a id="header_signup" href="/modelcarsystem/model_form.html.php?status='; echo CM_ADD; echo'">add model</a>';	
				}
				else
				 {
					echo '<a id="header_signin" href="add_user_form.html.php">sign up</a>';
					echo '<a id="header_signup" href="/modelcarsystem/login_form.html.php">log in</a>';							
				}
			
			?>
			
		</div>	
	</div>

