<?php include __DIR__ . '/../includes/navbar.php' ?>

<main>
    <div class="contenedor crud-container">
        <h2> Formulario de Videojuegos </h2>
        <?php if (isset($exitos) && !empty($exitos)) : ?>
            <p class="alerta exito"><?php echo $exitos ?></p>
        <?php endif; ?>
        <?php if (isset($errores) && !empty($errores)) : ?>
            <p class="alerta error"><?php echo $errores ?></p>
        <?php endif; ?>
        <?php if (isset($mensajes) && !empty($mensajes)) : ?>
            <p class="alerta mensaje"><?php echo $mensajes ?></p>
        <?php endif; ?>
        <div class="btn">
            <a href="/videogames" class="btn-agregar">Cancelar</a>
        </div>
        <div class="card">
            <form class="form-crud" action="<?php echo isset($videogame) && !empty($videogame) ? '/videogamesUpdate' : '/videogames' ?>" method="post">
                <div class="grupo">
                    <?php if (isset($videogame) && !empty($videogame)): ?>
                        <input type="hidden" name="id" value="<?php echo $videogame->getId() ?>">
                    <?php endif; ?>
                </div>
                <div class="grupo">
                    <div class="campos">
                        <label for="name">Nombre del Videojuego</label>
                        <div class="inp">
                            <input type="text" placeholder="Minecraft, Halo, etc" name="name" value="<?php echo isset($videogame) && !empty($videogame) ? htmlspecialchars($videogame->getName()) : '' ?>">
                        </div>
                    </div>
                    <div class="campos">
                        <label for="description">Descripción</label>
                        <div class="text">
                            <textarea name="description" id="description"> <?php echo isset($videogame) && !empty($videogame) ? htmlspecialchars($videogame->getDescription()) : '' ?></textarea>
                        </div>
                    </div>
                    <div class="campos">
                        <label for="releaseDate">Fecha de lanzamiento</label>
                        <div class="inp">
                            <input type="date" name="releaseDate" id="releaseDate">
                        </div>
                    </div>
                </div>
                <div class="grupo">
                    <div class="campos">
                        <legend>Generos</legend>
                        <div class="checkboxs">
                            <?php if (isset($genres) && !empty($genres)) : ?>
                                <?php foreach ($genres as $genre): ?>
                                    <div class="camp">
                                        <div class="check-box">
                                            <input class="hidden-checkbox" type="checkbox" id="cbxg<?php echo $genre->getId(); ?>" style="display: none;" value="<?php echo $genre->getId(); ?>" name="genres[]">
                                            <label for="cbxg<?php echo $genre->getId(); ?>" class="check">
                                                <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                    <path d="M 1 9 L 1 9 c 0 -5 3 -8 8 -8 L 9 1 C 14 1 17 5 17 9 L 17 9 c 0 4 -4 8 -8 8 L 9 17 C 5 17 1 14 1 9 L 1 9 Z"></path>
                                                    <polyline points="1 9 7 14 15 4"></polyline>
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="label-check">
                                            <label><?php echo htmlspecialchars($genre->getName()); ?></label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="camp">
                                    <div class="check-box">
                                        <input disabled type="checkbox" id="cbx-disabled-genre" style="display: none;">
                                        <label for="cbx-disabled-genre" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M 1 9 L 1 9 c 0 -5 3 -8 8 -8 L 9 1 C 14 1 17 5 17 9 L 17 9 c 0 4 -4 8 -8 8 L 9 17 C 5 17 1 14 1 9 L 1 9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                    </div>
                                    <div class="label-check">
                                        <label>No existe ningun Genero</label>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>

                    <div class="campos">
                        <legend>Consolas</legend>
                        <div class="checkboxs">
                            <?php if (isset($consoles) && !empty($consoles)) : ?>
                                <?php foreach ($consoles as $console): ?>
                                    <div class="camp">
                                        <div class="check-box">
                                            <input class="hidden-checkbox" type="checkbox" id="cbxc<?php echo $console->getId() ?>" style="display: none;" value="<?php echo $console->getId(); ?>" name="consoles[]">
                                            <label for="cbxc<?php echo $console->getId() ?>" class="check">
                                                <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                    <path d="M 1 9 L 1 9 c 0 -5 3 -8 8 -8 L 9 1 C 14 1 17 5 17 9 L 17 9 c 0 4 -4 8 -8 8 L 9 17 C 5 17 1 14 1 9 L 1 9 Z"></path>
                                                    <polyline points="1 9 7 14 15 4"></polyline>
                                                </svg>
                                            </label>
                                        </div>
                                        <div class="label-check">
                                            <label><?php echo htmlspecialchars($console->getName()); ?></label>
                                        </div>
                                    </div>
                                <?php endforeach; ?>
                            <?php else: ?>
                                <div class="camp">
                                    <div class="check-box">
                                        <input disabled type="checkbox" id="cbx-disabled-console" style="display: none;">
                                        <label for="cbx-disabled-console" class="check">
                                            <svg width="18px" height="18px" viewBox="0 0 18 18">
                                                <path d="M 1 9 L 1 9 c 0 -5 3 -8 8 -8 L 9 1 C 14 1 17 5 17 9 L 17 9 c 0 4 -4 8 -8 8 L 9 17 C 5 17 1 14 1 9 L 1 9 Z"></path>
                                                <polyline points="1 9 7 14 15 4"></polyline>
                                            </svg>
                                        </label>
                                    </div>
                                    <div class="label-check">
                                        <label>No existe ninguna Consola</label>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <div class="grupo">
                    <div class="campos">
                        <input type="submit" value="Guardar" class="submit">
                    </div>
                </div>
            </form>
        </div>
        </div>
</main>

<?php include __DIR__ . '/../includes/footer.php' ?>