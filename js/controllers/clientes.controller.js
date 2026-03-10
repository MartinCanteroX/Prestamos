// --------------------------------
// por defecto cuando arranca la pagina
// fuerza la busqueda de clientes
// --------------------------------
document.onreadystatechange = () => 
{ 
    if (document.readyState === 'complete') { 
        clientes_buscar(); 

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
    document.getElementById("buscar").addEventListener("click", clientes_buscar );

    // -------------------------------------------
    // Accion con Nuevo Cliente
    // -------------------------------------------
    document.getElementById("btn_nuevo").addEventListener("click", function(event) { event.preventDefault() });
    document.getElementById("btn_nuevo").addEventListener("click", clientes_nuevo );

    // Accion al 'Confirmar' de la pantalla de cliente 
    // -------------------------------------------
    if (document.getElementById("btn_confirmar")){
        document.getElementById("btn_confirmar").addEventListener("click", clientes_confirmar);
    }
    // Accion al 'Cerrar' de la pantalla de cliente 
    // -------------------------------------------
    if (document.getElementById("btn_cerrar")){
        document.getElementById("btn_cerrar").addEventListener("click", clientes_cerrar);
    }


}

// ----------------------------------------------------------------
// Rutina para buscar los movimientos solicitados
// ----------------------------------------------------------------
async function clientes_buscar(){
 
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
    const data = await clientes.LoadAllHtml( jsonvars );

    // Si esta ok, pasarlo a la pagina
    if (data){
        divClientes.innerHTML = data;
    } 

    // activar el boton buscar
    objbotonbuscar.disabled = false;
    objbotonbuscar.innerText = "Buscar";
}

// ----------------------------------------------------------------
// Nuevo Cliente
// ----------------------------------------------------------------
async function clientes_nuevo( id ){
    // const objDiv = document.getElementById("cliente-edicion");
    // const objID = document.getElementById("id");
    // const objnombre = document.getElementById("nombre");
    // const objtitulo = document.getElementById("titulo");

    // try{
    //     objtitulo.innerHTML = "Nuevo Cliente";

    //     // Agregar la captura de eventos al form de edicion
    //     agregarEventListener(objDiv);

    //     // Mostrar el form
    //     objDiv.style.display = "block";
        
    // }catch(error){
    //     console.log( "Cliente/Nuevo: Error : ", error);
    // }

    // Redireccionar a un nuevo cliente
    const link = BASE_URL + "clientes/new" ;
    PaginaIr(link);
}

// ----------------------------------------------------------------
// Cerrar Cliente
// ----------------------------------------------------------------
function clientes_cerrar( ){
    const objDiv = document.getElementById("cliente-edicion");

    try{
        // Ocultar el form
        objDiv.style.display = " none";
        
    }catch(error){
        console.log( "Cliente/Cerrar: Error : ", error);
    }
}

// ----------------------------------------------------------------
// Confirmar la edicion de un Cliente
// ----------------------------------------------------------------
async function clientes_confirmar( id ){
    const objDiv = document.getElementById("cliente-edicion");
    const objID = document.getElementById("id");
    const objNombre = document.getElementById("nombre");
    const botonConfirmar = document.getElementById("btn_confirmar");

    // cargar todos los inputs/select del formulario
    const inputs = objDiv.querySelectorAll("input,select");

    try{

        // -------------------------
        // Validaciones
        // -------------------------
        // avisar 'validando'
        EnviarCaption = botonConfirmar.innerHTML 
        botonConfirmar.innerHTML = "Validando...";

        // validar todos los inputs
        resultado = validarTodosLosInputs( inputs );

        // restaurar el texto del boton....
        botonConfirmar.innerHTML = EnviarCaption;

        // si hubo error ....
        if ( ! resultado ){
            avisoError( "Cliente  - Hay campos que no estan correctamente ingresados !");
            return;
        }

        // -------------------------
        // Confirmar el cliente
        // -------------------------
        // Objetos Vencimiento
        botonConfirmar.innerHTML = "Cargando...";
        id = objID.value;
        let cliente = new cClientes();
        
        // Cargar los datos,, si es una edicion
        if ( id != 0) {
            await cliente.load( id )
        }

        // actualizar los datos del cliente ( por si los actualizo )
        cliente.nombre = objNombre.value;

        // avisar 'grabando'
        botonConfirmar.innerHTML = "Grabando...";

        // confirmar
        
        res = await cliente.save()
        
        botonConfirmar.innerHTML = "Listo!";

        // Cerrar el modal
        clientes_cerrar();

        avisoOk("Se ha confirmado el cliente");

        // forzar la relectura 
        buscarVencimientos();

    }catch (error){
        console.log("Error al grabar la confirmar el vencimiento :", error);
    }
}
