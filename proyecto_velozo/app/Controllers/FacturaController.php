<?php
namespace App\Controllers;

use App\Models\FacturasModel;
use App\Models\DetalleFacturasModel;
use App\Models\ProductosModel;
use App\Controllers\CarritoController;
use App\Models\UsuariosModel;
use CodeIgniter\Controller;

class FacturaController extends Controller
{

    public function __construct()
    {
        helper(['form', 'url']);
    }

    public function generarFactura()
    {
        $facturasModel = new FacturasModel();
        $detalleFacturasModel = new DetalleFacturasModel();
        $productosModel = new ProductosModel();
        $carritoController = new CarritoController();

        if (!$carritoController->validarStockCarrito()) {
            session()->setFlashdata('fail', 'No se encontro stock suficiente, hemos removido los productos fuera de stock.');

            return redirect()->to('carrito');
        }


        $carrito = session()->get('carrito');

        $factura = [
            'usuario_id' => session()->get('id_usuario'),
            'fecha_venta' => date('y-m-d'),
            'total_venta' => $carritoController->calcularTotal(),
        ];

        $factura_id = $facturasModel->insert($factura);

        foreach ($carrito as $item) {
            $producto = $item['producto'];
            $cantidad = $item['cantidad'];

            $detalle = [
                'factura_id' => $factura_id,
                'producto_id' => $producto['id_producto'],
                'cantidad' => $cantidad,
                'total_producto' => $producto['precio_venta'] * $cantidad,
            ];

            $productosModel->reducirStock($producto['id_producto'], $cantidad);
            $detalleFacturasModel->insert($detalle);
        }

        // Vacia el carrito
        session()->set(['carrito' => null]);
        session()->setFlashdata('success', 'Compra realizada');
        return redirect()->to('carrito');
    }

    public function historialCompras()
    {

        $facturasModel = new FacturasModel();
        $detallesModel = new DetalleFacturasModel();
        $usuariosModel = new UsuariosModel();
        $productosModel = new ProductosModel();
        $id_usuario = session()->get('id_usuario');

        $facturas = array();

        foreach ($facturasModel->facturasPorUsuario($id_usuario) as $factura) {

            $detalles = $detallesModel->detallesPorFactura($factura['id_factura']);
            $facturas[$factura['id_factura']] =
                [
                    'factura' => $factura,
                    'detalles' => $detalles
                ];
        }

        echo view('head');
        echo view('nav');
        echo view('historialCompras', [
            'facturas' => array_reverse($facturas),
            'usuario' => $usuariosModel->find($id_usuario),
            'productos' => $productosModel->findAll(),
        ]);
        echo view('footer');

    }

}