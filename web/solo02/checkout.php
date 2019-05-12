<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Minecraft Checkout</title>
	<link rel="shortcut icon" type="image/png" href="../favicon.png"/>
	<link rel="stylesheet" type="text/css" href="./shopping.css">
	<script type="text/javascript" src="shopping.js"></script>
</head>
<body>
	<?php require("./header.php"); ?>

	<div class="page-container">
		<div class="item checkout-list">
			<?php  
				$file_contents = file_get_contents("./items.json");
				$items_list = json_decode($file_contents, true);

				$total = 0;
				foreach ($_SESSION['cart'] as $name => $count) {
					if($items_list[$name] != null){
						$value = $items_list[$name];
						echo "<p>" . $name . "</p>";
						echo "<p>" . $count . " x " . $value['price'] . "</p>";
						$val = str_replace("$", "", $value['price']);
						$total += (float)$count * (float)$val;
					}
				}

				echo "<hr><p>Total: </p>";
				$rounded = round($total, 2);
				echo "<p>\$$rounded</p>";
				$_SESSION['total'] = $rounded;
			?>
		</div>
		<form class="item address-container" name="address" method="post" action="confirm.php">
			<h2>Enter Shipping Address</h2>
			<label for="address">Address: </label>
			<input type="text" name="address" id="address" required>
			<label for="city">City: </label>
			<input type="text" name="city" id="city" required>
			<label for="state">State: </label>
			<input type="text" name="state" id="state" required>
			<label for="country">Country: </label>
			<input type="text" name="country" id="country" required>
			<button id='reset' type="reset">Clear Address</button>
			<button id='submit' type="submit">Make Purchase</button>
		</form>
	</div>

	<?php require("./footer.php") ?>
</body>
</html>