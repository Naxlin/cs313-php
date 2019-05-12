<link rel="stylesheet" type="text/css" href="shopping.css">

<header>
	<?php
		if (basename($_SERVER['PHP_SELF']) == "browsing.php") {
			echo '<a href="cart.php">';
			echo '<img src="cart.png" class="cart-link" height="64" width="64">';
			echo '</a>';
			echo '<a href="browsing.php"><h1>The Minecraft Emporium</h1></a>';
		} else if (basename($_SERVER['PHP_SELF']) == "cart.php") {
			echo '<a href="checkout.php">';
			echo '<img src="checkout.png" class="cart-link" height="64" width="64">';
			echo '</a>';
			echo '<a href="browsing.php"><h1>Minecraft Cart</h1></a>';
		} else if (basename($_SERVER['PHP_SELF']) == "checkout.php") {
			echo '<a href="cart.php">';
			echo '<img src="cart.png" class="cart-link" height="64" width="64">';
			echo '</a>';
			echo '<a href="browsing.php"><h1>Minecraft Checkout</h1></a>';
		} else if (basename($_SERVER['PHP_SELF']) == "confirm.php") {
			echo '<a href="browsing.php"><h1>Minecraft Confirmation</h1></a>';
		}
	?>
	

</header>