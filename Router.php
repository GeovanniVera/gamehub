<?php

namespace MVC;

class Router
{
    public array $getRoutes = [];
    public array $postRoutes = [];

    // Método para definir rutas GET
    public function get($url, $fn)
    {
        $this->getRoutes[$url] = $fn;
    }

    // Método para definir rutas POST
    public function post($url, $fn)
    {
        $this->postRoutes[$url] = $fn;
    }

    // Método para comprobar y manejar las rutas
    public function comprobarRutas()
    {
        $currentUrl = $_SERVER['REQUEST_URI'] ?? '/';
        $currentUrl = strtok($currentUrl, '?'); // Elimina parámetros GET
        $method = $_SERVER['REQUEST_METHOD'];

        $routes = ($method === 'GET') ? $this->getRoutes : $this->postRoutes;

        foreach ($routes as $route => $fn) {
            // Convertir ruta a regex (ej: '/user/:id' → '/user/(?P<id>[^/]+)')
            $routeRegex = preg_replace('/:(\w+)/', '(?P<$1>[^/]+)', $route);
            $routeRegex = "#^$routeRegex$#";

            if (preg_match($routeRegex, $currentUrl, $matches)) {
                // Capturar parámetros dinámicos
                $params = array_filter($matches, 'is_string', ARRAY_FILTER_USE_KEY);

                // Capturar parámetros GET
                $queryParams = [];
                if (strpos($_SERVER['REQUEST_URI'], '?') !== false) {
                    $urlParts = parse_url($_SERVER['REQUEST_URI']);
                    parse_str($urlParts['query'], $queryParams);
                }

                // Combinar parámetros dinámicos y GET
                $allParams = array_merge($params, $queryParams);

                // Llamar a la función con los parámetros
                call_user_func($fn, $this, $allParams);
                return;
            }
        }

        // Si no se encuentra la ruta
        include __DIR__ . '/app/views/errors/404.php';
    }

    // Método para renderizar las vistas
    public function render($view, $datos = [])
    {
        // Asignar los datos a las variables
        foreach ($datos as $key => $value) {
            $$key = $value;
        }

        ob_start(); // Inicia el buffer de salida

        // Incluir la vista
        include_once __DIR__ . "/app/views/$view.php";
        $contenido = ob_get_clean(); // Obtener el contenido y limpiarlo del buffer

        // Incluir el layout con el contenido
        include_once __DIR__ . '/app/views/layout.php';
    }
}
