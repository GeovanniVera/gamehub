<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use MVC\Router;
use App\Classes\Middlewares;
use App\Classes\Validators;
use App\Interfaces\CrudInterface;
use App\Models\Genre;

class GenreController extends BaseController implements CrudInterface {

    /**
     * Metodo que valida datos
     * @param array $data
     * @return array $errors
     */
    protected static function validateData($data){
        $errors = [];
        $errors[] = self::validateEmpties($data);
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
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $data = [
                "name" => $_POST['name'],
                "description" => $_POST['description'],
            ];
            $errors = self::validateData($data);
            if(!empty($errors)) redirect("errores", $errors, "/genre");
            $data = self::sanitizateData($data);
            $genre = Genre::arrayToObject($data);
            $nameexist = Genre::where("name",$genre->getName());
            if(!(is_null($nameexist))) redirect("errores", ["Genero Existente en la Base de Datos"], "/genre");
            if(!Genre::save($genre)){
                redirect("errores", ["Error al guardar en la base de Datos"], "/genre");
            }
            redirect("exitos",["Genero creado correctamente"],"/genre");
            
        }
        
    }

    public static function form(Router $router){
        Middlewares::isAuth();
        $data = [];
        $data["exitos"]=extractMessages("exitos");
        $data["mensajes"]=extractMessages("mensajes");
        $data["errores"]=extractMessages("errores");
        $router -> render("genre/form", $data);
    }

    public static function delete(Router $router, $params)
    {
        Middlewares::isAuth();
        if($_SERVER['REQUEST_METHOD']=="GET"){
            $id =(int) $params['id'];
            if(!is_numeric($id)) redirect("errores",["Registro no valido"],"/genre");
            if(!Genre::delete($id)) redirect("errores",["No se pudo eliminar el registro"],"/genre");
            redirect("exitos",["Genero Eliminado Correctamente"],"/genre");
        }
    }

    public static function update(Router $router, $params)
    {
        Middlewares::isAuth();
        if($_SERVER['REQUEST_METHOD']=="GET"){
            $id =(int) $params['id'];
            if(!is_numeric($id)) redirect("errores",["Registro no valido"],"/genre");
            $genre = Genre::find($id);
            if(is_null($genre)) redirect("errores",["Registro no existe"],"/genre");
            $data=[];
            $data['genre']= $genre;
            $router->render("genre/form",$data);

        }
    }

    public static function updateProcess()
    {
        Middlewares::isAuth();
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $genre = Genre::arrayToObject($_POST);
            if(!Genre::save($genre)) redirect("errores",["El registro no se pudo actualizar"],"/genre");
            redirect("exitos",["Genero actualizado correctamente"],"/genre");
        }
    }
}