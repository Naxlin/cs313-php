var element;

function getEle(id) {
	element = document.getElementById(id);
	return element;
}

// Sends the xmlhttp request to the PHP:
function xmlhttpSend(xmlhttp, id, name, clear) {
	request = {"cmd":"cart" + id, "name": name, "clear": clear};
	console.log(request);
	xmlhttp.open('POST', "./handle_cart.php", true);
	xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	xmlhttp.send("request="+JSON.stringify(request));
}

function cartAdd(name) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState === 4 && this.status === 200) {
			console.log(this.responseText);
		}
	}
	// Send the xmlhttprequest:
	xmlhttpSend(xmlhttp, "Add", name, false);
}

function cartMinus(name, ele) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState === 4 && this.status === 200) {
			console.log(this.responseText);
			if (this.responseText == "null") {
				element.style.display = "none";
			}
		}
	}
	// Send the xmlhttprequest:
	xmlhttpSend(xmlhttp, "Minus", name);
}

function cartPlus(name) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState === 4 && this.status === 200) {
			console.log(this.responseText);
		}
	}
	// Send the xmlhttprequest:
	xmlhttpSend(xmlhttp, "Plus", name);
}

function cartMod(action, id, count) {
	var inc = getEle(count);
	var ele = getEle(id);
	if (action == "minus") {
		inc.innerHTML = parseInt(inc.innerHTML) - 1;
		cartMinus(ele.firstChild.innerHTML);

	} else if (action == "plus") {
		inc.innerHTML = parseInt(inc.innerHTML) + 1;
		cartPlus(ele.firstChild.innerHTML, ele);
	}
}

function cartRemove(name) {
	var xmlhttp = new XMLHttpRequest();
	xmlhttp.onreadystatechange = function() {
		if (this.readyState === 4 && this.status === 200) {
			console.log(this.responseText);
		}
	}
	// Send the xmlhttprequest:
	xmlhttpSend(xmlhttp, "Remove", name, true);
}

function cart(id) {
	let ele = getEle(id);
	if (ele.classList.contains("in-cart")) {
		ele.classList.remove("in-cart");
		cartRemove(ele.firstChild.innerHTML);
	} else {
		ele.classList.add("in-cart");
		cartAdd(ele.firstChild.innerHTML);
	}
}

	