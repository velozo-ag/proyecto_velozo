<?php
namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\UsuariosModel;

class LoginController extends Controller
{

    public function login()
    {
        helper(['form', 'url']);

        echo view('head');
        echo view('nav');
        echo view('login');
        echo view('footer');
    }

    public function auth()
    {
        $session = session();
        $model = new UsuariosModel();

        $email = $this->request->getVar('email');
        $password = $this->request->getVar('pass');

        // Consulta en db segun email
        $data = $model->where('email', $email)->first();

        // Si se encuentra el usuario
        if (!$data) {

            $session->setFlashdata('fail', 'El usuario no se encuentra registrado');
            return redirect()->to('/login');

        }

        $pass = $data['pass'];
        $baja = $data['baja'];

        if ($baja) {
            $session->setFlashdata('fail', 'Usuario dado de baja');
            return redirect()->to('/login');
        }

        $verify_pass = password_verify($password, $pass);

        // Si la contrasenia es correcta
        if ($verify_pass) {
            $user = [
                'id_usuario' => $data['id_usuario'],
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'email' => $data['email'],
                'usuario' => $data['usuario'],
                'perfil_id' => $data['perfil_id'],
                'logged_in' => TRUE,
            ];

            $session->set($user);
            session()->setFlashdata('success', 'Bienvenido!');

        } else {

            $session->setFlashdata('fail', 'Usuario o contraseña incorrecta');
            return redirect()->to('/login');
        }


        if($data['perfil_id'] == 2){
            return redirect()->to(base_url(''));
        }else{
            return redirect()->to('/panelAdmin');
        }



    }

    public function logout()
    {
        $session = session();
        $session->destroy();
        return redirect()->to(base_url(''));
    }
}