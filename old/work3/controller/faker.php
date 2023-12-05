<?php
require_once '../vendor/autoload.php';
require_once('../config/db_connect.php');
require_once 'StorageController.php';

if (isset($_POST['generateFaker'])) {
    $faker = Faker\Factory::create("fr_FR");
    $fakerNumber = $_POST['fakerNumber'];

    $minStorage = $_POST['minStorage'];
    $maxStorage = $_POST['maxStorage'];

    $maxStorage = ($maxStorage < 1) ? 1000 : $maxStorage;

    $storageController = new StorageController();

    $fakerNumber = 50;
    for ($i = 0; $i < $fakerNumber; $i++) {
        $name = $faker->unique()->word;
        $description = $faker->sentence;
        $storage = $faker->numberBetween($minStorage, $maxStorage);

        $storageController->addElement($name, $description, $storage);
    }

    header("Location: ../index.php?addedFaker=True");
    exit();
}


?>
