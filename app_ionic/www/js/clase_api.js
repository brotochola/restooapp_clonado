console.log("clase_api.js")

class API {

    constructor() {

     


          if(window.hasOwnProperty("cordova"))  this.urlServer="http://pixeloide.com/restoApp/API/";
            else this.urlServer ="../../Resto/API/";
     
     
        // this.urlServer = "http://pixeloide.com/restoApp/API/"


      
        //ESTOS DATOS VIENEN DEL SERVER Y QUEDAN TODOS ACA:
        this.empleados = null;
        this.mesas = null;
        this.productos = null;
        this.estadoAnteriorMozo = null;
        this.estadoMozo = null;
        this.estadoCocinero = null;

    }

    guardarDataOneSignal(id_empleado, player_id, push_id){
        let data={
            "id_empleado":id_empleado,
            "player_id":player_id,
            "push_id":push_id
        }
        console.log(data);

        $.ajax({

            url: this.urlServer + "empleados/guardarDataOneSignal",
            type: "post",
            data: data, 
            success: (e) => {
                console.log(e)        
            }, error: e => console.log(e)
        })//ajax
    }

    indicarQSeLiberoUnaMesa(id_mesa, cb){
        $.ajax({
            type:"post",
            url: this.urlServer + "mesa/indicarQueLaMesaEstaLibre",
          /*  headers: {
                token: localStorage[usuarioLogueado_ls]
            },*/
            data: {
                "id_mesa": idMesa
            },
            success: (e) => {
                console.log(e)         

                if (cb instanceof Function) cb();
            }, error: e => console.log(e)
        })
    }




        cerrarMesa(id_mesa, cb){
            $.ajax({
                type:"post",
                url: this.urlServer + "mesa/cerrar",
              /*  headers: {
                    token: localStorage[usuarioLogueado_ls]
                },*/
                data: {
                    "id_mesa": idMesa
                },
                success: (e) => {
                    console.log(e)         
    
                    if (cb instanceof Function) cb();
                }, error: e => console.log(e)
            })
        }

    pedirCuentaMesa(id_mesa, cb){
        $.ajax({

            url: this.urlServer + "mesa/pedirCuenta",
            type: "post", //esto es solo porq estoy no usando un backend de verdad
            dataType: "json",
            data: {id_mesa:id_mesa},
         /*   headers: {
                token: localStorage[usuarioLogueado_ls]
            },*/
            success: (e) => {
                console.log(e)         

                if (cb instanceof Function) cb();
            }, error: e => console.log(e)
        })//ajax
    }

    habilitarMesa(data, cb) {

        $.ajax({

            url: this.urlServer + "mesas/habilitar",
            type: "post", //esto es solo porq estoy no usando un backend de verdad
            dataType: "json",
            data: data,
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            success: (e) => {
                console.log(e)
                this.estadoMozo = e;

                if (cb instanceof Function) cb();
            }, error: e => console.log(e)
        })//ajax
    }


        guardarRelevo(data,cb){
            $.ajax({
                url:api.urlServer+"empleados/relevo/cargar",
                data:dataAMandar,
                type:"post",
                success:(e)=>{
                    console.log(e);
                    if (cb instanceof Function) cb(e);
                },
                error:(e)=>console.log(e)

            });
        }

        metreAsignaMesaAReserva(id,cb){
            $.ajax({
                url:api.urlServer+"reservas/metreAsignaMesaAReserva",
                data:{id_reserva:id},
                type:"post",
                success:(e)=>{
                    console.log(e);
                    if (cb instanceof Function) cb(e);
                },
                error:(e)=>console.log(e)

            });
        }

    mozoMandaPedido(ped, cb) {
        let pedidoParaMandar = {}
        pedidoParaMandar.id_mesa = mesaActiva.id_mesa;
        pedidoParaMandar.id_cliente = mesaActiva.cliente.id_cliente
        pedidoParaMandar.id_cliente_visita = mesaActiva.clienteVisita.id_cliente_visita;
        pedidoParaMandar.productos = []
        pedidoParaMandar.cantidades = []
        //los paso al formato q requiere el backend:
        for (let i = 0; i < ped.productos.length; i++) {
            pedidoParaMandar.productos.push(ped.productos[i].id_producto)
            pedidoParaMandar.cantidades.push(ped.productos[i].cantidad)
        }
        app.mostrarLoading();
        $.ajax({
            url: this.urlServer + "mozo/agregarPedido",
            type: "post",
            dataType: "json",
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            data: pedidoParaMandar,
            success: function (e) {
                app.ocultarLoading();
                console.log(e)

                if (cb instanceof Function) cb(e);

            }, error: e => {  
                app.ocultarLoading();
                console.log(e)
            }
        })
    }


