<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

include 'includes/db.php';

$user_id = $_SESSION['user_id'];

// Fetch user details (Optional: can be used for user-specific costs or data)
$query = "SELECT * FROM users WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

$message = "";

// Handling form submission for cost analysis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['analyze_cost'])) {
        // Fetch form data
        $feed_type = $_POST['feed_type'];
        $ingredient_cost = $_POST['ingredient_cost'];
        $quantity_needed = $_POST['quantity_needed'];

        // Perform calculations (simple example: cost per quantity)
        $total_cost = $ingredient_cost * $quantity_needed;

        // Optionally, save this analysis data to the database
        // Insert query to save analysis data into the database can go here...

        // Display result (can be improved with graphs, charts, etc.)
        $message = "<div class='alert alert-success'>Total Cost: ₦" . number_format($total_cost, 2) . "</div>";
    }
}

$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cost Analysis</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php include 'navbar.php'; ?> <!-- Including the navbar -->

<div class="container mt-5">
    <h2>Cost Analysis for Poultry Feeds</h2>
    <?php echo $message; ?>

    <!-- Form for Cost Analysis -->
    <div class="card mt-4">
        <div class="card-header">
            <h5>Enter Feed and Ingredient Data</h5>
        </div>
        <div class="card-body">
            <form action="cost_analysis.php" method="POST">
                <div class="mb-3">
                    <label for="feed_type" class="form-label">Feed Type</label>
                    <input type="text" class="form-control" id="feed_type" name="feed_type" required>
                </div>

                <div class="mb-3">
                    <label for="ingredient_cost" class="form-label">Ingredient Cost (per unit)</label>
                    <input type="number" class="form-control" id="ingredient_cost" name="ingredient_cost" step="0.01" required>
                </div>

                <div class="mb-3">
                    <label for="quantity_needed" class="form-label">Quantity Needed (units)</label>
                    <input type="number" class="form-control" id="quantity_needed" name="quantity_needed" required>
                </div>

                <button type="submit" name="analyze_cost" class="btn btn-primary">Analyze Cost</button>
            </form>
        </div>
    </div>

    <!-- Results Section (Optional: You can display cost data here) -->
    <div class="mt-5">
        <h4>Cost Analysis Results</h4>
        <div class="card">
            <div class="card-body">
                <canvas id="costChart"></canvas> <!-- Chart.js chart -->
            </div>
        </div>
    </div>
</div>

<script>
// Chart.js to visualize cost data
const ctx = document.getElementById('costChart').getContext('2d');
const costChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Total Cost'],  // Replace with your data labels (feed types, etc.)
        datasets: [{
            label: 'Cost (₦)',
            data: [<?php echo isset($total_cost) ? $total_cost : 0; ?>],  // Dynamically inserted PHP value
            backgroundColor: 'rgba(75, 192, 192, 0.2)',
            borderColor: 'rgba(75, 192, 192, 1)',
            borderWidth: 1
        }]
    },
    options: {
        responsive: true,
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});
</script>

</body>
</html>
