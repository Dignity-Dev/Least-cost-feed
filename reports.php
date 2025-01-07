<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'includes/db.php';

// Fetch feed recipes
$query = "SELECT * FROM feed_recipes WHERE user_id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

// Calculate summary
$total_cost = 0;
$total_recipes = $result->num_rows;

$recipes = [];
while ($row = $result->fetch_assoc()) {
    $recipes[] = $row;
    $total_cost += $row['cost'];
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reports</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css">
</head>
<body>
<?php include 'navbar.php'; ?>
    <div class="container mt-5">
        <h2>Reports</h2>
        <div class="alert alert-primary">
            <p><strong>Total Feed Recipes:</strong> <?php echo $total_recipes; ?></p>
            <p><strong>Total Cost of All Recipes:</strong> ₦<?php echo number_format($total_cost, 2); ?></p>
        </div>

        <h3>Feed Recipes</h3>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Feed Name</th>
                    <th>Ingredients</th>
                    <th>Cost (₦)</th>
                </tr>
            </thead>
            <tbody>
                <?php if (count($recipes) > 0): ?>
                    <?php foreach ($recipes as $index => $recipe): ?>
                        <tr>
                            <td><?php echo $index + 1; ?></td>
                            <td><?php echo htmlspecialchars($recipe['feed_name']); ?></td>
                            <td><?php echo htmlspecialchars($recipe['ingredients']); ?></td>
                            <td><?php echo number_format($recipe['cost'], 2); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="4" class="text-center">No recipes found.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>

        <a href="export_report.php" class="btn btn-success">Download Report (CSV)</a>
    </div>
</body>
</html>
