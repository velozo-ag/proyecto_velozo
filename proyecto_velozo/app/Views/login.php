<secction class="formularioAdministracion">

    <form class="d-flex flex-column" action="<?php echo base_url('/LoginController/auth') ?>" method="post">
        <h4 class="text-center p-4">Login</h4>

        <?php if (!empty(session()->getFlashdata('fail'))): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
        <?php endif ?>

        <?php if (!empty(session()->getFlashdata('success'))): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif ?>
        <div class="form-group">
            <label class="label-registro" for="email">Email</label>
            <input type="text" name="email">
        </div>
        <div class="form-group">
            <label class="label-registro" for="Password">Password</label>
            <input type="password" name="pass">
        </div>
        <button type="submit">Login</button>
        <p class="text-center pt-4">Aun no posee una cuenta? <a href="<?php echo base_url('registro') ?>">registrese</a>
        </p>
    </form>

</secction>