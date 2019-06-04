console.log("empleados.js")

var empleadosCargados = 0;
var docReady = 0;
var empleados = [];

var rolesEmpleados=[null, "Bartender", "Cervecerx", "Cocinerx", "Camarerx", "Admin", "Candybar"];



$.ajax({
    //url: "../../server/admin/empleados/lista",
    url: caminoBackEnd + "empleados/listar",
    type: "get", //esto es solo porq estoy no usando un backend de verdad
    headers: {
        token: localStorage[usuarioLogueado_ls]
    },
    success: function(e) {

        	
        try 
        { 
            empleados = e;  
            //empleados = JSON.parse(e);  
    
        }
        catch (e) { 
            empleados = e
        }


        localStorage["empleados_" + nombreDelSitio] = e;
        empleadosCargados = 1;
        if (docReady == 1) armarTablaEmpleados();
    }
})



$(document).ready(function() {
    docReady = 1;
    if (empleadosCargados == 1) armarTablaEmpleados();
    console.log("doc ready empleados admin");

    agregarCachoABody("modalConfirmacion.html");
   	agregarCachoABody("footerAdmin.html",function(){
		$($(".botonFooterAdmin")[1]).addClass("active") //en la pantalla de estado, empieza activo el boton de estado
	})
	 agregarCachoABody("agregarVerEmpleado.html")

	$("h6#nombreAdmin").html(dataUsuario().nombre)



});


function armarTablaEmpleados() {

    html = "";
    for (var i = 0; i < empleados.length; i++) {
        if (empleados[i] != undefined && empleados[i] != -1) {
            html += armarEmpleado(empleados[i]);
            
        }
    }
    $("#listaDeEmpleados").html(html)
}

function armarEmpleado(emp) {


    html = ' <li> <div class="row filaEmpleado">  <div class="col-10">' + emp.nombre_completo + ' - <span>'+rolesEmpleados[emp.id_rol]+'</span></div>';
    html += '<div class="col-2">'
    html += '<i class="fa fa-pencil-alt" onclick="mostrarAgregarVerEmpleado('+emp.id_empleado+')"></i>    </div>                </div>                </li>            <hr>';
    
    return html
}


function traerEmpleadoPorId(id) {

   
    for (var i = 0; i < empleados.length; i++) {

        if (empleados[i].id_empleado == id) {
            return empleados[i];
        }
    }
    return -1;
   
}