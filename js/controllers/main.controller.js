// --------------------------------
// por defecto cuando arranca la pagina
// fuerza la busqueda de movimientos
// --------------------------------
document.onreadystatechange = () => 
{ 
    if (document.readyState === 'complete') { 
        mostrarMainData(); 
    }
};

// -------------------------------------------
// Accion al 'Enviar'
// -------------------------------------------
document.getElementById("btn_vesclose").addEventListener("click", cerrarVes);
document.getElementById("btn_egrclose").addEventListener("click", cerrarEgr);
document.getElementById("cas-btn_confirmar").addEventListener("click", cuentas_grabarcas);
document.getElementById("cas-btn_close").addEventListener("click", cuentas_cerrarcas);
// document.getElementById("btn_confirmarVes").addEventListener("click", vencimiento_editsimple_confirmar);

// ----------------------------------------------------------------
// Buscar y mostrar los proximos vencimientos
// ----------------------------------------------------------------
/*
     Recuperar y mostrar los proximos vencimientos
*/
async function mostrarProxVtos(){

    // Divs
    var divProxVtos = document.getElementById("tabla-prox-vencimientos");
    divProxVtos.innerHTML = "";
    
    // --------------------------------
    // mandar a buscar proximos vencimientos
    // --------------------------------
    try{
        const Vencimientos = new cVencimientos();
        const data = await Vencimientos.LoadProximosMain();
        divProxVtos.innerHTML = data;
    }catch(error){
        avisoError("Vencimientos - No se puede recuperar los proximos");
    }
}

// ----------------------------------------------------------------
// buscar y mostrar los saldos de las cuentas
// ----------------------------------------------------------------
async function mostrarSaldosCuentas(){
    var divSaldos = document.getElementById("tabla-saldo-cuentas");
    divSaldos.innerHTML = "";

    try{
        const Cuentas = new cCuentas();
        const data = await Cuentas.LoadAllSaldosHtml();
        divSaldos.innerHTML = data;

    }catch(error){
        avisoError("Cuentas - No se pueden recuperar los saldos");
    }

}

// ----------------------------------------------------------------
// buscar y mostrar los ultimos movimientos
// ----------------------------------------------------------------
async function mostrarUltMovs(){
    var divUltMovs = document.getElementById("tabla-ultimos-movs")
    divUltMovs.innerHTML = "";

    try{
        const Movimientos = new cMovimientos();
        const data = await Movimientos.LoadProximosMain();
        divUltMovs.innerHTML = data;

    }catch(error){
        avisoError( "Movimientos - No se los puede recuperar por los ultimos !");    
    }
}

// ----------------------------------------------------------------
// buscar y mostrar los ultimos movimientos
// ----------------------------------------------------------------
async function mostrarVtosDiaVencidos(){
    var divNotifCant = document.getElementById("main-notif-cant-icono")
    
    try{
        // vaciar el contenido actual
        divNotifCant.innerHTML = "";

        // ubicar la cantidad de vencimientos
        const vencimientos = new cVencimientos();
        const cantidad = await vencimientos.getCantidadHoy();

        if (cantidad == 0){
            return;
        }

        // Actuualizar la cantidad
        divNotifCant.innerHTML = cantidad;

    }catch(error){
        avisoError( "Vencimientos - No se los puede recuperar por los ultimos !");    
    }
}

// ----------------------------------------------------------------
// Rutina para buscar los movimientos agrupados por fecha
// ----------------------------------------------------------------
async function mostrarVtosPorFecha(){
    var divVtosFecha = document.getElementById("tabla-vtos-fecha");
    divVtosFecha.innerHTML = "";

    try{
        const Vencimientos = new cVencimientos();
        const data = await Vencimientos.LoadResFechaMain();
        divVtosFecha.innerHTML = data;
    }catch(error){
        avisoError("Vencimientos - No se puede recuperar el resumen por Fecha");
    }
}

