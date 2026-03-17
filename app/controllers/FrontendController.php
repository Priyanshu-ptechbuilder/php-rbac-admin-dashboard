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
        $userId       = $_SESSION['user_id'];
        $name         = trim($_POST['name'] ?? '');
        $email        = trim($_POST['email'] ?? '');
        $birthday     = trim($_POST['birthday'] ?? null);
        $gender       = trim($_POST['gender'] ?? null);
        $address      = trim($_POST['address'] ?? null);
        $availability = trim($_POST['availability'] ?? 'Available now');
        
        $error   = '';
        $success = '';

        if (empty($name) || empty($email)) {
            $error = 'Name and email are required.';
        } elseif ($this->userModel->emailExists($email, $userId)) {
            $error = 'Email already in use.';
        } else {
            $user = $this->userModel->getUserById($userId);
            $this->userModel->updateUser($userId, $name, $email, $user['role'], $user['status'], $birthday, $gender, $address, $availability);
            $_SESSION['user_name'] = $name;
            $success = 'Profile updated successfully.';
        }

        $user     = $this->userModel->getUserById($userId);
        $features = $this->featureModel->getEnabledFeatures($userId);
        $this->view('frontend/profile', ['pageTitle' => 'My Profile', 'user' => $user, 'features' => $features, 'error' => $error, 'success' => $success], 'frontend_layout');
    }

    // POST /profile/update-avatar
    public function updateAvatar($params = []) {
        $this->requireUser();
        $userId = $_SESSION['user_id'];
        $error  = '';
        
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath = $_FILES['avatar']['tmp_name'];
            $fileName    = $_FILES['avatar']['name'];
            $fileSize    = $_FILES['avatar']['size'];
            $fileType    = $_FILES['avatar']['type'];
            $fileNameCmps = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            
            $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
            if (in_array($fileExtension, $allowedfileExtensions)) {
                $projectRoot = dirname(__DIR__, 2);
                $uploadDir = $projectRoot . '/public/assets/media/uploads/avatars/';
                
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0777, true);
                }

                if (!is_writable($uploadDir)) {
                    $error = 'Upload directory is not writable. Path: ' . $uploadDir;
                } else {
                    $newFileName = md5(time() . $fileName) . '.' . $fileExtension;
                    $dest_path = $uploadDir . $newFileName;
                    
                    if(move_uploaded_file($fileTmpPath, $dest_path)) {
                        @chmod($dest_path, 0644);
                        $avatarUrl = BASE_URL . '/assets/media/uploads/avatars/' . $newFileName;
                        $this->userModel->updateAvatar($userId, $avatarUrl);
                        $_SESSION['user_avatar'] = $avatarUrl;
                        $this->redirect(BASE_URL . '/profile?success=Avatar updated');
                    } else {
                        $error = 'Failed to move uploaded file. Check permissions or PHP tmp settings.';
                    }
                }
            } else {
                $error = 'Upload failed. Allowed types: ' . implode(',', $allowedfileExtensions);
            }
        } else {
            $error = 'No file uploaded or upload error.';
        }
        
        $user     = $this->userModel->getUserById($userId);
        $features = $this->featureModel->getEnabledFeatures($userId);
        $this->view('frontend/profile', ['pageTitle' => 'My Profile', 'user' => $user, 'features' => $features, 'error' => $error], 'frontend_layout');
    }

    // POST /profile/update-password
    public function updatePassword($params = []) {
        $this->requireUser();
        $userId  = $_SESSION['user_id'];
        
        $currentPassword = trim($_POST['current_password'] ?? '');
        $newPassword     = trim($_POST['new_password'] ?? '');
        $confirmPassword = trim($_POST['confirm_password'] ?? '');
        
        $pwdError   = '';
        $pwdSuccess = '';

        $user = $this->userModel->getUserById($userId);

        if (empty($currentPassword) || empty($newPassword) || empty($confirmPassword)) {
            $pwdError = 'All password fields are required.';
        } elseif ($newPassword !== $confirmPassword) {
            $pwdError = 'New passwords do not match.';
        } elseif (!$this->userModel->verifyPassword($user['email'], $currentPassword)) {
            $pwdError = 'Current password is incorrect.';
        } else {
            $this->userModel->updatePassword($userId, $newPassword);
            $pwdSuccess = 'Password updated successfully.';
        }

        $features = $this->featureModel->getEnabledFeatures($userId);
        $this->view('frontend/profile', ['pageTitle' => 'My Profile', 'user' => $user, 'features' => $features, 'pwdError' => $pwdError, 'pwdSuccess' => $pwdSuccess], 'frontend_layout');
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
