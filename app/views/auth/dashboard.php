<div class="contenedor-app">
    <div class="imagen">
        <div class="contenedor-sombreado">
            <div class="sombreado"></div>
        </div>
    </div>
    <div class="app">
        <h1 class="nombre-pagina">Bienvenido <?php if(isset($user)) echo $user->getName() ;?></h1>
    </div>
</div>

<script type="module" src="build/js/forgetValidator.js"></script>