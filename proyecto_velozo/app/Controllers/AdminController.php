<?php
namespace App\Controllers;

use App\Models\CategoriasModel;
use App\Models\DetalleFacturasModel;
use App\Models\FacturasModel;
use App\Models\PerfilesModel;
use App\Models\UsuariosModel;
use App\Models\ProductosModel;
use App\Models\ConsultasModel;
use CodeIgniter\Controller;

class AdminController extends Controller
{

    public function __construct()
    {
        helper(['form', 'url']);
    }

    // ADMINISTRACION DE USUARIOS ------------
    public function tablaUsuarios()
    {
        $usuariosModel = new UsuariosModel();
        $perfilesModel = new PerfilesModel();

        $baja = $this->request->getVar('baja');
        if ($baja == null) {
            $baja = -1;
        }

        $page = (int) ($this->request->getVar('page_num') ?? -1);
        $perPage = 15; // Número de elementos por página

        switch ($baja) {
            case 0:
                $data = [
                    'usuarios' => $usuariosModel->paginarUsuariosActivos($perPage, $page),
                    'titulo' => 'Usuarios Activos',
                    'descripcion' => 'Lista de usuarios activos.',
                    'excepcion' => 'No hay usuarios activos.'
                ];
                break;
            case 1:
                $data = [
                    'usuarios' => $usuariosModel->paginarUsuariosInactivos($perPage, $page),
                    'titulo' => 'Usuarios Inactivos',
                    'descripcion' => 'Lista de usuarios inactivos.',
                    'excepcion' => 'No hay usuarios inactivos.'
                ];
                break;
            default:
                $data = [
                    'usuarios' => $usuariosModel->paginarUsuarios($perPage, $page),
                    'titulo' => 'Usuarios',
                    'descripcion' => 'Lista de todos los usuarios.',
                    'excepcion' => 'No hay usuarios registrados.'
                ];
                break;
        }


        $data['perfiles'] = $perfilesModel->findAll();
        $data['pager'] = $usuariosModel->pager;
        $data['baja'] = $baja;

        echo view('head');
        echo view('nav');
        echo view('Administracion/adminUsuarios', $data);
        echo view('footer');
    }

    public function bajaUsuario($id)
    {
        $usuariosModel = new UsuariosModel();
        $usuariosModel->bajaUsuario($id);

        $baja = $this->request->getVar('baja');

        return redirect()->to('adminUsuarios?baja=' . $baja);
    }

    public function altaUsuario($id)
    {
        $usuarios = new UsuariosModel();
        $usuarios->altaUsuario($id);

        $baja = $this->request->getVar('baja');

        return redirect()->to('adminUsuarios?baja=' . $baja);
    }

    // ADMINISTRACION DE PRODUCTOS ------------
    public function tablaProductos()
    {
        $productosModel = new ProductosModel;
        $categoriasModel = new CategoriasModel();

        $activo = $this->request->getVar('activo');
        if ($activo == null) {
            $activo = -1;
        }

        $page = (int) ($this->request->getVar('page_num') ?? -1);
        $perPage = 15; // Número de elementos por página

        switch ($activo) {
            case 1:
                $data = [
                    'productos' => $productosModel->paginarProductosActivos($perPage, $page),
                    'titulo' => 'Productos Activos',
                    'descripcion' => 'Lista de productos activos en el catalogo.',
                    'excepcion' => 'No hay productos activos.'
                ];
                break;
            case 0:
                $data = [
                    'productos' => $productosModel->paginarProductosInactivos($perPage, $page),
                    'titulo' => 'Productos Inactivos',
                    'descripcion' => 'Lista de productos inactivos o fuera de stock.',
                    'excepcion' => 'No hay productos inactivos.'
                ];
                break;
            default:
                $data = [
                    'productos' => $productosModel->paginarTotalProductos($perPage, $page),
                    'titulo' => 'Productos',
                    'descripcion' => 'Lista de todos los productos.',
                    'excepcion' => 'No hay productos registrados.'
                ];
                break;
        }


        $data['pager'] = $productosModel->pager;
        $data['activo'] = $activo;
        $data['categorias'] = $categoriasModel->findAll();

        echo view('head');
        echo view('nav');
        echo view('Administracion/adminProductos', $data);
        echo view('footer');
    }

    public function agregarProducto()
    {
        $model = new CategoriasModel();
        $categorias = $model->findAll();

        $data = [
            'categorias' => $categorias,
            'validation' => $this->validator,
        ];

        echo view('head');
        echo view('nav');
        echo view('Administracion/agregarProductos', $data);
        echo view('footer');
    }

