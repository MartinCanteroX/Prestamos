<?php

class utilestablas{
    
    // ==========================================
    // Utiles de tablas
    // ==========================================

    // ----------------------------------------
    // Abrir una tabla
    // ----------------------------------------
    function Nueva( $idTabla = "" ){
        
        // Arranque de la tabla
        $htmlADevolver = "<table class='table table-light table-striped table-hover table-sm'" ;
        if ( $idTabla ) {
            $htmlADevolver .= " id='$idTabla'";
        }
        
        $htmlADevolver .= ">";
        
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Abrir una tabla con BS
    // ----------------------------------------
    function NuevaBS( $idTabla = "" ){
        
        // Arranque de la tabla
        $htmlADevolver = "<table classs='table table-hover table-responsive table-bordered'" ;
        if ( $idTabla ) {
            $htmlADevolver .= " id='$idTabla'";
        }
        
        $htmlADevolver .= ">";
        
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
        $htmlADevolver = "<thead class='thead-dark'>";
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
    function NuevoDatoAccion( $classdato = "", $link = "", $tooltip = "" ){
        
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
        $htmlADevolver .= "><i class='$classdato'></i></a>" ;
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

}
?>