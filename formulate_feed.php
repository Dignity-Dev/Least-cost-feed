<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'includes/db.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulate Feed</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-4">
        <h1>Formulate Feed</h1>
        <form method="POST" action="formulate_feed_process.php">
            <div class="mb-3">
                <label for="feed_name" class="form-label">Feed Name</label>
                <input type="text" class="form-control" id="feed_name" name="feed_name" required>
            </div>
            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredients (comma-separated)</label>
                <input type="text" class="form-control" id="ingredients" name="ingredients" required>
            </div>
            <div class="mb-3">
                <label for="cost" class="form-label">Estimated Cost</label>
                <input type="number" class="form-control" id="cost" name="cost" required>
            </div>
            <button type="submit" class="btn btn-primary">Save Feed</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
