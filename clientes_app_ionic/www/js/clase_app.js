console.log("clase_app.js")
class App {
    //todo lo q tenga q ver con navegacion UI lo pongo aca
    constructor(nombre) {
        this.$contenido = $("#contenido")
        //this.partesActivas= []
        this.nombre = nombre
        this.partes = [];
        this.$negroIndex = $("#negroIndex");
        this.$loading = $("#loading");
        this.$videoSplash = $("video#videoSplash");
    }

    quePasaDespuesDeLogin() {
        console.log("Acá UI cliente");

        if (cliente.data.habilitado == 0) {
            mostrarModalConfirmacion("Todavía no se habilitó su usuario, debe revisar el enlace que se envió a su email", "OK", null, null, null);
        } else {

            //Aca verifica si tiene un cliente visita
            api.traerEstadoMesaCliente(cliente.data.id_cliente, this.queParteTrae);
        }

        //Ver qué opciones del footer
        //setTimeout(() => { this.mostrarFooterCliente() }, 200)//lo atamo con alambre
    }


    init() {
        console.log("APP INIT")
        //MODALES:
        this.traerHTML("partes/modalConfirmacion.html", true, true, "modalConfirm", false);
        this.traerHTML("partes/perfilesDePrueba.html", true, true, "modalPerfilesDePrueba", true);
        this.traerHTML("partes/nuevoCliente.html", true, true, "modalNuevoCliente", true);
        this.traerHTML("partes/nuevoAnonimo.html", true, true, "modalNuevoCliente", true);
        this.traerHTML("partes/nuevoPedidoAgregarProductos.html", true, true, "nuevoPedidoAgregarProductos", true);

        this.traerHTML("partes/verAgregarPedido.html", true, true, "modalVerPedido", true)


        //FOOTER
        //Revisar si es práctico que lo tenga el cliente, y qué opciones tendrá
        this.traerHTML("partes/footerCliente.html", true, true, "footerCliente", true, "fija", () => {
            setTimeout(() => { this.$footerCliente = $("#footerCliente"); }, 500);
        })

        //LOGIN LO TRAE NO COMO APPEND Y NO OCULTO
        this.traerHTML("partes/login.html", false, true, "login", false)

        if (cliente.tokenValido()) {
            setTimeout(() => { this.quePasaDespuesDeLogin() }, 600);
        }
    }

    queParteTrae() {
        if (api.datosClienteVisita == null) {
            app.traerHTML("partes/botonesQR.html", false, true, "botonesQR", false, "", null);
        } else {
            console.log("Mi mesa es #" + api.datosClienteVisita.id_mesa);
            app.traerHTML("partes/verEstadoMesaCliente.html", false, true, "verMiMesa", false, "", null);
        }
        setTimeout(() => { 
            $("#nombreCliente").html(cliente.dataCliente().nombre_completo); 
            $("#nombreClienteBotonQR").html(cliente.dataCliente().nombre_completo);
        }, 500);
    }

    terminoVideoSplash() {
        this.mostrarLoading()
        this.$contenido.show();
        this.$videoSplash.hide();
        setTimeout(() => { this.ocultarLoading() }, 500);
    }

    getGPS(cb) {
        // if(!this.esApp()){
        navigator.geolocation.getCurrentPosition((e) => {
            console.log("LAT=" + e.coords.latitude);
            console.log("LNG=" + e.coords.longitude);
            //estan son globales:
            this.latitud = e.coords.latitude;
            this.longitud = e.coords.longitude;
            if (cb != null && cb != undefined) cb();
        }, function (e) {
            bootbox.alert("problema accediendo al GPS. " + JSON.stringify(e));
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
            if (this.partes[i].$el.hasClass("fija")) continue;
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

    mostrarFooterCliente() {
        this.$footerCliente.show();
    }
    ocultarFooterCliente() {
        this.$footerCliente.hide();
    }

    traerHTML(url, append, forzarNoCache, id, traerloOculto, clase, cb) {
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
                if (traerloOculto == true) span.style.display = "none"

                if (cb instanceof Function) cb();
                if (checkStr(clase)) $(span).addClass("fija")
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