<?php
class prestamo_model
{
    private $db;

    // --------------------------
    // Devolver la lista de prestamos segun los filtros
    // --------------------------
    public function getAll($datos)
    {
        if ($this->db === null) {
            $this->db = new Database;
        }

        // Por ahora no se aplican filtros, se puede extender
        // usando $datos (fechas, cliente, estado, etc.)
        $param = [];
        $sql = "select * from prestamos";

        $stmt  = $this->db->query($sql, $param);
        $lista = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $this->db->close();

        return $lista;
    }
}

