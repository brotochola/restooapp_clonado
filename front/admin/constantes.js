console.log("constantes.js")
const nombreDelSitio="Resto UTN";
const usuarioLogueado_ls="token"+nombreDelSitio;
const dataDelUsuario_ls="dataDelUsuario_"+nombreDelSitio;
const minSillasPorMesa=2;
const maxSillasPorMesa=6;

const caminoBackEnd = "../../Resto/API/"
const caminoBackend= "../../Resto/API/"
//       url = "../../server/admin/informes/mesas/facturacion"; 

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


function dataUsuario(){
  return parseJwt(localStorage[usuarioLogueado_ls]).data
}

function checkStr(str){
  if(str!=undefined && str!=null && str!="" && str!="undefined" && str!= "null") return true;
  else return false;
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