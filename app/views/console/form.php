<?php

include __DIR__ . '/../includes/navbar.php' ?>

<main>
    <div class="contenedor crud-container">
        <h2> Formulario de Consolas </h2>

        <?php include __DIR__ . '/../includes/alertas.php'; ?>

        <div class="btn">
            <a href="/console" class="btn-agregar">Cancelar</a>
        </div>

        <form
            action="<?php echo isset($console) && !empty($console) ? '/consoleUpdate' : '/console' ?>"
            method="post"
            class="form-crud"
            id="consoleForm">
            <div class="grupo">
                <?php if (isset($console) && !empty($console)): ?>
                    <input type="hidden" name="id" value="<?php echo $console->getId() ?>">
                <?php endif; ?>
            </div>
            <div class="grupo">
                <div class="campos">
                    <label
                        for="name"
                        id="label-name">
                        Nombre:
                    </label>
                    <div class="inp">
                        <input
                            type="text"
                            placeholder="XBOX"
                            id="name"
                            name="name"
                            value="<?php echo isset($console) && !empty($console) ? htmlspecialchars($console->getName()) : '' ?>">
                    </div>
                    <span id="nameError" class="error-message"></span>
                </div>
                <div class="campos">
                    <label 
                        id="label-description" 
                        for="description">
                        Descripción:
                    </label>
                    <div class="text">
                        <textarea name="description" id="description"><?php echo isset($console) && !empty($console) ? htmlspecialchars($console->getDescription()) : '' ?></textarea>
                    </div>
                    <span id="descriptionError" class="error-message"></span>

                </div>
            </div>
            <div class="grupo">
                <div class="campos">
                    <label for="idModel">Modelo:</label>
                    <div class="select">
                        <select name="idModel" id="idModel">
                            <?php if (isset($modelos) && !empty($modelos)) : ?>
                                <option value="" disabled <?php if (!isset($console) || empty($console->getIdModel())) echo 'selected'; ?>>--selecciona un modelo--</option>
                                <?php foreach ($modelos as $model) : ?>
                                    <option value="<?php echo htmlspecialchars($model->getid()) ?>" <?php if (isset($console) && $console->getIdModel() == $model->getid()) echo 'selected'; ?>><?php echo htmlspecialchars($model->getName()) ?></option>
                                <?php endforeach; ?>
                            <?php else : ?>
                                <option value="" disabled selected>--NO EXISTEN MODELOS--</option>
                            <?php endif; ?>
                        </select>
                    </div>
                    <span id="modelError" class="error-message"></span>
                </div>
                <div class="campos">
                    <label for="releaseDate">Fecha de lanzamiento:</label>
                    <div class="inp">
                        <input type="date" name="releaseDate" id="releaseDate" value="<?php echo isset($console) && !empty($console) ? htmlspecialchars($console->getReleaseDate()) : '' ?>">
                    </div>
                    <span id="releaseDateError" class="error-message"></span>
                </div>

            </div>
            <div class="grupo">
                <div class="campos">
                    <input type="submit" value="Guardar" class="submit">

                </div>
            </div>
        </form>
    </div>
    <script type="module" src="/build/js/consoleValidador.js"></script>
</main>

<?php include __DIR__ . '/../includes/footer.php' ?>