<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Sign-up Page</title>
	<link rel="stylesheet" type="text/css" href="cred.css">
</head>
<body>
	<form id="form" method="POST" action="action.php">
		<input type="text" name="check" style="visibility: hidden;" value="false">
		<label for="1">Username: </label>
		<input id="1" type="text" name="user" placeholder="Username" required>
		<label for="2">Password: </label>
		<input id="2" type="password" name="pass" placeholder="Password" required
		<?php
			if ($_SESSION['match'] == 'false') {
				echo 'class="error"';
			}  
		?>>
		<label for="3">Confirm: </label>
		<input id="3" type="password" name="passC" placeholder="Confirm Pass" required
		<?php
			if ($_SESSION['match'] == 'false') {
				echo 'class="error"';
			}  
		?>>
		<button type="submit">Sign-up</button>
	</form>

	<a href="login.php">Login</a>
</body>
</html>