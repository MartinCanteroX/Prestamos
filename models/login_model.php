<?php
// Objeto para adeministrar los login
class login_model extends objeto{
    function __construct( $objid = 0, $nombre = ''){
        parent::__construct( "usuario", $objid, $nombre );
    }

    // set/get clave
    // -----------
    public function set_clave($nuevo_clave){;
        $this->set_atributo_valor_bynombre( nombre: 'clave', valor: $nuevo_clave);
    }
    
    public function get_clave(){
        return $this->get_atributo_valor_bynombre( nombre: 'clave');
    }
    
    // set/get pistarecupero
    // -----------
    public function set_pistarecupero($nuevo_pistarecupero){;
        $this->set_atributo_valor_bynombre( nombre: 'pistarecupero', valor: $nuevo_pistarecupero);
    }
    
    public function get_pistarecupero(){
        return $this->get_atributo_valor_bynombre( nombre: 'pistarecupero');
    }
    
    // set/get fechaalta
    // -----------
    public function set_fechaalta($nuevo_fechaalta){;
        $this->set_atributo_valor_bynombre( nombre: 'fechaalta', valor: $nuevo_fechaalta);
    }
    
    public function get_fechaalta(){
        return $this->get_atributo_valor_bynombre( nombre: 'fechaalta');
    }
    
    
} 