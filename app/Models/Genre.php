<?php 

namespace App\Models;

use InvalidArgumentException;

class Genre extends ActiveRecord{

    protected ?int $id = null;
    protected string $name; // Obligatorio en la base de datos
    protected ?string $description = null;

    public static function getTable()
    {
        return 'genres';
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setName($name): void
    {
        if(strlen($name) > 60){
            throw new InvalidArgumentException('El nombre de género no puede tener más de 60 caracteres');
      }
      $this->name = strtolower(trim($name));
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setDescription(string $description): void 
    {
        $this->description = strtolower(trim($description));
    }

    public function getDescription(): string
    {
        return $this->description;
    }
}