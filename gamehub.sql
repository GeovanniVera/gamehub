-- Crea la base de datos gamehub si no existe
CREATE DATABASE IF NOT EXISTS gamehub;

-- Usa la base de datos gamehub
USE gamehub;

-- Crea el usuario gamehub con la contraseña gamehub123 si no existe
CREATE USER IF NOT EXISTS 'gamehub'@'%' IDENTIFIED BY 'gamehub123';

-- Otorga todos los privilegios al usuario gamehub sobre la base de datos gamehub
GRANT ALL PRIVILEGES ON gamehub.* TO 'gamehub'@'%';

-- Actualiza los privilegios
FLUSH PRIVILEGES;

-- Tabla de Usuarios (solo crea si no existe)
CREATE TABLE IF NOT EXISTS user (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL,
    lastName VARCHAR(60) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL -- Recuerda usar hash para las contraseñas
);

-- Tabla de Géneros (solo crea si no existe)
CREATE TABLE IF NOT EXISTS genre (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL,
    description TEXT
);

-- Tabla de Modelos de Consola (solo crea si no existe)
CREATE TABLE IF NOT EXISTS console_model (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL
);

-- Tabla de Consolas (solo crea si no existe)
CREATE TABLE IF NOT EXISTS console (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL,
    description TEXT,
    idModel INT NOT NULL,
    releaseDate DATE NOT NULL,
    FOREIGN KEY (idModel) REFERENCES console_model(id)
);

-- Tabla de Videojuegos (solo crea si no existe)
CREATE TABLE IF NOT EXISTS videogame (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(255) NOT NULL,
    description TEXT
);

-- Tabla de Videojuego-Consola (Relación Muchos a Muchos) (solo crea si no existe)
CREATE TABLE IF NOT EXISTS videogame_console (
    id INT PRIMARY KEY AUTO_INCREMENT,
    id_videogame INT NOT NULL,
    id_console INT NOT NULL,
    release_date DATE NOT NULL,
    FOREIGN KEY (idVideogame) REFERENCES videogame(id),
    FOREIGN KEY (idConsole) REFERENCES console(id)
);

-- Tabla de Videojuego-Género (Relación Muchos a Muchos) (solo crea si no existe)
CREATE TABLE IF NOT EXISTS videogame_genre (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idVideogame INT NOT NULL,
    idGenre INT NOT NULL,
    FOREIGN KEY (idVideogame) REFERENCES videogame(id),
    FOREIGN KEY (idGenre) REFERENCES genre(id)
);

-- Indices para mejorar el rendimiento (solo crea si no existen)
CREATE INDEX IF NOT EXISTS idx_user_name ON user (user_name);
CREATE INDEX IF NOT EXISTS idx_email ON user (email);
CREATE INDEX IF NOT EXISTS idx_genre_name ON genre (name);
CREATE INDEX IF NOT EXISTS idx_console_name ON console (name);
CREATE INDEX IF NOT EXISTS idx_videogame_name ON videogame (name);

-- Actualiza los privilegios nuevamente
FLUSH PRIVILEGES;
