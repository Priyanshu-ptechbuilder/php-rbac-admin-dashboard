<?php
// app/controllers/AdminController.php

require_once __DIR__ . '/../../core/Controller.php';
require_once __DIR__ . '/../../core/Database.php';
require_once __DIR__ . '/../../core/Model.php';
require_once __DIR__ . '/../models/User.php';
require_once __DIR__ . '/../models/FeaturePermission.php';

class AdminController extends Controller {

    private $userModel;
    private $featureModel;

    public function __construct() {
        $this->userModel    = new User();
        $this->featureModel = new FeaturePermission();
    }

    // GET /admin  - Dashboard
    public function dashboard($params = []) {
        $this->requireAdmin();
        
        // Fetch all users from the database
        $allUsers = $this->userModel->getAllUsers();

        // Calculate total and active users for stats
        $totalUsers  = count($allUsers);
        $activeUsers = count(array_filter($allUsers, function($u) { return ($u['status'] ?? '') === 'active'; }));

        // Filter out THE current logged-in admin from the displayed list
        $allUsers = array_filter($allUsers, function($u) {
            return $u['id'] != $_SESSION['user_id'];
        });

        // Apply ID obfuscation to all users in the list
        foreach ($allUsers as &$user) {
            $user['hash_id'] = $this->obfuscateId($user['id']);
        }
        unset($user); 

        $data = [
            'pageTitle'   => 'Admin Dashboard',
            'totalUsers'  => $totalUsers,
            'activeUsers' => $activeUsers,
            'allUsers'    => $allUsers,
        ];

        $this->view('admin/dashboard', $data, 'admin_layout');
    }

    // GET /admin/profile
    public function profile($params = []) {
        $this->requireAdmin();
        $userId = $_SESSION['user_id'];
        $user   = $this->userModel->getUserById($userId);
        
        // Admins have access to everything, but we can pass an empty features array or mock it for the profile view
        $features = []; 
        
        $this->view('frontend/profile', ['pageTitle' => 'Admin Profile', 'user' => $user, 'features' => $features], 'admin_layout');
    }

    // POST /admin/profile/update
    public function updateProfile($params = []) {
        $this->requireAdmin();
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
        $features = [];
        $this->view('frontend/profile', ['pageTitle' => 'Admin Profile', 'user' => $user, 'features' => $features, 'error' => $error, 'success' => $success], 'admin_layout');
    }

