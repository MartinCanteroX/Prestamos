<?php

// -----------------------------------------
// Rutinas genericas 
// -----------------------------------------
class ParamsDev{

    public $ret_array = [];

    // -----------------
    // Acumular valoes a devolver
    // -----------------
    function setData( $item, $valor ){
        $this->ret_array[$item] = $valor;
    }

    // -----------------
    // Devolver los valores acumulados
    // -----------------
    function getDataAll(){
        return $this->ret_array;
    }

    // -----------------
    // Devolver un valor de la lista
    // -----------------
    function getData( $item ){
        return $this->ret_array[$item];
    }

    // -----------------
    // Devolver los valroes acumulados para JS
    // -----------------
    function getDataAllJS(){
        return json_encode( $this->ret_array);
    }
    // -----------------
    // Devolver un valor como JSON 
    // -----------------
    function getDataJS( $dato ){
        return json_encode( $dato );
    }
}