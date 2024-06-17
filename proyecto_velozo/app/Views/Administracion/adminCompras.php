<?php
$request = \Config\Services::request();
// Obtener el parámetro de periodo de la URL
$periodo = $request->getGet('periodo');

?>
<section class="administracion">
    <div class="navegacion">
        <a href="<?php echo base_url('/panelAdmin') ?>">Administracion</a>
    </div>

    <h4 class="">Gestion de Ventas</h4>
    <div class="recaudacion">
        <div class="">
            Total recaudado | <?php echo $cantidad_compras ?> ventas. <br>
            <span>$<?php echo $ventas_total ?></span>
            <ul class="periodo">
                <li>Periodo: </li>
                <li><a class="<?php echo ($periodo == '1') ? 'selec' : '' ?>"
                        href="<?php echo base_url('/adminVentas?periodo=1') ?>">1M</a></li>|
                <li><a class="<?php echo ($periodo == '6') ? 'selec' : '' ?>"
                        href="<?php echo base_url('/adminVentas?periodo=6') ?>">6M</a></li>|
                <li><a class="<?php echo ($periodo == '12') ? 'selec' : '' ?>"
                        href="<?php echo base_url('/adminVentas?periodo=12') ?>">1A</a></li>|
                <li><a class="<?php echo (!$periodo) ? 'selec' : '' ?>"
                        href="<?php echo base_url('/adminVentas') ?>">MAX</a></li>
            </ul>
        </div>
    </div>

    <?php if(count($productos) != 0) : ?>

    <table class="table">
        <colgroup>
            <col style="width: 60%;">
            <col style="width: 15%;">
            <col style="width: 15%;">
        </colgroup>
        <caption class="text-start p-2">
            Ventas por Producto

        </caption>
        <thead>
            <th>Producto</th>
            <th>Ventas</th>
            <th>Total</th>
        </thead>
        <tbody>
            <?php foreach ($productos as $producto): ?>
                <tr>
                    <td><b><?php echo $producto['nombre'] . '<br>' . $categorias[$producto['categoria_id'] - 1]['descripcion'] ?></b>
                    </td>
                    <td><?php echo $producto['total_ventas'] ?></td>
                    <td><?php echo '$' . $producto['total'] ?></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?php else: ?>
        <p class="text-center p-4">No se han realizado ventas en este periodo.  </p>
    <?php endif ?>
</section>