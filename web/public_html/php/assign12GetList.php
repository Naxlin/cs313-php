<?php // Returns the content of the following file.
	$file = "../data/registrationList.json";
	$handle = fopen($file, 'r') or die("Can't open: " . $file);
	echo fread($handle, filesize($file));
	fclose($handle);
?>