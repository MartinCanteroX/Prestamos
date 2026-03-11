<?php

class Database {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $conn;

    // Se permite configurar datos de conexión; por defecto apunta a la BD local "prestamos"
    public function __construct(
        $host = "localhost",
        $dbname = "prestamos",
        $username = "root",
        $password = ""
    ){
        $this->host     = $host;
        $this->dbname   = $dbname;
        $this->username = $username;
        $this->password = $password;

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
            if (class_exists('depuracion')){
                depuracion::RegistrarError($e);
            }
            throw $e;
        }
    }

    // Ejecución de sentencias (SELECT, INSERT, UPDATE, DELETE)
    public function query($sql, $params = []) {
        try {
            $stmt = $this->conn->prepare($sql);
            $stmt->execute($params);
            return $stmt;

        } catch (PDOException $e) {
            if (class_exists('depuracion')){
                depuracion::RegistrarError($e);
            }
            throw $e;
        }
    }

    // Cerrar conexión
    public function close() {
        $this->conn = null;
    }
}
