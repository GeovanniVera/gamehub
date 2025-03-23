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

    public static function createVideoGame(object $videogame, array $genres, array $consoles) {
        try {
            $conn = Database::getInstance()->getConnection();
            $conn->beginTransaction();
    
            // Creamos el objeto de videojuego y obtenemos su ID
            $videogameId = self::create($videogame);
    
            if (!is_array($videogameId) || !isset($videogameId['id'])) {
                $conn->rollBack();
                throw new PDOException("Error al crear el videojuego o ID no encontrado.");
            }
    
            // Recorremos todos los géneros asociados al videojuego
            if (isset($genres['id']) && is_array($genres['id'])) {
                foreach ($genres['id'] as $genreId) {
                    $videogameGenre = VideogameGenre::arrayToObject([
                        "idGenre" => (int) $genreId,
                        "idVideogame" => $videogameId['id']
                    ]);
    
                    $res = VideogameGenre::create($videogameGenre);
    
                    if (!$res) {
                        $conn->rollBack();
                        throw new PDOException("Error al asociar género al videojuego.");
                    }
                }
            }
    
            // Recorremos todas las consolas asociadas al videojuego
            if (isset($consoles['id']) && is_array($consoles['id']) && isset($consoles['releaseDate']) && is_array($consoles['releaseDate'])) {
                foreach ($consoles['id'] as $index => $consoleId) {
                    $releaseDate = isset($consoles['releaseDate'][$index]) ? $consoles['releaseDate'][$index] : null;
    
                    $videogameConsole = VideogameConsole::arrayToObject([
                        "idConsole" => (int) $consoleId,
                        "idVideogame" => $videogameId['id'],
                        'releaseDate' => $releaseDate
                    ]);
    
                    $res = VideogameConsole::create($videogameConsole);
    
                    if (!$res) {
                        $conn->rollBack();
                        throw new PDOException("Error al asociar la consola al videojuego.");
                    }
                }
            }
    
            $conn->commit();
    
            return true; // Indicar éxito
    
        } catch (PDOException $e) {
            if ($conn->inTransaction()) {
                $conn->rollBack();
            }
            error_log("Error al completar la transacción: " . $e->getMessage());
            throw $e; // Lanzar la excepción para que pueda ser manejada por el código que llama
        }
    }
}
