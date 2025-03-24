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
                            <td><?php echo $console['consoleId'] ?></td>
                            <td><?php echo $console['consoleName'] ?></td>
                            <td><?php echo $console['modelo'] ?></td>
                            <td><?php echo $console['releaseDate'] ?></td>
                            <td><a href="/consoleDetails/<?php echo $console['consoleId'] ?>"><i class="fas fa-eye view"></i></a></td>
                            <td><a href="/consoleDelete/<?php echo $console['consoleId'] ?>"><i class="fas fa-trash trash"></i></a></td>
                            <td><a href="/consoleUpdate/<?php echo $console['consoleId'] ?>"><i class="fas fa-pencil-alt update"></a></td>
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