    cargarEstadoCocinero(cb) {


        console.log("cargar estado cocoinero")


        $.ajax({
            url: api.urlServer + "cocinero/estado",
            type: "post",
            dataType: "json",
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            success: function (e) {
                console.log(e);
                api.estadoCocinero = e
                if (cb instanceof Function) cb();
            }, error: consoleLogE
        });
    }

    cocineroInformaQuePedidoEstaListo(id, cb) {
        $.ajax({
            //url: "../../server/admin/productos/lista",
            url: this.urlServer + "cocinero/pedidoListo",
            type: "post", //esto es solo porq estoy no usando un backend de verdad
            dataType: "json",
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            data: {
                "id_rol":usuario.dataUsuario().id_rol,
                "id_pedido": id
            },
            success: (e) => {
                console.log(e)

                if (cb instanceof Function) cb();
            }, error: e => console.log(e)
        })
    }

    traerProductos(cb) {

        $.ajax({
            //url: "../../server/admin/productos/lista",
            url: this.urlServer + "producto/listado",
            type: "post", //esto es solo porq estoy no usando un backend de verdad
            dataType: "json",
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            success: (e) => {
                console.log(e)
                this.productos = e

                localStorage["productos_" + nombreDelSitio] = e;

                if (cb instanceof Function) cb();
            }, error: e => console.log(e)
        })
    }


    agregarProducto(producto, cb) {

        $.ajax({
            url: this.urlServer + "producto/cargar",
            type: "post",
            dataType: "json",
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            data: producto,
            success: (e) => {

                console.log(e)
                if (e != -1) {
                    this.productos = e;
                    if (cb instanceof Function) cb();

                } else {
                    mostrarModalConfirmacion("Error conectando con la Base de datos", "ok")

                }

            },
            error: function (e) {
                console.log(e)
            }
        })
    }


    modificarProducto(producto, cb) {

        $.ajax({
            url: this.urlServer + "producto/modifica",
            type: "get",
            dataType: "json",
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            data: producto,
            success: (e) => {

                console.log(e)
                if (e != -1) {
                    this.productos = e;
                    if (cb instanceof Function) cb();

                } else {
                    mostrarModalConfirmacion("Error conectando con la Base de datos", "ok")

                }

            },
            error: function (e) {
                console.log(e)
            }
        })
    }

    traerClientePorEmail(email, cb) {

        $.ajax({
            url: this.urlServer + "cliente/por-email/"+email,
            type: "get",
            dataType: "json",
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            success: (e) => {
                
                if (e != -1) {
                    
                    if (cb instanceof Function) cb(e);

                } else {
                    mostrarModalConfirmacion("Error conectando con la Base de datos", "ok")

                }

            },
            error: function (e) {
                console.log(e)
            }
        })
    }


    traerUnaMesa(id, cb) {

        $.ajax({
            url: this.urlServer + "mesas/id/" + id,
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            dataType: "json",
            success: function (e) {
                // console.log(e)
                let mesa = e
                // console.log(mesa)
                if (cb instanceof Function) cb(mesa);
            }, error: (e) => {
                console.log(e)
            }
        }); //ajax
    }

    traerMesas(cb) {
        $.ajax({
            url: this.urlServer + "mesas/lista",
            type: "post",
            dataType: "json",
           /* headers: {
                token: localStorage[usuarioLogueado_ls]
            },*/
            success: (e) => {
                this.mesas = e;
                localStorage["mesas_" + nombreDelSitio] = JSON.stringify(e);
                if (cb instanceof Function) cb(e);
            }, error:(e)=>console.log(e)
        })
    }

    traerEmpleados(cb) {

        $.ajax({

            url: this.urlServer + "empleados/listar",
            type: "post",
            dataType: "json",

            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            success: (e) => {
                this.empleados = e

                localStorage["empleados_" + nombreDelSitio] = JSON.stringify(e);
                if (cb instanceof Function) cb(e);
            }
        })




    }//traerEmpleados


