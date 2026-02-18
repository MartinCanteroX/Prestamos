<?php

// ==================================
// Administracion de los objetos de este tipo
// ==================================

class generadores{

    /* --------------------------
     Generar el listado de vencimientos de pagos 
     pendientes simple
     ( solo nombre, Fecha, icono de la cuenta e importe )
     Esta basada en la info recolectada por getData
     Se usa para el Mian
     --------------------------
    */
    public static function VencimientosSimple( $data, $tablaid = "" ){
        $tablas         = new utilestablasbs();
        $htmlADevolver  = "";
        $totalgeneral   = 0;
        $fechahoy       = fechas::hoy( false, true );

        // Iconos de Accion
        $icono_Confirmar = utiles::SessionVar("ICONOS_CONFIRMAR") . " text-dark";
        $icono_EditarSimple = utiles::SessionVar("ICONOS_EDITARSIMPLE"). " text-dark";
        $icono_Editar = utiles::SessionVar("ICONOS_EDITAR"). " text-dark";
        $icono_Eliminar = utiles::SessionVar("ICONOS_ELIMINAR"). " text-dark";

        // Links de acciones
        $linkbase    = "vencimiento_";
        $linkeditsimp= $linkbase . "editsimple";
        // $linkeditfull= $linkbase . "editfull";
        $linkconf    = $linkbase . "confirmar";
        $linkdelete  = $linkbase . "delete";
        
        $lista_vencimientos = $data;

        // Dibujar
        $htmlADevolver .= $tablas->Nueva( $tablaid, "sm", false, false, true, true, true );
        
        // Titulos de las columnas : Nombre, Fecha, Cuenta, Importe, (Confirmar), (Anular)
        $htmlADevolver .= $tablas->SetTitulos( array( "Nombre", "Fecha", "Importe", " ", " ", " "));

        // Dibujarlas
        foreach( $lista_vencimientos as $lista => $item){
        
            $id               = $item['id'];
            $tipo             = $item['tipo'];
            $nombre           = $item['nombre'];
            $fecha            = $item['vencimiento'];
            $mes              = substr( $fecha, 5,2);
            $dia              = substr( $fecha, 8,2);
            $fechamostrar     = $dia . "/" . $mes;
            $importe_valor    = $item['importe'];
            if ( $tipo == 'E'){
                $importe_valor  *= (-1);
            }     

            $importe          = number_format ( floatval($importe_valor), 2, ",", "." );
            $totalgeneral    += $importe_valor;
            $vencido          = ( $fecha <= $fechahoy );

            // si esta vencido, mostrar en otro color
            // si es ingreso o egreso cambia el color
            $colorfont = "text-danger";
            $colorimporte = $colorfont;
            $colorback = "";
            if ( $vencido and $tipo <> 'I' ){
                $colorimporte   = "text-danger";
                $colorback      = "bg-danger";
                $colorfont      = "text-white";
            }
            if ( $vencido and $tipo == 'I' ){
                $colorimporte   = "text-danger";
                $colorback      = "bg-warning";
                $colorfont      = "text-white";
            }
            if ( $tipo == 'I'){
                $colorimporte   = "text-success";
                $colorfont      = "text-success";
            }
            if ( $tipo == 'T'){
                $colorimporte = "text-primary";
                $colorfont      = "text-primary";
            }
            
            $htmlADevolver .= $tablas->NuevaFila("col-12"); 
            $htmlADevolver .= $tablas->NuevoDato( $nombre       , $colorfont . " " . $colorback . " col-8");
            $htmlADevolver .= $tablas->NuevoDato( $fechamostrar , $colorfont . " " . $colorback . " text-center col-2");
            $htmlADevolver .= $tablas->NuevoDato( $importe      , $colorimporte . " " . $colorback . " text-right col-2");
            $htmlADevolver .= $tablas->NuevoDatoAccionBoton( $icono_EditarSimple . " col-1", $linkeditsimp  , "Editar monto y fecha", $id );
            $htmlADevolver .= $tablas->NuevoDatoAccionBoton( $icono_Confirmar    . " col-1", $linkconf      , "Confirmar vencimiento", $id );
            $htmlADevolver .= $tablas->NuevoDatoAccionBoton( $icono_Eliminar     . " col-1", $linkdelete    , "Eliminar el vencimiento", $id );
            $htmlADevolver .= $tablas->FinFila();
        }
        
        // Total general
        // $htmlADevolver .= $tablas->NuevaFila();
        $htmlADevolver .= $tablas->NuevaFila();
        $htmlADevolver .= $tablas->NuevoDato( "TOTAL", "bg-danger text-light" );
        $htmlADevolver .= $tablas->NuevoDato( "", "bg-danger text-light" );
        $htmlADevolver .= $tablas->NuevoDato( number_format ( floatval($totalgeneral), 2, ",", "." ), "text-right bg-danger text-light" );

        // Fin de la tabla
        $htmlADevolver .= $tablas->Fin();
  
        return $htmlADevolver;
    }

