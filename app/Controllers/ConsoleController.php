<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use MVC\Router;
use App\Classes\Middlewares;
use App\Classes\Validators;
use App\Interfaces\CrudInterface;
use App\Models\Console;
use App\Models\Model;

class ConsoleController extends BaseController  {


    public static function index (Router $router){
        Middlewares::isAuth();
        $data = [];
        $data["exitos"]=extractMessages("exitos");
        $data["mensajes"]=extractMessages("mensajes");
        $data["errores"]=extractMessages("errores");
        $data["consoles"] = Console::joinModel();
        $router -> render("console/index", $data);
    }

    public static function create(){
        Middlewares::isAuth();
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $data = [
                "name" => $_POST['name'],
                "description" => $_POST['description'],
                "idModel" => $_POST['idModel'],
                "releaseDate" => $_POST["releaseDate"]
            ];
            $errors = self::validateData($data);
            if(!empty($errors)) redirect("errores", $errors, "/consolecreate");
            $data = self::sanitizateData($data);
            $console = Console::arrayToObject($data);
            $nameExist = Console::where("name",$console->getName());
            if(!(is_null($nameExist))) redirect("errores", ["Genero Existente en la Base de Datos"], "/consolecreate");
            if (!Console::save($console)) {
                redirect("errores", ["Error al guardar en la Base de Datos"], "/consolecreate");
            } 
            redirect("exitos",["Consola creada correctamente"],"/console");
        }
    }
    public static function form(Router $router){
        Middlewares::isAuth();
        $data = [];
        $data["exitos"]=extractMessages("exitos");
        $data["mensajes"]=extractMessages("mensajes");
        $data["errores"]=extractMessages("errores");
        $data["modelos"]= Model::all();
        $router -> render("console/form", $data);
    }
    public static function delete($id)
    {
        
    }

    public static function update($id)
    {
        var_dump($id);
    }

    /**
     * Metodo que valida datos
     * @param array $data
     * @return array $errors
     */
    protected static function validateData($data){
        $errors = [];
        $errors[] = self::validateEmpties($data);
        $errors[] = Validators::alfa($data['name'],"nombre");
        return array_filter($errors);
    }
}