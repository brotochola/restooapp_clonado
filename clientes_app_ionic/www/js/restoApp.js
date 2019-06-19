console.log("restoApp.js")

var cliente = new Cliente();
var app;
var api;

/*
function terminoVideoSplash() {
    videoSplashTermino = 1

    if(navigator.onLine==false){
        bootbox.alert("No tenés conexión a internet. ClubMataderos no funciona sin internet");
         navigator.app.exitApp();
        return;
    }

    arrancar();
}*/

$(document).ready(function () {
    //traerHTML(url, append, forzarNoCache, id, traerloOculto) {
    // document.getElementById("videoSplash").playbackRate = 10;
    console.log("doc ready restoApp.js")
    arrancar();
})

function arrancar() {
    api = new API()
    app = new App("restoApp");

    //traigo partes q uso despues, ocultas.
    app.init()
}

function funcDeviceReady() {
    console.log("device ready!")
}

document.addEventListener("deviceready", funcDeviceReady, false);