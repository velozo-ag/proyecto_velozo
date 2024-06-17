<section class="catalogo">

    <?php if (!empty(session()->getFlashdata('fail'))): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
    <?php endif ?>

    <?php if (!empty(session()->getFlashdata('success'))): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif ?>

    <div class="row justify-content-center column-gap-2 row-gap-2 my-2">
        <form class="" style="margin-left: 15%;" action="<?php echo base_url('catalogoFiltrado') ?>">

            <select name="categoria_id" id="">
                <?php if ($seleccionado != null): ?>
                    <option value="<?php echo $seleccionado ?>"><?php echo $categorias[$seleccionado - 1]['descripcion'] ?>
                    </option>
                <?php endif ?>
                <option value="-1">Seleccionar categoria | Todos</option>
                <?php foreach ($categorias as $categoria): ?>
                    <option value="<?php echo $categoria['id_categoria'] ?>"><?php echo $categoria['descripcion'] ?>
                    </option>
                <?php endforeach ?>
            </select>
            <button type="submit">Filtrar</button>

        </form>

        <?php foreach ($productos as $producto): ?>

            <div class="card col-4 m-2 mt-2 producto"
                style="width: 18rem; background-color: #fffaf6; color: #2b1603; border: none;">
                <img src="<?php echo base_url("/assets/img/thumbnails/" . $producto['imagen']); ?>"
                    class="card-img-top my-2" alt="..." style="border: solid 1px #2b1603;">
                <div class="card-body text-center my-2 p-0">
                    <h4 class="card-title"><?php echo $producto['nombre'] ?></h4>
                    <h6 class="">$ <?php echo $producto['precio_venta'] ?></h6>
                    <a class="boton-agregar" href="<?php echo base_url('carrito/agregarNuevo/' . $producto['id_producto']) ?>">
                        agregar al carrito </a>
                </div>
            </div>

        <?php endforeach ?>

        <div>
            <?= $pager->links('num', 'default'); ?>
        </div>

    </div>
</section>