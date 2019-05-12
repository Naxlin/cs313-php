<?php  
	session_start();
	$_SESSION['cart'] = array();
    header("Location: browsing.php");
?>