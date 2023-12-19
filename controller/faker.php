<?php

require_once '../vendor/autoload.php';
require_once 'HomeController.php';
error_reporting(E_ALL); ini_set("display_errors", 1);
if (isset($_POST['generateFaker'])) {
    $jsonContent = file_get_contents('../config/tools_faker.json');
    $data = json_decode($jsonContent, true);

    if (isset($data['tools']) && is_array($data['tools'])) {
        $fakerNumber = $_POST['fakerNumber'];

        $minStorage = $_POST['minStorage'];
        $maxStorage = $_POST['maxStorage'];

        $maxStorage = ($maxStorage < 1) ? 1000 : $maxStorage;

        $storageController = new StorageController();

        $faker = Faker\Factory::create();

        for ($i = 0; $i < $fakerNumber; $i++) {
            $randomTool = $data['tools'][array_rand($data['tools'])];

            $name = $randomTool['name'];
            $description = $randomTool['description'];
            $storage = mt_rand($minStorage, $maxStorage);

            $userName = $faker->name;
            $storageController->addUser($userName, $storage);
            $storageController->addElement($name, $description, $userName);
        }
        header("Location: ../index.php?addedFaker=true");
        exit();
    } else {
        echo "Erreur de structure JSON ou pas de données d'outils.";
    }
}
?>
