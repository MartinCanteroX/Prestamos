<?php

class utilestablasbs{
    
    // ==========================================
    // Utiles de tablas
    // ==========================================

    // ----------------------------------------
    // Abrir una tabla
    // ----------------------------------------
    function Nueva( $idTabla = "", $size = "sm", $hover = true, $border = true, $striped = true, $headfixed = false, $textnowrap = false, $height = 0 ){
        
        // Arranque de la tabla
        $htmlADevolver = "<table class='table ";
        if ($hover){
            $htmlADevolver .= " table-hover ";
        } 
        if ($striped){
            $htmlADevolver .= " table-striped ";
        } 
        if ($headfixed){
            $htmlADevolver .= " table-head-fixed ";
        } 
        // if ($textnowrap){
        //     $htmlADevolver .= " text-nowrap ";
        // } 
        if ($border){
            $htmlADevolver .= " table-bordered ";
        }else{
            $htmlADevolver .= " table-borderless ";
        }
        if ($size){
            $htmlADevolver .= " table-$size ";
        }
        // if ($size){
        //     $htmlADevolver .= " table-responsive-$size ";
        // }else{
        //     $htmlADevolver .= " table-responsive ";
        // }

        $htmlADevolver .= "'";
                
        if ( $idTabla ) {
            $htmlADevolver .= " id='$idTabla'";
        }

        if ($height > 0 ){
            $htmlADevolver .= " style='height: " . $height . "px; '";
        } 
        
        $htmlADevolver .= ">";
        // var_dump($htmlADevolver);
        // die();

        return $htmlADevolver;
    }

    // ----------------------------------------
    // Set Titulos
    // ----------------------------------------
    function SetTitulos($array_titulos, $classcolumna = ""){
        $htmlADevolver = "";

        $htmlADevolver .= $this->InicioTitulos();
        $htmlADevolver .= $this->NuevasColumnas( $array_titulos, $classcolumna );
        $htmlADevolver .= $this->FinTitulos();

        return $htmlADevolver;
    }

