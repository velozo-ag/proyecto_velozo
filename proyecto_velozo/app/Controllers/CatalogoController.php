<?php
namespace App\Controllers;

use App\Models\CategoriasModel;
use App\Models\ProductosModel;
use CodeIgniter\Controller;

class CatalogoController extends Controller
{
    public function __construct()
    {
        helper(['form', 'url']);
    }

    public function catalogo()
    {
        $productosModel = new ProductosModel();
        $categoriasModel = new CategoriasModel();

        $page = (int) ($this->request->getVar('page_num') ?? 1);
        $perPage = 10; // Número de elementos por página

        $data['productos'] = $productosModel->paginarProductos($perPage, $page);

        $data['pager'] = $productosModel->pager;
        $data['categorias'] = $categoriasModel->findAll();
        $data['seleccionado'] = null;

        echo view('head');
        echo view('nav');
        echo view('catalogo', $data);
        echo view('footer');
    }

    public function catalogoFiltrado()
    {

        $productosModel = new ProductosModel();
        $categoriasModel = new CategoriasModel();
        $idCategoria = $this->request->getVar('categoria_id');

        $page = (int) ($this->request->getVar('page_num') ?? 1);
        $perPage = 10; // Número de elementos por página

        if ($idCategoria == -1) {
            $data = [
                'productos' => $productosModel->paginarProductos($perPage, $page),
                'seleccionado' => null,
            ];
        } else {
            $data = [
                'productos' => $productosModel->paginarProductosPorCategoria($idCategoria, $perPage, $page),
                'seleccionado' => $idCategoria,
            ];
        }
        ;

        $data['pager'] = $productosModel->pager;
        $data['categorias'] = $categoriasModel->findAll();

        echo view('head');
        echo view('nav');
        echo view('catalogo', $data);
        echo view('footer');

    }
}