<?php

require_once 'connect.php';

class StorageController {
    
    
    private $db;

    public function __construct() {
        $this->db = new DatabaseConnection();
    }

    private function validateSortColumn($sortColumn) {
        $allowedColumns = ['name', 'description', 'storage', 'user'];
        return in_array($sortColumn, $allowedColumns) ? $sortColumn : 'name';
    }

    public function getAllDataFromStorageP($sortColumn = 'name', $startFrom = 0, $perPage = 30) {
        $sortColumn = $this->validateSortColumn($sortColumn);
        $query = $this->db->prepareQuery("SELECT storage_tools.*, storage_users.name as user FROM storage_tools LEFT JOIN storage_users ON storage_tools.storage = storage_users.storage ORDER BY $sortColumn LIMIT :perPage OFFSET :startFrom");
        $query->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $query->bindParam(':startFrom', $startFrom, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
        
    }
    
    public function getAllUsers() {
        $query = $this->db->prepareQuery("SELECT id, name FROM storage_users");
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    
    public function addElement($name, $desc, $user) {
        $storage = $this->getStorageByUserName($user);
    
        if ($storage) {
            $query = $this->db->prepareQuery("INSERT INTO storage_tools (name, description, storage) VALUES (:name, :desc, :storage)");
            $query->bindParam(':name', $name);
            $query->bindParam(':desc', $desc);
            $query->bindParam(':storage', $storage);
            $query->execute();
    
            return true;
        } else {
            return false;
        }
    }
    
    public function getStorageByUserName($userName) {
        $query = $this->db->prepareQuery("SELECT storage FROM storage_users WHERE name = :userName");
        $query->bindParam(':userName', $userName, PDO::PARAM_STR);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
    
        return isset($result['storage']) ? $result['storage'] : null;
    }
    

    public function deleteElement($id) {
        $query = $this->db->prepareQuery("DELETE FROM storage_tools WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        return true;
    }

    public function getElementById($id) {
        $query = $this->db->prepareQuery("SELECT * FROM storage_tools WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function updateElement($id, $name, $desc, $storage) {
        $query = $this->db->prepareQuery("UPDATE storage_tools SET name = :name, description = :description, storage = :storage WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->bindParam(':name', $name);
        $query->bindParam(':description', $desc);
        $query->bindParam(':storage', $storage);
        $query->execute();
        return true;
    }

    public function removeAllData() {
        $queryStorageTools = $this->db->prepareQuery("DELETE FROM storage_tools");
        $queryStorageTools->execute();
    
        $queryStorageUsers = $this->db->prepareQuery("DELETE FROM storage_users");
        $queryStorageUsers->execute();
    
        return true;
    }

    public function searchDataFromStorageP($column, $value, $fullSearch = false) {
        $allowedColumns = ['name', 'description', 'storage'];
    
        if (!in_array($column, $allowedColumns)) {
            return [];
        }
    
        if ($fullSearch) {
            $query = $this->db->prepareQuery("SELECT * FROM storage_tools WHERE $column = :value");
        } else {
            $query = ($column == 'storage')
                ? $this->db->prepareQuery("SELECT * FROM storage_tools WHERE CAST($column AS TEXT) LIKE :value")
                : $this->db->prepareQuery("SELECT * FROM storage_tools WHERE $column LIKE :value");
        }
    
        $valueWithWildcards = $fullSearch ? $value : "%$value%";
        $query->bindParam(':value', $valueWithWildcards);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    }
    public function addUser($name, $storage) {
        $query = $this->db->prepareQuery("INSERT INTO storage_users (name, storage) VALUES (:name, :storage)");
        $query->bindParam(':name', $name);
        $query->bindParam(':storage', $storage);
        $query->execute();
    }
    
    public function getTotalElementsCount() {
        $query = $this->db->prepareQuery("SELECT COUNT(*) as count FROM storage_tools");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
    
        return isset($result['count']) ? (int)$result['count'] : 0;
    }
    

    function getUserIdByStorage($storage) {
         $query = $this->db->prepareQuery("SELECT id FROM storage_users WHERE storage = :storage");
        $query->bindParam(':storage', $storage);
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
    
        return isset($result['id']) ? $result['id'] : null;
    }
    
}
?>
