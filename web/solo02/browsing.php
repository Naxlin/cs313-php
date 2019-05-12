<?php 
	session_start(); 
?>

<!DOCTYPE html>
<html>
<head>
	<title>Minecraft Emporium</title>
	<link rel="shortcut icon" type="image/png" href="../favicon.png"/>
	<link rel="stylesheet" type="text/css" href="./shopping.css">
	<script type="text/javascript" src="shopping.js"></script>
</head>
<body>
	<?php require("./header.php"); ?>

	<form name="items" method="post" action="cart.php" class="node-list">
		<?php  
			$file_contents = file_get_contents("./items.json");
			$items_list = json_decode($file_contents, true);
			$inc = 0;
			foreach ($items_list as $key => $value) {
				$img = $value['img'];
				echo "<div id='node" . $inc . "' class='node";
					if (array_key_exists($key, $_SESSION['cart'])) {
						echo " in-cart";
					}
				echo "' onclick='cart(this.id)'>";
					echo "<h4>" . $key . "</h4>";
					echo "<img src=\"./$img\" width='64' height='64'>";
					echo "<p>" . $value['price'] . "</p>";
				echo "</div>";
				$inc++;
			}
		?>
	</form>

	<?php require("./footer.php") ?>
</body>
</html>