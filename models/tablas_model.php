<?php

class tablas_model {
    private $id = 0;
    private $nombre = '';
    private $tabla = "";

    function __construct( $id = 0, $nombre = ''){
        $this->id = $id;
        $this->nombre = $nombre;
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
    
    // ****************************************
    // Devolver todos los registros de la tabla
    // ****************************************
    public function getAll(){
        $db = new database();
        $sql = 'select id, nombre from ' . $this->tabla;
        $result = $db->query( $sql );

        // convertir en un array asociativo para devolver
        
    }
}
