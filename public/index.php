<?php
// public/index.php — Application Entry Point

session_start();

// Autoload core files
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../core/Database.php';
require_once __DIR__ . '/../core/Model.php';
require_once __DIR__ . '/../core/Controller.php';
require_once __DIR__ . '/../core/Router.php';

$router = new Router();

// ============================================================
// PUBLIC ROUTES
// ============================================================
$router->get('/',         'FrontendController', 'home');
$router->get('/login',    'AuthController',     'loginForm');
$router->post('/login',   'AuthController',     'login');
$router->get('/register', 'AuthController',     'registerForm');
$router->post('/register','AuthController',     'register');
$router->get('/logout',   'AuthController',     'logout');

// ============================================================
// FRONTEND USER ROUTES (require login + role=user)
// ============================================================
$router->get('/dashboard',       'FrontendController', 'dashboard');
$router->get('/profile',         'FrontendController', 'profile');
$router->post('/profile/update', 'FrontendController', 'updateProfile');
$router->get('/reports',         'FrontendController', 'reports');
$router->get('/documents',       'FrontendController', 'documents');
$router->get('/calendar',        'FrontendController', 'calendar');
$router->get('/projects',        'FrontendController', 'projects');

// ============================================================
// ADMIN ROUTES — all under /admin (require role=admin)
// ============================================================
$router->get('/admin',                                    'AdminController', 'dashboard');
$router->get('/admin/users',                              'AdminController', 'users');
$router->get('/admin/users/create',                       'AdminController', 'createUserForm');
$router->post('/admin/users/create',                      'AdminController', 'createUser');
$router->get('/admin/users/edit/{id}',                    'AdminController', 'editUserForm');
$router->post('/admin/users/edit/{id}',                   'AdminController', 'editUser');
$router->get('/admin/users/delete/{id}',                  'AdminController', 'deleteUser');
$router->get('/admin/users/permissions/{id}',             'AdminController', 'permissionsForm');
$router->post('/admin/users/permissions/{id}',            'AdminController', 'updatePermissions');

$router->get('/admin/profile',                            'AdminController', 'profile');
$router->post('/admin/profile/update',                    'AdminController', 'updateProfile');

// ============================================================
// DISPATCH
// ============================================================
$uri    = $_SERVER['REQUEST_URI'];
$method = $_SERVER['REQUEST_METHOD'];

$router->dispatch($uri, $method);
