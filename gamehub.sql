CREATE DATABASE IF NOT EXISTS gamehub;

USE gamehub;

CREATE USER IF NOT EXISTS 'gamehub'@'%' IDENTIFIED BY 'gamehub123';

GRANT ALL PRIVILEGES ON gamehub.* TO 'gamehub'@'%';

FLUSH PRIVILEGES;

CREATE TABLE IF NOT EXISTS users (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL,
    lastName VARCHAR(60) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL 
);

CREATE TABLE IF NOT EXISTS genres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL,
    description TEXT
);

CREATE TABLE IF NOT EXISTS console_model (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL
);

CREATE TABLE IF NOT EXISTS consoles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(60) NOT NULL,
    description TEXT,
    idModel INT NOT NULL,
    releaseDate DATE NOT NULL,
    FOREIGN KEY (idModel) REFERENCES console_model(id)
);

CREATE TABLE IF NOT EXISTS videogames (
    id INT PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(30) NOT NULL,
    description TEXT
);

CREATE TABLE IF NOT EXISTS videogames_consoles (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idVideogame INT NOT NULL,
    idConsole INT NOT NULL,
    releaseDate DATE NOT NULL,
    FOREIGN KEY (idVideogame) REFERENCES videogames(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (idConsole) REFERENCES consoles(id)
);

CREATE TABLE IF NOT EXISTS videogames_genres (
    id INT PRIMARY KEY AUTO_INCREMENT,
    idVideogame INT NOT NULL,
    idGenre INT NOT NULL,
    FOREIGN KEY (idVideogame) REFERENCES videogames(id) ON DELETE CASCADE ON UPDATE CASCADE,
    FOREIGN KEY (idGenre) REFERENCES genres(id)
);

CREATE INDEX IF NOT EXISTS idx_user_name ON users (name);
CREATE INDEX IF NOT EXISTS idx_email ON users (email);
CREATE INDEX IF NOT EXISTS idx_genre_name ON genres (name);
CREATE INDEX IF NOT EXISTS idx_console_name ON consoles (name);
CREATE INDEX IF NOT EXISTS idx_videogame_name ON videogames (name);

FLUSH PRIVILEGES;