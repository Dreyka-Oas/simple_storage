<?php
include 'controller/StorageController.php';
$storageController = new StorageController();

$page = isset($_GET['page']) ? max(1, intval($_GET['page'])) : 1;
$perPage = 50;
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
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>List of storage_p elements</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container-fluid mt-5">
        <div class="row">
            <div class="col-md-3 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h2 class="card-title">Add an element</h2>
                    </div>
                    
                    <div class="card-body">
                        <form action="controller/add_element.php" method="post">
                            <?php
                                $formFields = [
                                    'name' => 'Name',
                                    'desc' => 'Description',
                                    'storage' => 'Storage Number'
                                ];

                                foreach ($formFields as $field => $label) {
                                    echo '<div class="form-group">';
                                    echo "<label for=\"$field\">$label :</label>";
                                    if ($field === 'storage') {
                                        echo "<input type=\"number\" class=\"form-control\" id=\"$field\" name=\"$field\" min=\"0\" value=\"0\" required>";
                                    } else {
                                        echo "<input type=\"text\" class=\"form-control\" id=\"$field\" name=\"$field\" required>";
                                    }
                                        echo '</div>';
                                }
                            ?>
                            <button type="submit" class="btn btn-primary">Add</button>
                        </form>
                    </div>

                </div>               
                <div class="card mt-3">
                    <div class="card-header">
                        <h2 class="card-title">Faker</h2>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($_GET['addedFaker']) && $_GET['addedFaker'] === 'true') {
                            echo '<div class="alert alert-success" role="alert">';
                            echo 'Faker data added successfully.';
                            echo '</div>';
                        }
                        ?>
                        <form action="controller/faker.php" method="post">
                            <div class="form-group">
                                <label for="fakerNumber">Number:</label>
                                <input type="number" class="form-control" id="fakerNumber" name="fakerNumber" min="1" value="50" required>
                            </div>


                            <div class="form-group row">
                                <div class="col-md-6">
                                    <label for="minStorage">Min Storage:</label>
                                    <input type="number" class="form-control" id="minStorage" min="0" name="minStorage" value="0">
                                </div>
                                <div class="col-md-6">
                                    <label for="maxStorage">Max Storage:</label>
                                    <input type="number" class="form-control" id="maxStorage" min="1" name="maxStorage" value="800">
                                </div>
                            </div>



                            <button type="submit" class="btn btn-primary" name="generateFaker">Validate</button>
                        </form>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-header">
                        <h2 class="card-title">Search</h2>
                    </div>
                    <div class="card-body">
                        <form action="" method="get">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="searchColumn">Choose a column:</label>
                                        <select class="form-control" id="searchColumn" name="searchColumn">
                                            <?php
                                            $searchColumns = [
                                                'name' => 'Name',
                                                'description' => 'Description',
                                                'storage' => 'Storage Number'
                                            ];
                                            
                                            foreach ($searchColumns as $column => $columnLabel) {
                                                echo "<option value=\"$column\">$columnLabel</option>";
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="searchValue">Search:</label>
                                        <input type="text" class="form-control" id="searchValue" name="searchValue" required>
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="fullSearch" name="fullSearch">
                                            <label class="form-check-label" for="fullSearch">
                                                Full search
                                            </label>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                <div class="form-group">
                                   
                                        <?php
                                            $totalSearchResults = count($searchData);
                                            echo 'Total search results: ' . $totalSearchResults;
                                            ?>
                                        </p>
                                        </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="search">Search</button>
                        </form>
                    </div>
                </div>
                <div class="card mt-3">
                    <div class="card-body">
                        <form action="controller/remove_all.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-danger" name="removeAll">Remove All</button>
                                </div>
                                <div class="col-md-6">
                                    <?php
                                    $totalElements = $storageController->getTotalElementsCount();
                                    echo '<p class="text-right">Total elements: ' . $totalElements . '</p>';
                                    ?>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-9 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <h1 class="card-title">List of stored elements</h1>
                    </div>
                    <div class="card-body">
                        <?php
                    if (!empty($data)) {
                        echo '<table class="table table-striped">';
                        echo '<thead>';
                        echo '<tr>';
                        echo '<th scope="col"><a>Num</a></th>';
                        echo '<th scope="col"><a href="?sort=name">Name</a></th>';
                        echo '<th scope="col"><a href="?sort=description">Description</a></th>';
                        echo '<th scope="col"><a href="?sort=storage">Storage Number</a></th>';
                        echo '<th scope="col">Actions</th>';
                        echo '</tr>';
                        echo '</thead>';
                        echo '<tbody>';
                        $counter = 1 + $startFrom;
                        foreach ($data as $row) {
                            echo '<tr>';
                            echo '<td>' . $counter . '. </td>';
                            echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['description']) . '</td>';
                            echo '<td>' . htmlspecialchars($row['storage']) . '</td>';
                            echo '<td>';
                            echo '<a href="controller/edit_element.php?id=' . $row['id'] . '" class="btn btn-primary btn-sm btn-actions">Edit</a>';
                            echo '<a href="controller/delete_element.php?id=' . $row['id'] . '" class="btn btn-danger btn-sm btn-actions">Delete</a>';
                            echo '</td>';
                            echo '</tr>';
                            $counter++;
                        }
                        echo '</tbody>';
                        echo '</table>';
                 
                        echo '<div class="text-center"><ul class="pagination">';

                        if ($totalPages > 10) {
                        echo '<li class="page-item"><a class="page-link" href="?page=1&sort=' . $sort . '&searchColumn=' . $searchColumn . '&searchValue=' . $searchValue . '">1</a></li>';
                        }
                        if ($page > 10) {
                            echo '<li class="page-item"><a class="page-link" href="?page=' . ($page - 1) . '&sort=' . $sort . '&searchColumn=' . $searchColumn . '&searchValue=' . $searchValue . '">&laquo;</a></li>';
                        }
                        for ($i = max(1, $page - 9); $i <= min($totalPages, $page + 9); $i++) {
                            echo '<li class="page-item';
                            if ($page == $i) {
                                echo ' active';
                            }
                            echo '"><a class="page-link" href="?page=' . $i . '&sort=' . $sort . '&searchColumn=' . $searchColumn . '&searchValue=' . $searchValue . '">' . $i . '</a></li>';
                        }

                        if ($page < $totalPages - 10) {
                            echo '<li class="page-item"><a class="page-link" href="?page=' . ($page + 1) . '&sort=' . $sort . '&searchColumn=' . $searchColumn . '&searchValue=' . $searchValue . '">&raquo;</a></li>';
                        }
                        if ($totalPages > 10) {
                        echo '<li class="page-item"><a class="page-link" href="?page=' . $totalPages . '&sort=' . $sort . '&searchColumn=' . $searchColumn . '&searchValue=' . $searchValue . '">' . $totalPages . '</a></li>';
                        }
                        echo '</ul></div>';

                    } else {
                        echo '<p class="text-muted">No elements found in the storage_p table.</p>';
                    }
                    ?>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
