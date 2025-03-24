<?php include __DIR__ . "/../includes/navbar.php" ?>
<main>
    <div class="contenedor dashbord-container">
        <p>Bienvenido <?php echo ucwords($user->getName()) ?></p>
        <h2>Ultimos Agregados </h2>
        <!--inicio de la card-->
        <div class="cards">
            <?php if (isset($videogames) && !empty($videogames)): ?>
                <?php foreach ($videogames as $videogame): ?>
                    <div class="card red">
                        <p class="tip"><?php echo $videogame->getName() ?></p>
                        <p class="second-text"> <?php echo $videogame->getDescription()?></p>
                        <a href="/videogameDetails/<?php echo $videogame->getId() ?>" class="button">ver mas</a>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </div>
        <!-- fin card-->
    </div>
</main>
<?php include __DIR__ . "/../includes/footer.php" ?>