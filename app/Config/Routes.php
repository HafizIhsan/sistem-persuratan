<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
    require SYSTEMPATH . 'Config/Routes.php';
}

/*
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('dashboard');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(true);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Home::dashboard');
$routes->get('/dashboard', 'Home::dashboard');
$routes->get('/buat_surat_keluar', 'Home::buat_surat_keluar');
$routes->get('/dokumentasi_surat_keluar', 'Home::dokumentasi_surat_keluar');
$routes->get('/dokumentasi_surat_masuk', 'Home::dokumentasi_surat_masuk');
$routes->get('/dokumentasi_nota_kesepahaman', 'Home::dokumentasi_nota_kesepahaman');
$routes->get('/dokumentasi_berita_acara', 'Home::dokumentasi_berita_acara');
$routes->get('/dokumentasi_perjanjian_kerjasama', 'Home::dokumentasi_perjanjian_kerjasama');

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
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
    require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}
