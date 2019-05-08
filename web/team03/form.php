	<?php 
		require("form_header.php");
	?>
	<main>
		<form name="form_example" method="post" action="form_handler.php">
			<label class="label" for="name">Name: </label><input class="text" type="text" name="name" id="name"><br>
			<label class="label" for="email">Email: </label><input class="text" type="text" name="email" id="email"><br><br>
			<label class="label" for="major">Major: </label><br>
			<div id="major_radio">
				<?php
					foreach ($_Session['majors'] as $key_major => $major) {
						echo "<input type=\"radio\" name=\"major\" id=\"$key_major\" value=\"$key_major\">";
						echo "<label for=\"$key_major\">$major</label><br>";
					}
					unset($key_major);
					unset($major);
				?>
				<!-- <input type="radio" name="major" id="computer-science" value="Computer Science">
				<label for="computer-science">Computer Science</label><br>
				<input type="radio" name="major" id="web-design-development" value="Web Design and Development">
				<label for="web-design-development">Web Design and Development</label><br>
				<input type="radio" name="major" id="computer-information-technology" value="Computer Information Technology">
				<label for="computer-information-technology">Computer Information Technology</label><br>
				<input type="radio" name="major" id="computer-engineering" value="Computer Engineering">
				<label for="computer-engineering">Computer Engineering</label><br> -->
			</div>
			<br>
			<label class="label" for="visited_continents">What continentes have you visited?</label>
			<div id="visited-continents">
				<?php
					foreach ($_Session['continents'] as $key_continent => $continent) {
						echo "<input type=\"checkbox\" name=\"visited_continents[]\" value=\"$key_continent\" id=\"$key_continent\"><label for=\"$key_continent\">$continent</label><br>";
					}
					unset($key_continent);
					unset($continent);
				?>
				<!--<input type="checkbox" name="visited_continents[]" value="North America" id="na"><label for="na">North America</label><br>
				<input type="checkbox" name="visited_continents[]" value="South America" id="sa"><label for="sa">South America</label><br>
				<input type="checkbox" name="visited_continents[]" value="Europe" id="eu"><label for="eu">Europe</label><br>
				<input type="checkbox" name="visited_continents[]" value="Asia" id="as"><label for="as">Asia</label><br>
				<input type="checkbox" name="visited_continents[]" value="Australia" id="au"><label for="au">Australia</label><br>
				<input type="checkbox" name="visited_continents[]" value="Africa" id="af"><label for="af">Africa</label><br>
				<input type="checkbox" name="visited_continents[]" value="Antartica" id="an"><label for="an">Antartica</label><br>-->
			</div>
			<br>
			<label class="label" for="comments">Comments: </label><br>
			<textarea name="comments" id="comments"></textarea><br>
			
			<br>
			<input class="button" type="submit" name="submit">
			<input class="button" type="reset" name="clear" value="Clear">
		</form>
	</main>

	<!--Potentially this could be put in a separate footer.php file-->
	<footer></footer>
</body>
</html>