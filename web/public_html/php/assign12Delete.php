<?php // Deletes the following file.
	$file = "../data/registrationList.json";
	unlink($file) or die("Failed to delete: " . $file); // Delete file.
	echo "registrationList.json deleted.";
?>