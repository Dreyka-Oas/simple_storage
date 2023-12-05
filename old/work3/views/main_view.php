<?php
include_once 'functions/form_functions.php';
include_once 'functions/faker_functions.php';
include_once 'functions/search_functions.php';
include_once 'functions/display_functions.php';
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
                            <?php addFormFields(); ?>
                            <button type="submit" class="btn btn-primary">Add</button>
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
                                            <?php searchColumns();?>
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
                                        <?php echo displayTotalSearchResults($searchData);?>
                                </div>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary" name="search">Search</button>
                        </form>
                    </div>
                </div>

                <div class="card mt-3">
                    <div class="card-header">
                        <h2 class="card-title">Faker</h2>
                    </div>
                    <div class="card-body">
                        <?php showFakerMessage();?>
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
                    <div class="card-body">
                        <form action="controller/remove_all.php" method="post">
                            <div class="row">
                                <div class="col-md-6">
                                    <button type="submit" class="btn btn-danger" name="removeAll">Remove All</button>
                                </div>
                                <div class="col-md-6">
                                    <?php echo displayTotalElements($storageController); ?>
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
                        <?php displayStoredElements($data, $startFrom, $totalPages, $sort, $searchColumn, $searchValue, $page); ?>
                    </div>

                </div>
            </div>
        </div>
    </div>


</body>
</html>



