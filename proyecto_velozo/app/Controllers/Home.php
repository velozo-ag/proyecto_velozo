<?php

namespace App\Controllers;
use App\Models\ProductosModel;

class Home extends BaseController
{
    public function index()
    {
        $productosModel = new ProductosModel();

        $productosPrincipales = array();
        $productosPrincipales[] = $productosModel->find(1);
        $productosPrincipales[] = $productosModel->find(2);
        $productosPrincipales[] = $productosModel->find(3);
        $productosPrincipales[] = $productosModel->find(4);

        echo view('head');
        echo view('nav');
        echo view('principal', ['productos' => $productosPrincipales]);
        echo view('footer');
    }
    
    public function quienes_somos()
    {
        echo view('head');
        echo view('nav');
        echo view('quienes-somos');
        echo view('footer');
    }
    
    public function comercializacion()
    {
        echo view('head');
        echo view('nav');
        echo view('comercializacion');
        echo view('footer');
    }

    public function terminos_usos()
    {
        echo view('head');
        echo view('nav');
        echo view('terminos-usos');
        echo view('footer');
    }
    
    public function adminDashboard(){
        echo view('head');
        echo view('nav');
        echo view('Administracion/adminDashboard');
        echo view('footer');
    }
    
}
