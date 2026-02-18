<?php
// 
// Clase Fechas para automatizar calculos y funciones sobre fechas
//
class fechas {
    // ---------------------------------
    // Generar la ultima fecha del mes
    // Se puede enviar la fecha o el mes/anio
    // el parametro $fecha debe ser en formato 
    // ---------------------------------
    public static function Eom( $fecha = "", $mes = 0, $anio = 0, $formatoStr = false, $formatoAnsi = false ){
        if ( $fecha ){
            $dia = date_format( $fecha, "d" );
            $mes = date_format( $fecha, "m" );
            $anio = date_format( $fecha, "Y" );
        }
        
        // Analzar cuantos dias del mes le corresponde
        switch ($mes){
            case 1: $dia = 31; break;
            case 2:
                if ($anio % 4 == 0){
                    $dia = 29;
                }else{
                    $dia = 28;
                }
            break;
            case 3: $dia = 31; break;
            case 4: $dia = 30; break;
            case 5: $dia = 31; break;
            case 6: $dia = 30; break;
            case 7: $dia = 31; break;
            case 8: $dia = 31; break;
            case 9: $dia = 30; break;
            case 10: $dia = 31; break;
            case 11: $dia = 30; break;
            case 12: $dia = 31; break;
        }
        
        // Armar la fecha
        $fecha_nueva = date_create();
        $fecha_nueva = date_date_set( $fecha_nueva, $anio, $mes, $dia );
        $ret = $fecha_nueva;

        if ( $formatoAnsi){
            $ret = date_format( $ret, "Y-m-d" );
        }

        if ( $formatoStr){
            $ret = date_format( $ret, "d-m-Y" );
        }

        return $ret;
    } 

    // ---------------------------------
    // Devolver la fecha de hoy como objeto
    // ---------------------------------
    public static function Hoy( $formatoStr = false, $formatoAnsi = false){

        if ( $formatoAnsi ){
            $ret = date( "Y-m-d");
        }
        elseif ( $formatoStr){
            $ret = date( "d-m-Y");
        }
        elseif ( ! $formatoStr and ! $formatoAnsi ){
            $ret = date_create( date("d-m-Y"));
        }
        
        return $ret;
    }

    // ---------------------------------
    // Devolver el mes de la fecha indicada
    // ---------------------------------
    public static function Mes( $fecha, $formatoStr = False, $formatoAnsi = true ){
        if ( $formatoStr){
            if ( $formatoAnsi){
                $mes = substr( $fecha, 5, 2);
            }else{
                $mes = substr( $fecha, 3, 2);
            }
        }else{
            $mes = date_format($fecha, "m");
        }
        return $mes;
    }

    // ---------------------------------
    // Devolver el anio de la fecha indicada
    // ---------------------------------
    public static function anio( $fecha, $formatoStr = False, $formatoAnsi = true  ){
        if ( $formatoStr){
            if ( $formatoAnsi){
                $anio = substr( $fecha, 0, 4);
            }else{
                $anio = substr( $fecha, 6, 4);
            }
        }else{
            $anio = date_format($fecha, "Y");
        }
        return $anio;
    }
    
    // ---------------------------------
    // Devolver el anio de la fecha indicada
    // ---------------------------------
    public static function dia( $fecha ){
        return date_format($fecha, "d");
    }

    // ---------------------------------
    // Sumar dias a una fecha
    // $fecha es un objeto fecha
    // ---------------------------------
    public static function Add( $fecha, $dias = 0, $meses = 0, $anios = 0, $formatoStr = false, $formatoAnsi = false ){
        if ( $dias <> 0){
            $intervalo = strval($dias) . " days";
        }
        if ( $meses <> 0){
            $intervalo = strval($meses) . " months";
        }
        if ( $anios <> 0){
            $intervalo = strval($anios) . " years";
        }
        date_add( $fecha, date_interval_create_from_date_string( $intervalo ));
        $ret = $fecha;

        if ( $formatoAnsi){
            $ret = date_format( $fecha, "Y-m-d" );
        }

        if ( $formatoStr){
            $ret = date_format( $fecha, "d-m-Y" );
        }

        return $ret;
    } 

    // ---------------------------------
    // Devolver una fecha como string ( yyyy-mm-dd )
    // ---------------------------------
    public static function GetString( $fecha ){
        $fechastr = date_format( $fecha, "Y-m-d");
        return $fechastr;
    }

    // ---------------------------------
    // Generar primer dia del mes
    // ---------------------------------
    public static function Bom( $fecha = "", $mes = 0, $anio = 0, $formatoStr = false, $formatoAnsi = false ){
        if ( $fecha ){
            $dia = 1;
            $mes = date_format( $fecha, "m" );
            $anio = date_format( $fecha, "Y" );
        }
                
        // Armar la fecha
        $fecha_nueva = date_create();
        $fecha_nueva = date_date_set( $fecha_nueva, $anio, $mes, $dia );
        $ret = $fecha_nueva;

        if ( $formatoAnsi){
            $ret = date_format( $fecha_nueva, "Y-m-d" );
        }

        if ( $formatoStr){
            $ret = date_format( $fecha_nueva, "d-m-Y" );
        }

        return $ret;
    }
    
