// Global Variables:
var url; // Handles the various urls
var httpReq; // Shortened xmlhttprequest object
var resp; // Handles the response text
var inputMap = {
	"first": "First Name",
	"last": "Last Name",
	"id1": "Student ID",
	"first2": "2nd First Name",
	"last2": "2nd Last Name",
	"id2": "2nd Student ID",
	"building": "Building",
	"room": "Room #"
}

function getId(id) {
	return document.getElementById(id);
}

function capFirst(string) {
	string.toLowerCase();
	return string.charAt(0).toUpperCase() + string.slice(1);
}

function startUp(run) {
	if (run == 0) {
		getId("first").focus();
	}

	url = "../php/assign12GetList.php";
	httpReq = new XMLHttpRequest();
	httpReq.onreadystatechange = function() {
		if (httpReq.readyState == 4 && httpReq.status == 200) {
			var table;
			// console.log(this.responseText);
			if (this.responseText != "Can't open: ../data/registrationList.json") {
				table = "<table><tr><th>Performing</th><th>First Name</th><th>Last Name</th>" +
								"<th>Student ID</th><th>Skill Level</th><th>Instrument</th><th>" +
								"Building</th><th>Room #</th><th>Time</th></tr>";
				resp = JSON.parse(this.responseText);

				for (var i = 0; i < resp.length; i++) {
					table += "<tr><td>" + resp[i].performType + "</td><td>" + resp[i].first +
									 "</td><td>" + resp[i].last + "</td><td>"+ resp[i].id1 + "</td><td>" +
									 resp[i].level + "</td><td>" + resp[i].instrument + "</td><td>" + 
									 resp[i].building + "</td><td>" + resp[i].room + "</td><td>" + 
									 resp[i].time + "</td></tr>";
					if (resp[i].first2 != undefined && resp[i].last2 != undefined && resp[i].id2 != undefined) {
						table += "<tr><td>2nd Student</td><td>" + resp[i].first2 + "</td><td>" + resp[i].last2 + 
										 "</td><td>" + resp[i].id2 + "</td><td>- -</td><td>- -</td><td>- -</td>" + 
										 "</td><td>- -</td><td>- -</td>";
					}
				}

				table += "</table>";
				getId("output").innerHTML = table;
			} else {
				table = "<table><tr><th>Performing</th><th>First Name</th><th>Last Name</th>" +
								"<th>Student ID</th><th>Skill Level</th><th>Instrument</th><th>" +
								"Building</th><th>Room #</th><th>Time</th></tr><tr><td>- -</td><td>" +
								"- -</td><td>- -</td><td>- -</td><td>- -</td><td>- -</td><td>- -</td>" +
								"<td>- -</td><td>- -</td></tr></table>";
				getId("output").innerHTML = table;				
			}
		}
	}

	httpReq.open("POST", url, true);
	httpReq.send();
}

function sendReq() {
	// do validation here:
	if (!validateText("first")) {
		console.log("First Name Invalid");
		return false;
	}
	if (!validateText("last")) {
		console.log("Last Name Invalid");
		return false;
	}
	if (!validateNumber("id1")) {
		console.log("Student ID Invalid");
		return false;
	}
	// Validate second student only on duets.
	if (getId("performType").selectedIndex == 1) {
		if (!validateText("first2")) {
			console.log("2nd First Name Invalid");
			return false;
		}
		if (!validateText("last2")) {
			console.log("2nd Last Name Invalid");
			return false;
		}
		if (!validateNumber("id2")) {
			console.log("2nd Student ID Invalid");
			return false;
		}
	}
	if (!validateText("building")) {
		console.log("Building Invalid");
		return false;
	}
	if (!validateNumber("room")) {
		console.log("Room # Invalid");
		return false;
	}


	url = "../php/assign12.php";
	httpReq = new XMLHttpRequest();
	httpReq.onreadystatechange = function() {
		if (this.readyState == 4 && this.status == 200) {
			console.log(this.responseText);
			startUp(1);
		}
	}

	var type = getId("performType");
	var lvl = getId("level");
	var inst = getId("instrument");
	var time = getId("time");
	url += "?" + type.name + "=" + type.options[type.selectedIndex].value + "&";
	url += getId("first").name + "=" + capFirst(getId("first").value) + "&";
	url += getId("last").name + "=" + capFirst(getId("last").value) + "&";
	url += getId("id1").name + "=" + getId("id1").value + "&";
	// Only include the following if there is a second student.
	if (type.selectedIndex == 1) {
		url += getId("first2").name + "=" + capFirst(getId("first2").value) + "&";
		url += getId("last2").name + "=" + capFirst(getId("last2").value) + "&";
		url += getId("id2").name + "=" + getId("id2").value + "&";
	}
	url += lvl.name + "=" + lvl.options[lvl.selectedIndex].value + "&";
	url += inst.name + "=" + inst.options[inst.selectedIndex].value + "&";
	url += getId("building").name + "=" + capFirst(getId("building").value) + "&";
	url += getId("room").name + "=" + getId("room").value + "&";
	url += time.name + "=" + time.options[time.selectedIndex].value;

	console.log(url);

	httpReq.open("GET", url, true);
	httpReq.send();
}

function clearInput() { 
	// Easiest way to reset the inputs
	window.location.href = "../html/assign12.html";
}

function deleteList() {
	url = "../php/assign12Delete.php";
	httpReq = new XMLHttpRequest();
	httpReq.onreadystatechange = function() {
		if (httpReq.readyState == 4 && httpReq.status == 200) {
			console.log(this.responseText);
			startUp(1);
		}
	}

	httpReq.open("POST", url, true);
	httpReq.send();
}

function toggleDuet() {
	if (getId("performType").selectedIndex == 1) {
		if (getId("inputContainer2").style.display == "none") {
			getId("inputContainer2").style.display = "block";
		}	
	}
	else {
		getId("inputContainer2").style.display = "none";
	}
}

function validateText(id) {
	var val = getId(id).value;
	if (val == "") {
		getId("error").innerHTML = "<p>Error: " + inputMap[id] + " is required.</p>";
		getId("error").style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	} else if (!isNaN(val)) {
		getId("error").innerHTML = "<p>Error: " + inputMap[id] + " must not be a number.</p>";
		getId("error").style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	} else if (val.length > 50) {
		getId("error").innerHTML = "<p>Error: " + inputMap[id] + " cannot be longer than 50 characters.</p>";
		getId("error").style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	} else if (/\d+/.test(val)) {
		getId("error").innerHTML = "<p>Error: " + inputMap[id] + " cannot contain numbers.</p>";
		getId("error").style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	} else {
		getId("error").style.display = "none";
		return true;
	}
}

function validateNumber(id) {
	var val = getId(id).value;
	if (val == "") {
		getId("error").innerHTML = "<p>Error: " + inputMap[id] + " is required.</p>";
		getId("error").style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	} else if (isNaN(val)) {
		getId("error").innerHTML = "<p>Error: " + inputMap[id] + " must be a number.</p>";
		getId("error").style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	} else if (id == "room" && (val.length < 1 || val.length > 3)) {
		getId("error").innerHTML = "<p>Error: " + inputMap[id] + " must be 1-3 digits.</p>";
	} else if ((id == "id" || id == "id2") && val.length != 10) {
		getId("error").innerHTML = "<p>Error: " + inputMap[id] + " must be 10 digits.</p>";
		getId("error").style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	} else {
		getId("error").style.display = "none";
		return true;
	}
}