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
			<a href="cs213assignments.php" class="width-full">
				<div class="button-nav flex-item flex-item-footer
				<?php  
					if (basename($_SERVER['PHP_SELF']) == "cs213assignments.php") {
						echo " active";
					}
				?>
				">CS 213 Assignments</div>
			</a>
			<a href="assignments.php" class="width-full">
				<div class="button-nav flex-item flex-item-footer
				<?php  
					if (basename($_SERVER['PHP_SELF']) == "assignments.php") {
						echo " active";
					}
				?>
				">CS 313 Assignments</div>
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
			<a href="about.php" class="width-full">
				<div class="button-nav flex-item flex-item-footer
				<?php  
					if (basename($_SERVER['PHP_SELF']) == "about.php") {
						echo " active";
					}
				?>
				">About</div>
			</a>
		</nav>
		<hr class="not">
		<nav>
			<a href="https://www.linkedin.com/in/naxlin/" target="_blank" class="width-full">
				<div class="button-nav flex-item flex-item-footer border-top">Linkedin</div>
			</a>
			<a href="https://drive.google.com/file/d/16hMbiYlIlMb5y4YA3oIYnSVzYrEU2N50/view?usp=sharing" target="_blank" class="width-full">
				<div class="button-nav flex-item flex-item-footer">Resume</div>
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