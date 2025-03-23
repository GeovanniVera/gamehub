<?php


include __DIR__ . "/../includes/navbar.php" ?>

<main>
    <div class="contenedor crud-container">
        <h2> Generos </h2>

        <?php if (isset($exitos) && !empty($exitos)) : ?>
            <p class="alerta exito"><?php echo $exitos ?></p>
        <?php endif; ?>
        <?php if (isset($errores) && !empty($errores)) : ?>
            <p class="alerta error"><?php echo $errores ?></p>
        <?php endif; ?>
        <?php if (isset($mensajes) && !empty($mensajes)) : ?>
            <p class="alerta mensaje"><?php echo $mensajes ?></p>
        <?php endif; ?>
        <!--inicio de la card-->
        <div class="btn">
            <a href="/genre" class="btn-agregar">Cancelar</a>
        </div>


        <form class="form-crud" action="<?php echo isset($genre) && !empty($genre) ? '/genreUpdate' : '/genre' ?>" method="post">
            <div class="grupo">
                <?php if (isset($genre) && !empty($genre)): ?>
                    <input type="hidden" name="id" value="<?php echo $genre->getId() ?>">
                <?php endif; ?>
            </div>
            <div class="grupo">
                <div class="campos">
                    <label for="name">
                        Nombre
                    </label>
                    <div class="inp">
                        <input type="text" placeholder="Terror, Accion, etc." name="name" value="<?php echo isset($genre) && !empty($genre) ? htmlspecialchars($genre->getName()) : '' ?>">
                    </div>
                </div>
                <div class="campos">
                    <label for="description">Descripcion</label>
                    <div class="text">
                        <textarea name="description" id="description"><?php echo isset($genre) && !empty($genre) ? htmlspecialchars($genre->getDescription()) : '' ?></textarea>
                    </div>
                </div>
                <div class="grupo">
                    <div class="campos">
                        <input type="submit" value="Guardar" class="submit">
                    </div>
                </div>
        </form>
        <!-- fin card-->
    </div>
</main>

<?php include __DIR__ . "/../includes/footer.php" ?>