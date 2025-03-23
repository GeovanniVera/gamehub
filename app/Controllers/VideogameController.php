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
        if($_SERVER['REQUEST_METHOD'=="POST"]){
            $data = [
                "name" => "tapia",
                "description" => "alo"
            ];
            $errors = self::validateData($data);
            if (!empty($errors)) redirect("errores", $errors, "/videogame");
            $data = self::sanitizateData($data);
            $console = Videogame::arrayToObject($data);
            $nameExist = Videogame::where("name", $console->getName());
            if (!(is_null($nameExist))) redirect("errores", ["Videojuego Existente en la Base de Datos"], "/videogame");
            if (!Videogame::save($console)) {
                redirect("errores", ["Error al guardaren la Base de Datos"], "/videogame");
            }
            redirect("mensajes", ["videojeugo creado correctamente"], "/videogame");
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
