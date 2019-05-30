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
		<h1 class="borderNormal textDrop">
			<?php
				$buttonClicked = $_GET['submit'];
				if ($buttonClicked == 1) {
					echo "Purchase Confirmed";
				} else {
					echo "Purchase Cancelled";
				}
			?>
		</h1>

		<div id="confirmContainer" class="borderNormal textDrop">
			<?php
				$first = $_GET['first'];
				$buttonClicked = $_GET['submit'];
				if ($buttonClicked == 1) {
					echo "<h2>Your purchase has been made</h2><h2>Thank you</h2>
					      <p style=\"font-family:'Garamond'; font-size: 18px;\">The money you have spent here will ripple throughout time, through the sustainment of my angelic children, who will receive strength from your patronage and become mighty people of valor, to go on and conquer the evils of the world overthrowing the darkness of all lands and uniting them in peace and serenity. And their descendants throughout time will honor the name of the person who empowered them to do their mightiest deeds of conquest and advancement. Indeed, bards will sing praises to your name. Scholars will chronicalize your life and children everywhere will learn of your deeds. Religions may worship you as an angel of grace and generosity. And royalty will be coronated with this pledge: \"I, prince George the III, son of king George the II, son of king George the I, do hearby pledge myself to the purchasing of fine goods in support of all that is good that children of merchants may become mighty in thoughts and deeds, as the great, wonderous, and gracious $first did so long ago, for he empowered our ancestors of old to the conquering of evil and the establishing of peace.\"</p>";
				} else {
					echo "<h2>Your purchase has been cancelled</h2><h2>Curse you</h2>
								<p style=\"font-family:'Garamond'; font-size: 18px;\">The money you flippantly denied us here will rot your very existance throughout time, my children will starve because of you, they will weaken and may even die from your lack of patronage, evil will seek them out in their weakened state and the whole world will fall into darkness and all lands will writhe in carnality and violence. And descendants throughout time will curse the name of the person who stripped them of their opportunities for all that is good, leaving them powerless and conquested by evil. Indeed, jesters will make melancholy to your folly. Scholars will jot down your life as the worst mistake ever made. Cults may worship you as the demon of death and disparity. And royalty will be coronated with this pledge: \"I, prince George the III, son of king George the II, son of king George the I, do hearby pledge myself to be not flippant in my acts, or take advantage of people in their weakness, as the aweful, woeful, and grinch $first did so long ago, for he denied the children of old the peace and prosperity that would have allowed them to conquer the nightmares of their lives and become rising stars.\"</p>";
				}
			?>
		</div>

		<!-- Buttons -->
		<div id="buttonContainer" class="flexRow"> 
			<button class="borderThin textDrop button widthThird" onclick="returnHome()">Return to Shopping</button>
		</div>
	</div>
</body>
</html>