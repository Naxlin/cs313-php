<?php
	session_start();
	unset($_SESSION[0]);
	header("Location: home.php");
?>