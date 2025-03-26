<?php include __DIR__ . '/../includes/navbar.php' ?>

<main>
    <div class="contenedor crud-container">
        <h2> Formulario de Modelos de Consolas </h2>
        <?php include __DIR__.'/../includes/alertas.php'; ?>
        <!--inicio de la tabla-->
        <div class="btn">
            <a href="/consoleModel" class="btn-agregar">Cancelar</a>
        </div>

        <form action="<?php echo isset($model) && !empty($model) ? '/consoleModelUpdate' : '/consoleModel' ?>" method="post" class="form-crud">
            <?php if (isset($model) && !empty($model)): ?>
                <div class="grupo">
                    <input type="hidden" name="id" value="<?php echo $model->getId() ?>">
                </div>
            <?php endif; ?>

            <div class="grupo">
                <div class="campos">
                    <label for="name">
                        Modelo de consola:
                    </label>
                    <div class="inp">
                        <input type="text" placeholder="Xbox series S" name="name" value="<?php echo isset($model) && !empty($model) ? htmlspecialchars($model->getName()) : '' ?>">
                    </div>
                </div>
                <span id="nameError" class="error-message"></span>
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

<?php include __DIR__ . '/../includes/footer.php' ?>