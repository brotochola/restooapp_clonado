console.log("facturacion.js")


$(document).ready(function() {

    agregarCachoABody("footerAdmin.html", function() {
        $($(".botonFooterAdmin")[3]).addClass("active") //en la pantalla de estado, empieza activo el boton de estado
    })


    //listeners

    $("#desde, #hasta").change(actualizarTabla);



    actualizarTabla();


});
var informe;


function actualizarTabla() {
    console.log("actualizar tabla estadistcas!")

	$("#contTablaEstadisticas").html("")
    $("#contTablaEstadisticas").append('<table class="contenedor-listados-pedidos" id="ulStats"></table>')



    $.ajax({
        url: "../../server/admin/informes/facturacion",
        datatype: "json",
        data: {
            "desde": $("#desde")[0].value,
            "hasta": $("#hasta")[0].value
        },
        headers: {
            token: localStorage[usuarioLogueado_ls]
        },
        success: armarTabla
    })
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