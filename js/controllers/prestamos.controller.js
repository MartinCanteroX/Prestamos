// --------------------------------
// Setup inicial de la pagina de prestamos
// --------------------------------
document.onreadystatechange = () => { 
    if (document.readyState === "complete") { 
        prestamos_initSetup(); 
    }
};

function prestamos_initSetup(){
    const btnBuscar = document.getElementById("prestamos-buscar");

    if (btnBuscar){
        btnBuscar.addEventListener("click", function(event) { event.preventDefault(); });
        btnBuscar.addEventListener("click", prestamos_buscar);
    }
}

// ----------------------------------------------------------------
// Buscar prestamos y mostrarlos en la tabla
// ----------------------------------------------------------------
async function prestamos_buscar(){
    const divPrestamos = document.getElementById("tabla-prestamos");

    if (!divPrestamos){
        return;
    }

    // Parametros de busqueda (se pueden completar luego)
    const jsonvars = {};

    divPrestamos.innerHTML = "";

    const prestamos = new cPrestamos();
    const data = await prestamos.loadAllHtml(jsonvars);

    if (data){
        divPrestamos.innerHTML = data;
    }
}

