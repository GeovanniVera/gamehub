<?php

namespace App\Models;

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
}