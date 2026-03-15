<?php
// app/controllers/FrontendController.php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../../core/Database.php';
require_once __DIR__ . '/../../core/Model.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/FeaturePermission.php';

class FrontendController extends Controller {

    private $userModel;
    private $featureModel;

    public function __construct() {
        $this->userModel    = new User();
        $this->featureModel = new FeaturePermission();
    }

    // GET / - Home page (public)
    public function home($params = []) {
        $this->view('frontend/home', ['pageTitle' => 'Welcome'], 'frontend_public');
    }

    // GET /dashboard - User dashboard (requires login)
    public function dashboard($params = []) {
        $this->requireUser();
        $userId   = $_SESSION['user_id'];
        $features = $this->featureModel->getEnabledFeatures($userId);

        $data = [
            'pageTitle' => 'My Dashboard',
            'features'  => $features,
        ];
        $this->view('frontend/dashboard', $data, 'frontend_layout');
    }

    // GET /profile
    public function profile($params = []) {
        $this->requireUser();
        $userId = $_SESSION['user_id'];

        if (!$this->featureModel->isFeatureEnabled($userId, 'profile')) {
            $this->view('frontend/denied', ['pageTitle' => 'Access Denied'], 'frontend_layout');
            return;
        }

        $user     = $this->userModel->getUserById($userId);
        $features = $this->featureModel->getEnabledFeatures($userId);

        $this->view('frontend/profile', ['pageTitle' => 'My Profile', 'user' => $user, 'features' => $features], 'frontend_layout');
    }

    // POST /profile/update
    public function updateProfile($params = []) {
        $this->requireUser();
        $userId  = $_SESSION['user_id'];
        $name    = trim($_POST['name'] ?? '');
        $email   = trim($_POST['email'] ?? '');
        $error   = '';
        $success = '';

        if (empty($name) || empty($email)) {
            $error = 'Name and email are required.';
        } elseif ($this->userModel->emailExists($email, $userId)) {
            $error = 'Email already in use.';
        } else {
            $user = $this->userModel->getUserById($userId);
            $this->userModel->updateUser($userId, $name, $email, $user['role'], $user['status']);
            $_SESSION['user_name'] = $name;
            $success = 'Profile updated successfully.';
        }

        $user     = $this->userModel->getUserById($userId);
        $features = $this->featureModel->getEnabledFeatures($userId);
        $this->view('frontend/profile', ['pageTitle' => 'My Profile', 'user' => $user, 'features' => $features, 'error' => $error, 'success' => $success], 'frontend_layout');
    }

    // GET /reports
    public function reports($params = []) {
        $this->requireUser();
        $userId = $_SESSION['user_id'];
        if (!$this->featureModel->isFeatureEnabled($userId, 'reports')) {
            $this->view('frontend/denied', ['pageTitle' => 'Access Denied'], 'frontend_layout');
            return;
        }
        $features = $this->featureModel->getEnabledFeatures($userId);
        $this->view('frontend/reports', ['pageTitle' => 'Reports', 'features' => $features], 'frontend_layout');
    }

    // GET /documents
    public function documents($params = []) {
        $this->requireUser();
        $userId = $_SESSION['user_id'];
        if (!$this->featureModel->isFeatureEnabled($userId, 'documents')) {
            $this->view('frontend/denied', ['pageTitle' => 'Access Denied'], 'frontend_layout');
            return;
        }
        $features = $this->featureModel->getEnabledFeatures($userId);
        $this->view('frontend/documents', ['pageTitle' => 'Documents', 'features' => $features], 'frontend_layout');
    }

    // GET /calendar
    public function calendar($params = []) {
        $this->requireUser();
        $userId = $_SESSION['user_id'];
        if (!$this->featureModel->isFeatureEnabled($userId, 'calendar')) {
            $this->view('frontend/denied', ['pageTitle' => 'Access Denied'], 'frontend_layout');
            return;
        }
        $features = $this->featureModel->getEnabledFeatures($userId);
        $this->view('frontend/calendar', ['pageTitle' => 'Calendar', 'features' => $features], 'frontend_layout');
    }

    // GET /projects
    public function projects($params = []) {
        $this->requireUser();
        $userId = $_SESSION['user_id'];
        if (!$this->featureModel->isFeatureEnabled($userId, 'projects')) {
            $this->view('frontend/denied', ['pageTitle' => 'Access Denied'], 'frontend_layout');
            return;
        }
        $features = $this->featureModel->getEnabledFeatures($userId);
        $this->view('frontend/projects', ['pageTitle' => 'Projects', 'features' => $features], 'frontend_layout');
    }
}