// ----------------------------------------------------------------
// Rutina para buscar movimientos agrupados por cuenta
// ----------------------------------------------------------------
async function mostrarVtosPorCuenta(){
    var divVtosCuenta = document.getElementById("tabla-vtos-cuenta");
    divVtosCuenta.innerHTML = "";

    try{

        const Vencimientos = new cVencimientos();
        const data = await Vencimientos.LoadResCuentaMain();
        divVtosCuenta.innerHTML = data;

    }catch(error){
        avisoError("Vencimientos - No se puede recuperar el resumen por cuenta");
    }

}

// ----------------------------------------------------------------
// Rutina para buscar los movimientos solicitados
// ----------------------------------------------------------------
async function mostrarMainData(){
    
    // --------------------------------
    // mandar a buscar proximos vencimientos
    // --------------------------------
    await mostrarProxVtos();

    // --------------------------------
    // mandar a buscar ultimos movimientos
    // --------------------------------
    await mostrarUltMovs();
    
    // --------------------------------
    // mandar a buscar saldos de cuentas
    // --------------------------------
    await mostrarSaldosCuentas();

    // --------------------------------
    // Buscar Vencimientos por fecha
    // --------------------------------
    await mostrarVtosPorFecha();

    // --------------------------------
    // Buscar Vencimientos por Cuenta
    // --------------------------------
    await mostrarVtosPorCuenta();

    // --------------------------------
    // Buscar Vencimientos del dia o vencidos
    // --------------------------------
    await mostrarVtosDiaVencidos();



}

// =========================================
// Eliminar un proximo vencimiento
// =========================================
function eliminarProxVto( id ){
    // let link = BASE_URL + "vencimientos/delete/" + id;

    // // jsonvars = {}
    // // jsonvars["id"] = id;
    // $.ajax({
    //     // type: 'GET',
    //     url: link,
    //     // data: jsonvars,
    //     success: function(){
    //         mostrarProxVtos();
    //     }
    // });
    alert("Opcion no implementada");
}

// =========================================
// Rutina para buscar los movimientos solicitados
// ----------------------------------------------------------------
async function movimientos_eliminar( id ){
 
    if ( ! id ){
        return;
    }

    // confirmar
    if (confirm("Esta seguro de eliminar el movimiento ?") == false ){
        return;
    }

    try{
        // Recuperar los datos del movimiento
        let movimiento = new cMovimiento();
        await movimiento.load(id);

        // eliminar
        await movimiento.delete(id);
        
        // Avisar
        avisoOk("Se ha eliminado el movimiento");

        // actualizar los ultimos movimientos
        mostrarUltMovs();

    }catch(error){
        console.log("Error al eliminar el movimiento :", error);
    }
}

// ----------------------------------------------------------------
// Mostrar el vencimiento simple 
// ----------------------------------------------------------------
async function vencimiento_simple_mostrar( id ){
    const objDivVtoEditSimple = document.getElementById("vencimientos-edicion-simple");
    const objID = document.getElementById("id");
    const objFecha = document.getElementById("fecha");
    const objImporte = document.getElementById("importe");
    const objCuenta = document.getElementById("decuenta");
    const objACuenta = document.getElementById("acuenta");
    const objdivACuenta = document.getElementById("div_acuenta");
    const objtitulo = document.getElementById("ves-titulo");

    // Objetos Vencimiento
    const vencimiento = new cVencimiento( id );
    const cuentas = new cCuentas();

    try{
        // Cargar los datos
        await vencimiento.load(id)
        
        // actualizar los datos en pantalla
        objFecha.value = vencimiento.fecha;
        objImporte.value = vencimiento.importe;
        objCuenta.value = vencimiento.cuentaid;
        objID.value = id;
        if ( vencimiento.tipo != "T"){
            objdivACuenta.style.display = "none";
        }
        objtitulo.innerHTML = vencimiento.nombre;

        // recuperar la lista cuentas
        const ctaslista = await cuentas.loadAll();
        
        // generar la lista de cuentas desde

            // generar el html de las cuentas
        getHtmlParaSelect( objCuenta, ctaslista, vencimiento.cuentaid )
            
        if (vencimiento.tipo == 'T'){
            // generar la lista de cuentas hasta
            getHtmlParaSelect( objACuenta, ctaslista, vencimiento.acuentaid )
        }

        // Agregar la captura de eventos al form de edicion
        agregarEventListener(objDivVtoEditSimple);

        // Mostrar el form
        objDivVtoEditSimple.style.display = "block";
        
    }catch(error){
        console.log( "vencimiento_simple_ostrar: Error : ", error);
    }
}

