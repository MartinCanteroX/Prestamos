// -----------------------------------------------------------------------
// Transferencias - Editar
// Calcular el valor de conversion del egreso al ingreso ( si son diferentes )
// Evento: Change en importe desde y hasta
//
function CalcularCotizacion(){

    var importedesde, importehasta, cotizacion;

    importedesde = document.getElementById("importedesde");
    importehasta = document.getElementById("importehasta");
    importe_cotizacion = document.getElementById("importe_cotizacion");

    if ( importehasta.value > 0 ) {
        cotizacion = importedesde.value / importehasta.value
    }

    importe_cotizacion.innerHTML = cotizacion;
}

// -----------------------------------------------------------------------
// Planificaciones - Editar
// Activar o desactivar un dia
// Evento: Click de los dias del calendario
// Marca la fecha y guarda la lista de fechas seleccionadas
//
function calendario_seldia(th){
    var pElement, nombre_elemento;
    var elemento_hidden;
    var classname;
    var dia = 0;
    classname = 'bg-light';

    if ( th.classList.contains(classname)){
        th.classList.remove(classname);
    }else{
        th.classList.add(classname);
    }

    // Armar la lista de dias. Recorrer todos los 'calendario-dia-??' y analizar
    // si tiene la clase o no para saber si se eligio.
    // Generar una cadena de dias y asignarla en el input-hiden 'diaselegidos'
    ListaDias = "";
    for (dia=1; dia<=31; dia++){
        nombre_elemento = 'calendario-dia-' + dia; 

        // Ubicar el elemento
        pElement = document.getElementById( nombre_elemento );

        if ( pElement.classList.contains(classname)){
            // Es una fecha seleccionada, agregarlo
            ListaDias = ListaDias.concat( "," + dia.toString());

        }
    }

    // Asignarla al input-hidden
    elemento_hidden = document.getElementById("diaselegidos");
    elemento_hidden.value = ListaDias;

}   

// -----------------------------------------------------------------------
// Planificaciones - Editar
// Activar o no la cuenta de ingreso si es Transferencia
// Evento: Click en el combo de tipo de movimiento
function Planificacion_MostrarCuentas( combo ){
    var tipo, seccion_cuentas;
    
    tipo = combo.value;

    // Recuperar las secciones
    seccion_cuentas = document.getElementById("columna-ingreso");

    // Determinar si mostrar o no los dias de la semana
    // arranca que no y si es semanal, se activa
    seccion_cuentas.style.display = "none";
    if ( tipo === 'T'){
        seccion_cuentas.style.display = "block";
    }
}

// -----------------------------------------------------------------------
// Planificaciones - Editar
// Activar o no la cuenta de ingreso si es Transferencia
// Evento: Click en el combo de tipo de movimiento
//
function Planificacion_Frecuencia( combo ){
    var tipo, seccion_diasdelasemana, seccion_todoslosdias;
    
    tipo = combo.value;

    // Recuperar las secciones
    seccion_diasdelasemana = document.getElementById("div-dias-de-la-semana");
    seccion_todoslosdias = document.getElementById("div-todos-los-dias");

    // Determinar si mostrar o no los dias de la semana
    // arranca que no y si es semanal, se activa
    seccion_diasdelasemana.style.display = "none";
    if ( tipo === 'S'){
        seccion_diasdelasemana.style.display = "block";
    }

    // Determinar si mostrar o no todos los dias
    // arranca que no y si es mensual o bimestral, se activa
    seccion_todoslosdias.style.display = "none";
    if ( tipo === 'M' || tipo === 'B'){
        seccion_todoslosdias.style.display = "block";
    }
}

//---------------------------------------------------------
// Rubros_Abm.php
//  * Funcion para cargar las categorias del rubro y las disponibles
//  * Toma el ID del rubro
//  * Invoca el programa PHP que devuelve un array con ID, Nombre y Incluida (S/N)
//  * Arma una lista con las categorias Incluida='S' para en el DIV 'rubros_lst_cat_inc'
//  * Arma una lista con las categorias Incluida='N' para el DIV 'rubros_lst_cat_disp'
//---------------------------------------------------------
function Rubros_LlenarCategorias( comboName ) {
    if ( comboName != "") {
      // Preparar la comunicacion con el server
      var xmlhttp = new XMLHttpRequest();
      var rubroid, listacategorias, htmlListaIncluidas, htmlListaDisponibles;
      combo = document.getElementById( comboName );
      rubroid = combo.value;
      document.getElementById("rubros_lst_cat_inc").innerHTML = "Cargando...";
      document.getElementById("rubros_lst_cat_disp").innerHTML = "Cargando...";
      
      // Procesar la respuesta del server...
      xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
          listacategoriasJS = xmlhttp.responseText;
          
          // Armar una lista de categorias
          htmlListaIncluidas = Rubros_GenLista( listacategoriasJS, 'S' );
          htmlListaDisponibles = Rubros_GenLista( listacategoriasJS, 'N' );
          
          document.getElementById("rubros_lst_cat_inc").innerHTML = htmlListaIncluidas;
          document.getElementById("rubros_lst_cat_disp").innerHTML = htmlListaDisponibles;
        }
      };
      
      // Generar el pedido de info al server...
      xmlhttp.open("GET", "rubros_getcategorias.php?cid=" + rubroid, true);
      xmlhttp.send();

    } 
    else {
          // Se invoco la funcion incorrectamente
          alert("Sin parametro");
          document.getElementById("rubros_lst_cat_inc").innerHTML = "";
          document.getElementById("rubros_lst_cat_disp").innerHTML = "";
          return;
    } 
  }
  