    /* --------------------------
     Generar el listado de vencimientos pendientes y devolverlo 
     Data = son los movimientos conseguidos con el metodo
     getData de esta clase ( array con los vencimientos )
     Se usa para el informe de Vencimientos
     --------------------------
    */
    public static function getHtmlVencimientos( $lista_vencimientos, $btnConf = true, $btnEdtImporte = true, $btnEdt = true, $btnDel = true ){
        $tablas         = new utilestablasbs();
        $htmlADevolver  = "";
        $htmlADevolver .= $tablas->Nueva("", "sm", true, false, true, true, false   );
        
        // Titulos de las columnas
        $titulos = array( "Nombre", "Fecha", "Tipo", "Importe", "Categoria", " ", "Cuenta" );
        if ($btnConf){
            $titulos[] = " ";
        }
        if ($btnEdtImporte){
            $titulos[] = " ";
        }
        if ($btnEdt){
            $titulos[] = " ";
        }
        if ($btnDel){
            $titulos[] = " ";
        }
        // $htmlADevolver .= $tablas->SetTitulos( array( "Nombre", "Fecha", "Tipo", "Importe", "Categoria", " ", "Cuenta", "  ", "  ", "  ","  "));
        $htmlADevolver .= $tablas->SetTitulos( $titulos );

        // Fecha de hoy
        $hoy = fechas::Hoy(true);

        // Traer lista de cuentas
        $cuentas = new cuentas_model();
        $cuentas->setLista();

        // Iconos de Accion
        $icono_Confirmar = utiles::SessionVar("ICONOS_CONFIRMAR");
        $icono_EditarSimple = utiles::SessionVar("ICONOS_EDITARSIMPLE");
        $icono_Editar = utiles::SessionVar("ICONOS_EDITAR");
        $icono_Eliminar = utiles::SessionVar("ICONOS_ELIMINAR");

        // Links de acciones
        $linkbase    = "vencimientos";
        $linkeditsimp = $linkbase . "_editsimple";
        $linkeditfull = $linkbase . "_editfull";
        $linkconf     = $linkbase . "_confirmar";
        $linkdelete   = $linkbase . "_delete";

        // Dibujarlas
        foreach( $lista_vencimientos as $lm => $vencimiento ){
        
            $id               = $vencimiento['id'];
            $nombre           = $vencimiento['nombre'];
            $fecha            = $vencimiento['vencimiento'];
            $tipo             = strtoupper($vencimiento['tipo']);
            $importe_valor    = $vencimiento['importe'];
            $importe          = number_format ( floatval($importe_valor), 2, ",", "." );
            $categoriaid      = $vencimiento['categoriaid'];
            $categorianombre  = $vencimiento['categorianombre'];
            $cuentaid         = $vencimiento['cuentaid'];
            $cuentanombre     = $vencimiento['cuentanombre'];
            $color_importe    = "text-danger";
            $color_fecha      = "";
            if ( $fecha <= $hoy ){
                $color_fecha = 'text-danger';
            }

            // Tipo de movimiento
            $tiponombre = "";
            if ( $tipo == 'I'){
                $tiponombre = "Ingreso";
                $color_importe = "w3-green";
            }
            if ( $tipo == 'E'){
                $tiponombre = "Egreso";
                $color_importe = "w3-red";
            }
            if ( $tipo == 'T'){
                $tiponombre = "Transferencia";
                $color_importe = "w3-light-blue";
            }
            /*
            if ( $tipo == "I"){
                $color_importe = "text-primary";
            }
            */

            // Cuenta
            $cuenta = $cuentas->getFromLista( $cuentaid );
            $iconocuenta = $cuenta->get_icono();

            $htmlADevolver .= $tablas->NuevaFila();
            $htmlADevolver .= $tablas->NuevoDato( $nombre, $color_fecha );
            $htmlADevolver .= $tablas->NuevoDato( $fecha, $color_fecha );
            $htmlADevolver .= $tablas->NuevoDato( $tiponombre, $color_fecha );
            $htmlADevolver .= $tablas->NuevoDato( $importe, "text-right $color_importe" );
            $htmlADevolver .= $tablas->NuevoDato( $categorianombre );
            $htmlADevolver .= $tablas->NuevoDatoImagen( BASE_URL_IMG . $iconocuenta );
            $htmlADevolver .= $tablas->NuevoDato( $cuentanombre );
            
            // Botones de accion (se puede personalizar cual mostrar y cual no)
            if ($btnConf){
                $htmlADevolver .= $tablas->BotonClassJs(  $icono_Confirmar . " accion.vtos.confirmar" ,  "Confirmar vencimiento", $id );
            }
            if ($btnEdtImporte){
                $htmlADevolver .= $tablas->BotonClassJs( $icono_EditarSimple . " accion.vtos.editar",    "Editar monto y vencimiento", $id  );
            }
            if ($btnEdt){
                $htmlADevolver .= $tablas->BotonClassJs( $icono_Editar       . " accion.vtos.editar" ,  "Editar datos del vencimiento", $id  );
            }
            if ($btnDel){
                $htmlADevolver .= $tablas->BotonClassJs( $icono_Eliminar     . " accion.vtos.eliminar" ,  "Eliminar vencimiento", $id  );
            }
        }
        
        // Fin de la tabla
        $htmlADevolver .= $tablas->Fin();
                
        return $htmlADevolver;

    }

    /* --------------------------
     Generar una lista con las fechas
     y la suma de los vencimientos 
     --------------------------
    */
    public static function VencimientosPorFecha( $data ){
        $totalgeneral = utiles::genTotal( $data, 0);
        $hoy     = fechas::Hoy(false, false);

        //
        // Generar la tabla 
        //
        $tablas         = new utilestablasbs();
        $htmlADevolver  = "";
        $htmlADevolver .= $tablas->Nueva("", "sm", true, false, true, true, false   );
        $htmlADevolver .= $tablas->SetTitulos( array( "Fecha", "Importe"));
        
        // Dibujar 
        foreach( $data as $lafecha => $elimporte){
            $fecha            = $lafecha;
            $importe_valor    = $elimporte; 
            $importe          = number_format ( floatval($importe_valor), 2, ",", "." );
            $color            = "text-black";
            $link             = BASE_URL . "vencimientos/getVencimientosDeFecha/" . $fecha;
            if ( $fecha <= $hoy){
                $color = "text-danger";
            }
            
            // control
            if ( ! $fecha ){
                var_dump( $data );
                utiles::Aviso("Fecha invalida con el importe " . $importe_valor . " (getHtmlVencimientosPorFecha)");
            }

            $htmlADevolver .= $tablas->NuevaFila("col-12");
            $htmlADevolver .= $tablas->NuevoDato( $fecha, $color . " col-8 text-center", $link );
            $htmlADevolver .= $tablas->NuevoDato( $importe, "text-right $color col-4", $link );
            $htmlADevolver .= $tablas->FinFila();
        }

        // Total general
        $htmlADevolver .= $tablas->NuevaFila();
        $htmlADevolver .= $tablas->NuevoDato( "TOTAL", "bg-secondary text-light" );
        $htmlADevolver .= $tablas->NuevoDato( number_format ( floatval($totalgeneral), 2, ",", "." ), "text-right bg-secondary text-light" );

        // Fin de la tabla
        $htmlADevolver .= $tablas->Fin();
  
        return $htmlADevolver;
    }

