// Globals
var aspect4Amount = {};
var lastSingularity = 0;

// Shortens the document.getElementById() tool.
function getId(id) {
	return document.getElementById(id);
}

function getName(name) {
	return document.getElementsByName(name);
}

// Finds currently selected radio button by parameter name
function getRadioVal(name) {
	var radios = getName(name);
	for (var i = 0; i < radios.length; i++) {
		if (radios[i].checked) {
			return radios[i].value;
		}
	}
	return null;
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
           	getId("singularity1").innerHTML = this.responseText;
           	getId("IronSingularity").classList.remove('inactive');
			lastSingularity = 0;
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
            var html = JSON.parse(this.responseText);
           	getId("thaumItemCol").innerHTML = html['items'];
           	getId("thaumAspectCol").innerHTML = html['aspects'];
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

// Remove the hiding class from the active singularity
function activateSingularity(sel) {
	getId(sel.options[lastSingularity].value).classList.add('inactive');
	getId(sel.options[sel.selectedIndex].value).classList.remove('inactive');
	lastSingularity = sel.selectedIndex;
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

function toggleAspect(id) {
	var aspect = getId(id);
	var key = "amount" + aspect.value;
	aspect4Amount[key] = id;
	if (aspect.checked == true) {
		getId(key).classList.remove('inactive');
	} else {
		getId(key).classList.add('inactive');
	}

	// Prepare and send HttpRequest
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    }
    request = {
    	"cmd":"addAspect2List",
    	"itemName": getId("iLabel" + getId(id).value).innerHTML,
    	"aspectName": getId("aLabel" + aspect.value).innerHTML,
    	"amount": getId(key).value
    };
    xmlhttpSend(xmlhttp, request);
}

function toggleItem(id) {
	// Clear select item warning, this'll only happen once, because 'radio'
	// Also send updates for any checked aspects, because more than one could have been added
	if (!getId("itemSelWarn").classList.contains("inactive")) {
		getId("itemSelWarn").classList.add("inactive");
	}

	// Prepare and send HttpRequest
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var html = JSON.parse(this.responseText);
           	getId("thaumItemCol").innerHTML = html['items'];
           	getId("thaumAspectCol").innerHTML = html['aspects'];
        }
    }
    request = {
    	"cmd":"updateAspectAmount",
    	"itemName": getId("iLabel" + getId(id).value).innerHTML,
    	"aspectName": getId("thaumAspect").value
    };
    xmlhttpSend(xmlhttp, request);
}

function updateAspectAmount(id) {
	// Make sure value is within range
	var ele = getId(id);
	if (ele.value < ele.min) {
		ele.value = ele.min;
	} 
	if (ele.value > ele.max) {
		ele.value = ele.max;
	}

	console.log(ele.value);
	var itemSel = getRadioVal("items[]");

	// Validate that an Item is selected
	if (itemSel == null) {
		getId("itemSelWarn").classList.remove("inactive");
		return; // Don't send HttpRequest
	} else {
		getId("itemSelWarn").classList.add("inactive");
	}

	// Prepare and send HttpRequest
	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
        }
    }
    request = {
    	"cmd":"updateAspectAmount", 
    	"itemName": getId("iLabel" + itemSel).innerHTML,
    	"aspectName": getId("aLabel" + getId(aspect4Amount[id]).value).innerHTML,
    	"amount": ele.value,

    };
    xmlhttpSend(xmlhttp, request);
}

function updateItemList(id) {
	var ele = getId(id);

	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
           	getId("thaumItemCol").innerHTML = this.responseText;
        }
    }
    request = {
    	"cmd":"updateItemList", 
    	"itemSearch": ele.value
    };
    xmlhttpSend(xmlhttp, request);
}

function updateAspectList(id) {
	var ele = getId(id);

	var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
           	getId("thaumAspectCol").innerHTML = this.responseText;
        }
    }
    request = {
    	"cmd":"updateItemList", 
    	"aspectSearch": ele.value
    };
    xmlhttpSend(xmlhttp, request);
}