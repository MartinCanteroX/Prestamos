<?php

// -----------------------------------------
// Rutinas genericas 
// -----------------------------------------
class Utiles{
    
    // -----------------------------------------
    // Devolver el titulo a mostrar en la pantalla
    // -----------------------------------------
    public static function setTitulo( $titulo ) {
        $htmlaDevolver = "<div id='titulo'><h1 class='TituloDePantalla'>$titulo</h1></div>";
        $htmlaDevolver .= "<div class='clearfloat'></div>";
        return ( $htmlaDevolver );
    }
    
    // -----------------------------------------
    // Mensaje avmosiso
    // -----------------------------------------
    public static function Aviso( $cadena ) {
        echo "<H3 id='alerta'>$cadena</H3>" ;
        die();
    }
    
    // -----------------------------------------
    // Recuperar el parametro GET o su valor por defecto
    // -----------------------------------------
    public static function getParametroGet( $parametro, $valorDefault ) {
        $valorADevolver = "";
        $ok = false;
        
        if ( isset($_GET[ $parametro ])) {
            if ( gettype( $parametro) === gettype($valorDefault)){
                $valorADevolver = $_GET[ $parametro ];
                $ok = True;
            }
        }

        if ( ! $ok ){
            $valorADevolver = $valorDefault;
        }
        
        return ( $valorADevolver );
    }
    
    // -----------------------------------------
    // Recuperar el parametro GET o su valor por defecto
    // -----------------------------------------
    public static function getParametroPost( $parametro, $valorDefault ) {
        $valorADevolver = "";
        $ok = false;
        
        if ( isset($_POST[ $parametro ])) {
            if ( gettype( $parametro) === gettype($valorDefault)){
                $valorADevolver = $_POST[ $parametro ];
                $ok = true;
            }
        }

        if ( ! $ok ){
            $valorADevolver = $valorDefault;
        }
        
        return ( $valorADevolver );
    }

    // -----------------------------------------
    // Recuperar el plural de una palabra
    // -----------------------------------------
    public static function IrAPagina( $link ) {
        if ( ! $link ){
            return;
        }
        
        header("location: " . $link );

    }

    // -----------------------------------------
    // Usuario-name
    // -----------------------------------------
    public static function getUsuarioName(){
        $usuarioname = "";
        if ( isset($_SESSION['usuarioname'])){
            $usuarioname = $_SESSION['usuarioname'];
        }
        return $usuarioname;
    }

    // -----------------------------------------
    // Recuperar un parametro
    // -----------------------------------------
    public static function getParametro( $item_parametro, $default = '' ){
        $parametro = new parametro_model( $item_parametro);
        $ret = $default;
        if ( $parametro and ! $parametro->get_is_new()){
            $ret = $parametro->get_valor();
        }
        return $ret;
    }

    // -----------------------------------------
    // Generar un array sumarizando los datos
    // de un array con detalle
    // Se indica el campo del corte y el campo
    // del importe
    // Devuelve un array con el corte y la suma de los importes
    // -----------------------------------------
    public static function genResumen( $datos, $campocorte, $campoimporte ){

        // Array de las cuentas 
        $lista_resumen = array();
    
        foreach( $datos as $lista => $item){
            $datocorte = $item[ $campocorte ];
            $tipo      = $item[ 'tipo' ];
            $importe = floatval( $item[ $campoimporte ]);

            if ( $datocorte ){

                // Acumula por cuentaid 
                if ( ! isset($lista_resumen[$datocorte]) ){
                    $lista_resumen[$datocorte] = 0;
                } 
                if ( $tipo == 'E'){
                    $lista_resumen[$datocorte] -= $importe;
                }else{
                    $lista_resumen[$datocorte] += $importe;
                }
            }
        }
        
        return $lista_resumen;
    }

    // -----------------------------------------
    // Generar un total general del array
    // -----------------------------------------
    public static function genTotal( $datos, $columna ){

        // Array de las cuentas 
        $totalgeneral = 0;
    
        foreach( $datos as $indice => $importe ){
            $totalgeneral += $importe;
        }    

        return $totalgeneral;
    }

    // -----------------------------------------
    // Generar un total general del array asociativo
    // -----------------------------------------
    public static function genTotal2( $datos, $campo ){

        // Array de las cuentas 
        $totalgeneral = 0;
    
        foreach( $datos as $indice => $renglon ){
            $totalgeneral += $renglon[$campo];
        }    

        return $totalgeneral;
    }

