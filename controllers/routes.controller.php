<?php
    class routes{
        public function main(){

            $controller = "main";
            $metodo = "main";
            $param_dato = "";
            $param = "";
            $basepath = "/miscuentas12/";

            // =================================
            // Controlador y metodo solicitado
            // =================================
            // Limpiar las lista de parametros
            $request = str_replace( $basepath, "", $_SERVER['REQUEST_URI'] );
            
            // Generar el array con los parametros
            $parametros_request = explode( "/", $request );
            $parametros_request = array_filter( $parametros_request);

            // Preparar controlador, metodo y posibles parametros
            if (count($parametros_request) >= 1){ 
                $controller = $parametros_request[0];
            }
            if (count($parametros_request) >= 2){ 
                $metodo = $parametros_request[1];
            }
            if (count($parametros_request) >= 3){ 
                $param = $parametros_request[2];
            }
            
            // =================================
            // Recuperar posibles parameros extras
            // =================================
            // analizar el metodo como se enviaron los posibles datos
            switch ($_SERVER['REQUEST_METHOD']){
                // Select
                case "GET":
                    $param_dato = $_GET;
                    break;
                
                // Insert
                case "POST":
                    // $param_dato = $_POST;
                    $param_dato = json_decode(file_get_contents('php://input'), true);
                    break;
                    
                // Update
                case "PUT":
                    $param_dato = $_POST;
                    break;
                    
                // Delete
                case "DELETE":
                    $param_dato = $_GET;
                    break;
                
                case "HEAD":
                case "PATCH":
            }

            // =================================
            // Control de Usurio
            // redefine el controlador / metodo 
            // =================================
            // $param_loginActivo = utiles::SessionVar('Sistema.LoginActivo');
            // if ($param_loginActivo == 'S') {
            //     $login = new login();
            //     /*  Si esta activado el login y no hay un usuario
            //         logueado y se quiere ir a otro modulo que no sea Login
            //         fuerza el Login
            //     */
            //     if ( $login->getcurrent() == 0 && $controller != "login" ){
            //         $controller = "login";
            //         $metodo = "pedirUsuario";
            //     }
            // }

            // =================================
            // Testear que exista el controlador
            // si no existe, re dirige a la pagina ppal
            // =================================
            // $controller = "main";
            if ( ! class_exists($controller)){
                $controller = "main";
                $metodo = "main";
            }

            // ---------------------------------------
            // Cargar el controlador
            // ---------------------------------------
            $el_controlador = new $controller;
            
            // ---------------------------------------
            // Se ejecuta el comando solicitado 
            // ---------------------------------------
            $respuesta = $el_controlador->$metodo( $param, $param_dato );
            
            echo $respuesta;
        }
 }
