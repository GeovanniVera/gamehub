<?php

namespace App\Models;

class Model extends ActiveRecord
{
    protected ?int $id = null;
    protected string $name;
    public static function getTable()
    {
        return 'console_model';
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
}