// ----------------------------------------------------------------
// Edicion simple de vencimiento
// ----------------------------------------------------------------
function vencimiento_editsimple( id ){
    
    // Mostrar los datos del vencimieto
    vencimiento_simple_mostrar( id );
    
    // Titulo
    const titulo = document.getElementById("titulo");
    titulo.innerHTML = "Editar Vencimiento";
    
    // Direccionar el Click de aceptar 
    document.getElementById("btn_confirmarVes").addEventListener("click", vencimiento_editsimple_save);
}

// ----------------------------------------------------------------
// Edicion simple de vencimiento - Confirmar
// Graba los datos ingresados
// ----------------------------------------------------------------
async function vencimiento_editsimple_save( id ){
    const objDivVtoEditSimple = document.getElementById("vencimientos-edicion-simple");
    const objID = document.getElementById("id");
    const objFecha = document.getElementById("fecha");
    const objImporte = document.getElementById("importe");
    const objCuenta = document.getElementById("decuenta");
    const objACuenta = document.getElementById("acuenta");
    const botonEnviar = document.getElementById("btn_confirmarVes");
    let cant_mal, ret, resultado;

    // -------------------------
    // Validaciones
    // -------------------------
    // cargar todos los inputs/select del formulario
    const inputs = objDivVtoEditSimple.querySelectorAll("input,select");

    try {
        // avisar 'validando'
        EnviarCaption = botonEnviar.innerHTML 
        botonEnviar.innerHTML = "Validando...";

        // validar todos los inputs
        resultado = validarTodosLosInputs( inputs );

        // restaurar el texto del boton....
        botonEnviar.innerHTML = EnviarCaption;

        // si hubo error ....
        if ( ! resultado ){
            avisoError( "Vencimiento - Hay campos que no estan correctamente ingresados !");
            return;
        }
        
        // -------------------------
        // Confirmar el vencimiento
        // -------------------------
        // Objetos Vencimiento
        botonEnviar.innerHTML = "Cargando...";
        id = objID.value;
        let vencimiento = new cVencimiento();
        
        // Cargar los datos
        await vencimiento.load(id);
        
        // actualizar los datos del vencimiento ( por si los actualizo )
        vencimiento.fecha = objFecha.value;
        vencimiento.importe = objImporte.value;
        vencimiento.cuentaid = objCuenta.value;
        if (vencimiento.tipo == "T"){
            vencimiento.acuentaid = objACuenta.value;
        }

        // avisar 'grabando'
        botonEnviar.innerHTML = "Grabando...";

        // Grabar
        await vencimiento.save();

        // avisar 'grabando'
        botonEnviar.innerHTML = "Listo!";
        
        // Cerrar el modal
        cerrarVes();

        avisoOk("Se ha actualizado el vencimiento");

        // forzar la relectura de los vencimientos
        mostrarProxVtos();

    } catch( error ) {
        avisoError("No se puede actualizar el vencimiento: ", error);
        cerrarVes();
    }
}

