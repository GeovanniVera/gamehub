<?php

namespace App\Models;

use App\Classes\Database;
use PDO;
use PDOException;

class Console extends ActiveRecord{
    protected ?int $id = null;
    protected int $idModel;
    protected string $name; 
    protected string $description;
    protected string $releaseDate;

    public static function getTable()
    {
        return 'consoles';
    }
    public function setId($id){
        $this->id = $id;
    }

    public function getId(){
        return $this->id;

    }
    public function setIdModel($idModel){
        $this->idModel = $idModel;

    }

    public function getIdModel(){
        return $this->idModel;
        
    }
    public function setName($name){
        $this->name = $name;

    }

    public function getName(){
        return $this->name;
        
    }
    public function setDescription($description){
        $this->description = $description;

    }

    public function getDescription(){
        return $this->description;
        
    }
    public function setReleaseDate($releaseDate){
        $this->releaseDate = $releaseDate;

    }

    public function getReleaseDate(){
        return $this->releaseDate;
    }

    //Metodo para el join con model
    public static function joinModel(){
        try{
            $conn = Database::getInstance()->getConnection();
            $query = " SELECT 
                c.id AS consoleId, 
                c.name AS consoleName, 
                c.description AS consoleDescription,
                c.releaseDate AS releaseDate,
                m.name AS modelo FROM " . self::getTable() ." AS c 
                INNER JOIN 
                console_model AS m ON c.idModel = m.id";
            $stmt = $conn->prepare($query);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if(!$res) return [];
            return $res;
        }catch(PDOException $e){
            error_log("Error al recuperar el join");

        }
    }
}