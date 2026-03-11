<?php
class prestamos
{
    /*
        Presentar la pantalla para mostrar los prestamos
    */
    public function main()
    {
        // Vista principal de prestamos (por crear)
        include "views/prestamos.php";
    }

    /*
        Presentar la pantalla para un nuevo prestamo
    */
    public function new()
    {
        // Vista de edición de prestamo (por crear)
        include "views/prestamos_edicion.php";
    }

    /*
        Cargar los datos del prestamo y presentarlo para su edicion
    */
    public function edit($parametro, $datos)
    {
        include "views/prestamos_edicion.php";
    }

    /*
        Devolver la lista de prestamos segun filtros
        Por ahora solo devuelve cadena vacía; se puede
        completar luego con HTML o JSON como en clientes.
    */
    public function get($parametro, $datos)
    {
        $respuesta = '';

        try {
            $prestamo = new prestamo_model();
            $data = $prestamo->getAll($datos);

            // TODO: generar HTML con los datos (similar a clientes)
            // $respuesta = generadores::getHtmlPrestamos($data);
        } catch (Exception $e) {
            if (class_exists('depuracion')) {
                depuracion::RegistrarError($e);
            }
        }

        return $respuesta;
    }

    // ----------------------------
    //  Grabar 
    // ----------------------------
    public function save($parametro, $datos)
    {
        // Implementar logica de grabacion mas adelante
    }

    // ----------------------------
    //  Eliminar un prestamo
    // ----------------------------
    public function delete($parametro, $datos)
    {
        // Implementar logica de borrado mas adelante
    }

    // ----------------------------
    //  Buscar prestamos (alias de get)
    // ----------------------------
    public function buscar($parametro, $datos)
    {
        return $this->get($parametro, $datos);
    }
}

