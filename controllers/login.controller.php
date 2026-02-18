<?php
class login{
    /*
        Devolver el ID del usuario de la sesion actual
    */
    public function getcurrent(){
        $respuesta = utiles::SessionVar('usuarioid');
        if ($respuesta == ''){
            $respuesta = 0;
        }
        return $respuesta;
    }

    /*
        Pedir nuevo Usuario
    */
    public function pedirusuario(){
        include "views/login.php";
    }
    
    /*
        Nuevo Usuario
    */
    
    /*
        Eliminar un usuario
    */
        
    /*
        Cargar y devolver un usuario
    */
    public function get($parametro, $datos){
        $ok = false;
        $login = new login_model($datos['id'], $datos['nombre']);
        
        // Devolver la respuesta
        $resp = new ParamsDev();
        $resp->setData("id", $login->get_id());
        $resp->setData("clave", $login->get_clave());
        $resp->setData("nombre", $login->get_nombre());
        ob_end_clean();
        echo $resp->getDataAllJS();
        exit;
    }
    
    // ----------------------------
    //   Setear el ID del usuario activo
    // ----------------------------
    public function setCurrent( $parametro ){
        if ( $parametro ){
            utiles::SessionVar('usuarioid', $parametro);
        }

        // Devolver la respuesta
        $resp = new ParamsDev();
        $resp->setData("ok", True);
        ob_end_clean();
        echo $resp->getDataAllJS();
        exit;
    }


    /*
        Validar nueva clave
    */
}