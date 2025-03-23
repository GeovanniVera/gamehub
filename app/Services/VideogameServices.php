<?php

namespace App\Services;

use App\Classes\Database;
use App\Models\Console;
use App\Models\Videogame;
use App\Models\VideogameConsole;
use App\Models\VideogameGenre;
use PDOException;

class VideogameServices {
    public function transactionVideoGame(object $videogame, array $genres, array $consoles) {
        try {


            $conn = Database::getInstance()->getConnection();
            $conn->beginTransaction();

            // Creamos el objeto de videojuego y obtenemos su ID
            $videogameId = $this->createVideoGame($videogame);

            if (!is_array($videogameId) || !isset($videogameId['id'])) {
                $conn->rollBack();
                throw new PDOException("Error al crear el videojuego o ID no encontrado.");
            }

            $res = $this->createGenres($genres, $videogameId['id']);
            if (!$res) {
                $conn->rollBack();
                throw new PDOException("Error al asociar género al videojuego.");
            }

            $res = $this->createConsoles($consoles, $videogameId['id']);

            if (!$res) {
                $conn->rollBack();
                throw new PDOException("Error al asociar la consola al videojuego.");
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

    private function createGenres($genres, $idVideogame) {
        // Recorremos todos los géneros asociados al videojuego
        if (isset($genres['id']) && is_array($genres['id'])) {
            foreach ($genres['id'] as $genreId) {
                $videogameGenre = VideogameGenre::arrayToObject([
                    "idGenre" => (int) $genreId,
                    "idVideogame" => $idVideogame
                ]);
                $res = VideogameGenre::create($videogameGenre);

                if (!$res) {
                    return false; // Retorna false si falla la creación
                }
            }
            return true; // Retorna true si todas las creaciones son exitosas
        }
        return true; // Retorna true si no hay géneros para procesar
    }

    private function createConsoles($consoles, $id) {
        // Recorremos todas las consolas asociadas al videojuego
        if (isset($consoles['id']) && is_array($consoles['id']) && isset($consoles['releaseDate'])) {
            foreach ($consoles['id'] as $consoleId) {
                $releaseDate = isset($consoles['releaseDate']) ? $consoles['releaseDate'] : null;

                $videogameConsole = VideogameConsole::arrayToObject([
                    "idConsole" => (int) $consoleId,
                    "idVideogame" => (int) $id,
                    'releaseDate' => $releaseDate
                ]);


                $res = VideogameConsole::create($videogameConsole);

                if (!$res) {
                    return false; // Retorna false si falla la creación
                }
            }
            return true; // Retorna true si todas las creaciones son exitosas
        }
        return true; // Retorna true si no hay consolas para procesar
    }

    private function createVideoGame(object $videogame) {
        $videogame = Videogame::create($videogame);
        return $videogame;
    }
}