console.log("constantes.js")

const minSillasPorMesa=2;
const maxSillasPorMesa=6;
const estadosPedidos = ["-", "Pendiente", "En Preparación", "Listo", "Servido", "Cancelado","-","listo/en preparación"]
const estadosMesas = ["Libre", "Ocupada sin Pedido", "Esperando Pedido", "Pedido Listo", "Comiendo", "Esperando Cuenta", "Pagada","pedido listo/faltan cosas"];
const rolesEmpleados = ["-", "Socix","Camarerx", "Bartender", "Cervecerx", "Cocinerx",  "Pastelerx", "Admin"];

const sectoresCocinas = ["-", "Bar", "Cervecería", "Cocina",  "Pastelería"];




function formatDate(date) {
  var d = new Date(date),
      month = '' + (d.getMonth() + 1),
      day = '' + d.getDate(),
      year = d.getFullYear();

  if (month.length < 2) month = '0' + month;
  if (day.length < 2) day = '0' + day;

  return [year, month, day].join('-');
}

function fechaArg2timeStamp(str){
  let b=str.split("/");
  return new Date(b[1]+"-"+b[0]+"-"+b[2])

  }

function array2Select(arr,id){
  let str="<select id='"+id+"'>"
  for(let i=0;i<arr.length;i++){
    str+="<option value='"+i+"'>"+arr[i]+"</option>";
  }
  str+="</select>";
  return str
}

function consoleLogE(e){
  console.log(e)
}

function hora(data){

  let a=new Date(data);
  let minutos=a.getMinutes();
  if (minutos<10) minutos="0"+minutos.toString();
  return a.getHours()+":"+minutos;
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



 function decodeHTMLEntities (str) {
    if(str && typeof str === 'string') {
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

function copyObj(obj){
  return JSON.parse(JSON.stringify(obj))
  }

function base64(fotoObj, callback) {
  // console.log("base64 " + fotoObj.name)
  var reader = new FileReader();

  reader.onload = function(readerEvt) {
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




function checkStr(str){
  if(str!=undefined && str!=null && str!="" && str!="undefined" && str!= "null") return true;
  else return false;
}



function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}

function validarInput(input){
  return !input == "";
}

function validarSelect(seleccion){
  return !seleccion == "0";
}

function buscarEnArray(val,propiedad,array){
  
  for(var i=0;i<array.length;i++){
    if(array[i][propiedad]==val) return array[i]
  }
  return -1;
}

function id2i(id,array){
  
  for(var i=0;i<array.length;i++){
    if(array[i].id==id) return i
  }
  return -1;
}

function id_prod2i(id,array){
  
  for(var i=0;i<array.length;i++){
    if(array[i].id_producto==id) return i
  }
  return -1;
}