//---------------------------------------------------------
// BuscarVencimientos: Buscar los vencimientos con los 
// paramatros indicados y poner el resultado en la seccion
// de vencimientos
//---------------------------------------------------------
function BuscarVencimientos(){
  var objdesde = document.getElementById( 'desde' );
  var objhasta = document.getElementById( 'hasta' );
  var objcuentas = document.getElementById( 'cuentas' );
  var objcategorias = document.getElementById( 'categorias' );
  var objtablamovs = document.getElementById( 'vencimientos-datos' );
  var desde, hasta, cuentaid, categoriaid, link;

  // Valores de parametros
  desde = objdesde.value;
  hasta = objhasta.value;
  cuentaid = objcuentas.value;
  categoriaid = objcategorias.value;

  // control de los parametros
  /*
  if ( typeof desde != "string" ){ desde = "2020-01-01"; }
  if ( typeof hasta != "string" ){ hasta = "2099-01-01"; }
  if ( ! isNaN(Number(cuentaid)) ){ cuentaid = 0; }
  if ( ! isNaN(Number(categoriaid)) ){ categoriaid = 0; }
  */

  //Armar el llamado para recuperar los datos
  link = "vencimientos_getmovs.php?d=" + desde + "&h=" + hasta + "&c=" + cuentaid + "&ct=" + categoriaid;

  // Invocar la busqueda de datos
  $.get( link, function( data ){ 
    objtablamovs.innerHTML = data;
  } );
}

//---------------------------------------------------------
// BuscarMovimientos: Buscar los movimientos con los 
// paramatros indicados y poner el resultado en la seccion
// de movimientos
//---------------------------------------------------------
function BuscarMovimientos( TipoMov ){
  var objdesde = document.getElementById( 'desde' );
  var objhasta = document.getElementById( 'hasta' );
  var objcuentas = document.getElementById( 'cuentas' );
  var objcategorias = document.getElementById( 'categorias' );
  var objtablamovs = document.getElementById( 'movimientos-datos' );
  var desde, hasta, cuentaid, categoriaid, link;

  // Valores de parametros
  desde = objdesde.value;
  hasta = objhasta.value;
  cuentaid = objcuentas.value;
  categoriaid = objcategorias.value;

  // control de los parametros
  /*
  if ( typeof desde != "string" ){ desde = "2020-01-01"; }
  if ( typeof hasta != "string" ){ hasta = "2099-01-01"; }
  if ( ! isNaN(Number(cuentaid)) ){ cuentaid = 0; }
  if ( ! isNaN(Number(categoriaid)) ){ categoriaid = 0; }
  */

  //Armar el llamado para recuperar los datos
link = "movimientos_getmovs.php?t=" + TipoMov + "&d=" + desde + "&h=" + hasta + "&c=" + cuentaid + "&ct=" + categoriaid;

  // Invocar la busqueda de datos
  $.get( link, function( data ){ 
    objtablamovs.innerHTML = data;
  });
}

//---------------------------------------------------------
// Llamado desde Rubros_LlenarCategorias()
// Armar una lista con UL con los datos pasados en la lista
// tomando solo los valores cuyo campo INCLUIDA = cualIncluir
// Devuelve el html
// 
//---------------------------------------------------------
function Rubros_GenLista( listaCategoriasJS, cualIncluir ){
  var htmlADevoler = "", i;
  var flen, moneda, link, icono;
  var htmlRenglon, htmlADevolver = "";
  var listaCategorias;

  // Decodificar el array de categorias JS en un array JS
  listaCategorias = JSON.parse( listaCategoriasJS) ;

  flen = listacategorias.length;
  for( i=0; i <= flen; i++ ){
    categoria = listacategorias[i];

    if ( categoria[2] == cualIncluir ){
        // Itme
        htmlRenglon = "<div class='rubros_lstcat_item'><ul>" + categoria[1] + "</ul></div>";
        
        // Agregar div para el icono
        htmlRenglon += "<div class='rubros_lstcat_icono_'" + cualIncluir + ">";
        
        // Agregar el link y el icono
        if ( cualIncluir == 'S'){ 
          link = "Rubros_DelCat";
          icono = "img/agregar.png"; 
        }
        else{ 
          link = "Rubros_AddCat"; 
          icono = "img/quitar.png"; 
        }

        htmlRenglon += "<a onclick='" + link + "(" + categoria[0] + ")>";
        htmlRenglon +=    "<img src='" + icono + "' alt='icono'/>";
        htmlRenglon += "</a>";

        // Anexar al HTML general
        htmlADevoler += htmlRenglon;
    }

    // devolver
    return htmlADevoler;
  };
}
// -------------------------------------------------------------
// Generico para cuando se hace clic en un ojo de un password
// El control tiene que tener la clase 'toggle-password'
// Tambien tiene que estar incluida la libreria de iconos
// 
// -------------------------------------------------------------
function togglePassword( idInput ){
  var elInput = document.getElementById( idInput );
  var type = elInput.type;
  if(type=='password'){
    elInput.type = "text";
   }else{
    elInput.type = "password";
   }
  }

