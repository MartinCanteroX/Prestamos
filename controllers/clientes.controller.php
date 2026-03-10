<?php
class clientes
{

    /*
        Presentar la pantalla para mostrar los clientes
    */
    public function main()
    {
        include "views/clientes.php";
    }

    /*
        Presentar la pantalla para un nuevo cliente
    */
    public function new()
    {

        // cargar todas las tablas necesarias para la edicion
        $lista

        // presentar la pantalla para su edicion
        include "views/clientes_edicion.php";
    }

    /*
        Cargar los datos del cliente y presentarlo para su edicion
    */
    public function edit( $parametro, $datos )
    {
        include "views/clientes_edicion.php";
    }

    /*
        Ubicar vencimientos 
        Filtros: Periodo, Cuenta, Categoria, Tipo 
        Devolver HTML
    */
    public function get($parametro, $datos)
    {
        $ok = True;

        try{

            // ---------------------------------
            // Parametros 
            // ---------------------------------
            $hoy        = fechas::Hoy(false, false);
            
            // Acomodar los parametros de busqueda
            if ( ! isset($datos['hasta']) ||  $datos['hasta'] = ''){
                $datos['hasta'] = $hoy;
            }

            // recuperar los datos
            $cliente = new cliente_model();
            $data = $cliente->getAll( $datos );
            $htmlADevolver = generadores::getHtmlClientes( $data );

            $respuesta = $htmlADevolver;

        } catch( Exception $e ) {
                depuracion::RegistrarError( $e );
        }

        // ---------------------------------
        // Devolver la respuesta
        // --------------------------------- 
        // ob_end_clean();
        return $respuesta;        
    }

    // ----------------------------
    //  Grabar 
    // ----------------------------
    public function save($parametro, $datos)
    {
    
    }

    // ----------------------------
    //  Eliminar un cliente
    // ----------------------------
    public function delete($parametro, $datos)
    {
    
    }

    // ----------------------------
    //  Buscar
    // ----------------------------
    public function buscar($parametro, $datos)
    {
    
    }

    // ----------------------------
    //  Devolver los prestamos de un cliente
    // ----------------------------
    public function getPrestamos($parametro, $datos)
    {
    
    }

}