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
        <?php foreach($genres as $genre):  ?>
            <div>
                <p>
                    <?php echo $genre -> getId() ?>
                </p>
                <p>
                    <?php echo $genre -> getName() ?>
                </p>
                <p>
                    <?php echo $genre -> getDescription() ?>
                </p>
            </div>
        <?php endforeach; ?>
        <!-- fin card-->
    </div>
</main>

<?php include __DIR__ . "/../includes/footer.php" ?>
