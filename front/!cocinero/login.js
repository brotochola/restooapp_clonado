

$(document).ready(function() {
	console.log("doc ready login cocinerx");
	
	//listeners
	$("#botonLogin").click(login)

	//agrego cachos:
	agregarCachoABody("modalConfirmacion.html")
	agregarCachoABody("perfilesDePrueba.html")

});

function login(){
	console.log("boton login")
	if(!validateEmail($("#email").val())){
		 mostrarModalConfirmacion("Email invalido", "ok", null, null, null)
		 return;
	}
	$.ajax({
		url:caminoBackend+"cocinero/login?Asd=4",
		type:"get",
		data:{
			"user":$("#email").val(),
			"pass":$("#pass").val()
		},
		success:function(r){
			if(r==-1){	
				bootbox.alert("usuario/contraseña incorrecto/s", function(){});
			}else if(r==-2){
				bootbox.alert("usuario inhabilitado", function(){});
			}else if(r==-3){
				bootbox.alert("complete usuario y/ contraseña", function(){});
			}else if(r!=-1 && r!=-2){
					localStorage[usuarioLogueado_ls]=r;
				console.log(localStorage[usuarioLogueado_ls]);
				window.location.href="estado.html"; //home del admin
				
			}			
		}
	})
}



function funcLoadLogin(){
	console.log("token: ")
	console.log(localStorage[usuarioLogueado_ls]);
	console.log("dataDelUsuario: ")
	console.log(localStorage[dataDelUsuario_ls]);
	/*if(localStorage[usuarioLogueado_ls]!=null && localStorage[usuarioLogueado_ls]!=undefined && localStorage[usuarioLogueado_ls]!="" && localStorage[usuarioLogueado_ls]!="null" ){
		cargarPanel();
	}*/
}

function logout(){
	localStorage[usuarioLogueado_ls]="";
	localStorage[dataDelUsuario_ls]="";
	location.href="../front/";
}

