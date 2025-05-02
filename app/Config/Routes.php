<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Page d'accueil -> Connexion
$routes->get('/', 'AuthController::index');

// Connexion
$routes->get('/login', 'Login::index');
$routes->post('/login', 'Login::authenticate');

// Inscription
$routes->get('/register', 'Register::index');
$routes->post('/register/submit', 'Register::submit');

// Dashboard
$routes->get('/dashboard', 'Dashboard::index');

// Réservation
$routes->get('/reservation', 'Reservation::index');
$routes->match(['get', 'post'], '/reservation/recherche', 'Reservation::recherche');
$routes->get('/reservation/submit/(:num)', 'Reservation::submit/$1');
$routes->post('/reservation/confirmer', 'Reservation::confirmer');
$routes->post('/reservation/annuler/(:num)', 'Reservation::annuler/$1');
$routes->get('/reservation/confirmation', 'Reservation::confirmationView');
$routes->post('/reservation/validerReservation', 'Reservation::validerReservation');

// Tests & informations
$routes->get('/testdb', 'TestDb::index');
$routes->get('/test-db', 'TestDb::index');
$routes->get('/info', 'Info::index');

// Déconnexion
$routes->get('/logout', 'AuthController::logout');
