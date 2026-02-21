<?php
class database {
    private $host = "localhost";
    private $dbname = "prestamos";
    private $username = "root";
    private $password = "";
    private $conn;

    // Automaticamente se conecta al server
    public function __construct(){
        $this->connect();
    }

    // Apertura de conexión
    public function connect() {
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};dbname={$this->dbname};charset=utf8",
                $this->username,
                $this->password
            );
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->conn;

        } catch (PDOException $e) {
            die("Error de conexión: " . $e->getMessage());
        }
    }

    // Ejecución de sentencias (SELECT, INSERT, UPDATE, DELETE)
    public function query($sql, $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;

        } catch (PDOException $e) {
            die("Error en la consulta: " . $e->getMessage());
        }
    }

    // Cerrar conexión
    public function close() {
        $this->conn = null;
    }
}
