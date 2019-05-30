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
var valiAPR = false; // false until validation returns no errors.
var valiLT = false;  // false until validation returns no errors.
var valiLA = false;  // false until validation returns no errors.
var vali1st = false; // false until the submit has been hit once,
					 // clear resets this.
					 
var clearedAPR = false; // used to check if validateAPR() caused onchange.
var clearedLT = false;  // used to check if validateLT() caused onchange.
var clearedLA = false;  // used to check if validateLA() caused onchange.


// Functions:
function getId(id) { // Shortened version of the get ID call.
	return document.getElementById(id);
}

function calculateMortgage() {
	valiAPR = false;
	valiLT = false;
	valiLA = false;
	vali1st = false;

	// Checks if APR is incorrect and alerts the user, 
	validateAPR();
	if (!valiAPR) { 
		return; 
	}
	// Checks if Loan Term is incorrect and alerts the user.
	validateLT();
	if (!valiLT) { 
		return; 
	}
	// Checks if Load Amount is incorrect and alerts the user.
	validateLA();
	if (!valiLA) { 
		return; 
	}

	if (valiAPR && valiLT && valiLA) {
		// Remove the alert field if no errors.
		getId("alerts").style.display = "none";

		// Calculates the Mortgage values.
		calculate();
		vali1st = true;
	}
}

function calculate() {
	var apr = parseFloat(getId("formAPR").value);
	var lt = parseFloat(getId("formLT").value);
	var la = parseFloat(getId("formLA").value);

	apr = apr.toFixed(2); // Cut off excess input.
	apr = apr / 100; // Converted to percentage.
	var mpr = apr / 12; // Monthly percent from apr.
	lt = lt.toFixed(0); // Cut off decimal values.
	lt = lt * 12; // Converted to months in the term.
	la = la.toFixed(2); // Cut off excess input.

	var payment = ((mpr * la) / (1 - Math.pow(mpr + 1,-lt)));
	getId("payment").innerHTML = "<span style=\"margin-left:"
	+ "15px; margin-right: 22px;\">=</span>$" + payment.toFixed(2);
}

function clearAlerts() {
	getId("alerts").style.display = "none";
	getId("payment").innerHTML = "<span style=\"margin-left: "
	+ "15px; margin-right: 22px;\">=</span>$0.00";
	getId("formAPR").focus();
	vali1st = false;
}

function setFocus() {
	getId("formAPR").focus();
}

function validateAPR() {
	if (clearedAPR) {
		clearedAPR = false;
		return;
	} else if (getId("formAPR").value == "") {
		getId("alerts").innerHTML = "<strong>APR is required</strong>";
		getId("alerts").style.display = "block";
		getId("formAPR").focus();
		return; // End the function early = do not accept bad input.
	} else if (isNaN(getId("formAPR").value)) {
		getId("alerts").innerHTML = "<strong>APR needs to be a number "
		+ "ranging 0-25%</strong>";
		getId("alerts").style.display = "block";
		getId("formAPR").value = "";
		clearedAPR = true;
		getId("formAPR").focus();
		return; // End the function early = do not accept bad input.
	} else if (getId("formAPR").value > 25 || getId("formAPR").value <= 0) {
		getId("alerts").innerHTML = "<strong>APR ranges from 0-25%</strong>";
		getId("alerts").style.display = "block";
		getId("formAPR").value = "";
		clearedAPR = true;
		getId("formAPR").focus();
		return; // End the function early = do not accept bad input.
	}

	valiAPR = true;

	if (valiAPR && vali1st) {
		// Remove the alert field if no errors.
		getId("alerts").style.display = "none";
		calculate();
	}
}

function validateLT() {
	if (clearedLT) {
		clearedLT = false;
		return;
	} else if (getId("formLT").value == "") {
		getId("alerts").innerHTML = "<strong>Loan Term is required</strong>";
		getId("alerts").style.display = "block";
		getId("formLT").focus();
		valiLT = false;
		return; // End the function early = do not accept bad input.
	} else if (isNaN(getId("formLT").value)) {
		getId("alerts").innerHTML = "<strong>Loan Term needs to be a number "
		+ "ranging 0-40</strong>";
		getId("alerts").style.display = "block";
		getId("formLT").value = "";
		clearedLT = true;
		getId("formLT").focus();
		valiLT = false;
		return; // End the function early = do not accept bad input.
	} else if (getId("formLT").value > 40 || getId("formLT").value <= 0) {
		getId("alerts").innerHTML = "<strong>Loan Term ranges from 0-40"
		+ "</strong>";
		getId("alerts").style.display = "block";
		getId("formLT").value = "";
		clearedLT = true;
		getId("formLT").focus();
		valiLT = false;
		return; // End the function early = do not accept bad input.
	}

	valiLT = true;

	if (valiLT && vali1st) {
		// Remove the alert field if no errors.
		getId("alerts").style.display = "none";
		calculate();
	}
}

function validateLA() {
	if (clearedLA) {
		clearedLA = false;
		return;
	} else if (getId("formLA").value == "") {
		getId("alerts").innerHTML = "<strong>Loan Amount is required"
		+ "</strong>";
		getId("alerts").style.display = "block";
		getId("formLA").focus();
		valiLA = false;
		return; // End the function early = do not accept bad input.
	} else if (isNaN(getId("formLA").value)) {
		getId("alerts").innerHTML = "<strong>Loan Amount needs to be "
		+ "a number</strong>";
		getId("alerts").style.display = "block";
		getId("formLA").value = "";
		clearedLA = true;
		getId("formLA").focus();
		valiLA = false;
		return; // End the function early = do not accept bad input.
	} else if (getId("formLA").value <= 0) {
		getId("alerts").innerHTML = "<strong>Loan Amount cannot be "
		+ "zero or negative</strong>";
		getId("alerts").style.display = "block";
		getId("formLA").value = "";
		clearedLA = true;
		getId("formLA").focus();
		valiLT = false;
		return; // End the function early = do not accept bad input.
	}

	valiLA = true;

	if (valiLA && vali1st) {
		// Remove the alert field if no errors.
		getId("alerts").style.display = "none";
		calculate();
	}
}