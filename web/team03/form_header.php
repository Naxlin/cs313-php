<?php 
	session_start();
	$_Session['majors'] = array(
		"CS" => "Computer Science",
		"SE" => "Software Engineering",
		"WDD" => "Web Design and Development",
		"CIT" => "Computer Information Technology",
		"CE" => "Computer Engineering"

	);
	// sort($_Session['majors']);
	$_Session['continents'] = array(
		"NA" => "North America",
		"SA" => "South America",
		"EU" => "Europe",
		"AS" => "Asia",
		"AU" => "Australia",
		"AN" => "Antartica"

	);
	// sort($_Session['continents']);
?>
<!DOCTYPE html>
<html>
<head>
	<title>PHP Form Example</title>
	<link rel="stylesheet" type="text/css" href="form_style.css">
	<!-- DEBUG LINE REMOVE OR COMMENT OUT BEFORE NORMAL PAGE USE -->
	<!-- <meta http-equiv="refresh" content="1" >  -->
</head>
<body>
	<h1>Student Information</h1>
