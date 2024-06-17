<section class="administracion">

    <?php if (!empty(session()->getFlashdata('fail'))): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
    <?php endif ?>

    <?php if (!empty(session()->getFlashdata('success'))): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif ?>

    <div class="navegacion">
        <a href="<?php echo base_url('panelAdmin') ?>">Administracion</a>

        <form action="<?php echo base_url('adminUsuarios') ?>">
            <label for="baja"></label>
            <select name="baja">
                <option value="-1">Todos los Usuarios</option>
                <option value="0">Usuarios Activos</option>
                <option value="1">Usuarios Inactivos</option>
            </select>

            <button type="submit">Filtrar</button>
        </form>

    </div>

    <hr>

    <!-- TABLA DE USUARIOS DADOS DE ALTA/ACTIVOS -->
    <h4><?php echo $titulo ?></h4>
    <?php if (count($usuarios) == 0): ?>
        <p><?php echo $descripcion . ' ' . $excepcion ?></p>
    <?php else: ?>
        <p><?php echo $descripcion ?></p>

        <table class="table">
            <thead>
                <tr>
                    <th class="des">ID</th>
                    <th>Usuario</th>
                    <th class="des">Nombre de Usuario</th>
                    <th>Rol</th>
                    <th>Administrar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($usuarios as $usuario): ?>
                    <tr>
                        <td class="des">
                            <b> <?= esc($usuario['id_usuario']) ?> </b>
                        </td>
                        <td>
                            <b><?= esc($usuario['nombre']) . ' ' . esc($usuario['apellido']) ?></b>
                            <br><?= esc($usuario['email']) ?>
                        </td>
                        <td class="des"><?= esc($usuario['usuario']) ?></td>
                        <td><?= esc($perfiles[$usuario['perfil_id'] - 1]['descripcion']) ?></td>

                        <?php if (session()->get('id_usuario') != $usuario['id_usuario']): ?>
                            <td>
                                <?php echo ($usuario['baja']) ?
                                    '<a class="text-success" href="' . base_url("altaUsuario/" . $usuario["id_usuario"]) . '?baja=' . $baja . '">Habilitar</a>' :
                                    '<a class="text-danger" href="' . base_url("bajaUsuario/" . $usuario["id_usuario"]) . '?baja=' . $baja . '">Deshabilitar</a>'
                                    ?>

                            </td>
                        <?php else: ?>
                            <td> - </a>
                            </td>
                        <?php endif ?>

                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

    <?php endif ?>

    <div>
        <?= $pager->links('num', 'default'); ?>
    </div>

</section>