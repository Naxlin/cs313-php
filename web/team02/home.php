<?php
	session_start();
?>

<!DOCTYPE html>
<html>
<head>
	<title>Home</title>
</head>
<body>
	<?php 
		include 'header.php';
	?>
	<br>
	<div class="page-container">
		<h2>Welcome to Thayne Inc!</h2>
		<p>Here you will learn how to code in php.</p>
		<?php  
			$username = $_SESSION['username'];
			if ($username != NULL) {
				if ($username == "Admin") {
					echo "<p>You are logged in as: " . $username . "istrator</p>";
				} else {
					echo "<p>You are logged in as: $username</p>";
				}
			} else {
				echo "<p><span class='bold'>You are not logged in.</span><br>Login to access all site features.</p>";		
			}
		?>
	</div>
</body>
</html>
