<?php 

require_once __DIR__ . '/../app/Classes/app.php';

use App\Controllers\AuthController;
use App\Controllers\RegisterController;
use App\Controllers\DashboardController;
use App\Controllers\GenreController;
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

//Generos
$router->get('/genre',[GenreController::class,'index']);
$router->get('/genreUsuario',[GenreController::class,'create']);

// Comprueba y valida las rutas, que existan y les asigna las funciones del Controlador
$router->comprobarRutas();