    /* --------------------------
     Generar una lista con las cuentas
     y la suma de los vencimientos por
     cada una 
     --------------------------
    */
    public static function VencimientosPorCuenta( $data ){
        $totalgeneral = utiles::genTotal( $data, 0);
        $cuentas      = new cuentas_model();
        $cuentas->setLista();

        //
        // Generar la tabla 
        //
        $tablas         = new utilestablasbs();
        $htmlADevolver  = "";
        $htmlADevolver .= $tablas->Nueva( "", "sm", true, false, true, true, false);
        $htmlADevolver .= $tablas->SetTitulos( array( " ", "Cuenta", "Importe", " "));
        
        // Dibujar 
        foreach( $data as $cuentaid => $elimporte){
            $importe_valor    = $elimporte;
            $cuenta           = $cuentas->getFromLista($cuentaid);
            $link             = BASE_URL . "vencimientos/getVencimientosDeCuenta/" . $cuentaid;

            // control
            if ( ! $cuenta ){
                var_dump( $data );
                utiles::Aviso("Cuenta invalida con el importe " . $importe_valor . " (getHtmlVencimientosPorCuenta)");
            }
            
            $importe          = number_format ( floatval($importe_valor), 2, ",", "." );
            $iconocuenta      = $cuenta->get_icono();
            $cuentanombre     = $cuenta->get_nombre();
            
            $htmlADevolver .= $tablas->NuevaFila("col-12");
            $htmlADevolver .= $tablas->NuevoDatoImagen( BASE_URL_IMG . $iconocuenta, " col-1");
            $htmlADevolver .= $tablas->NuevoDato( $cuentanombre, "col-7", $link );
            $htmlADevolver .= $tablas->NuevoDato( $importe, "text-right col-4", $link );
        }

        // Total General
        $htmlADevolver .= $tablas->NuevaFila();
        $htmlADevolver .= $tablas->NuevoDato( "TOTAL", "bg-secondary text-light" );
        $htmlADevolver .= $tablas->NuevoDato( "", "bg-secondary");
        $htmlADevolver .= $tablas->NuevoDato( number_format ( floatval($totalgeneral), 2, ",", "." ), "text-right bg-secondary text-light" );
        $htmlADevolver .= $tablas->FinFila();

        // Fin de la tabla
        $htmlADevolver .= $tablas->Fin();
  
        return $htmlADevolver;
    }

    /* ----------------------------
     Generar la tabla con los movimientos
     $data son los movimientos recibidos y
     con eso dibuja una tabla
     ----------------------------
    */
    public static function MainMovs( $data, $linkNuevo = "", $soloLectura = false){
        $htmlADevolver = "";
        $tablas = new utilestablasbs();
        $baselink = " accion.movs.";
        $linkAnulacion  = $baselink . "eliminar";
        $linkEdicion    = $baselink . "editar";

        // Preparar datos
        $cuentas = new cuentas_model();
        $cuentas->setLista();
        $icono_editar = utiles::SessionVar("ICONOS_EDITAR"). " text-dark";
        $icono_eliminar = utiles::SessionVar("ICONOS_ELIMINAR"). " text-dark";

        // Arranca
        $htmlADevolver .= $tablas->Nueva( "", "sm", true, false, true, true, false );

        // Titulos de las columnas
        if ( ! $soloLectura){
            $htmlADevolver .= $tablas->SetTitulos( array( "Nombre", "Fecha", "Importe", " ", "Cuenta", "  ","  "));
        }else{
            $htmlADevolver .= $tablas->SetTitulos( array( "Nombre", "Fecha", "Importe", " ", "Cuenta"));
        }

        // Dibujarlas
        $totalimportes = 0;
        foreach( $data as $lm => $mov ){
            $id             = $mov['id'];
            $tipo           = $mov['tipo'];
            $nombre         = $mov['nombre'];
            $importe0       = $mov['importe'];
            $cuentaid       = $mov['cuentaid'];
            $cuenta_nombre  = $mov['cuentanombre'];
            $importe        = floatval( $importe0 );            
            $fecha          = $mov['fecha'];        
                        
            if ( floatval( $importe ) <> 0 and ($cuenta_nombre) ){
                
                // Color del movimiento, links de las acciones
                $color_mov = "text-sucess";
                if ( $tipo == 'E'){
                    $color_mov = "text-danger";
                    $importe  *= (-1);
                }
                $totalimportes += $importe;
                $importe        = number_format( $importe, 2, ",", ".");
                $icono          = "";

                $cuenta         = $cuentas->getFromLista($cuentaid);
                if ( $cuenta ){
                    $icono      = $cuenta->get_icono();
                }
                
                $htmlADevolver .= $tablas->NuevaFila("col-12");
                $htmlADevolver .= $tablas->NuevoDato( $nombre, $color_mov . " col-5" );
                $htmlADevolver .= $tablas->NuevoDato( $fecha, $color_mov . " col-2" );
                $htmlADevolver .= $tablas->NuevoDato( $importe, "text-right $color_mov" . " col-2");
                $htmlADevolver .= $tablas->NuevoDatoImagen( BASE_URL_IMG . $icono, "col-1"  );
                $htmlADevolver .= $tablas->NuevoDato( $cuenta_nombre, $color_mov . " col-2");
                if ( ! $soloLectura){
                    $htmlADevolver .= $tablas->BotonClassJs( $icono_editar . $linkEdicion, "Editar datos", $id );
                    $htmlADevolver .= $tablas->BotonClassJs( $icono_eliminar . $linkAnulacion, "Anular movimiento", $id);
                }
                $htmlADevolver .= $tablas->FinFila();
            }
        }

        // Fin de la tabla
        $htmlADevolver .= $tablas->Fin();

        return $htmlADevolver;

    }

