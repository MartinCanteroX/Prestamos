
//
//    Validaciones Vs de campos de formularios
// =========================================================
 
// --------------------------------
// Expresiones regulares para validacines
// Web : https://regex101.com/
// --------------------------------
const expresiones = {
    usuario: /^[a-zA-Z0-9\_\-]{4,20}$/,                         // Letras, numeros, guion y guion bajo o guion medio
    nombre: /^[a-zA-Z0-9\_\-\$\s]{2,}$/,                        // letras y espacios y numeros, incluidos acentos
    password: /^.{4,20}$/,                                      // 4 a 20 digitos
    correo: /^[a-zA-Z0-9_.+-]+@[a-zA-Z0-9-]+\.[a-zA-Z0-9-]+$/,  
    telefono: /[\d\s]{8,14}/,                  // 8 a 14 digitos
    fecha: /[1-2][9,0][0-9]{2}[\-/][0-1][0-9][\-/#][0-3][0-9]/, // 19XX o 2XXX + mes + dia con / o - como separadores
    documento: /^[0-9]{6,8}/,                                   // Nros de documento o pasaporte
    callenombre: /^[a-zA-Z\s0-9]{2,80}$/,                       // letras, numeros y espacios, incluidos acentos
    cuitcuil: /[2-3][0,3,4,7][-]*[0-9]{8}[-]*[1-9]/,            // Solo numeros y guiones
    importe: /[\d.]+/,                                          // Solo numeros y punto decimal
    numero: /[\d]+/                                             // Solo numeros
}

// -------------------------------------------
// Funcion para agregarle el event Listner a los campos de un formulario
// Es llamada por el formulario o algun JS cargado en un formulario
// Invocacion: "agregarEventListener( document.getElementById("nombre_del_form"))"
// -------------------------------------------
function agregarEventListener( formulario ){
    if ( ! formulario ){
        return;
    }

    // cargar todos los inputs/select del formulario
    const inputs = formulario.querySelectorAll("input,select");
    
    // -------------------------------------------
    // Agregar los eventos a escuchar a los inputs
    // -------------------------------------------
    inputs.forEach(( input ) => {
        input.addEventListener('keyup', validarInput);
        input.addEventListener('blur', validarInput);
    });
}

// -------------------------------------------
// Funcion para desacrtivar el event Listner a los campos de un formulario
// -------------------------------------------
function quitarEventListener( formulario ){
    if ( ! formulario ){
        return;
    }

    // cargar todos los inputs/select del formulario
    const inputs = formulario.querySelectorAll("input,select");
    
    // -------------------------------------------
    // Agregar los eventos a escuchar a los inputs
    // -------------------------------------------
    inputs.forEach(( input ) => {
        input.removeEventListener('keyup', validarInput);
        input.removeEventListener('blur', validarInput);
    });
}

// -------------------------------------------
// Funcion para evaluar cada campo
// Es llamada por el evento click en cualquier input
// -------------------------------------------
function validarInput(e){
    valor = e.target.value;
    campo = e.target.name;
    // ret = dovalidacionCampos( e.target );
    ret = doValidacionCampoClass( e.target );
}


// -------------------------------------------
// Validar todos los inputs de un formulario
// es llamado desde la funciones de los 
// botones de un form
// -------------------------------------------
function validarTodosLosInputs( inputs ){
    var cant_mal, ret;

    cant_mal = 0;
    inputs.forEach(( input ) => {
        if ( input.name ){
            ret = doValidacionCampoClass( input );
            if ( ! ret ){
                // contar cuantos estan mal
                cant_mal++;   
            }
        }    
    });

    return ( cant_mal == 0);
}

// -------------------------------------------
// Funcion para hacer la evaluacion del contenido del campo
// esta version usa las clases que tenga el input para 
// identificar el tipo de control que hay que hacer
// ( invocada por validarInput() y envaiarformulario() )
// Recupera toda la lista de clases y busca las FV-*
// -------------------------------------------
function doValidacionCampoClass( elemento ){
    var ret = true;
    var listaclases;

    if ( ! elemento ){
        return false;
    }

    // recuperar la lista de clases
    listaclases = elemento.classList;

    // recorrer las clases para buscar alguna para 
    // identificar el tipo de dato
    listaclases.forEach(classname => {
        switch ( classname ){
            case "fv-nombre":
                ret = ValidarDato( elemento, expresiones.nombre );
                break;
    
            case "fv-fecha":
                ret = ValidarDato( elemento, expresiones.fecha );
                break;
    
            case "fv-documentonro":
                ret = ValidarDato( elemento, expresiones.documento );
                break;
            
            case "fv-telefono":
                ret = ValidarDato( elemento, expresiones.telefono, false);
                break;            
    
            case "fv-correo":
                ret = ValidarDato( elemento, expresiones.correo );
                break;
    
            case "fv-calle":
                ret = ValidarDato( elemento, expresiones.callenombre);
                break;
    
            case "fv-cuitcuil":
                ret = ValidarDato( elemento, expresiones.cuitcuil);
                break;
            
            case "fv-importe":
                ret = ValidarDato( elemento, expresiones.importe);
                break;
    
            case "fv-numero":
                ret = ValidarDato( elemento, expresiones.numero);
                break;
    
            case "fv-select":    
                // ret = ( elemento.value != "" && elemento.value != "0" && elemento.value >= 0 );
                ret = ( elemento.value != "" && elemento.value != "0" );

                // Mostrar ok o error
                if ( ret ){
                    setErrorOff( elemento );
                }else{
                    setErrorOn( elemento, "No debe estar vacio" );
                }
                break;

            case "fv-novacios":    
                ret = ( elemento.value != "" );

                // Mostrar ok o error
                if ( ret ){
                    setErrorOff( elemento );
                }else{
                    setErrorOn( elemento, "No debe estar vacio" );
                }
                break;
    
        }
    })

    return ret;
}

// -------------------------------------------
// Validacion de un campo con una expresion regular suministrada
// -------------------------------------------
function ValidarDato( input, expresion, esobligatorio = true, leyenda = "" ){
    var ret = false;
    var valor = input.value;

    // Puede estar vacio ?
    if ( valor.length != 0 || ! esobligatorio ){
        // Validar
        ret = expresion.test( valor );
    }

    // Mostrar ok o error
    if ( ret ){
        setErrorOff( input );
    }else{
        setErrorOn( input, leyenda );
    }

    // Devolver
    return ret;
}


// -------------------------------------------
// Quitar marcas de error y marcar como OK
// -------------------------------------------
function setErrorOff( objeto ){
    objeto.classList.toggle( "w3-pale-green", true);
    objeto.classList.toggle( "w3-pale-red", false);
}

// -------------------------------------------
// Activar marcas de error
// -------------------------------------------
function setErrorOn( objeto, leyenda ){ 
    objeto.classList.toggle( "w3-pale-red", true);
    objeto.classList.toggle( "w3-pale-green", false);
}

// -------------------------------------------
// Quitar marcas de error y de Ok
// -------------------------------------------
function setErrorNone( objeto ){
    objeto.classList.toggle( "w3-pale-green", false );
    objeto.classList.toggle( "w3-pale-red", false);
}

// -------------------------------------------
// Mostrar un mensaje de error 
// -------------------------------------------
function avisoError( mensaje ){
    Toastify({
        text: mensaje,
        duration: 3000,
        close: false,
        gravity: "top",
        position: "right",
        stopOnFocus: false,
        style: {
            background: "red"
        }
    }).showToast();
}

// -------------------------------------------
// Mostrar un mensaje exitoso
// -------------------------------------------
function avisoOk( mensaje, pagina ){
    Toastify({
        text: mensaje,
        duration: 3000,
        close: false,
        gravity: "top",
        position: "right",
        stopOnFocus: false,
        style: {
            background: "green"
        }
    }).showToast();

    // Pausar y continuar después de 3 segundos (3000 milisegundos)
    if (pagina){ 
        setTimeout(function() {
            window.location.href = pagina;            
        }, 3000);    
    }
}

// -------------------------------------------
// Funcion Sleep(ms)
// -------------------------------------------
function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

// -------------------------------------------
// Armado de un json con los inputs que contengan
// el atributo name 
// -------------------------------------------
function armadoJsonCamposForm( inputs ){
    var idcampo, nombrecampo, valorcampo;
    var jsonvars = {};

    inputs.forEach(( input ) => {
        idcampo = input.id;
        nombrecampo = input.name;
        valorcampo = input.value;

        if ( nombrecampo ){
            jsonvars[nombrecampo] = valorcampo;
        }
    });
    
    return jsonvars;
}
 
// -------------------------------------------
// Armar los items de un select
// -------------------------------------------
function getHtmlParaSelect( objSelect, alista, idSelect ){
    var item, listaLen

    if ( ! objSelect ){
        return false;
    }
    if ( ! alista ){
        return false;
    }
    
    // Valor nulo de seleccionar
    var option = document.createElement("option");
    option.value = 0;
    option.text = "(Seleccionar)";
    // option.selected = ( idSelect );
    objSelect.appendChild(option);

    // Generar la lista de las cuentas
    listaLen = alista.length
    for(i=0; i < listaLen; i++) {
        item = alista[i];

        var option = document.createElement("option");
        option.value = item[0];
        option.text = item[1];
        if (idSelect){
            option.selected = ( item[0] == idSelect );
        }
        objSelect.appendChild(option);
    }        

    return true;
}

// -------------------------------------------
// Armar los items de un select
// -------------------------------------------
function BuscarIDEnSelect( objSelect, cadena ){
    var i;

    for (let i = 0; i < objSelect.length; i++) {
        if (objSelect.options[i].text == cadena){
            objSelect.selectedIndex = i;  
        } 
    }
}

// -------------------------------------------
// Ir a una pagina
// -------------------------------------------
function PaginaIr( direccion ){
    window.location.href = direccion;
}

/*  -------------------------------------------
Devolver el numero formateado y con el simbolo de la moneda
indicado
Parametros : currency = simbolo de la moneda
                value = importe
*/
function numberFormatter( value ) {
    const formatter = new Intl.NumberFormat('es-ES', {
                           minimumFractionDigits: 2,
                            maximumFractionDigits: 2
        }); 

    return formatter.format(value);
}

// -------------------------------------------
// Devolver fecha de hoy en formato Ansi
// -------------------------------------------
function FechaHoyAnsi(){
    const hoy = new Date();
    const dia = hoy.getDate();
    const mes = hoy.getMonth() + 1; // Los meses van de 0 a 11
    const anio = hoy.getFullYear();
    const fecha = `${anio}-${mes.toString().padStart(2, '0')}-${dia.toString().padStart(2, '0')}`;

    return fecha;
}