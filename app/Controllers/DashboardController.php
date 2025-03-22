<?php

namespace App\Controllers;
use App\Classes\Middlewares;
use App\Controllers\BaseController;
use MVC\Router;
use App\Classes\Session;

class DashboardController extends BaseController
{
    public static function index(Router $router){
        Middlewares::isAuth();
        $data = [];
        $data['mensajes'] = extractMessages("mensajes");
        if(Session::has('user')) $data['user']=Session::get('user');
        $router->render("auth/dashboard",$data);
    }
    protected static function validateData($data) {}
}
