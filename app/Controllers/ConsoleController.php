<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use MVC\Router;
use App\Classes\Middlewares;
use App\Classes\Validators;
use App\Interfaces\CrudInterface;
use App\Models\Console;

class ConsoleController extends BaseController implements CrudInterface {


    public static function index (Router $router){
        Middlewares::isAuth();
        $data = [];
        $data["exitos"]=extractMessages("exitos");
        $data["mensajes"]=extractMessages("mensajes");
        $data["errores"]=extractMessages("errores");
        $data["console"] = Console::all();
        $router -> render("console/index", $data);
    }

    public static function create(){
        Middlewares::isAuth();
        if($_SERVER['REQUEST_METHOD'=="POST"]){
            $data = [
                "name" => $_POST['name'],
                "description" => $_POST['description'],
                "idModel" => $_POST['model'],
                "releaseDate" => $_POST["releaseDate"]
            ];
            $errors = self::validateData($data);
            if(!empty($errors)) redirect("errores", $errors, "/console");
            $data = self::sanitizateData($data);
            $console = Console::arrayToObject($data);
            $nameExist = Console::where("name",$console->getName());
            if(!(is_null($nameExist))) redirect("errores", ["Genero Existente en la Base de Datos"], "/console");
            if (!Console::save($console)) {
                redirect("errores", ["Error al guardaren la Base de Datos"], "/ConsoleModel");
            } 
            redirect("mensajes",["Consola creada correctamente"],"/consoleModel");
        }
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
    protected static function validateData($data){
        $errors = [];
        $errors[] = self::validateEmpties($data);
        $errors[] = Validators::alfa($data["name"], "nombre");
        return array_filter($errors);
    }
}