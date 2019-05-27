console.log("clase_usuario.js")

class Usuario {

    constructor(token) {
        if (token != undefined) {
            if (Usuario.chequearValidezToken(token)) {
                this.token = localStorage["token"] = token;
            } else {
                alert("el token q le metes al usuario no es valido")
            }
        } else { //si no le entra token al constructor
            if (localStorage.hasOwnProperty("token")) {
                //si hay token en el localstorage
                if (Usuario.chequearValidezToken(localStorage["token"])) {
                    //si el token del localstorage esta ok
                    this.token = localStorage["token"]
                    this.data = this.dataUsuario();
                    if (localStorage.hasOwnProperty("cupones_del_usuario")) {
                        try { this.actualizarListaDeCupones(JSON.parse(localStorage["cupones_del_usuario"])) } catch (e) {
                            this.token = localStorage["token"] = "";
                        }
                    }



                } else {
                    //si el token del localstorage no es valido y ademas no le entra token al construcotr...
                    this.token = localStorage["token"] = "";

                }
            }
        }




    }

    actualizarListaDeCupones(arr) {
        this.data.cupones = CuponObtenido.json2ArrayDeCuponesObtenidos(arr)
        localStorage["cupones_del_usuario"] = JSON.stringify(this.data.cupones)

      
    }



    tokenValido() {
        return Usuario.chequearValidezToken(this.token)
    }



    logout() {
        app.retraerMenuLateral();
        localStorage["token"] = localStorage["cupones_del_usuario"] = "";
        usuario.data={};
        usuario.token="";
        app.inicioSesion()
        app.ocultarFooterComercio()
        app.esconderFooter();

    }
    dataUsuario() {
        // console.log(parseJwt(this.token))
        if (this.token != "") return parseJwt(this.token).data
        else return {}
    }

    meterleToken(token) {
        this.token = token || "";
        localStorage["token"] = this.token;
        this.data = this.dataUsuario();
        localStorage["cupones_del_usuario"] = JSON.stringify(this.data.cupones)
        this.armarMenuLateral()

    }

    armarMenuLateral() {
        if(!this.hasOwnProperty("data")) return;
        if(!this.data.hasOwnProperty("nombre")) return;
        $("#nombreDelUsuarioMenuLateral").html(this.data.nombre);
        
      

        let str = '';
        if(!this.data.hasOwnProperty("comercios")){
            this.data.comercios=[];

        }
        for (let i = 0; i < this.data.comercios.length; i++) {

            let c=this.data.comercios[i];
            
          
            

            str += ' <div onclick="app.abrirHomeComercio('+c.id_comercio+')" class="menu-item" '+c.id_comercio+'">';
          //  str += '<div class="menu-item-bg" style="background-image:url('+urlServer+c.img_portada+')">';
            str += '<div class="logo-holder">';
            str += '<img src="'+urlServer+c.img_logo+'"   alt="">';
            str += '</div>';
         //   str += '</div>';
            str += '<div class="menu-content">';
            str += '<h3 class="tituloComercioMenuLateral">'+c["nombre"]+'</h3>';
            str += '<p> <b>Dirección:</b> '+c.direccion.toUpperCase()+' </p>';
            str += '<p> <b>Rubro:</b> '+c.nombre_categoria_comercio+'</p>';
            str += '</div> </div>';

        }

        $("#comerciosDelUsuario").html(str);
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

    queCuponesTengoEnMisComercios() {
        let arr = [];
        for (let i = 0; i < this.data.comercios.length; i++) {
            for (let j = 0; j < this.data.comercios[i].cupones.length; j++) {
                arr.push(this.data.comercios[i].cupones[j].id)
            }
        }
        return arr;
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