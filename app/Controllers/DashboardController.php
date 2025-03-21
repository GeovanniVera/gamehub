<?php

namespace App\Controllers;
use App\Classes\Middlewares;
use App\Controllers\BaseController;
use MVC\Router;

class DashboardController extends BaseController
{
    public static function index(Router $router){
        Middlewares::isAuth();
        $data = [];
        $data['mensajes'] = extractMessages("mensajes");
        $router->render("auth/dashboard",$data);
    }
    protected static function validateData($data) {}
}