    // ----------------------------------------
    // Inicio Titulos (usar si no se usa SetTitulos)
    // ----------------------------------------
    function InicioTitulos(){
        $htmlADevolver = "<thead>";
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Nueva columna de la tabla (usar si no se usa SetTitulos)
    // ----------------------------------------
    function NuevaColumna( $titulo, $classcolumna = "" ){
        
        if ( ! $titulo) {
            return "";
        }
        
        $htmlADevolver = "<th";
        if ( $classcolumna) {
            $htmlADevolver .= " class='$classcolumna'";
        }
        $htmlADevolver .= ">$titulo</th>";
        
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Nuevas columnas (usar si no se usa SetTitulos)
    // ----------------------------------------
    function NuevasColumnas( $array_titulos, $classcolumna = "" ){
        
        if ( ! $array_titulos) {
            return "";
        }
        
        $htmlADevolver = "";
        foreach( $array_titulos as $at =>$titulo ){
            $htmlADevolver .= $this->NuevaColumna( $titulo, $classcolumna );
        }
        
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Fin Inicio Titulo (usar si no se usa SetTitulos)
    // ----------------------------------------
    function FinTitulos(){
        $htmlADevolver = "</thead>";
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Set fila completa
    // ----------------------------------------
    function SetFila( $array_datos, $classcolumna = '' ){
        $htmlADevolver = "";
    
        $htmlADevolver .= $this->NuevaFila();
        
        foreach( $array_datos as $ad => $dato ){
            $htmlADevolver .= $this->NuevoDato( $dato, $classcolumna );
        }

        $htmlADevolver .= $this->FinFila();

        return $htmlADevolver;
    }

    // ----------------------------------------
    // Nueva fila
    // ----------------------------------------
    function NuevaFila( $classcolumna = '' ){
        if ( $classcolumna){
            $htmlADevolver = "<tr class='$classcolumna'>";
        }else {
            $htmlADevolver = "<tr>";
        }
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Nuevo dato en un renglon
    // ----------------------------------------
    function NuevoDato( $dato, $classdato = "", $link = "", $onclick = "" ){
        
        /*
        if ( ! $dato) {
            return "";
        }
        */
        
        // Length minimo
        if ( ! $dato or ! is_string($dato)){
            $dato = " ";
        }elseif ( strlen($dato) == 0){
            $dato = " ";
        }

        $htmlADevolver = "";
        $htmlADevolver .= "<td" ;
        $htmlADevolver .= ( $classdato ) ? " class='$classdato'" : "";
        $htmlADevolver .= ( $link ) ? "><a href='$link'>" . $dato . "</a></td>" : ">" . $dato . "</td>";
        
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Nuevo dato en un renglon
    // ----------------------------------------
    function NuevoDatoImagen( $imagen, $classdato = "", $link = "" ){
        
        if ( ! $imagen) {
            return "";
        }
        
        $htmlADevolver = "";
        $htmlADevolver .= "<td" ;
        $htmlADevolver .= ( $classdato ) ? " class='$classdato'" : "";
        $htmlADevolver .= ">";
        $htmlADevolver .= ( $link ) ? "<a href='$link'><img src='$imagen'></a>" : "<img src='$imagen'>";
        $htmlADevolver .= "</td>" ;
        
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Nuevo icono en una celda ( <a> )
    // ----------------------------------------
    function NuevoDatoAccion( $classdato = "", $link = "", $tooltip = "", $clase = "", $value = "" ){
        
        if ( ! $classdato and ! $link ) {
            return "";
        }
        
        $htmlADevolver = "";
        $htmlADevolver .= "<td";
        $htmlADevolver .= ">";
            $htmlADevolver .= "<a href='$link'";
        if ( $tooltip ){
            $htmlADevolver .= " title='$tooltip'";
        }
        if ( $clase ){
            $htmlADevolver .= " class='$clase'";
        }
        if ( $value ){
            $htmlADevolver .= " value='$value'";
        }
        $htmlADevolver .= "><i class='$classdato'></i></a>" ;
        $htmlADevolver .= "</td>" ;

        return $htmlADevolver;
    }

    // ----------------------------------------
    // Nuevo icono en una celda ( <a> )
    // ----------------------------------------
    function NuevoDatoAccionJS( $classdato = "", $link = "", $tooltip = "", $value = "" ){
        
        if ( ! $classdato and ! $link ) {
            return "";
        }
        
        $htmlADevolver = "";
        // $htmlADevolver .= "<td><button";
        $htmlADevolver .= "<td><a href=''";

        if ( $tooltip ){
            $htmlADevolver .= " title='$tooltip'";
        }
        if ( $value ){
            $htmlADevolver .= " value='$value'";
        }
        // $htmlADevolver .= " onclick='$link($value)'>" ;
        // $htmlADevolver .= "<i class='$classdato'></i>" ;
        $htmlADevolver .= " onclick='$link" ;

        if ($value){
            $htmlADevolver .= "($value)" ;
        }
        
        $htmlADevolver .= "'" ;
        $htmlADevolver .= "<i class='$classdato'></i></a>" ;
        $htmlADevolver .= "</td>" ;

        return $htmlADevolver;
    }

    // ----------------------------------------
    // Nuevo icono en una celda ( <a> )
    // no se usa una etiqueta <a></a>
    // ----------------------------------------
    function NuevoDatoAccionJS2( $classdato = "", $link = "", $tooltip = "", $value = "" ){
        
        if ( ! $classdato and ! $link ) {
            return "";
        }
        
        $htmlADevolver = "";
        $htmlADevolver .= "<td><span ";

        if ( $tooltip ){
            $htmlADevolver .= " title='$tooltip'";
        }

        $htmlADevolver .= " onclick='$link" ;

        if ($value){
            $htmlADevolver .= "($value)" ;
        }
        
        $htmlADevolver .= "'" ;
        $htmlADevolver .= " style='cursor:pointer'" ;

        // cierre del span
        $htmlADevolver .= ">" ;  // cierre del span

        $htmlADevolver .= "<i class='$classdato'></i></a>" ;
                
        // Cierre de la celda
        $htmlADevolver .= "</td>" ;

        return $htmlADevolver;
    }

    // ----------------------------------------
    // Fin Nueva Fila
    // ----------------------------------------
    function FinFila(){
        $htmlADevolver = "</tr>";
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Cerrar una tabla
    // ----------------------------------------
    function Fin(){
        
        // Fin de la tabla
        $htmlADevolver = "</table>" ;
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Barra de progreso
    // ----------------------------------------
    function BarraDeProgreso( $width ){
        $htmlADevolver  = "<td>" ;
        $htmlADevolver .= "<div class='progress progress-xs'>";
        $htmlADevolver .= "     <div class='progress-bar progress-bar-danger' style='width: $width%'></div>";
        $htmlADevolver .= "</div>";
        $htmlADevolver .= "</td>";
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Nuevo icono como boton en una celda ( <boton> )
    // ----------------------------------------
    function NuevoDatoAccionBoton( $classdato = "", $link = "", $tooltip = "", $value = "" ){
        
        if ( ! $classdato and ! $link ) {
            return "";
        }
        
        $htmlADevolver = "";
        // $htmlADevolver .= "<td><button type='button' class='btn'";
        $htmlADevolver .= "<td style='width:15px'><button type='button' class='border-0' style='width:15px'";

        if ( $tooltip ){
            $htmlADevolver .= " title='$tooltip'";
        }
        if ( $value ){
            $htmlADevolver .= " value='$value'";
        }
        $htmlADevolver .= " onclick='$link" ;

        if ($value){
            $htmlADevolver .= "($value)" ;
        }
        
        $htmlADevolver .= "'" ;
        $htmlADevolver .= "><i class='$classdato'></i></button>" ;
        $htmlADevolver .= "</td>" ;

        return $htmlADevolver;
    }

    /* ----------------------------------------
       Icono en celda de tabla
       el ID va en el ID y se engancha luego
       con un event Delegation en el controller
       ----------------------------------------
    */
    public function BotonClassJs( $classdato = "accion", $tooltip = "", $value = "" ){
        
        if ( ! $classdato or ! $value ) {
            return "";
        }
        
        $htmlADevolver = "";
        $htmlADevolver .= "<td><span ";

        // Tooltip
        if ( $tooltip ){
            $htmlADevolver .= " title='$tooltip'";
        }

        // clase
        $htmlADevolver .= " class='$classdato'" ;

        // Cursor
        $htmlADevolver .= " style='cursor:pointer'" ;
        
        // ID
        $htmlADevolver .= " id=$value" ;

        // cierre del span
        $htmlADevolver .= ">" ;  // cierre del span

        // Cierre de la celda
        $htmlADevolver .= "</td>" ;

        return $htmlADevolver;
    }    
}
?>