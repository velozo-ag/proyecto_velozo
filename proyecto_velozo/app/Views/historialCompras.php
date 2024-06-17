<section class="historialCompras">

    <h2> Historial de Compras </h2>
    <p> Aqui puedes ver todas las compras que ya has realizado.</p>

    <ul>
        <?php foreach ($facturas as $factura):
            $cabecera = $factura['factura'];
            $detalles = $factura['detalles'];
            ?>

            <div class="factura">
                <div class="cabecera">
                    <p class="text-center">RoastCafe Company S.A
                        <br> +54 0379 4123456
                    </p>
                    <p>Cliente: <?php echo $usuario['apellido'] . ', ' . $usuario['nombre'] ?><br>
                        <?php echo $usuario['email'] ?></p>
                    <p>Factura N° 00<?php echo $cabecera['id_factura'] ?><br>
                        Fecha <?php echo $cabecera['fecha_venta'] ?></p>
                </div>
                <div class="detalle">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Cant</th>
                                <th>Descripcion</th>
                                <th>Unidad</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($detalles as $detalle): ?>
                                <tr>
                                    <td><?php echo $detalle['cantidad'] ?></td>
                                    <td><?php echo $productos[$detalle['producto_id']]['nombre'] ?></td>
                                    <td><?php echo '$' . $detalle['total_producto'] / $detalle['cantidad'] ?></td>
                                    <td><?php echo '$' . $detalle['total_producto'] ?></td>
                                </tr>
                            <?php endforeach ?>
                            <tr>
                                <td></td>
                                <td></td>
                                <td><b>TOTAL</b></td>
                                <td><b><?php echo '$' . $cabecera['total_venta'] ?></b></td>
                            </tr>
                        </tbody>
                    </table>
                </div>
                <footer>Gracias por su compra! <br> 9 de Julio 1449, Corrientes, Capital
                    <br><?php echo $cabecera['fecha_venta'] ?><br>
                    roastcafe@gmail.com
                </footer>
            </div>

        <?php endforeach ?>

        <?php if ($facturas == null): ?>
            <p>Aun no has realizado ninguna compra</p>
        <?php endif ?>
    </ul>

</section>