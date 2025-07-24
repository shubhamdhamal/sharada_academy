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

$default_controller = 'Home';

$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController($default_controller);
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(true);
$routes->set404Override('App\Controllers\Assets::error_404');
$routes->setAutoRoute(true);

$routes->add('manifest.json','Assets::manifest');
$routes->add('robots.txt', 'Assets::robots');
$routes->add('sitemap.xml', 'Assets::sitemap');
$routes->add('offline', 'Assets::offline');
$routes->add('service-worker.js', 'Assets::service_worker');
$routes->add('assets/admin/root.css', 'Assets::admin_root_css');
$routes->add('assets/admin/root.js', 'Assets::admin_root_js');
$routes->add('pwa.js', 'Assets::pwa_js');
$controller_exceptions = array('terms-and-conditions','return-refund-and-cancellation-policy','privacy-policy','disclaimer','page','about_us','contact_us','courses','faculty','blog','gallery','enquiry-form','directors_desk','process');

foreach($controller_exceptions as $v) {
    $routes->add(str_replace('_', '-', $v), $default_controller.'::'.$v);
    $routes->add(str_replace('_', '-', $v)."/(:any)", $default_controller.'::'.$v.'/$1');
}

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.

//$routes->get('/', 'Auth::index');

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
