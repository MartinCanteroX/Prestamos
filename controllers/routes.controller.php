<?php

class routes {
    public function main() {

        // Valores por defecto
        $controller  = "main";
        $metodo      = "main";
        $param       = "";
        $param_dato  = "";

        // Base del proyecto (si existe una constante, se usa; si no, se mantiene el valor actual)
        $basepath = defined('BASE_PATH') ? BASE_PATH : "/prestamos/";

        // =================================
        // Normalizar la URL solicitada
        // =================================
        $requestUri  = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $requestPath = str_replace($basepath, "/", $requestUri);
        $requestPath = "/" . trim($requestPath, "/");
        if ($requestPath === "//" || $requestPath === "") {
            $requestPath = "/";
        }

        // =================================
        // Tabla de rutas explícitas
        // =================================
        $routes = [
            'GET' => [
                '/'                   => ['controller' => 'main',      'method' => 'main'],
                '/login'              => ['controller' => 'login',     'method' => 'pedirusuario'],
                '/clientes'           => ['controller' => 'clientes',  'method' => 'main'],
                '/clientes/nuevo'     => ['controller' => 'clientes',  'method' => 'new'],
                '/clientes/buscar'    => ['controller' => 'clientes',  'method' => 'buscar'],
                '/prestamos'          => ['controller' => 'prestamos', 'method' => 'main'],
                '/prestamos/nuevo'    => ['controller' => 'prestamos', 'method' => 'new'],
                '/prestamos/buscar'   => ['controller' => 'prestamos', 'method' => 'buscar'],
            ],
            'POST' => [
                // Ejemplos de rutas POST habituales
                // '/login/acceder'     => ['controller' => 'login',    'method' => 'acceder'],
                // '/clientes/guardar'  => ['controller' => 'clientes', 'method' => 'save'],
            ],
        ];

        $httpMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';

        // =================================
        // Resolver ruta → controlador/método
        // =================================
        if (isset($routes[$httpMethod][$requestPath])) {
            $controller = $routes[$httpMethod][$requestPath]['controller'];
            $metodo     = $routes[$httpMethod][$requestPath]['method'];
        } else {
            // Fallback compatible con la versión anterior:
            // /controlador/metodo/param
            $request = str_replace($basepath, "", $requestUri);
            $parametros_request = explode("/", $request);
            $parametros_request = array_filter($parametros_request);

            if (count($parametros_request) >= 1) {
                $controller = $parametros_request[0];
            }
            if (count($parametros_request) >= 2) {
                $metodo = $parametros_request[1];
            }
            if (count($parametros_request) >= 3) {
                $param = $parametros_request[2];
            }
        }

        // =================================
        // Recuperar posibles parámetros extra
        // =================================
        switch ($httpMethod) {
            case "GET":
                $param_dato = $_GET;
                break;

            case "POST":
                // Se prioriza JSON (fetch/AJAX). Si viene vacío, se podría usar $_POST.
                $jsonBody = file_get_contents('php://input');
                $decoded  = json_decode($jsonBody, true);
                $param_dato = is_array($decoded) ? $decoded : $_POST;
                break;

            case "PUT":
                $param_dato = $_POST;
                break;

            case "DELETE":
                $param_dato = $_GET;
                break;

            case "HEAD":
            case "PATCH":
                $param_dato = [];
                break;
        }

        // =================================
        // Control de Usuario (Login)
        // =================================
        $login = new login();
        if ($login->getcurrent() == 0 && $controller !== "login") {
            $controller = "login";
            $metodo     = "pedirusuario";
        }

        // =================================
        // Validar controlador y método
        // =================================
        if (!class_exists($controller)) {
            $controller = "main";
            $metodo     = "main";
        }

        $el_controlador = new $controller;

        if (!method_exists($el_controlador, $metodo)) {
            // Si el método no existe, se vuelve a la página principal
            $controller = "main";
            $metodo     = "main";
            $el_controlador = new $controller;
        }

        // ---------------------------------------
        // Ejecutar comando solicitado
        // ---------------------------------------
        $respuesta = $el_controlador->$metodo($param, $param_dato);
        echo $respuesta;
    }
}