    // --------------------------
    // Generar una lista de 2 columnas
    // col1 = dato // col2 = importe
    // --------------------------
    public static function genHtmlResumen( $datos, $titulocorte, $tituloimporte ){
        $totalgeneral = utiles::genTotal( $datos, 0);

        //
        // Generar la tabla 
        //
        $tablas         = new utilestablas();
        $htmlADevolver  = "";
        $htmlADevolver .= $tablas->Nueva();
        $htmlADevolver .= $tablas->SetTitulos( array( $titulocorte, $tituloimporte));
        
        // Dibujar 
        foreach( $datos as $item => $elimporte){
            $importe_valor    = $elimporte;
            $importe          = number_format ( floatval($importe_valor), 2, ",", "." );
            $color            = "";            
            $htmlADevolver .= $tablas->NuevaFila();
            $htmlADevolver .= $tablas->NuevoDato( $item );
            $htmlADevolver .= $tablas->NuevoDato( $importe, "text-right" );
        }

        // Total general
        $htmlADevolver .= $tablas->NuevaFila();
        $htmlADevolver .= $tablas->NuevoDato( "TOTAL", 'bg-secondary text-light' );
        $htmlADevolver .= $tablas->NuevoDato( number_format ( floatval($totalgeneral), 2, ",", "." ), "text-right bg-secondary text-light" );

        // Fin de la tabla
        $htmlADevolver .= $tablas->Fin();
  
        return $htmlADevolver;
    }
    // --------------------------
    // Determinar el mes actual
    // guardarlo en la session para mostrarlo
    // en el barra de titulo
    // --------------------------
    // Determinar el mes actual
    function SetMesActual($mes = 0, $anio = 0){
        $hoy = "";
        if ( $mes == 0){
            $hoy = fechas::Hoy();
            $mes = fechas::Mes( $hoy );
            $anio = fechas::anio( $hoy );
        }else{
            if ( $anio == 0){
                // Sin año, se asume el año actual
                $anio = fechas::anio( fechas::Hoy());
            }
        }
        
        // Setear fecha inicial y final del periodo
        $periodo_actual_desde = fechas::Bom( $hoy, $mes, $anio );
        $periodo_actual_hasta = fechas::Eom( $hoy, $mes, $anio );

        // Nombre del mes
        $nombre_mes = fechas::NombreMes( $hoy, $mes );

        // Guardar en la sesion
        $_SESSION['MesActual'] = $mes;
        $_SESSION['AnioActual'] = $anio;
        $_SESSION['NombreMes'] = $nombre_mes;
    }

    // -----------------------------------------
    // Recuperar el parametro GET o su valor por defecto
    // -----------------------------------------
    public static function getParametroGet2( $parametro, $valorDefault, $tipo ) {
        $valorADevolver = "";
        $ok = false;
        
        if ( isset($_GET[ $parametro ])) {
            //if ( gettype( $parametro) === gettype($valorDefault)){
                $valorADevolver = $_GET[ $parametro ];

                // test el tipo de dato de acuerdo al tipo indicado
                $ok = self::CheckVarTYpe( $tipo, $valorADevolver );
            //}
        }

        if ( ! $ok ){
            $valorADevolver = $valorDefault;
        }
        
        return ( $valorADevolver );
    }
    
    // -----------------------------------------
    // Recuperar el parametro GET o su valor por defecto
    // -----------------------------------------
    public static function getParametroPost2( $parametro, $valorDefault, $tipo ) {
        $valorADevolver = "";
        $ok = false;
        
        if ( isset($_POST[ $parametro ])) {
            //if ( gettype( $parametro) === gettype($valorDefault)){
                $valorADevolver = $_POST[ $parametro ];

                // test el tipo de dato de acuerdo al tipo indicado
                $ok = self::CheckVarTYpe( $tipo, $valorADevolver );

            //}
        }
        
        if ( ! $ok ){
            $valorADevolver = $valorDefault;
        }
        
        return ( $valorADevolver );
    }

    // -----------------------------------------
    // Verificar el tipo de dato de una variable
    // -----------------------------------------
    public static function CheckVarTYpe( $tipo, $valor ) {

        $result = false;

        switch( strtoupper($tipo) ){
            case "":
                $result = ( is_string( $valor ));
                break;
            
            case "N":
                $result = ( is_numeric( $valor ));
                break;
            
            case "L":
                $result = ( is_bool( $valor ));
                break;

            case "C":
                $result = ( is_string( $valor ));
                break;
                
            case "I":
                if ( gettype($valor) == "string" ){
                    $valor = floatval( $valor );
                }
                $result = ( is_int( $valor ));
                break;
            
            case "R":
                if ( gettype($valor) == "string" ){
                    $valor = floatval( $valor );
                }
                $result = (is_float( $valor ));
                break;
            
            case "T":
                $result = ( is_float( $valor ));
                break;
        }

        return $result;
    }
    
