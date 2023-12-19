<?php
require_once 'HomeController.php';

if (isset($_POST['removeAll'])) {
    $storageController = new StorageController();
    $success = $storageController->removeAllData();

    header("Location: ../index.php");
    exit();
} else {
    
    
}
?>