    public function nuevoProducto()
    {
        $productosModel = new ProductosModel();
        $categoriasModel = new CategoriasModel();

        $input = $this->validate([
            'nombre' => 'required',
            'imagen' => [
                'uploaded[imagen]',
                'mime_in[imagen,image/jpg,image/jpeg,image/png]',
            ],
            'categoria_id' => 'required',
            'precio' => 'required',
            'precio_venta' => 'required',
            'stock' => 'required',
            // 'stock_minimo' => 'required',
        ]);

        if ($input) {

            $img = $this->request->getFile('imagen');
            // Le asignamos un nombre random a nuestra imagen
            $randomName = $img->getRandomName();
            // Guardamos la imagen ingresada en la carpeta uploads con un nombre random
            $img->move(ROOTPATH . 'assets/img/Thumbnails', $randomName);

            $data = [
                'nombre' => $this->request->getVar('nombre'),
                'imagen' => $img->getName(),
                'categoria_id' => $this->request->getVar('categoria_id'),
                'precio' => $this->request->getVar('precio'),
                'precio_venta' => $this->request->getVar('precio_venta'),
                'stock' => $this->request->getVar('stock'),
                // 'stock_minimo' => $this->request->getVar('stock_minimo'),
                'activo' => 1,
            ];

            $productosModel->save($data);

            session()->setFlashdata('success', 'Producto agregado correctamente');
            return $this->response->redirect(base_url('agregarProducto'));
        } else {

            $categorias = $categoriasModel->findAll();

            $data = [
                'categorias' => $categorias,
                'validation' => $this->validator,
            ];

            echo view('head');
            echo view('nav');
            echo view('Administracion/agregarProductos', $data);
            echo view('footer');

            session()->setFlashdata('fail', 'Error al agregar producto');
            return $this->response->redirect(base_url('agregarProducto'));
        }

    }

    public function modificarProducto($id)
    {
        $modelProductos = new ProductosModel();
        $modelCategorias = new CategoriasModel();

        $producto = $modelProductos->find($id);
        $categorias = $modelCategorias->findAll();

        $data['producto'] = $producto;
        $data['categorias'] = $categorias;

        echo view('head');
        echo view('nav');
        echo view('Administracion/modificarProductos', $data);
        echo view('footer');

    }

    public function editarProducto($id)
    {

        $model = new ProductosModel();

        $img = $this->request->getFile('imagen');

        // si hay imagen, la valida, caso contrario, no valida la imagen
        if ($img && $img->isValid() && !$img->hasMoved()) {
            $input = $this->validate([
                'nombre' => 'required',
                'imagen' => [
                    'uploaded[imagen]',
                    'mime_in[imagen,image/jpg,image/jpeg,image/png]',
                ],
                'categoria_id' => 'required',
                'precio' => 'required',
                'precio_venta' => 'required',
                'stock' => 'required',
                // 'stock_minimo' => 'required',
            ]);
        } else {
            $input = $this->validate([
                'nombre' => 'required',
                'categoria_id' => 'required',
                'precio' => 'required',
                'precio_venta' => 'required',
                'stock' => 'required',
                // 'stock_minimo' => 'required',
            ]);
        }

        if ($input) {

            $data = [
                'nombre' => $this->request->getVar('nombre'),
                'categoria_id' => $this->request->getVar('categoria_id'),
                'precio' => $this->request->getVar('precio'),
                'precio_venta' => $this->request->getVar('precio_venta'),
                'stock' => $this->request->getVar('stock'),
                // 'stock_minimo' => $this->request->getVar('stock_minimo'),
            ];

            // si es una imagen nueva, la valida y la mueve a la carpeta correspondiente
            if ($img && $img->isValid() && !$img->hasMoved()) {
                $randomName = $img->getRandomName();
                $img->move(ROOTPATH . 'assets/img/Thumbnails', $randomName);
                $data['imagen'] = $img->getName();
            } else { // si no hay imagen, utiliza la que ya poseia
                $data['imagen'] = $model->find($id)['imagen'];
            }

            $model->update($id, $data);

            session()->setFlashdata('success', 'Producto modificado correctamente');
            return $this->response->redirect(base_url('adminProductos'));
        } else {

            session()->setFlashdata('fail', 'Error al modificar producto');
            return $this->response->redirect(base_url('modificarProducto/' . $id));
        }

    }

    public function bajaProducto($id)
    {
        $producto = new ProductosModel();
        $producto->bajaProducto($id);

        $activo = $this->request->getVar('activo');

        // session()->setFlashdata('success', 'Producto dado de baja');
        return redirect()->to('adminProductos?activo=' . $activo);
    }

