<link rel="stylesheet" type="text/css" href="company.css">
<h1>Thayne Inc</h1>
<div class="topnav">
  <a <?php	
	if(basename($_SERVER['PHP_SELF']) == "home.php"){
		echo "class=\"active\"";
	}
?> href="home.php">Home</a>
  <a <?php	
	if(basename($_SERVER['PHP_SELF']) == "about-us.php"){
		echo "class=\"active\"";
	}
?>href="about-us.php">About</a>
  <a <?php	
	if(basename($_SERVER['PHP_SELF']) == "login.php"){
		echo "class=\"active\"";
	}
?> href="login.php">Login</a>
<a href="logout.php">Logout</a>
</div>
