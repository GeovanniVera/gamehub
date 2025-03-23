<?php

namespace App\Models;

class VideogameConsole extends ActiveRecord
{
    protected ?int $id = null;
    protected int $idConsole;
    protected int $idVideogame;
    protected string $releaseDate;


    public function setReleaseDate($releaseDate){
        $this->releaseDate = $releaseDate;

    }

    public function getReleaseDate(){
        return $this->releaseDate;
    }

    public static function getTable()
    {
        return 'videogames_consoles';
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setIdGenre($id)
    {
        $this->id = $id;
    }

    public function getIdGenre()
    {
        return $this->id;
    }
    public function setIdVideogame($id)
    {
        $this->id = $id;
    }

    public function getIdVideogame()
    {
        return $this->id;
    }
}
