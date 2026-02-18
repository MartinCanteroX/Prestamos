<?php

class utilesForms {
    
    // ----------------------------------------
    // Nuevo Formulario
    // ----------------------------------------
    function formNuevo( $action = "", $nuevoDiv = TRUE, $divClass = "form-datos" ){
        
        $htmlADevolver = "";
        if ( $nuevoDiv) {
            $htmlADevolver .= "<div ";
        }
        if ($divClass){
            $htmlADevolver .= "class='$divClass'";
        }
        
        if ( $nuevoDiv) {
            $htmlADevolver .= ">";
        }
        
        $htmlADevolver .= "<form ";

        if ( $action ){
            $htmlADevolver .= " action='$action' ";
        }

        $htmlADevolver .= " method='post'>";
        
        return $htmlADevolver;
    }
    
    // -----------------------------------------
    // Generar el HTML de una tarjeta objetos de un objeto
    // -----------------------------------------
    function genControlInput( $tipodato, $caption, $valor = '', $name = '', $id = '', $placeholder = '', $opciones = '' ){

        $htmlA = "";

        switch (strtoupper($tipodato)) {
            case 'H':
                $htmlA = $this->inputHidden( $name, $valor, $id );
                break;
            case 'C':
                $htmlA = $this->inputText( $caption, $valor, $name, $id, $placeholder );
                break;
            case 'F':
                $htmlA = $this->inputdate( $caption, $valor, $name, $id );
                break;
            case 'L':
                $htmlA = $this->inputRadio( $caption, $valor, $name, "", ($valor == "S"));
                break;
            case 'N':
                $htmlA = $this->inputNumber( $caption, $valor, $name, $id, $placeholder );
                break;
            case 'NE':
                $htmlA = $this->inputNumber( $caption, $valor, $name, $id, $placeholder );
                break;
            case 'IP':
                $htmlA = $this->inputText( $caption, $valor, $name, $id, $placeholder );
                break;
            case 'DC':
                $htmlA = $this->inputText( $caption, $valor, $name, $id, $placeholder );
                break;
            case 'J':
                $htmlA = $this->inputText( $caption, $valor, $name, $id, $placeholder );
                break;
            case 'P':
                $htmlA = $this->inputPassword( $caption, $valor, $name, $id, $placeholder );
                break;
            case 'CMB':
                $htmlX = $this->genComboFromArray( $opciones, $name, $id, '', $valor );
                $htmlA = $this->imputCombo( $name, $htmlX, $caption);
                break;
        }

        return $htmlA;
    }     

    // ----------------------------------------
    // Cerrar Formulario
    // ----------------------------------------
    function formFin( $nuevoDiv = TRUE ){
        
        $htmlADevolver = "</form>";
        if ( $nuevoDiv) {
            $htmlADevolver .= "</div>";
        }
        return $htmlADevolver;
    }
    
