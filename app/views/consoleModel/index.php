<?php include __DIR__ . '/../includes/navbar.php' ?>

<main>
    <div class="contenedor crud-container">
        <h2> Modelos de consolas </h2>

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
            <a href="/consoleModelcreate" class="btn-agregar">Agregar Modelo de consola</a>
        </div>
        <table rules=”groups” class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th colspan="3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($consolesModels) && !empty($consolesModels)) : ?>
                    <?php foreach ($consolesModels as $consoleModel):  ?>
                        <tr>
                            <td><?php echo $consoleModel->getId() ?></td>
                            <td><?php echo $consoleModel->getName() ?></td>
                            <td><a href="/consoleModelDetails?id=<?php echo $consoleModel->getId() ?>">Detalles</a></td>
                            <td><a href="/consoleModelDelete?id=<?php echo $consoleModel->getId() ?>">Eliminar</a></td>
                            <td><a href="/consoleModelUpdate?id=<?php echo $consoleModel->getId() ?>">Actualizar</a></td>
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