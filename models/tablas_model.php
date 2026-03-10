<?php

class tablas_model {
    private $id = 0;
    private $nombre = '';
    private $tabla = "";

    function __construct( $id = 0, $nombre = '', $tabla = ''){
        $this->id = $id;
        $this->nombre = $nombre;
        $this->tabla = $tabla;
    }

    // set/get id
    // -----------
    public function set_id($nuevo_id){
        $this->id = $nuevo_id;
    }
    
    public function get_id(){
        return $this->id;
    }
    
    // set/get nombre
    // -----------
    public function set_nombre($nuevo_nombre){;
        $this->nombre = $nuevo_nombre;
    }
    
    public function get_nombre(){
        return $this->nombre;
    }
    
    // set/get tabla
    // -----------
    public function set_tabla($nuevo_tabla){;
        $this->tabla = $nuevo_tabla;
    }
    
    public function get_tabla(){
        return $this->tabla;
    }
    

    // ****************************************
    // Devolver todos los registros de la tabla
    // ****************************************
    public function getAll( $sql = ""){
        $db = new database();

        if ( ! $sql ){
            $sql = "select * from " . $this->tabla;
        }
        $result = $db->query( $sql );

        // convertir en un array 
        $listaarray = [];

        foreach( $result as $it => $item ){
            $listaarray[] = array( $item[0], $item[1] );        
        }
        
        // devolver
        return $listaarray;
    }
}
