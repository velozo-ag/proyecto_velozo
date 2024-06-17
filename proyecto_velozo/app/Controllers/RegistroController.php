<?php 
namespace App\Controllers;
use CodeIgniter\Controller;
use App\Models\UsuariosModel;
use CodeIgniter\Validation\Exceptions\ValidationException;

class RegistroController extends Controller{

    public function __construct(){
        helper(['form', 'url']);
    }

    public function create(){   
        echo view('head');
        echo view('nav');
        echo view('registro');
        echo view('footer');
    }

    public function nuevoUsuario(){

        $input = $this->validate([
            'nombre' => 'required|min_length[3]|regex_match[/^[a-zA-Z]+$/]',
            'apellido' => 'required|min_length[3]|max_length[25]|regex_match[/^[a-zA-Z]+$/]',
            'usuario' => 'required|min_length[3]|is_unique[usuarios.usuario]',
            'email' => 'required|min_length[4]|max_length[100]|valid_email|is_unique[usuarios.email]',
            'pass' => 'required|min_length[6]|max_length[20]'
            // 'pass' => 'required'
            // 'pass' => 'required|min_length[6]|max_length[20]|regex_match[/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d).+$/]'
        ]);

        $formModel = new UsuariosModel();

        if(!$input){
            echo view('head');
            echo view('nav');
            echo view('registro');
            echo view('footer');
        }else {
            
            //si la validacion es exitosa, se almacenan los datos  y se guarda en la bd
            $formData = [
                'nombre' => $this->request->getVar('nombre'),
                'apellido' => $this->request->getVar('apellido'),
                'usuario' => $this->request->getVar('usuario'),
                'email' => $this->request->getVar('email'),
                'pass' => password_hash($this->request->getVar('pass'), PASSWORD_DEFAULT),
            ];

            $formModel->save($formData);

            session()->setFlashdata('success', 'Usuario registrado con éxito!');
            
            return redirect()->to(site_url('/registro'));
        }
    }
}