<?php

// =================================
// Setear las variables publicas
// =================================

utiles::SessionVar('ICONOS_EDITARSIMPLE', "far fa-edit");
utiles::SessionVar('ICONOS_EDITAR', "fas fa-pencil-alt");
utiles::SessionVar('ICONOS_CONFIRMAR', "fas fa-check");
utiles::SessionVar('ICONOS_ELIMINAR', "far fa-trash-alt");
utiles::SessionVar('ICONOS_FOLDEROPEN', "far fa-folder-open");

utiles::SessionVar('SISTEMA_INICIALIZADO', "NO");

define( "BASE_URL"               ,  "http://localhost/prestamos/" );
define( "BASE_URL_IMG"           ,  "http://localhost/prestamos/views/img/" );
define( "BASE_URL_VIEWS"         ,  "http://localhost/prestamos/views/" );
define( "PATH_ICONOS_CUENTAS"    ,  "/views/img/iconos/cuentas/" );
define( "PATH_ICONOS_TIPOCUENTAS",  "/views/img/iconos/tipocuentas/" );
define( "BASE_URL_JS"            ,  "http://localhost/prestamos/js/" );

// =================================
// Activar el registro de errores
// =================================
ini_set('display_errors', 1);
ini_set("log_errors", 1);
ini_set("error_log",  "c:/xampp/htdocs/mvc/php_error_log");

// Guardar la version actual del sistema
// $sistemaVersion = utiles::getParametro('sistema.version');
// utiles::SessionVar('Sistema.Version', $sistemaVersion);

// Login Activo ?
// $param_loginActivo = utiles::getParametro('sistema.segurirdad.loginactivo');
// utiles::SessionVar('Sistema.LoginActivo', $param_loginActivo);

// Vaciar el UsuarioID 
// utiles::SessionVarDel('usuarioid');

