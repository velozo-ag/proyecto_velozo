<section class="carrito">
    <!-- <?php var_dump($carrito); ?> -->

    <div class="container my-5">

        <?php if (!empty(session()->getFlashdata('fail'))): ?>
            <div class="alert alert-danger"><?= session()->getFlashdata('fail'); ?></div>
        <?php endif ?>

        <?php if (!empty(session()->getFlashdata('success'))): ?>
            <div class="alert alert-success"><?= session()->getFlashdata('success'); ?></div>
        <?php endif ?>

        <?php if ($carrito != null): ?>

            <table class="table">
                <colgroup>
                    <col style="width: 10%;">
                    <col style="width: 50%;">
                    <col style="width: 20%;">
                    <col style="width: 20%;">
                </colgroup>
                <thead>
                    <tr>
                        <th></th>
                        <th>Detalle</th>
                        <th>Cantidad</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($carrito as $id_producto => $item):
                        $producto = $item['producto'];
                        $cantidad = $item['cantidad'] ?>

                        <tr>
                            <td>
                                <img class="img-fluid d-none d-md-block" style="height: 100px;"
                                    src="<?php echo base_url('assets/img/Thumbnails/' . $producto['imagen']) ?>" />
                            </td>
                            <td>
                                <div class="contenido">
                                    <p><b>
                                            <?php echo $producto['nombre'] . " - " . $categorias[$producto['categoria_id'] - 1]['descripcion'] ?></b>
                                        <br>
                                        <?php echo '$ ' . $producto['precio_venta'] ?> <br> <a class="text-danger"
                                            href="<?php echo base_url('carrito/remover/' . $id_producto) ?>">remover</a>
                                    </p>
                                </div>
                            </td>
                            <td>
                                <div class="contenido">
                                    <a class="boton" href="<?php echo base_url('carrito/quitar/' . $id_producto) ?>">-</a>
                                    <span> <?php echo $cantidad ?> </span>
                                    <a class="boton" href="<?php echo base_url('carrito/agregar/' . $id_producto) ?>">+</a>
                                </div>
                            </td>
                            <td>
                                <div class="contenido">
                                    <h5>$ <?php echo $cantidad * $producto['precio_venta'] ?></h5>
                                </div>
                            </td>
                        </tr>

                    <?php endforeach ?>
                    <thead>
                        <th></th>
                        <th></th>
                        <th>Total</th>
                        <th><?php echo '$ ' . $total ?></th>
                    </thead>
                </tbody>
            </table>

            <div class="navegacion">
                <ul>
                    <li>
                        <a href="<?php echo base_url('catalogo') ?>">Seguir comprando</a>
                    </li>
                    <li>
                        <a href="<?php echo base_url('carrito/finalizarCompra') ?>">Finalizar compra</a><br>
                    </li>
                </ul>
                <a href="<?php echo base_url('historialCompras') ?>">Ver historial de Compras</a>
            </div>

        <?php else: ?>

            <h5 class="text-center">
                Aun no hay productos en el carrito. <br>
                Dirigete al <a href="<?php echo base_url('catalogo') ?>">catalogo</a> para seguir comprando!
            </h5>

            <div class="navegacion">
                <a href="<?php echo base_url('historialCompras') ?>">Ver historial de Compras</a>
                <a href="<?php echo base_url('catalogo') ?>">Seguir comprando</a>
            </div>

        <?php endif ?>

    </div>

</section>