console.log("estado.js")

var delayTraerEstado = 5000;
var tiempoNotificacion = 3500;
var estadoActual = {};
var mesas;
var mesasCargadas = 0;
var docReady = 0;
var notificacionesPendientes = [];


//ni bien empieza cargo las mesas,
//dps me manejo solo con el array q trae el servicio de la API: /mozo/estado
//cada 5 segundos

$.ajax({
    url: caminoBackend+"mozo/mesas/lista",
    type: "get", //esto es solo porq estoy no usando un backend de verdad
    headers: {
        token: localStorage[usuarioLogueado_ls]
    },
    success: function(e) {
        //  console.log(e)
        try { mesas = JSON.parse(e) } catch (e) { mesas = e }
        localStorage["mesas_" + nombreDelSitio] = e;
        mesasCargadas = 1;
        if (docReady == 1) setup()
    }
})

function setup() {
    cargarEstadoMozo();
    armarGraficoMesas();
}

function logOut() {
    mostrarModalConfirmacion("Seguro que querés desloguearte?", "si", "no", function() {
        localStorage[usuarioLogueado_ls] = null;
        window.location.href = "index.html"
    })
}

$(document).ready(function() {
    docReady = 1;
    if (mesasCargadas == 1) setup()
    console.log("doc ready estado mozx");



    //populo cosas:
    try {
        console.log(localStorage[usuarioLogueado_ls])
        obj = JSON.parse(localStorage[usuarioLogueado_ls])
        $("#nombreMozo").html(obj.nombre)

    } catch (e) {
        console.log(e)
        $("#nombreMozo").html(localStorage[usuarioLogueado_ls].nombre)
    }


    //listeners


    //agrego cachos:
    agregarCachoABody("modalConfirmacion.html")
    agregarCachoABody("verEstadoMesaMozo.html")
    agregarCachoABody("verAgregarPedidoMozo.html")
    agregarCachoABody("nuevoPedidoAgregarProductos.html")
    agregarCachoABody("nuevoCliente.html")





});

function verMesa(id) {
    //aca la funcion ver mesa es esta
    //en la pantalla de mesas la funcion es otra
    console.log(estadoActual)
    console.log(estadoActual.estados)
    if (estadoActual == undefined || estadoActual.estados == undefined) {
        mostrarModalConfirmacion("Esperando data... momento", "ok")
        return;
    }

    if (estadoActual.estados[id] == 0 || estadoActual.estados[id] == undefined) {
        //la mesa esta libre
        mostrarModalNuevoCliente(id); //y le mando el id de la mesa
    } else {
        mostrarEstadoMesaMozo(id)
    }



}

function cargarEstadoMozo() {
    console.log("cargar estado mozo!")
    //esta funcion se ejecuta cada 5 segundos
    if (mesas == undefined || mesas.length == 0 || isNaN(mesas[0].id) || mesas[0].id == undefined) return; //si no estan cargadas las mesas, el grafico, esta funcion no anda

    $.ajax({
        url: caminoBackend+"mozo/estado",
        success: function(e) {
            try { estadoActual = JSON.parse(e) } catch (e) { estadoActual = e }
            console.log(estadoActual)
            //console.log(estadoActual)
            $("#recaudacionDia").html("$" + estadoActual.facturacionDia);
            $("#cantComensalesDia").html(estadoActual.cubiertosDelDia);
            //estados de las mesas
            // console.log(mesas)
            // console.log(estadoActual)
            var idsMesas = Object.keys(estadoActual.estados);

            for (var i = 0; i < idsMesas.length; i++) {
                $(".mesa." + idsMesas[i] + " img.mesaImg")[0].src = "../mesas/" + mesas[mesaId2i(parseInt(idsMesas[i]))].sillas + "/" + estadoMesas[estadoActual.estados[idsMesas[i]]] + ".png";
            }

            //veo si hay notificaciones:
            if (estadoActual.notif.length > 0) {
                for (var i = 0; i < estadoActual.notif.length; i++) {
                    n = estadoActual.notif[i];
                    cargarNotificacion(n)
                }
            }
            mostrarSiguienteNotificacion()
            //espera y pide el estado al server de nuevo
            setTimeout(cargarEstadoMozo, delayTraerEstado)
        }
    }) //ajax


}


function mostrarSiguienteNotificacion() {
var muestro=1;
    $(".fondo-modal").each(function(k,v){
          if($(v).is(":visible") ==true) muestro=0
    })
  
    //si estan todos invisible, sigue de largo y muestra la siguiente notif
    if (muestro==1 && notificacionesPendientes.length > 0) mostrarNotificacion(notificacionesPendientes.pop())

}


function mostrarNotificacion(n) {
    try {
        $("#donde").html(n.donde.toUpperCase())
        $("#idPedido").html("#" + n.pedido)
        $("#idMesa").html("#" + n.mesa)

        $("#notificacionesMozo").fadeIn()
        setTimeout(ocultarNotificaciones, tiempoNotificacion)
    } catch (e) { console.log("la notificacion no está completa y nos e muestra") }
}

function ocultarNotificaciones() {
    $("#notificacionesMozo").fadeOut()
}

function cargarNotificacion(n) {

    for (var i = 0; i < notificacionesPendientes.length; i++) {
        // console.log(notificacionesPendientes[i].mesa, n.mesa, notificacionesPendientes[i].pedido, n.pedido, notificacionesPendientes[i].donde, n.donde)
        if (notificacionesPendientes[i].mesa == n.mesa && notificacionesPendientes[i].pedido == n.pedido && notificacionesPendientes[i].donde == n.donde) {
            //  console.log("son iguales")
            return;;
        }
    }
    //no esta
    notificacionesPendientes.push(n)
}