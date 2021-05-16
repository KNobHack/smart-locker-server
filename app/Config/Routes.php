<?php

namespace Config;

// Create a new instance of our RouteCollection class.
$routes = Services::routes();

// Load the system's routing file first, so that the app and ENVIRONMENT
// can override as needed.
if (file_exists(SYSTEMPATH . 'Config/Routes.php')) {
	require SYSTEMPATH . 'Config/Routes.php';
}

/**
 * --------------------------------------------------------------------
 * Router Setup
 * --------------------------------------------------------------------
 */
$routes->setDefaultNamespace('App\Controllers');
$routes->setDefaultController('Home');
$routes->setDefaultMethod('index');
$routes->setTranslateURIDashes(false);
$routes->set404Override();
$routes->setAutoRoute(false);

/*
 * --------------------------------------------------------------------
 * Route Definitions
 * --------------------------------------------------------------------
 */

// We get a performance increase by specifying the default
// route since we don't have to scan directories.
$routes->get('/', 'Auth::loginPage');

$routes->group('api', ['namespace' => 'App\Controllers\API'], function ($routes) {
	$routes->get('locker/status/(:alphanum)', 'Locker::checkStatus/$1');
});

$routes->get('login', 'Auth::loginPage', ['as' => 'loginPage']);
$routes->post('login', 'Auth::login', ['as' => 'login']);
$routes->get('logout', 'Auth::logout', ['as' => 'logout']);

$routes->get('signup', 'Auth::registerPage', ['as' => 'registerPage']);
$routes->post('signup', 'Auth::register', ['as' => 'register']);

$routes->get('home', 'Home', ['as' => 'homePage']);

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