// ----------------------------------------------------------------
// Edicion simple de vencimiento - Confirmar
// Graba los datos ingresados
// ----------------------------------------------------------------
function vencimiento_confirmar( id ){
    
    // mostrar los datos del vencimiento
    vencimiento_simple_mostrar( id );
    
    // Titulo
    const titulo = document.getElementById("titulo");
    titulo.innerHTML = "Confirmar Vencimiento";

    // Direccionar el Click de aceptar 
    document.getElementById("btn_confirmarVes").addEventListener("click", vencimiento_confirmar_save);
    
}

// ----------------------------------------------------------------
// Vencimiento - Confirmar - Save
// ----------------------------------------------------------------
async function vencimiento_confirmar_save( id ){
    const objDivVtoEditSimple = document.getElementById("vencimientos-edicion-simple");
    const objID = document.getElementById("id");
    const objFecha = document.getElementById("fecha");
    const objImporte = document.getElementById("importe");
    const objCuenta = document.getElementById("decuenta");
    const objACuenta = document.getElementById("acuenta");
    const botonEnviar = document.getElementById("btn_confirmarVes");

    // -------------------------
    // Validaciones
    // -------------------------
    // cargar todos los inputs/select del formulario
    const inputs = objDivVtoEditSimple.querySelectorAll("input,select");

    try {
        // avisar 'validando'
        EnviarCaption = botonEnviar.innerHTML 
        botonEnviar.innerHTML = "Validando...";

        // validar todos los inputs
        resultado = validarTodosLosInputs( inputs );

        // restaurar el texto del boton....
        botonEnviar.innerHTML = EnviarCaption;

        // si hubo error ....
        if ( ! resultado ){
            avisoError( "Vencimiento - Hay campos que no estan correctamente ingresados !");
            return;
        }
        
        // -------------------------
        // Confirmar el vencimiento
        // -------------------------
        // Objetos Vencimiento
        botonEnviar.innerHTML = "Cargando...";
        id = objID.value;
        let vencimiento = new cVencimiento();
        
        // Cargar los datos
        // console.log("Cargar vencimiento...")
        await vencimiento.load( id )

        // actualizar los datos del vencimiento ( por si los actualizo )
        vencimiento.fecha = objFecha.value;
        vencimiento.importe = objImporte.value;
        vencimiento.cuentaid = objCuenta.value;
        if (vencimiento.tipo == "T"){
            vencimiento.acuentaid = objACuenta.value;
        }

        // avisar 'grabando'
        botonEnviar.innerHTML = "Grabando...";

        // confirmar
        res = await vencimiento.confirmar()
        
        botonEnviar.innerHTML = "Listo!";

        // Cerrar el modal
        cerrarVes();

        avisoOk("Se ha confirmado el vencimiento");

        // forzar la relectura 
        mostrarMainData();
    }catch (error){
        console.log("Error al grabar la confirmar el vencimiento :", error);
    }
}

// ----------------------------------------------------------------
// Eliminacion del vencimiento
// ----------------------------------------------------------------
async function vencimiento_delete( id ){

    try{
        
        // Recuperar los datos del egreso
        let vencimiento = new cVencimiento();
        await vencimiento.load(id);
        
        // pedir confirmacion
        if (confirm("Esta seguro de eliminar el vencimiento :" + vencimiento.nombre + " ?") == false ){
            return;
        }
    
        // Invocar la elimiancion
        await vencimiento.delete( id )
        
        // Avisar
        avisoOk("Se ha eliminado el vencimiento");

        // Actualizar los ultimos movimientos ( solamente )
        mostrarProxVtos();        
        mostrarVtosPorFecha();
        mostrarVtosPorCuenta();

    } catch(error){
        console.log("Error al grabar la eliminar el vencimiento :", error);
    }
}

