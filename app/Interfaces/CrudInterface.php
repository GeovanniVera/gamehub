<?php
namespace App\Interfaces;

use MVC\Router;

interface CrudInterface {
    public static function index(Router $router);
    public static function create();
    public static function delete();
    public static function update();
}