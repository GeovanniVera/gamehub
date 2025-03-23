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
        

        <form action="/genre" method="post">
            <div class="grupo">
                <div class="inp">
                    <label for="name">
                        Nombre
                    </label>
                    <input type="text" placeholder="Terror, Accion, etc." name="name"
                </div>
                <div class="inp">
                    <label for="description">Descripcion</label>
                    <input type="text" placeholder="Descripcion del Genero" name="description">
                </div>
            </div>
            <div class="grupo">
                <input type="submit" value="Guardar" class="btn_submit">
            </div>
        </form>
        <!-- fin card-->
    </div>
</main>

<?php include __DIR__ . "/../includes/footer.php" ?>