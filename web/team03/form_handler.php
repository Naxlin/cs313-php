<?php require "form_header.php"; ?>
	<div class="page-container">
		<div class="label">Name: </div>
		<div class="value">
			<?php 
				echo htmlspecialchars($_POST['name']);
			?>
		</div>
		<br>
		<div class="label">Email: </div>
		<?php  
			echo "<a href=\"mailto:" . $_POST['email'] . "\">";
		?>
			<div class="value">
				<?php 
					echo htmlspecialchars($_POST['email']);
				?>
			</div>
		</a>
		<br>
		<div class="label">Major: </div>
		<div class="value">
			<?php 
				echo $_Session['majors'][$_POST['major']];
			?>
		</div>
		<br>
		<div class="label">Comments: </div>
		<div class="value">
			<?php 
				echo htmlspecialchars($_POST['comments']);
			?>
		</div>
		<br>
		<div class="label">Visited Continents: </div>
		<div class="value">
			<?php
				if (sizeof($_POST['visited_continents']) == 0) {
					echo "<div class='continent'>None</div>";
				} else {
					foreach($_POST['visited_continents'] as $continent) {
						$value = $_Session['continents'][$continent];
						echo "<div class='continent'>$value</div>";
					}	
					unset($continent);
				}
			?>
		</div>
	</div>
</body>
</html>