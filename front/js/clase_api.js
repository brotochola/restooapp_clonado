console.log("clase_api.js")

class API{

    constructor(){
        this.urlServer="../Resto/API/";

        //ESTOS DATOS VIENEN DEL SERVER Y QUEDAN TODOS ACA:
        this.empleados=null;
        this.mesas=null;

    }

    traerUnaMesa(id,cb){

        $.ajax({
            url: this.urlServer+"mesas/id/"+id,
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            dataType:"json",
            success: function(e) {
               // console.log(e)
                let mesa=e
               // console.log(mesa)
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

    traerEmpleados(cb){

        $.ajax({
           
            url: this.urlServer + "empleados/listar",
            type: "post",
            dataType:"json",
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            success: (e) =>{
                this.empleados = e  
                 
                localStorage["empleados_" + nombreDelSitio] = JSON.stringify(e);              
                if(cb instanceof Function) cb(e);
            }
        })
    
    
    

    }//traerEmpleados


    agregarEmpleado(cb,emple){
        console.log("agregarEmpleado api")
        $.ajax({
            type:"post",
            dataType:"json",
            url: api.urlServer + "empleados/alta",
            //url:"../../server/admin/empleados/agregar",
            headers:{
                token: localStorage[usuarioLogueado_ls]
            },
            data:emple,
            success:(e)=>{
                console.log(e)
                if(e!=-1) {
                      this.empleados = e
                        localStorage["empleados_" + nombreDelSitio] = JSON.stringify(e);
                        if(cb instanceof Function) cb(e);
    
                }else{
                    mostrarModalConfirmacion("Error conectando con la Base de datos", "ok")
                
                }
               
            },error:(e)=>{
                console.log(e)
            }
        })
    }

    modificarEmpleado(cb,emple){
        $.ajax({
            // url:"../../server/admin/empleados/modificar",
            url: this.urlServer + "empleados/modificar",
             headers:{
                 token: localStorage[usuarioLogueado_ls]
             },
             type:"post",
             dataType:"json",
             data:emple,
             success:(e)=>{
                 console.log(e)
                 if(e!=-1) {
                       this.empleados=e
                         localStorage["empleados_" + nombreDelSitio] = JSON.stringify(e);
                       
     
                 }else{
                     mostrarModalConfirmacion("Error conectando con la Base de datos", "ok")
                 
                 }                 
                  if(cb instanceof Function) cb(e);
             },
             error:(e)=>{
                 console.log(e)
             }
         }) //ajx

    }

    cargarEstadoAdmin(cb){
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
    }//cargarEstadoAdmin



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