<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Welcome Page</title>
</head>
<body>
	<h1>Welcome to a page with nothing on it</h1>
	<?php  
		if (array_key_exists('logged in', $_SESSION)) {
			$user = $_SESSION['user'];
			echo "<p>$user</p>";
			echo '<a id="logout" href="logout.php">Logout</a>';
		} else {
			echo '<a id="signup" href="signup.php">Sign-up</a><br>';
			echo '<a id="login" href="login.php">Login</a>';
		}
	?>
</body>
</html>