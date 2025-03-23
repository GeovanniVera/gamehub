<?php

namespace App\Models;

class Videogame extends ActiveRecord
{
    protected ?int $id = null;
    protected string $name;
    protected string $description;
    
    public static function getTable()
    {
        return 'videogames';
    }
    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId()
    {
        return $this->id;
    }

    public function setName($name)
    {
        $this->name = $name;
    }

    public function getName()
    {
        return $this->name;
    }
    public function setDescription($description)
    {
        $this->description = $description;
    }

    public function getDescription()
    {
        return $this->description;
    }
}
