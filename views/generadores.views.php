<?php

// ==================================
// Administracion de los objetos de este tipo
// ==================================

class generadores{

    /* --------------------------
     Generar el listado de cllientes
     Data = son los clientes conseguidos con el metodo
     --------------------------
    */
    public static function getHtmlClientes( $data ){
        $tablas         = new utilestablasbs();
        $htmlADevolver  = "";
        $htmlADevolver .= $tablas->Nueva("", "sm", true, false, true, true, false   );
        
        // Titulos de las columnas
        $titulos = array( "Apellido", "Nombre", "Numero", "FechaAlta" );
        $htmlADevolver .= $tablas->SetTitulos( $titulos );

        // Fecha de hoy
        $hoy = fechas::Hoy(true);

        // Iconos de Accion
        $icono_Ver = utiles::SessionVar("ICONOS_VER");
        $icono_Editar = utiles::SessionVar("ICONOS_EDITAR");
        $icono_Eliminar = utiles::SessionVar("ICONOS_ELIMINAR");

        // Links de acciones
        $linkbase    = "clientes";
        $linkeditfull = $linkbase . "_edit";
        $linkdelete   = $linkbase . "_delete";

        // Dibujarlas
        foreach( $data as $lm => $cliente ){
        
            $id               = $cliente['id'];
            $apellido     = $cliente['apellido'];
            $nombre     = $cliente['nombre'];
            $numero     = $cliente['numero'];
            $fechaalta   = $cliente['fechaalta'];

            // Generar las columnas
            $htmlADevolver .= $tablas->NuevaFila();
            $htmlADevolver .= $tablas->NuevoDato( $apellido);
            $htmlADevolver .= $tablas->NuevoDato( $nombre );
            $htmlADevolver .= $tablas->NuevoDato( $numero );
            $htmlADevolver .= $tablas->NuevoDato( $fechaalta );
            
            // Botones de accion (se puede personalizar cual mostrar y cual no)
            $htmlADevolver .= $tablas->BotonClassJs( $icono_Ver           . " accion.clientes.ver",    "Consultar datos", $id  );
            $htmlADevolver .= $tablas->BotonClassJs( $icono_Editar      .  " accion.clientes.editar" ,  "Editar datos del cliente", $id  );
            $htmlADevolver .= $tablas->BotonClassJs( $icono_Eliminar   . " accion.clientes.eliminar" ,  "Eliminar al cliente", $id  );
        }
        
        // Fin de la tabla
        $htmlADevolver .= $tablas->Fin();
                
        return $htmlADevolver;

    }
}
 