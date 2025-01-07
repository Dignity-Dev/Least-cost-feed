<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'includes/db.php';

if (!isset($_GET['id'])) {
    $_SESSION['error_message'] = "Invalid feed recipe ID.";
    header('Location: feed_recipes.php');
    exit();
}

$id = $_GET['id'];
$query = "SELECT * FROM feed_recipes WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('ii', $id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['error_message'] = "Feed recipe not found.";
    header('Location: feed_recipes.php');
    exit();
}

$feed = $result->fetch_assoc();
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Feed Recipe</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-5">
        <h2>Edit Feed Recipe</h2>
        <form action="update_feed.php" method="POST">
            <input type="hidden" name="id" value="<?php echo $feed['id']; ?>">
            <div class="mb-3">
                <label for="feed_name" class="form-label">Feed Name</label>
                <input type="text" class="form-control" id="feed_name" name="feed_name" value="<?php echo $feed['feed_name']; ?>" required>
            </div>
            <div class="mb-3">
                <label for="ingredients" class="form-label">Ingredients</label>
                <textarea class="form-control" id="ingredients" name="ingredients" rows="4" required><?php echo $feed['ingredients']; ?></textarea>
            </div>
            <div class="mb-3">
                <label for="cost" class="form-label">Cost</label>
                <input type="number" class="form-control" id="cost" name="cost" value="<?php echo $feed['cost']; ?>" required>
            </div>
            <button type="submit" class="btn btn-primary">Update</button>
            <a href="feed_recipes.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</body>
</html>
