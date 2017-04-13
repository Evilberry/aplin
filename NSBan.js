function test(){
	document.getElementsByName('UN')[0].value = "Аплин";
	document.getElementsByName('PW')[0].value = "123123"
	login_ctrl.login();   
}
setInterval(test, 5000)
