function checkUser () {
	var user2 = getcookie('user2');
	if (user2) {
		window.user = JSON.parse(user2);
	} else {			
		window.location.replace('login.html');
	}
}
 
checkUser();

function logout () {
	delcookie('user2');
	window.location.replace('login.html');
}