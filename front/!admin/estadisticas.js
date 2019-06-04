console.log("estadisticas.js")

/*
7- De los empleados:
a- Los días y horarios que se Ingresaron al sistema.
b- Cantidad de operaciones de todos por sector.
c- Cantidad de operaciones de todos por sector, listada por cada empleado.
d- Cantidad de operaciones de cada uno por separado.
e- Posibilidad de dar de alta a nuevos, suspenderlos o borrarlos.

8- De las pedidos:
a- Lo que más se vendió.
b- Lo que menos se vendió.
c- Los que no se entregaron en el tiempo estipulado.
d- Los cancelados.

9- De las mesas:
a- La más usada.
b- La menos usada.
c- La que más facturó.
d- La que menos facturó.
e- La/s que tuvo la factura con el mayor importe.
f- La/s que tuvo la factura con el menor importe.
g- Lo que facturó entre dos fechas dadas.
h- Mejores comentarios.
i- Peores comentarios
*/
window.alert = function() {}
$(document).ready(function() {

    agregarCachoABody("footerAdmin.html", function() {
        $($(".botonFooterAdmin")[5]).addClass("active") //en la pantalla de estado, empieza activo el boton de estado
    })


    //listeners

    $("#seleccionMetrica, #desde, #hasta").change(actualizarTabla);


    $("#catInfo").change(function() {
        $("#seleccionMetrica").html("");
        if (this.value == 1) {
            $("#seleccionMetrica").append("<option value='1'>Logins</option>")
            $("#seleccionMetrica").append("<option value='2'>Cant de Operaciones por Sector</option>")
            $("#seleccionMetrica").append("<option value='3'>Cant de Operaciones por Empleadx</option>")

            //metricas de los empleados
        } else if (this.value == 2) {
            //mtricas de los productos
            $("#seleccionMetrica").append("<option value='1'>Cantidad de Ventas</option>")
            $("#seleccionMetrica").append("<option value='2'>Tiempo de espera extra</option>")
            $("#seleccionMetrica").append("<option value='3'>Cantidad de Cancelaciones</option>")




        } else if (this.value == 3) {
            //metricas de las mesas
            $("#seleccionMetrica").append("<option value='1'>Cantidad de usos</option>")
            $("#seleccionMetrica").append("<option value='2'>Facturación</option>")
            $("#seleccionMetrica").append("<option value='3'>Factura única más grande</option>")
        }
    }) //change
    $("#catInfo").change()

    actualizarTabla();


});
var informe;
var tabla;

function actualizarTabla() {
    console.log("actualizar tabla estadistcas!")

	$("#contTablaEstadisticas").html("")
    $("#contTablaEstadisticas").append('<table class="contenedor-listados-pedidos" id="ulStats"></table>')



    var catInfo = $("#catInfo")[0].value;
    var informe = $("#seleccionMetrica")[0].value;
    var url = ""
    var cb;
    //segun la combinacion de los 2 select mando a diferentes urls de apis
    if (catInfo == 1) {
        if (informe == 1) {
            url = caminoBackend+"admin/informes/empleados/logueos";
            cb = armarTabla;
        } else if (informe == 2) {
            url = caminoBackend+"admin/informes/empleados/cantOperacPorSector";
            cb = armarTablitaCantOperacPorSector;
        }else if (informe == 3) {
        	 url = caminoBackend+"admin/informes/empleados/operaciones";
            cb = armarTabla;
        }
    }else if(catInfo==2){
    	 cb = armarTabla;
    	 if (informe == 1) {
            url = caminoBackend+"admin/informes/productos/cantVentas";           
        } else if (informe == 2) {
            url = caminoBackend+"admin/informes/productos/tiempoEspera";          
        }else if (informe == 3) {
        	 url = caminoBackend+"admin/informes/productos/cancelaciones";           
        }
    }else if(catInfo==3){
    	 cb = armarTabla;
    	 if (informe == 1) {
            url = caminoBackend+"admin/informes/mesas/cantUsos";           
        } else if (informe == 2) {
            url = caminoBackend+"admin/informes/mesas/facturacion";          
        }else if (informe == 3) {
        	 url = caminoBackend+"admin/informes/mesas/facturaMayor";           
        }
    }

    $.ajax({
        url: url,
        datatype: "json",
        data: {
            "desde": $("#desde")[0].value,
            "hasta": $("#hasta")[0].value
        },
        headers: {
            token: localStorage[usuarioLogueado_ls]
        },
        success: cb
    })
}

function armarTablitaCantOperacPorSector(e) {
    html = "<thead><tr><th>Sector</th><th>Cant Operaciones</th></tr></thead><tbody>";
    try { informe = JSON.parse(e) } catch (e) { informe = e }
    var keys = Object.keys(informe);

    for (var i = 0; i < keys.length; i++) {
        html += "<tr><td>" + keys[i] + "</td><td>" + informe[keys[i]] + "</td></tr>"
    }
    $("#ulStats").html(html);
    console.log($("#table#ulStats").html())



        
                $('table#ulStats').DataTable({
                    retrieve: true,
                    "paging": false,
                    "searching": false,
                    "language": {
                        "url": "datatables/dataTablesEspanol.json"
                    }
                });
      

    


}

function armarTabla(e) {
    console.log(e)
    try { informe = JSON.parse(e) } catch (e) { informe = e }


    var keys = Object.keys(informe[0]);
    thead = "<thead><tr>"
    for (var i = 0; i < keys.length; i++) {
        thead += "<th>" + keys[i] + "</th>";
    }
    thead += "</tr></thead>"
    $("#ulStats").html(thead);

    $("#ulStats").append("<tbody>")
    for (var i = 0; i < informe.length; i++) {
        html = armarItem(informe[i])
        $("#ulStats").append(html)
    }
    $("#ulStats").append("</tbody>")




        
       $('table#ulStats').DataTable({
                    "retrieve": true,                  
                    "language": {
                        "url": "datatables/dataTablesEspanol.json"
                   }
               });
            
    
    

} //armar tabla logueos


function armarItem(it) {
    html = "<tr>"
    var keys = Object.keys(it);
    for (var i = 0; i < keys.length; i++) {
        html += "<td>" + it[keys[i]] + "</td>"
    }
    html += '</tr>'
    return html
}