    /* --------------------------
     Devolver los saldos de las cuentas con 
     graficos de barra horizontales
     En cada renglon ira el nombre de la cuenta 
     y dentro de la barra el saldo
     Cada cuenta sera un div con 2 columnas ( texto y barra )
     --------------------------
    */
    public static function MainCuentasSaldos( $data ){
        $htmlADevolver = "";
        $tablas = new utilestablasbs();

        // Iconos de Accion
        $icono_FolderOpen = utiles::SessionVar("ICONOS_FOLDEROPEN");
        $icono_EditarSimple = utiles::SessionVar("ICONOS_EDITARSIMPLE"). " text-dark";
        
        // Recuperar la lista de cuentas
        $lista_cuentas = $data;
        $linkbase      = "cuentas_";
        $linkMovs      = "movimientos/getdecuenta/";
        $linkMovs      = $linkbase . "vermovimientos";
        $linkeditsaldo = $linkbase . "ajustarsaldo";
        
        $nrodecolor = 1;

        // Averiguar el saldo mayor absoluto
        $maximo_importe = 0;
        foreach( $lista_cuentas as $lm => $cuenta ){        
            $saldo = $cuenta->get_saldo();
            if ( abs($saldo) > $maximo_importe ){
                $maximo_importe = abs($saldo);
            }
        }        
        
        $htmlADevolver .= $tablas->Nueva( "", "sm", true, false, true, true, false );
        $htmlADevolver .= $tablas->SetTitulos( array("Cuenta", "Saldo", " ", " "));

        // Dibujarlas
        foreach( $lista_cuentas as $lm => $cuenta ){
            
            $color = "";
            $saldo = floatval($cuenta->get_saldo());
            $id    = $cuenta->get_id();
            $porcentaje_sobre_total = 0;
            if ($maximo_importe > 0){
                $porcentaje_sobre_total = $saldo / $maximo_importe * 100;
            }
            if ( $saldo > 0){
                //$clasecolorbarra = " text-success";
                $clasecolorfuente = " text-success";
            }else{                
                //$clasecolorbarra = " bg-danger";
                $clasecolorfuente = " text-danger";
            }
            
            $htmlADevolver .= $tablas->NuevaFila("col-12");
            $htmlADevolver .= $tablas->NuevoDato( $cuenta->get_nombre(), "col-8");
            $htmlADevolver .= $tablas->NuevoDato( number_format( $saldo, 2, ",", "." ), $clasecolorfuente . " text-right");
            $htmlADevolver .= $tablas->NuevoDatoAccionBoton( $icono_EditarSimple . " col-1", $linkeditsaldo  , "Editar Saldo", $id );
            // $htmlADevolver .= $tablas->NuevoDatoAccion( $icono_FolderOpen . " col-1", $linkMovs . $id, "Ver movimientos");
            $htmlADevolver .= $tablas->NuevoDatoAccionBoton( $icono_FolderOpen . " col-1", $linkMovs, "Ver movimientos", $id);
            $htmlADevolver .= $tablas->FinFila();
        }        
        
        $htmlADevolver .= $tablas->Fin();
        
        return $htmlADevolver;
        
    }

    /* --------------------------
     Generar el listado de planificaciones y devolverlo 
     Data = son los movimientos conseguidos con el metodo
     getData de esta clase ( array con las planificaciones )
     --------------------------
    */
    public static function getHtmlPlanificaciones( $lista_planificaciones ){
        $tablas         = new utilestablasbs();
        $htmlADevolver  = "";
        $htmlADevolver .= $tablas->Nueva("", "sm", true, false, true, true, false   );

        // Titulos de las columnas
        $htmlADevolver .= $tablas->SetTitulos( array( "Nombre", "Tipo", "Frecuencia", "Importe", "Categoria", "de Cuenta", "a Cuenta", "  ","  "));

        // Iconos de Accion
        $icono_Editar = utiles::SessionVar("ICONOS_EDITAR");
        $icono_Eliminar = utiles::SessionVar("ICONOS_ELIMINAR");
        
        // Links
        $linkEditar = "planificacion_editar";
        $linkEliminar = "planificacion_eliminar";

        // Dibujarlas
        foreach( $lista_planificaciones as $plan => $una_planif ){

            $nombre           = $una_planif['nombre'];
            $tipo             = $una_planif['tipo'];
            $tiponombre       = $una_planif['tiponombre'];
            $id               = $una_planif['id'];
            $frecuencianombre = $una_planif['frecuencianombre'];
            // $diadelmes        = 0;
            // $diasemana        = 0;
            // $repeticiones     = 0;
            $importe          = $una_planif['importe'];
            $importe          = number_format ( floatval($importe), 2, ",", "." );

            // $importehasta     = $una_planif['importe'];
            // $decuenta         = $una_planif['cuentaidde'];
            // $cuentahasta      = $una_planif['cuentaida'];
            // $categoria        = $una_planif['categoriaid'];
            $decuentanombre   = $una_planif['de_cuentanombre'];
            $acuentanombre    = $una_planif['a_cuentanombre'];
            $categorianombre  = $una_planif['categorianombre'];

            // Color segun su tipo
            switch ( strtoupper($tipo)){
            case "I":
                $color = "w3-green";
                break;
            case "E":
                $color = "w3-red";
                break;
            case "T":
                $color = "w3-light-blue";
                break;
            }

            $htmlADevolver .= $tablas->NuevaFila();
            $htmlADevolver .= $tablas->NuevoDato( $nombre );
            $htmlADevolver .= $tablas->NuevoDato( $tiponombre );
            $htmlADevolver .= $tablas->NuevoDato( $frecuencianombre );
            $htmlADevolver .= $tablas->NuevoDato( $importe, "text-right $color" );
            $htmlADevolver .= $tablas->NuevoDato( $categorianombre );
            $htmlADevolver .= $tablas->NuevoDato( $decuentanombre );

            // a cuenta
            if ($tipo == 'T'){
                $htmlADevolver .= $tablas->NuevoDato( $acuentanombre );
            }else{
                $htmlADevolver .= $tablas->NuevoDato( "   " );
            }

            // Acciones
            $htmlADevolver .= $tablas->BotonClassJs( $icono_Editar . " accion_editar"  , "Editar datos", $id );
            $htmlADevolver .= $tablas->BotonClassJs( $icono_Eliminar . " accion_eliminar", "Eliminar la planificacion", $id );
        }

        // Fin de la tabla
        $htmlADevolver .= $tablas->Fin();

        return $htmlADevolver;
    }