//---------------------------------------------------------
// Validar la edicion de una categoria
//---------------------------------------------------------
function CategoriasSave(){
  var objnombre = document.getElementById( "nombre" );
  var objcategoriaid = document.getElementById( 'categoriaid' );
  var nombre, categoriaid, link;
  var okNombre, okCategoria;

  // Valores de parametros
  nombre = objnombre.value;
  categoriaid = objcategoriaid.value;

  //
  // control de los parametros
  // -------------------------
  okNombre = ( typeof nombre == "string" );
  okNombre = ( okNombre && nombre != "" );
  okCategoria = ( isNaN(Number(categoriaid)) );
  
  // marcar los campos si estan incorrectos
  // --------------------------------------
  if ( ! okNombre ){
    objnombre.classList.replace('w3-white', 'w3-pale-red');
  }
  
  // placeholders para indicar el error 
  // ----------------------------------
  if ( nombre == "" ){
    objnombre.setAttribute("placeholder", "No puede estar vacio el nombre");  
    objnombre.classList.replace('w3-white', 'w3-pale-red');
  }

  //
  // Si todo es correcto, grabar
  //
  if ( okNombre ){

    // preparar datos para enviar
    datasend = [ categoriaid, nombre ];
    
    // Link para grabar
    link = "categorias_save.php?id=" + categoriaid + "&n=" + nombre + "&data=" + datasend ;
    
    // Invocar la busqueda de datos
    $.get( link, function( data ){ 
        var jsonData = JSON.parse(data);
        newlink = "categorias_abm.php?resp=" + jsonData.resultado;
        window.location.assign( newlink );
      } 
    );
  }
}

