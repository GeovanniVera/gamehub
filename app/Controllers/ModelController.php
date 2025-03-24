<?php

namespace App\Controllers;

use MVC\Router;
use App\Controllers\BaseController;
use App\Classes\Middlewares;
use App\Classes\Validators;
use App\Interfaces\CrudInterface;
use App\Models\Console;
use App\Models\Model;

use function PHPSTORM_META\map;

class ModelController extends BaseController implements CrudInterface
{

    public static function index(Router $router)
    {
        Middlewares::isAuth();
        $data = [];
        $data["exitos"] = extractMessages("exitos");
        $data["mensajes"] = extractMessages("mensajes");
        $data["errores"] = extractMessages("errores");
        $data["consolesModels"] = Model::all();
        $router->render("consoleModel/index", $data);
    }

    public static function create()
    {
        Middlewares::isAuth();
        if ($_SERVER['REQUEST_METHOD'] == "POST") {

            $data = [
                "name" => $_POST['name']
            ];
            $errors = self::validateData($data);
            if (!empty($errors)) redirect("errores", $errors, "/consoleModelcreate");
            $data = self::sanitizateData($data);
            $console = Model::arrayToObject($data);
            $nameExist = Model::where("name", $console->getName());
            if (!(is_null($nameExist))) redirect("errores", ["Modelo Existente en la Base de Datos"], "/consoleModelcreate");
            if (!Model::save($console)) {
                redirect("errores", ["Error al guardaren la Base de Datos"], "/consoleModelcreate");
            }
            redirect("exitos", ["Modelo creado correctamente"], "/consoleModel");
        }
    }

    public static function form(Router $router)
    {
        Middlewares::isAuth();
        $data = [];
        $data["exitos"] = extractMessages("exitos");
        $data["mensajes"] = extractMessages("mensajes");
        $data["errores"] = extractMessages("errores");
        $router->render("consoleModel/form", $data);
    }
    public static function delete(Router $router, $params)
    {
        Middlewares::isAuth();
        if($_SERVER['REQUEST_METHOD'] =="GET"){
            $id =(int) $params['id'];
            if(!is_numeric($id)) redirect("errores",["Registro no valido"],"/consoleModel");
            $consolesCount = Console::where('idModel', $id); 
            if ($consolesCount)  redirect("errores",["El registro que intentas eliminar tiene datos asociados "],"/consoleModel");
            if (!Model::delete($id)) redirect("errores",["El registro que intentas eliminar tiene datos asociados"],"/consoleModel");
            redirect("exitos",["Registro Eliminado Correctamente"],"/consoleModel");
        }
    }

    public static function update(Router $router, $params)
    {
        Middlewares::isAuth();
        if($_SERVER['REQUEST_METHOD']=="GET"){
            $id =(int) $params['id'];
            if(!is_numeric($id)) redirect("errores",["Registro no valido"],"/consoleModel");
            $model = Model::find($id);
            if(is_null($model)) redirect("errores",["Registro no existe"],"/consoleModel");
            $data=[];
            $data["model"]= $model;
            $router->render("consoleModel/form",$data);

        }
    }

    public static function updateProcess()
    {
        Middlewares::isAuth();
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $console = Model::arrayToObject($_POST);
            if(!Model::save($console)) redirect("errores",["El registro no se pudo actualizar"],"/consoleModel");
            redirect("exitos",["Consola actualizada correctamente"],"/consoleModel");
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
        $errors[] = self::validateEmpties($data);
        $errors[] = Validators::alfa($data["name"], "nombre");
        return array_filter($errors);
    }
}
