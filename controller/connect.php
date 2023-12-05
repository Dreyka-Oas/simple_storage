<?php

$configFile = __DIR__ . '/../config/conf_connect.json';

if (!file_exists($configFile)) {
    die("Error: Configuration file not found.");
}

$config = json_decode(file_get_contents($configFile), true);

$GLOBALS['DB_HOST'] = $config['DB_HOST'];
$GLOBALS['DB_NAME'] = $config['DB_NAME'];
$GLOBALS['DB_USER'] = $config['DB_USER'];
$GLOBALS['DB_PASSWORD'] = $config['DB_PASSWORD'];

class DatabaseConnection {
    private $db;

    public function __construct() {
        $this->connectToDatabase();
    }

    private function connectToDatabase() {
        $dsn = "pgsql:host=" . $GLOBALS['DB_HOST'] . ";dbname=" . $GLOBALS['DB_NAME'];
        $this->db = new PDO($dsn, $GLOBALS['DB_USER'], $GLOBALS['DB_PASSWORD']);
        $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function prepareQuery($sql) {
        return $this->db->prepare($sql);
    }
}
?>
