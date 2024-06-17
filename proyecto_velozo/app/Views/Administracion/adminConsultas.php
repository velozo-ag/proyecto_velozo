<section class="administracion">

    <?php if (!empty(session()->getFlashdata('fail'))): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
    <?php endif ?>

    <?php if (!empty(session()->getFlashdata('success'))): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif ?>

    <div class="navegacion">
        <a href="<?php echo base_url('panelAdmin') ?>">
            Administracion</a>

        <ul>
            <li><a href="<?php echo base_url('adminConsultas') ?>">Consultas</a></li>
            <li><a href="<?php echo base_url('adminContactos') ?>">Contactos</a></li>
        </ul>

    </div>

    <hr>

    <h4><?php echo $titulo ?></h4>
    <p><?php echo $descripcion ?></p>
    <table class="table">
        <colgroup>
            <col style="width: 20%;">
            <col style="width: 60%;">
            <col style="width: 20%;">
        </colgroup>
        <thead>
            <tr>
                <th>Usuario</th>
                <th>Mensaje</th>
                <th>Administrar</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($consultas as $consulta): ?>
                <tr class="<?php echo (!$consulta['activo']) ? 'leido' : '' ?>">
                    <td><b><?php echo $consulta['nombre'] . ' ' . $consulta['apellido'] ?></b><br>
                        <?= esc($consulta['email']) ?>
                    </td>
                    <td><?= esc($consulta['mensaje']) ?></td>
                    <td>

                        <?php if ($consulta['usuario_id'] != null): ?>

                            <?php if ($consulta['activo']): ?>
                                <a class="text-success  "
                                    href="<?php echo base_url('/bajaConsulta/' . $consulta['id_consulta']) ?>">Marcar Leido</a>
                            <?php else: ?>
                                <a class="text-danger"
                                    href="<?php echo base_url('/altaConsulta/' . $consulta['id_consulta']) ?>">Marcar no Leido</a>
                            <?php endif ?>

                        <?php else: ?>

                            <?php if ($consulta['activo']): ?>
                                <a class="text-success  "
                                    href="<?php echo base_url('/bajaContacto/' . $consulta['id_consulta']) ?>">Marcar Leido</a>
                            <?php else: ?>
                                <a class="text-danger"
                                    href="<?php echo base_url('/altaContacto/' . $consulta['id_consulta']) ?>">Marcar no Leido</a>
                            <?php endif ?>

                        <?php endif ?>

                    </td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>

    <div>
        <?= $pager->links('num', 'default'); ?>
    </div>

</section>