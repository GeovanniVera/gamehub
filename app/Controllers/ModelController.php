<?php

namespace App\Controllers;

use MVC\Router;
use App\Controllers\BaseController;
use App\Classes\Middlewares;
use App\Classes\Validators;
use App\Interfaces\CrudInterface;
use App\Models\Model;

class ModelController extends BaseController implements CrudInterface
{

    public static function index(Router $router)
    {
        Middlewares::isAuth();
        $data = [];
        $data["exitos"] = extractMessages("exitos");
        $data["mensajes"] = extractMessages("mensajes");
        $data["errores"] = extractMessages("errores");
        $data["consoleModel"] = Model::all();
        $router->render("consoleModel/index", $data);
    }

    public static function create()
    {
        Middlewares::isAuth();
        $data = [
            "name" => "tapia",
            "description" => "alo"
        ];
        $errors = self::validateData($data);
        if (!empty($errors)) redirect("errores", $errors, "/consoleModel");
        $data = self::sanitizateData($data);
        $console = Model::arrayToObject($data);
        $nameExist = Model::where("name", $console->getName());
        if (!(is_null($nameExist))) redirect("errores", ["Genero Existente en la Base de Datos"], "/ConsoleModel");
        if (!Model::save($console)) {
            redirect("errores", ["Error al guardaren la Base de Datos"], "/ConsoleModel");
        }
        redirect("mensajes", ["Genero creado correctamente"], "/consoleModel");
    }

    public static function delete()
    {
        
    }

    public static function update()
    {
        
    }

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
