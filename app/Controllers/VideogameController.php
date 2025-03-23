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
    public static function delete()
    {
        Middlewares::isAuth();
        if($_SERVER['REQUEST_METHOD']=="GET"){
            $id = $_GET['id'];
            if(!is_numeric($id)) redirect("errores",["Registro no valido"],"/videogames");
            if(!Videogame::delete($id)) redirect("errores",["No se pudo eliminar el registro"],"/videogames");
            redirect("exitos",["Genero Eliminado Correctamente"],"/videogames");
        }
    }

    public static function update(Router $router)
    {
        Middlewares::isAuth();
        if($_SERVER['REQUEST_METHOD']=="GET"){
            $id = $_GET['id'];
            if(!is_numeric($id)) redirect("errores",["Registro no valido"],"/videogames");
            $videogame = Videogame::find($_GET['id']);
            if(is_null($videogame)) redirect("errores",["Registro no existe"],"/videogames");
            $data=[];
            $data['videogame']= $videogame;
            $router->render("videogames/form",$data);

        }
    }

    public static function updateProcess()
    {
        Middlewares::isAuth();
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $videogame = Videogame::arrayToObject($_POST);
            if(!Videogame::save($videogame)) redirect("errores",["El registro no se pudo actualizar"],"/videogames");
            redirect("exitos",["Genero actualizado correctamente"],"/videogames");
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
