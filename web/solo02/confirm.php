<?php session_start(); ?>

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

	<div class="confirmation">
		<h3>Thanks for purchasing from the Minecraft Emporium!</h3>
		<p class="shipping-title">Shipping to</p>
		<?php  
			echo "<p>";
			foreach ($_POST as $key => $value) {
				if ($key == "city") {
					echo "<br>";
				}
				echo htmlspecialchars($value);
				if ($key != "country") {
					echo ", ";
				}
			}
			echo "</p>";
		?>
	</div>

	<div class="node-list">
		<?php  
			$file_contents = file_get_contents("./items.json");
			$items_list = json_decode($file_contents, true);

			$inc = 0;
			foreach ($_SESSION['cart'] as $name => $count) {
				if($items_list[$name] != null) {
					$value = $items_list[$name];
					echo "<div id='node" . $inc . "' class='node-cart'>";
						echo "<h4>" . $name . "</h4>";
						echo "<img src='./" . $value['img'] . "' width='64' height='64'>";
						echo "<p><span>" . $count . " x </span>" . $value['price'] . "</p>";
					echo "</div>";
					$inc++;
				}
			}
		?>
	</div> 

	<?php require("./footer.php") ?>
</body>
</html>

<?php 
	session_destroy();
?>