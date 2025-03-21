<?php

namespace App\Models;

use InvalidArgumentException;


class User extends ActiveRecord
{

    protected ?int $id = null;
    protected string $name; //obligatorio en la base de datos
    protected string $lastName; //obligatorio en la base de datos
    protected string $email; //obligatorio en la base de datos
    protected string $password; //obligatorio en la base de datos


    public static function getTable()
    {
        return "users";
    }

    /**
     * Establece el id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    /**
     * Recupera el ID
     */
    public function getId(): ?int
    {
        return $this->id;
    }
    
    
    /**
     * Establece el nombre del usuario
     */
    public function setName($name): void
    {
        if (strlen($name) > 60) {
            throw new InvalidArgumentException("El nombre no puede tener más de 60 caracteres");
        }
        $this->name = strtolower(trim($name));
    }
    /**
     * Recupera el nombre del usuario
     */
    public function getName(): string
    {
        return $this->name;
    }
    /**
     * Establece el Apellido del usuario
     */
    public function setLastName($lastName): void
    {
        if (strlen($lastName) > 255) {
            throw new InvalidArgumentException("El apellido no puede tener más de 255 caracteres");
        }
        $this->lastName = strtolower(trim($lastName));
    }
    /** 
     * Recupera el Apellido
     */
    public function getLastName(): string
    {
        return $this->lastName;
    }
    /**
     * Establece el correo electronico
     */
    public function setEmail($email): void
    {
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new InvalidArgumentException("El correo electrónico no es válido");
        }
        $this->email = $email;
    }
    /**
     * Recupera el correo electronico
     */
    public function getEmail(): string
    {
        return $this->email;
    }
    /**
     * Hashea la contraseña
     * @param string $password
     * @throws InvalidArgumentException
     */
    public function setPassword(string $password): void
    {
        if (empty($password)) {
            throw new InvalidArgumentException("La contraseña no puede estar vacía");
        }
        $this->password = password_hash($password, PASSWORD_BCRYPT);
    }
    /**
     * Verifica la contraseña
     * @param string $password
     * @return bool
     */

    public function verifyPassword(string $password): bool
    {
        return password_verify($password, $this->password);
    }

    

    public function __toString(): string
    {
        return "Usuario #{$this->id}: {$this->name} {$this->name}";
    }
}
