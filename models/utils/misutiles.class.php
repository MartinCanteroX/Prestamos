<?php

class misutiles {

    // -------------------------------
    // Nueva tarjeta de cuenta
    // muestra el icono, nombre, saldo
    // link para ajustar el saldo
    // link para acceder a los datos de la cuenta
    // -------------------------------
    static function genTarjetaCuenta( $cuenta ){
        $tarjeta = "";
        $pathiconos = "images/48/";
        $esnueva = TRUE;
        
        // Analizar si no hay cuenta
        if ( $cuenta ){
            $id               = $cuenta->get_id();
            $nombre           = $cuenta->get_nombre();
            $linkajustarsaldo = "cuenta_ajsaldo.php?id=$id";
            $linkvermov       = "cuenta_vermovs.php?id=$id";
            $iconotarjeta     = $cuenta->get_atributo_valor_bynombre("icono");
            $esnueva          = FALSE;
        }else{
            $id               = 0;
            $nombre           = "(Nueva)";
            $linkajustarsaldo = '#';
            $linkvermov       = '#';
            $iconotarjeta     = "saldos.png";
        }
        $iconotarjeta     = $pathiconos . $iconotarjeta;
        
        $tarjeta .= " <article class='tarjeta-cuentas'>";
        $tarjeta .=     "<a href='$linkvermov'>"; 
        $tarjeta .=       " <h3 class='tarjeta-cuentas-titulo'>$nombre</h3>";        
        $tarjeta .=       " <img alt='cuenta' src='$iconotarjeta'>";        
        $tarjeta .=     "</a>";

        if ( ! $esnueva ){

            $tarjeta .=     "<div class='container-fluid'>";
            $tarjeta .=     "   <div class='row'>";
            $tarjeta .=     "       <div class='col'>";
            
            if ( $linkajustarsaldo ){
                $tarjeta .=     "           <a href=$linkajustarsaldo><h4>Ajustar</h4></a>";
            }
            $tarjeta .=     "       </div>";
            $tarjeta .=     "       <div class='col'>";
            
            if ( $linkvermov ){
                $tarjeta .=     "           <a href=$linkvermov><h4>Movimientos</h4></a>";
            }
            $tarjeta .=     "       </div>";
            $tarjeta .=     "   </div>";
            $tarjeta .=     "</div>";
        }
        $tarjeta .= " </article>";
            
        return $tarjeta;
    }
    
    // // ---------------------------
    // // Mostrar todos los vencimientos pasados y futuros
    // // ---------------------------
    // static function showmovegresos(){
    //     // Recuperar los vencimientos

    //     // Generar las tarjetas
    //     $htmlADevolver = "";
        
    //     // Meter todos las tarjetas en una fila
    //     $htmlADevolver .= "<div class='col bg-secondary' id='main-egresos'>";

    //     $htmlADevolver .= utiles::setTitulo("Egresos");

    //     // Recuperar los egrsos
    //     $egresos = [];
    //     $tablas = new utilestablas();

    //     // Comenzar a dibujar la tabla
    //     $htmlADevolver .= $tablas->Nueva();
    //     $htmlADevolver .= $tablas->InicioTitulos();
    //     $htmlADevolver .= $tablas->NuevaColumna("Fecha", "");
    //     $htmlADevolver .= $tablas->NuevaColumna("Nombre", "");
    //     $htmlADevolver .= $tablas->NuevaColumna("Cuenta", "");
    //     $htmlADevolver .= $tablas->NuevaColumna("Importe", "");
    //     $htmlADevolver .= $tablas->NuevaColumna("Categoria", "");
    //     $htmlADevolver .= $tablas->NuevaColumna("SubCateg.", "");
    //     $htmlADevolver .= $tablas->FinTitulos();
        
    //     // Generar las tarjetas 
    //     foreach( $egresos as $v => $egreso ){
    //         $htmlADevolver .= $tablas->NuevaFila();
    //         $htmlADevolver .= $tablas->NuevoDato();
    //         $htmlADevolver .= $tablas->FinFila();
    //     }
    //     $htmlADevolver .= $tablas->Fin();

    //     // Cerrar la fila
    //     $htmlADevolver .= "</div>";

    //     // Motrar las tarjetas 
    //     return $htmlADevolver;
        
    // }
    // // ---------------------------
    // // Mostrar todos los vencimientos pasados y futuros
    // // ---------------------------
    // static function showmovingresos(){
    //     // Recuperar los vencimientos

    //     // Generar las tarjetas
    //     $htmlADevolver = "";
        
    //     // Meter todos las tarjetas en una fila
    //     $htmlADevolver .= "<div class='col bg-secondary' id='main-ingresos'>";
        
    //     $htmlADevolver .= utiles::setTitulo("Ingresos");

    //     // Recuperar los egrsos
    //     $ingresos = [];
    //     $tablas = new utilestablas();

    //     // Comenzar a dibujar la tabla
    //     $htmlADevolver .= $tablas->Nueva();
    //     $htmlADevolver .= $tablas->InicioTitulos();
    //     $htmlADevolver .= $tablas->NuevaColumna("Fecha", "");
    //     $htmlADevolver .= $tablas->NuevaColumna("Nombre", "");
    //     $htmlADevolver .= $tablas->NuevaColumna("Cuenta", "");
    //     $htmlADevolver .= $tablas->NuevaColumna("Importe", "");
    //     $htmlADevolver .= $tablas->NuevaColumna("Categoria", "");
    //     $htmlADevolver .= $tablas->NuevaColumna("SubCateg.", "");
    //     $htmlADevolver .= $tablas->FinTitulos();
        
    //     // Generar las tarjetas 
    //     foreach( $ingresos as $v => $ingreso ){
    //         $htmlADevolver .= $tablas->NuevaFila();
    //         $htmlADevolver .= $tablas->NuevaDato();
    //         $htmlADevolver .= $tablas->FinFila();
    //     }
    //     $htmlADevolver .= $tablas->Fin();

    //     // Cerrar la fila
    //     $htmlADevolver .= "</div>";

    //     // Motrar las tarjetas 
    //     return $htmlADevolver;
        
    // }

}

?>