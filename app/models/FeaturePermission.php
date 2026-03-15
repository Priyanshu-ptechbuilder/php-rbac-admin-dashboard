<?php
// app/models/FeaturePermission.php

class FeaturePermission extends Model {
    protected $table = 'feature_permissions';

    public function getUserPermissions($userId) {
        $sql = "SELECT fp.*, f.feature_route, f.description 
                FROM feature_permissions fp
                JOIN features f ON fp.feature_key = f.feature_key
                WHERE fp.user_id = ?
                ORDER BY f.id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $perms = [];
        while ($row = $result->fetch_assoc()) {
            $perms[] = $row;
        }
        return $perms;
    }

    public function getAllFeaturesForUser($userId) {
        // Get all features with this user's permission status
        $sql = "SELECT f.*, IFNULL(fp.is_enabled, 0) as is_enabled
                FROM features f
                LEFT JOIN feature_permissions fp ON f.feature_key = fp.feature_key AND fp.user_id = ?
                ORDER BY f.id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $perms = [];
        while ($row = $result->fetch_assoc()) {
            $perms[] = $row;
        }
        return $perms;
    }

    public function isFeatureEnabled($userId, $featureKey) {
        $sql = "SELECT is_enabled FROM feature_permissions WHERE user_id = ? AND feature_key = ?";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('is', $userId, $featureKey);
        $stmt->execute();
        $result = $stmt->get_result();
        $row = $result->fetch_assoc();
        return $row ? (bool)$row['is_enabled'] : false;
    }

    public function updatePermissions($userId, $enabledFeatures = []) {
        // First reset all to 0 for this user
        $stmt = $this->db->prepare("UPDATE feature_permissions SET is_enabled = 0 WHERE user_id = ?");
        $stmt->bind_param('i', $userId);
        $stmt->execute();

        // Then enable selected ones
        if (!empty($enabledFeatures)) {
            foreach ($enabledFeatures as $featureKey) {
                $stmt2 = $this->db->prepare(
                    "INSERT INTO feature_permissions (user_id, feature_key, feature_label, is_enabled) 
                     VALUES (?, ?, (SELECT feature_label FROM features WHERE feature_key = ?), 1)
                     ON DUPLICATE KEY UPDATE is_enabled = 1"
                );
                $stmt2->bind_param('iss', $userId, $featureKey, $featureKey);
                $stmt2->execute();
            }
        }
        return true;
    }

    public function getEnabledFeatures($userId) {
        $sql = "SELECT fp.*, f.feature_route 
                FROM feature_permissions fp
                JOIN features f ON fp.feature_key = f.feature_key
                WHERE fp.user_id = ? AND fp.is_enabled = 1
                ORDER BY f.id ASC";
        $stmt = $this->db->prepare($sql);
        $stmt->bind_param('i', $userId);
        $stmt->execute();
        $result = $stmt->get_result();
        $features = [];
        while ($row = $result->fetch_assoc()) {
            $features[$row['feature_key']] = $row;
        }
        return $features;
    }

    public function getAllFeatures() {
        $result = $this->db->query("SELECT * FROM features ORDER BY id ASC");
        $features = [];
        while ($row = $result->fetch_assoc()) {
            $features[] = $row;
        }
        return $features;
    }
}
