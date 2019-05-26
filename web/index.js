// Shortens the document.getElementById() tool.
function getId(id) {
	return document.getElementById(id)
}

// Send to server function, logs request and sends it to the calculator handler.
function xmlhttpSend(xmlhttp, request) {
    console.log(request);
    xmlhttp.open("POST", "project1/calculator_handler.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("request="+JSON.stringify(request));
}

// Server request and handler for Singularities.
function getSingularity(name) {
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
           	// var html = JSON.parse(this.responseText);
           	getId("singularity1").innerHTML = this.responseText;
        }
    }
    request = {"cmd":"singularity", "name": name};
    xmlhttpSend(xmlhttp, request);
}

// Server request and handler for Thaumcraft.
function getThaumcraft(name) {
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    }
    request = {"cmd":"thaumcraft", "name": name};
    xmlhttpSend(xmlhttp, request);
}

// Server request and handler for Tinkers Construct.
function getTinkers(name) {
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    }
    request = {"cmd":"tinkers", "name": name};
    xmlhttpSend(xmlhttp, request);
}

// Switches between overview and calculators.
function toggleCalculators(id) {
	var active = id;
	var inactive;
	if (id == "calculators") {
		inactive = "overview";
	} else if (id == "overview") {
		inactive = "calculators";
	}
	getId(active + 1).style.display = "block";
	getId(inactive + 1).style.display = "none";
}

// Switches between the different calculators.
function switchToCalculator(id) {
	var calc1 = id;
	var calc2;
	var calc3;
	if (id == "singularity") {
		getSingularity('');
		calc2 = "thaumcraft";
		calc3 = "tinkers";
	} else if (id == "thaumcraft") {
		getThaumcraft('');
		calc2 = "singularity";
		calc3 = "tinkers";
	} else if (id == "tinkers") {
		getTinkers('');
		calc2 = "singularity";
		calc3 = "thaumcraft";
	}

	getId(calc1).classList.add("calc-active");
	getId(calc2).classList.remove("calc-active");
	getId(calc3).classList.remove("calc-active");
	getId(calc1 + 1).style.display = "block";
	getId(calc2 + 1).style.display = "none";
	getId(calc3 + 1).style.display = "none";
}