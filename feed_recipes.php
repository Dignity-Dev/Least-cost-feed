<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'includes/db.php';

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM feed_recipes WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Feed Recipes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <?php include 'navbar.php'; ?>

    <div class="container mt-4">
        <h1>Feed Recipes</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Feed Name</th>
                    <th>Ingredients</th>
                    <th>Cost</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php while ($row = $result->fetch_assoc()): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($row['feed_name']); ?></td>
                        <td><?php echo htmlspecialchars($row['ingredients']); ?></td>
                        <td><?php echo htmlspecialchars($row['cost']); ?></td>
                        <td>
    <a href="edit_feed.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
    <a href="delete_feed.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm"
       onclick="return confirm('Are you sure you want to delete this recipe?');">Delete</a>
</td>

                    </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
