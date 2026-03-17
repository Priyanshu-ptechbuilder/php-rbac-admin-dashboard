<?php
// core/Controller.php

class Controller {

    protected function view($viewPath, $data = [], $layout = null) {
        extract($data);

        ob_start();
        require __DIR__ . '/../app/views/' . $viewPath . '.php';
        $content = ob_get_clean();

        if ($layout) {
            require __DIR__ . '/../app/views/layouts/' . $layout . '.php';
        } else {
            echo $content;
        }
    }

    protected function redirect($url) {
        header('Location: ' . $url);
        exit;
    }

    protected function isLoggedIn() {
        return isset($_SESSION['user_id']);
    }

    protected function isAdmin() {
        return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    }

    protected function requireLogin() {
        if (!$this->isLoggedIn()) {
            $this->redirect(BASE_URL . '/login');
        }
    }

    protected function requireAdmin() {
        if (!$this->isLoggedIn() || !$this->isAdmin()) {
            $this->redirect(BASE_URL . '/login');
        }
    }

    protected function requireUser() {
        if (!$this->isLoggedIn()) {
            $this->redirect(BASE_URL . '/login');
        }
        if ($this->isAdmin()) {
            $this->redirect(BASE_URL . '/admin');
        }
    }

    protected function json($data) {
        header('Content-Type: application/json');
        echo json_encode($data);
        exit;
    }

    protected function obfuscateId($id) {
        if (!is_numeric($id)) return $id;
        return str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($id . '_id_secure_99'));
    }

    protected function deobfuscateId($hash) {
        if (is_numeric($hash)) return (int)$hash;
        $hash = str_replace(['-', '_'], ['+', '/'], $hash);
        $decoded = base64_decode($hash);
        if (!$decoded) return 0;
        $parts = explode('_id_secure_99', $decoded);
        return (isset($parts[0]) && is_numeric($parts[0])) ? (int)$parts[0] : 0;
    }
}