//---------------------------------------------------------
// Validar el alta / edicion de una moneda
//---------------------------------------------------------
function MonedasSave(){
  // Levantar los datos del formulario
  var objnombre = document.getElementById( "nombre" );
  var objmonedaid = document.getElementById( 'monedaid' );
  var objabreviatura = document.getElementById( 'abreviatura' );
  var objsimbolo = document.getElementById( 'simbolo' );
  var objicono = document.getElementById( 'icono' );
  var objsaldo = document.getElementById( 'saldo' );
  var nombre, monedaid, abreviatura, simbolo, icono, saldo;
  var oknombre, okmonedaid, okabreviatura, oksimbolo, okicono, oksaldo;
  var link, newlink, objdatasend, sdatasend; 
  
  // Valores de parametros
  nombre = "";
  monedaid = 0;
  abreviatura = "";
  simbolo = "";
  icono = "";
  saldo = 0;

  if ( objnombre ){
    nombre = objnombre.value;
  }
  if ( objmonedaid ){
    monedaid = parseFloat( objmonedaid.value );
  }
  if ( objabreviatura ){
    abreviatura = objabreviatura.value;
  }
  if ( objsimbolo ){
    simbolo = objsimbolo.value;
  }
  if ( objicono ){
    icono = objicono.value;
  }
  if ( objsaldo ){
    saldo = parseFloat( objsaldo.value );
  }

  //
  // control de los parametros
  // -------------------------
  oknombre = ( typeof nombre == "string" );
  oknombre = ( oknombre && nombre != "" );
  okmonedaid = ( isNaN(Number(monedaid)) );
  okabreviatura = ( typeof abreviatura == "string" );
  oksimbolo = ( typeof simbolo == "string" );
  okicono = ( typeof icono == "string" );
  oksaldo = ( ! isNaN(Number(saldo)) );
  
  // marcar los campos si estan incorrectos
  // --------------------------------------
  if ( ! oknombre ){
    objnombre.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! oksimbolo ){
    objsimbolo.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okabreviatura ){
    objabreviatura.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okicono ){
    objicono.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! oksaldo ){
    objsaldo.classList.replace('w3-white', 'w3-pale-red');
  }
  
  // placeholders para indicar el error 
  // ----------------------------------
  if ( nombre == "" ){
    objnombre.setAttribute("placeholder", "No puede estar vacio el nombre");  
    objnombre.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( abreviatura == "" ){
    objabreviatura.setAttribute("placeholder", "Debe indicar una abreviatura");  
    objabreviatura.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( simbolo == "" ){
    objsimbolo.setAttribute("placeholder", "Debe indicar un simbolo");  
    objsimbolo.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( icono == "" ){
    objicono.setAttribute("placeholder", "Debe indicar un icono");  
    objicono.classList.replace('w3-white', 'w3-pale-red');
  }

  //
  // Si todo es correcto, grabar
  //
  if ( oknombre && okabreviatura && oksimbolo && okicono && oksaldo ){

    // preparar datos para enviar
    objdatasend = { "monedaid" : monedaid, "nombre" : nombre, "abreviatura" : abreviatura, "simbolo" : simbolo, "icono" : icono, "saldo" : saldo };
    sdatasend = JSON.stringify(objdatasend);
    
    // Link para grabar
    link = "monedas_save.php?p=" + sdatasend ;
    
    // Invocar la busqueda de datos
    $.get( link, function( data ){ 
        var jsonData = JSON.parse(data);
        newlink = "monedas_abm.php?resp=" + jsonData.resultado;
        window.location.assign( newlink );
      } 
    );
  }
}

//---------------------------------------------------------
// Validar el alta / edicion de una cuenta
//---------------------------------------------------------
function CuentasSave(){
  // Levantar los datos del formulario
  var objcuentaid = document.getElementById( "cuentaid" );
  var objnombre = document.getElementById( "nombre" );
  var objabreviatura = document.getElementById( 'abreviatura' );
  var objmonedaid = document.getElementById( 'monedaid' );
  var objsaldo = document.getElementById( 'saldo' );
  var objtipodecuenta = document.getElementById( 'tipodecuenta' );
  var objlimitecompra = document.getElementById( 'limitecompra' );
  var objfechacorte = document.getElementById( 'fechacorte' );
  var objicono = document.getElementById( 'icono' );

  var nombre, monedaid, abreviatura, icono, saldo;
  var tipodecuenta, limitecompra, fechacorte;
  var oknombre, okcuentaid, okmonedaid, okabreviatura, okicono, oksaldo;
  var oktipodecuenta, oklimitecompra, okfechacorte;
  var link, newlink, objdatasend, sdatasend; 
  
  // Valores de parametros
  cuentaid = 0;
  nombre = "";
  monedaid = 0;
  abreviatura = "";
  icono = "";
  saldo = 0;
  tipodecuenta = "";
  limitecompra = 0;
  fechacorte = "";

  if ( objnombre ){
    nombre = objnombre.value;
  }
  if ( objmonedaid ){
    monedaid = parseFloat( objmonedaid.value );
  }
  if ( objabreviatura ){
    abreviatura = objabreviatura.value;
  }
  if ( objcuentaid ){
    cuentaid = parseFloat(objcuentaid.value);
  }
  if ( objicono ){
    icono = objicono.value;
  }
  if ( objsaldo ){
    saldo = parseFloat( objsaldo.value );
  }
  if (objtipodecuenta){
      tipodecuenta = objtipodecuenta.value;
    }
  if ( objlimitecompra){ 
    limitecompra = parseFloat( objlimitecompra.value );
  }
  if ( objfechacorte){
    fechacorte = objfechacorte.value;
  }

  //
  // control de los parametros
  // -------------------------
  okcuentaid = ( ! isNaN(Number(cuentaid)) );
  oknombre = ( typeof nombre == "string" );
  oknombre = ( oknombre && nombre != "" );
  okmonedaid = ( ! isNaN(Number(monedaid)) );
  okabreviatura = ( typeof abreviatura == "string" );
  okicono = ( typeof icono == "string" );
  oksaldo = ( ! isNaN(Number(saldo)) );
  oktipodecuenta = ( typeof tipodecuenta == "string" );
  oklimitecompra = ( ! isNaN(Number(limitecompra)) );
  okfechacorte = ( typeof fechacorte == "string" );
  
  // marcar los campos si estan incorrectos
  // --------------------------------------
  if ( ! oknombre ){
    objnombre.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okabreviatura ){
    objabreviatura.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okicono ){
    objicono.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! oksaldo ){
    objsaldo.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okmonedaid ){
    objmonedaid.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! oktipodecuenta ){
    objtipodecuenta.classList.replace('w3-white', 'w3-pale-red');
  }
  
  // placeholders para indicar el error 
  // ----------------------------------
  if ( nombre == "" ){
    objnombre.setAttribute("placeholder", "No puede estar vacio el nombre");  
    objnombre.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( abreviatura == "" ){
    objabreviatura.setAttribute("placeholder", "Debe indicar una abreviatura");  
    objabreviatura.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( icono == "" ){
    objicono.setAttribute("placeholder", "Debe indicar un icono");  
    objicono.classList.replace('w3-white', 'w3-pale-red');
  }

  //
  // Si todo es correcto, grabar
  //
  if ( oknombre && okabreviatura && okcuentaid && okicono && oksaldo && oktipodecuenta ){

    // preparar datos para enviar
    objdatasend = { "cuentaid" : cuentaid, "nombre" : nombre, 
      "abreviatura" : abreviatura, "monedaid": monedaid, 
      "icono" : icono, "saldo" : saldo,
      "tipodecuenta" : tipodecuenta,
      "limitecompra" : limitecompra,
      "fechacorte" : fechacorte };
    sdatasend = JSON.stringify(objdatasend);
    
    // Link para grabar
    link = "cuentas_save.php?p=" + sdatasend ;
    
    // Invocar la busqueda de datos
    $.get( link, function( data ){ 
        var jsonData = JSON.parse(data);
        newlink = "cuentas_abm.php?resp=" + jsonData.resultado;
        window.location.assign( newlink );
      } 
    );
  }
}

//---------------------------------------------------------
// Validar el alta / edicion de un movimiento ( egreso / ingreso )
//---------------------------------------------------------
function MovimientosSave(){
  // Levantar los datos del formulario
  var objmovimientoid = document.getElementById( "movimientoid" );
  var objtipo = document.getElementById( "tipo" );
  var objnombre = document.getElementById( "movimientos-nombre" );
  var objfecha = document.getElementById( "movimientos-fecha" );
  var objimporte = document.getElementById( 'movimientos-importe' );
  var objcuentaid = document.getElementById( "movimientos-cuenta" );
  var objcategoriaid = document.getElementById( 'movimientos-categoria' );

  var movid, tipo, nombre, fecha, importe, cuentaid, categoriaid;
  var oktipo, oknombre, okfecha, okimporte, okcuentaid, okcategoriaid;
  var link, newlink, objdatasend, sdatasend; 
  
  // Valores de parametros
  movid = 0;
  tipo = 0;
  nombre = "";
  fecha = "";
  importe = 0;
  cuentaid = 0;
  categoriaid = 0;
  
  if ( objmovimientoid ){
    movid = parseFloat( objmovimientoid.value );
  }
  if ( objtipo ){
    tipo = objtipo.value;
  }
  if ( objnombre ){
    nombre = objnombre.value;
  }
  if ( objfecha ){
    fecha = objfecha.value;
  }
  if ( objimporte ){
    importe = parseFloat(objimporte.value);
  }
  if ( objcuentaid ){
    cuentaid = parseFloat(objcuentaid.value);
  }
  if ( objcategoriaid ){
    categoriaid = parseFloat( objcategoriaid.value );
  }

  //
  // control de los parametros
  // -------------------------
  okmovid = ( ! isNaN(Number(movid)) );
  oktipo = ( typeof tipo == "string" );
  oktipo = ( oktipo && tipo != "" );
  oknombre = ( typeof nombre == "string" );
  oknombre = ( oknombre && nombre != "" );
  okfecha = ( typeof fecha == "string" );
  okimporte = ( ! isNaN(Number(importe)) );
  okcuentaid = ( ! isNaN(Number(cuentaid)) );
  okcategoriaid = ( ! isNaN(Number(categoriaid)) );
  
  // marcar los campos si estan incorrectos
  // --------------------------------------
  if ( ! oknombre ){
    objnombre.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okfecha ){
    okfecha.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okimporte ){
    objimporte.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okcuentaid ){
    objcuentaid.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! objcategoriaid ){
    objcategoriaid.classList.replace('w3-white', 'w3-pale-red');
  }
  
  // placeholders para indicar el error 
  // ----------------------------------
  if ( nombre == "" ){
    objnombre.setAttribute("placeholder", "No puede estar vacio el nombre");  
    objnombre.classList.replace('w3-white', 'w3-pale-red');
  }

  //
  // Si todo es correcto, grabar
  //
  if ( oktipo && oknombre && okfecha && okimporte && okcuentaid && okcategoriaid ){

    // preparar datos para enviar
    objdatasend = { "id" : movid, "tipo" : tipo, "nombre" : nombre, "fecha" : fecha, "importe" : importe, "cuentaid" : cuentaid, "categoriaid" : categoriaid };
    sdatasend = JSON.stringify(objdatasend);
    
    // Link para grabar
    link = "movimientos_save.php?p=" + sdatasend ;
    
    // Invocar la busqueda de datos
    $.get( link, function( data ){ 
        var jsonData = JSON.parse(data);
        newlink = "movimientos_abm.php?tipo=" + tipo + "&resp=" + jsonData.resultado;
        window.location.assign( newlink );
      } 
    );
  }
}

//---------------------------------------------------------
// Validar el alta / edicion de una transferencia
//---------------------------------------------------------
function TransferenciaSave(){
  // Levantar los datos del formulario
  var objtransferenciaid = document.getElementById( 'transferenciaid' );
  var objnombre = document.getElementById( 'nombre' );
  var objfecha = document.getElementById( 'fecha' );
  var objcategoriaid = document.getElementById( 'categoriaid' );
  var objdescripcion = document.getElementById( 'descripcion' );
  var objcuentadesdeid = document.getElementById( "cuentadesdeid" );
  var objimportedesde = document.getElementById( 'importedesde' );
  var objcuentahastaid = document.getElementById( "cuentahastaid" );
  var objimportehasta = document.getElementById( 'importehasta' );

  var transferenciaid, nombre, fecha, categoriaid, descripcion;
  var cuentadesdeid, importedesde, cuentahastaid, importehasta;
  var oknombre, okfecha, okcategoriaid;
  var okcuentadesdeid, okimportedesde, okcuentahastaid, okimportehasta;
  var link, newlink, objdatasend, sdatasend; 
  
  // Valores de parametros
  transferenciaid = 0;
  nombre = "";
  fecha = "";
  categoriaid = 0;
  descripcion = "";
  cuentadesdeid = 0;
  importedesde = 0;
  cuentahastaid = 0;
  importehasta = 0;
  
  if ( objtransferenciaid ){
    transferenciaid = parseFloat( objtransferenciaid.value );
  }
  if ( objnombre ){
    nombre = objnombre.value;
  }
  if ( objfecha ){
    fecha = objfecha.value;
  }
  if ( objcategoriaid ){
    categoriaid = parseFloat( objcategoriaid.value );
  }
  if ( objdescripcion ){
    descripcion = objdescripcion.value;
  }  
  if ( objcuentadesdeid ){
    cuentadesdeid = parseFloat( objcuentadesdeid.value);
  }
  if ( objimportedesde ){
    importedesde = parseFloat(objimportedesde.value);
  }
  if ( objcuentahastaid ){
    cuentahastaid = parseFloat( objcuentahastaid.value);
  }
  if ( objimportehasta ){
    importehasta = parseFloat(objimportehasta.value);
  }
  

  //
  // control de los parametros
  // -------------------------
  oktransferenciaid = ( ! isNaN(Number(transferenciaid)) );
  oknombre = ( typeof nombre == "string" );
  oknombre = ( oknombre && nombre != "" );
  okfecha = ( typeof fecha == "string" );
  okcategoriaid = ( ! isNaN(Number(categoriaid)));
  okcategoriaid = ( okcategoriaid && categoriaid > 0 );
  okcuentadesdeid = ( ! isNaN(Number(cuentadesdeid)) );
  okcuentadesdeid = ( okcuentadesdeid && cuentadesdeid > 0 );
  okimportedesde = ( ! isNaN(Number(importedesde)) && importedesde > 0 );
  okcuentahastaid = ( ! isNaN(Number(cuentahastaid)) && cuentahastaid > 0 );
  okimportehasta = ( ! isNaN(Number(importehasta)) && importehasta > 0 );
  
  // marcar los campos si estan incorrectos
  // --------------------------------------
  if ( ! oknombre ){
    objnombre.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okfecha ){
    objfecha.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! objcategoriaid ){
    objcategoriaid.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okcuentadesdeid ){
    objcuentadesdeid.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okimportedesde ){
    objimportedesde.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okcuentahastaid ){
    objcuentahastaid.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okimportehasta ){
    objimportehasta.classList.replace('w3-white', 'w3-pale-red');
  }
  // placeholders para indicar el error 
  // ----------------------------------
  if ( nombre == "" ){
    objnombre.setAttribute("placeholder", "No puede estar vacio el nombre");  
    objnombre.classList.replace('w3-white', 'w3-pale-red');
  }

  //
  // Si todo es correcto, grabar
  //
  if ( oknombre && okfecha && okcuentadesdeid && okimportedesde && okcuentahastaid && okimportehasta && okcategoriaid ){

    // preparar datos para enviar
    objdatasend = { "transferenciaid" : transferenciaid, "nombre" : nombre, "fecha" : fecha, "categoriaid" : categoriaid, "descripcion" : descripcion, "cuentadesdeid" : cuentadesdeid, "importedesde" : importedesde, "cuentahastaid" : cuentahastaid, "importehasta" : importehasta };
    sdatasend = JSON.stringify(objdatasend);
    
    // Link para grabar
    link = "transferencia_save.php?p=" + sdatasend ;
    
    // Invocar la busqueda de datos
    $.get( link, function( data ){ 
        var jsonData = JSON.parse(data);
        newlink = "transferencias_abm.php?resp=" + jsonData.resultado;
        window.location.assign( newlink );
      } 
    );
  }
}

//---------------------------------------------------------
// Validar la confirmacion de un vencimiento
//---------------------------------------------------------
function VencimientoConfirmarSave(){
  // Levantar los datos del formulario
  var objvencimientoid = document.getElementById( 'vencimientoid' );
  var objtipo = document.getElementById( 'tipo' );
  var objnombre = document.getElementById( 'nombre' );
  var objfecha = document.getElementById( 'fecha' );
  var objcategoriaid = document.getElementById( 'categoriaid' );
  var objcuentadesdeid = document.getElementById( "cuentadesdeid" );
  var objimportedesde = document.getElementById( 'importedesde' );
  var objcuentahastaid = document.getElementById( "cuentahastaid" );
  var objimportehasta = document.getElementById( 'importehasta' );
  var objdescripcion = document.getElementById( 'descripcion' );
  var objactualizar = document.getElementById( 'actualizar' );

  var vencimientoid, tipo, nombre, fecha, categoriaid, descripcion;
  var actualizar, cuentadesdeid, importedesde, cuentahastaid, importehasta;
  var oknombre, oktipo, okfecha, okcategoriaid, okactualizar;
  var okcuentadesdeid, okimportedesde, okcuentahastaid, okimportehasta;
  var link, newlink, objdatasend, sdatasend; 
  
  // Valores de parametros
  vencimientoid = 0;
  nombre = "";
  tipo = "";
  fecha = "";
  categoriaid = 0;
  cuentadesdeid = 0;
  importedesde = 0;
  cuentahastaid = 0;
  importehasta = 0;
  descripcion = "";
  actualizar = "";
  
  if ( objvencimientoid ){
    vencimientoid = parseFloat( objvencimientoid.value );
  }
  if ( objtipo ){
    tipo = objtipo.value;
  }
  if ( objnombre ){
    nombre = objnombre.value;
  }
  if ( objfecha ){
    fecha = objfecha.value;
  }
  if ( objcategoriaid ){
    categoriaid = parseFloat( objcategoriaid.value );
  }
  if ( objdescripcion ){
    descripcion = objdescripcion.value;
  }  
  if ( objcuentadesdeid ){
    cuentadesdeid = parseFloat( objcuentadesdeid.value);
  }
  if ( objimportedesde ){
    importedesde = parseFloat(objimportedesde.value);
  }
  if ( objcuentahastaid ){
    cuentahastaid = parseFloat( objcuentahastaid.value);
  }
  if ( objimportehasta ){
    importehasta = parseFloat(objimportehasta.value);
  }
  if ( objactualizar ){
    actualizar = objactualizar.value;
  }


  //
  // control de los parametros
  // -------------------------
  okvencimientoid = ( ! isNaN(Number(vencimientoid)) );
  oktipo = ( typeof nombre == "string" && tipo != "" );
  oknombre = ( typeof nombre == "string" && nombre != "" );
  okfecha = ( typeof fecha == "string" );
  okcategoriaid = ( ! isNaN(Number(categoriaid)) && categoriaid > 0 );
  okcuentadesdeid = ( ! isNaN(Number(cuentadesdeid)) && cuentadesdeid > 0 );
  okimportedesde = ( ! isNaN(Number(importedesde)) && importedesde > 0 );
  okcuentahastaid = true;
  okimportehasta = true;
  okcuentahastaid = ( tipo != "T" || ( ! isNaN(Number(cuentahastaid)) && cuentahastaid > 0 ));
  okimportehasta =  ( tipo != "T" || ( ! isNaN(Number(importehasta)) && importehasta > 0 ));
  
  // marcar los campos si estan incorrectos
  // --------------------------------------
  if ( ! oknombre || nombre == "" ){
    objnombre.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okfecha ){
    objfecha.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! objcategoriaid ){
    objcategoriaid.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okcuentadesdeid ){
    objcuentadesdeid.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okimportedesde ){
    objimportedesde.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okcuentahastaid ){
    objcuentahastaid.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okimportehasta ){
    objimportehasta.classList.replace('w3-white', 'w3-pale-red');
  }
  // placeholders para indicar el error 
  // ----------------------------------
  if ( nombre == "" ){
    objnombre.setAttribute("placeholder", "No puede estar vacio el nombre");  
  }

  //
  // Si todo es correcto, grabar
  //
  if ( oktipo && oknombre && okfecha && okcuentadesdeid && okimportedesde && okcuentahastaid && okimportehasta && okcategoriaid ){

    // preparar datos para enviar
    objdatasend = { "vencimientoid" : vencimientoid, "tipo" : tipo, "nombre" : nombre, "fecha" : fecha, "categoriaid" : categoriaid, "descripcion" : descripcion, "cuentadesdeid" : cuentadesdeid, "importedesde" : importedesde, "cuentahastaid" : cuentahastaid, "importehasta" : importehasta, "actualizar" : actualizar };
    sdatasend = JSON.stringify(objdatasend);
    
    // Link para grabar
    link = "vencimiento_confirmar_save.php?p=" + sdatasend ;
    
    // Invocar la busqueda de datos
    $.get( link, function( data ){ 
        var jsonData = JSON.parse(data);
        newlink = "vencimientos_abm.php?resp=" + jsonData.resultado;
        window.location.assign( newlink );
      } 
    );
  }
}

//---------------------------------------------------------
// Validar un vencimiento
//---------------------------------------------------------
function VencimientoSave(){
  // Levantar los datos del formulario
  var objvencimientoid = document.getElementById( 'vencimientoid' );
  var objnombre = document.getElementById( 'nombre' );
  var objfecha = document.getElementById( 'fecha' );
  var objtipo = document.getElementById( 'tipo' );
  var objcategoriaid = document.getElementById( 'categoriaid' );
  var objcuentadesdeid = document.getElementById( "cuentadesdeid" );
  var objimportedesde = document.getElementById( 'importedesde' );
  var objcuentahastaid = document.getElementById( "cuentahastaid" );
  var objimportehasta = document.getElementById( 'importehasta' );

  var vencimientoid, tipo, nombre, fecha, categoriaid;
  var cuentadesdeid, importedesde, cuentahastaid, importehasta;
  var oknombre, oktipo, okfecha, okcategoriaid
  var okcuentadesdeid, okimportedesde, okcuentahastaid, okimportehasta;
  var link, newlink, objdatasend, sdatasend; 
  
  // Valores de parametros
  vencimientoid = 0;
  nombre        = "";
  tipo          = "";
  fecha         = "";
  categoriaid   = 0;
  cuentadesdeid = 0;
  importedesde  = 0;
  cuentahastaid = 0;
  importehasta  = 0;
  
  if ( objvencimientoid ){
    vencimientoid = parseFloat( objvencimientoid.value );
  }
  if ( objtipo ){
    tipo = objtipo.value;
  }
  if ( objnombre ){
    nombre = objnombre.value;
  }
  if ( objfecha ){
    fecha = objfecha.value;
  }
  if ( objcategoriaid ){
    categoriaid = parseFloat( objcategoriaid.value );
  }
  if ( objcuentadesdeid ){
    cuentadesdeid = parseFloat( objcuentadesdeid.value);
  }
  if ( objimportedesde ){
    importedesde = parseFloat(objimportedesde.value);
  }
  if ( objcuentahastaid ){
    cuentahastaid = parseFloat( objcuentahastaid.value);
  }
  if ( objimportehasta ){
    importehasta = parseFloat(objimportehasta.value);
  }

  //
  // control de los parametros
  // -------------------------
  okvencimientoid = ( ! isNaN(Number(vencimientoid)) );
  oktipo          = ( typeof nombre == "string" && tipo != "" );
  oknombre        = ( typeof nombre == "string" && nombre != "" );
  okfecha         = ( typeof fecha == "string" );
  okcategoriaid   = ( ! isNaN(Number(categoriaid)) && categoriaid > 0 );
  okcuentadesdeid = ( ! isNaN(Number(cuentadesdeid)) && cuentadesdeid > 0 );
  okimportedesde  = ( ! isNaN(Number(importedesde)) && importedesde > 0 );
  okcuentahastaid = true;
  okimportehasta  = true;
  okcuentahastaid = ( tipo != "T" || ( ! isNaN(Number(cuentahastaid)) && cuentahastaid > 0 ));
  okimportehasta  =  ( tipo != "T" || ( ! isNaN(Number(importehasta)) && importehasta > 0 ));
  
  // marcar los campos si estan incorrectos
  // --------------------------------------
  if ( ! oknombre || nombre == "" ){
    objnombre.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okfecha ){
    objfecha.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! objcategoriaid ){
    objcategoriaid.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okcuentadesdeid ){
    objcuentadesdeid.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okimportedesde ){
    objimportedesde.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okcuentahastaid ){
    objcuentahastaid.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okimportehasta ){
    objimportehasta.classList.replace('w3-white', 'w3-pale-red');
  }
  // placeholders para indicar el error 
  // ----------------------------------
  if ( nombre == "" ){
    objnombre.setAttribute("placeholder", "No puede estar vacio el nombre");  
  }

  //
  // Si todo es correcto, grabar
  //
  if ( oktipo && oknombre && okfecha && okcuentadesdeid && okimportedesde && okcuentahastaid && okimportehasta && okcategoriaid ){

    // preparar datos para enviar
    objdatasend = { "vencimientoid" : vencimientoid, "tipo" : tipo, "nombre" : nombre, "fecha" : fecha, "categoriaid" : categoriaid, "cuentadesdeid" : cuentadesdeid, "importedesde" : importedesde, "cuentahastaid" : cuentahastaid, "importehasta" : importehasta};
    sdatasend = JSON.stringify(objdatasend);
    
    // Link para grabar
    link = "vencimiento_save.php?p=" + sdatasend ;
    
    // Invocar la busqueda de datos
    $.get( link, function( data ){ 
        var jsonData = JSON.parse(data);
        newlink = "vencimientos_abm.php?resp=" + jsonData.resultado;
        window.location.assign( newlink );
      } 
    );
  }
}

//---------------------------------------------------------
// Validar un vencimiento
//---------------------------------------------------------
function VencimientoSaveSimple(){
  // Levantar los datos del formulario
  var objvencimientoid = document.getElementById( 'vencimientoid' );
  var objfecha = document.getElementById( 'fecha' );
  var objtipo = document.getElementById( 'tipo' );
  var objcuentadesdeid = document.getElementById( "cuentadesdeid" );
  var objimportedesde = document.getElementById( 'importedesde' );
  var objcuentahastaid = document.getElementById( "cuentahastaid" );
  var objimportehasta = document.getElementById( 'importehasta' );

  var vencimientoid, tipo, fecha;
  var cuentadesdeid, importedesde, cuentahastaid, importehasta;
  var oknombre, okfecha, oktipo
  var okcuentadesdeid, okimportedesde, okcuentahastaid, okimportehasta;
  var link, newlink, objdatasend, sdatasend; 
  
  // Valores de parametros
  vencimientoid = 0;
  fecha         = "";
  tipo          = "";
  cuentadesdeid = 0;
  importedesde  = 0;
  cuentahastaid = 0;
  importehasta  = 0;
  
  if ( objvencimientoid ){
    vencimientoid = parseFloat( objvencimientoid.value );
  }
  if ( objtipo ){
    tipo = objtipo.value;
  }
  if ( objfecha ){
    fecha = objfecha.value;
  }
  if ( objcuentadesdeid ){
    cuentadesdeid = parseFloat( objcuentadesdeid.value);
  }
  if ( objimportedesde ){
    importedesde = parseFloat(objimportedesde.value);
  }
  if ( objcuentahastaid ){
    cuentahastaid = parseFloat( objcuentahastaid.value);
  }
  if ( objimportehasta ){
    importehasta = parseFloat(objimportehasta.value);
  }

  //
  // control de los parametros
  // -------------------------
  okvencimientoid = ( ! isNaN(Number(vencimientoid)) );
  okfecha         = ( typeof fecha == "string" );
  oktipo          = ( typeof tipo == "string" && tipo != "" );
  okcuentadesdeid = ( ! isNaN(Number(cuentadesdeid)) && cuentadesdeid > 0 );
  okimportedesde  = ( ! isNaN(Number(importedesde)) && importedesde > 0 );
  okcuentahastaid = true;
  okimportehasta  = true;
  okcuentahastaid = ( tipo != "T" || ( ! isNaN(Number(cuentahastaid)) && cuentahastaid > 0 ));
  okimportehasta  =  ( tipo != "T" || ( ! isNaN(Number(importehasta)) && importehasta > 0 ));
  
  // marcar los campos si estan incorrectos
  // --------------------------------------
  if ( ! okfecha ){
    objfecha.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okcuentadesdeid ){
    objcuentadesdeid.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okimportedesde ){
    objimportedesde.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okcuentahastaid ){
    objcuentahastaid.classList.replace('w3-white', 'w3-pale-red');
  }
  if ( ! okimportehasta ){
    objimportehasta.classList.replace('w3-white', 'w3-pale-red');
  }

  //
  // Si todo es correcto, grabar
  //
  if ( oktipo && okfecha && okcuentadesdeid && okimportedesde && okcuentahastaid && okimportehasta ){

    // preparar datos para enviar
    objdatasend = { "vencimientoid" : vencimientoid, "tipo" : tipo, "fecha" : fecha, "cuentadesdeid" : cuentadesdeid, "importedesde" : importedesde, "cuentahastaid" : cuentahastaid, "importehasta" : importehasta};
    sdatasend = JSON.stringify(objdatasend);
    
    // Link para grabar
    link = "vencimiento_save_simple.php?p=" + sdatasend ;
    
    // Invocar la busqueda de datos
    $.get( link, function( data ){ 
        var jsonData = JSON.parse(data);
        newlink = "main.php";
        window.location.assign( newlink );
      } 
    );
  }
}

//---------------------------------------------------------
// Validar un vencimiento
//---------------------------------------------------------
function DateToAnsi( fecha ){
  var anio, mes, dia, fechaAnsi;
  
  anio = hasta.getFullYear();
  mes = hasta.getMonth();
  dia = hasta.getDate();
  
  fechaAnsi = anio + "-" + mes + "-" + dia;
  return fechaAnsi;
}

