<?php

require_once "./include/autoload.php";
require_once "./include/init_sets.php";

// =================================
// Inicializar el sistema
// =================================
// if (utiles::SessionVar('SISTEMA_INICIALIZADO') == 'NO') {
//     $mainApp = new main();
//     $mainApp->inicializar();
// }

// =================================
// Todos los Requerimientos se redirigen 
// =================================
$main = new routes();
$main->main();

?>

<!-- Validaciones del formulario -->
<script type="text/javascript" src="<?php echo BASE_URL_JS ?>init_sets.js"></script>