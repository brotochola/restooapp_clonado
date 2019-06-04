console.log("estado.js")

var delayTraerEstado = 5000;
var estadoActual = {};
var mesas;
var mesasCargadas = 0;
var docReady = 0;

$.ajax({
    url: caminoBackend+"/mesas/lista",
    type: "post", 
    dataType:"json",
    headers: {
        token: localStorage[usuarioLogueado_ls]
    },
    success: function(e) {
        //	console.log(e)
        mesas=e
        localStorage["mesas_" + nombreDelSitio] = JSON.stringify(e);
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

       
    
    $("h6#nombreAdmin").html(dataUsuario().nombre)

  
  


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
    console.log("estado admin")
    //esta funcion se ejecuta cada 5 segundos
    if (mesas==undefined || mesas.length == 0 || isNaN(mesas[0].id_mesa) || mesas[0].id_mesa == undefined) {
        console.log("error..")
      //  return; //si no estan cargadas las mesas, el grafico, esta funcion no anda

    }

    $.ajax({
        url: caminoBackend+"admin/estado",
        type:"post",
        headers:{
            token:localStorage[dataDelUsuario_ls]
        },
        success: function(e) {
            estadoActual = e
            console.log(estadoActual)
            $("#recaudacionDia").html("$" + estadoActual.facturacionDia);
            $("#cantComensalesDia").html(estadoActual.cubiertosDelDia);
            //estados de las mesas
            //try { m = JSON.parse(localStorage["mesas_" + nombreDelSitio]) } catch (err) { m = localStorage["mesas_" + nombreDelSitio] }
            //console.log(m)
            for (var i = 0; i < estadoActual.mesas.length; i++) {
              
                    $(".mesa." + estadoActual.mesas[i].id_mesa + " img.mesaImg")[0].src = "../mesas/" + estadoActual.mesas[i].sillas + "/" + estadoMesas[estadoActual.mesas[i].estado_mesa] + ".png";
               
            }

            setTimeout(cargarEstadoAdmin, delayTraerEstado)
        },error:(e)=>{
            console.log(e)
        }
    })
}

cargarEstadoAdmin();