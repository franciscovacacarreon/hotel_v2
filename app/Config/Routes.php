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
$base = '';
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

//-------------------------------------rutas habitacion----------------------------------------//
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

//-------------------------------------rutas para recepcionista----------------------------------------//
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

//-------------------------------------rutas para usuario----------------------------------------//
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
$routes->post($base.'/usuario/actualizarPassword', 'Usuario::postActualizarPassword');
$routes->get($base.'/usuario/logout', 'Usuario::getLogout');
//mostrar vista administrador
$routes->get($base.'/administrador', 'Usuario::getAdministrador');
// COMPLETAR LA VISTA PARA CAMBIAR PASSWORD (Hecho)

//-------------------------------------TipoServicio----------------------------------------//
//mostrar
$routes->get($base.'/tiposervicio', 'TipoServicio::getIndex');
//crear
$routes->get($base.'/tiposervicio/crear', 'TipoServicio::getCrear'); 
$routes->post($base.'/tiposervicio/insertar', 'TipoServicio::postInsertar');
//editar
$routes->get($base.'/tiposervicio/editar/(:num)', 'TipoServicio::getEditar/$1');
$routes->post($base.'/tiposervicio/actualizar', 'TipoServicio::postActualizar');
//eliminar
$routes->get($base.'/tiposervicio/eliminados', 'TipoServicio::getEliminados');
$routes->get($base.'/tiposervicio/eliminar/(:num)', 'TipoServicio::getEliminar/$1');
$routes->get($base.'/tiposervicio/restaurar/(:num)', 'TipoServicio::getRestaurar/$1');

//-------------------------------------Servicio----------------------------------------//
$routes->get($base.'/servicio', 'Servicio::getIndex');
//crear
$routes->get($base.'/servicio/crear', 'Servicio::getCrear'); 
$routes->post($base.'/servicio/insertar', 'Servicio::postInsertar');
//editar
$routes->get($base.'/servicio/editar/(:num)', 'Servicio::getEditar/$1');
$routes->post($base.'/servicio/actualizar', 'Servicio::postActualizar');
//eliminar
$routes->get($base.'/servicio/eliminados', 'Servicio::getEliminados');
$routes->get($base.'/servicio/eliminar/(:num)', 'Servicio::getEliminar/$1');
$routes->get($base.'/servicio/restaurar/(:num)', 'Servicio::getRestaurar/$1');

//-------------------------------------Cliente----------------------------------------//
$routes->get($base.'/cliente', 'Cliente::getIndex');
//crear
$routes->get($base.'/cliente/crear', 'Cliente::getCrear'); 
$routes->post($base.'/cliente/insertar', 'Cliente::postInsertar');
//editar
$routes->get($base.'/cliente/editar/(:num)', 'Cliente::getEditar/$1');
$routes->post($base.'/cliente/actualizar', 'Cliente::postActualizar');
//eliminar
$routes->get($base.'/cliente/eliminados', 'Cliente::getEliminados');
$routes->get($base.'/cliente/eliminar/(:num)', 'Cliente::getEliminar/$1');
$routes->get($base.'/cliente/restaurar/(:num)', 'Cliente::getRestaurar/$1');

//-------------------------------------Nota de servicio----------------------------------------//
//mostrar
$routes->get($base.'/notaservicio', 'notaservicio::getIndex');
//crear
$routes->get($base.'/notaservicio/crear', 'NotaServicio::getCrear'); 
$routes->post($base.'/notaservicio/guarda', 'NotaServicio::postGuarda');

//servcio, mostrar por id
$routes->get($base.'/servicio/buscarPorId/(:num)', 'Servicio::getBuscarPorId/$1');

//TemporalServicio
$routes->get($base.'/temporalservicio/insertar/(:num)/(:num)/(:alphanum)/(:num)/(:num)', 
                        'TemporalServicio::getInsertar/$1/$2/$3/$4/$5');

//temporalservicio, eliminar
$routes->get($base.'/temporalservicio/eliminar/(:num)/(:alphanum)', 'TemporalServicio::getEliminar/$1/$2');

//Rutas para el pdf
//muestra el pdf
$routes->get($base.'/notaservicio/muestraNotaServicioPdf/(:num)', 'NotaServicio::getMuestraNotaServicioPdf/$1');
//generar el pdf
$routes->get($base.'/notaservicio/generaNotaServicioPdf/(:num)', 'NotaServicio::getGeneraNotaServicioPdf/$1');


//-------------------------------------Configuracion----------------------------------------//
//mostrar
$routes->get($base.'/configuracion', 'Configuracion::getIndex'); 
//actualizar
$routes->post($base.'/configuracion/actualizar', 'Configuracion::postActualizar');

//-------------------------------------Hospedaje----------------------------------------//
//Crear 
$routes->get($base.'/notahospedaje', 'NotaHospedaje::getIndex'); 
$routes->get($base.'/notahospedaje/crear', 'NotaHospedaje::getCrear');
$routes->post($base.'/notahospedaje/guarda', 'NotaHospedaje::postGuarda');

//habitacion, buscar por id
$routes->get($base.'/habitacion/buscarPorId/(:num)', 'Habitacion::getBuscarPorId/$1'); 

//cliente, buscar por id
$routes->get($base.'/cliente/buscarPorId/(:num)', 'Cliente::getBuscarPorId/$1'); 

//finalizar hospedaje
$routes->get($base.'/notahospedaje/finalizarHospedaje/(:num)', 'NotaHospedaje::getFinalizarHospedaje/$1'); 

//temporal, insertar
$routes->get($base.'/temporalhospedaje/insertar/(:num)/(:num)/(:alphanum)/(:num)/(:alphanum)', 
                        'TemporalHospedaje::getInsertar/$1/$2/$3/$4/$5');