    agregarEmpleado(cb, emple) {

        console.log("agregarEmpleado api")

        $.ajax({
            type: "post",
            dataType: "json",
            url: api.urlServer + "empleados/alta",
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            data: emple,
            success: (e) => {
                console.log(e)
                if (e != -1) {
                    this.empleados = e
                    localStorage["empleados_" + nombreDelSitio] = JSON.stringify(e);
                    if (cb instanceof Function) cb(e);

                } else {
                    mostrarModalConfirmacion("Error conectando con la Base de datos", "ok")

                }

            }, error: (e) => {
                console.log(e)
            }
        })
    }

    borrarEmpleado(cb, id) {
        $.ajax({
            // url:"../../server/admin/empleados/modificar",
            url: this.urlServer + "empleados/borrar",
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            type: "post",
            dataType: "json",
            data: { id: id },
            success: (e) => {
                console.log(e)
                this.empleados = e
                if (cb instanceof Function) cb(e);
            }, error: (e) => {
                console.log(e)
            }
        });
    }

    modificarEmpleado(cb, emple) {
        $.ajax({
            // url:"../../server/admin/empleados/modificar",
            url: this.urlServer + "empleados/modificar",
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            type: "post",
            dataType: "json",
            data: emple,
            success: (e) => {
                console.log(e)
                if (e != -1) {
                    this.empleados = e
                    localStorage["empleados_" + nombreDelSitio] = JSON.stringify(e);


                } else {
                    mostrarModalConfirmacion("Error conectando con la Base de datos", "ok")

                }
                if (cb instanceof Function) cb(e);
            },
            error: (e) => {
                console.log(e)
            }
        }) //ajx

    }

    cargarEstadoAdmin(cb) {
        $.ajax({
            url: this.urlServer + "admin/estado",
            type: "post",
            headers: {
                token: localStorage[dataDelUsuario_ls]
            },
            success: (e) => {
                // console.log(e)
                this.estadoAdmin = e;
                if (cb instanceof Function) cb(e);
            },
            error: (e) => {
                console.log(e)
            }
        })
    }//cargarEstadoAdmin

    cargarEstadoMozo(cb) {
        $.ajax({
            url: this.urlServer + "mozo/estado",
            dataType: "json",
            type: "post",
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            success: (e) => {
                this.estadoAnteriorMozo = this.estadoMozo;
                this.estadoMozo = e;
                if (cb instanceof Function) cb(e);
            },
            error: (e) => {
                console.log(e.responseText)
            }
        })
    }//estdo mozo

    cargarPedidosMozo(cb) {
        $.ajax({
            url: this.urlServer + "mozo/traerMisPedidos",
            type: "post",
            dataType: "json",
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            success: (e) => {
                console.log(e)
                this.pedidosAnteriorMozo = this.pedidosMozo;
                this.pedidosMozo = e;
                if (cb instanceof Function) cb(e);
            },
            error: (e) => {
                console.log(e.responseText)
            }
        })
    }//estdo mozo


    logueo(mail, clave, cb) {
        console.log("Clase api: " + mail, clave, "server: " + this.urlServer)
        $.ajax({
            url: this.urlServer + "login/",
            type: "post",
            dataType: "json",
            data: {
                "email": mail,
                "clave": clave
            },
            success: (e) => {
                if (cb instanceof Function) cb(e);
            }, error: e => console.log(e)
        })
    }



    modificarMesa(m, cb) {
        $.ajax({
            url: this.urlServer + "mesa/modificar",
            type: "post",
            data: {
                "mesa": JSON.stringify(m)
            },
            dataType: "json",
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            success: (e) => {
                if (cb instanceof Function) cb(e)
            }
        })


    }

    agregarMesa(m, cb) {
        $.ajax({
            url: this.urlServer + "mesa/alta",
            type: "post",
            data: {
                "mesa": JSON.stringify(m)
            },
            dataType: "json",
            headers: {
                token: localStorage[usuarioLogueado_ls]
            },
            success: function (e) {
                this.mesas = e
                localStorage["mesas_" + nombreDelSitio] = e;
                Mesa.armarGraficoMesas($("#contMesasAdmin"), "verMesaAdmin")
                ocultarAgregarVerMesa();
            }

        })
    }

}