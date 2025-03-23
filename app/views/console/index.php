<?php include __DIR__ . '/../includes/navbar.php' ?>

<main>
    <div class="contenedor crud-container">
        <h2> Consolas </h2>

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
            <a href="/consolecreate" class="btn-agregar">Agregar Consola</a>
        </div>
        <table  rules=”groups” class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Model</th>
                    <th>Fecha de lanzamiento:</th>
                    <th colspan="3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($consoles) && !empty($consoles)) : ?>
                    <?php foreach ($consoles as $console):  ?>
                        <tr>
                            <td><?php echo $console->getId() ?></td>
                            <td><?php echo $console->getName() ?></td>
                            <td><?php echo $console->getIdModel() ?></td>
                            <td><?php echo $console->getReleaseDate() ?></td>
                            <td><a href="">Detalles</a></td>
                            <td><a href="">Eliminar</a></td>
                            <td><a href="">Actualizar</a></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="5">
                        No existen registros en la base de datos.
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>


        <!-- fin card-->
    </div>
</main>

<?php include __DIR__ . '/../includes/footer.php' ?>