<?php ob_start() ?>
<div class="contenedor-titulo-main">
    <h1 class="title-main">Acceso</h1>
</div>
<div class="contenido-main">
    <div class="error">
        <?php echo isset($errorLogin) ? $errorLogin : '' ?>
    </div>
    <div class="login">
        <form action="/login" method="POST">
            <div class="input-form">
                <label for="user">Usuario</label>
                <input type="text" name="user" id="user">
            </div>
            <div class="input-form">
                <label for="password">Contraseña</label>
                <input type="password" name="password" id="password">
            </div>
            <div class="input-form">
                <button type="submit">Acceder</button>
            </div>
        </form>
    </div>

</div>

<?php $contenido = ob_get_clean() ?>

<?php include   'layoutmain.php'; ?>

</body>

</html>