// let sum = truly local scope.
// var sum = can be used in the function, no matter where declared.

// Math.pow(n,2); Calculating something to the power of the right side.

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
// check phone # = /^\d{3}-\d{3}-\d{4}$/ 
// or /^\d?(?\d{3})?[ -.]\d{3}[ -.]\d{4}$/
// returns the active element = document.activeElement

// Global variables:
					 
// Functions:
function getId(id) { // Shortened version of the get ID call.
	return document.getElementById(id);
}

function validateForm() {
	// Validating Fields
	if (!valiName("formFirstName"))	{ return false; }
	if (!valiName("formMidName")) 	{ return false; }
	if (!valiName("formLastName")) 	{ return false; }
	if (!valiPhone("formPhone")) 		{ return false; }
	if (!valiStreet("formStreet")) 	{ return false; }
	if (!valiCity("formCity")) 			{ return false; }
	if (!valiState("formState")) 		{ return false; }
	if (!valiZip("formZipcode")) 		{ return false; }
	if (!valiCardType())						{ return false; }
	if (!valiCard("formCardNumber")){ return false; }
	if (!valiMonth("formCardMonth")){ return false; }
	if (!valiYear("formCardYear"))	{ return false; }
	if (!costumeSelected()) 				{ return false; }
	return true;
}

function resetForm() {
	resetAlerts();
	resetSelections();
}

function resetAlerts() {
	var alerts = document.forms[0].querySelectorAll('div[name="alert"]');
	for (var i = 0; i < alerts.length; i++) {
		alerts[i].style.display = "none";
	}
	getId("formFirstName").focus();
}

function startupFocus() {
	getId("formFirstName").focus();
}

function setCard(id) {
	getId(id + "In").checked = true;
}

function costumeCheck(id) {
	toggleThumbnail(id);
	checkBox(id + "Check");
}

function toggleThumbnail(id) {
	if (getId(id).parentElement.classList.contains("thumbnailContainer")) {
		getId(id).parentElement.classList.add("thumbnailContainerChecked");
		getId(id).parentElement.classList.remove("thumbnailContainer");
	} else {
		getId(id).parentElement.classList.add("thumbnailContainer");
		getId(id).parentElement.classList.remove("thumbnailContainerChecked");
	}
}

function checkBox(id) {
	if (getId(id).checked == true) {
		getId(id).checked = false;
		calculateTotal();
	} else {
		getId(id).checked = true;
		calculateTotal();
	}
}

function calculateTotal() {
	var total = 0;
	var costumePrices = [
		23.46,	42.52,	12.50,
		20.10,	53.21,	15.75,
		60.45,	20.32,	14.99]

	for (var i = 0; i < 9; ++i) {
		if (getId("costume0" + (i + 1) + "Check").checked) {
			total = total + costumePrices[i];
		}
	}
	getId("totalValue").innerHTML = total.toFixed(2);
	return total;
}

function resetSelections() {
	costumes = document.forms[0].querySelectorAll('input[name="costume"]');
	for (var i = 0; i < 9; ++i) {
		getId("costume0" + (i + 1) + "Check").checked = false;
		if (getId("costume0" + (i + 1)).parentElement.classList.contains(
			"thumbnailContainer") == false) {
			getId("costume0" + (i + 1)).parentElement.classList.add(
				"thumbnailContainer");
			getId("costume0" + (i + 1)).parentElement.classList.remove(
				"thumbnailContainerChecked");
		}
	}
	calculateTotal();
}

function valiName(id) {
	if (getId(id).value == "") {
		if (id == "formFirstName") {
			getId("alert" + id).innerHTML = 
			"<strong>First Name is required</strong>";
			getId("alert" + id).style.display = "block";
			getId(id).focus();
		} else if (id == "formMidName") {
			getId("alert" + id).innerHTML = 
			"<strong>Middle Initial is required</strong>";
			getId("alert" + id).style.display = "block";
			getId(id).focus();
		} else if (id == "formLastName") {
			getId("alert" + id).innerHTML = 
			"<strong>Last Name is required</strong>";
			getId("alert" + id).style.display = "block";
			getId(id).focus();
		}
		return false; // End the function early = do not accept bad input.
	} else if (!isNaN(getId(id).value)) {
		if (id == "formFirstName") {
			getId("alert" + id).innerHTML = "<strong>First Name can not be a number</strong>";
			getId("alert" + id).style.display = "block";
			getId(id).focus();
		} else if (id == "formMidName") {
			getId("alert" + id).innerHTML = "<strong>Middle Name can not be a number</strong>";
			getId("alert" + id).style.display = "block";
			getId(id).focus();
		} else if (id == "formLastName") {
			getId("alert" + id).innerHTML = "<strong>Last Name can not be a number</strong>";
			getId("alert" + id).style.display = "block";
			getId(id).focus();
		} 
		return false; // End the function early = do not accept bad input.
	} else if (getId(id).value.length > 50) {
		if (id == "formFirstName") {
			getId("alert" + id).innerHTML = "<strong>First Name can not be longer than 50 characters</strong>";
			getId("alert" + id).style.display = "block";
			getId(id).focus();
		} else if (id == "formMidName") {
			getId("alert" + id).innerHTML = "<strong>Middle Name can not be longer than 50 characters</strong>";
			getId("alert" + id).style.display = "block";
			getId(id).focus();
		} else if (id == "formLastName") {
			getId("alert" + id).innerHTML = "<strong>Last Name can not be longer than 50 characters</strong>";
			getId("alert" + id).style.display = "block";
			getId(id).focus();
		} 
		return false; // End the function early = do not accept bad input.
	} else if (/\d+/.test(getId(id).value)) {
		if (id == "formFirstName") {
			getId("alert" + id).innerHTML = "<strong>First Name can not contain numbers</strong>";
			getId("alert" + id).style.display = "block";
			getId(id).focus();
		} else if (id == "formMidName") {
			getId("alert" + id).innerHTML = "<strong>Middle Name can not contain numbers</strong>";
			getId("alert" + id).style.display = "block";
			getId(id).focus();
		} else if (id == "formLastName") {
			getId("alert" + id).innerHTML = "<strong>Last Name can not contain numbers</strong>";
			getId("alert" + id).style.display = "block";
			getId(id).focus();
		} 
		return false; // End the function early = do not accept bad input.
	}
	getId("alert" + id).style.display = "none";
	return true;
}

