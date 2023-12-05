<?php
require_once('../config/db_connect.php');
include 'StorageController.php';

if (isset($_POST['removeAll'])) {
    $storageController = new StorageController();
    $success = $storageController->removeAllData();

    header("Location: ../index.php");
    exit();
} else {
    
    
}
?>
