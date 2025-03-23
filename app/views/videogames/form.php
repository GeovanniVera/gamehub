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
        <!--inicio de la tabla-->
        <div class="btn">
            <a href="/videogames" class="btn-agregar">Cancelar</a>
        </div>
        <div class="card">
            <form action="/videogames" method="post">
                <div class="grupo">
                    <div class="inp">
                        <label for="name">Nombre del Videojuego</label>
                        <input type="text" placeholder="Minecraft, Halo, etc" name="name">
                    </div>
                    <div class="inp">
                        <label for="description">Descripción</label>
                        <input type="text" placeholder="Descripción del Videojuego" name="description">
                    </div>
                </div>
                <div class="grupo">
                    <input type="submit" value="Guardar" class="btn_submit">
                </div>
            </form>
        </div>

        <!-- fin card-->
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php' ?>