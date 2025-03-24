<?php 
require_once __DIR__ . '/../app/Classes/app.php';

use App\Controllers\AuthController;
use App\Controllers\RegisterController;
use App\Controllers\DashboardController;
use App\Controllers\GenreController;
use App\Controllers\ConsoleController;
use App\Controllers\ModelController;
use App\Controllers\VideogameController;
use MVC\Router;

$router = new Router();

// Login 
$router->get('/', [AuthController::class, 'login']);
$router->post('/', [AuthController::class, 'loginProcess']);
$router->get('/logout', [AuthController::class, 'logout']);

// Crear Cuenta
$router->get('/register', [RegisterController::class, 'register']);
$router->post('/register', [RegisterController::class, 'saveUser']);

// Dashboard 
$router->get('/dashboard', [DashboardController::class, 'index']);

// Generos
$router->get('/genre', [GenreController::class, 'index']);
$router->post('/genre', [GenreController::class, 'create']);
$router->get('/genreUpdate/:id', [GenreController::class, 'update']);      // Con parámetro
$router->post('/genreUpdate/:id', [GenreController::class, 'updateProcess']); // Con parámetro
$router->get('/genreDelete/:id', [GenreController::class, 'delete']);     // Con parámetro
$router->get('/genrecreate', [GenreController::class, 'form']);

// Consolas
$router->get('/console', [ConsoleController::class, 'index']);
$router->post('/console', [ConsoleController::class, 'create']);
$router->get('/consoleUpdate/:id', [ConsoleController::class, 'update']);    // Con parámetro
$router->post('/consoleUpdate/:id', [ConsoleController::class, 'updateProcess']); // Con parámetro
$router->get('/consoleDetails/:id', [ConsoleController::class, 'details']);  // Con parámetro
$router->get('/consoleDelete/:id', [ConsoleController::class, 'delete']);    // Con parámetro
$router->get('/consolecreate', [ConsoleController::class, 'form']);

// Modelo de las consolas
$router->get('/consoleModel', [ModelController::class, 'index']);
$router->get('/consoleModelUpdate/:id', [ModelController::class, 'update']);   // Con parámetro
$router->post('/consoleModelUpdate/:id', [ModelController::class, 'updateProcess']);  // Con parámetro
$router->get('/consoleModelDelete/:id', [ModelController::class, 'delete']);  // Con parámetro
$router->post('/consoleModel', [ModelController::class, 'create']);
$router->get('/consoleModelcreate', [ModelController::class, 'form']);

// Videojuegos
$router->get('/videogames', [VideogameController::class, 'index']);
$router->post('/videogames', [VideogameController::class, 'create']);
$router->get('/videogamesUpdate/:id', [VideogameController::class, 'update']);    // Con parámetro
$router->post('/videogamesUpdate/:id', [VideogameController::class, 'updateProcess']); // Con parámetro
$router->get('/videogameDetails/:id', [VideogameController::class, 'details']);  // Con parámetro
$router->get('/videogamesDelete/:id', [VideogameController::class, 'delete']);   // Con parámetro
$router->get('/videogamescreate', [VideogameController::class, 'form']);

// Validar rutas
$router->comprobarRutas();