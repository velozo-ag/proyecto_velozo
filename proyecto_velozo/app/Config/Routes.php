<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
// The Auto Routing (Legacy) is very dangerous. It is easy to create vulnerable apps
// where controller filters or CSRF protection are bypassed.
// If you don't want to define all routes, please use the Auto Routing (Improved).
// Set `$autoRoutesImproved` to true in `app/Config/Feature.php` and set the following to true.
// $routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::index');
$routes->get('quienes-somos', 'Home::quienes_somos');
$routes->get('comercializacion', 'Home::comercializacion');
$routes->get('terminos-usos', 'Home::terminos_usos');

$routes->get('panelAdmin', 'Home::adminDashboard', ['filter' => 'adminRequired']);

$routes->get('registro', 'RegistroController::create', ['filter' => 'alreadyLogged']);
$routes->post('/RegistroController/nuevoUsuario', 'RegistroController::nuevoUsuario', ['filter' => 'alreadyLogged']);

$routes->get('login', 'LoginController::login', ['filter' => 'alreadyLogged']);
$routes->post('/LoginController/auth', 'LoginController::auth', ['filter' => 'alreadyLogged']);
$routes->get('LoginController/logout', 'LoginController::logout', ['filter' => 'loginRequired']);

$routes->get('contacto', 'ConsultaController::contacto', ['filter' => 'alreadyLogged']);
$routes->post('/ConsultaController/enviarContacto', 'ConsultaController::enviarContacto', ['filter' => 'alreadyLogged']);

$routes->get('consulta', 'ConsultaController::consulta', ['filter' => 'loginRequired']);
$routes->post('/ConsultaController/enviarConsulta', 'ConsultaController::enviarConsulta', ['filter' => 'loginRequired']);

$routes->get('catalogo', 'CatalogoController::catalogo');
$routes->get('catalogoFiltrado', 'CatalogoController::catalogoFiltrado');

// ADMINISTRACION USUARIOS
$routes->get('adminUsuarios', 'AdminController::tablaUsuarios', ['filter' => 'adminRequired']);
$routes->get('bajaUsuario/(:num)', 'AdminController::bajaUsuario/$1', ['filter' => 'adminRequired']);
$routes->get('altaUsuario/(:num)', 'AdminController::altaUsuario/$1', ['filter' => 'adminRequired']);

// ADMINISTRACION PRODUCTOS
$routes->get('adminProductos', 'AdminController::tablaProductos', ['filter' => 'adminRequired']);

$routes->get('agregarProducto', 'AdminController::agregarProducto', ['filter' => 'adminRequired']);
$routes->post('nuevoProducto', 'AdminController::nuevoProducto', ['filter' => 'adminRequired']);

$routes->get('modificarProducto/(:num)', 'AdminController::modificarProducto/$1', ['filter' => 'adminRequired']);
$routes->post('editarProducto/(:num)', 'AdminController::editarProducto/$1', ['filter' => 'adminRequired']);

$routes->get('bajaProducto/(:num)', 'AdminController::bajaProducto/$1', ['filter' => 'adminRequired']);
$routes->get('altaProducto/(:num)', 'AdminController::altaProducto/$1', ['filter' => 'adminRequired']);

$routes->get('crearCategoria', 'AdminController::formCategoria', ['filter' => 'adminRequired']);
$routes->post('crearCategoria', 'AdminController::nuevaCategoria', ['filter' => 'adminRequired']);

// ADMINISTRACION CONSULTAS
$routes->get('adminConsultas', 'AdminController::tablaConsultas', ['filter' => 'adminRequired']);
$routes->get('altaConsulta/(:num)', 'AdminController::altaConsulta/$1', ['filter' => 'adminRequired']);
$routes->get('bajaConsulta/(:num)', 'AdminController::bajaConsulta/$1', ['filter' => 'adminRequired']);

$routes->get('adminContactos', 'AdminController::tablaContactos', ['filter' => 'adminRequired']);
$routes->get('altaContacto/(:num)', 'AdminController::altaContacto/$1', ['filter' => 'adminRequired']);
$routes->get('bajaContacto/(:num)', 'AdminController::bajaContacto/$1', ['filter' => 'adminRequired']);

// CARRITO
$routes->get('carrito', 'CarritoController::carrito', ['filter' => 'loginRequired']);
$routes->get('carrito/agregarNuevo/(:num)', 'CarritoController::agregarProductoAlCarrito/$1', ['filter' => 'loginRequired']);
$routes->get('carrito/quitar/(:num)', 'CarritoController::quitarDelCarrito/$1', ['filter' => 'loginRequired']);
$routes->get('carrito/agregar/(:num)', 'CarritoController::agregarEnCarrito/$1', ['filter' => 'loginRequired']);
$routes->get('carrito/remover/(:num)', 'CarritoController::removerProductoCompleto/$1', ['filter' => 'loginRequired']);
$routes->get('carrito/eliminarCarrito', 'CarritoController::removerCarritoCompleto', ['filter' => 'loginRequired']);

// ADMINISTRACION COMPRAS
$routes->get('adminVentas', 'AdminController::gestionCompras', ['filter' => 'adminRequired']);

$routes->get('carrito/finalizarCompra', 'FacturaController::generarFactura', ['filter' => 'loginRequired']);
$routes->get('historialCompras', 'FacturaController::historialCompras', ['filter' => 'loginRequired']);
/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 *
 * There will often be times that you need additional routing and you
 * need it to be able to override any defaults in this file. Environment
 * based routes is one such time. require() additional route files here
 * to make that happen.
 *
 * You will have access to the $routes object within that file without
 * needing to reload it.
 */
if (is_file(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}