    public function altaProducto($id)
    {
        $producto = new ProductosModel();
        $producto->altaProducto($id);

        $activo = $this->request->getVar('activo');

        // session()->setFlashdata('success', 'Producto dado de alta');

        return redirect()->to('adminProductos?activo=' . $activo);
    }

    // ADMINISTRACION CATEGORIAS
    public function formCategoria()
    {
        echo view('head');
        echo view('nav');
        echo view('Administracion/agregarCategoria');
        echo view('footer');
    }

    public function nuevaCategoria()
    {

        $input = $this->validate([
            'descripcion' => 'required|min_length[3]'
        ]);

        $categoria = new CategoriasModel();

        if (!$input) {
            echo view('head');
            echo view('nav');
            echo view('Administracion/agregarCategoria');
            echo view('footer');

            session()->setFlashdata('fail', 'Error al crear categoria');
            return redirect()->to('crearCategoria');

        } else {

            $data = [
                'descripcion' => $this->request->getVar('descripcion')
            ];

            $categoria->save($data);

            session()->setFlashdata('success', 'Categoria guardada correctamente');

            return redirect()->to('crearCategoria');
        }
    }

    // ADMINISTRACION DE CONSULTAS --------------
    public function tablaConsultas()
    {
        $consultasModel = new ConsultasModel();

        $page = (int) ($this->request->getVar('page_num') ?? -1);
        $perPage = 15; // Número de elementos por página

        $data = [
            'titulo' => 'Consultas',
            'descripcion' => 'Consultas de los usuarios registrados en la tienda.',
            'consultas' => array_reverse($consultasModel->paginarConsultas($perPage, $page)),
            'pager' => $consultasModel->pager,
        ];

        echo view('head');
        echo view('nav');
        echo view('Administracion/adminConsultas', $data);
        echo view('footer');
    }

    public function bajaConsulta($id)
    {
        $model = new ConsultasModel();
        $model->baja($id);

        // session()->setFlashdata('success', 'Leido!');
        return redirect()->to('adminConsultas');
    }

    public function altaConsulta($id)
    {
        $model = new ConsultasModel();
        $model->alta($id);

        // session()->setFlashdata('success', 'Reactivado!');
        return redirect()->to('adminConsultas');
    }

    // ADMINISTRACION DE CONTACTOS --------------
    public function tablaContactos()
    {
        $consultasModel = new ConsultasModel();

        $page = (int) ($this->request->getVar('page_num') ?? -1);
        $perPage = 15; // Número de elementos por página

        $data = [
            'titulo' => 'Contactos',
            'descripcion' => 'Mensajes de contacto de visitantes no registrados.',
            'consultas' => array_reverse($consultasModel->paginarContactos($perPage, $page)),
            'pager' => $consultasModel->pager,
        ];

        echo view('head');
        echo view('nav');
        echo view('Administracion/adminConsultas', $data);
        echo view('footer');
    }

    public function bajaContacto($id)
    {
        $model = new ConsultasModel();
        $model->baja($id);

        // session()->setFlashdata('success', 'Leido!');
        return redirect()->to('adminContactos');
    }

    public function altaContacto($id)
    {
        $model = new ConsultasModel();
        $model->alta($id);

        // session()->setFlashdata('success', 'Reactivado!');
        return redirect()->to('adminContactos');
    }

    public function gestionCompras()
    {
        $detallesModel = new DetalleFacturasModel();
        $facturasModel = new FacturasModel();
        $categoriasModel = new CategoriasModel();

        $periodo = $this->request->getVar('periodo');
        switch ($periodo) {
            case 1:
                $facturas = $facturasModel->facturasUltimoMes();
                break;
            case 6:
                $facturas = $facturasModel->facturasUltimosSeisMeses();
                break;
            case 12:
                $facturas = $facturasModel->facturasUltimoAnio();
                break;
            default:
                $facturas = $facturasModel->findAll();
                break;
        }

        if (count($facturas) == 0) {
            $data = [
                'productos' => [],
                'cantidad_compras' => 0,
                'ventas_total' => 0,
                'categorias' => 0,
            ];
        } else {
            $data = [
                'productos' => $detallesModel->productosCantidad($facturas),
                'cantidad_compras' => $facturasModel->cantidadComprasPorFacturas($facturas),
                'ventas_total' => $detallesModel->ventasTotalPorFacturas($facturas),
                'categorias' => $categoriasModel->findAll(),
            ];
        }

        echo view('head');
        echo view('nav');
        echo view('Administracion/adminCompras', $data);
        echo view('footer');
    }

}
