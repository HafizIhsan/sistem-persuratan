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

// Home
$routes->get('/', 'Home::home');
$routes->get('/home', 'Home::home');

// Login
$routes->match(['get', 'post'], 'home', 'UserController::login', ["filter" => "noauth"]);

// Admin routes
$routes->group("admin", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "AdminController::index");
});
$routes->get('/admin', 'AdminController::index');
$routes->get('/dashboard_admin', 'Home::dashboard_admin');

// Pegawai routes
$routes->group("pegawai", ["filter" => "auth"], function ($routes) {
    $routes->get("/", "PegawaiController::index");
});
$routes->get('/pegawai', 'PegawaiController::index');
$routes->get('/dashboard_pegawai', 'Home::dashboard_pegawai');

// Logout
$routes->get('logout', 'UserController::logout');

// Buat Surat Keluar
$routes->get('/buat_surat_keluar', 'BuatSuratKeluarController::index');
$routes->get('/buat_surat_keluar/get', 'BuatSuratKeluarController::getSuratKeluar');
$routes->add('/buat_surat_keluar', 'BuatSuratKeluarController::create');
$routes->get('/buat_surat_keluar_p', 'BuatSuratKeluarController::index_p');

// Dokumentasi Surat Keluar
$routes->get('/dokumentasi_surat_keluar', 'Home::dokumentasi_surat_keluar');
$routes->post('/check-nomor-surat-availability', 'SuratKeluarController::check_nomor_surat_availability');
$routes->add('/dokumentasi_surat_keluar/update_dokumentasi', 'SuratKeluarController::update_dokumentasi');

$routes->get('/dokumentasi_surat_keluar_p', 'Home::dokumentasi_surat_keluar_p');

// Dokumentasi Surat Masuk
$routes->get('/dokumentasi_surat_masuk', 'Home::dokumentasi_surat_masuk');

// Dokumentasi Surat Lainnya
$routes->get('/dokumentasi_surat_lainnya', 'JenisSuratLainnyaController::index');
$routes->add('/dokumentasi_surat_lainnya', 'SuratLainnyaController::create');

// Data Surat
$routes->get('/data_surat_keluar', 'SuratKeluarController::index');
$routes->add('/data_surat_keluar', 'SuratKeluarController::store');
$routes->get('/data_surat_keluar/delete/(:segment)', 'SuratKeluarController::delete/$1');
$routes->add('/data_surat_keluar/edit/(:segment)', 'SuratKeluarController::edit/$1');

$routes->get('/data_surat_masuk', 'SuratMasukController::index');
$routes->add('/data_surat_masuk', 'SuratMasukController::store');
$routes->get('/data_surat_masuk/delete/(:segment)', 'SuratMasukController::delete/$1');
$routes->add('/data_surat_masuk/edit/(:segment)', 'SuratMasukController::edit/$1');

$routes->get('/data_surat_lainnya', 'SuratLainnyaController::index');
$routes->add('/data_surat_lainnya', 'SuratLainnyaController::store');
$routes->get('/data_surat_lainnya/delete/(:segment)', 'SuratLainnyaController::delete/$1');
$routes->add('/data_surat_lainnya/edit/(:segment)', 'SuratLainnyaController::edit/$1');

// Klasifikasi Surat
$routes->get('/data_klasifikasi_surat', 'KlasifikasiSuratController::index');
$routes->add('/data_klasifikasi_surat', 'KlasifikasiSuratController::create');
$routes->add('/data_klasifikasi_surat/edit/(:segment)', 'KlasifikasiSuratController::edit/$1');
$routes->get('/data_klasifikasi_surat/delete/(:segment)', 'KlasifikasiSuratController::delete/$1');

$routes->get('/klasifikasi_surat', 'KlasifikasiSuratController::klasifikasi_surat');

// Pengguna
$routes->get('/data_pengguna', 'DataPenggunaController::index');
// $routes->get('/data_pengguna/get-records', 'DataPenggunaController::getRecords');
$routes->add('/data_pengguna', 'DataPenggunaController::create');
$routes->add('/data_pengguna/edit/(:segment)', 'DataPenggunaController::edit/$1');
$routes->get('/data_pengguna/delete/(:segment)', 'DataPenggunaController::delete/$1');






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
