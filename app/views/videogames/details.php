<?php include __DIR__ ."/../includes/navbar.php" ?>
<main>
    <div class="contenedor crud-container">
        <h2>Videojuego <?php echo $videogame->getName() ?></h2>
        <p>Descripción : <?php echo $videogame->getDescription() ?></p>

        <!-- fin card-->
    </div>
</main>
<?php include __DIR__ ."/../includes/footer.php" ?>
