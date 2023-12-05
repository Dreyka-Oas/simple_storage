<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier l'élément</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <div class="card">
            <div class="card-header">
                <h1 class="card-title">Modifier l'élément</h1>
            </div>
            <div class="card-body">
                <form action="update_element.php" method="post">
                    <input type="hidden" name="id" value="<?php echo $element['id']; ?>">
                    <div class="form-group">
                        <label for="name">Nom :</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo $element['name']; ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="desc">Description :</label>
                        <textarea class="form-control" id="desc" name="desc" rows="3" required><?php echo $element['description']; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="storage">Stockage :</label>
                        <input type="number" class="form-control" id="storage" name="storage" min="1" value="<?php echo $element['storage']; ?>" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Enregistrer les modifications</button>
                </form>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.0.8/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
