<?php

namespace App\Controllers;

use MVC\Router;
use App\Controllers\BaseController;
use App\Classes\Middlewares;
use App\Interfaces\CrudInterface;
use App\Models\Console;
use App\Models\Genre;
use App\Models\Videogame;
use App\Services\VideogameServices;

class VideogameController extends BaseController implements CrudInterface
{

    public static function index(Router $router)
    {
        Middlewares::isAuth();
        $data = [];
        $data["exitos"] = extractMessages("exitos");
        $data["mensajes"] = extractMessages("mensajes");
        $data["errores"] = extractMessages("errores");
        $data["videogames"] = Videogame::all();
        $router->render("videogames/index", $data);
    }

    public static function create()
    {
        Middlewares::isAuth();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {


            //se recuperan los datos de la base de datos 
            $videogame = [
                "name" => $_POST['name'],
                "description" => $_POST['description'],
            ];

            $genres['id'] = $_POST['genres'];
            $consoles['id'] = $_POST['consoles'];
            $consoles['releaseDate'] = $_POST['releaseDate'];

            $data = [$videogame,$consoles,$genres];
            //se validan los datos
            $errors[] = self::validateData($data);


            if (!empty($errors)) redirect("errores", $errors, "/videogamescreate");

            //se sanitizan los datos
            $videogame = self::sanitizateData($videogame);

            //se mapean los objetos
            $videogame = Videogame::arrayToObject($videogame);
            $nameexist = Videogame::where("name", $videogame->getName());

            //se verifica que no exista en la base de datos
            if (!(is_null($nameexist))) redirect("errores", ["Videojuego Existente en la Base de Datos"], "/videogames");

            //Se guardara el videojuego por medio de una trasaccion
            $service = new VideogameServices();
            if (!($service->transactionVideoGame($videogame, $genres, $consoles))) {
                redirect("errores", ["Error al guardar en la Base de Datos"], "/videogames");
            }

            redirect("exitos", ["Videojuego creado correctamente"], "/videogames");
        }
    }

    public static function form(Router $router)
    {
        Middlewares::isAuth();
        $data = [];
        $data["exitos"] = extractMessages("exitos");
        $data["mensajes"] = extractMessages("mensajes");
        $data["errores"] = extractMessages("errores");
        $data["genres"] = Genre::all();
        $data['consoles'] = Console::all();
        $router->render("videogames/form", $data);
    }


    public static function details(Router $router, $params)
    {
        Middlewares::isAuth();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $id = (int) $params['id'];
            if (!is_numeric($id)) redirect("errores", ["Registro no valido"], "/videogames");
            $videogame = Videogame::find($id);
            if (is_null($videogame)) redirect("errores", ["Registro no existe"], "/videogames");
            $data = [];
            $data['videogame'] = $videogame;
            $router->render("videogames/details", $data);
        }
    }



    public static function delete(Router $router, $params)
    {
        Middlewares::isAuth();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $id = (int) $params['id'];
            if (!is_numeric($id)) redirect("errores", ["Registro no valido"], "/videogames");
            if (!Videogame::delete($id)) redirect("errores", ["No se pudo eliminar el registro"], "/videogames");
            redirect("exitos", ["Genero Eliminado Correctamente"], "/videogames");
        }
    }

    public static function update(Router $router, $params)
    {
        Middlewares::isAuth();
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $id = (int) $params['id'];
            if (!is_numeric($id)) redirect("errores", ["Registro no valido"], "/videogames");
            $videogame = Videogame::find($id);
            if (is_null($videogame)) redirect("errores", ["Registro no existe"], "/videogames");
            $data = [];
            $data["genres"] = Genre::all();
            $data['consoles'] = Console::all();
            $data['videogame'] = $videogame;
            $router->render("videogames/form", $data);
        }
    }

    public static function updateProcess()
    {
        Middlewares::isAuth();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $videogame = Videogame::arrayToObject($_POST);
            if (!Videogame::save($videogame)) redirect("errores", ["El registro no se pudo actualizar"], "/videogames");
            redirect("exitos", ["Genero actualizado correctamente"], "/videogames");
        }
    }

    /**
     * Metodo que valida datos
     * @param array $data
     * @return array $errors
     */
    protected static function validateData($data)
    {
        $errors = [];
        foreach( $data as $d){
            
            $errors = array_merge($errors,self::validateEmpties($d));    
        }
        return array_filter($errors);
    }
}
