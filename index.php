<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<?php
	session_start();	
	unset($_SESSION['SESS_MEMBER_ID']);
	unset($_SESSION['SESS_FIRST_NAME']);
	unset($_SESSION['SESS_LAST_NAME']);
?>

	<!-- General meta information -->
	<title>Login Form</title>
	<meta name="keywords" content="" />
	<meta name="description" content="" />
	<meta name="robots" content="index, follow" />
	<meta charset="utf-8" />
	<!-- // General meta information -->
	
	

	<!-- Load stylesheets -->
	<link type="text/css" rel="stylesheet" href="css/style.css" media="screen" />
	<!-- // Load stylesheets -->
	
<script>


	$(document).ready(function(){
 
	$("#submit1").hover(
	function() {
	$(this).animate({"opacity": "0"}, "slow");
	},
	function() {
	$(this).animate({"opacity": "1"}, "slow");
	});
 	});


</script>
	
</head>
<body>
<?php
			if( isset($_SESSION['ERRMSG_ARR']) && is_array($_SESSION['ERRMSG_ARR']) && count($_SESSION['ERRMSG_ARR']) >0 ) {
			echo '<ul class="err">';
			foreach($_SESSION['ERRMSG_ARR'] as $msg) {
				echo '<center><li>',$msg,'</li><center>'; 
				}
			echo '</ul>';
			unset($_SESSION['ERRMSG_ARR']);
			}
		?>
	<div id="wrapper">
		<div id="wrappertop"></div>

		<div id="wrappermiddle">

			<h2>Login</h2>
                                                 <form name="login" action="login_exec.php" method="post">
			<div id="username_input">

				<div id="username_inputleft"></div>

				<div id="username_inputmiddle">
				
					<input type="text" name="username" id="url" placeholder="Username">
					<img id="url_user" src="./images/mailicon.png" alt="">
				
				</div>

				<div id="username_inputright"></div>

			</div>

			<div id="password_input">

				<div id="password_inputleft"></div>

				<div id="password_inputmiddle">
				
					<input type="password" name="password" id="url" placeholder="Password" >
					<img id="url_password" src="./images/passicon.png" alt="">
				
				</div>

				<div id="password_inputright"></div>

			</div>

			<div id="submit">
				
				<input type="image" src="./images/submit_hover.png" id="submit1" name="submit" value="Sign In">
				<input type="image" src="./images/submit.png"  name="submit" id="submit2" value="Sign In">
				</form>
			</div>


			<div id="links_left">

			<a href="#">Forgot your Password?</a>

			</div>

		</div>

		<div id="wrapperbottom"></div>
		
		<div id="powered">
		<p>Powered by &copy; MPP</p>
		</div>
	</div>

</body>
</html>
