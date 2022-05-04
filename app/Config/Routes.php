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
$routes->setDefaultMethod('home');
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
$routes->get('/', 'Home::home');
$routes->get('/home', 'Home::home');
$routes->get('/dashboard', 'Home::dashboard');

$routes->get('/buat_surat_keluar', 'Home::buat_surat_keluar');

$routes->get('/dokumentasi_surat_keluar', 'Home::dokumentasi_surat_keluar');
$routes->get('/dokumentasi_surat_masuk', 'Home::dokumentasi_surat_masuk');

$routes->get('/data_surat_keluar', 'Home::data_surat_keluar');
$routes->get('/data_surat_masuk', 'Home::data_surat_masuk');

$routes->get('/data_klasifikasi_surat', 'KlasifikasiSuratController::index');
$routes->add('/data_klasifikasi_surat', 'KlasifikasiSuratController::create');
$routes->get('/kelola_klasifikasi_surat', 'KlasifikasiSuratController::kelola_klasifikasi');
$routes->get('/tambah_klasifikasi', 'KlasifikasiSuratController::form_tambah_klasifikasi');

$routes->get('/dokumentasi_surat_lainnya', 'JenisSuratLainnyaController::index');

$routes->get('/data_admin', 'DataPenggunaController::data_admin');
$routes->get('/data_pegawai', 'DataPenggunaController::data_pegawai');



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
