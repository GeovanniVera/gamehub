<?php include __DIR__ . "/../includes/navbar.php" ?>
<main>
    <div class="contenedor dashbord-container">
        <p>Bienvenido <?php echo ucwords($user->getName()) ?></p>
        <h2>Ultimos Agregados </h2>
        <!--inicio de la card-->
        <div class="cards">

            <div class="card red">
                <p class="tip">Gears of War day E</p>
                <p class="second-text">Descripcion Aqui</p>
                <a href="/" class="button">ver mas</a>
            </div>
        </div>
        <!-- fin card-->
    </div>
</main>
<?php include __DIR__ . "/../includes/footer.php" ?>