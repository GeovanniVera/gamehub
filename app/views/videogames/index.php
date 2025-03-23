<?php include __DIR__ . '/../includes/navbar.php' ?>

<main>
    <div class="contenedor crud-container">
        <h2> videojuegos </h2>

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
            <a href="/videogamescreate" class="btn-agregar">Agregar Videojuego</a>
        </div>
        <table  rules=”groups” class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th colspan="3">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($videogames) && !empty($videogames)) : ?>
                    <?php foreach ($videogames as $videogame):  ?>
                        <tr>
                            <td><?php echo $videogame->getId() ?></td>
                            <td><?php echo $videogame->getName() ?></td>
                            <td><a href="/videogamesDetails?id=<?php echo $videogame->getId()?>"><i class="fas fa-eye view"></i></a></td>
                            <td><a href="/videogamesDelete?id=<?php echo $videogame->getId()?>"><i class="fas fa-trash trash"></i></a></td>
                            <td><a href="/videogamesUpdate?id=<?php echo $videogame->getId()?>"><i class="fas fa-pencil-alt update"></a></td>
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