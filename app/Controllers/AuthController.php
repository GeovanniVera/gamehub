<?php

namespace App\Controllers;

use App\Classes\Middlewares;
use App\Classes\Session;
use App\Classes\Validators;
use App\Models\User;
use MVC\Router;

class AuthController extends BaseController{
    public static function login(Router $router){
        Middlewares::isGuest();
        $data = [];
        $data["errores"] = extractMessages("errores");
        $data["exitos"] = extractMessages("exitos");
        $router->render('auth/login',$data);
    }   

    /**
     * Metodo que procesa la informacion del login 
     * @param  $_POST -> email, login
     * 
     */
    public static function loginProcess(){
        Middlewares::isGuest();
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $data = ["email" => $_POST['email'],"password"=> $_POST['password']];
            $errors = self::validateData($data);
            if(!empty($errors))redirect("errores",$errors,"/");
            $data = self::sanitizateData($data);
            $user = User::where('email',$data['email']);
            if(!$user) redirect("errores",['Usuario no registrado.'],"/");
            $password_verify = $user->verifyPassword($data['password']);
            if(!$password_verify) redirect("errores",['Contraseña Incorrecta'],"/"); 
            redirect("user",$user,"/dashboard");
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