<section class="formularioAdministracion">
    <?php $validation = \Config\Services::validation(); ?>


    <form class="d-flex flex-column" action="<?php echo base_url('/RegistroController/nuevoUsuario') ?>" method="post">
        <h4 class="text-center p-4">Registro</h4>

        <?php if (!empty(session()->getFlashdata('fail'))): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
        <?php endif ?>

        <?php if (!empty(session()->getFlashdata('success'))): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif ?>

        <!-- ----------------------------------- -->
        <div class="form-group">
            <label class="label-registro" for="nombre">Nombre</label>
            <input type="text" name="nombre">
        </div>
        <?php if ($validation->getError('nombre')) { ?>
            <div class='alert alert-danger'>
                <?= $error = $validation->getError('nombre'); ?>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="label-registro" for="nombre">Apellido</label>
            <input type="text" name="apellido">
        </div>
        <?php if ($validation->getError('apellido')) { ?>
            <div class='alert alert-danger'>
                <?= $error = $validation->getError('apellido'); ?>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="label-registro" for="nombre">Username</label>
            <input type="text" name="usuario">
        </div>
        <?php if ($validation->getError('usuario')) { ?>
            <div class='alert alert-danger'>
                <?= $error = $validation->getError('usuario'); ?>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="label-registro" for="nombre">Email</label>
            <input type="text" name="email">
        </div>
        <?php if ($validation->getError('email')) { ?>
            <div class='alert alert-danger'>
                <?= $error = $validation->getError('email'); ?>
            </div>
        <?php } ?>

        <div class="form-group">
            <label class="label-registro" for="nombre">Password</label>
            <input type="password" name="pass">
        </div>
        <?php if ($validation->getError('pass')) { ?>
            <div class='alert alert-danger'>
                <?= $error = $validation->getError('pass'); ?>
            </div>
        <?php } ?>

        <button type="submit">Enviar</button>

        <p class="text-center pt-4">Ya posees una cuenta? <a href="<?php echo base_url('login') ?>">logeate</a></p>
    </form>
</section>