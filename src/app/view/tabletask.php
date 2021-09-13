<table id="tableTask" class="table-tasks">
    <thead class="thead-table">
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripción</th>
        <th>Estado</th>
        <th>Acción </th>
    </thead>
    <tbody id="">
        <?php $cont = 1;
        $hayDatos = $params['listTask'] != false ? true : false;
        $estados = array('pendiente',  'terminada');
        if ($hayDatos) {

            foreach ($params['listTask'] as $task) : ?>
                <tr>
                    <td><?= $task['id'] ?></td>
                    <td><?= $task['nombre'] ?></td>
                    <td><?= $task['descripcion'] ?></td>
                    <td class="estado">
                        <select name="estado" id="estado_<?= $cont ?>" class="estadosSelect" href="javascript:;" onchange="changeStatus('<?= $task['id'] ?>','estado_<?= $cont ?>')">
                            <?php foreach ($estados as $estado) {
                                if ($estado == $task['estado']) { ?>
                                    <option selected value="<?= $task['estado'] ?>"><?= strtoupper($task['estado']) ?></option>
                                <?php } else { ?>
                                    <option value="<?= $estado ?>"> <?= strtoupper($estado) ?></option>
                            <?php }
                            } ?>
                        </select>
                    </td>
                    <td>
                        <div class="acciones-contenedor">
                            <button class="btnBorrar" id="btnBorrar_<?= $cont ?>" href="javascript:;" onclick="deleteTask('<?= $task['id'] ?>')">Borrar</button>
                        </div>
                    </td>
                </tr>
            <?php ++$cont;
            endforeach;
        } else { ?>
            <tr>
                <td colspan=" 4"> No existe ninguna tarea
                </td>
            </tr>
        <?php }  ?>
    </tbody>
</table>
