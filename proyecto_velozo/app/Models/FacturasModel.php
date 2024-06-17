<?php
namespace App\Models;

use CodeIgniter\Model;
use App\Models\DetalleFacturasModel;

class FacturasModel extends Model
{
    protected $table = 'factura';
    protected $primaryKey = 'id_factura';
    protected $allowedFields = ['usuario_id', 'fecha_venta', 'total_venta'];

    public function detallesFactura($id_factura)
    {
        $detalles = new DetalleFacturasModel();
        return $detalles->detallesPorFactura($id_factura);
    }

    public function facturasPorUsuario($id_usuario)
    {
        return $this->where('usuario_id', $id_usuario)->findAll();
    }

    public function cantidadCompras()
    {
        return count($this->findAll());
    }

    public function cantidadComprasPorFacturas($facturas)
    {
        return count($facturas);
    }

    public function facturasUltimoMes()
    {
        $fecha_actual = date('y-m-d');
        $fecha_limite = date('y-m-d', strtotime('-1 months'));

        $facturas = $this->where('fecha_venta <=', $fecha_actual)
        ->where('fecha_venta >=', $fecha_limite)
        ->findAll();

        return $facturas;
    }

    public function facturasUltimosSeisMeses()
    {
        $fecha_actual = date('y-m-d');
        $fecha_limite = date('y-m-d', strtotime('-6 months'));

        $facturas = $this->where('fecha_venta <=', $fecha_actual)
        ->where('fecha_venta >=', $fecha_limite)
        ->findAll();

        return $facturas;
    }

    public function facturasUltimoAnio()
    {
        $fecha_actual = date('y-m-d');
        $fecha_limite = date('y-m-d', strtotime('-1 years'));

        $facturas = $this->where('fecha_venta <=', $fecha_actual)
        ->where('fecha_venta >=', $fecha_limite)
        ->findAll();

        return $facturas;
    }

}