function getId(id) {
	return document.getElementById(id);
}

function validate() {
	var user = getId('1');
	var pass = getId('2');
	var passC = getId('3');

	if (pass.value != passC.value) {
		getId('match').classList.remove('hide');
		pass.classList.add('error');
		passC.classList.add('error');
	} else if (pass.value.length < 7) {
		getId('match').classList.add('hide');
		getId('length').classList.remove('hide');
		pass.classList.add('error');
		passC.classList.remove('error');
	} else if (!/\d/.test(pass.value)) {
		getId('length').classList.add('hide');
		getId('number').classList.remove('hide');
		pass.classList.add('error');
	} else {
		getId('form').innerHTML += '<button type="submit" id="submit" style="display: none;"></button>';
		getId('submit').click();
	}
}