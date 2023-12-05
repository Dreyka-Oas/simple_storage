<?php

class StorageController {
    private $db;

    const DB_HOST = 'localhost';
    const DB_NAME = 'storage';
    const DB_USER = 'root';
    const DB_PASSWORD = 'mdproot';

    public function __construct() {
        $this->connectToDatabase();
    }

    private function connectToDatabase() {
        $dsn = "pgsql:host=" . self::DB_HOST . ";dbname=" . self::DB_NAME;
        $this->db = new PDO($dsn, self::DB_USER, self::DB_PASSWORD);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    private function prepareQuery($sql) {
        return $this->db->prepare($sql);
    }

    private function validateSortColumn($sortColumn) {
        $allowedColumns = ['name', 'description', 'storage'];
        return in_array($sortColumn, $allowedColumns) ? $sortColumn : 'name';
    }

    public function getAllDataFromStorageP($sortColumn = 'name', $startFrom = 0, $perPage = 50) {
        $sortColumn = $this->validateSortColumn($sortColumn);
        $query = $this->prepareQuery("SELECT * FROM storage_p ORDER BY $sortColumn LIMIT :perPage OFFSET :startFrom");
        $query->bindParam(':perPage', $perPage, PDO::PARAM_INT);
        $query->bindParam(':startFrom', $startFrom, PDO::PARAM_INT);
        $query->execute();
        return $query->fetchAll(PDO::FETCH_ASSOC);
    }
    

    public function addElement($name, $desc, $storage) {
        $query = $this->prepareQuery("INSERT INTO storage_p (name, description, storage) VALUES (:name, :desc, :storage)");
        $query->bindParam(':name', $name);
        $query->bindParam(':desc', $desc);
        $query->bindParam(':storage', $storage);
        $query->execute();
    }

    public function deleteElement($id) {
        $query = $this->prepareQuery("DELETE FROM storage_p WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        return true;
    }

    public function getElementById($id) {
        $query = $this->prepareQuery("SELECT * FROM storage_p WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->execute();
        return $query->fetch(PDO::FETCH_ASSOC);
    }

    public function updateElement($id, $name, $desc, $storage) {
        $query = $this->prepareQuery("UPDATE storage_p SET name = :name, description = :description, storage = :storage WHERE id = :id");
        $query->bindParam(':id', $id);
        $query->bindParam(':name', $name);
        $query->bindParam(':description', $desc);
        $query->bindParam(':storage', $storage);
        $query->execute();
        return true;
    }

    public function removeAllData() {
        $query = $this->prepareQuery("DELETE FROM storage_p");
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
        $query = $this->prepareQuery("SELECT COUNT(*) as count FROM storage_p");
        $query->execute();
        $result = $query->fetch(PDO::FETCH_ASSOC);
    
        return isset($result['count']) ? (int)$result['count'] : 0;
    }
    
    
}
?>
