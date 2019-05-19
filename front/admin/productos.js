console.log("productos.js")

var productosCargados = 0;
var docReady = 0;
var productos = [];

var rolesEmpleados = [null, "../media/Img/roles/tragos.png", "../media/Img/roles/cerveza.png", "../media/Img/roles/cocina.png", "Camarerx", "Admin", "../media/Img/roles/candy.png"];



$.ajax({
    //url: "../../server/admin/productos/lista",
    url: caminoBackEnd + "producto/listado",
    type: "get", //esto es solo porq estoy no usando un backend de verdad
    headers: {
        token: localStorage[usuarioLogueado_ls]
    },
    success: function(e) {
        //  console.log(e)
        try { 
            //productos = JSON.parse(e)
            productos = e
        
        } catch (e) { productos = e }
        localStorage["productos_" + nombreDelSitio] = e;
        productosCargados = 1;
        if (docReady == 1) armarTablaProductos();
    }
})


$(document).ready(function() {
    docReady = 1;
    if (productosCargados == 1) armarTablaProductos();
    console.log("doc ready productos admin");

    agregarCachoABody("modalConfirmacion.html");
    agregarCachoABody("footerAdmin.html", function() {
        $($(".botonFooterAdmin")[4]).addClass("active") //en la pantalla de estado, empieza activo el boton de estado
    })
    agregarCachoABody("agregarVerProducto.html")

    $("h6#nombreAdmin").html(JSON.parse(localStorage[usuarioLogueado_ls]).nombre)



});




function armarTablaProductos() {


    html = "";
    html += armarProducto(null); //uno vacio
    for (var i = 0; i < productos.length; i++) {
        if (productos[i] != undefined && productos[i] != -1) {
            html += armarProducto(productos[i]);
        }
    }
    $("#listaDeProductos").html(html)
}

function armarProducto(prod) {
    if (prod == null) {
        html = "";
        html += '      <li>'
        html += '         <div class="row">'
        html += '              <div class="col-3">   '
        html += '             </div>'
        html += '             <div class="col-7"></span></div>'
        html += '             <div class="col-2">'
        html += '                </div>'
        html += '          </div>'
        html += '       </li>'
        html += '       <hr>';

    } else {
        html = "";
        html += '      <li>'
        html += '         <div class="row">'
        html += '              <div class="col-3">'
        html += '                  <img src="' + rolesEmpleados[prod.id_cocina] + '">'
        html += '             </div>'
        html += '             <div class="col-7">' + prod.nombre_producto + ' - <span>$' + prod.precio + '</span></div>'
        html += '             <div class="col-2">'
        html += '                   <i class="fa fa-pencil-alt" onclick="mostrarAgregarVerProducto(' + prod.id_producto + ')"></i>'
        html += '                </div>'
        html += '          </div>'
        html += '       </li>'
        html += '       <hr>';

    }
    return html
}


function traerProductoPorId(id) {

   
    for (var i = 0; i < productos.length; i++) {

        if (productos[i].id_producto == id) {
            return productos[i];
        }
    }
    return -1;
   
}