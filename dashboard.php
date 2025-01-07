<?php
// Start session
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

// Database connection
include 'includes/db.php';

// Fetch metrics from the database
$user_id = $_SESSION['user_id'];

// Query for total recipes
$query_recipes = "SELECT COUNT(*) AS total_recipes FROM feed_recipes WHERE user_id = ?";
$stmt_recipes = $conn->prepare($query_recipes);
$stmt_recipes->bind_param('i', $user_id);
$stmt_recipes->execute();
$result_recipes = $stmt_recipes->get_result();
$total_recipes = $result_recipes->fetch_assoc()['total_recipes'];

// Query for cost analyses
$query_analyses = "SELECT COUNT(*) AS total_analyses FROM cost_analysis WHERE user_id = ?";
$stmt_analyses = $conn->prepare($query_analyses);
$stmt_analyses->bind_param('i', $user_id);
$stmt_analyses->execute();
$result_analyses = $stmt_analyses->get_result();
$total_analyses = $result_analyses->fetch_assoc()['total_analyses'];

// Dummy data for now (you can add more queries later)
$total_users = 5; // Replace with dynamic query if needed
$pending_tasks = 2; // Replace with dynamic query if needed
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - Least-Cost Feed Formulation</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f8f9fa;
        }
    </style>
</head>
<body>
    <!-- Navbar -->

    <?php include 'navbar.php';?>

    <!-- Content -->
    <div class="container mt-4">
        <h1 class="mb-4">Dashboard</h1>
        <div class="row">
            <div class="col-md-3">
                <div class="card text-white bg-primary mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Total Recipes</h5>
                        <p class="card-text"><?php echo $total_recipes; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-success mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Cost Analyses</h5>
                        <p class="card-text"><?php echo $total_analyses; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-warning mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Users</h5>
                        <p class="card-text"><?php echo $total_users; ?></p>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="card text-white bg-danger mb-3">
                    <div class="card-body">
                        <h5 class="card-title">Pending Tasks</h5>
                        <p class="card-text"><?php echo $pending_tasks; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