    // POST /admin/profile/update-avatar
    public function updateAvatar($params = []) {
        $this->requireAdmin();
        $userId = $_SESSION['user_id'];
        $error  = '';
        
        if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] === UPLOAD_ERR_OK) {
            $fileTmpPath   = $_FILES['avatar']['tmp_name'];
            $fileName      = $_FILES['avatar']['name'];
            $fileNameCmps  = explode(".", $fileName);
            $fileExtension = strtolower(end($fileNameCmps));
            
            $allowedfileExtensions = array('jpg', 'gif', 'png', 'jpeg');
            if (in_array($fileExtension, $allowedfileExtensions)) {
                // Use absolute path from project root
                $projectRoot = dirname(__DIR__, 2);
                $uploadDir = $projectRoot . '/public/assets/media/uploads/avatars/';
                
                if (!is_dir($uploadDir)) {
                    @mkdir($uploadDir, 0777, true);
                }

                if (!is_writable($uploadDir)) {
                    $error = 'Upload directory is not writable. Path: ' . $uploadDir;
                } else {
                    $newFileName = 'admin_' . md5(time() . $fileName) . '.' . $fileExtension;
                    $dest_path = $uploadDir . $newFileName;
                    
                    if(move_uploaded_file($fileTmpPath, $dest_path)) {
                        @chmod($dest_path, 0644);
                        $avatarUrl = BASE_URL . '/assets/media/uploads/avatars/' . $newFileName;
                        $this->userModel->updateAvatar($userId, $avatarUrl);
                        $_SESSION['user_avatar'] = $avatarUrl;
                        $this->redirect(BASE_URL . '/admin/profile?success=Avatar updated');
                    } else {
                        $error = 'Failed to move uploaded file to destination. Check permissions or PHP tmp settings.';
                    }
                }
            } else {
                $error = 'Invalid file type.';
            }
        }
        
        $user     = $this->userModel->getUserById($userId);
        $this->view('frontend/profile', ['pageTitle' => 'Admin Profile', 'user' => $user, 'features' => [], 'error' => $error], 'admin_layout');
    }

    public function users($params = []) {
        $this->requireAdmin();
        $users = $this->userModel->getAllUsers();
        
        // Filter out THE current logged-in admin from the displayed list
        $users = array_filter($users, function($u) {
            return $u['id'] != $_SESSION['user_id'];
        });

        // Obfuscate IDs for links while keeping original ID for display
        foreach ($users as &$u) {
            $u['hash_id'] = $this->obfuscateId($u['id']);
        }

        $this->view('admin/users', ['pageTitle' => 'Manage Users', 'users' => $users], 'admin_layout');
    }

    // GET /admin/users/create
    public function createUserForm($params = []) {
        $this->requireAdmin();
        $this->view('admin/create_user', ['pageTitle' => 'Create User'], 'admin_layout');
    }

    // POST /admin/users/create
    public function createUser($params = []) {
        $this->requireAdmin();
        $name     = trim($_POST['name'] ?? '');
        $email    = trim($_POST['email'] ?? '');
        $password = trim($_POST['password'] ?? '');
        $role     = $_POST['role'] ?? 'user';
        $error    = '';
        $success  = '';

        if (empty($name) || empty($email) || empty($password)) {
            $error = 'All fields are required.';
        } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $error = 'Invalid email address.';
        } elseif ($this->userModel->emailExists($email)) {
            $error = 'Email already exists.';
        } else {
            $id = $this->userModel->createUser($name, $email, $password, $role);
            if ($id) {
                $this->redirect(BASE_URL . '/admin/users?success=User created successfully');
            } else {
                $error = 'Failed to create user.';
            }
        }

        $this->view('admin/create_user', ['pageTitle' => 'Create User', 'error' => $error], 'admin_layout');
    }

    // GET /admin/users/edit/{id}
    public function editUserForm($params = []) {
        $this->requireAdmin();
        $id   = $this->deobfuscateId($params['id'] ?? 0);
        $user = $this->userModel->getUserById($id);
        if (!$user) {
            $this->redirect(BASE_URL . '/admin/users');
        }
        $user['hash_id'] = $this->obfuscateId($user['id']);
        $this->view('admin/edit_user', ['pageTitle' => 'Edit User', 'user' => $user], 'admin_layout');
    }

    // POST /admin/users/edit/{id}
    public function editUser($params = []) {
        $this->requireAdmin();
        $id     = $this->deobfuscateId($params['id'] ?? 0);
        $name   = trim($_POST['name'] ?? '');
        $email  = trim($_POST['email'] ?? '');
        $role   = $_POST['role'] ?? 'user';
        $status = $_POST['status'] ?? 'active';
        $error  = '';

        $user = $this->userModel->getUserById($id);
        if (!$user) {
            $this->redirect(BASE_URL . '/admin/users');
        }

        if (empty($name) || empty($email)) {
            $error = 'Name and email are required.';
        } elseif ($this->userModel->emailExists($email, $id)) {
            $error = 'Email already in use by another user.';
        } else {
            // Update password if provided
            if (!empty($_POST['password'])) {
                $this->userModel->updatePassword($id, $_POST['password']);
            }
            $result = $this->userModel->updateUser($id, $name, $email, $role, $status);
            if ($result) {
                $this->redirect(BASE_URL . '/admin/users?success=User updated successfully');
            } else {
                $error = 'Update failed.';
            }
        }

        $this->view('admin/edit_user', ['pageTitle' => 'Edit User', 'user' => $user, 'error' => $error], 'admin_layout');
    }

    // POST /admin/users/delete/{id}
    public function deleteUser($params = []) {
        $this->requireAdmin();
        $id = $this->deobfuscateId($params['id'] ?? 0);

        // Prevent deleting self
        if ($id == $_SESSION['user_id']) {
            $this->redirect(BASE_URL . '/admin/users?error=Cannot delete your own account');
        }

        $this->userModel->deleteUser($id);
        $this->redirect(BASE_URL . '/admin/users?success=User deleted successfully');
    }

    // GET /admin/users/permissions/{id}
    public function permissionsForm($params = []) {
        $this->requireAdmin();
        $id       = $this->deobfuscateId($params['id'] ?? 0);
        $user     = $this->userModel->getUserById($id);
        if (!$user) {
            $this->redirect(BASE_URL . '/admin/users');
        }
        $user['hash_id'] = $this->obfuscateId($user['id']);
        $features = $this->featureModel->getAllFeaturesForUser($id);

        $data = [
            'pageTitle' => 'Manage Permissions',
            'user'      => $user,
            'features'  => $features,
        ];
        $this->view('admin/permissions', $data, 'admin_layout');
    }

    // POST /admin/users/permissions/{id}
    public function updatePermissions($params = []) {
        $this->requireAdmin();
        $id              = $this->deobfuscateId($params['id'] ?? 0);
        $user            = $this->userModel->getUserById($id);
        if (!$user) {
            $this->redirect(BASE_URL . '/admin/users');
        }
        $enabledFeatures = $_POST['features'] ?? [];
        $this->featureModel->updatePermissions($id, $enabledFeatures);
        $this->redirect(BASE_URL . '/admin/users/permissions/' . $this->obfuscateId($id) . '?success=Permissions updated');
    }
}
