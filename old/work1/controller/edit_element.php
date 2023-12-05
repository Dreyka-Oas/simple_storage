<?php
include 'StorageController.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $storageController = new StorageController();
    $element = $storageController->getElementById($id);

    if ($element) {
        include '../views/edit_element_form.php';
    } else {
        echo "Élément non trouvé.";
    }
} else {
    echo "ID de l'élément non spécifié.";
}
?>
