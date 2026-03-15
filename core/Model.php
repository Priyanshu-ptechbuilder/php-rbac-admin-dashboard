<?php
// core/Model.php

class Model {
    protected $db;
    protected $table;

    public function __construct() {
        $this->db = Database::getInstance();
    }

    protected function findAll($conditions = '', $params = []) {
        $sql = "SELECT * FROM {$this->table}";
        if ($conditions) {
            $sql .= " WHERE $conditions";
        }
        $sql .= " ORDER BY id DESC";

        if (!empty($params)) {
            $stmt = $this->db->prepare($sql);
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $result = $this->db->query($sql);
        }

        $rows = [];
        while ($row = $result->fetch_assoc()) {
            $rows[] = $row;
        }
        return $rows;
    }

    protected function findOne($conditions, $params = []) {
        $sql = "SELECT * FROM {$this->table} WHERE $conditions LIMIT 1";

        if (!empty($params)) {
            $stmt = $this->db->prepare($sql);
            $types = str_repeat('s', count($params));
            $stmt->bind_param($types, ...$params);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $result = $this->db->query($sql);
        }

        return $result->fetch_assoc();
    }

    protected function findById($id) {
        return $this->findOne("id = ?", [$id]);
    }

    protected function count($conditions = '') {
        $sql = "SELECT COUNT(*) as cnt FROM {$this->table}";
        if ($conditions) $sql .= " WHERE $conditions";
        $result = $this->db->query($sql);
        $row = $result->fetch_assoc();
        return (int)$row['cnt'];
    }
}
