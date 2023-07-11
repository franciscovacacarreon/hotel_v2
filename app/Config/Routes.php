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
//$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$base = 'Hotel_v2/public';
$routes->get('/', 'Home::index');
//rutas para categoria
$routes->get($base.'/categoria', 'Categoria::getIndex');
//mostrar e insertar
$routes->get($base.'/categoria/crear', 'Categoria::getCrear');
$routes->post($base.'/categoria/insertar', 'Categoria::postInsertar');
//editar
$routes->get($base.'/categoria/editar/(:num)', 'Categoria::getEditar/$1');
$routes->post($base.'/categoria/actualizar', 'Categoria::postActualizar');
//eliminar
$routes->get($base.'/categoria/eliminados', 'Categoria::getEliminados');
$routes->get($base.'/categoria/eliminar/(:num)', 'Categoria::getEliminar/$1');
//restaurar
$routes->get($base.'/categoria/restaurar/(:num)', 'Categoria::getRestaurar/$1');

//rutas habitacion
$routes->get($base.'/habitacion', 'Habitacion::getIndex');
//crear
$routes->get($base.'/habitacion/crear', 'Habitacion::getCrear');
$routes->post($base.'/habitacion/insertar', 'Habitacion::postInsertar');
//editar
$routes->get($base.'/habitacion/editar/(:num)', 'Habitacion::getEditar/$1');
$routes->post($base.'/habitacion/actualizar', 'Habitacion::postActualizar');
//eliminar
$routes->get($base.'/habitacion/eliminados', 'Habitacion::getEliminados');
$routes->get($base.'/habitacion/eliminar/(:num)', 'Habitacion::getEliminar/$1');
//restaurar
$routes->get($base.'/habitacion/restaurar/(:num)', 'habitacion::getRestaurar/$1');

//rutas recepcionista
$routes->get($base.'/recepcionista', 'Recepcionista::getIndex');
//crear
$routes->get($base.'/recepcionista/crear', 'Recepcionista::getCrear');
$routes->post($base.'/recepcionista/insertar', 'Recepcionista::postInsertar');
//editar
$routes->get($base.'/recepcionista/editar/(:num)', 'Recepcionista::getEditar/$1');
$routes->post($base.'/recepcionista/actualizar', 'Recepcionista::postActualizar');
//eliminar
$routes->get($base.'/recepcionista/eliminados', 'Recepcionista::getEliminados');
$routes->get($base.'/recepcionista/eliminar/(:num)', 'Recepcionista::getEliminar/$1');
//restaurar
$routes->get($base.'/recepcionista/restaurar/(:num)', 'Recepcionista::getRestaurar/$1');

//rutas para usuario
$routes->get($base.'/usuario', 'Usuario::getIndex');
//crear
$routes->get($base.'/usuario/crear', 'Usuario::getCrear');
$routes->post($base.'/usuario/insertar', 'Usuario::postInsertar');
//editar
$routes->get($base.'/usuario/editar/(:num)', 'Usuario::getEditar/$1');
$routes->post($base.'/usuario/actualizar', 'Usuario::postActualizar');
//eliminar
$routes->get($base.'/usuario/eliminados', 'Usuario::getEliminados');
$routes->get($base.'/usuario/eliminar/(:num)', 'Usuario::getEliminar/$1');
//restaurar
$routes->get($base.'/usuario/restaurar/(:num)', 'Usuario::getRestaurar/$1');
//cambiar password
$routes->get($base.'/usuario/cambiaPassword', 'Usuario::getCambiaPassword');
//inicio sesion
$routes->post($base.'/usuario/valida', 'Usuario::postValida');
// COMPLETAR LA VISTA PARA CAMBIAR PASSWORD

//-------------------------------------TipoServicio----------------------------------------//
//mostrar
$routes->get($base.'/tipoServicio', 'TipoServicio::getIndex');
//crear
$routes->get($base.'/tipoServicio/crear', 'TipoServicio::getCrear'); 
$routes->post($base.'/tipoServicio/insertar', 'TipoServicio::postInsertar');
//editar
$routes->get($base.'/tipoServicio/editar/(:num)', 'TipoServicio::getEditar/$1');
$routes->post($base.'/tipoServicio/actualizar', 'TipoServicio::postActualizar');
//eliminar
$routes->get($base.'/tipoServicio/eliminados', 'TipoServicio::getEliminados');
$routes->get($base.'/tipoServicio/eliminar/(:num)', 'TipoServicio::getEliminar/$1');
$routes->get($base.'/tipoServicio/restaurar/(:num)', 'TipoServicio::getRestaurar/$1');

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
