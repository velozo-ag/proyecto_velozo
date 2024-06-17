<?php
namespace App\Models;
use CodeIgniter\Model;

class ConsultasModel extends Model{
    protected $table = 'consultas';
    protected $primaryKey = 'id_consulta';
    protected $allowedFields = ['usuario_id', 'nombre', 'apellido', 'email', 'mensaje', 'activo'];

    public function consultasActivas(){
        return $this->where('activo', 1)->where('usuario_id IS NOT NULL')->findAll();
    }
    
    public function consultasInactivas(){
        return $this->where('activo', 0)->where('usuario_id IS NOT NULL')->findAll();
    }

    public function contactosActivos(){
        return $this->where('activo', 1)->where('usuario_id', null)->findAll();
    }

    public function contactosInactivos(){
        return $this->where('activo', 0)->where('usuario_id', null)->findAll();
    }

    public function paginarConsultas($perPage, $page)
    {
        return $this->where('usuario_id IS NOT NULL')
                    ->paginate($perPage, 'num', $page);
    }

    public function paginarContactos($perPage, $page)
    {
        return $this->where('usuario_id', null)
                    ->paginate($perPage, 'num', $page);
    }

    public function baja($id){
        return $this->update($id, ['activo' => 0]);
    }
    
    public function alta($id){
        return $this->update($id, ['activo' => 1]);
    }
}