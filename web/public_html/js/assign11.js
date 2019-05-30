var url = "http://157.201.194.254/cgi-bin/cs213/mileageAjaxJSON"; // Base url
var ajaxReq; // the XML Http Request.
var resp;	 // the XML Http Request response.

function getId(id) {
	return document.getElementById(id);
}

function startFocus() {
	getId("input1").focus();
}

function capFirst(string) {
	return string.charAt(0).toUpperCase() + string.slice(1);
}

function sendReq() {
	if (!validateSC()) {
		console.log("Validating Starting City failed!");
		return false;
	}
	if (!validateSS()) {
		console.log("Validating Starting State failed!");
		return false;
	}
	if (!validateEC()) {
		console.log("Validating Ending City failed!");
		return false;
	}
	if (!validateES()) {
		console.log("Validating Ending State failed!");
		return false;
	}

	getId("output").innerHTML = "<p>Info: no errors.</p>";
	
	ajaxReq = new XMLHttpRequest();
	ajaxReq.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			resp = JSON.parse(this.responseText);

			var output = "<p>Start Location - " + resp.trip.startcity + 
						 ", " + resp.trip.startstate + "</p>" + 
						 "<p>Destination - " + resp.trip.endcity + 
						 ", " + resp.trip.endstate + "</p>" + 
						 "<p>Distance - " + resp.trip.miles + " miles</p>";

			if (resp.trip.tmode != undefined) {

		 		output += "<p class=\"transport\">Transportation Options</p>" +
		 				  "<p class=\"transportItems\">";

			
				for (var i = 0; i < resp.trip.tmode.length; i++) {
					output += resp.trip.tmode[i];
					if (i + 1 != resp.trip.tmode.length) {
						output += ", "; 
					} else {
						output += ".";
					}
				}
				output += "</p>";
			}

			getId("output").innerHTML = output;
		}
	}

	url += "?" + getId("input1").name + "=" + capFirst(getId("input1").value.toLowerCase()) + "&";
	url += getId("input2").name + "=" + getId("input2").value.toUpperCase() + "&";
	url += getId("input3").name + "=" + capFirst(getId("input3").value.toLowerCase()) + "&";
	url += getId("input4").name + "=" + getId("input4").value.toUpperCase();
	ajaxReq.open("GET", url, true);
	ajaxReq.send();

	// Resetting url:
	url = "http://157.201.194.254/cgi-bin/cs213/mileageAjaxJSON"; // Base url
}

function validateSC() {
	var val = getId("input1").value;

	if (val == "") {
		getId("output").innerHTML = "<p>Error: The starting city is required.</p>";
		getId("input1").focus();
		return false; // End the function early = do not accept bad input.
	} else if (!isNaN(val)) {
		getId("output").innerHTML = "<p>Error: The starting city must not be a number.</p>";
		getId("input1").focus();
		return false; // End the function early = do not accept bad input.
	} else if (val.length > 50) {
		getId("output").innerHTML = "<p>Error: The starting city cannot be longer than 50 characters.</p>";
		getId("input1").focus();
		return false; // End the function early = do not accept bad input.
	} else if (/\d+/.test(val)) {
		getId("output").innerHTML = "<p>Error: The starting city cannot contain numbers.</p>";
		getId("input1").focus();
		return false; // End the function early = do not accept bad input.
	} else {		
		return true;
	}
}

function validateSS() {
	var val = getId("input2").value;

	if (val == "") {
		getId("output").innerHTML = "<p>Error: The starting state is required.</p>";
		getId("input2").focus();
		return false; // End the function early = do not accept bad input.
	} else if (!isNaN(val)) {
		getId("output").innerHTML = "<p>Error: The starting state must not be a number.</p>";
		getId("input2").focus();
		return false; // End the function early = do not accept bad input.
	} else if (val.length > 50) {
		getId("output").innerHTML = "<p>Error: The starting state cannot be longer than 50 characters.</p>";
		getId("input2").focus();
		return false; // End the function early = do not accept bad input.
	} else if (/\d+/.test(val)) {
		getId("output").innerHTML = "<p>Error: The starting state cannot contain numbers.</p>";
		getId("input2").focus();
		return false; // End the function early = do not accept bad input.
	} else {
		return true;
	}
}

function validateEC() {
	var val = getId("input3").value;

	if (val == "") {
		getId("output").innerHTML = "<p>Error: The destination city is required.</p>";
		getId("input3").focus();
		return false; // End the function early = do not accept bad input.
	} else if (!isNaN(val)) {
		getId("output").innerHTML = "<p>Error: The destination city must not be a number.</p>";
		getId("input3").focus();
		return false; // End the function early = do not accept bad input.
	} else if (val.length > 50) {
		getId("output").innerHTML = "<p>Error: The destination city cannot be longer than 50 characters.</p>";
		getId("input3").focus();
		return false; // End the function early = do not accept bad input.
	} else if (/\d+/.test(val)) {
		getId("output").innerHTML = "<p>Error: The destination city cannot contain numbers.</p>";
		getId("input3").focus();
		return false; // End the function early = do not accept bad input.
	} else {
		return true;
	}
}

function validateES() {
	var val = getId("input4").value;

	if (val == "") {
		getId("output").innerHTML = "<p>Error: The destination state is required.</p>";
		getId("input4").focus();
		return false; // End the function early = do not accept bad input.
	} else if (!isNaN(val)) {
		getId("output").innerHTML = "<p>Error: The destination state must not be a number.</p>";
		getId("input4").focus();
		return false; // End the function early = do not accept bad input.
	} else if (val.length > 50) {
		getId("output").innerHTML = "<p>Error: The destination state cannot be longer than 50 characters.</p>";
		getId("input4").focus();
		return false; // End the function early = do not accept bad input.
	} else if (/\d+/.test(val)) {
		getId("output").innerHTML = "<p>Error: The destination state cannot contain numbers.</p>";
		getId("input4").focus();
		return false; // End the function early = do not accept bad input.
	} else {
		return true;
	}
}