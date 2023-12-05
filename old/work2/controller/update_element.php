<?php

require_once('../config/db_connect.php');
include 'StorageController.php';



if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    echo "Avant la vérification POST";

    try {
        $id = $_POST['id'];
        $name = $_POST['name'];
        $desc = $_POST['desc'];
        $storage = $_POST['storage'];

        $storageController = new StorageController();

        echo "Avant l'appel à updateElement"; 

        $existingElement = $storageController->getElementById($id);


        if ($existingElement) {
            $result = $storageController->updateElement($id, $name, $desc, $storage);

            if ($result) {
                header("Location: ../index.php");
                exit();
            } else {
                echo "Erreur lors de la mise à jour de l'élément.";
            }
        } else {
            echo "L'élément avec l'ID $id n'existe pas.";
        }
    } catch (Exception $e) {
        echo "Exception capturée : " . $e->getMessage();
    }
} else {
    echo "Méthode non autorisée.";
}

echo "À la fin du script";
