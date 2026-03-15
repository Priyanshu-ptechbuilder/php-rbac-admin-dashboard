<?php
// app/controllers/AuthController.php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../../core/Database.php';
require_once __DIR__ . '/../../core/Model.php';
require_once __DIR__ . '/../models/User.php';

class AuthController extends Controller {

    private $userModel;

    public function __construct() {
        $this->userModel = new User();
    }

    // GET /login
    public function loginForm($params = []) {
        if ($this->isLoggedIn()) {
            if ($this->isAdmin()) {
                $this->redirect(BASE_URL . '/admin');
            } else {
                $this->redirect(BASE_URL . '/dashboard');
            }
        }
        $this->view('auth/login', [], 'auth_layout');
    }

    // POST /login
    public function login($params = []) {
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $error    = '';

        if (empty($email) || empty($password)) {
            $error = 'Please enter email and password.';
        } else {
            $user = $this->userModel->verifyPassword($email, $password);
            if ($user) {
                if ($user['status'] !== 'active') {
                    $error = 'Your account is disabled. Contact admin.';
                } else {
                    $_SESSION['user_id']   = $user['id'];
                    $_SESSION['user_name'] = $user['name'];
                    $_SESSION['email']     = $user['email'];
                    $_SESSION['role']      = $user['role'];

                    if ($user['role'] === 'admin') {
                        $this->redirect(BASE_URL . '/admin');
                    } else {
                        $this->redirect(BASE_URL . '/dashboard');
                    }
                }
            } else {
                $error = 'Invalid email or password.';
            }
        }

        $this->view('auth/login', ['error' => $error], 'auth_layout');
    }

    // GET /register
    public function registerForm($params = []) {
        if ($this->isLoggedIn()) {
            $this->redirect(BASE_URL . '/dashboard');
        }
        $this->view('auth/register', [], 'auth_layout');
    }

    // POST /register
    public function register($params = []) {
        $name     = trim($_POST['name'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $confirm  = trim($_POST['confirm_password'] ?? '');
        $error    = '';
        $success  = '';

        if (empty($name) || empty($email) || empty($password)) {
            $error = 'All fields are required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Invalid email address.';
        } elseif (strlen($password) < 6) {
            $error = 'Password must be at least 6 characters.';
        } elseif ($password !== $confirm) {
            $error = 'Passwords do not match.';
        } elseif ($this->userModel->emailExists($email)) {
            $error = 'Email already registered.';
        } else {
            $id = $this->userModel->createUser($name, $email, $password, 'user');
            if ($id) {
                $success = 'Account created successfully. Please login.';
            } else {
                $error = 'Registration failed. Try again.';
            }
        }

        $this->view('auth/register', ['error' => $error, 'success' => $success], 'auth_layout');
    }

    // GET /logout
    public function logout($params = []) {
        session_destroy();
        $this->redirect(BASE_URL . '/login');
    }
}
