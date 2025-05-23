<main>
    <div class="contenedor-app">
        <div class="imagen">
            <div class="contenedor-sombreado">
                <div class="sombreado"></div>
            </div>
        </div>
        <div class="app">
            <h1 class="nombre-pagina">Registra tu Cuenta</h1>
            <?php if (isset($errores) && !empty($errores)) : ?>
                <?php foreach ($errores as $error): ?>
                    <p class="alerta error"><?php echo $error ?></p>
                <?php endforeach; ?>
            <?php endif; ?>


            <?php if (isset($exitos) && !empty($exitos)) : ?>
                <?php foreach ($exitos as $exito): ?>
                    <p class="alerta exito"><?php echo $exito ?></p>
                <?php endforeach; ?>
            <?php endif; ?>
            <form action="/register" class="formulario-registro" method="POST" id="registerForm">

                <div class="grupo">
                    <div class="campo">
                        <!-- Input de Nombre-->
                        <label for="name" class="form-label" id="label-name">Nombres:</label>
                        <div class="input-container">
                            <i class="fas fa-user input-icon"></i>
                            <input
                                type="text"
                                name="name"
                                id="name"
                                class="form-control"
                                autocomplete="off"
                                placeholder="Geovanni Benjamin"
                                autofocus>
                        </div>
                        <span id="nameError" class="error-message"></span>
                    </div>

                    <div class="campo">
                        <!-- Input de Apellido-->
                        <label for="last_name" class="form-label" id="label-last_name">Apellidos:</label>
                        <div class="input-container">
                            <i class="fas fa-user input-icon"></i>
                            <input
                                type="text"
                                name="last_name"
                                id="last_name"
                                class="form-control"

                                placeholder="Vera Balcazar">
                        </div>
                        <span id="last_nameError" class="error-message"></span>
                    </div>
                </div>
                <div class="grupo">
                    <!-- Input de Email-->
                    <div class="campo">
                        <label for="email" class="form-label" id="label-email">Correo Electronico:</label>
                        <div class="input-container">
                            <i class="fas fa-envelope input-icon"></i>
                            <input
                                type="email"
                                name="email"
                                id="email"
                                class="form-control"
                                autocomplete="off"
                                placeholder="ejemplo@gmail.com">
                        </div>
                        <span id="emailError" class="error-message"></span>
                    </div>
                    <div class="campo">
                        <label for="password" class="form-label" id="label-password">Contraseña:</label>
                        <div class="input-container">
                            <i class="fas fa-lock input-icon"></i>
                            <input
                                type="password"
                                name="password"
                                id="password"
                                class="form-control"
                                autocomplete="off"
                                placeholder="Contraseña">
                        </div>
                        <span id="passwordError" class="error-message"></span>
                    </div>
                </div>
                <!-- Boton para enviar la solicitud-->
                <div class="grupo">
                    <div class="campo">
                        <input
                            type="submit"
                            value="Registrar Cuenta"
                            class="submit">

                    </div>
                </div>
            </form>

            <div class="acciones">
                <a href="/">
                    ¿ya tienes cuenta? inicia sesion.
                </a>
            </div>
            
        </div>
    </div>
    <script type="module" src="build/js/registerValidator.js"></script>

</main>