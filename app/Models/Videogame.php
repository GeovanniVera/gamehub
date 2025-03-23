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

            //creamos el objeto de videojuego


            //self::create($videogame);
            debuguear($videogame);

            //recorremos todos los generos a los que se asocio el videojuego

            for ($i = 0; $i < sizeof($genres['id']); $i++) {
                $videogameGenre = VideogameGenre::arrayToObject([
                    "idGenre" => $genres['id'][$i],
                    "idVideogame" => $videogame->getId()
                ]);

                debuguear($videogameGenre);
                $res = VideogameGenre::create($videogameGenre);


                if(!$res){
                    $conn -> rollBack();
                    throw new PDOException("Error al asociar género al videojuego.");
                }

            }
            
            $i = 0;
            foreach($consoles as $console){
                $videogameGenre = VideogameGenre::arrayToObject([
                    "idConsole" => $console[$i],
                    "idVideogame" => $videogame->getId(),
                    'releaseDate' => $console['releaseDate']
                ]);
                $i++;

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
