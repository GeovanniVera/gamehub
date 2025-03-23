<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use MVC\Router;
use App\Classes\Middlewares;
use App\Classes\Validators;
use App\Models\Genre;

class GenreController extends BaseController {

    /**
     * Metodo que valida datos
     * @param array $data
     * @return array $errors
     */
    protected static function validateData($data){
        $errors = [];
        $errors[] = self::validateEmpties($data);
        $errors[] = Validators::alfa($data["name"], "nombre");
        return array_filter($errors);
    }

    public static function index (Router $router){
        Middlewares::isAuth();
        $data = [];
        $data["exitos"]=extractMessages("exitos");
        $data["mensajes"]=extractMessages("mensajes");
        $data["errores"]=extractMessages("errores");
        $data["genres"] = Genre::all();
        $router -> render("genre/index", $data);
    }

    public static function create(){
        Middlewares::isAuth();
        $data = [
            "name" => "geovas",
            "description" => "xd"
        ];
        $errors = self::validateData($data);
        if(!empty($errors)) redirect("errores", $errors, "/genre");
        $data = self::sanitizateData($data);
        $genre = Genre::arrayToObject($data);
        $nameexist = Genre::where("name",$genre->getName());
        if(!(is_null($nameexist))) redirect("errores", ["Genero Existente en la Base de Datos"], "/genre");
        $res = Genre::save($genre);
        redirect("mensajes",["Genero creado correctamente"],"/genre");
    }

    public static function form(Router $router){
        Middlewares::isAuth();
        $data = [];
        $data["exitos"]=extractMessages("exitos");
        $data["mensajes"]=extractMessages("mensajes");
        $data["errores"]=extractMessages("errores");
        $router -> render("genre/form", $data);
    }
}