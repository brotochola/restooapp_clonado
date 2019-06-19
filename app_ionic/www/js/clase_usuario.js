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
        app.ocultarFooterAdmin();
        app.ocultarFooterMozo();
      //  app.inicioSesion()s
      //  app.ocultarFooterComercio()
      //  app.esconderFooter();

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
}