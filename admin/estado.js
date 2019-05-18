console.log("estado.js")

var delayTraerEstado = 5000;
var estadoActual = {};
var mesas;
var mesasCargadas = 0;
var docReady = 0;

$.ajax({
    url: "../../server/admin/mesas/lista",
    type: "get", //esto es solo porq estoy no usando un backend de verdad
    headers: {
        token: localStorage[usuarioLogueado_ls]
    },
    success: function(e) {
        //	console.log(e)
        try { mesas = JSON.parse(e) } catch (e) { mesas = e }
        localStorage["mesas_" + nombreDelSitio] = e;
        mesasCargadas = 1;
        if (docReady == 1) armarGraficoMesas();
    }
})



$(document).ready(function() {
    docReady = 1;
    if (mesasCargadas == 1) armarGraficoMesas();
    console.log("doc ready estado admin");

    agregarCachoABody("footerAdmin.html", function() {
        $($(".botonFooterAdmin")[0]).addClass("active") //en la pantalla de estado, empieza activo el boton de estado
    })

    //populo cosas:
    try {
        console.log(localStorage[usuarioLogueado_ls])
        obj = JSON.parse(localStorage[usuarioLogueado_ls])
        $("h6#nombreAdmin").html(obj.nombre)

    } catch (e) {
        console.log(e)
        $("h6#nombreAdmin").html(localStorage[usuarioLogueado_ls].nombre)
    }


    //listeners


    //agrego cachos:
    agregarCachoABody("modalConfirmacion.html")
    agregarCachoABody("verEstadoMesaAdmin.html")


    cargarEstadoAdmin()
});

function verMesa(id){
	//aca la funcion ver mesa es esta
	//en la pantalla de mesas la funcion es otra
	mostrarEstadoMesaAdmin(id)

}

function cargarEstadoAdmin() {
    //esta funcion se ejecuta cada 5 segundos
    if (mesas==undefined || mesas.length == 0 || isNaN(mesas[0].id) || mesas[0].id == undefined) return; //si no estan cargadas las mesas, el grafico, esta funcion no anda

    $.ajax({
        url: "../../server/admin/estado",
        success: function(e) {
            try { estadoActual = JSON.parse(e) } catch (e) { estadoActual = e }
            console.log(estadoActual)
            $("#recaudacionDia").html("$" + estadoActual.facturacionDia);
            $("#cantComensalesDia").html(estadoActual.cubiertosDelDia);
            //estados de las mesas
            try { m = JSON.parse(localStorage["mesas_" + nombreDelSitio]) } catch (err) { m = localStorage["mesas_" + nombreDelSitio] }
            for (var i = 0; i < estadoActual.mesas.length; i++) {
                $(".mesa." + estadoActual.mesas[i].id + " img.mesaImg")[0].src = "../mesas/" + m[mesaId2i(m[i].id)].sillas + "/" + estadoMesas[estadoActual.mesas[i].estado] + ".png";
            }

            setTimeout(cargarEstadoAdmin, delayTraerEstado)
        }
    })
}