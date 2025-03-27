<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use MVC\Router;
use App\Classes\Middlewares;
use App\Classes\Validators;
use App\Interfaces\CrudInterface;
use App\Models\Console;
use App\Models\Model;

class ConsoleController extends BaseController implements CrudInterface {


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
            $save = Console::save($console);
            if (!$save) {
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
    public static function details(Router $router,$params){
        Middlewares::isAuth();
        if($_SERVER['REQUEST_METHOD']=="GET"){
            $id =(int) $params['id'];
            if(!is_numeric($id)) redirect("errores",["Registro no valido"],"/console");
            $console = Console::find($id);
            if(is_null($console)) redirect("errores",["Registro no existe"],"/console");
            $model = Model::find($console->getIdModel());
            $data=[];
            $data['console']= $console;
            $data['model'] = $model;
            $router->render("console/details",$data);
        }
        
    }
    public static function delete(Router $router , $params)
    {
        Middlewares::isAuth();
        if($_SERVER['REQUEST_METHOD'] =="GET"){
            $id =(int) $params['id'];
            if(!is_numeric($id)) redirect("errores",["Registro no valido"],"/console");
            if(!Console::delete($id)) redirect("errores",["No se pudo eliminar el registro"],"/console");
            redirect("exitos",["Registro Eliminado Correctamente"],"/console");
        }
        
    }

    public static function update(Router $router,$params)
    {
        Middlewares::isAuth();
        if($_SERVER['REQUEST_METHOD']=="GET"){
            $id =(int) $params['id'];
            if(!is_numeric($id)) redirect("errores",["Registro no valido"],"/console");
            $console = Console::find($id);
            if(is_null($console)) redirect("errores",["Registro no existe"],"/console");
            $data=[];
            $data['console']= $console;
            $data["modelos"]= Model::all();
            $router->render("console/form",$data);

        }
    }

    public static function updateProcess()
    {
        Middlewares::isAuth();
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $console = Console::arrayToObject($_POST);
            $save = Console::save($console);
            if(!$save) redirect("errores",["El registro no se pudo actualizar"],"/console");
            redirect("exitos",["Consola actualizada correctamente"],"/console");
        }
    }


    /**
     * Metodo que valida datos
     * @param array $data
     * @return array $errors
     */
    protected static function validateData($data){
        $errors = [];
        $errors[] = self::validateEmpties($data);
        $errors[] = Validators::alfanumeric($data['name'],'nombre');
        $errors[] = Validators::alfanumeric($data['descrition'],'descricion');
        return array_filter($errors);
    }
}