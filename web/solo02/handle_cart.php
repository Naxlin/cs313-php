<?php 
	session_start();

	$requestString = $_REQUEST['request'];
	$request = json_decode($requestString, true);

	$commandMap = array("cartAdd"=>"cartAdd", "cartRemove"=>"cartRemove", "cartMinus"=>"cartMinus", "cartPlus"=>"cartPlus");
	$commandMap[$request['cmd']]($request);

	function cartAdd($obj) {
		$name = $obj['name'];
		if (!$obj['clear']) {
			$_SESSION['cart'][$name] = 1;
			echo json_encode($_SESSION['cart'][$name]);
		}
	}

	function cartMinus($obj) {
		$name = $obj['name'];
		$_SESSION['cart'][$name] -= 1;
		if ($_SESSION['cart'][$name] <= 0) {
			unset($_SESSION['cart'][$name]);
		}
		echo json_encode($_SESSION['cart'][$name]);		
	}

	function cartPlus($obj) {
		$name = $obj['name'];
		$_SESSION['cart'][$name] += 1;
		echo json_encode($_SESSION['cart'][$name]);
	}

	function cartRemove($obj) {
		$name = $obj['name'];
		if (array_key_exists($obj['name'], $_SESSION['cart'])) {
			if ($obj['clear']) {
				unset($_SESSION['cart'][$name]);
			} 
			echo json_encode($_SESSION['cart']);
		}
	}
?>