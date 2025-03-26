<?php


include __DIR__ . "/../includes/navbar.php" ?>

<main>
    <div class="contenedor crud-container">
        <h2> Generos </h2>
        <?php include __DIR__.'/../includes/alertas.php'; ?>
        <!--inicio de la card-->
        <div class="btn">
            <a href="/genrecreate" class="btn-agregar">Agregar Género</a>
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
                            <td><a href="/genreDelete/<?php echo $genre->getId() ?>"><i class="fas fa-trash trash"></i></a></td>
                            <td><a href="/genreUpdate/<?php echo $genre->getId() ?>"><i class="fas fa-pencil-alt update"></a></td>
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