<?php

namespace App\Models;

class VideogameGenre extends ActiveRecord
{
    protected ?int $id = null;
    protected int $idGenre;
    protected int $idVideogame;

    public static function getTable()
    {
        return 'videogames_genres';
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
        $this->idGenre = $id;
    }

    public function getIdGenre()
    {
        return $this->idGenre;
    }
    public function setIdVideogame($id)
    {
        $this->idVideogame = $id;
    }

    public function getIdVideogame()
    {
        return $this->idVideogame;
    }
}