    // ---------------------------------
    // Devolver el nombre del mes
    // ---------------------------------
    public static function NombreMes( $fecha = "", $mes = 0 ){
        if ( $fecha ){
            $mes = date_format( $fecha, "m" );
        }

        // Analzar mes
        $nombremes = ""; 
        switch ($mes){
            case 1: $nombremes = "Enero"; break;
            case 2: $nombremes = "Febrero"; break;
            case 3: $nombremes = "Marzo"; break;
            case 4: $nombremes = "Abril"; break;
            case 5: $nombremes = "Mayo"; break;
            case 6: $nombremes = "Junio"; break;
            case 7: $nombremes = "Julio"; break;
            case 8: $nombremes = "Agosto"; break;
            case 9: $nombremes = "Setiembre"; break;
            case 10: $nombremes = "Octubre"; break;
            case 11: $nombremes = "Noviembre"; break;
            case 12: $nombremes = "Diciembre"; break;
        }

        return $nombremes ;
    }

    // -----------------------------------------
    // Funcion de fecha : Dato to Ansi
    // -----------------------------------------
    public static function FechaToAnsi( $fecha ){
        // $ret = date_format($fecha, "Ymd");
        $ret = $fecha;
        return $ret;
    } 
    
    // -----------------------------------------
    // Funcion de fecha : Ansi To Date
    // -----------------------------------------
    public static function FechaToDate( $fecha ){
        //$ret = date_format($fecha, "d/m/Y");
        $ret = $fecha;
        return $ret;
    }

    // -------------------------------------------------------------------------
    // Ir mes x mes hasta la fecha maxima y con 
    // las repeticiones generando en los dias elegidos
    // -------------------------------------------------------------------------
    public static function GenerarFechasMensuales( $fecha, $repeticiones, $listadiasmensuales, $fecha_maxima, $saltodemes = 1 ){

        $fecha_a_generar        = $fecha;
        $cantidad_repeticiones  = 1;
        $mes                    = intval($fecha_a_generar->format("n"));
        $anio                   = intval( $fecha_a_generar->format("Y"));
        
        while ( $cantidad_repeticiones <= $repeticiones or ( $repeticiones == 0 and $fecha_a_generar <= $fecha_maxima )){
            
            // Iterar por todos los dias elegidos dentro del mes
            for( $dia=0; $dia < count($listadiasmensuales); $dia++ ){
                // Calculamos la nueva fecha
                $fecha_a_generar = date_create( $anio . "/" . $mes . "/" . $listadiasmensuales[$dia] );
                
                // guardar la fecha, si corresponde
                if ( $repeticiones == 0 or $cantidad_repeticiones <= $repeticiones or ( $repeticiones == 0 and $fecha_a_generar <= $fecha_maxima )){
                    $listafechasagenerar[] = $fecha_a_generar;
                }
            } 

            // Repeticiones ( en meses )
            $cantidad_repeticiones++;

            // Salto del mes
            $mes += $saltodemes;
            if ($mes > 12) {
                // Cambio de año
                $anio++;
                $mes -= 12;
            }
        }

        return $listafechasagenerar;
    }

    // -------------------------------------------------------------------------
    // vencimientos semanales
    // desde el dia elegido...recorrer cada dia hasta la fecha maxima
    // y generar fechas en los dias de la semana
    // -------------------------------------------------------------------------
    public static Function GenerarFechasSemanales( $fecha, $repeticiones, $listadiasemanales, $fecha_maxima ){
        // preparar la lista de dias de la semana con numeros 
        $listadiasemanalesnum = array();

        for( $i = 0; $i< count($listadiasemanales); $i++){
            $dianum = 0;
            switch ($listadiasemanales[$i]){
                case 'D':
                    $dianum = 0;
                    break;
                case 'L':
                    $dianum = 1;
                    break;
                case 'M':
                    $dianum = 2;
                    break;
                case 'X':
                    $dianum = 3;
                    break;
                case 'J':
                    $dianum = 4;
                    break;
                case 'V':
                    $dianum = 5;
                    break;
                case 'S':
                    $dianum = 6;
                    break;
            }
            $listadiasemanalesnum[] = $dianum;
        }

        // 
        $fecha_a_generar = $fecha;
        $cantidad_repeticiones = 1;
        while ( ($repeticiones == 0 or $cantidad_repeticiones <= $repeticiones ) and $fecha_a_generar <= $fecha_maxima ){
            
            $diadelasemana = date_format( $fecha_a_generar, "w");
            if (in_array( $diadelasemana, $listadiasemanalesnum)) {
                // Es uno de los dias de la semana, se guarda
                $listafechasagenerar[] = date_format($fecha_a_generar, "d/m/Y");
            }

            // Calculamos la nueva fecha
            $fecha_a_generar = date_add( $fecha_a_generar, date_interval_create_from_date_string( "1 day"));

            // Repeticiones ( en meses )
            $cantidad_repeticiones++;
        }

        return $listafechasagenerar;
    }    
}
?>