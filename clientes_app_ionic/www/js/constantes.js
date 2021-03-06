console.log("constantes.js")

const minSillasPorMesa = 2;
const maxSillasPorMesa = 6;
const estadosPedidos = [null, "Pendiente", "En Preparación", "Listo", "Servido", "Cancelado"]
const estadosMesas = ["Libre", "Ocupada sin Pedido", "Esperando Pedido", "Pedido Listo", "Comiendo", "Esperando Cuenta", "Pagada"];
const rolesEmpleados = ["-", "Socix", "Camarerx", "Bartender", "Cervecerx", "Cocinerx", "Pastelerx", "Admin"];

const coloresMesas = ["verdeClaro", "amarillo", "naranja", "rojo", "amarillo", "violeta", "celeste"];
//var imgRolesEmpleados = [null, "media/Img/roles/tragos.png", "media/Img/roles/cerveza.png", "media/Img/roles/cocina.png", "Camarerx", "Admin", "media/Img/roles/candy.png"];


function formatDate(date) {
  var d = new Date(date),
    month = '' + (d.getMonth() + 1),
    day = '' + d.getDate(),
    year = d.getFullYear();

  if (month.length < 2) month = '0' + month;
  if (day.length < 2) day = '0' + day;

  return [year, month, day].join('-');
}

function array2Select(arr,id){

  let str="<select id='"+id+"'>"

  for(let i=0;i<arr.length;i++){
    str+="<option value='"+i+"'>"+arr[i]+"</option>";
  }
  str += "</select>";
  return str
}

function consoleLogE(e) {
  console.log(e)
}

function hora(data) {

  let a = new Date(data);
  let minutos = a.getMinutes();
  if (minutos < 10) minutos = "0" + minutos.toString();
  return a.getHours() + ":" + minutos;
}

function formatDate(date) {
  var d = new Date(date),
    month = '' + (d.getMonth() + 1),
    day = '' + d.getDate(),
    year = d.getFullYear();

  if (month.length < 2) month = '0' + month;
  if (day.length < 2) day = '0' + day;

  return [year, month, day].join('-');
}

function decodeHTMLEntities(str) {
  if (str && typeof str === 'string') {
    var element = document.createElement('div');
    // strip script/html tags
    str = str.replace(/<script[^>]*>([\S\s]*?)<\/script>/gmi, '');
    str = str.replace(/<\/?\w(?:[^"'>]|"[^"]*"|'[^']*')*>/gmi, '');
    element.innerHTML = str;
    str = element.textContent;
    element.textContent = '';
  }

  return str;
}

function copyObj(obj) {
  return JSON.parse(JSON.stringify(obj))
}

function base64(fotoObj, callback) {
  // console.log("base64 " + fotoObj.name)
  var reader = new FileReader();

  reader.onload = function (readerEvt) {
    var binaryString = readerEvt.target.result;
    var fotoBase64 = btoa(binaryString);
    //$(thumb).show();
    //$(thumb).attr("src", "data:image/png;base64," + fotoBase64);
    console.log("foto cargada");
    callback(fotoBase64);
  };
  reader.readAsBinaryString(fotoObj);
}

function parseJwt(token) {
  var objRta = {}

  try {
    var base64Url = token.split('.')[1];
    var base64 = base64Url.replace(/-/g, '+').replace(/_/g, '/');
    objRta = JSON.parse(window.atob(base64));
  } catch (e) {
    console.log(e)

  }
  return objRta;
}

function checkStr(str) {
  if (str != undefined && str != null && str != "" && str != "undefined" && str != "null") return true;
  else return false;
}

function validateEmail(email) {
  var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
  return re.test(String(email).toLowerCase());
}

function buscarEnArray(val, propiedad, array) {

  for (var i = 0; i < array.length; i++) {
    if (array[i][propiedad] == val) return array[i]
  }
  return -1;
}

function id2i(id, array) {

  for (var i = 0; i < array.length; i++) {
    if (array[i].id == id) return i
  }
  return -1;
}

function id_prod2i(id,array){
  
  for(var i=0;i<array.length;i++){
    if(array[i].id_producto==id) return i
  }
  return -1;
}

function validarInput(input){
  return !input == "";
}

///////////////COSAS DEL QR:
// Para verificar disponibilidad de una mesa.
// Para relacionar al cliente con una mesa.
// Para ver el estado del pedido.
// Para acceder a la encuesta de satisfacción.
//{"tipo":"mesa","id":5,"nombreResto":"BlaBla"}
//https://www.the-qrcode-generator.com/


function scanQRMesa(cbFuncion) {

  try {
    cordova.plugins.barcodeScanner.scan(cbFuncion, QRmal, {
      prompt: "escaneá el qr de la mesa", // Android
      resultDisplayDuration: 1500,
      orientation: "portrait"
    });
  } catch (e) {
    alert(e);
  }
}

function QRmal(error) {
  alert("Error: " + error)
}

///////////////////FIN COSAS DEL QR