    /* --------------------------
     Generar el listado de monedas
     getData de esta clase ( array con las monedas )
     --------------------------
    */
    public static function getHtmlMonedas($lista_monedas){

        $tablas         = new utilestablasbs();
        $htmlADevolver  = "";
        $htmlADevolver .= $tablas->Nueva("", "sm", true, false, true, true, false);

        $icono_Editar = utiles::SessionVar("ICONOS_EDITAR");
        $icono_Eliminar = utiles::SessionVar("ICONOS_ELIMINAR");

        // Dibujarlas
        foreach ($lista_monedas as $lm => $moneda) {
            $htmlADevolver .= $tablas->NuevaFila();
            $htmlADevolver .= $tablas->NuevoDato($moneda->get_abreviatura());
            $htmlADevolver .= $tablas->NuevoDato($moneda->get_nombre());
            $htmlADevolver .= $tablas->NuevoDato($moneda->get_simbolo());
            $htmlADevolver .= $tablas->NuevoDato($moneda->get_saldo());
            $htmlADevolver .= $tablas->NuevoDatoImagen( BASE_URL_IMG . $moneda->get_icono());
            $htmlADevolver .= $tablas->NuevoDatoAccionJs( $icono_Editar  , "monedas_editar"  , "Editar datos"      , $moneda->get_id());
            $htmlADevolver .= $tablas->NuevoDatoAccionJs( $icono_Eliminar, "monedas_eliminar", "Eliminar la moneda", $moneda->get_id());
        }

        // Fin de la tabla
        $htmlADevolver .= $tablas->Fin();

        return $htmlADevolver;
    }

    /* --------------------------
     Generar el listado de cuentas
     --------------------------
    */
    public static function getHtmlCuentas($lista_cuentas){

        $tablas = new utilestablasbs();
        $forms  = new utilesforms();
        $htmlADevolver = "";
        $htmlADevolver .= $tablas->Nueva("", "sm", true, false, true, true, false);
        
        // Titulos de las columnas
        $htmlADevolver .= $tablas->InicioTitulos();
        $htmlADevolver .= $tablas->NuevaColumna(" ");
        $htmlADevolver .= $tablas->NuevaColumna("Nombre" , "col-xs-3");
        $htmlADevolver .= $tablas->NuevaColumna("Abrev"  , "col-xs-2");
        $htmlADevolver .= $tablas->NuevaColumna("Moneda" , "col-xs-2");
        $htmlADevolver .= $tablas->NuevaColumna("Saldo"  , "col-xs-2");
        $htmlADevolver .= $tablas->NuevaColumna("Cierre" , "col-xs-2");
        $htmlADevolver .= $tablas->NuevaColumna("Tipo"   , "col-xs-1"); 
        $htmlADevolver .= $tablas->NuevaColumna(" ", "col-xs-1");   // detalle
        $htmlADevolver .= $tablas->NuevaColumna(" ", "col-xs-1");   // editar
        $htmlADevolver .= $tablas->NuevaColumna(" ", "col-xs-1");   // eliminar
        $htmlADevolver .= $tablas->NuevaColumna(" ", "col-xs-1");   // editar cierre
        $htmlADevolver .= $tablas->FinTitulos();

        // Iconos de Accion
        $icono_FolderOpen   = utiles::SessionVar("ICONOS_FOLDEROPEN") . " accion.vermovs";
        $icono_Editar       = utiles::SessionVar("ICONOS_EDITAR") . " accion.editar";
        $icono_Eliminar     = utiles::SessionVar("ICONOS_ELIMINAR") . " accion.eliminar";
        $icono_EditarCierre = utiles::SessionVar("ICONOS_EDITARSIMPLE") . " accion.editarCierre";
        $linkbase           = "cuentas";
        $linkedit           = $linkbase . "/editar/";

        // Dibujarlas
        foreach( $lista_cuentas as $lm => $cuenta ){
            $cuentaid       = $cuenta->get_id();
            $color          = "";
            $saldo          = floatval($cuenta->get_saldo());
            $tipodecuenta   = $cuenta->get_tipodecuenta();
            $iconocuenta    = $cuenta->get_icono();
            if ( $saldo > 0 ){
                $color = "text-primary";
            }elseif ( $saldo < 0 ){
                $color = "text-danger";
            }

            // Icono de tipo de cuenta
            $iconotipo = "cuentas-otros.png";
            switch ($tipodecuenta){
                case "X":
                    $iconotipo = "cuentas-otros.png";
                    break;
                case "D":
                    $iconotipo = "cuentas-fondos.png";
                    break;
                case "C":
                    $iconotipo = "cuentas-credito.png";
                    break;
                case "E":
                    $iconotipo = "cuentas-efectivo.png";
                    break;
            }

            $htmlADevolver .= $tablas->NuevaFila();
            $htmlADevolver .= $tablas->NuevoDatoImagen( BASE_URL_IMG . $iconocuenta);
            $htmlADevolver .= $tablas->NuevoDato( $cuenta->get_nombre());
            $htmlADevolver .= $tablas->NuevoDato( $cuenta->get_abreviatura());
            $htmlADevolver .= $tablas->NuevoDato( $cuenta->get_moneda()->get_nombre());
            $htmlADevolver .= $tablas->NuevoDato( number_format( $saldo, 2, ",", thousands_separator: "." ), "text-right $color");
            $htmlADevolver .= $tablas->NuevoDato( $cuenta->get_fechacierremensual());
            if ( $iconotipo ){
                $htmlADevolver .= $tablas->NuevoDatoImagen( BASE_URL_IMG . $iconotipo);
            }else{
                $htmlADevolver .= "     ";
            }
            $htmlADevolver .= $tablas->BotonClassJs( $icono_FolderOpen   , "Ver movimientos", $cuentaid, );
            $htmlADevolver .= $tablas->BotonClassJs( $icono_Editar       , "Editar datos", $cuentaid, );
            $htmlADevolver .= $tablas->BotonClassJs( $icono_Eliminar     , "Eliminar la cuenta", $cuentaid );
            $htmlADevolver .= $tablas->BotonClassJs( $icono_EditarCierre , "Editar Cierre", $cuentaid );
        }

        // Fin de la tabla
        $htmlADevolver .= $tablas->Fin();

        return $htmlADevolver;
      
    }    

