<?php
require_once 'HomeController.php';
error_reporting(E_ALL); ini_set("display_errors", 1); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $desc = $_POST["desc"];
    $user = $_POST["user"];  // Utilisez le même nom que le champ dans le formulaire

    $storageController = new StorageController();

    $success = $storageController->addElement($name, $desc, $user);

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
