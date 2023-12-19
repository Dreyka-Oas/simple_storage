<?php


function getUsersList() {
    require_once 'controller/HomeController.php';

    $storageController = new StorageController();

    try {
        $users = $storageController->getAllUsers();
        return $users;
    } catch (Exception $e) {
        echo 'Erreur dans getUsersList : ' . $e->getMessage();
        return [];
    }
}
?>

