

<?php if (isset($errores) && !empty($errores)) : ?>
    <?php foreach ($errores[0] as $error): ?>
        <p class="alerta error"><?php echo $error ?></p>
    <?php endforeach; ?>
<?php endif; ?>


<?php if (isset($exitos) && !empty($exitos)) : ?>
    <?php foreach ($exitos[0] as $exito): ?>
        <p class="alerta exito"><?php echo $exito ?></p>
    <?php endforeach; ?>
<?php endif; ?>