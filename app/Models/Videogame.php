<?php

namespace App\Models;

use App\Classes\Database;
use PDOException;

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

    public static function createVideoGame(object $videogame, array $genres , array $consoles){
        try{
            $conn = Database::getInstance()->getConnection();
            $conn -> beginTransaction();
            self::create($videogame);
            //recorremos todos los generos a los que se asocio el videojuego
            foreach($genres as $genre){
                $videogameGenre = VideogameGenre::arrayToObject([
                    "idGenre" =>$genre['id'],
                    "idVideogame" => $videogame->getId()
                ]);

                $res = VideogameGenre::create($videogameGenre);

                if(!$res){
                    $conn -> rollBack();
                    throw new PDOException("Error al asociar género al videojuego.");
                }

            }
            
            foreach($consoles as $console){
                $videogameGenre = VideogameGenre::arrayToObject([
                    "idConsole" =>$console['id'],
                    "idVideogame" => $videogame->getId()
                ]);

                $res = VideogameGenre::create($videogameGenre);

                if(!$res){
                    $conn -> rollBack();
                    throw new PDOException("Error al asociar la consola al videojuego.");

                }
            }

            $conn->commit();

            return true; // Indicar éxito
    
            
        }catch (PDOException $e) {
            if ($conn->inTransaction()) {
                $conn->rollBack();
            }
            error_log("Error al completar la transacción: " . $e->getMessage());
            throw $e; // Lanzar la excepción para que pueda ser manejada por el código que llama
        
        }

    }
}
