console.log("clase_api.js")

class API {
    constructor() {

        //local
        // this.urlServer="../../Resto/API/";
        //web

        //http://darodarioli.tech/restoapp2/Resto/API/
        // this.urlServer= "http://darodarioli.tech/restoapp2/Resto/API/";


        if (window.hasOwnProperty("cordova")) this.urlServer = "http://pixeloide.com/restoApp/API/";
        else this.urlServer = "../../Resto/API/";

        // this.urlServer="http://pixeloide.com/restoApp/API/"

        //ESTOS DATOS VIENEN DEL SERVER Y QUEDAN TODOS ACA:
        this.empleados = null;
        this.mesas = null;
        this.productos = null;
        this.estadoAnteriorMozo = null;
        this.estadoMozo = null;
        this.estadoCocinero = null;

    }

    mozoMandaPedido(ped, cb) {
        let pedidoParaMandar = {}
        pedidoParaMandar.id_mesa = mesaActiva.id_mesa;
        pedidoParaMandar.id_cliente = mesaActiva.cliente.id_cliente
        pedidoParaMandar.id_cliente_visita = mesaActiva.clienteVisita.id_cliente_visita;
        pedidoParaMandar.productos = []
        pedidoParaMandar.cantidades = []
        //los paso al formato q requiere el backend:
        for (let i = 0; i < ped.productos.length; i++) {
            pedidoParaMandar.productos.push(ped.productos[i].id_producto)
            pedidoParaMandar.cantidades.push(ped.productos[i].cantidad)
        }

        $.ajax({
            url: this.urlServer + "mozo/agregarPedido",
            type: "post",
            dataType: "json",
            headers: {
                token: localStorage[clienteLogueado_ls]
            },
            data: pedidoParaMandar,
            success: function (e) {

                console.log(e)

                if (cb instanceof Function) cb(e);

            }, error: e => console.log(e)
        })
    }

    traerProductos(cb) {

        $.ajax({
            //url: "../../server/admin/productos/lista",
            url: this.urlServer + "producto/listado",
            type: "post", //esto es solo porq estoy no usando un backend de verdad
            dataType: "json",
            headers: {
                token: localStorage[clienteLogueado_ls]
            },
            success: (e) => {
                console.log(e)
                this.productos = e

                localStorage["productos_" + nombreDelSitio] = e;

                if (cb instanceof Function) cb();
            }, error: e => console.log(e)
        })
    }

    traerUnaMesa(id, cb) {

        $.ajax({
            url: this.urlServer + "mesas/id/" + id,
            headers: {
                token: localStorage[clienteLogueado_ls]
            },
            dataType: "json",
            success: function (e) {
                // console.log(e)
                let mesa = e
                // console.log(mesa)
                if (cb instanceof Function) cb(mesa);
            }, error: (e) => {
                console.log(e)
            }
        }); //ajax
    }

    cargarPedidosMozo(cb) {
        $.ajax({
            url: this.urlServer + "mozo/traerMisPedidos",
            type: "post",
            dataType: "json",
            headers: {
                token: localStorage[clienteLogueado_ls]
            },
            success: (e) => {
                console.log(e)
                this.pedidosAnteriorMozo = this.pedidosMozo;
                this.pedidosMozo = e;
                if (cb instanceof Function) cb(e);
            },
            error: (e) => {
                console.log(e.responseText)
            }
        })
    }//estdo mozo

    logueo(mail, dni, cb) {
        console.log("Clase api: " + mail, dni, "server: " + this.urlServer)
        $.ajax({
            url: this.urlServer + "cliente/login2",
            type: "post",
            dataType: "json",
            data: {
                "email": mail,
                "dni": dni
            },
            success: (e) => {
                if (cb instanceof Function) cb(e);
            }, error: e => console.log(e)
        })
    }

    registro(datos, cb) {
        console.log("server: " + this.urlServer, datos);
        $.ajax({
            url: this.urlServer + "cliente/alta",
            type: "post",
            dataType: "json",
            data: datos,
            success: (e) => {
                alert("Te registraste!");
                if (cb instanceof Function) cb(e);
            }, error: e => console.log(e)
        })
    }
}