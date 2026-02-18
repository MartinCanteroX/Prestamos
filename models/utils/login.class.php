<?php
// Objeto Cuentas: Contiene metodos para la coleccion de cuentas

class login extends objeto{

   function __construct( $nombre = '' ){
        parent::__construct( "login", 0, $nombre );

        if ( $nombre ){
           $this->find_byNombre( $nombre );
        }
    }
   
   // funcion SET password
   function set_clave( $clave ) {
      $this->set_atributo_valor_bynombre( 'clave', $clave );
   }
   
   // funcion GET clave
   function get_clave(){
      return $this->get_atributo_valor_bynombre('clave');
   }
 
   // function GET para saber si es un Admin
   function get_EsAdmin(){
      return $this->get_atributo_valor_bynombre('EsAdmin');
   }

}
?>