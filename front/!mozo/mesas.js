console.log("mesas.js")

const estadoMesas=["verdeClaro", "amarillo", "naranja", "rojo", "amarillo", "violeta", "celeste"];

function armarGraficoMesas(){
	try{m=JSON.parse(localStorage["mesas_"+nombreDelSitio])}catch(e){m=localStorage["mesas_"+nombreDelSitio]}
	$("#contenedorMesas").html("")

	//console.log("armar grafico de mesas!")

	zonaMax=0;
	for(var i=0; i<m.length;i++){
		if(m[i].zona>zonaMax)zonaMax=m[i].zona
	}
	console.log("hay "+zonaMax+ " zonas en el resto ")
	for(var q=1;q<=zonaMax;q++){
		$("#contenedorMesas").append("<div class='zonaMesas "+q+"' ><p class='nombreZonaMesas'>Zona "+q+"</p></div>")
	}

	for(var i=0; i<m.length;i++){		
		//aca solo las deja en verde	
		$("div.zonaMesas."+m[i].zona).append("<div class='mesa "+m[i].id+"' onclick='verMesa("+m[i].id+")' ><img   class='mesaImg' src='../mesas/"+m[i].sillas+"/verdeClaro.png'><br> #"+m[i].id+"</div>");
	}
	
	
}


function mesaId2i(id){
	try{m=JSON.parse(localStorage["mesas_"+nombreDelSitio])}catch(e){m=localStorage["mesas_"+nombreDelSitio]}
	for(var i=0;i<m.length;i++){
		if(m[i].id==id) return i
	}
	return -1;
}