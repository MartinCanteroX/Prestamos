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
        $tiposiva = new tiposiva_model();
        $tablocalidades = new tablalocalidades_model();
        $tabprovincias = new tablaprovincias_model();
        $tiposestcivil = new tiposestciviles_model();
        $tipossexo = new tiposexo_model();
        $tiposdocum = new tiposdocumentos_model();
        $tiposiibb = new tiposiibb_model();

        // Instanciar la clase 
        $utilesforms = new utilesforms();

        // Generar las listas en version HTML
        $tiposivaHtml = $utilesforms->genComboFromArray( $tiposiva->getAll(), "listaiva", 0, "","(seleccionar)");
        $tablocalidadesHtml = $utilesforms->genComboFromArray( $tablocalidades->getAll(), "tablocalidades", 0, "","(seleccionar)");
        $tabprovinciasHtml = $utilesforms->genComboFromArray( $tabprovincias->getAll(), "tabprovincias", 0, "","(seleccionar)");
        $tiposestcivilHtml = $utilesforms->genComboFromArray( $tiposestcivil->getAll(), "tiposestcivil", 0, "","(seleccionar)");
        $tipossexoHtml = $utilesforms->genComboFromArray( $tipossexo->getAll(), "tipossexo", 0, "","(seleccionar)");
        $tiposdocumHtml = $utilesforms->genComboFromArray( $tiposdocum->getAll(), "tiposdocum", 0, "","(seleccionar)");
        $tiposiibbHtml = $utilesforms->genComboFromArray( $tiposiibb->getAll(), "tiposiibb", 0, "","(seleccionar)");

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