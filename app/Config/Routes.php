<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('home', 'Home::index');
$routes->get('about', 'About::index');
$routes->get('services', 'Services::index');

$routes->match(['get', 'post'], 'contact', 'Contact::index');

$routes->get('register', 'Register::index');
$routes->post('register', 'Register::create');

$routes->get('login', 'Auth::index');
$routes->post('login', 'Auth::login');
$routes->post('logout', 'Auth::logout', ['filter' => 'auth']);

$routes->group('', ['filter' => 'auth'], static function ($routes) {
    $routes->get('dashboard', 'Accounts::index');

    $routes->get('accounts', 'Accounts::index');
    $routes->get('accounts/new', 'Accounts::newAccount');
    $routes->post('accounts', 'Accounts::create');
    $routes->get('accounts/(:num)/edit', 'Accounts::edit/$1');
    $routes->post('accounts/(:num)/update', 'Accounts::update/$1');
    $routes->post('accounts/(:num)/delete', 'Accounts::delete/$1');
    $routes->get('accounts/(:num)', 'Accounts::viewAccount/$1');
});
