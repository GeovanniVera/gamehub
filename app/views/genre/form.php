<?php


include __DIR__ . "/../includes/navbar.php" ?>

<main>
    <div class="contenedor crud-container">
        <h2> Generos </h2>
        <?php include __DIR__ . '/../includes/alertas.php'; ?>
        <!--inicio de la card-->
        <div class="btn">
            <a
                href="/genre"
                class="btn-agregar">
                Cancelar
            </a>
        </div>
        <form
            class="form-crud"
            action="<?php echo isset($genre) && !empty($genre) ? '/genreUpdate' : '/genre' ?>"
            method="post"
            id="genreForm">
            <div class="grupo">
                <?php if (isset($genre) && !empty($genre)): ?>
                    <input type="hidden" name="id" value="<?php echo $genre->getId() ?>">
                <?php endif; ?>
            </div>
            <div class="grupo">
                <div class="campos">
                    <label
                        for="name"
                        id="label-name">
                        Nombre
                    </label>
                    <div class="inp">
                        <input
                            type="text"
                            placeholder="Terror, Accion, etc."
                            name="name"
                            value="<?php echo isset($genre) && !empty($genre) ? htmlspecialchars($genre->getName()) : '' ?>"
                            id="name">
                    </div>
                    <span
                        id="nameError"
                        class="error-message">
                    </span>
                </div>
                <div class="campos">
                    <label
                        for="description"
                        id="label-description">

                        Descripcion
                    </label>
                    <div class="text">
                        <textarea
                            name="description"
                            id="description">
                            <?php echo isset($genre) && !empty($genre) ? htmlspecialchars($genre->getDescription()) : '' ?>
                        </textarea>
                        <span
                            id="descriptionError"
                            class="error-message">
                        </span>
                    </div>
                </div>
                <div class="grupo">
                    <div class="campos">
                        <input
                            type="submit"
                            value="Guardar"
                            disabled
                            class="submit">
                    </div>
                </div>
        </form>
        <!-- fin card-->
    </div>
</main>
<?php include __DIR__ . "/../includes/footer.php" ?>