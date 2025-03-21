<?php 

require_once __DIR__ . '/../app/Classes/app.php';

use App\Controllers\AuthController;
use App\Controllers\RegisterController;
use App\Controllers\DashboardController;

use MVC\Router;

$router = new Router();

//Login 
$router->get('/',[AuthController::class,'login']);
$router->post('/',[AuthController::class,'loginProcess']);
$router->get('/logout',[AuthController::class,'logout']);


//Crear Cuenta
$router->get('/register',[RegisterController::class,'register']);
$router->post('/register',[RegisterController::class,'saveUser']);

//Dashboard 
$router->get('/dashboard',[DashboardController::class,'index']);
// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();