    // -----------------------------------------
    // Devolver el html de un aviso
    // -----------------------------------------
    public static function getAviso( $tipo, $leyenda ) {
        $htmlADevolver = "";
        $titulo = "";
        $color = "w3-green";
        
        if ( $tipo ){
            $titulo = "Operacion Exitosa !";
            $color = "w3-green";
        }else{
            $titulo = "Problemas con la operacion !";
            $color = "w3-red";
        }
        
        $htmlADevolver .= "<div id='id_alert' class='w3-panel w3-card-4 $color'>";
        $htmlADevolver .=   "<div class='w3-container'>";
        $htmlADevolver .=      "<span onclick='document.getElementById(\"id_alert\").style.display = \"none\"' class='w3-button w3-large w3-display-topright'>&times;</span>";
        $htmlADevolver .=      "<h2 class='p2'>$titulo</h2>";
        $htmlADevolver .=      "<h4 class='p2'>$leyenda</h4>";
        $htmlADevolver .=    "</div>";
        $htmlADevolver .= "</div>";

        return $htmlADevolver;
    }

    // -----------------------------------------
    // Convertir un valor logico a S / N
    // -----------------------------------------
    public static function LtoC( $valor ) {
        if ( ! $valor ){
            $ret = "N";
        }else{
            $ret = "S";
        }
        
        return $ret;
    }

    // -----------------------------------------
    // Convertir un valor Char a Logico
    // -----------------------------------------
    public static function CtoL( $valor ) {
        $ret = ( $valor == "S" );
        
        return $ret;
    }

    // -----------------------------------------
    // Recuperar o setear una variable global
    // -----------------------------------------
    public static function SessionVar( $var, $valor = "") {
        $ret = "";

        if ( ! $valor || $valor == "" ){
            // Sin valor especificado..solo esta consultando
            if ( isset( $_SESSION[ $var ])) {
                    $ret = $_SESSION[ $var ];
                }
        }else{
            // Esta actualizando ( nueva o existente )
            $_SESSION[ $var ] = $valor;
            $ret = $valor;
        }
        
        return $ret;
    }

    // -----------------------------------------
    // Eliminar una variable
    // -----------------------------------------
    public static function SessionVarDel( $var ) {
        unset( $_SESSION[ $var ]);
    }

    // -----------------------------------------
    // Devolver el prefijo para las variables
    // de sesion. Si no existe la toma de la DB
    // parametro: PREF-SES
    // -----------------------------------------
    public static function getPrefijoSession(){
        $prefijo_session = "";
        
        /*
        $parametro = new parametro("PREFIJO-SESSION");

        if ( ! $parametro ){
            $prefijo_session = "";
        }else{
            $prefijo_session = $parametro->get_valor();
        }
        */
        return $prefijo_session;
    }

    // -----------------------------------------
    // Devolver el valor de la variabla de la sesion
    // -----------------------------------------
    public static function getVarSession( $variable, $valordefault = "" ){

        $prefijo = self::getPrefijoSession();

        if ( ! isset( $_SESSION[ $prefijo . $variable ])){
            $valor = $valordefault;
        }else{
            $valor = $_SESSION[ $prefijo . $variable ];
        }

        return $valor;
    }

    // -----------------------------------------
    // Set el valor de la variabla de la sesion
    // -----------------------------------------
    public static function setVarSession( $variable, $valor ){

        // Recuperar el prefijo
        $prefijo = self::getPrefijoSession();

        // Set el valor 
        $_SESSION[ $prefijo . $variable ] = $valor;
    }

    // -----------------------------------------
    // Leer contenido de una carpeta y devolver 
    // un array 
    // -----------------------------------------
    public static function LoadFilesFromDir( $path ){        
        $listaarray = array();
        $currPath = getcwd();
        $realpath = $currPath . $path;

        // Obt�n los nombres de los archivos
        $archivos = scandir($realpath);
        if ( ! $archivos ){
            return false;
        }
        
        // Llenar el array ( devulve KEY y DATO iguales)
        foreach($archivos as $archivo) {
            if ( is_file($realpath . $archivo)){
                $listaarray[] = array( $archivo, $archivo );
            }
        }

        // if (is_dir($path)) {
        //     if ($dh = opendir($path)) {
        //         while (($file = readdir($dh)) !== false) {
        //             $listaarray[] = array( $file, $file );
        //         }
        //         closedir($dh);
        //     }
        // }        
        return $listaarray;
    }
}
