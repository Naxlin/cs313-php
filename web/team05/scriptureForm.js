function showScriptures(book) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText);
            var rows = JSON.parse(this.responseText);
            if (rows.length == 0) { 
                document.getElementById("scriptures").innerHTML = "";
            } else {
                document.getElementById("scriptures").innerHTML = JSON.parse(this.responseText);;
            }
        }
    }
    request = {"cmd":"scripture", "book": book};
    xmlhttpSend(xmlhttp, request);
}

function showScriptureDetails(scriptureId) {
    var xmlhttp = new XMLHttpRequest();
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                console.log(this.responseText);
                var rows = JSON.parse(this.responseText);
                if (rows.length == 0) { 
                    document.getElementById("scriptureDetails").innerHTML = "";
                } else {
                    document.getElementById("scriptureDetails").innerHTML = JSON.parse(this.responseText);
                }
            }
        }
        request = {"cmd":"details", "scriptureId": scriptureId};
        xmlhttpSend(xmlhttp, request);
}

function xmlhttpSend(xmlhttp, request) {
    console.log(request);
    xmlhttp.open('POST', "scriptureList.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
    xmlhttp.send("request="+JSON.stringify(request));
}
