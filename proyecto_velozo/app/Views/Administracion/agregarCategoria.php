<section class="formularioAdministracion">
    <?php $validation = \Config\Services::validation(); ?>

    <div class="navegacion">
        <a href="<?php echo base_url('adminProductos') ?>"><- Volver</a>
    </div>

    <form class="d-flex flex-column" action="<?php echo base_url('/crearCategoria') ?>" method="post">

        <h4 class="text-center p-4">Crear Categoria</h4>

        <?php if (!empty(session()->getFlashdata('fail'))): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
        <?php endif ?>

        <?php if (!empty(session()->getFlashdata('success'))): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif ?>

        <!-- ----------------------------------- -->
        <div class="form-group">
            <label class="label-registro">Descripcion / Categoria</label>
            <input type="text" name="descripcion">
        </div>

        <button type="submit">Agregar</button>

    </form>
</section>