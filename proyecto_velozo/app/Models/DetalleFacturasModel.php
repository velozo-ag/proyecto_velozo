<?php
namespace App\Models;

use CodeIgniter\Model;

class DetalleFacturasModel extends Model
{

    protected $table = 'detalle_factura';
    protected $allowedFields = ['factura_id', 'producto_id', 'cantidad', 'total_producto'];

    public function detallesPorFactura($factura_id)
    {
        return $this->where('factura_id', $factura_id)->findAll();
    }

    public function cantidadPorProducto($producto_id, $factura_id)
    {
        $builder = $this->db->table($this->table); // obtiene tabla
        $builder->selectSum('cantidad'); // suma de la columa 'total_producto'
        $builder->where('producto_id', $producto_id); // donde el producto_id sea el indicado
        $builder->where('factura_id', $factura_id); // donde el factura_id sea el indicado
        $query = $builder->get();

        return (int) $query->getRow()->cantidad;
    }

    public function cantidadTotal()
    {
        $builder = $this->db->table($this->table); // obtiene tabla
        $builder->selectSum('cantidad'); // suma de la columa 'total_producto'
        $query = $builder->get();

        return (int) $query->getRow()->cantidad;
    }

    public function ventasPorProducto($producto_id, $factura_id)
    {
        // Construye query sql / consulta sql
        $builder = $this->db->table($this->table); // obtiene tabla
        $builder->selectSum('total_producto'); // suma de la columa 'total_producto'
        $builder->where('producto_id', $producto_id); // donde el producto_id sea el indicado
        $builder->where('factura_id', $factura_id); // donde el factura_id sea el indicado
        $query = $builder->get();

        // Retornar la suma obtenida como float
        // return (float) $query->getRow()->total_producto;
        return number_format((float) $query->getRow()->total_producto, 2, '.', '');
    }

    public function ventasTotal()
    {
        // Construye query sql / consulta sql
        $builder = $this->db->table($this->table); // obtiene tabla
        $builder->selectSum('total_producto'); // suma de la columa 'total_producto'
        $query = $builder->get();

        // Retornar la suma obtenida como float
        // return (float) $query->getRow()->total_producto;
        return number_format((float) $query->getRow()->total_producto, 2, '.', '');
    }

    public function ventasTotalPorFacturas($facturas)
    {
        // Recorre el array $facturas y almacena solo sus ids
        $factura_ids = array_map(function($factura) {
            return $factura['id_factura'];
        }, $facturas);

        // Construye query sql / consulta sql
        $builder = $this->db->table($this->table); // obtiene tabla
        $builder->selectSum('total_producto'); // suma de la columa 'total_producto'
        $builder->whereIn('factura_id', $factura_ids); // Filtrar por los IDs de las facturas

        $query = $builder->get();

        // Retornar la suma obtenida como float
        // return (float) $query->getRow()->total_producto;
        return number_format((float) $query->getRow()->total_producto, 2, '.', '');
    }

    
    public function productosCantidad($facturas)
    {

        $productosModel = new ProductosModel();

        $listaProductos = $productosModel->findAll();

        $productos = array();

        foreach ($facturas as $factura) {
            foreach ($listaProductos as $producto) {

                $id_producto = $producto['id_producto'];
                
                if(!isset($productos[$id_producto])){
                    $productos[$id_producto] = [
                        'nombre' => $producto['nombre'],
                        'categoria_id' => $producto['categoria_id'],
                        'total_ventas' => 0,
                        'total' => 0,
                    ];
                }

                $productos[$id_producto]['total_ventas'] += $this->cantidadPorProducto($id_producto, $factura['id_factura']);
                
                $productos[$id_producto]['total'] += $this->ventasPorProducto($id_producto, $factura['id_factura']);
            }
        }

        usort($productos, function($a, $b) {
            return $b['total_ventas'] <=> $a['total_ventas'];
        });

        return $productos;
    }

}