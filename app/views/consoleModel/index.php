<?php include __DIR__ . '/../includes/navbar.php' ?>

<main>
    <div class="contenedor crud-container">
        <h2> Modelos de consolas </h2>

        <?php include __DIR__.'/../includes/alertas.php'; ?>

        <!--inicio de la tabla-->
        <div class="btn">
            <a href="/consoleModelcreate" class="btn-agregar">Agregar Modelo de consola</a>
        </div>
        <table rules=”groups” class="table">
            <thead>
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th colspan="2">Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php if (isset($consolesModels) && !empty($consolesModels)) : ?>
                    <?php foreach ($consolesModels as $consoleModel):  ?>
                        <tr>
                            <td><?php echo $consoleModel->getId() ?></td>
                            <td><?php echo $consoleModel->getName() ?></td>
                            <td><a href="/consoleModelDelete/<?php echo $consoleModel->getId() ?>"><i class="fas fa-trash trash"></i></i></a></td>
                            <td><a href="/consoleModelUpdate/<?php echo $consoleModel->getId() ?>"><i class="fas fa-pencil-alt update"></i></a></td>
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