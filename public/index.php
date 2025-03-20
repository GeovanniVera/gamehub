<?php 

require_once __DIR__ . '/../app/Classes/app.php';

use App\Controllers\AuthController;
use App\Controllers\RegisterController;
use MVC\Router;

$router = new Router();

//Login 
$router->get('/',[AuthController::class,'login']);
$router->post('/',[AuthController::class,'loginProcess']);
$router->get('/logout',[AuthController::class,'logout']);

//Recuperar password
$router->get('/forgetPassword',[AuthController::class,'forgetPassword']);
$router->post('/forgetPassword',[AuthController::class,'forgetPassword']);
$router->get('/recoveryPassword',[AuthController::class,'recoveryPassword']);
$router->post('/recoveryPassword',[AuthController::class,'recoveryPassword']);

//Crear Cuenta
$router->get('/register',[RegisterController::class,'register']);
$router->post('/register',[RegisterController::class,'saveUser']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();