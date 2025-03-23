<?php include __DIR__ . '/../includes/navbar.php' ?>

<main>
    <div class="contenedor crud-container">
        <h2> Formulario de Consolas </h2>

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
            <a href="/console" class="btn-agregar">Cancelar</a>
        </div>

        <form action="/console" method="post">
            <div class="grupo">
                <div class="inp">
                    <label for="name">Nombre:</label>
                    <input type="text" placeholder="XBOX" id="name" name="name">
                </div>
                <div class="inp">
                    <label for="description"></label>
                    <textarea name="description" id="description"></textarea>
                </div>
            </div>
            <div class="grupo">
                <div class="inp">
                    <label for="idModel">Modelo:</label>
                    <select name="idModel" id="idModel">
                        <?php if (isset($modelos) && !empty($modelos)) : ?>
                            <option value="" disabled selected>--selecciona un modelo--</option>
                            <?php foreach($modelos as $model):?>
                                <option value="<?php echo $model->getid() ?>"><?php echo $model->getName() ?></option>
                            <?php endforeach; ?>
                        <?php else: ?>
                            <option value="" disabled selected>--NO EXISTEN MODELOS--</option>
                        <?php endif; ?>
                    </select>
                </div>
                <div class="inp">
                    <label for="releaseDate">Fecha de lanzamiento</label>
                    <input type="date" name="releaseDate" id="releaseDate">
                </div>
            </div>
            <div class="grupo">
                <input type="submit" value="Guardar" class="btn_submit">
            </div>
        </form>
        <!-- fin card-->
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php' ?>