<?php

require_once 'controller/HomeController.php';

$storageController = new StorageController();

$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$perPage = 25;
$startFrom = ($page - 1) * $perPage;

if (isset($_POST['removeAll'])) {
    $storageController->removeAllData();
}

$sort = isset($_GET['sort']) ? $_GET['sort'] : 'name';
$searchData = [];
if (isset($_GET['search'])) {
    $searchColumn = $_GET['searchColumn'];
    $searchValue = $_GET['searchValue'];

    $searchData = $storageController->searchDataFromStorageP($searchColumn, $searchValue, isset($_GET['fullSearch']));
}

$data = !empty($searchData) ? array_slice($searchData, $startFrom, $perPage) : $storageController->getAllDataFromStorageP($sort, $startFrom, $perPage);

$totalResults = count($searchData) ?: $storageController->getTotalElementsCount();

if ($totalResults > 0) {
    $totalPages = ceil($totalResults / $perPage);
    $maxPages = ceil($totalResults / $perPage);
} else {
    $totalPages = 1;
    $maxPages = $totalPages;
}

if ($page > $maxPages) {
    $page = $maxPages;
    $startFrom = ($page - 1) * $perPage;
    $data = !empty($searchData) ? array_slice($searchData, $startFrom, $perPage) : $storageController->getAllDataFromStorageP($sort, $startFrom, $perPage);
}

include 'views/main.php';
?>
