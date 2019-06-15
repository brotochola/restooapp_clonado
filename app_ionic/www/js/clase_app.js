console.log("clase_app.js")
class App {
    //todo lo q tenga q ver con navegacion UI lo pongo aca
    constructor(nombre) {
        this.$contenido = $("#contenido")
        //this.partesActivas= []
        this.nombre = nombre
        this.partes = [];
        this.$negroIndex=$("#negroIndex");
        this.$loading = $("#loading");
        this.$videoSplash=$("video#videoSplash");
 
    
    }
    quePasaDespuesDeLogin() {
        if(usuario.dataUsuario().id_rol==1){            
            this.traerHTML("partes/admin_estado.html", false, true, "admin_estado", false)
           setTimeout(()=>{ this.mostrarFooterAdmin()},200)//lo atamo con alambre
        }else if(usuario.dataUsuario().id_rol==2){      
            this.traerHTML("partes/mozo_estado.html", false, true, "admin_estado", false)
            setTimeout(()=>{ this.mostrarFooterMozo()},200)//seguimos usando alambre
        }else if(usuario.dataUsuario().id_rol==5){      
            //COCINERO
            this.traerHTML("partes/cocinero_estado.html", false, true, "cocinero_estado", false)
      
        }
      
     

    }

  
    init() {
        

       console.log("APP INIT")
       //MODALES:
       this.traerHTML("partes/verEstadoMesa.html", true, true, "verEstadoMesa", true)
       this.traerHTML("partes/agregarVerEmpleado.html", true, true, "verEmpleado", true)
       this.traerHTML("partes/verAgregarPedido.html", true, true, "modalVerPedido", true)
       
       this.traerHTML("partes/agregarVerProducto.html", true, true, "modalVerAgregarProducto", true)
       this.traerHTML("partes/agregarVerMesa.html", true, true, "agregarVerMesa", true)
        this.traerHTML("partes/modalConfirmacion.html", true, true, "modalConfirm", false)
       
        this.traerHTML("partes/nuevoPedidoAgregarProductos.html", true, true, "nuevoPedidoAgregarProductos", true)
        this.traerHTML("partes/nuevoCliente.html", true, true, "modalNuevoCliente", true)
        this.traerHTML("partes/perfilesDePrueba.html", true, true, "modalPerfilesDePrueba", true)
        
        

        



        //FOOTER
        this.traerHTML("partes/footerAdmin.html", true, true, "footerAdmin", true,"fija",()=>{
            setTimeout(()=>{this.$footerAdmin=$("#footerAdmin");},500);          
        })

        this.traerHTML("partes/footerMozo.html", true, true, "footerMozo", true,"fija",()=>{
            setTimeout(()=>{this.$footerMozo=$("#footerMozo");},500);          
        })

      
        //LOGIN LO TRAE NO COMO APPEND Y NO OCULTO
        this.traerHTML("partes/login.html", false, true, "login", false)


      

        if (usuario.tokenValido()) {
           setTimeout(()=>{this.quePasaDespuesDeLogin()},600);
        }

  

  
      
    


    }

    terminoVideoSplash(){
        this.mostrarLoading()
       this.$contenido.show();
       this.$videoSplash.hide();
       setTimeout(()=>{this.ocultarLoading()},500);

    }
   

    getGPS(cb){
       // if(!this.esApp()){
            
              navigator.geolocation.getCurrentPosition((e)=>{
                console.log("LAT="+e.coords.latitude);
                console.log("LNG="+e.coords.longitude); 
                //estan son globales:
                this.latitud=e.coords.latitude;
                this.longitud=e.coords.longitude;
                if(cb!=null && cb!=undefined) cb();
              }, function(e){
                   bootbox.alert("problema accediendo al GPS. "+JSON.stringify(e));   
              });


       
        
    }





    estaLaParte(url) {
        for (var i = 0; i < this.partes.length; i++) {
            if (this.partes[i].url == url) return true
        }
        return false;
    }

    mostrarLoading() {
        this.$loading.show();
    }
    ocultarLoading() {
        this.$loading.fadeOut();
    }


    esconderTodasLasPartes() {
        
        for (let i = 0; i < this.partes.length; i++) {
            if( this.partes[i].$el.hasClass("fija")) continue;
            this.partes[i].$el.hide()
        }
    }

    esconderUnaParte(url, id) {
        for (let i = 0; i < this.partes.length; i++) {
            if (this.partes[i].url == url || this.partes[i].id == id) {
                this.partes[i].$el.hide();
            }

        }
    }

    mostrarFooterAdmin(){
        this.$footerAdmin.show();
    }
    ocultarFooterAdmin(){
        this.$footerAdmin.hide();
    }

    mostrarFooterMozo(){
        this.$footerMozo.show();
    }
    ocultarFooterMozo(){
        this.$footerMozo.hide();
    }

    traerHTML(url, append, forzarNoCache, id, traerloOculto,clase,cb) {

      //  console.log("#### TRAER HTML ", url, append, forzarNoCache, id)
        if (this.estaLaParte(url)) {
          //  console.log("## esta la parte")
            for (let i = 0; i < this.partes.length; i++) {
                if (this.partes[i].url == url) {
                    if (!append) {
                        this.esconderTodasLasPartes();
                    }
                    //console.log(this.partes[i].$el)
                    this.partes[i].$el.show();
                    app.ocultarLoading()
                    return;
                }
            }
        }
      //  console.log("### NO ESTA LA PARTE")
        let urlFinal;
        if (forzarNoCache != true && forzarNoCache != 1) {
            urlFinal = url;
        } else {
            urlFinal = url + "?bla=" + Math.random()
        }
        //si tiene q traer la parte
        if (!append) app.mostrarLoading()
        $.ajax({
            url: urlFinal,
            success: (e) => {
                let span = document.createElement("parte"); //me gusta q se llamen asi
                span.id = id
                span.innerHTML = e;
                if (append != 1 && append != true) {
                    this.esconderTodasLasPartes();
                }
                this.partes.push({ url: url, id: id, $el: $(span) })
                if (traerloOculto==true) span.style.display = "none"
             
                if(cb instanceof Function) cb();
                if(checkStr(clase)) $(span).addClass("fija")
                this.$contenido.append(span)
                app.ocultarLoading()
            }, //fin success
            error: () => {
                app.ocultarLoading()
            }
        }) //ajax
    }



    esApp() {
        return window.hasOwnProperty("cordova");
    }

}