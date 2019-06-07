class Productos{



 static armarTablaProductos($donde) {


   let html = "";
    html += Productos.armarProducto(null); //uno vacio
    for (var i = 0; i < api.productos.length; i++) {
        if (api.productos[i] != undefined && api.productos[i] != -1) {
            html += Productos.armarProducto(api.productos[i]);
        }
    }
    $donde.html(html);
    //$("#listaDeProductos").html(html)
}

static  armarProducto(prod) {
    let  html="";
    if (prod == null) {
        
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
       
        html += '      <li>'
        html += '         <div class="row">'
        html += '              <div class="col-3">'
        html += '                  <img src="' + imgRolesEmpleados[prod.id_cocina] + '">'
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


static traerProductoPorId(id) {

   
    for (var i = 0; i < api.productos.length; i++) {

        if (api.productos[i].id_producto == id) {
            return api.productos[i];
        }
    }
    return -1;
   
}
    
}