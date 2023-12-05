<?php
include 'StorageController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $storageController = new StorageController();
    $success = $storageController->deleteElement($id);

    if ($success) {
        header("Location: ../index.php");
        exit();
    } else {
        echo "Erreur lors de la suppression de l'élément.";
    }
} else {
    echo "ID de l'élément non spécifié.";
}
?>
