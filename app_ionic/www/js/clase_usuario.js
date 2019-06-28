console.log("clase_usuario.js")
const nombreDelSitio="Resto UTN";
const usuarioLogueado_ls="token"+nombreDelSitio;
const dataDelUsuario_ls="dataDelUsuario_"+nombreDelSitio;
var fotoDelUsuario="sinFoto";

class Usuario {

    constructor(token) {
        if (token != undefined) {
            if (Usuario.chequearValidezToken(token)) {
                this.token = localStorage[usuarioLogueado_ls] = token;
            } else {
                alert("el token q le metes al usuario no es valido")
            }
        } else { //si no le entra token al constructor
            if (localStorage.hasOwnProperty(usuarioLogueado_ls)) {
                //si hay token en el localstorage
                if (Usuario.chequearValidezToken(localStorage[usuarioLogueado_ls])) {
                    //si el token del localstorage esta ok
                    this.token = localStorage[usuarioLogueado_ls]
                    this.data = this.dataUsuario();
                   


                } else {
                    //si el token del localstorage no es valido y ademas no le entra token al construcotr...
                    this.token = localStorage[usuarioLogueado_ls] = "";

                }
            }
        }




    }


    getRol(){
        return  rolesEmpleados[this.dataUsuario().id_rol];
    }


    tokenValido() {
        return Usuario.chequearValidezToken(this.token)
    }



    logout() {
       // app.retraerMenuLateral();
        localStorage[usuarioLogueado_ls] =  "";
        usuario.data={};
        usuario.token="";
        app.traerHTML("partes/login.html");
       app.sacarTodoMenosUnaParteID("login");

       // app.ocultarFooterAdmin();
        //app.ocultarFooterMozo();
      //  app.inicioSesion()s
      //  app.ocultarFooterComercio()
      //  app.esconderFooter();

        app.audioLogout.play();

    }
    dataUsuario() {
        // console.log(parseJwt(this.token))
        if (this.token != "") return parseJwt(this.token).data
        else return {}
    }

    meterleToken(token) {
        this.token = token || "";
        localStorage[usuarioLogueado_ls] = this.token;
        this.data = this.dataUsuario();
      
      

    }


    static chequearValidezToken(token) {
        if (!checkStr(token)) return false;
        let data = parseJwt(token);
        if (data.data == undefined) return false;

        let fech = new Date(data.exp);
        if ((fech * 1000) < Date.now()) {
            return false;
        } else {
            return true;
        }
    }



    actualizarData(callback){
      //  console.log(this.token)
       $.ajax({
            url: urlServer + "usuarios/traerData",
           headers:{
               "token":this.token
           },
            type: "post",
            success: (e)=> {
               // console.log(e)
                this.meterleToken(e)
                if(callback instanceof Function) callback();
            }, error:(e)=>{
                console.log(e)
            }
    });//ajax
   }//actualizar


   static parsearQRDNI(_text){
    
        console.log(_text);
         let  rta={ nombre : '',
            apellido : '',
            dni : '',
            sexo : '',
            fechaNac : '',
            raw :_text
        };
        let data = _text.split('@');
        console.log(data);
        if( data.length == 8 ||  data.length == 9 ) {
          // Formato nuevo
          rta.apellido = data[1].trim()
          rta.nombre   = data[2].trim()
          rta.sexo     = data[3].trim()
          rta.dni      = data[4].trim()
          rta.fechaNac = data[6].trim()
      
        } else if (data.length == 15) {
          // Formato anterior
          rta.apellido = data[4].trim()
          rta.nombre   = data[5].trim()
          rta.sexo     = data[8].trim()
          rta.dni      = data[1].trim()
          rta.fechaNac = data[7].trim()
        } else {
        
          return -1;
        } //tipo de data q tiene el dni
      
        /////////////
  /*  const validarTexto = _text => {
        // El protocolo mantiene el texto en mayúsculas y sin caracteres especiales
        let _regex = /^[A-Z ]+$/;
        return _regex.test(_text.trim());
    }
    const validarFecha = _text => {
        let _regex = /^[0-9]{2}\/[0-9]{2}\/[0-9]{4}?$/;
        return _regex.test(_text.trim());
    }
    const validarNumero = _text => {
        _text = _text.trim();
        return !isNaN(_text) && _text.length >= 7 && _text.length <= 8;
    }*/
 //////////////////////
      
      return rta;
      

   } //parsear dni

}