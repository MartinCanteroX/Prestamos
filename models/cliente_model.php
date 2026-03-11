<?php
class cliente_model{
    private $db;

    // Sets/Gets de los campos 

    
    // --------------------------
    // Devolver la lista de clientes segun los filtros
    // --------------------------
    function getAll( $datos ){
        // objeto de base de datos
        if ($this->db == null) {
            $this->db = new Database;
        }

        // Preparar los parametros de busqueda
        $param = [];
        $param[] = $datos['desde'];
        $param[] = $datos['hasta']; 

        // armar la sentencia de busqueda segun los filtros
        if ( $datos['nombre']  && $datos['nombre'] != '') {
            $param[] = "%".$datos['nombre']."%";
            $sql = "select * from clientes where fechaalta between ? and ? and apellido like ?  order by fechaalta desc";
        } else {
            $sql = "select * from clientes where fechaalta between ? and ? order by fechaalta desc";
        }

        // TODO : Cambiar cuando esten todos los campos en la tabla de clientes
        $param =[];
        $sql = "select * from clientes "; 

        $stmt = $this->db->query( $sql, $param );
        $listaclientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Cerrar conexion
        $this->db->close();

        // aplicar
        return $listaclientes;
    }
    



    
}