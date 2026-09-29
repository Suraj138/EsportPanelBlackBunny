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
$routes->get('dbg', 'Auth::index');
$routes->get('logout', 'Auth::logout');
$routes->get('dashboard', 'User::index');
$routes->match(['get', 'post'], '/', 'Auth::login');
$routes->match(['get', 'post'], 'login', 'Auth::login');
$routes->match(['get', 'post'], 'register', 'Auth::register'); // Server

$routes->match(['get', 'post'], 'settings', 'User::settings');
$routes->match(['get', 'post'], 'Server', 'User::Server');
$routes->match(['get', 'post'], 'store', 'User::lib');
$routes->match(['get', 'post'], 'lib', 'User::lib');
$routes->match(['get', 'post'], 'recover', 'Auth::recover');
$routes->match(['get', 'post'], 'recover/reset/(:segment)', 'Auth::recoverReset/$1');
$routes->match(['get', 'post'], 'search', 'User::search');
$routes->get('audit', 'User::audit');
$routes->get('shop', 'Shop::index');
$routes->get('shop/legal/(:segment)', 'Shop::legal/$1');
$routes->get('shop/buy/(:num)', 'Shop::buy/$1');
$routes->post('shop/order', 'Shop::order');
$routes->get('shop/thanks/(:num)', 'Shop::thanks/$1');
$routes->match(['get', 'post'], 'public-control', 'Shop::control');
$routes->get('keys/share/(:segment)', 'Keys::share/$1');

// Testing
$routes->match(['get', 'post'], 'New', 'Home::index');

/* --------------------------- Keys Grouping -------------------------- */
$routes->group('keys', function ($routes) {
	$routes->match(['get', 'post'], '/', 'Keys::index');
	$routes->match(['get', 'post'], 'generate', 'Keys::generate');
	$routes->match(['get', 'post'], 'deleteUnused', 'Keys::deleteUnused');
	$routes->match(['get', 'post'], 'deleteExp', 'Keys::deleteExpired');
	$routes->match(['get', 'post'], 'deleteAll', 'Keys::deleteAll'); // <-- Added Delete All Route
	$routes->get('(:num)', 'Keys::edit_key/$1');
	$routes->get('reset', 'Keys::api_key_reset');
	$routes->post('edit', 'Keys::edit_key');
	$routes->match(['get', 'post'], 'api', 'Keys::api_get_keys');
	$routes->match(['get', 'post'], 'resetAll', 'Keys::resetAllKeys');
});

/* --------------------------- Admin Grouping -------------------------- */
$routes->group('admin', ['filter' => 'admin'], function ($routes) {
	$routes->match(['get', 'post'], 'create-referral', 'User::ref_index');
	$routes->match(['get', 'post'], 'manage-users', 'User::manage_users');
	$routes->match(['get', 'post'], 'user/(:num)', 'User::user_edit/$1');
	
	/* --------------------------- Admin API Grouping -------------------------- */
	$routes->group('api', function ($routes) {
		$routes->match(['get', 'post'], 'users', 'User::api_get_users');
	});
});

$routes->match(['get', 'post'], 'connect', 'Connect::index');

/*
 * --------------------------------------------------------------------
 * Additional Routing
 * --------------------------------------------------------------------
 */
if (file_exists(APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php')) {
	require APPPATH . 'Config/' . ENVIRONMENT . '/Routes.php';
}