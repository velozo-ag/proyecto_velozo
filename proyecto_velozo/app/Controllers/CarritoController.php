<?php
namespace App\Controllers;

use App\Models\CategoriasModel;
use App\Models\ProductosModel;
use CodeIgniter\Controller;

class CarritoController extends Controller
{

    public function __construct()
    {
        helper(['form', 'url']);
    }

    public function carrito()
    {
        $session = session();

        $categorias = new CategoriasModel();
        $carrito = $session->get('carrito');

        echo view('head');
        echo view('nav');
        echo view('carrito', [
            'carrito' => $carrito,
            'categorias' => $categorias->findAll(),
            'total' => $this->calcularTotal(),
        ]);
        echo view('footer');
    }

    public function agregarProductoAlCarrito($id)
    {

        $productosModel = new ProductosModel();
        $producto = $productosModel->find($id);

        // si no esta logeado automaticamente lo envia al login
        if (!session()->get('logged_in')) {
            return redirect()->to('login');
        }

        if($producto['stock'] <= 0){
            session()->setFlashdata('fail', 'Producto ' . $producto['nombre'] . ' fuera de stock.');
            return redirect()->to('catalogo');
        }

        // obtiene el carrito actual si es que ya hay algo
        $carrito = session()->get('carrito');

        if (isset($carrito[$id])) {
            $carrito[$id]['cantidad'] += 1;
        } else {
            $carrito[$id] = [
                'producto' => $producto,
                'cantidad' => 1
            ];
        }

        session()->set(['carrito' => $carrito]);

        session()->setFlashdata('success', 'Producto ' . $producto['nombre'] . ' agregado correctamente.');
        return redirect()->to('catalogo');
    }

    public function agregarEnCarrito($id)
    {
        $productosModel = new ProductosModel();
        $carrito = session()->get('carrito');

        if (
            isset($carrito[$id]) &&
            $productosModel->verificarCantidad($id, $carrito[$id]['cantidad'] + 1)
        ) {
            $carrito[$id]['cantidad'] += 1;
        } else {
            session()->setFlashdata('fail', 'Stock Insuficiente de ' . $carrito[$id]['producto']['nombre']);
        }

        session()->set(['carrito' => $carrito]);
        return redirect()->to('carrito');
    }

    public function quitarDelCarrito($id)
    {

        $productosModel = new ProductosModel();
        $carrito = session()->get('carrito');

        if (!isset($carrito[$id])) {
            return redirect()->to('catalogo');
        }

        if ($carrito[$id]['cantidad'] == 1) {
            unset($carrito[$id]);
        } else {
            $carrito[$id]['cantidad'] = $carrito[$id]['cantidad'] - 1;
        }

        session()->set(['carrito' => $carrito]);
        return redirect()->to('carrito');

    }

    public function removerProductoCompleto($id)
    {

        $carrito = session()->get('carrito');

        if (isset($carrito[$id])) {
            unset($carrito[$id]);
        }

        session()->set(['carrito' => $carrito]);
        return redirect()->to('carrito');

    }

    public function removerCarritoCompleto()
    {
        session()->set(['carrito' => null]);
        return redirect()->to('carrito');
    }

    public function calcularTotal()
    {
        $carrito = session()->get('carrito');
        $total = 0;

        if ($carrito == null) {
            return 0;
        }

        foreach ($carrito as $item) {
            $total += $item['producto']['precio_venta'] * $item['cantidad'];
        }

        return $total;
    }

    public function validarStockCarrito()
    {
        $productosModel = new ProductosModel();
        $carrito = session()->get('carrito');

        $suficienteStock = true; // cancela compra si un prod es insuficiente
        $productosSinStock = array();

        foreach ($carrito as $item) {
            $producto = $item['producto'];
            $cantidad = $item['cantidad'];
            $id = $producto['id_producto'];

            if (!$productosModel->verificarCantidad($id, $cantidad)) {

                $suficienteStock = false;
                $stockActual = $productosModel->find($id)['stock'];

                if ($stockActual == 0) {
                    $productosSinStock[$id] = $id;
                } else {
                    $carrito[$id]['cantidad'] = $stockActual;
                }

            }
        }

        foreach ($productosSinStock as $idProducto) {
            unset($carrito[$idProducto]);
        }

        session()->set(['carrito' => $carrito]);
        return $suficienteStock;
    }

    public function ventasPorProducto(){
        
    }

}