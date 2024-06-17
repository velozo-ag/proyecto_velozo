<?php
namespace App\Models;
use CodeIgniter\Model;

class UsuariosModel extends Model{
    protected $table = 'usuarios';
    protected $primaryKey = 'id_usuario';
    protected $allowedFields = ['nombre', 'apellido', 'email', 'usuario', 'pass', 'perfil_id', 'baja', 'created_at'];

    public function listarUsuarios(){
        return $this->findAll();
    }

    public function listarActivos(){
        return $this->where('baja', 0)->findAll();
    }

    public function listarInactivos(){
        return $this->where('baja', 1)->findAll();
    }

    public function buscarUsuario($id){
        return $this->find($id);
    }

    public function bajaUsuario($id){
        return $this->update($id, ['baja' => 1]);
    }

    public function altaUsuario($id){
        return $this->update($id, ['baja' => 0]);
    }

    public function paginarUsuarios($perPage, $page)
    {
        return $this->paginate($perPage, 'num', $page);
    }

    public function paginarUsuariosActivos($perPage, $page)
    {
        return $this->where('baja', 0)
                    ->paginate($perPage, 'num', $page);
    }

    public function paginarUsuariosInactivos($perPage, $page)
    {
        return $this->where('baja', 1)
                    ->paginate($perPage, 'num', $page);
    }
}