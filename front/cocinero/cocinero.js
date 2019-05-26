console.log("cocinero.js")

const tiempoDelay = 10000;

$(document).ready(function() {
    cargarEstado()

});

var estadoActual = {};

function cargarEstado() {
    console.log("cargar estado")

    $.ajax({
        url: caminoBackend+"cocinero/estado",
        headers: {
            token: localStorage[usuarioLogueado_ls]
        },
        success: function(e) {
            try { estadoActual = JSON.parse(e) } catch (e) { estadoActual = e }
            actualizarEstadoActual(estadoActual)
        }
    })




    setTimeout(cargarEstado, tiempoDelay)
}


function actualizarEstadoActual(ea) {
    if (ea.notif.length > 0) {
        mostrarNotif(ea.notif[0])
    }

    $("#contenedorPedidosActuales").html("")
    for (var i = 0; i < ea.pedidos.length; i++) {
        $("#contenedorPedidosActuales").append(armarPedidoActual(ea.pedidos[i]))
    }
}

function mostrarNotif(notif) {
    console.log("lanzando notificacion")
    rol = JSON.parse(localStorage[usuarioLogueado_ls]).rol
    $("#rolEmple").html(lugaresDeTrabajoRoles[rol])
    $("#mesaNum").html(notif.mesa)
    $("#pedidoNum").html(notif.pedido)
    $("#horaPedido").html("Hora Pedido: " + notif.hora_pedido)

    keys = Object.keys(notif.prods)
    $("#contPedidosNotif").html("")
    for (var i = 0; i < keys.length; i++) {

        $("#contPedidosNotif").append(armarProdNotif(keys[i], notif.prods[keys[i]]))
    }


    $("#notifCocinero").fadeIn()
}

function armarProdNotif(id, prod) {
    html = ""
    html += ' <div class="col-6">';
    html += '<div class="row">';
    html += '<div class="col-4">';
    html += '<span class="numero-de-pedido-cocinero">#<span id="idProducto">' + id + '</span></span>';
    html += '</div> ';
    html += '<div class="col-8 nombreProd">' + prod + '</div>';
    html += '</div>';
    html += '</div>';
    return html
}

function aceptarPedido(id) {
    $("#notifCocinero").fadeOut()
    $.ajax({
        url: caminoBackend+"cocinero/aceptarPedido",
        headers: {
            token: localStorage[usuarioLogueado_ls]
        },
        data: {
            "idPedido": id
        },
        success: function(e) {
            try { estadoActual = JSON.parse(e) } catch (e) { estadoActual = e }        	
        	actualizarEstadoActual(estadoActual)
        }
    })
}

function armarProdPedidoActual(id, nombre) {
    var html = ""
    html += '<div class="col-12 prod">'
    html += '<div class="row">'
    html += '<div class="col-2">'
    html += '<span class="numero-de-pedido-cocinero">#' + id + '</span>'
    html += '</div>'
    html += '<div class="col-10 text-left">' + nombre + ' </div>'
    html += '</div>'
    html += '<hr>'
    html += '</div>'
    return html;
}


function pedidoListo(id) {
    console.log("el pedido " + id + " esta listo")
    $(".unPedido."+id).remove() //esto es de mentirita

}

function armarPedidoActual(pedido) {


    console.log(pedido)

    var html = '  <!-- un pedido -->'
    html += '            <div class="unPedido '+pedido.id+'">'
    html += '                  <div class="row listaPedidosPendientes">'
    html += '  <div class="col-5">'
    html += '  <img src="../media/Img/pedido-black.png" class="pedido-pendiente">'
    html += '  <span class="n-pedido-p">PEDIDO #<strong>' + pedido.id + '</strong></span>'
    html += '  </div>'
    html += '  <div class="col-5">'
    html += '  <img src="../media/Img/mesa.png" class="mesa-pendiente">'
    html += '  <span class="n-mesa-p">MESA #<strong>' + pedido.mesa + '</strong></span>'
    html += '  </div>'
    html += '  <div class="col-2 check-verde-pedidos">'
    html += '  <img src="../media/Img/check-verde.png" onclick="pedidoListo(' + pedido.id + ')">'
    html += '  </div>'
    html += '  </div>'
    html += '  <div class="row list-pedidos-pendientes">'

    keys = Object.keys(pedido.prods)
    for (var i = 0; i < keys.length; i++) {
        html += armarProdPedidoActual(keys[i], pedido.prods[keys[i]])
    }

    html += '  </div>'
    html += '  </div>'
    html += '  <!-- fin pedido-->'
    console.log()
    return html
}