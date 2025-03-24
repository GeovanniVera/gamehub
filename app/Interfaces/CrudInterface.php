<?php
namespace App\Interfaces;

use MVC\Router;

interface CrudInterface {
    public static function index(Router $router);
    public static function create();
    public static function delete(Router $router,$params);
    public static function update(Router $router, $params);
    public static function updateProcess();

}