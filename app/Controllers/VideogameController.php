<?php

namespace App\Controllers;

use MVC\Router;
use App\Controllers\BaseController;
use App\Classes\Middlewares;
use App\Classes\Validators;
use App\Interfaces\CrudInterface;
use App\Models\Videogame;

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
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $data = [
                "name" => $_POST['name'],
                "description" => $_POST['description'],
            ];
            $errors = self::validateData($data);
            if (!empty($errors)) redirect("errores", $errors, "/videogames");
            $data = self::sanitizateData($data);
            $videogame = Videogame::arrayToObject($data);
            $nameexist = Videogame::where("name", $videogame->getName());
            if (!(is_null($nameexist))) redirect("errores", ["Videojuego Existente en la Base de Datos"], "/videogames");
            if (!Videogame::save($videogame)) {
                redirect("errores", ["Error al guardar en la Base de Datos"], "/videogames");
            }
            redirect("exitos", ["Videojuego creado correctamente"], "/videogames");
        }
    }

    public static function form(Router $router){
        Middlewares::isAuth();
        $data = [];
        $data["exitos"]=extractMessages("exitos");
        $data["mensajes"]=extractMessages("mensajes");
        $data["errores"]=extractMessages("errores");
        $router -> render("videogames/form", $data);
    }
    public static function delete() {}

    public static function update() {}

    /**
     * Metodo que valida datos
     * @param array $data
     * @return array $errors
     */
    protected static function validateData($data)
    {
        $errors = [];
        $errors[] = self::validateEmpties($data);
        $errors[] = Validators::alfa($data["name"], "nombre");
        return array_filter($errors);
    }
}
