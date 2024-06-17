<?php

namespace App\Controllers;

use App\Models\ConsultasModel;
use CodeIgniter\Controller;

class ConsultaController extends Controller
{

    public function consulta()
    {
        helper(['form', 'url', 'session']);

        echo view('head');
        echo view('nav');
        echo view('consulta');
        echo view('footer');
    }

    public function contacto()
    {
        helper(['form', 'url']);

        echo view('head');
        echo view('nav');
        echo view('contacto');
        echo view('footer');
    }

    public function enviarConsulta()
    {
        $input = $this->validate([
            'mensaje' => 'required|max_length[255]'
        ]);

        $formModel = new ConsultasModel();

        if (!$input) {
            echo view('head');
            echo view('nav');
            echo view('contacto', ['validation' => $this->validator]);
            echo view('footer');

            $session = session();
            $session->setFlashdata('fail', 'Error al enviar mensaje, intentelo nuevamente');
            return redirect()->to(site_url('/consulta'));

        } else{
            $formData = [
                'usuario_id' => session()->get('id_usuario'),
                'nombre' => session()->get('nombre'),
                'apellido' => session()->get('apellido'),
                'email' => session()->get('email'),
                'mensaje' => $this->request->getVar('mensaje'),
            ];

            $formModel->save($formData);
            $session = session();

            $session->setFlashdata('success', 'Mensaje enviado con exito!');

            return redirect()->to(site_url('/consulta'));
        }
    }

    public function enviarContacto()
    {
        $input = $this->validate([
            'nombre' => 'required|min_length[3]|max_length[30]|regex_match[/^[a-zA-Z]+$/]',
            'apellido' => 'required|min_length[3]|max_length[30]|regex_match[/^[a-zA-Z]+$/]',
            'email' => 'required|valid_email',
            'mensaje' => 'required|max_length[255]'
        ]);

        $formModel = new ConsultasModel();

        if (!$input) {
            echo view('head');
            echo view('nav');
            echo view('contacto', ['validation' => $this->validator]);
            echo view('footer');

            $session = session();
            $session->setFlashdata('fail', 'Error al enviar mensaje, intentelo nuevamente');
            return redirect()->to(site_url('/contacto'));

        } else{
            $formData = [
                'usuario_id' => $this->request->getVar('usuario_id'),
                'nombre' => $this->request->getVar('nombre'),
                'apellido' => $this->request->getVar('apellido'),
                'email' => $this->request->getVar('email'),
                'mensaje' => $this->request->getVar('mensaje'),
            ];

            $formModel->save($formData);
            $session = session();

            $session->setFlashdata('success', 'Mensaje enviado con exito!');

            return redirect()->to(site_url('/contacto'));
        }
    }
}
