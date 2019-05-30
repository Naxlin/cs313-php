<?php // Saves information given to the registrationList.json file.
	# Variable Setting
	$type = $_GET["performType"];
	$first = $_GET["first"];
	$last = $_GET["last"];
	$id1 = $_GET["id1"];
	if (isset($_GET["first2"])) {
		$first2 = $_GET["first2"];
	}
	if (isset($_GET["last2"])) {
		$last2 = $_GET["last2"];
	}
	if (isset($_GET["id2"])) {
		$id2 = $_GET["id2"];
	}
	$level = $_GET["level"];
	$instrument = $_GET["instrument"];
	$building = $_GET["building"];
	$room = $_GET["room"];
	$time = $_GET["time"];

	// Get the current contents of the file into non-json object.
	$file = file_get_contents("../data/registrationList.json", true);
	$data = json_decode($file, true);
	unset($file);

	// Prepare information for saving.
	$singleReg = array(
		"performType" => $type,
		"first" => $first,
		"last" => $last,
		"id1" => $id1
	);

	if ($first2 != false && $last2 != false && $id2 != false) {
		$singleReg += array(
			"first2" => $first2,
			"last2" => $last2,
			"id2" => $id2
		);
	}

	$singleReg += array(
		"level" => $level,
		"instrument" => $instrument,
		"building" => $building,
		"room" => $room,
		"time" => $time
	);

	// Add information to the object.
	$data[] = $singleReg;
	$result = json_encode($data);
	// Save information as json to file.
	file_put_contents("../data/registrationList.json", $result);
	unset($result);
?>