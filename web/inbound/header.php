<link rel="stylesheet" type="text/css" href="index.css">

<header>
	<div class="header-container">
		<a href="http://flippybitandtheattackofthehexadecimalsfrombase16.com/"><img src="resources/starflame.png" class="float-left header-img-left"></a>
		<img src="resources/starflame.png" class="float-right header-img-right">
		<h1>
			<?php 
				if (basename($_SERVER['PHP_SELF']) == "index.php") {
					echo "The Dalgoni Codex";
				} elseif (basename($_SERVER['PHP_SELF']) == "creatures.php") {
					echo "Dalgoni Creature Compendium";
				} elseif (basename($_SERVER['PHP_SELF']) == "assignments.php") {
					echo "CS 313 Assignments";
				} elseif (basename($_SERVER['PHP_SELF']) == "projectI.php") {
					echo "Awakening Calculator";
				} elseif (basename($_SERVER['PHP_SELF']) == "about.php") {
					echo "Jonathan Smith's ePortfolio";
				} elseif (basename($_SERVER['PHP_SELF']) == "cs213assignments.php") {
					echo "CS 213 Assignments";
				} 
			?>
		</h1>		
	</div>
	<nav class="flexbox-row float-clear">
		<a href="index.php">
			<div class="button-nav flex-item
			<?php  
				if (basename($_SERVER['PHP_SELF']) == "index.php") {
					echo " active";
				}
			?>
			">Index</div>
		</a>
		<a href="cs213assignments.php">
			<div class="button-nav flex-item
			<!-- <?php  
				if (basename($_SERVER['PHP_SELF']) == "cs213assignments.php") {
					echo " active";
				}
			?> -->
			">CS 213 Assignments</div>
		</a>
		<a href="assignments.php">
			<div class="button-nav flex-item
			<?php  
				if (basename($_SERVER['PHP_SELF']) == "assignments.php") {
					echo " active";
				}
			?>
			">CS 313 Assignments</div>
		</a>
		<a href="projectI.php">
			<div class="button-nav flex-item
			<?php  
				if (basename($_SERVER['PHP_SELF']) == "projectI.php") {
					echo " active";
				}
			?>
			">CS 313 Project I</div>
		</a>
		<a href="creatures.php">
			<div class="button-nav flex-item
			<?php  
				if (basename($_SERVER['PHP_SELF']) == "creatures.php") {
					echo " active";
				}
			?>
			">Creatures</div>
		</a>
		<a href="about.php">
			<div class="button-nav flex-item
			<?php  
				if (basename($_SERVER['PHP_SELF']) == "about.php") {
					echo " active";
				}
			?>
			">About</div>
		</a>
	</nav>
</header>