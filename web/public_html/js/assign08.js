
function cityResponse() {
	if (httpRequest.readyState == 4) {
		if (httpRequest.status == 200) {
			var text = httpRequest.responseText;
			document.getElementById('cities').innerHTML = text;
		}
	}
}

function requestCity(city) {
	var url = "http://157.201.194.254/~cs213/" + city;
	httpRequest = new XMLHttpRequest();
	httpRequest.onreadystatechange = cityResponse;
	httpRequest.open("GET", url, true);
	httpRequest.send();
}

function jsonResponse() {
	if (httpRequest.readyState == 4) {
		if (httpRequest.status == 200) {
			console.log(httpRequest.responseText);
			var obj = JSON.parse(httpRequest.responseText);
			// students
			// First | Last | Address - city, state, zip | major | gpa
      var table = "<table border = '1'><tr><th>First</th><th>Last</th><th>" +
      						"Address</th><th>Major</th><th>GPA</th></tr>\n";

      for (var i = 0; i < obj.students.length; i++)
      {
           table  = table + "<tr><td>" + obj.students[i].first + "</td><td>" + 
           					obj.students[i].last + "</td>" + 
                    "<td>" + obj.students[i].address.city + ", " + 
                    obj.students[i].address.state + " " +
                    obj.students[i].address.zip + "</td>" +
                    "<td>" + obj.students[i].major + "</td>" +
                     "<td>" + obj.students[i].gpa + "</td></tr>\n";
      }

	    document.getElementById("json").innerHTML = table;
    }
    else {
      alert("Issue with request: " + req.statusText);
    }
	}
}

function requestJson() {
	var filename = document.getElementById("jsonFilename").value;
	if (!(filename == ""))
	{
		var url = "http://157.201.194.254/~cs213/" + filename;
		httpRequest = new XMLHttpRequest();
		httpRequest.onreadystatechange = jsonResponse;
		httpRequest.open("GET", url, true);
		httpRequest.send();
	}
}

/* Archived from Ajax inclass activity */

// var toggled = false;

// function handleResponse() {
// 	if (httpRequest.readyState == 4) {
// 		if (httpRequest.status == 200) {
// 			var text = httpRequest.responseText;
// 			document.getElementById('response').innerHTML = text;
// 		}
// 	}
// }

// function makeRequest() {
// 	var url;
// 	if (!toggled) {
// 		var url = "http://157.201.194.254/~ercanbracks/studentList.html";
// 		toggled = true;
// 	} else if (toggled) {
// 		var url = "http://157.201.194.254/~ercanbracks/studentList1.html";
// 		toggled = false;
// 	}
// 	httpRequest = new XMLHttpRequest();
// 	httpRequest.onreadystatechange = handleResponse;
// 	httpRequest.open("GET", url, true);
// 	httpRequest.send();
// }