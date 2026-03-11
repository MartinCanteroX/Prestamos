// --------------------------------
// por defecto cuando arranca la pagina
// --------------------------------
document.onreadystatechange = () => 
    { 
        if (document.readyState === 'complete') {
            // Lista de cuentas 
            pedirUsuario(); 

        }
    };

// --------------------------------
// Variables para acceder al DOM
// --------------------------------
// agregarEventListener( document.getElementById("form_login"));

// -------------------------------------------
// Accion al 'Enviar'
// -------------------------------------------
// document.getElementById("btn_confirmar").addEventListener("click", Grabar);

// ----------------------------------------------------------------
// Pedir el usuario
// ----------------------------------------------------------------
function pedirUsuario(){
    var objDivModal = document.getElementById("loginModal");
    var objTitulo = document.getElementById("titulo");
    var objBotonConfirmar = document.getElementById("btn_confirmar");
    // // const objlinkOlvide = document.getElementById("link-olvideclave")
    // // const objlinkNuevo = document.getElementById("link-nuevousuario")

    try{
        // cargar el resto de los datos en la pantalla
        objTitulo.innerHTML = "Bienvenido";

        // mostrar el egreso
        objBotonConfirmar.addEventListener("click", aceptarUsuario);
        // objlinkOlvide.addEventListener("click", olvideClave);
        // objlinkNuevo.addEventListener("click", nuevoUsuario);
        objDivModal.style.display = "block";

    }catch(error){
        console.log( "Login - Error al editar: ", error);
    }
}

// ----------------------------------------------------------------
// el usuario y la clave
// ----------------------------------------------------------------
async function aceptarUsuario(){
    const objDivModal = document.getElementById("loginModal");
    const objNombre = document.getElementById("usuario_nombre");
    const objClave = document.getElementById("usuario_clave");
    const objBotonConfirmar = document.getElementById("btn_confirmar");

    try{
        // Aviso 
        objBotonConfirmar.innerHTML = "Validando...";

        // Validar el usuario
        const login = new cLogin();
        const varclave = objClave.value;
        const varnombre = objNombre.value;
        
        // Validar
        ok = (await login.validar( varnombre, varclave));
        if ( ok ){
            // Guardar el ID logueado
            await login.setCurrent();

            // Cerrar el login
            objDivModal.style.display = "none";

            // Volver al principio
            PaginaIr( BASE_URL );

        }else{
            avisoError("Los datos no corresponden a un usuario");
        }

        // Desactvar la pantalla

    }catch(error){
        console.log( "Login - Error en AceptarUsuario: ", error);
    }
}
