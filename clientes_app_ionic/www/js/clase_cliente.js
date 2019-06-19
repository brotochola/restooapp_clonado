console.log("clase_cliente.js")
const nombreDelSitio = "Resto UTN-C";
const clienteLogueado_ls = "token" + nombreDelSitio;
const dataDelCliente_ls = "dataDelCliente_" + nombreDelSitio;

class Cliente {
    constructor(token) {
        if (token != undefined) {
            if (Cliente.chequearValidezToken(token)) {
                this.token = localStorage[clienteLogueado_ls] = token;
            } else {
                alert("El token q le metes al cliente no es valido");
            }
        } else { //si no le entra token al constructor
            if (localStorage.hasOwnProperty(clienteLogueado_ls)) {
                //si hay token en el localstorage
                if (Cliente.chequearValidezToken(localStorage[clienteLogueado_ls])) {
                    //si el token del localstorage esta ok
                    this.token = localStorage[clienteLogueado_ls]
                    this.data = this.dataCliente();
                } else {
                    //si el token del localstorage no es valido y ademas no le entra token al construcotr...
                    this.token = localStorage[clienteLogueado_ls] = "";
                }
            }
        }
    }//end constructor

    tokenValido() {
        return Cliente.chequearValidezToken(this.token)
    }

    logout() {
        // app.retraerMenuLateral();
        localStorage[clienteLogueado_ls] = "";
        cliente.data = {};
        cliente.token = "";
        app.traerHTML("partes/login.html");
        //app.ocultarFooterAdmin();
        //app.ocultarFooterMozo();
        //  app.inicioSesion()s
        //  app.ocultarFooterComercio()
        //  app.esconderFooter();
    }

    dataCliente() {
        // console.log(parseJwt(this.token))
        if (this.token != "") return parseJwt(this.token).data
        else return {}
    }

    meterleToken(token) {
        this.token = token || "";
        localStorage[clienteLogueado_ls] = this.token;
        this.data = this.dataCliente();
    }

    static chequearValidezToken(token) {
        if (!checkStr(token)) return false;
        let data = parseJwt(token);
        if (data.data == undefined) return false;

        let fech = new Date(data.exp);
        if ((fech * 1000) < Date.now()) {
            return false;
        } else {
            return true;
        }
    }
}