console.log("clase_api.js")

class API{

    constructor(){
        this.urlServer="../Resto/API/";

    }

    traerMesas(cb){
        $.ajax({
            url: this.urlServer+"/mesas/lista",
            type: "post", 
            dataType:"json",
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            success: cb
        })
    }

    estadoAdmin(cb){
        $.ajax({
            url: this.urlServer + "admin/estado",
            type: "post",
            headers: {
                token: localStorage[dataDelUsuario_ls]
            },
            success: cb,
            error: (e) => {
                console.log(e)
            }
        })
    }
    logueo(mail, clave,cb){
        console.log(mail,clave)
        $.ajax({
            url: this.urlServer + "login/",
            type:"post",
            dataType:"json",
            data:{
                "email":mail,
                "clave":clave
            },
            success:cb
        })
    }

}