    /* --------------------------
     Generar el listado de categorias
     --------------------------
    */
    public static function getHtmlCategorias($lista_categorias){

        $tablas = new utilestablasbs();
        $icono_Editar = utiles::SessionVar("ICONOS_EDITAR");
        $icono_Eliminar = utiles::SessionVar("ICONOS_ELIMINAR");
        
        $htmlADevolver = "";
        $htmlADevolver .= $tablas->Nueva("", "sm", true, false, true, true, false);
        
        // Titulos de las columnas
        $htmlADevolver .= $tablas->SetTitulos( array( "Nombre", "  ","  "));
        
        // Dibujarlas
        foreach( $lista_categorias as $lm => $categoria ){
            $htmlADevolver .= $tablas->NuevaFila();
            $htmlADevolver .= $tablas->NuevoDato( $categoria->get_nombre());
            $htmlADevolver .= $tablas->NuevoDatoAccionJs2( $icono_Editar, "categorias_editar" , "Editar categoria", $categoria->get_id());
            $htmlADevolver .= $tablas->NuevoDatoAccionJs2( $icono_Eliminar, "categorias_eliminar" , "Eliminar la categoria", $categoria->get_id());
        }
                
        // Fin de la tabla
        $htmlADevolver .= $tablas->Fin();
        
        return $htmlADevolver;
        
    }

    /* --------------------------
     Generar el listado de transferencias
     --------------------------
    */
    public static function getHtmlTransferencias($lista_transferencias){
        $htmlADevolver = "";
        $tablas = new utilestablasbs();
        
        // Preparar datos
        $cuentas = new cuentas_model();
        $cuentas->setLista();
        $icono_Editar = utiles::SessionVar("ICONOS_EDITAR");
        $icono_Eliminar = utiles::SessionVar("ICONOS_ELIMINAR");
        
        $htmlADevolver .= $tablas->Nueva( "", "sm", true, false, true, true, false );
        
        // Titulos de las columnas
        $htmlADevolver .= $tablas->SetTitulos( array( "Fecha", "Nombre", "Categoria", "Descripcion", "de Cuenta", "  ", "Importe", "a Cuenta", "  ","  ","  "));
                
        // Dibujarlas
        foreach( $lista_transferencias as $lm => $una_transf ){
            $fecha          = $una_transf['fecha'];
            $nombre         = $una_transf['nombre'];
            $categoria      = $una_transf['categorianombre'];
            $descripcion    = $una_transf['descripcion'];
            $decuenta       = $una_transf['deCuentaNombre'];
            $decuentaid     = $una_transf['deCuentaid'];
            $acuenta        = $una_transf['aCuentaNombre'];
            $acuentaId      = $una_transf['aCuentaid'];
            $importe        = $una_transf['importe'];
            $id             = $una_transf['id'];

            // Iconos de las cuentas
            $cuenta = $cuentas->getFromLista($decuentaid);
            if ( $cuenta ){
                $iconodeCuenta = $cuenta->get_icono();
            }
            $cuenta = $cuentas->getFromLista($acuentaId);
            if ( $cuenta ){
                $iconoaCuenta = $cuenta->get_icono();
            }

            // Dibujar
            $htmlADevolver .= $tablas->NuevaFila();
            $htmlADevolver .= $tablas->NuevoDato( $fecha );
            $htmlADevolver .= $tablas->NuevoDato( $nombre);
            $htmlADevolver .= $tablas->NuevoDato( $categoria );
            $htmlADevolver .= $tablas->NuevoDato( $descripcion );
            $htmlADevolver .= $tablas->NuevoDato( $decuenta );
            $htmlADevolver .= $tablas->NuevoDatoImagen( BASE_URL_IMG . $iconodeCuenta );
            $htmlADevolver .= $tablas->NuevoDato( $importe );
            $htmlADevolver .= $tablas->NuevoDato( $acuenta );
            $htmlADevolver .= $tablas->NuevoDatoImagen( BASE_URL_IMG . $iconoaCuenta );
        
            $htmlADevolver .= $tablas->NuevoDatoAccion( $icono_Editar, "transferencias_edit.php?id=" . $id, "Editar datos" );
            $htmlADevolver .= $tablas->NuevoDatoAccion( $icono_Eliminar, "transferencias_del.php?id=" . $id, "Eliminar el movimiento" );
            
        }
                
        // Fin de la tabla
        $htmlADevolver .= $tablas->Fin();
        return $htmlADevolver;        

    }

