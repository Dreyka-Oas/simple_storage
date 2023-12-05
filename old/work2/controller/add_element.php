<?php
require_once('../config/db_connect.php');
include 'StorageController.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $storage = $_POST["storage"];

    $storageController = new StorageController();

    $success = $storageController->addElement($name, $desc, $storage);

    if ($success) {
        echo '<div class="alert alert-success" role="alert">Élément ajouté avec succès !</div>';
    } else {
        echo '<div class="alert alert-danger" role="alert">Erreur lors de l\'ajout de l\'élément.</div>';
    }
    header("Location: ../index.php");
    exit();
} else {
    header("Location: ../index.php");
    exit();
}
?>
