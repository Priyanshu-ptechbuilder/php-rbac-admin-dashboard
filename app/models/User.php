<?php
// app/models/User.php

class User extends Model {
    protected $table = 'users';

    public function getAllUsers() {
        return $this->findAll();
    }

    public function getUserById($id) {
        return $this->findById($id);
    }

    public function getUserByEmail($email) {
        return $this->findOne("email = ?", [$email]);
    }

    public function createUser($name, $email, $password, $role = 'user') {
        $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare(
            "INSERT INTO users (name, email, password, role, status) VALUES (?, ?, ?, ?, 'active')"
        );
        $stmt->bind_param('ssss', $name, $email, $hashedPassword, $role);
        $result = $stmt->execute();
        if ($result) {
            $newUserId = $this->db->lastInsertId();
            $this->initUserPermissions($newUserId);
            return $newUserId;
        }
        return false;
    }

    public function updateUser($id, $name, $email, $role, $status) {
        $stmt = $this->db->prepare(
            "UPDATE users SET name=?, email=?, role=?, status=?, updated_at=NOW() WHERE id=?"
        );
        $stmt->bind_param('ssssi', $name, $email, $role, $status, $id);
        return $stmt->execute();
    }

    public function updatePassword($id, $newPassword) {
        $hashed = password_hash($newPassword, PASSWORD_BCRYPT);
        $stmt = $this->db->prepare("UPDATE users SET password=? WHERE id=?");
        $stmt->bind_param('si', $hashed, $id);
        return $stmt->execute();
    }

    public function deleteUser($id) {
        $stmt = $this->db->prepare("DELETE FROM users WHERE id=?");
        $stmt->bind_param('i', $id);
        return $stmt->execute();
    }

    public function verifyPassword($email, $password) {
        $user = $this->getUserByEmail($email);
        if ($user && password_verify($password, $user['password'])) {
            return $user;
        }
        return false;
    }

    public function emailExists($email, $excludeId = null) {
        if ($excludeId) {
            $user = $this->findOne("email = ? AND id != ?", [$email, $excludeId]);
        } else {
            $user = $this->findOne("email = ?", [$email]);
        }
        return $user !== null;
    }

    public function getTotalUsers() {
        return $this->count("role = 'user'");
    }

    public function getActiveUsers() {
        return $this->count("role = 'user' AND status = 'active'");
    }

    private function initUserPermissions($userId) {
        $features = $this->db->query("SELECT * FROM features");
        while ($feature = $features->fetch_assoc()) {
            $stmt = $this->db->prepare(
                "INSERT IGNORE INTO feature_permissions (user_id, feature_key, feature_label, is_enabled) VALUES (?, ?, ?, 0)"
            );
            $stmt->bind_param('iss', $userId, $feature['feature_key'], $feature['feature_label']);
            $stmt->execute();
        }
    }
}
