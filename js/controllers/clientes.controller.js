// --------------------------------
// por defecto cuando arranca la pagina
// fuerza la busqueda de clientes
// --------------------------------
document.onreadystatechange = () => 
{ 
    if (document.readyState === 'complete') { 
        buscarClientes(); 

        initSetup();
    }
}

/* -------------------------------------------
 Seteos iniciales de la pagina
 -------------------------------------------
*/
function initSetup(){

    // --------------------------------
    // Variables para acceder al DOM
    // --------------------------------
    if (document.getElementById("form-cliente")){
        agregarEventListener( document.getElementById("form-clliente"));
    }

    // -------------------------------------------
    // Accion al 'Enviar' en Consulta de Clientes
    // -------------------------------------------
    document.getElementById("buscar").addEventListener("click", function(event) { event.preventDefault() });
    document.getElementById("buscar").addEventListener("click", buscarClientes );
    // document.getElementById("btn_vesclose").addEventListener("click", cerrarVencimiento);

    // -------------------------------------------
    // Accion al 'Confirmar' de la pantalla de cliente 
    // -------------------------------------------
    if (document.getElementById("btn_confirmar")){
        document.getElementById("btn_confirmar").addEventListener("click", confirmar);
    }

    // // Eventos de la tabla de clientes - Iconos de acciones
    // const objTablaMov = document.getElementById("tabla-clientes");
    // objTablaMov.addEventListener("click", (event) => {
    //     if (event.target.classList.contains("accion.clientes.ver")) {
    //         clientes_view( event.target.id );
    //     }
    //     if (event.target.classList.contains("accion.clientes.editar")) {
    //         clientes_edit( event.target.id );
    //     }
    //     if (event.target.classList.contains("accion.clientes.eliminar")) {
    //         clientes_delete( event.target.id );
    //     }
    // });
}

// ----------------------------------------------------------------
// Rutina para buscar los movimientos solicitados
// ----------------------------------------------------------------
async function buscarClientes(){
 
    var objdesde = document.getElementById("desde");
    var objhasta = document.getElementById("hasta");
    var objnombre = document.getElementById("nombre");
    var objbotonbuscar = document.getElementById("buscar");
    
    var desde = objdesde.value;
    var hasta = objhasta.value;
    var nombre = objnombre.value;
    var jsonvars

    // Divs
    var divClientes = document.getElementById("tabla-clientes");

    // apagar el boton buscar
    objbotonbuscar.innerText = "Buscando...";
    objbotonbuscar.disabled = true;

    // preparar parametros pedidos
    jsonvars = {}
    jsonvars["desde"] = desde;
    jsonvars["hasta"] = hasta;
    jsonvars["nombre"] = nombre;

    // --------------------------------
    // Limpiar el o los divs
    // --------------------------------
    divClientes.innerHTML = "";

    // Preparar la clase de vencimientos
    const clientes = new cClientes();

    // mandar a buscar los movimientos de la categoria
    const data = await clientes.LoadAllHtml2( jsonvars );

    // Si esta ok, pasarlo a la pagina
    if (data){
        divClientes.innerHTML = data;
    } 

    // activar el boton buscar
    objbotonbuscar.disabled = false;
    objbotonbuscar.innerText = "Buscar";
}
