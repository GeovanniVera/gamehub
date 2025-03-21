<?php

namespace App\Controllers;

use App\Classes\Middlewares;
use App\Classes\Session;
use App\Classes\Validators;
use App\Models\User;
use MVC\Router;

class AuthController extends BaseController{
    public static function login(Router $router){
        Middlewares::isAuth();
        $data = [];
        if (Session::has('errores')) {
            $data['errores'] = Session::get('errores');
            Session::delete('errores');
        }
        if (Session::has('exitos')) {
            $data['exitos'] = Session::get('exitos');
            Session::delete('exitos');
        }
        $router->render('auth/login',$data);
    }   

    /**
     * Metodo que procesa la informacion del login 
     * @param  $_POST -> email, login
     * 
     */
    public static function loginProcess(){
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $data = [
                "email" => $_POST['email'],
                "password"=> $_POST['password']
            ];
            $errors = self::validateData($data);
            if(!empty($errors)){
                Session::set("errores",$errors);
                header("Location: /");
                exit;
            }
            $data = self::sanitizateData($data);
            var_dump($data['email']);
            $user = User::where('email',$data['email']);
            var_dump($user); 
        }        
    }

    /**
     * Metodo para cerrar la sesion del usuarios
     */
    public static function logout(){
        Session::destroy();
        header('Location: /');
    }
    
    /**
     * Metodo para vlidar los datos del formulario
     * @param array $data
     * @return array $errors
     */
    protected static function validateData($data){
        $errors = [];
        $errors[] = self::validateEmpties($data);
        $errors[] = Validators::email($data['email'],'email');
        return array_filter($errors);
    }
}