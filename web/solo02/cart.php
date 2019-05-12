<?php session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Minecraft Cart</title>
	<link rel="shortcut icon" type="image/png" href="../favicon.png"/>
	<link rel="stylesheet" type="text/css" href="./shopping.css">
	<script type="text/javascript" src="shopping.js"></script>
</head>
<body>
	<?php require("./header.php"); ?>

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
						echo "<p>" . $value['price'] . "</p>";
						echo "<button type='button' id='minus' class='button' onclick='cartMod(this.id, \"node" . $inc . "\", \"count" . $inc . "\")'>- -</button>";
						echo "<span id='count" . $inc . "'>" . $count . "</span>";
						echo "<button type='button' id='plus' class='button' onclick='cartMod(this.id, \"node" . $inc . "\", \"count" . $inc . "\")'>++</button>";
					echo "</div>";
					$inc++;
				}
			}
		?>
	</div>

	<?php require("./footer.php") ?>
</body>
</html>