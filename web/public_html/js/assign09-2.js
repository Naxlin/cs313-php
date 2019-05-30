// let sum = truly local scope.
// var sum = can be used in the function, no matter where declared.

// Math.pow(n,2); Calculating something to the power of the right side.
// isNaN(variable); Returns true when the variable is not a number.

// Pattern Expressions - /n/ (looks for n) /[abcd]/ (match any 1 of them)
// /[a-z]/ (any lowercase) /[^0-9]/ (anything but those)
// /d = [0-9]
// /D = [^0-9]
// /w = [A-Za-z_0-9]
// /W = [^A-Za-z_0-9]
// /s = [ \r\t\n\f]
// /S = [^ \r\t\n\f]

// specific quantity /xy{4}z/ don't put brackets
// * 0-more | ? 0-1 | + 1-more | ^ left anchor (only on leftside match)
// $ right anchor (only on rightside match)
// /oak/i = ignore the case.
// str.replace(/rab/g, "tim");
// split(para) == str.split(":") or str.split(/,/)
// /^[A-Z][a-z]+, ?[A-Z][a-z]+, ?[A-Z]\.?$/
// check phone # = /^\d{3}-\d{3}-\d{4}$/ or /^\d?(?\d{3})?[ -.]\d{3}[ -.]\d{4}$/
// returns the active element = document.activeElement


// Global variables for stage recognition:
var cwd;

// Functions:
function getId(id) { // Shortened version of the get ID call.
	return document.getElementById(id);
}

function startUp() {
	var xhttp = new XMLHttpRequest();
	xhttp.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			var response = JSON.parse(this.responseText);
			var keys = Object.keys(response);
			var display = "<hr>";
			cwd = response[0].cwd;

			var fnOpen = "<div class=\"borderRight inlineBlock widthHalf\">";
			var ftOpen = "<div class=\"borderRight inlineBlock widthQuarter\">";
			var actOpen = "<div class=\"inlineBlock widthQuarter\"><button value=\"";
			var actMid = "class=\"button\" onclick=\"nav2Page(this.value)\"";
			var actEnd = ">Open Link</button></div>";

			for (var i = 0; i < response.length; i++) {
				var cur = response[i];
				console.log(cur);

				display += fnOpen + cur.fileName + "</div>";
				display += ftOpen + cur.fileType + "</div>" + actOpen;
				display += cur.fileName + "\" " + actMid + actEnd + "<hr>";
			}

			getId("cwd").innerHTML += cwd;
			getId("pageContainer").innerHTML += display;
		}
	}
	xhttp.open('GET',"../php/assign09Ajax.php",true);
	xhttp.send();
	return;
}

function nav2Page(val) {
	console.log(val);
	var dir = val;
	window.location.href = dir;
}