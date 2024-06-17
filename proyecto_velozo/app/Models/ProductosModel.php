<?php
namespace App\Models;

use CodeIgniter\Model;

class ProductosModel extends Model
{

    protected $table = 'productos';
    protected $primaryKey = 'id_producto';
    protected $allowedFields = ['nombre', 'imagen', 'categoria_id', 'precio', 'precio_venta', 'stock', 'stock_minimo', 'activo'];

    public function listarProductos()
    {
        return $this->findAll();
    }

    public function listarProductosActivos()
    {
        return $this->where('activo', 1)->findAll();
    }

    public function paginarProductos($perPage, $page)
    {
        return $this->where('activo', 1)
                    ->paginate($perPage, 'num', $page);
    }
    
    public function paginarProductosPorCategoria($idCategoria, $perPage, $page)
    {
        return $this->where('activo', 1)
                    ->where('categoria_id', $idCategoria)
                    ->paginate($perPage, 'num', $page);
    }

    public function paginarProductosActivos($perPage, $page)
    {
        return $this->where('activo', 1)
                    ->paginate($perPage, 'num', $page);
    }

    public function paginarProductosInactivos($perPage, $page)
    {
        return $this->where('activo', 0)
                    ->paginate($perPage, 'num', $page);
    }

    public function paginarTotalProductos($perPage, $page)
    {
        return $this->paginate($perPage, 'num', $page);
    }

    public function listarProductosInactivos()
    {
        return $this->where('activo', 0)->findAll();
    }

    public function buscarProducto($id)
    {
        return $this->find($id);
    }

    public function altaProducto($id)
    {
        return $this->update($id, ['activo' => 1]);
    }

    public function bajaProducto($id)
    {
        return $this->update($id, ['activo' => 0]);
    }

    public function actualizarProducto($id, $data)
    {
        return $this->doUpdate($id, $data);
    }

    public function verificarCantidad($id, $cantidad)
    {
        return $this->find($id)['stock'] >= $cantidad;
    }

    public function reducirStock($id, $cantidad)
    {
        $nuevoStock = $this->find($id)['stock'] - $cantidad;

        if ($nuevoStock >= 1) {
            $this->update($id, ['stock' => $nuevoStock]);
        } else {
            return $this->update($id, [
                'stock' => $nuevoStock,
                'activo' => 0,
            ]);

        };
    }

}