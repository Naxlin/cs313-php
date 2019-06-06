<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome Page</title>
	<link rel="stylesheet" type="text/css" href="cred.css">
</head>
<body>
	<h1>Welcome to a page with nothing on it</h1>
	<?php  
		if (array_key_exists('logged in', $_SESSION)) {
			$user = $_SESSION['user'];
			echo "<p>Welcome $user</p>";
			echo '<a id="logout" href="logout.php">Logout</a>';
		} else {
			echo '<a id="signup" href="signup.php">Sign-up</a><br><br>';
			echo '<a id="login" href="login.php">Login</a>';
		}
	?>
</body>
</html>