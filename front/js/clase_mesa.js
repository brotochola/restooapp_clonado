console.log("clase_mesa.js")
class Mesa {

	static estadoMesas = ["verdeClaro", "amarillo", "naranja", "rojo", "amarillo", "violeta", "celeste"];
	static urlPNGsMesas="images/mesas/";


	static armarGraficoMesas() {
		
		$("#contenedorMesas").html("")

		console.log("armar grafico de mesas!")

		let zonaMax = 0;
		for (var i = 0; i < api.mesas.length; i++) {
			if (api.mesas[i].zona > zonaMax) zonaMax = api.mesas[i].zona
		}
		console.log("hay " + zonaMax + " zonas en el resto ")
		for (var q = 1; q <= zonaMax; q++) {
			$("#contenedorMesas").append("<div class='zonaMesas " + q + "' ><p class='nombreZonaMesas'>Zona " + q + "</p></div>")
		}

		for (var i = 0; i < api.mesas.length; i++) {
			//aca solo las deja en verde	
			$("div.zonaMesas." + api.mesas[i].zona).append("<div class='mesa " + api.mesas[i].id_mesa + "' onclick='verMesa(" + api.mesas[i].id_mesa + ")' ><img   class='mesaImg' src='"+Mesa.urlPNGsMesas + api.mesas[i].sillas + "/verdeClaro.png'><br> #" + api.mesas[i].id_mesa + "</div>");
		}


	}


	mesaId2i(id) {
	
		for (var i = 0; i < api.mesas.length; i++) {
			if (api.mesas[i].id_mesa == id) return i
		}
		return -1;
	}

}