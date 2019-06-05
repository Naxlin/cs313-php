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
			$msg = $_SESSION['valid'];
			if ($msg == 'mismatch' || $msg == 'length' || $msg == 'number') {
				echo 'class="error"';
			}  
		?>>
		<label for="3">Confirm: </label>
		<input id="3" type="password" name="passC" placeholder="Confirm Pass" required
		<?php
			$msg = $_SESSION['valid'];
			if ($msg == 'mismatch' || $msg == 'length' || $msg == 'number') {
				echo 'class="error"';
			}  
		?>>
		<button type="button" onclick="validate()">Sign-up</button>
	</form>

	<div id="sub"></div>

	<p id="match" class="error hide">The passwords did not match, try again.</p>
	<p id="length" class="error hide">The password must be at least 7 characters.</p>
	<p id="number" class="error hide">The password needs to contain a number and letters.</p>

	<?php
		$msg = $_SESSION['valid'];
		if ($msg == 'mismatch') {
			echo '<p class="error">The passwords did not match, try again.</p>';
		} else if ($msg == 'length') {
			echo '<p class="error">The password must be at least 7 characters.</p>';
		} else if ($msg == 'number') {
			echo '<p class="error">The password needs to contain a number and letters.</p>';
		}
	?>

	<a href="login.php">Login</a>
	<script type="text/javascript" src="cred.js"></script>
</body>
</html>