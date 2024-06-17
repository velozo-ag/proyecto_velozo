<section class="formularioAdministracion">
    <?php $validation = \Config\Services::validation(); ?>

    <div class="navegacion">
        <a href="<?php echo base_url('adminProductos') ?>"><- Volver</a>
    </div>

    <form class="d-flex flex-column" action="<?php echo base_url('nuevoProducto') ?>" method="post"
        enctype="multipart/form-data">

        <h4 class="text-center p-4">Agregar Producto</h4>

        <?php if (!empty(session()->getFlashdata('fail'))): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
        <?php endif ?>

        <?php if (!empty(session()->getFlashdata('success'))): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif ?>

        <!-- ----------------------------------- -->
        <div class="form-group">
            <label class="label-registro">Nombre</label>
            <input type="text" name="nombre">
        </div>

        <label>Imagen</label>
        <input class="input-imagen" type="file" name="imagen" size="20">

        <label>Categoria</label>
        <select name="categoria_id" id="categoria_id">
            <?php foreach ($categorias as $categoria): ?>
                <option name="categoria_id" value="<?php echo $categoria['id_categoria'] ?>">
                    <?php echo $categoria['id_categoria'] . ' - ' . $categoria['descripcion'] ?>
                </option>
            <?php endforeach ?>
        </select>

        <div class="form-group">
            <label class="label-registro">Precio</label>
            <input type="number" step="0.01" min="0" name="precio">
        </div>
        <div class="form-group">
            <label class="label-registro">Precio de Venta</label>
            <input type="number" step="0.01" min="0" name="precio_venta">
        </div>

        <div class="form-group">
            <label class="label-registro">Stock</label>
            <input type="number" name="stock">
        </div>
        <!-- <input type="number" name="stock_minimo" placeholder="stock_minimo"> -->

        <button type="submit">Agregar</button>
    </form>
</section>