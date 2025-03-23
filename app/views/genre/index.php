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
            <a href="" class="btn-agregar">Agregar Género</a>
        </div>
        <table class="table" rules=”groups”>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($genres) && !empty($genres)) : ?>
                    <?php foreach ($genres as $genre): ?>
                        <tr>
                            <td><?php echo $genre->getId(); ?></td>
                            <td><?php echo $genre->getName(); ?></td>
                            <td></td>
                            <td></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3" class="td">No existen registros en la base de datos.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
        <!-- fin card-->
    </div>
</main>

<?php include __DIR__ . "/../includes/footer.php" ?>