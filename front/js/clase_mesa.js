console.log("clase_mesa.js")
class Mesa {

	static estadoMesas = ["verdeClaro", "amarillo", "naranja", "rojo", "amarillo", "violeta", "celeste"];
	static urlPNGsMesas="images/mesas/";

	static armarGraficoMesas() {
		
		$("#contenedorMesas").html("")

		console.log("armar grafico de mesas!")

		let zonaMax = 0;
		for (var i = 0; i < mesas.length; i++) {
			if (mesas[i].zona > zonaMax) zonaMax = mesas[i].zona
		}
		console.log("hay " + zonaMax + " zonas en el resto ")
		for (var q = 1; q <= zonaMax; q++) {
			$("#contenedorMesas").append("<div class='zonaMesas " + q + "' ><p class='nombreZonaMesas'>Zona " + q + "</p></div>")
		}

		for (var i = 0; i < mesas.length; i++) {
			//aca solo las deja en verde	
			$("div.zonaMesas." + mesas[i].zona).append("<div class='mesa " + mesas[i].id_mesa + "' onclick='verMesa(" + mesas[i].id_mesa + ")' ><img   class='mesaImg' src='"+Mesa.urlPNGsMesas + mesas[i].sillas + "/verdeClaro.png'><br> #" + mesas[i].id_mesa + "</div>");
		}


	}


	mesaId2i(id) {
		try { m = JSON.parse(localStorage["mesas_" + nombreDelSitio]) } catch (e) { m = localStorage["mesas_" + nombreDelSitio] }
		for (var i = 0; i < m.length; i++) {
			if (m[i].id == id) return i
		}
		return -1;
	}

}