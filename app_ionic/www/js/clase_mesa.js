console.log("clase_mesa.js")
var clickEnContenedorDragNDrop = false;
var currentX;
var currentY;
var initialX;
var initialY;
var xOffset = 0;
var yOffset = 0;
var dragItem;

class Mesa {

	static urlPNGsMesas="images/mesas/";
	static coloresMesas=["verdeClaro", "amarillo", "naranja", "rojo", "amarillo", "violeta", "celeste","rojo"];



	static armarGraficoMesas($div,cbOnClick) {
		
		$div.html("")

		//console.log("armar grafico de mesas!")

		let zonaMax = 0;
		for (var i = 0; i < api.mesas.length; i++) {
			if (api.mesas[i].zona > zonaMax) zonaMax = api.mesas[i].zona
		}
		console.log("hay " + zonaMax + " zonas en el resto ")
		for (var q = 1; q <= zonaMax; q++) {
			$div.append("<div class='zonaMesas " + q + "' ><p class='nombreZonaMesas'>Zona" + q + "</p></div>")
		}

		for (var i = 0; i < api.mesas.length; i++) {
			//aca solo las deja en verde	
			$div.find("div.zonaMesas." + api.mesas[i].zona).append("<div onpointerdown='Mesa.startDrag(this)' class='mesa " + api.mesas[i].id_mesa + "' onclick='"+cbOnClick+"(" + api.mesas[i].id_mesa + ")' ><img   class='mesaImg' src='"+Mesa.urlPNGsMesas + api.mesas[i].sillas + "/verdeClaro.png'><br> #" + api.mesas[i].id_mesa + "</div>");
		}


	}


	static mesaId2i(id) {
	
		for (var i = 0; i < api.mesas.length; i++) {
			if (api.mesas[i].id_mesa == id) return i
		}
		return -1;
	}


	static startDrag(el){
		//para elementos
		dragItem=el
	}

	 //cosas de dragndrop
	 static dragStart (e) {
        console.log("dragstart")
        if (e.type === "touchstart") {
            dragItem.setAttribute("initialX", e.touches[0].clientX - dragItem.getAttribute("xOffset"));
            dragItem.setAttribute("initialY", e.touches[0].clientY - dragItem.getAttribute("yOffset"));
        } else {
			dragItem.setAttribute("initialX",  e.clientX - dragItem.getAttribute("xOffset"));
            dragItem.setAttribute("initialY", e.clientY - dragItem.getAttribute("yOffset"));
        }

       // if (e.target === dragItem) {
            clickEnContenedorDragNDrop = true;
      //  }
    };

    static dragEnd  (e) {
        console.log("dragend")
		
		dragItem.setAttribute("initialX",dragItem.getAttribute("currentX"))
		dragItem.setAttribute("initialY",dragItem.getAttribute("currentY"))

		let num=dragItem.classList[1];
		api.mesas[num].x=Math.floor(dragItem.getAttribute("currentX"))
		api.mesas[num].y=Math.floor(dragItem.getAttribute("currentY"))

		dragItem=null;
		clickEnContenedorDragNDrop = false;
		
		localStorage["posMesas"]=JSON.stringify(api.mesas);
    };

	static posicionarMesas(cont){
		//NO TIENE Q SER CON LOCALSTORAGE, SINO EN LA DB
		try{
			let pM=JSON.parse(localStorage["posMesas"])


			//Mesa.mesaId2i(
			for(let i=0;i<pM.length;i++){
				let m=pM[i];
				//console.log(m)
				let cual=Mesa.mesaId2i(m.id_mesa)
				console.log(cual)
				api.mesas[cual].x=m.x
				api.mesas[cual].y=m.y
				//me fijo si hay posicion guardada para este.
				
				let obj=$(cont).find(".mesa."+cual)
			
				Mesa.setTranslate(m.x,m.y,obj);
			}
		}catch(e){console.log(e)}
	}


    static drag  (e) {
        if (clickEnContenedorDragNDrop) {

            e.preventDefault();

            if (e.type === "touchmove") {
				dragItem.setAttribute("currentX", e.touches[0].clientX -dragItem.getAttribute("initialX"));
                dragItem.setAttribute("currentY",e.touches[0].clientY -  dragItem.getAttribute("initialY"));
            } else {
                dragItem.setAttribute("currentX",e.clientX - dragItem.getAttribute("initialX"));
				dragItem.setAttribute("currentY", e.clientY - dragItem.getAttribute("initialY"));
            }

			dragItem.setAttribute("xOffset", dragItem.getAttribute("currentX"));
			dragItem.setAttribute("yOffset", dragItem.getAttribute("currentY"));
          //  console.log(dragItem.getAttribute("xOffset"),dragItem.getAttribute("yOffset"));
            Mesa.setTranslate(dragItem.getAttribute("currentX"), dragItem.getAttribute("currentY"), dragItem);
        }
    }

    static setTranslate  (xPos, yPos, el) {
       // console.log(el)
        let str="translate3d(" + Math.floor(xPos) + "px, " + Math.floor(yPos) + "px, 0)";
      //  console.log(str)
        $(el).css("transform", str)
        
    }
  
    static setearDragNDrop( container) {
      



        container.addEventListener("touchstart", Mesa.dragStart, false);
        container.addEventListener("touchend", Mesa.dragEnd, false);
        container.addEventListener("touchmove", Mesa.drag, false);

        container.addEventListener("mousedown", Mesa.dragStart, false);
        container.addEventListener("mouseup", Mesa.dragEnd, false);
        container.addEventListener("mousemove", Mesa.drag, false);


    }


}