//temporal, eliminar
$routes->get($base.'/temporalhospedaje/eliminar/(:num)/(:alphanum)', 'TemporalHospedaje::getEliminar/$1/$2');

//rutas para el pdf
//muestra el pdf
$routes->get($base.'/notahospedaje/muestraNotaHospedajePdf/(:num)', 'NotaHospedaje::getMuestraNotaHospedajePdf/$1');
$routes->get($base.'/notahospedaje/generaNotaHospedajePdf/(:num)', 'NotaHospedaje::getGeneraNotaHospedajePdf/$1');

//-------------------------------------Reportes----------------------------------------//
$routes->get($base.'/reporte', 'Reporte::getIndex');
$routes->get($base.'/reporte/servicio', 'Reporte::getIndexServicio');
//hospedaje
$routes->post($base.'/reporte/muestraReporteHospedajePdf', 'Reporte::postMuestraReporteHospedajePdf');
$routes->get($base.'/reporte/generaReporteHospedajePdf/(:any)/(:any)', 'Reporte::getGeneraReporteHospedajePdf/$1/$2');
//hospedaje, estadisticas
$routes->get($base.'/reporte/datosReportePorHospedajeMes/(:any)/(:any)', 'Reporte::getReportePorHospedajeMes/$1/$2');
$routes->get($base.'/reporte/datosReportePorHospedajeSemana/(:any)/(:any)', 'Reporte::getReportePorHospedajeSemana/$1/$2');
//servicios
$routes->post($base.'/reporte/muestraReporteServicioPdf', 'Reporte::postMuestraReporteServicioPdf');
$routes->get($base.'/reporte/generaReporteServicioPdf/(:any)/(:any)', 'Reporte::getGeneraReporteServicioPdf/$1/$2');
//habitaciones
$routes->post($base.'/reporte/muestraReporteHabitacionPdf', 'Reporte::postMuestraReporteHabitacionPdf');
$routes->get($base.'/reporte/generaReporteHabitacionPdf/(:any)/(:any)', 'Reporte::getGeneraReporteHabitacionPdf/$1/$2');
//habitaciones, estadisticas
$routes->get($base.'/reporte/datosReporteHabitacionTotalMes/(:any)/(:any)', 'Reporte::getDatosReporteHabitacionTotalMes/$1/$2');
$routes->get($base.'/reporte/datosReportePorCategoria/(:any)/(:any)', 'Reporte::getReportePorCategoria/$1/$2');



//verificar
$routes->get($base.'/reporte/graficaServicio', 'Reporte::getGraficaServicio');

//-------------------------------------Reservas----------------------------------------//
//crear
$routes->get($base.'/reserva', 'Reserva::getIndex');
$routes->get($base.'/reserva/crear', 'Reserva::getCrear');
$routes->post($base.'/reserva/guarda', 'Reserva::postGuarda');

//temporal, insertar
$routes->get($base.'/temporalreserva/insertar/(:num)/(:num)/(:alphanum)/(:num)/(:alphanum)', 
                        'TemporalReserva::getInsertar/$1/$2/$3/$4/$5');

//temporal, eliminar
$routes->get($base.'/temporalreserva/eliminar/(:num)/(:alphanum)', 'TemporalReserva::getEliminar/$1/$2');

//-------------------------------------Recepcion----------------------------------------//
$routes->get($base.'/recepcion', 'Recepcion::getIndex');
//finalizar hospedaje
$routes->get($base.'/recepcion/finalizarHospedaje/(:num)', 'Recepcion::getFinalizarHospedaje/$1'); 


//-------------------------------------Roles----------------------------------------//
//Crear
$routes->get($base.'/rol', 'Rol::getIndex');
$routes->post($base.'/rol/insertar', 'Rol::postInsertar');
//editar
$routes->get($base.'/rol/editar/(:num)', 'Rol::getEditar/$1');
$routes->post($base.'/rol/actualizar', 'Rol::postActualizar');
//detalle de los permisos
$routes->get($base.'/rol/detalle/(:num)', 'Rol::getDetalle/$1');
$routes->post($base.'/rol/guardaPermiso', 'Rol::postGuardaPermiso');

//-------------------------------------Permisos----------------------------------------//
//crear
$routes->get($base.'/permiso', 'Permiso::getIndex');
$routes->post($base.'/permiso/insertar', 'Permiso::postInsertar');
//editar
$routes->get($base.'/permiso/actualizar/(:num)/(:any)/(:num)/(:num)', 'Permiso::getActualizar/$1/$2/$3/$4');
$routes->get($base.'/permiso/actualizarNombre/(:num)/(:any)', 'Permiso::getActualizarNombre/$1/$2');
$routes->get($base.'/permiso/actualizarTipoPermiso/(:num)/(:num)', 'Permiso::getActualizarIDTipoPermiso/$1/$2');
$routes->get($base.'/permiso/actualizarSubmodulo/(:num)/(:num)', 'Permiso::getActualizarIDSubmodulo/$1/$2');


//-------------------------------------Submodulos----------------------------------------//
//mostrar
$routes->get($base.'/submodulo', 'Submodulo::getIndex');
$routes->get($base.'/submodulo/indexJSON', 'Submodulo::getIndexJSON');
//Crear
$routes->post($base.'/submodulo/insertar', 'Submodulo::postInsertar');

// $routes->get($base.'/permiso/tipoPermisoJSON', 'Permiso::getTipoPermisoJSON');
// $routes->get($base.'/permiso/moduloJSON', 'Permiso::getModuloJSON');

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