    // ----------------------------------------
    // Nuevo Combo
    // ----------------------------------------
    function imputCombo( $nombre, $htmlCombo, $caption = ''){

        $htmlADevolver = "<div class='form-group'>";
        $htmlADevolver .= "<label for='$nombre'>$caption</label>";
        $htmlADevolver .= $htmlCombo;
        $htmlADevolver .= "</div>";
        
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Control de ingreso de texto
    // ----------------------------------------
    function inputText( $nombre, $valor, $name, $id,  $placeHolder ){
        
        $htmlADevolver = "<div class='form-group'>";
        $htmlADevolver .= "<label for='$name'>$nombre</label>";
        $htmlADevolver .= "<input type='text' name='$name' value='$valor' class='form-control form-control-sm w3-white'";
        
        if ( $id ) {
            $htmlADevolver .= " id='$id'";
        }
        
        if ( $placeHolder) {
            $htmlADevolver .= " placeholder='$placeHolder'";
        }
        $htmlADevolver .= "/></div>";
        
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Control de ingreso de importes
    // ----------------------------------------
    function inputNumber( $nombre, $valor, $name, $id,  $placeHolder ){
        
        $htmlADevolver = "<div class='form-group'>";
        $htmlADevolver .= "<label for='$name'>$nombre</label>";
        $htmlADevolver .= "<input type='number' name='$name' value='$valor' class='form-control form-control-sm w3-white'";
        
        if ( $id ) {
            $htmlADevolver .= " id='$id'";
        }
        
        if ( $placeHolder) {
            $htmlADevolver .= " placeholder='$placeHolder'";
        }
        $htmlADevolver .= "></div>";
        
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Control de ingreso de password
    // ----------------------------------------
    function inputPassword( $nombre, $valor, $name, $id,  $placeHolder ){
        
        $htmlADevolver = "<div class='form-group'>";
        $htmlADevolver .=   "<label for='$name'>$nombre</label>";
        
        $htmlADevolver .=       "<input type='password' name='$name' id='$id' value='$valor' class='form-control form-control-sm'";
        
        if ( $placeHolder) {
            $htmlADevolver .=   " placeholder='$placeHolder'";
        }
        $htmlADevolver .=       "onclick='togglePassword(\'$id\')'"; 
        $htmlADevolver .=       "/>";       // Cierre input

        // Cerrar el div
        $htmlADevolver .= "</div>";
        
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Control de ingreso de fecha
    // ----------------------------------------
    function inputDate( $nombre, $valor, $name, $id ){

        $htmlADevolver = "<div class='form-group'>";
        $htmlADevolver .= "<label for='$name'>$nombre</label>";
        $htmlADevolver .= "<input type='date' name='$name' value='$valor' class='form-control form-control-sm'";
        
        if ( $id ) {
            $htmlADevolver .= " id='$id'";
        }
        $htmlADevolver .= "/></div>";
        
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Control de CheckBox
    // ----------------------------------------
    function inputCheckBox( $leyenda, $valor, $name, $id, $checked, $jsCode = "" ){
        
        $htmlADevolver  = "<div class='form-check'>";
        $htmlADevolver  .= "    <input class='form-check-input' type='checkbox' name='$name' value='$valor' id='$id'";
        
        if ( $checked ){
            $htmlADevolver  .= " checked ";
        }
        
        if ( $jsCode ){
            $htmlADevolver  .= " " . $jsCode . " ";
        }

        $htmlADevolver  .= "/>";

        $htmlADevolver  .= "    <label class='form-check-label' for='$name'>";
        $htmlADevolver  .=          "$leyenda";
        $htmlADevolver  .= "    </label>";
        $htmlADevolver  .= "</div>";
    
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Control radio button
    // ----------------------------------------
    function inputRadio( $nombre, $valor, $name, $id, $checked ){

        $htmlADevolver  = "";
        
        // ---------------------
        // Radio para el SI
        // ---------------------
        $htmlADevolver .= "<div class='custom-control custom-radio custom-control-inline'>";
        $htmlADevolver .= "     <label class = 'm-3' for='$name'>$nombre" . "   </label>";

        $htmlADevolver .= "     <div class='form-check form-check-inline'>";
        $htmlADevolver .= "         <input class='form-check-input' type='radio' name='$name' value='S'";
        if ( $checked ){ $htmlADevolver .= " checked "; }        
        if ( $id ) { $htmlADevolver .= " id='$id'"; }
        $htmlADevolver .= ">";
        
        // Texto para el radio SI
        // ---------------------
        $htmlADevolver .= "         <label class='form-check-label m-1' for='$name'>";
        $htmlADevolver .=               "Si";
        $htmlADevolver .= "         </label>";
        $htmlADevolver .= "     </div>";
        
        // ---------------------
        // Radio para el NO
        // ---------------------
        $htmlADevolver .= "     <div class='form-check form-check-inline'>";
        $htmlADevolver .= "         <input class='form-check-input' type='radio' name='$name' value='N' ";
        if ( ! $checked ){ $htmlADevolver .= " checked "; }        
        if ( $id ) { $htmlADevolver .= " id='$id'"; }
        $htmlADevolver .= ">";
        
        // Texto para el radio SI
        // ---------------------
        $htmlADevolver .= "         <label class='form-check-label m-1' for='$name'>";
        $htmlADevolver .=               "No";
        $htmlADevolver .= "         </label>";
        $htmlADevolver .= "     </div>";
        $htmlADevolver .= "</div>";
        
        return $htmlADevolver;

    }

    // ----------------------------------------
    // Control de ingreso de texto
    // ----------------------------------------
    function inputHidden( $nombre, $valor, $id ){
        
        $htmlADevolver = "<input type='hidden' name='$nombre' value='$valor' id='$id'/>";
        
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Boton de Formulario
    // ----------------------------------------
    function botonForm( $leyenda, $clase = '' ){
        
        $htmlADevolver = "<input type='submit' value='$leyenda' class= 'btn btn-success $clase'/> " ;
        return $htmlADevolver;
    }

    // --------------------------------
    // Devolver la lista de tipos de datos en formato HTML
    // el array NO es asociativo
    // toma posicion 0 como valor y 1 como leyenda
    // $listaItems es un array simple con pos-0 es ID y pos-1 es la leyenda
    // --------------------------------
    function genComboFromArray( $listaItems, $name, $id = '', $clase = '', $valorInicial = '') {
        
        $htmlADevolver = "";
        $param_id = ( $id ) ? " id='$id'" : "";
        $param_clase = ( $clase ) ? " class='$clase'" : "";
        
        //<!-- arranca el select -->
        $htmlADevolver .= "<select class='form-control ' name='$name'";
        
        // Tiene un ID ?
        $htmlADevolver .= $param_id;
        $htmlADevolver .= $param_clase;
        
        $htmlADevolver .=       ">";
        
        // Valor nulo
        $htmlADevolver .= "<option value='0'>(Seleccionar)</option>";

        $arrlength=count($listaItems);
        for($x=0;$x<$arrlength;$x++) {
            // Armar una opcion por cada clase
            $dato = $listaItems[ $x ];
            $selected = "";
            
            // Valor inicial
            if ( $valorInicial) {
                if ( $dato[0] == $valorInicial ) {
                    $selected = " selected ";
                }
            }
            
            $htmlADevolver .= "<option value='" . $dato[0] . "' $selected >" . $dato[1] . "</option>";
        }
        
        // <!-- fin del select -->
        $htmlADevolver .= "</select>";
        
        return $htmlADevolver;
        
    }

    // ----------------------------------------
    // Nueva Lista Vertical
    // ----------------------------------------
    function listaNueva($id){
        
        $htmlADevolver = "<ul class='list-group list-group-flush' id='$id'>" ;
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Cierre Lista Vertical
    // ----------------------------------------
    function listaFin(){
        
        $htmlADevolver = "</ul>" ;
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Lista Vertical Nuevo Item
    // ----------------------------------------
    function listaItem($leyenda, $id, $link, $activo = FALSE){
        
        if ($activo) {
            $htmlADevolver = "<a href='$link'><li class='list-group-item active list-group-item-dark' id='$id'>" . $leyenda . "</li></a>"; ;
        }else{
            $htmlADevolver = "<a href='$link'><li class='list-group-item list-group-item-dark' id='$id'>" . $leyenda . "</li></a>"; ;
        }
        return $htmlADevolver;
    }

    // ----------------------------------------
    // Input con la leyenda en linea ( parte del input )
    // ----------------------------------------
    function inputTextEnlinea( $nombre, $valor, $id, $placeHolder ) {
        
        $htmlADevolver = "";
        
        $htmlADevolver .= "<div class='input-group mb-3'>";
        $htmlADevolver .= "  <div class='input-group-prepend'>";
        $htmlADevolver .= "    <span class='input-group-text' id='basic-addon1'>$nombre</span>";
        $htmlADevolver .= "  </div>";
        $htmlADevolver .= "  <input type='text' valu = '$valor' id = '$id' class='form-control' placeholder='$placeHolder' aria-label='$nombre' aria-describedby='basic-addon1'>";
        $htmlADevolver .= "</div>";
        
        return $htmlADevolver;
        
    }

    // ----------------------------------------
    // Boton de Formulario con link
    // ----------------------------------------
    function botonLink( $leyenda, $link, $clase = '' ){
        
        $htmlADevolver = "<a href='$link'><button type='button' class='btn btn-success $clase'>$leyenda</button></a>" ;
        return $htmlADevolver;
    }

    // -----------------------------------------
    // Generar el HTML de una tarjeta tipica
    // -----------------------------------------
    public static function genTarjeta( $objID, $Nombre, $linkDestino, $linkRetorno, $modeloTarjeta, $editable, $linkEditarTarjeta, $textoEditarTarjeta ) {
        
        /*$linkEditarTarjeta  = "objeto_editAtr.php?retorno=" . $linkRetorno . "&id=" . $objID;*/
        if ( ! $linkEditarTarjeta){
            $linkEditarTarjeta = "#";
        }
        $iconoEditarTarjeta = BASE_URL_IMG . "iconoeditar.png";
        
        $tarjeta = " <article class='" . $modeloTarjeta . "'>";
        
        if ( $linkDestino) {
            $tarjeta .= "<a href=$linkDestino>"; 
            $tarjeta .= " <h3 class='titulotarjeta'>$Nombre</h3></a>";        
        }else{
            $tarjeta .= " <h3 class='titulotarjeta'>$Nombre</h3>";
        }
        if ( $editable ) {
            $tarjeta .= "<a href=$linkEditarTarjeta> <img src=$iconoEditarTarjeta alt='$textoEditarTarjeta' class='IconoEditarTarjeta'></a>";
        }
        $tarjeta .= " </article>";
        
        return ($tarjeta);
        
    }    

    // -----------------------------------------
    // Generar el HTML de una tarjeta de clases
    // -----------------------------------------
    public static function genTarjetaClase( $nombre, $linkabrir, $linknuevo = "", $icono = "") {
        
        if ( $icono != ''){
            $iconotarjeta = "images/$icono";
        }
        else{   
            $iconotarjeta = "images/clase-$nombre.png";
        }
        
        $tarjeta = " <article class='tarjeta-clases'>";
        $tarjeta .=     "<a href=$linkabrir>"; 
        $tarjeta .=       " <h3 class='titulotarjetaclase'>$nombre</h3>";        
        $tarjeta .=       " <img alt='' src='$iconotarjeta' class='tarjeta-clases2-icono'>";        
        $tarjeta .=     " </a>";    
        
        if ( $linknuevo <> ""){
            $tarjeta .=     "<a href=$linknuevo><h4>Nuevo</h4></a>";
        }
        $tarjeta .= " </article>";
        
        return ($tarjeta);
        
    }    

    // -----------------------------------------
    // Generar el HTML de una tarjeta objetos de un objeto
    // -----------------------------------------
    public static function genTarjetaClase2( $nombre, $linkabrir, $linknuevo = "", $icono = "") {
        
        if ( $icono != ''){
            $iconotarjeta = "images/$icono";
        }
        else{   
            $iconotarjeta = "images/clase-$nombre.png";
        }
        
        $tarjeta = " <article class='tarjeta-clases2'>";
        $tarjeta .=     "<a href=$linkabrir>"; 
        $tarjeta .=       " <h3 class='titulotarjetaclase'>$nombre</h3>";        
        $tarjeta .=       " <img alt='' src='$iconotarjeta' class='tarjeta-clases-icono'>";        
        $tarjeta .=     " </a>";    
        
        if ( $linknuevo <> ""){
            $tarjeta .=     "<a href=$linknuevo><h4>Nuevo</h4></a>";
        }
        $tarjeta .= " </article>";
        
        return ($tarjeta);
        
    }

    // ----------------------------------------
    // Boton visual y funcion con JS
    // ----------------------------------------
    function botonJS( $leyenda, $id ){
        
        $htmlADevolver = "<button type='button' class='btn btn-success' id='$id'>$leyenda</button>" ;
        return $htmlADevolver;
    }

    // --------------------------------
    // Devolver los items para un cambo existente
    // el array NO es asociativo
    // --------------------------------
    function genComboFromArray2( $listaItems, $opcion_seleccionar = false, $valorInicial = 0) {
        
        $htmlADevolver = "";
            
        // Valor nulo
        if ( $opcion_seleccionar ){
            $htmlADevolver .= "<option value='0'";
            if ( ! $valorInicial ){ 
                $htmlADevolver .= " selected ";
            }
            $htmlADevolver .= ">(Seleccionar)</option>";
        }

        $arrlength=count($listaItems);
        for($x=0;$x<$arrlength;$x++) {
            // Armar una opcion por cada clase
            $dato = $listaItems[ $x ];
            $selected = "";
            
            // Valor inicial
            if ( $valorInicial) {
                if ( $dato[0] == $valorInicial ) {
                    $selected = " selected ";
                }
            }
            
            $htmlADevolver .= "<option value='" . $dato[0] . "' $selected >" . $dato[1] . "</option>";
        }
        
        return $htmlADevolver;
        
}

}


?>