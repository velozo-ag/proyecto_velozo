<section class="administracion">

    <?php if (!empty(session()->getFlashdata('fail'))): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
    <?php endif ?>

    <?php if (!empty(session()->getFlashdata('success'))): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
    <?php endif ?>

    <div class="navegacion">
        <a href="<?php echo base_url('panelAdmin') ?>">Administracion</a>

        <div class="derecha">

            <ul>
                <li><a class="boton nuevo-cat" href="<?php echo base_url('crearCategoria') ?>">Nueva Categoria +</a>
                </li>
                <li><a class="boton nuevo-prod" href="<?php echo base_url('agregarProducto') ?>">Nuevo Producto
                        +</a>
                </li>
            </ul>
            <form action="<?php echo base_url('adminProductos') ?>">

                <label for="activo"></label>
                <select name="activo">
                    <option value="-1">Todos los Productos</option>
                    <option value="1">Productos Activos</option>
                    <option value="0">Productos Inactivos</option>
                </select>

                <button type="submit">Filtrar</button>
            </form>
        </div>
    </div>

    <hr>

    <!-- LISTA DE PRODUCTOS ACTIVOS -->
    <h4><?php echo $titulo ?></h4>
    <?php if (count($productos) == 0): ?>
        <p><?php echo $excepcion ?></p>
    <?php else: ?>
        <p><?php echo $descripcion ?></p>
        <table class="table">
            <thead>
                <tr>
                    <th class="des">Imagen</th>
                    <th class="des">ID</th>
                    <th>Nombre/Categoria</th>
                    <th class="des">Precio</th>
                    <th>Precio Venta</th>
                    <th>Stock</th>
                    <th>Administrar</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($productos as $producto): ?>
                    <tr>
                        <td class="des">
                            <img style="max-height: 100px;"
                                src="<?php echo base_url('/assets/img/Thumbnails/' . esc($producto['imagen'])); ?>" />
                        </td>
                        <td class="des"><?= esc($producto['id_producto']) ?></td>
                        <td><b><?= esc($producto['nombre']) ?></b><br>
                            <?= esc($categorias[$producto['categoria_id'] - 1]['descripcion']) ?></td>
                        <td class="des"><?= '$' . esc($producto['precio']) ?></td>
                        <td><?= '$' . esc($producto['precio_venta']) ?></td>
                        <td><?= esc($producto['stock']) ?></td>
                        <td>
                            <?php echo ($producto['activo']) ?
                                '<a class="text-danger" href="' . base_url("bajaProducto/" . $producto["id_producto"]) . '?activo=' . $activo . '">Desactivar</a>' :
                                '<a class="text-success" href="' . base_url("altaProducto/" . $producto["id_producto"]) . '?activo=' . $activo . '">Activar</a>'
                                ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>
        </table>

    <?php endif ?>

    <div>
        <?= $pager->links('num', 'default'); ?>
    </div>
</section>