console.log("mesas_pag.js")

var delayTraerEstado=5000;
var estadoActual={};
var mesas;
var mesasCargadas=0;
var docReady=0;

$.ajax({
	url:caminoBackend+"mesas/lista",
	dataType:"json",
	type:"post",//esto es solo porq estoy no usando un backend de verdad
	headers:{
		token:localStorage[usuarioLogueado_ls]
	},
	success:function(e){
		console.log(e)
		mesas=e
	
		localStorage["mesas_"+nombreDelSitio]=JSON.stringify(e)
		mesasCargadas=1;
		if(docReady==1) armarGraficoMesas();
	}
})




$(document).ready(function() {
	docReady=1;
	if(mesasCargadas==1) armarGraficoMesas();
	console.log("doc ready mesas admin");



	
	//listeners
	

	//agrego cachos:
	agregarCachoABody("agregarVerMesa.html")
	//agregarCachoABody("modalConfirmacion.html")
	agregarCachoABody("footerAdmin.html",function(){
			$($(".botonFooterAdmin")[2]).addClass("active") //en la pantalla de estado, empieza activo el boton de estado
	})


});

function verMesa(id){
	i=mesaId2i(id);
	mostrarAgregarVerMesa(id, mesas[i].sillas, mesas[i].zona)
}
