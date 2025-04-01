<main>
    <div class="contenedor-app">
        <div class="imagen">
            <div class="contenedor-sombreado">
                <div class="sombreado"></div>
            </div>
        </div>
        <div class="app">
            <h1 class="nombre-pagina">Inicia Sesion en Game Hub</h1>
            <?php include __DIR__ . '/../includes/alertas.php' ?>
            <form action="/" class="formulario" method="post" id="loginForm">
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
                            placeholder="Contraseña"
                            disabled>
                    </div>
                    <span id="passwordError" class="error-message"></span>


                </div>
                <div class="campo">
                    <input
                        type="submit"
                        value="Inicia sesión"
                        class="submit">
                </div>
            </form>

            <div class="acciones">
                <a href="/register">
                    ¿no tienes cuenta? registrate
                </a>
            </div>
        </div>
    </div>
</main>