    /* --------------------------
     Generar el resumen de movimientos por fecha
     --------------------------
    */
    public static function MovsPorFecha( $data ){
        // Recuperar la lista de proximos vencimientos
        if ( ! $data ){
            return "";
        }
        $lista_movs    = $data;
        $totalgeneral  = 0;
        $lista_fechas  = utiles::genResumen( $lista_movs, 'fecha', 'importe');
        $totalgeneral  = utiles::genTotal( $lista_fechas, 0);
        if ( $lista_fechas ){
            ksort($lista_fechas);
        }
        
        //
        // Generar la tabla 
        //
        $tablas         = new utilestablasbs();
        $htmlADevolver  = $tablas->Nueva("", "sm", true, false, true, true, false);
        $htmlADevolver .= $tablas->SetTitulos( array( "Fecha", "% Total", "Importe" ));
        
        // Dibujar 
        foreach( $lista_fechas as $lafecha => $elimporte){
            $fecha            = $lafecha;
            $importe_valor    = $elimporte;
            $importe          = number_format ( floatval($importe_valor), 2, ",", "." );            
            $htmlADevolver   .= $tablas->NuevaFila();
            $htmlADevolver   .= $tablas->NuevoDato( $fecha );
            $htmlADevolver   .= $tablas->BarraDeProgreso( $importe_valor/$totalgeneral*100 );
            $htmlADevolver   .= $tablas->NuevoDato( $importe, "text-right" );
            $htmlADevolver   .= $tablas->FinFila();
        }

        // Total general
        $htmlADevolver .= $tablas->NuevaFila();
        $htmlADevolver .= $tablas->NuevoDato( "TOTAL", "bg-secondary text-light" );
        $htmlADevolver .= $tablas->NuevoDato( number_format ( floatval($totalgeneral), 2, ",", "." ), "text-right bg-secondary text-light" );

        // Fin de la tabla
        $htmlADevolver .= $tablas->Fin();
    
        return $htmlADevolver;
    
    }
    public static function VtosPorFecha( $data ){
        // Recuperar la lista de proximos vencimientos
        if ( ! $data ){
            return "";
        }
        $lista_movs    = $data;
        $totalgeneral  = 0;
        $lista_fechas  = utiles::genResumen( $lista_movs, 'vencimiento', 'importe');
        $totalgeneral  = utiles::genTotal( $lista_fechas, 0);
        if ( $lista_fechas ){
            ksort($lista_fechas);
        }
        
        //
        // Generar la tabla 
        //
        $tablas         = new utilestablasbs();
        $htmlADevolver  = $tablas->Nueva("", "sm", true, false, true, true, false);
        $htmlADevolver .= $tablas->SetTitulos( array( "Fecha", "% Total", "Importe" ));
        
        // Dibujar 
        foreach( $lista_fechas as $lafecha => $elimporte){
            $fecha            = $lafecha;
            $importe_valor    = $elimporte;
            $importe          = number_format ( floatval($importe_valor), 2, ",", "." );            
            $htmlADevolver   .= $tablas->NuevaFila();
            $htmlADevolver   .= $tablas->NuevoDato( $fecha );
            $htmlADevolver   .= $tablas->BarraDeProgreso( $importe_valor/$totalgeneral*100 );
            $htmlADevolver   .= $tablas->NuevoDato( $importe, "text-right" );
            $htmlADevolver   .= $tablas->FinFila();
        }

        // Total general
        $htmlADevolver .= $tablas->NuevaFila();
        $htmlADevolver .= $tablas->NuevoDato( "TOTAL", "bg-secondary text-light" );
        $htmlADevolver .= $tablas->NuevoDato( number_format ( floatval($totalgeneral), 2, ",", "." ), "text-right bg-secondary text-light" );

        // Fin de la tabla
        $htmlADevolver .= $tablas->Fin();
    
        return $htmlADevolver;
    
    }    

    /* --------------------------
     Generar el resumen de movimientos por fecha
     --------------------------
    */
    public static function MovsPorCategoria( $data ){
        // Recuperar la lista de proximos vencimientos
        if ( ! $data ){
            return "";
        }
        $lista_movs        = $data;
        $totalgeneral      = 0;
        $lista_categorias  = utiles::genResumen( $lista_movs, 'categorianombre', 'importe');
        $totalgeneral      = utiles::genTotal( $lista_categorias, 0);
        if ( $lista_categorias ){
            ksort($lista_categorias);
        }
        
        //
        // Generar la tabla 
        //
        $tablas         = new utilestablasbs();
        $htmlADevolver  = $tablas->Nueva("", "sm", true, false, true, true, false);
        $htmlADevolver .= $tablas->SetTitulos( array( "Categoria", "% Total", "Importe" ));
        
        // Dibujar 
        foreach( $lista_categorias as $lacategoria => $elimporte){
            $categoria        = $lacategoria;
            $importe_valor    = $elimporte;
            $importe          = number_format ( floatval($importe_valor), 2, ",", "." );            
            $htmlADevolver   .= $tablas->NuevaFila();
            $htmlADevolver   .= $tablas->NuevoDato( $categoria );
            $htmlADevolver   .= $tablas->BarraDeProgreso( $importe_valor/$totalgeneral*100 );
            $htmlADevolver   .= $tablas->NuevoDato( $importe, "text-right" );
            $htmlADevolver   .= $tablas->FinFila();
        }

        // Total general
        $htmlADevolver .= $tablas->NuevaFila();
        $htmlADevolver .= $tablas->NuevoDato( "TOTAL", "bg-secondary text-light" );
        $htmlADevolver .= $tablas->NuevoDato( number_format ( floatval($totalgeneral), 2, ",", "." ), "text-right bg-secondary text-light" );

        // Fin de la tabla
        $htmlADevolver .= $tablas->Fin();
    
        return $htmlADevolver;
    
    }    