function valiPhone(id) {
	var phoneRegEx = RegExp(/^\(?\d{3}\)?[ -.]?\d{3}[ -.]?\d{4}$/);

	if (!phoneRegEx.test(getId(id).value)) {
		getId("alert" + id).innerHTML = "<strong>Not a phone number</strong>";
		getId("alert" + id).style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	}
	getId("alert" + id).style.display = "none";
	return true;
}

function valiStreet(id) {
	if (getId(id).value == "") {
		getId("alert" + id).innerHTML = "<strong>Street is required</strong>";
		getId("alert" + id).style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	}
	getId("alert" + id).style.display = "none";
	return true;
}

function valiCity(id) {
	if (getId(id).value == "") {
		getId("alert" + id).innerHTML = "<strong>City is required</strong>";
		getId("alert" + id).style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	} else if (!isNaN(getId(id).value)) {
		getId("alert" + id).innerHTML = "<strong>City can not be a number</strong>";
		getId("alert" + id).style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	} else if (getId(id).value.length > 50) {
		getId("alert" + id).innerHTML = "<strong>City can not be longer than 50 characters</strong>";
		getId("alert" + id).style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	} else if (/\d+/.test(getId(id).value)) {
		getId("alert" + id).innerHTML = "<strong>City can not contain numbers</strong>";
		getId("alert" + id).style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	}
	getId("alert" + id).style.display = "none";
	return true;
}

function valiState(id) {
if (getId(id).value == "") {
		getId("alert" + id).innerHTML = "<strong>State is required</strong>";
		getId("alert" + id).style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	} else if (!isNaN(getId(id).value)) {
		getId("alert" + id).innerHTML = "<strong>State can not be a number</strong>";
		getId("alert" + id).style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	} else if (getId(id).value.length > 50) {
		getId("alert" + id).innerHTML = "<strong>State can not be longer than 50 characters</strong>";
		getId("alert" + id).style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	} else if (/\d+/.test(getId(id).value)) {
		getId("alert" + id).innerHTML = "<strong>State can not contain numbers</strong>";
		getId("alert" + id).style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	}
	getId("alert" + id).style.display = "none";
	return true;
}

function valiZip(id) {
	if (getId(id).value == "") {
		getId("alert" + id).innerHTML = "<strong>Zipcode is required</strong>";
		getId("alert" + id).style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	} else if (/\D+/.test(getId(id).value)) {
		getId("alert" + id).innerHTML = "<strong>Zipcode must contain only numbers</strong>";
		getId("alert" + id).style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	} else if (getId(id).value.length != 5) {
		getId("alert" + id).innerHTML = "<strong>Zipcode must be 5 numbers</strong>";
		getId("alert" + id).style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	} 
	getId("alert" + id).style.display = "none";
	return true;
}

function valiCardType() {
	cards = document.forms[0].querySelectorAll('input[name="card"]');
	for (var i = 0; i < cards.length; ++i) {
		if (cards[i].checked == true) {
			getId("alertformCardType").style.display = "none";
			return true;
		}
	}
	getId("alertformCardType").style.display = "block";
	getId("visaIn").focus();
	return false;
}

function valiCard(id) {
	var cardRegEx = RegExp(/^\d{4}[ -]?\d{4}[ -]?\d{4}[ -]?\d{4}[ -]?$/);

	if (!cardRegEx.test(getId(id).value)) {
		getId("alert" + id).style.display = "block";
		getId(id).focus();
		return false; // End the function early = do not accept bad input.
	}
	getId("alert" + id).style.display = "none";
	return true;
}

function valiMonth(id) {
	var month = getId(id);
	if (month.options[month.selectedIndex].value == "null") {
		getId("alert" + id).style.display = "block";
		month.focus();
		return false; // End the function early = do not accept bad input.
	}
	getId("alert" + id).style.display = "none";
	return true;
}

function valiYear(id) {
	var year = getId(id);
	if (year.options[year.selectedIndex].value == "null") {
		getId("alert" + id).style.display = "block";
		year.focus();
		return false; // End the function early = do not accept bad input.
	}
	getId("alert" + id).style.display = "none";
	return true;
}

function costumeSelected() {
	var total = calculateTotal();
	if (total == 0) {
		getId("alertformCostume").style.display = "block";
		return false;
	}
	getId("alertformCostume").style.display = "none";
	return true;
}

function returnHome() {
	window.location.href = "../html/assign10.html";
}