<!DOCTYPE html>
<html>
<head>
	<title>PHP Database Connection Example</title>
</head>
<body>
	<!--This is where the form that allows you to search for a scripture by book will go. The displayed scriptures will be links that will open content in the scripture details section-->
	<div id="scriptureList">
		<form> 
			Book: <input type="text" onkeyup="showHint(this.value)">
		</form>
		<p>Scriptures: <span id="scriptures"></span></p>
	</div>
	<!--This section is where the text of the scripture will go after the link for that scriture is clicked-->
	<div id="scriptureDetails">
		
	</div>
	<script src="scriptureForm.js"></script>
</body>
</html>