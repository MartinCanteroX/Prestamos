<?php

require_once "./include/autoload.php";

class main{

    public function main(){
        $htmlVencimientos = "";
        $htmlMovimientos = "";
        $htmlSaldoCuentas = "";
        $htmlVencimientosPorFecha = "";
        $htmlVencimientosPorCuenta = "";

        // Si hay usuario, se Invoca la pagina principal y usa todas las variables 
        // arriba declaradas
        include "views/main.php";
    }

    // ----------------------------
    // Inicializar el sistema
    // ----------------------------
    // public function inicializar(){
    //     $sistemaVersion = utiles::getParametro('sistema.version');
    //     $param_loginActivo = utiles::getParametro('sistema.segurirdad.loginactivo');

    //     // Guardar la version actual del sistema
    //     utiles::SessionVar('Sistema.Version', $sistemaVersion);

    //     // Login Activo ?
    //     utiles::SessionVar('Sistema.LoginActivo', $param_loginActivo);

    //     // Vaciar el UsuarioID 
    //     utiles::SessionVarDel('usuarioid');

    //     // Buscar la empresa por defecto ( si corresponde )
    //     if ($sistemaVersion != 'ME'){
    //         $empresa_activaId = utiles::getParametro('empresa.activa.id', 0);
    //         if ( $empresa_activaId > 0){
    //             $empresa = new empresa_model( $empresa_activaId);

    //             // Guardar el ID y el nonbre de la empresa activa
    //             utiles::SessionVar('empresa.activa.id', $empresa_activaId);
    //             utiles::SessionVar('empresa.activa.nombre', $empresa->get_nombre());

    //         }
    //     }

    //     // Marcar el sistema como inicializado
    //     utiles::SessionVar('SISTEMA_INICIALIZADO', 'SI');

    // }
    
}
