<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/login', 'UserController::login');
$routes->post('/login', 'UserController::doLogin');
$routes->get('/register', 'UserController::register');
$routes->post('/register', 'UserController::doRegister');
$routes->get('/logout', 'UserController::logout');
$routes->get('/transactions', 'TransactionController::index');
$routes->get('/transactions/create', 'TransactionController::create');
$routes->post('/transactions/store', 'TransactionController::store');
$routes->get('/reports', 'ReportController::index');
$routes->get('/reports/export-pdf', 'ReportController::exportPdf');
