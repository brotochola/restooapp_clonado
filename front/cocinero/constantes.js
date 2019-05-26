console.log("constantes.js")
const nombreDelSitio="Resto UTN";
const usuarioLogueado_ls="token"+nombreDelSitio;
const dataDelUsuario_ls="dataDelUsuario_"+nombreDelSitio;
const minSillasPorMesa=2;
const maxSillasPorMesa=6;
const caminoBackEnd = "../../Resto/API/"


const rolesEmpleados = [null, "../media/Img/roles/tragos.png", "../media/Img/roles/cerveza.png", "../media/Img/roles/cocina.png", "Camarerx", "Admin", "../media/Img/roles/candy.png"];

const estadosPedidos = [null, "Pendiente", "En Preparación", "Listo", "Servido", "Cancelado"]

const estadosMesas = ["Libre", "Ocupada sin Pedido", "Esperando Pedido", "Pedido Listo", "Comiendo", "Esperando Cuenta", "Pagada"];

const lugaresDeTrabajoRoles=[null, "Bar", "Cervezas", "Cocina", null, null, "Candybar"]



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
function isFunction(functionToCheck) {
 return functionToCheck && {}.toString.call(functionToCheck) === '[object Function]';
}

function agregarCachoABody(url,cb){
 // console.log(cb)
    $.ajax({
    url:url,
    success:function(e){
      $("body").append(e);
      if(isFunction(cb)) cb();
    }
  })
}

function validateEmail(email) {
    var re = /^(([^<>()\[\]\\.,;:\s@"]+(\.[^<>()\[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/;
    return re.test(String(email).toLowerCase());
}


function id2i(id,array){
  
  for(var i=0;i<array.length;i++){
    if(array[i].id==id) return i
  }
  return -1;
}