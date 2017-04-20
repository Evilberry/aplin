var array = ["Аплин"];
var n = 0;
while (n < 3){
	alert(n);
		document.getElementsByName('UN')[0].value = "Аплин";
	document.getElementsByName('PW')[0].value = "123123"
	login_ctrl.login();  
	n++;
}

var i = 1;                     //  set your counter to 1

function myLoop () {           //  create a loop function
   setTimeout(function () {    //  call a 3s setTimeout when the loop is called
	document.getElementsByName('UN')[0].value = "Аплин";
	document.getElementsByName('PW')[0].value = "123123"
	login_ctrl.login();  
	i++;                     //  increment the counter
      if (i < 3) {            //  if the counter < 10, call the loop function
         myLoop();             //  ..  again which will trigger another 
      }                        //  ..  setTimeout()
   }, 2000)
}

myLoop();                      //  start the loop

function test(){
	document.getElementsByName('UN')[0].value = "Аплин";
	document.getElementsByName('PW')[0].value = "123123"
	login_ctrl.login();   
}
setInterval(test, 5000)
