<?php
error_reporting(E_ALL); ini_set("display_errors", 1);

require_once 'connect.php';
class StorageController {
    
    
    private $db;

    public function __construct() {
        $this->db = new DatabaseConnection();
    }

    private function validateSortColumn($sortColumn) {
        $allowedColumns = ['name', 'description', 'storage'];
        return in_array($sortColumn, $allowedColumns) ? $sortColumn : 'name';
    }

    public function getAllDataFromStorageP($sortColumn = 'name', $startFrom = 0, $perPage = 50) {
        $sortColumn = $this->validateSortColumn($sortColumn);
        $query = $this->db->prepareQuery("SELECT * FROM storage_p ORDER BY $sortColumn LIMIT :perPage OFFSET :startFrom");
        $query->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $query->bindParam(':startFrom', $startFrom, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addElement($name, $desc, $storage) {
        $query = $this->db->prepareQuery("INSERT INTO storage_p (name, description, storage) VALUES (:name, :desc, :storage)");
        $query->bindParam(':name', $name);
        $query->bindParam(':desc', $desc);
        $query->bindParam(':storage', $storage);
        $query->execute();
    }

    public function deleteElement($id) {
        $query = $this->db->prepareQuery("DELETE FROM storage_p WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        return true;
    }

    public function getElementById($id) {
        $query = $this->db->prepareQuery("SELECT * FROM storage_p WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function updateElement($id, $name, $desc, $storage) {
        $query = $this->db->prepareQuery("UPDATE storage_p SET name = :name, description = :description, storage = :storage WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->bindParam(':name', $name);
        $query->bindParam(':description', $desc);
        $query->bindParam(':storage', $storage);
        $query->execute();
        return true;
    }

    public function removeAllData() {
        $query = $this->db->prepareQuery("DELETE FROM storage_p");
        $query->execute();
        return true;
    }

    public function searchDataFromStorageP($column, $value, $fullSearch = false) {
        $allowedColumns = ['name', 'description', 'storage'];
    
        if (!in_array($column, $allowedColumns)) {
            return [];
        }
    
        if ($fullSearch) {
            $query = $this->db->prepare("SELECT * FROM storage_p WHERE $column = :value");
        } else {
            $query = ($column == 'storage')
                ? $this->db->prepare("SELECT * FROM storage_p WHERE CAST($column AS TEXT) LIKE :value")
                : $this->db->prepare("SELECT * FROM storage_p WHERE $column LIKE :value");
        }
    
        $valueWithWildcards = $fullSearch ? $value : "%$value%";
        $query->bindParam(':value', $valueWithWildcards);
        $query->execute();
        $result = $query->fetchAll(PDO::FETCH_ASSOC);
    
        return $result;
    }
    
    
    public function getTotalElementsCount() {
        $query = $this->db->prepareQuery("SELECT COUNT(*) as count FROM storage_p");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
    
        return isset($result['count']) ? (int)$result['count'] : 0;
    }
    
    
}
?>
