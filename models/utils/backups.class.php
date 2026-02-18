<?php

// -----------------------------------------
// Backup de bases de datos de MySql
// -----------------------------------------
class Backups{

    private $base;
    private $usuario_db;
    private $server;
    private $clave_db;
    
    //
    // ejecutar un backup, zipear y descargar el archivo
    //
    function dobackup(){

        // cargar los datos de la conexion de la base de datos
        include "include/conexion.php";
        
        // preparar los parametros
        $fecha_backup = date("Ymd-His");
        $archivo_sql = $this->base . "_" . $fecha_backup . ".sql";
        
        // linea de comando a ejecutar
        $sql = "mysqldump --no-defaults -h" . $this->server . " -u" . $this->usuario_db . " -p" . $this->clave_db . " --opt $this->base > $archivo_sql";
        
        // ejecutar el comando
        system( $sql, $output); 
        
        // Zipear
        $zip = new ZipArchive();
        $archivo_zip = $this->base . "_" . $fecha_backup . ".zip";

        // crear el zip
        if ( $zip->open( $archivo_zip, ZIPARCHIVE::CREATE) === true ){
            $zip->addFile( $archivo_sql );
            $zip->close();

            // eliminar el archivo original
            unlink( $archivo_sql);

            // descargar
            return $archivo_zip;
        }

    }
}
?>