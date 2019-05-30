<?php  session_start(); ?>

<!DOCTYPE html>
<html>
<head>
	<title>Dalgoni Codex</title>
	<script type="text/javascript" src="index.js"></script>
	<link rel="shortcut icon" type="image/png" href="../Fairy Tail Guild Icon.ico"/>
	<!-- DEBUG LINE REMOVE OR COMMENT OUT BEFORE NORMAL PAGE USE -->
	<!-- <meta http-equiv="refresh" content="1" >  -->
</head>
<body onload="getSingularity('')">
	<?php require 'header.php'; ?>

	<div id="overview1" class="page-container" style="display: none;">
		<h3 class="header-awakening width-seventy">The most amazing Minecraft modpack</h3>
		<img id="awakening" src="awakening logo.png">

		<p id="needs-calculation" class=" width-fourty">Needs a lot of calulation</p>

		<p class="awakening-desc">Awakening modpack aims to be a pack unlike any other. It is designed to be a long term use pack e.g. for a long Minecraft let’s play series or just an everyday pack to keep you playing for a long time, with over 300 mods and well over 800 quests (and growing). Say no to defaults! Nearly every mod and config in this pack has been edited or modified to make them work better together. The ultimate idea of the pack is to integrate mods together so well that you wouldn’t know they were ever meant to be separate. Is this the most highly customized and ambitious modpack ever made? Probably. Try it and see for yourself.</p>

		<div id="calculators" class="button-calc" onclick="toggleCalculators(this.id)">See Calculators</div>
	</div>

	<div id="calculators1" class="calculator-container">
		<div class="calc-list">
			<div id="singularity" class="button-calc calc-active" onclick="switchToCalculator(this.id)">Singularity Calculator</div>
			<div id="thaumcraft" class="button-calc" onclick="switchToCalculator(this.id)">Thaumcraft Calculator</div>
			<div id="tinkers" class="button-calc" onclick="switchToCalculator(this.id)">Tinkers Construct Calculator</div>
		</div>

		<div class="calculator">
			<div id="singularity1" class="singularity">
				
			</div>

			<div id="thaumcraft1" class="thaumcraft" style="display: none;">
				<div id="thaumcraftForm">
					<button type="button" onclick="thaumcraftForm()">Apply Aspects</button>
					<div class="thaum-form-col">
						<h3 class="index-h3">Item</h3>
						<input id="thaumItem" type="text" placeholder="Item">
						<hr>
						<div id="thaumItemCol" class="thaum-item-col">
							<!-- Example div returned from search query. Many might be returned. -->
							<div id="itemCont5"> 
								<input id="item5" type="checkbox" name="items[]" value="5" onclick="toggleItem(this.id)">
								<label for="item5">Fifth Item</label>
							</div>
						</div>
					</div>
					<div class="thaum-form-col">
						<h3 class="index-h3">Aspects</h3>
						<input id="thaumAspect" type="text" placeholder="Aspect">
						<hr>
						<div id="thaumAspectCol" class="thaum-aspect-col">
							<!-- Example div returned from search query. Many might be returned. -->
							<div id="aspCont5"> 
								<input id="aspect5" type="checkbox" name="aspects[]" value="5" onclick="toggleAspect(this.id)">
								<label for="aspect5">Fifth Aspect</label>
								<input id="amount5" type="text" name="amounts[]" style="display: none">
							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="tinkers1" class="tinkers" style="display: none;">
				
			</div>
		</div>

		<div id="overview" class="button-calc" onclick="toggleCalculators(this.id)">Calculator Overview</div>

	</div>
	
	<?php require 'footer.php'; ?>
</body>
</html>
