<!DOCTYPE html>
<html>
<head>
	<title>Purchase Confirmation</title>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<script type="text/javascript" src="../js/assign10.js"></script>
	<link rel="stylesheet" type="text/css" href="../css/assign10.css">
	<link rel="icon" href="../house.png">
</head>

<body>
	<div id="formContainer">
		<h1 class="borderNormal textDrop">Purchase Confirmation</h1>

		<div id="confirmContainer" class="borderNormal textDrop">

			<?php
				// If this were a real website it would have the prices
				// from the server, meaning I would do a get to grab the 
				// prices from the database, but for the assignment they
				// will just be in two different places in the php & js.
			  $costumeNames = ["Guys Skull Costume",
												 "Girls Red Riding Hood Costume",
												 "Womans Pirate Costume",
												 "Couples Incredibles Costumes",
												 "Wonder Woman Costume",
												 "Boys Vampire Costume",
												 "Boys Superman Costume",
												 "Guys Madhatter Costume",
												 "Sissorhands Costume"];
				$costumePrices = [23.46, 42.52,	12.50, 
								  				20.10, 53.21, 15.75, 
								  				60.45, 20.32,	14.99];
				$expMonth = ["", "January", "February", "March",
			              "April", "May", "June", "July",
			            	"August", "September", "October",
			            	"November", "December"];
				// GET Request variables:
				$costumes = $_GET['costume'];
				$nameFirst = $_GET['nameFirst'];
				$nameMid = $_GET['nameMid'];
				$nameLast = $_GET['nameLast'];
				$phone = $_GET['phone'];
				$street = $_GET['street'];
				$city = $_GET['city'];
				$state = $_GET['state'];
				$zip = $_GET['zip'];
				$card = $_GET['card'];
				$cardNum = $_GET['cardNum'];
				$cardM = $_GET['cardM'];
				$cardY = $_GET['cardY'];
				$total;

				echo "<p><h2><strong>Name</strong></h2>";
				echo $nameFirst . " " . $nameMid . " " . $nameLast . "</p>";
				echo "<p><h2><strong>Phone #</strong></h2>";
				echo $phone . "</p>";
				echo "<p><h2><strong>Address</strong></h2>";
				echo $street . "<br/>";
				echo $city . " " . $state . " " . $zip . "</p>";
				echo "<p><h2><strong>$card Card</strong></h2>";
				echo $cardNum . "<br/>";
				echo "Expires - " . $expMonth[ltrim($cardM, '0')] . " " . $cardY . "</p>";
				echo "<p><h2><strong>Costumes</strong></h2>";
				foreach ($costumes as $key) {
					$total += $costumePrices[$key];
					echo $costumeNames[$key] . " - $" . $costumePrices[$key] . "<br/>";
				}
				echo "</p><p><h2><strong>Total</strong></h2>";
				echo "$" . $total . "</p>";

			?>
			<form id="buttonContainer" class="flexRow" action="assign10_a.php">
				<?php 
					$first = $_GET['nameFirst'];
					echo "<input type=\"text\" name=\"first\" style=\"display:none\" value=\"$first\">"; 
				?>
				<button type="submit" class="borderThin textDrop button widthThird" name="submit" value="1">Confirm Purchase</button>
				<button type="submit" class="borderThin textDrop button widthThird" name="submit" value="2">Cancel Purchase</button>
			</form>
		</div>
	</div>

</body>
</html>