// ----------------------------------------------------------------
// Egresos: Edicion
// ----------------------------------------------------------------
function egreso_edit( id ){
    const objUltEgreso = document.getElementById("egreso_edicion");
    const objID = document.getElementById("egreso-id");
    const objCategoria = document.getElementById("egreso-categoria");
    const objFecha = document.getElementById("egreso-fecha");
    const objImporte = document.getElementById("egreso-importe");
    const objCuenta = document.getElementById("egreso-cuenta");
    const objtitulo = document.getElementById("egreso-titulo");

    // Recuperar los datos del egreso
    let egreso = new cEgreso( id );
    let cuentas = new cCuentas();
    let categorias = new cCategorias();

    egreso.load().then( egr => {
        objFecha.value = egr.fecha;
        objID.value = egr.id;
        objImporte.value = egr.importe;
        objtitulo.innerHTML = egr.nombre;

        // recuperar la lista cuentas
        cuentas.loadAll()
        .then( ctas => {
            // generar el html de las cuentas
            getHtmlParaSelect( objCuenta, ctas.lista, egr.cuentaid );

            // cargar las categorias
            categorias.loadAll()
            .then( categs => {
                // generar el html de las cuentas
                getHtmlParaSelect( objCategoria, categs.lista, egr.categoriaid );

                // Agregar la captura de eventos al form de edicion
                agregarEventListener(objUltEgreso);

                // Direccionar el Click de aceptar 
                document.getElementById("btn_egrconfirmar").addEventListener("click", egreso_save);
                
                // Mostrar la pantalla
                objUltEgreso.style.display = "block";
            })
        })
    })
}

// ----------------------------------------------------------------
// Egreso - Save
// ----------------------------------------------------------------
function egreso_save(){
    const objUltEgreso = document.getElementById("egreso_edicion");
    const objID = document.getElementById("egreso-id");
    const objCategoria = document.getElementById("egreso-categoria");
    const objFecha = document.getElementById("egreso-fecha");
    const objImporte = document.getElementById("egreso-importe");
    const objCuenta = document.getElementById("egreso-cuenta");

    const botonEnviar = document.getElementById("btn_egrconfirmar");
    let cant_mal, ret, resultado;

    // -------------------------
    // Validaciones
    // -------------------------
    // cargar todos los inputs/select del formulario
    const inputs = objUltEgccreso.querySelectorAll("input,select");

    // avisar 'validando'
    EnviarCaption = botonEnviar.innerHTML 
    botonEnviar.innerHTML = "Validando...";

    // validar todos los inputs
    cant_mal = 0;
    resultado = true;
    inputs.forEach(( input ) => {
        if ( input.name ){
            ret = doValidacionCampoClass( input );
            if ( ! ret ){
                // contar cuantos estan mal
                cant_mal++;   
            }
            resultado = ( resultado && ret );
        }    
    });

    // restaurar el texto del boton....
    botonEnviar.innerHTML = EnviarCaption;

    // si hubo error ....
    if ( ! resultado ){
        avisoError( "Vencimiento - Hay campos que no estan correctamente ingresados !");
        return;
    }
    
    // -------------------------
    // Confirmar el egreso
    // -------------------------
    botonEnviar.innerHTML = "Cargando...";
    id = objID.value;
    let egreso = new cEgreso( id );
    
    // Cargar los datos
    egreso.load()
    .then( egr => {

        // actualizar los datos del vencimiento ( por si los actualizo )
        egr.fecha = objFecha.value;
        egr.importe = objImporte.value;
        egr.cuentaid = objCuenta.value;
        egr.categoriaid = objCategoria.value;

        // avisar 'grabando'
        botonEnviar.innerHTML = "Grabando...";

        // confirmar
        egr.save()
        .then( egr => {
            // avisar 'grabando'
            botonEnviar.innerHTML = "Listo!";
        
            // Cerrar el modal
            cerrarEgr();

            avisoOk("Se ha actualizado el egreso");

            // forzar la relectura 
            mostrarUltMovs();
        })
        .catch( error => {
            avisoError("No se puede confirmar el egreso")
            cerrarEgr();
        })
    })
    .catch( error => {
        avisoError("No se puede recupear los datos del egreso !");
        // Cerrar el modal
        cerrarEgr();
    })
}

