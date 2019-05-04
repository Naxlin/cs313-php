<footer>
	<div class="footer-container center">		
		<nav class="flexbox-col center">
			<a href="index.php" class="width-full">
				<div class="button-nav flex-item flex-item-footer
				<?php  
					if (basename($_SERVER['PHP_SELF']) == "index.php") {
						echo " active";
					}
				?>
				">Index</div>
			</a>
			<a href="assignments.php" class="width-full">
				<div class="button-nav flex-item flex-item-footer
				<?php  
					if (basename($_SERVER['PHP_SELF']) == "assignments.php") {
						echo " active";
					}
				?>
				">Assignments</div>
			</a>
			<a href="projectI.php" class="width-full">
				<div class="button-nav flex-item flex-item-footer
				<?php  
					if (basename($_SERVER['PHP_SELF']) == "projectI.php") {
						echo " active";
					}
				?>
				">Project I</div>
			</a>
			<a href="creatures.php" class="width-full">
				<div class="button-nav flex-item flex-item-footer
				<?php  
					if (basename($_SERVER['PHP_SELF']) == "creatures.php") {
						echo " active";
					}
				?>
				">Creatures</div>
			</a>
		</nav>
		<div class="footer-credit">
			<p><strong>Dalgoni's Author</strong> - Jonathan Smith</p>
			<p>naxlin.everthaine@gmail.com</p>	
			<p><strong>Webpage Author</strong> - Jonathan Smith</p>
			<p>© copyright 2019</p>	
		</div>
	</div>
</footer>