    /* --------------------------
     Generar el resumen de movimientos por Cuentas
     --------------------------
    */
    public static function MovsPorCuenta( $data ){
        // Recuperar la lista de proximos vencimientos
        if ( ! $data ){
            return "";
        }
        $lista_movs     = $data;
        $totalgeneral   = 0;
        $lista_cuentas  = utiles::genResumen( $lista_movs, 'cuentanombre', 'importe');
        $totalgeneral   = utiles::genTotal( $lista_cuentas, 0);
        if ( $lista_cuentas ){
            ksort($lista_cuentas);
        }
        
        //
        // Generar la tabla 
        //
        $tablas         = new utilestablasbs();
        $htmlADevolver  = $tablas->Nueva("", "sm", true, false, true, true, false);
        $htmlADevolver .= $tablas->SetTitulos( array( "Cuenta", "% Total", "Importe" ));
        
        // Dibujar 
        foreach( $lista_cuentas as $lacuenta => $elimporte){
            $cuenta           = $lacuenta;
            $importe_valor    = $elimporte;
            $importe          = number_format ( floatval($importe_valor), 2, ",", "." );            
            $htmlADevolver   .= $tablas->NuevaFila();
            $htmlADevolver   .= $tablas->NuevoDato( $cuenta );
            $htmlADevolver   .= $tablas->BarraDeProgreso( $importe_valor/$totalgeneral*100 );
            $htmlADevolver   .= $tablas->NuevoDato( $importe, "text-right" );
            $htmlADevolver   .= $tablas->FinFila();
        }

        // Total general
        $htmlADevolver .= $tablas->NuevaFila();
        $htmlADevolver .= $tablas->NuevoDato( "TOTAL", "bg-secondary text-light" );
        $htmlADevolver .= $tablas->NuevoDato( number_format ( floatval($totalgeneral), 2, ",", "." ), "text-right bg-secondary text-light" );

        // Fin de la tabla
        $htmlADevolver .= $tablas->Fin();
    
        return $htmlADevolver;
    
    }
    
    /* -------------------------
     Estado de Tarjetas: Generar una tarjeta 
    ----------------------------
    */
    public static function GenerarEstadoTarjeta( $TarjetaNombre, $limite, $egresos, $ingresos, $vtosperiodo, $vtosfuturos, $disponible ){
        $colorDisponible = "text-success";
        if ($limite > 0){
            $saldoUsadoDelLimite = abs(($ingresos-$egresos-$vtosfuturos-$vtosperiodo)/$limite*100);
        }else{
            $saldoUsadoDelLimite = 0;
        }
        if ( $disponible < 0){ $colorDisponible = "text-danger" ;}

        $htmlADevolver  = "";

        $htmlADevolver  .= '<div class="card bg-light d-flex flex-fill mr-3">';
        $htmlADevolver  .= '    <div class="bg-dark card-header border-bottom-1">';
        $htmlADevolver  .= '        <h3>' . $TarjetaNombre . '</h3>';
        $htmlADevolver  .= '    </div>';
        $htmlADevolver  .= '    <div class="card-body pt-0">';
        $htmlADevolver  .= '        <div class="row">';
        $htmlADevolver  .= '            <div class="col-12 text-success">';
        $htmlADevolver  .= '                <p><b>Limite Compra : </b><span>' . number_format ( floatval($limite), 2, ",", ".") . '</apan></p>';
        $htmlADevolver  .= '            </div>';
        $htmlADevolver  .= '            <div class="col-7">';
        $htmlADevolver  .= '                <p class="text-danger"><b>Gastos: </b>' . number_format ( floatval($egresos), 2, ",", ".") . '</p>';
        $htmlADevolver  .= '                <p class="text-success"><b>Ingresos: </b>' . number_format ( floatval($ingresos), 2, ",", ".") . '</p>';
        $htmlADevolver  .= '                <p class="text-danger"><b>Vtos Periodo: </b>' . number_format ( floatval($vtosperiodo), 2, ",", ".") . '</p>';
        $htmlADevolver  .= '                <p class="text-info"><b>Vtos Futuros: </b>' . number_format ( floatval($vtosfuturos), 2, ",", ".") . '</p>';
        $htmlADevolver  .= '            </div>';
        $htmlADevolver  .= '            <div class="col-5 mt-2">';
        $htmlADevolver  .= '                <input type="text" class="dial"';
        $htmlADevolver  .= '                  data-min="0"';
        $htmlADevolver  .= '                  data-max="100"';
        $htmlADevolver  .= '                  data-width="120"';
        $htmlADevolver  .= '                  data-height="120"';
        $htmlADevolver  .= '                  data-fgColor="#00BCD4"';
        $htmlADevolver  .= '                  data-thickn1ess="0.5"';

        if ($limite == 0 ){ 
            $htmlADevolver  .= '              value="0">';
        }else{
            $htmlADevolver  .= '              value="' . number_format($saldoUsadoDelLimite) . '">';
        }
        $htmlADevolver  .= '            </div>';
        $htmlADevolver  .= '        </div>';
        $htmlADevolver  .= '    </div>';
        $htmlADevolver  .= '    <div class="card-footer">';
        $htmlADevolver  .= '         <div class="row">';
        $htmlADevolver  .= '         <div class="col-6">';
        $htmlADevolver  .= '             <h4 class="d-inline">Saldo Disponible</h4>';
        $htmlADevolver  .= '         </div>';
        $htmlADevolver  .= '         <div class="col-6 text-right">';
        $htmlADevolver  .= '             <span class="' . $colorDisponible .  '">' . number_format(floatval($disponible), 2, ",",".") . '</span>';
        $htmlADevolver  .= '         </div>';
        $htmlADevolver  .= '         </div>';
        $htmlADevolver  .= '    </div>';
        $htmlADevolver  .= '</div>';

        return $htmlADevolver;
      
    }
}
?>