console.log("restoApp.js")

var usuario = new Usuario()
var app;
var api 



/*
function terminoVideoSplash() {
    videoSplashTermino = 1

    if(navigator.onLine==false){
        bootbox.alert("No tenés conexión a internet. ClubMataderos no funciona sin internet");
         navigator.app.exitApp();
        return;
    }


    arrancar()

    

}*/

$(document).ready(function() {
      //traerHTML(url, append, forzarNoCache, id, traerloOculto) {
 // document.getElementById("videoSplash").playbackRate = 10;
    console.log("doc ready restoApp.js")
    arrancar();
    
})




function arrancar() {
    
   
 
    api= new API()
    app = new App("restoApp");

       //traigo partes q uso despues, ocultas.
         app.init()
}






var notificationOpenedCallback = function(jsonData) {
    console.log('notificationOpenedCallback: ' + JSON.stringify(jsonData));
  };

function funcDeviceReady(){
console.log("device ready!")
document.addEventListener('deviceready', function () {
  // Enable to debug issues.
  // window.plugins.OneSignal.setLogLevel({logLevel: 4, visualLevel: 4});
  


  window.plugins.OneSignal
    .startInit("549189c2-0a0f-4ee6-8053-e5063d08f206")
    .handleNotificationOpened(notificationOpenedCallback)
    .endInit();
}, false);


}

document.addEventListener("deviceready", funcDeviceReady, false);

