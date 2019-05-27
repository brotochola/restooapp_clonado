console.log("clase_api.js")

class API{

    constructor(){
        this.urlServer="../Resto/API/";

    }

    traerUnaMesa(id,cb){

        $.ajax({
            url: this.urlServer+"mesas/id/"+id,
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            success: function(e) {
                console.log(e)
                let mesa;
                try { mesa = JSON.parse(e) } catch (e) { mesa = e }
                console.log(mesa)
                if(cb instanceof Function) cb(mesa);
            },error:(e)=>{
                console.log(e)
            }
             }); //ajax
    }

    traerMesas(cb){
        $.ajax({
            url: this.urlServer+"/mesas/lista",
            type: "post", 
            dataType:"json",
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            success: (e)=>{
                this.mesas=e;
                localStorage["mesas_" + nombreDelSitio] = JSON.stringify(e);
                if(cb instanceof Function) cb(e);
            }
        })
    }

    estadoAdmin(cb){
        $.ajax({
            url: this.urlServer + "admin/estado",
            type: "post",
            headers: {
                token: localStorage[dataDelUsuario_ls]
            },
            success: (e)=>{
                this.estadoAdmin=e;
                if(cb instanceof Function) cb(e);
            },
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
            success:(e)=>{
                if(cb instanceof Function) cb(e);
            }
        })
    }

}