<?php ob_start() ?>
<div class="contenedor-titulo-main">
    <h1 class="title-main">TODO-LIST APP</h1>
    <h3 class="title-main">Bienvenid@ <?= isset($_COOKIE['user']) ? $_COOKIE['user'] : '' ?></h3>
</div>
<div class="contenido-main">
    <div id="msmerror" class="error"></div>
    <div class="todoapp">
        <form action="" method="POST" id="formCreateTask">
            <div class="input-form">
                <label for="nombreTarea">Nombre de la tarea</label>
                <input type="text" name="nombreTarea" id="nombreTarea" placeholder="Escriba el nombre de la tarea">
            </div>
            <div class="input-form">
                <label for="descTarea">Descripción</label>
                <textarea name="descTarea" id="descTarea" cols="20" rows="8"></textarea>
            </div>
            <div class="input-form">
                <label for="estadoTarea">Estado</label>
                <select name="estadoTarea" id="estadoTarea">
                    <option value="terminada">Terminada</option>
                    <option value="pendiente">Pendiente</option>
                </select>
            </div>
            <div class="input-form btns">
                <button id="btnNewTask" type="submit">Añadir Tarea</button>
                <button type="reset">Cancelar</button>
            </div>
        </form>
    </div>
    <hr>
    <div class="listaTarea">
        <?php include 'tabletask.php' ?>
    </div>
</div>

</div>

<?php $contenido = ob_get_clean() ?>

<?php include   'layoutlogado.php'; ?>
<?php include   'footerscripjs.php'; ?>

</html>