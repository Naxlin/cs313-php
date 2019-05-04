<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Log in</title>
</head>
<body>
<?php 
		include 'header.php';
?>

<form action="session.php" method="post">
<input type="submit" name="username" value="Admin">
<input type="submit" name="username" value="Tester">
</form>
</body>
</html>