// ----------------------------------------------------------------
// Seccion de ultimos movimientos : Anulacion
// ----------------------------------------------------------------
function egreso_delete( id ){
    var result;

    // Recuperar los datos del egreso
    let egreso = new cEgreso( id );
    
    // Invocar la elimiancion
    egreso.delete().then( res =>{
        if (res.ok){
            avisoOk("Se ha eliminado el egreso correctamente!");
            
            // Actualizar los ultimos movimientos ( solamente )
            mostrarUltMovs();        
        }else{
            avisoError("No se pudo eliminar el registro");
        }
    })
}

// ----------------------------------------------------------------
// Edicion simple de vencimiento - Cerrar
// ----------------------------------------------------------------
function cerrarVes(){
    var objDivVtoEditSimple = document.getElementById("vencimientos-edicion-simple");
    objDivVtoEditSimple.style.display = "none";
}

// ----------------------------------------------------------------
// Edicion Egreso - Cerrar
// ----------------------------------------------------------------
function cerrarEgr(){
    const objUltEgreso = document.getElementById("egreso_edicion");
    objUltEgreso.style.display = "none";
}

// ----------------------------------------------------------------
// Cuentas - Ver movimientos
// ----------------------------------------------------------------
function cuentas_vermovimientos(id){
    link = BASE_URL + "movimientos/getdecuenta/" + id;
    window.location.href = link;
}

// ----------------------------------------------------------------
// Cuentas - Pedir nuevo saldo
// ----------------------------------------------------------------
async function cuentas_ajustarsaldo(id){
    const objDivCas = document.getElementById("cuenta-ajuste-saldo");
    const objID = document.getElementById("cas-id");
    const objImporte = document.getElementById("cas-importe");
    const objtitulo = document.getElementById("cas-titulo");

    // Objetos Vencimiento
    const cuenta = new cCuenta( id );

    try{
        // Cargar los datos
        await cuenta.load(id)
        
        // actualizar los datos en pantalla
        objtitulo.innerHTML = "Cuenta : " + cuenta.nombre;
        objID.value = id;
        objImporte.value = cuenta.saldo;

        // Agregar la captura de eventos al form de edicion
        agregarEventListener(objDivCas);

        // Direccionar el Click de aceptar 
        document.getElementById("cas-btn_confirmar").addEventListener("click", cuentas_grabarcas);
        document.getElementById("cas-btn_close").addEventListener("click", cuentas_cerrarcas);

        // Mostrar el form
        objDivCas.style.display = "block";
        
    }catch(error){
        console.log( "Cuentas - Ajuste de Saldo: Error : ", error);
    }
}

// ----------------------------------------------------------------
// Cerrar ventana de edicion de Saldo de cuenta
// ----------------------------------------------------------------
function cuentas_cerrarcas(){
    const objDivCas = document.getElementById("cuenta-ajuste-saldo");
    objDivCas.style.display = "none";
}

// ----------------------------------------------------------------
// Edicion simple de vencimiento - Cerrar
// ----------------------------------------------------------------
async function cuentas_grabarcas(){
    const objDivCas = document.getElementById("cuenta-ajuste-saldo");
    const objID = document.getElementById("cas-id");
    const objImporte = document.getElementById("cas-importe");

    
    try{
        // Objetos Vencimiento
        id = objID.value;
        saldo = objImporte.value;
        const cuenta = new cCuenta( id );

        // Cargar los datos
        await cuenta.load(id)
        
        // actualizar el saldo
        cuenta.saldo = saldo;

        // Grabar
        await cuenta.saveSaldo();

        avisoOk("Se ha actualizado el saldo de la cuenta");

        // Mostrar el form
        objDivCas.style.display = "none";

        // forzar actualizacion de los saldos
        await mostrarSaldosCuentas();

        
    }catch(error){
        console.log( "Cuentas - Ajuste de Saldo: Error : ", error);
    }
}