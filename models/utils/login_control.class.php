<?php

//*********************
// Clase para solicitar el login
// dispara el formulario Login.php e invoca a Login_procesar.php para validar
// 
//*********************

class login_control {

    // Property UserName
    public static function username(){
        if ( ! isset( $_SESSION['username'])){
            $username = "";
        }else{
            $username = $_SESSION['username'];
        }
        return $username;
    } 

    // Property LoginIntentos
    public static function login_intentos( $sumar_intento = false ){
        if ( ! isset( $_SESSION['login_intentos'])){
            $_SESSION['login_intentos'] = 0;
        }

        // si se quiere sumar un intento
        if ( $sumar_intento){
            $_SESSION['login_intentos']++;
        }
        
        return $_SESSION['login_intentos'];
    }
    
    // Resetear los intentos de login
    public static function login_intentos_reset(){
        if ( isset( $_SESSION['login_intentos'])){
            $_SESSION['login_intentos'] = 0;
        }
    }

    // Controlar si hay un usuario logueado o no
    public static function control() {
        if ( self::islogueado()){
            return true;
        }

        // No lo hay...invocar el formulario de login
        self::dologin();
    }

    // Devolver si hay un usuario
    public static function islogueado() {
        return ( self::username() );
    }

    // Invocar el formulario de login
    public static function dologin(){
        header("location:login.php");
        exit;
    }

    // Control de usuario ingresado en el formulario de login
    // se valida contra la DB
    public static function validar_login( $username, $clave ){
        if ( $username ){
            // Vino un usuario valido

            // Instanciar el usuario
            $login = new login( $username );
            if ( $login ){
                // El usuario existe, validar la clave
                if ( $clave == $login->get_clave()){

                    // setear la variable global 
                    $_SESSION['username'] = $username;
                    $_SESSION['usuarioname'] = $username;
                    $_SESSION['esadmin'] = $login->get_EsAdmin();

                    // resetear la cantidad de intentos de login
                    self::login_intentos_reset();

                    return true;
                }
            }
        }

        // cualquier causa por la que llego aca...esta mal
        // incrementar un intento mas 
        self::login_intentos( true );

        // y volver a invocar la pagina de login
        self::dologin();
    }
}

?>